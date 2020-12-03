<?php

namespace Phprosemirror\Renderers\Nodes;

use Phprosemirror\Node;

class CodeBlock extends Node {
    public function toDOM($node) {
        return ['pre', 0];
    }
}
