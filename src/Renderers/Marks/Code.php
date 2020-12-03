<?php

namespace Phprosemirror\Renderers\Marks;

use Phprosemirror\Mark;

class Code extends Mark {
    public function toDOM($node) {
        return ['code', 0];
    }
}
