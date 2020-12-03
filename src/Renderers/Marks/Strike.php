<?php

namespace Phprosemirror\Renderers\Marks;

class Strike extends Mark {
    public function toDOM($node) {
        return ['s', 0];
    }
}
