<?php

namespace Phprosemirror\Renderers\Nodes;

use Phprosemirror\Node;

class Table extends Node {
    public function toDOM($node) {
        return ['table', ['tbody', 0]];
    }
}
