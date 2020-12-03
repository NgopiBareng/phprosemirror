<?php

namespace Phprosemirror\Renderers\Nodes;

class Table extends Node {
    public function toDOM($node) {
        return ['table', ['tbody', 0]];
    }
}
