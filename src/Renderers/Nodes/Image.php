<?php

namespace Phprosemirror\Renderers\Nodes;

use Phprosemirror\Node;

class Image extends Node {
    public function toDOM($node) {
        return ['img', $node->attrs];
    }

    public function getText($node) {
        $alt = $node->attrs->alt;
        $src = $node->attrs->src;
        return [$alt, $src];
    }
}
