<?php

namespace Phprosemirror\Renderers;

class PlainText {
    public $text;

    public function __construct($text) {
        $this->text = $text;
    }
}
