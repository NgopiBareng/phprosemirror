<?php

namespace Phprosemirror\Renderers\Marks;

class Bold extends Mark {
    public function toDOM($node) {
        return ['strong', 0];
    }
}
