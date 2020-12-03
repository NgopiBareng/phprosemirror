<?php

namespace Phprosemirror;

use Phprosemirror\Registry\Factory;
use Phprosemirror\Renderers\PlainText;

class Phprosemirror {

    protected $document;
    protected $nodesRegistry;
    protected $marksRegistry;

    public function __construct() {
        $this->nodesRegistry = Factory::buildNodesRegistry();
        $this->marksRegistry = Factory::buildMarksRegistry();
    }

    public function document($value) {
        if (is_string($value)) {
            $value = json_decode($value);
        } elseif (is_array($value)) {
            $value = json_decode(json_encode($value));
        }

        $this->document = $value;

        return $this;
    }

    private function parseDOM($dom, $contentDOM) {
        $result = (object) [
            'tag' => null,
            'attrs' => null,
            'content' => null,
            'selfClosing' => true,
        ];

        if($dom instanceof PlainText) {
            return $dom;
        } else if(is_array($dom)) {
            $result->tag = $dom[0];
            $contents = [];

            if(isset($dom[1]) && ((is_array($dom[1]) && !isset($dom[1][0])) || is_object($dom[1]))) {
                $result->attrs = $dom[1];
                $contents = array_slice($dom, 2);
            } else if(count($dom) > 1) {
                $contents = array_slice($dom, 1);
            }

            if(count($contents) > 0) {
                $result->content = [];
                foreach ($contents as $content) {
                    if($content === 0) {
                        if(count($contents) > 1) {
                            throw new \Exception('DOM content placeholder must be the only content of the element');
                        }
                        $result->content = $contentDOM;
                        break;
                    }
                    $result->content[] = $this->parseDOM($content, $contentDOM);
                }
                $result->selfClosing = false;
            }
        } else {
            $result->tag = $dom;
        }

        return ($result->tag === null ? null : $result);
    }

    private function generateDOM($node) {
        $dom = null;
        if(is_object($node)) {
            $contentDOM = null;
            if(isset($node->text)) {
                $dom = new PlainText($node->text);
            } else {
                if(isset($node->content)) {
                    $contentDOM = [];
                    foreach ($node->content as $content) {
                        $contentDOM[] = $this->generateDOM($content);
                    }
                    if(!count($contentDOM)) {
                        $contentDOM = null;
                    }
                }

                $nodeRenderer = $this->nodesRegistry->get($node->type);
                if($nodeRenderer !== null) {
                    $dom = $nodeRenderer->toDOM($node);
                    $dom = $this->parseDOM($dom, $contentDOM);
                }
            }

            if(isset($node->marks)) {
                foreach ($node->marks as $mark) {
                    if(!is_object($mark)) {
                        $mark = (object) $mark;
                    }
                    $markRenderer = $this->marksRegistry->get($mark->type);
                    if($markRenderer !== null) {
                        $markDOM = $markRenderer->toDOM($mark);
                        if($dom instanceof PlainText) {
                            $dom = [$dom];
                        }
                        $dom = $this->parseDOM($markDOM, $dom);
                    }
                }
            }
        }
        return $dom;
    }

    private function renderDOM($dom) {
        if($dom === null) return '';

        $html = [];
        $attrs = '';
        if(is_array($dom->attrs)) {
            foreach ($dom->attrs as $attr => $value) {
                $attrs .= " $attr=\"$value\"";
            }
        }
        $html[] = "<{$dom->tag}{$attrs}>";

        if(!$dom->selfClosing) {
            if(is_array($dom->content)) {
                foreach ($dom->content as $content) {
                    if($content instanceof PlainText) {
                        $html[] = $content->text;
                    } else {
                        $html[] = $this->renderDOM($content);
                    }
                }
            }

            $html[] = "</$dom->tag>";
        }

        return implode('', $html);
    }

    public function toHTML($json) {
        $this->document($json);
        $html = [];
        $content = (is_array($this->document->content) ? $this->document->content : []);

        foreach ($content as $node) {
            $dom = $this->generateDOM($node);
            $html[] = $this->renderDOM($dom);
        }

        return implode('', $html);
    }
}
