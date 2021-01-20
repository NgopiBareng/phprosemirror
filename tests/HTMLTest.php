<?php

namespace Phprosemirror\Tests;

class HTMLTest extends TestBase
{
    public function testCorrect() {
        $this->assertSame($this->html, $this->phprosemirror->toHTML());
    }
}
