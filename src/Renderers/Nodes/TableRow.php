<?php

namespace Phprosemirror\Renderers\Nodes;

use Phprosemirror\Node;

class TableRow extends Node {
    public function toDOM($node) {
        return ['tr', 0];
    }
}
