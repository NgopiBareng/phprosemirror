<?php

namespace Phprosemirror\Renderers\Nodes;

class BulletList extends Node {
    public function toDOM($node) {
        return ['ul', 0];
    }
}
