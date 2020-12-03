<?php

namespace Phprosemirror\Renderers\Marks;

class Subscript extends Mark {
    public function toDOM($node) {
        return ['sub', 0];
    }
}
