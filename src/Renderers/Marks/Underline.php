<?php

namespace Phprosemirror\Renderers\Marks;

use Phprosemirror\Mark;

class Underline extends Mark {
    public function toDOM($node) {
        return ['u', 0];
    }
}
