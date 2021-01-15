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
    }

    /**
     * @param string $renderer Renderer name
     * @return bool
     */
    public function remove($renderer)
    {
        if(isset($this->renderers[$renderer])) {
            unset($this->renderers[$renderer]);
            return true;
        }
        return false;
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
