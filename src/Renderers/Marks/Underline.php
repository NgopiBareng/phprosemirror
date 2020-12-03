<?php

namespace Phprosemirror\Renderers\Marks;

class Underline extends Mark {
    public function toDOM($node) {
        return ['u', 0];
    }
}
