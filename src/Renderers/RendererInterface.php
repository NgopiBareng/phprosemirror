<?php

namespace Phprosemirror\Renderers;

interface RendererInterface {

    /**
     * @return string
     */
    public static function name();

    /**
     * @param $node
     * @return string|array
     */
    public function toDOM($node);
}
