<?php

namespace Phprosemirror\Renderers\Nodes;

use Phprosemirror\Node;

class Image extends Node {
    public function toDOM($node) {
        return ['img', $node->attrs];
    }
}
