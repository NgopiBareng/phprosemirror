<?php

namespace Phprosemirror\Renderers\Nodes;

class ListItem extends Node {
    public function toDOM($node) {
        return ['li', 0];
    }
}
