<?php

namespace Phprosemirror\Renderers\Marks;

class Code extends Mark {
    public function toDOM($node) {
        return ['code', 0];
    }
}
