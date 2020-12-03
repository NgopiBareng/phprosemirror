<?php

namespace Phprosemirror\Renderers\Nodes;

use Phprosemirror\Node;

class ListItem extends Node {
    public function toDOM($node) {
        return ['li', 0];
    }
}
