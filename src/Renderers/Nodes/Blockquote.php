<?php

namespace Phprosemirror\Renderers\Nodes;

class Blockquote extends Node {
    public function toDOM($node) {
        return ['blockquote', 0];
    }
}
