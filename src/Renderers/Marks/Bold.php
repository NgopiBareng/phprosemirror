<?php

namespace Phprosemirror\Renderers\Marks;

use Phprosemirror\Mark;

class Bold extends Mark {
    public function toDOM($node) {
        return ['strong', 0];
    }
}
