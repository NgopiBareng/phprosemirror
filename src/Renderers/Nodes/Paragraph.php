<?php

namespace Phprosemirror\Renderers\Nodes;

class Paragraph extends Node {
    public function toDOM($node) {
        return ['p', 0];
    }
}
