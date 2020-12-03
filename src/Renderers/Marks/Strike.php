<?php

namespace Phprosemirror\Renderers\Marks;

use Phprosemirror\Mark;

class Strike extends Mark {
    public function toDOM($node) {
        return ['s', 0];
    }
}
