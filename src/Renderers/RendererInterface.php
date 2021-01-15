<?php

namespace Phprosemirror\Renderers;

interface RendererInterface {

    /**
     * Renderer name
     * @return string
     */
    public static function name();

    /**
     * Defines the way a node of this type should be serialized to DOM/HTML. This method is similar to [ProseMirror NodeSpec.toDOM](https://prosemirror.net/docs/ref/#model.NodeSpec.toDOM).
     * @param object $node This class represents a node in the tree that makes up a ProseMirror document. View [ProseMirror Node](https://prosemirror.net/docs/ref/#model.Node) for more info.
     * @return string|array
     */
    public function toDOM($node);

    /**
     * Get text content of this node. Text node are parsed automatically, use this method to get text inside attributes.
     * @param object $node This class represents a node in the tree that makes up a ProseMirror document. View [ProseMirror Node](https://prosemirror.net/docs/ref/#model.Node) for more info.
     * @return array|string|null
     */
    public function getText($node);
}
