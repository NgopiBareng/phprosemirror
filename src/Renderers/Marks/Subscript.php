<?php

namespace Phprosemirror\Renderers\Marks;

use Phprosemirror\Mark;

class Subscript extends Mark {
    public function toDOM($node) {
        return ['sub', 0];
    }
}
