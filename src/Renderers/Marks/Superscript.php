<?php

namespace Phprosemirror\Renderers\Marks;

use Phprosemirror\Mark;

class Superscript extends Mark {
    public function toDOM($node) {
        return ['sup', 0];
    }
}
