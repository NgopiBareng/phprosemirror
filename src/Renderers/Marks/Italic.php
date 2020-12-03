<?php

namespace Phprosemirror\Renderers\Marks;

class Italic extends Mark {
    public function toDOM($node) {
        return ['em', 0];
    }
}
