<?php

namespace Phprosemirror\Renderers\Nodes;

class OrderedList extends Node {
    public function toDOM($node) {
        return ($node->attrs->order === 1 ? ['ol', 0] : ['ol', ['start' => $node->attrs->order], 0]);
    }
}
