<?php

namespace Phprosemirror\Renderers\Nodes;

class HardBreak extends Node {
    public function toDOM($node) {
        return 'br';
    }
}
