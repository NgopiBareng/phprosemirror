<?php

namespace Phprosemirror\Renderers\Marks;

class Link extends Mark {
    public function toDOM($node) {
        return ['a', $node->attrs, 0];
    }
}
