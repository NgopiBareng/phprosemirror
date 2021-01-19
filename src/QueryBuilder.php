<?php

namespace Phprosemirror;

class QueryBuilder {
    protected $document;
    protected $deep;
    protected $allowedKeys = ['type', 'attrs'];
    protected $conditions = [];

    public function __construct(object $document, bool $deep = false) {
        $this->document = $document;
        $this->deep = $deep;
    }

    private function addCondition($condition, $inverse = false) {
        $validCondition = [
            '__inverse' => $inverse,
        ];
        foreach ($this->allowedKeys as $allowed) {
            if(isset($condition[$allowed])) {
                $validCondition[$allowed] = $condition[$allowed];
            }
        }
        if(!empty($validCondition)) {
            $this->conditions[] = $validCondition;
        }
    }

    /**
     * Set query condition
     * @param string|array $key Key to check on the node or associative array of key and value
     * @param mixed $value Value to check
     * @return self
     */
    public function where($key, $value = null) {
        if(is_array($key)) {
            $this->addCondition($key);
        } else {
            $this->addCondition([$key => $value]);
        }
        return $this;
    }

    /**
     * Set exception query condition
     * @param string|array $key Key to check on the node or associative array of key and value
     * @param mixed $value Value to check
     * @return self
     */
    public function whereNot($key, $value = null) {
        if(is_array($key)) {
            $this->addCondition($key, true);
        } else {
            $this->addCondition([$key => $value], true);
        }
        return $this;
    }

    protected function checkType($node, $type, $inverse) {
        if($inverse) return ($type !== null && $node->type !== $type);
        $check = ($type !== null && $node->type === $type);
        if($inverse) return !$check;
        return $check;
    }

    protected function checkAttrs($node, $attrs, $inverse) {
        if(!is_array($attrs)) return false;
        $check = count(array_intersect_assoc($attrs, (array) ($node->attrs ?? []))) === count($attrs);
        if($inverse) return !$check;
        return $check;
    }

    protected function find($first = false, $content = null) {
        if($content === null) {
            $content = $this->document->content;
        }
        $result = [];
        foreach ($content as $node) {
            foreach ($this->conditions as $condition) {
                $type = $condition['type'] ?? null;
                $attrs = $condition['attrs'] ?? null;
                $inverse = $condition['__inverse'] ?? false;

                $typeValid = (!isset($condition['type']) || $this->checkType($node, $type, $inverse));
                $attrsValid = (!isset($condition['attrs']) || $this->checkAttrs($node, $attrs, $inverse));

                if($typeValid && $attrsValid) {
                    if($first) return $node;
                    $result[] = $node;
                }
                if($this->deep && isset($node->content)) {
                    $contentResult = $this->find($first, $node->content);
                    if($contentResult && $first) {
                        return $contentResult;
                    } else if(!$first) {
                        $result = array_merge($result, $contentResult);
                    }
                }
            }
        }
        if($first) {
            return null;
        }
        return $result;
    }

    /**
     * Execute query with the specified condition and get all result nodes
     * @return array Array of nodes
     */
    public function get() {
        return $this->find();
    }

    /**
     * Execute query with the specified condition and get only the first result node
     * @return object|null The resulting node if found, null if nothing found
     */
    public function first() {
        return $this->find(true);
    }

    /**
     * Create new Prosemirror document from query result
     * @param bool $first Only get the first result if true
     * @return object Prosemirror document
     */
    public function createDocument($first = false) {
        return (object) [
            'type' => 'doc',
            'content' => $this->find($first),
        ];
    }
}
