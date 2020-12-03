<?php

namespace Phprosemirror\Renderers\Nodes;

use Phprosemirror\Node;

class TableHeader extends Node {
    public function toDOM($node) {
        return ['th', 0];
    }
}
