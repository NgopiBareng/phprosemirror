<?php

namespace Phprosemirror\Renderers\Nodes;

class Image extends Node {
    public function toDOM($node) {
        return ['img', $node->attrs];
    }
}
