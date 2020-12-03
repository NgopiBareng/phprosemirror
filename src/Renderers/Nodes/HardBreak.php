<?php

namespace Phprosemirror\Renderers\Nodes;

use Phprosemirror\Node;

class HardBreak extends Node {
    public function toDOM($node) {
        return 'br';
    }
}
