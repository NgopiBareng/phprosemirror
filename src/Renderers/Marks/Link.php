<?php

namespace Phprosemirror\Renderers\Marks;

use Phprosemirror\Mark;

class Link extends Mark {
    public function toDOM($node) {
        return ['a', $node->attrs, 0];
    }

    public function getText($node) {
        return $node->attrs->href ?? null;
    }
}
