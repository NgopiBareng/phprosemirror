<?php

namespace Phprosemirror\Renderers\Marks;

class Superscript extends Mark {
    public function toDOM($node) {
        return ['sup', 0];
    }
}
