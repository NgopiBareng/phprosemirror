<?php

namespace Phprosemirror\Renderers\Marks;

use Phprosemirror\Mark;

class Italic extends Mark {
    public function toDOM($node) {
        return ['em', 0];
    }
}
