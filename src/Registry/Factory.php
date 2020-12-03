<?php

namespace Phprosemirror\Registry;

use Phprosemirror\Renderers\Marks\Bold;
use Phprosemirror\Renderers\Marks\Link;
use Phprosemirror\Renderers\Marks\Italic;
use Phprosemirror\Renderers\Marks\Strike;
use Phprosemirror\Renderers\Marks\Underline;
use Phprosemirror\Renderers\Marks\Code;
use Phprosemirror\Renderers\Marks\Superscript;
use Phprosemirror\Renderers\Marks\Subscript;

use Phprosemirror\Renderers\Nodes\Blockquote;
use Phprosemirror\Renderers\Nodes\BulletList;
use Phprosemirror\Renderers\Nodes\OrderedList;
use Phprosemirror\Renderers\Nodes\ListItem;
use Phprosemirror\Renderers\Nodes\Paragraph;
use Phprosemirror\Renderers\Nodes\Heading;
use Phprosemirror\Renderers\Nodes\Image;
use Phprosemirror\Renderers\Nodes\Table;
use Phprosemirror\Renderers\Nodes\TableRow;
use Phprosemirror\Renderers\Nodes\CodeBlock;
use Phprosemirror\Renderers\Nodes\HardBreak;
use Phprosemirror\Renderers\Nodes\TableCell;
use Phprosemirror\Renderers\Nodes\TableHeader;

class Factory
{
    /**
     * @return RendererRegistry
     */
    public static function buildMarksRegistry()
    {
        return new RendererRegistry([
            new Bold(),
            new Italic(),
            new Link(),
            new Strike(),
            new Underline(),
            new Code(),
            new Subscript(),
            new Superscript(),
        ]);
    }

    /**
     * @return RendererRegistry
     */
    public static function buildNodesRegistry()
    {
        return new RendererRegistry([
            new Blockquote(),
            new BulletList(),
            new Heading(),
            new ListItem(),
            new OrderedList(),
            new Paragraph(),
            new CodeBlock(),
            new HardBreak(),
            new Image(),
            new Table(),
            new TableCell(),
            new TableHeader(),
            new TableRow(),
        ]);
    }
}
