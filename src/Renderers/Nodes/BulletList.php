<?php

namespace Phprosemirror\Renderers\Nodes;

use Phprosemirror\Node;

class BulletList extends Node {
    public function toDOM($node) {
        return ['ul', 0];
    }
}
