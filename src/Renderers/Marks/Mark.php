<?php

namespace Phprosemirror\Renderers\Marks;

use Phprosemirror\Helpers\StringHelper;
use Phprosemirror\Renderers\RendererInterface;

abstract class Mark implements RendererInterface {
    public static function name() {
        return StringHelper::toSnakeCase((new \ReflectionClass(static::class))->getShortName());
    }
}
