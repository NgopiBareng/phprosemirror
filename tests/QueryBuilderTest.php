<?php

namespace Phprosemirror\Tests;

class QueryBuilderTest extends TestBase
{
    public function testType() {
        $expected = '[{"type":"paragraph","content":[{"type":"text","text":"Text paragraph"}]},{"type":"paragraph","content":[{"type":"text","text":"Normal"},{"type":"paragraph","content":[{"type":"text","marks":[{"type":"link","attrs":{"href":"www.google.com","target":null}}],"text":"Link"}]},{"type":"text","marks":[{"type":"strike"}],"text":"Strike"},{"type":"text","text":" "},{"type":"text","marks":[{"type":"bold"}],"text":"bold"},{"type":"text","text":" "},{"type":"text","marks":[{"type":"italic"}],"text":"italic"},{"type":"text","text":" "},{"type":"text","marks":[{"type":"underline"}],"text":"underline"},{"type":"text","text":" "},{"type":"text","marks":[{"type":"bold"},{"type":"italic"},{"type":"strike"},{"type":"underline"}],"text":"combination of all"}]}]';

        $actual = $this->phprosemirror->query()
            ->where('type', 'paragraph')
            ->get();

        $this->assertSame($expected, json_encode($actual));
    }

    public function testAttrs() {
        $expected = '{"type":"heading","attrs":{"level":2},"content":[{"type":"text","text":"heading 2"}]}';

        $actual = $this->phprosemirror->query(null, true)->where('attrs', ['level' => 2])->first();

        $this->assertSame($expected, json_encode($actual));
    }
}
