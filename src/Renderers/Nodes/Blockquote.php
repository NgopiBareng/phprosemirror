<?php

namespace Phprosemirror\Renderers\Nodes;

use Phprosemirror\Node;

class Blockquote extends Node {
    public function toDOM($node) {
        return ['blockquote', 0];
    }
}
