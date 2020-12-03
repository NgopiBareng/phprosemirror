<?php

namespace Phprosemirror\Renderers\Nodes;

use Phprosemirror\Node;

class Heading extends Node {
    public function toDOM($node) {
        return ['h'.$node->attrs->level, 0];
    }
}
