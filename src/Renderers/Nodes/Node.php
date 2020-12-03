<?php

namespace Phprosemirror\Renderers\Nodes;

use Phprosemirror\Helpers\StringHelper;
use Phprosemirror\Renderers\RendererInterface;

abstract class Node implements RendererInterface {
    public static function name() {
        return StringHelper::toSnakeCase((new \ReflectionClass(static::class))->getShortName());
    }
}
