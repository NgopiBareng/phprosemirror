<?php

namespace Phprosemirror\Renderers\Nodes;

class CodeBlock extends Node {
    public function toDOM($node) {
        return ['pre', 0];
    }
}
