<?php

namespace Phprosemirror\Renderers\Nodes;

use Phprosemirror\Node;

class Paragraph extends Node {
    public function toDOM($node) {
        return ['p', 0];
    }
}
