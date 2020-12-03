<?php

namespace Phprosemirror\Renderers\Nodes;

class TableHeader extends Node {
    public function toDOM($node) {
        return ['th', 0];
    }
}
