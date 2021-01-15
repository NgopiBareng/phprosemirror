<?php

namespace Phprosemirror;

use Phprosemirror\Registry\Factory;
use stdClass;

class Phprosemirror {

    protected $document;
    public $nodes;
    public $marks;

    public function __construct() {
        $this->nodes = Factory::buildNodesRegistry();
        $this->marks = Factory::buildMarksRegistry();
    }

    /**
     * Set ProseMirror Document from JSON
     */
    public function document($json) {
        if (is_string($json)) {
            $json = json_decode($json);
        } elseif (is_array($json)) {
            $json = json_decode(json_encode($json));
        }

        if(json_last_error() == JSON_ERROR_NONE) {
            $this->document = $json;
        }

        return $this;
    }

    /**
     * Check document validity. The json requirement are `{"type": "doc", "content": []}`
     * @param stdClass|null $document ProseMirror Document. Set to null to get current document.
     * @return bool
     */
    public function isDocumentValid($document = null) {
        if($document === null) $document = $this->document;
        return (
            isset($document) &&
            is_object($document) &&
            isset($document->type) &&
            isset($document->content) &&
            $document->type === 'doc' &&
            is_array($document->content)
        );
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

            if(isset($dom[1]) && ((is_array($dom[1]) && !isset($dom[1][0])) || $dom[1] instanceof stdClass)) {
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

                $nodeRenderer = $this->nodes->get($node->type);
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
                    $markRenderer = $this->marks->get($mark->type);
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
        if(is_array($dom->attrs) || $dom->attrs instanceof stdClass) {
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

    private function renderText($node) {
        $text = [];
        if(is_object($node)) {
            if(isset($node->text)) {
                $text[] = $node->text;
            } else {
                if(isset($node->content)) {
                    foreach ($node->content as $content) {
                        $text = array_merge($text, $this->renderText($content));
                    }
                }

                $nodeRenderer = $this->nodes->get($node->type);
                if($nodeRenderer !== null) {
                    $nodeText = $nodeRenderer->getText($node);
                    if(is_array($nodeText)) {
                        $text = array_merge($text, $nodeText);
                    } else if(is_string($nodeText)) {
                        $text[] = $nodeText;
                    }
                }
            }

            if(isset($node->marks)) {
                foreach ($node->marks as $mark) {
                    if(!is_object($mark)) {
                        $mark = (object) $mark;
                    }
                    $markRenderer = $this->marks->get($mark->type);
                    if($markRenderer !== null) {
                        $markText = $markRenderer->getText($mark);
                        if(is_array($markText)) {
                            $text = array_merge($text, $markText);
                        } else if(is_string($markText)) {
                            $text[] = $markText;
                        }
                    }
                }
            }
        }
        return $text;
    }

    /**
     * Converts ProseMirror Document to HTML. Returns empty string if the document are invalid.
     * @param string|null $json ProseMirror JSON
     * @return string
     */
    public function toHTML($json = null) {
        if($json !== null) {
            $this->document($json);
        }
        $html = [];

        if($this->isDocumentValid()) {
            $content = $this->document->content;

            foreach ($content as $node) {
                $dom = $this->generateDOM($node);
                $html[] = $this->renderDOM($dom);
            }
        }

        return implode('', $html);
    }

    /**
     * Get text from ProseMirror Document. Returns empty string if the document are invalid.
     * @param string|null $json ProseMirror JSON
     * @return string
     */
    public function toText($json = null) {
        if($json !== null) {
            $this->document($json);
        }
        $text = [];

        if($this->isDocumentValid()) {
            $content = $this->document->content;

            foreach ($content as $node) {
                $text = array_merge($text, $this->renderText($node));
            }
        }

        return implode(' ', array_filter($text, function($string) {
            return strlen($string) && $string !== ' ';
        }));
    }
}
