<?php

namespace Phprosemirror\Registry;

use Phprosemirror\Renderers\RendererInterface;

class RendererRegistry
{
    protected $renderers = [];

    /**
     * RendererRegistry constructor.
     * @param RendererInterface[] $renderers
     */
    public function __construct(array $renderers = [])
    {
        $this->add($renderers);
    }

    /**
     * @param RendererInterface|RendererInterface[] $renderers
     */
    public function add($renderers)
    {
        if (is_array($renderers)) {
            foreach ($renderers as $renderer) {
                $this->add($renderer);
            }

            return;
        }

        $this->renderers[$renderers::name()] = $renderers;
        return self;
    }

    /**
     * @param string|string[] $renderer Renderer name
     * @return bool
     */
    public function remove($renderers)
    {
        if(is_array($renderers)) {
            foreach ($renderers as $renderer) {
                $this->remove($renderer);
            }
        }
        if(isset($this->renderers[$renderers])) {
            unset($this->renderers[$renderers]);
        }
        return self;
    }

    public function clear()
    {
        $this->renderers = [];
        return self;
    }

    /**
     * @param string $type
     * @return RendererInterface
     */
    public function get($type)
    {
        if (!isset($this->renderers[$type])) {
            return null;
        }

        return $this->renderers[$type];
    }
}
