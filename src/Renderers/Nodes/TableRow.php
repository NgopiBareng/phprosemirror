<?php

namespace Phprosemirror\Renderers\Nodes;

class TableRow extends Node {
    public function toDOM($node) {
        return ['tr', 0];
    }
}
