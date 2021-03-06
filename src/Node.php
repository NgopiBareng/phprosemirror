<?php

namespace Phprosemirror;

use Phprosemirror\Helpers\StringHelper;
use Phprosemirror\Renderers\RendererInterface;

abstract class Node implements RendererInterface {
    public static function name() {
        return StringHelper::toSnakeCase((new \ReflectionClass(static::class))->getShortName());
    }

    public function getText($node) {
        return null;
    }
}
