<?php
require __DIR__.'/../vendor/autoload.php';

use Phprosemirror\Phprosemirror;

$renderer = new Phprosemirror();
$renderer->document('{"type":"doc","content":[{"type":"paragraph","content":[{"type":"text","text":"Text paragraph <img src=\"a\">"}]},{"type":"paragraph","content":[{"type":"text","text":"Normal"},{"type":"paragraph","content":[{"type":"text","marks":[{"type":"link","attrs":{"href":"www.google.com","target":null}}],"text":"Link"}]},{"type":"text","marks":[{"type":"strike"}],"text":"Strike"},{"type":"text","text":" "},{"type":"text","marks":[{"type":"bold"}],"text":"bold"},{"type":"text","text":" "},{"type":"text","marks":[{"type":"italic"}],"text":"italic"},{"type":"text","text":" "},{"type":"text","marks":[{"type":"underline"}],"text":"underline"},{"type":"text","text":" "},{"type":"text","marks":[{"type":"bold"},{"type":"italic"},{"type":"strike"},{"type":"underline"}],"text":"combination of all"}]},{"type":"image","attrs":{"src":"uploads\/2020\/2020-12-03\/image.png","alt":"image"}},{"type":"heading","attrs":{"level":1},"content":[{"type":"text","text":"heading"}]},{"type":"heading","attrs":{"level":2},"content":[{"type":"text","text":"heading 2"}]},{"type":"heading","attrs":{"level":3},"content":[{"type":"text","text":"heading 3"}]},{"type":"blockquote","content":[{"type":"paragraph","content":[{"type":"text","text":"quote"}]}]},{"type":"bullet_list","content":[{"type":"list_item","content":[{"type":"paragraph","content":[{"type":"text","text":"List"}]}]},{"type":"list_item","content":[{"type":"paragraph","content":[{"type":"text","text":"Bullet"}]}]}]},{"type":"ordered_list","attrs":{"order":1},"content":[{"type":"list_item","content":[{"type":"paragraph","content":[{"type":"text","text":"first"}]}]},{"type":"list_item","content":[{"type":"paragraph","content":[{"type":"text","text":"second"}]}]}]}]}');

$html = $renderer->toHTML();
$text = $renderer->toText();
echo "\"$html\"\n";
echo "\"$text\"\n";

var_dump($renderer->query(null, true)->where('attrs', ['level' => 2])->first());
