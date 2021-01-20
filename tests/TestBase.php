<?php

namespace Phprosemirror\Tests;

use Phprosemirror\Phprosemirror;
use PHPUnit\Framework\TestCase;

class TestBase extends TestCase
{
    protected $phprosemirror;
    protected $html;
    protected $json;

    public function __construct() {
        parent::__construct();
        $this->phprosemirror = new Phprosemirror();
        $this->html = file_get_contents(__DIR__ . '/example.html');
        $this->json = file_get_contents(__DIR__ . '/example.json');
        $this->phprosemirror->document($this->json);
    }
}
