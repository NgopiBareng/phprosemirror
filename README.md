# Phprosemirror

Work with prosemirror document in php. Convert prosemirror document to HTML or query the prosemirror document

## Installation

You can install the package via composer:

```bash
composer require ngopibareng/phprosemirror:dev-main
```

## Usage

### Getting started
``` php
use Phprosemirror\Phprosemirror;

$phprosemirror = new Phprosemirror();

$html = $phprosemirror->toHTML($prosemirror_json);
$text = $phprosemirror->toText($prosemirror_json); // only get text without markup

// or set the prosemirror document first

$phprosemirror = new Phprosemirror();
$phprosemirror->document($prosemirror_json);

$html = $phprosemirror->toHTML();
$text = $phprosemirror->toText();
```

### Querying Prosemirror Document
```php
use Phprosemirror\Phprosemirror;

$phprosemirror = new Phprosemirror();

// Get all top level heading
$headings = $phprosemirror->query($prosemirror_json)
    ->where('type', 'heading')
    ->get();

// Get all paragraph (with nested paragraph)
$paragraphs = $phprosemirror->query($prosemirror_json, true)
    ->where('type', 'paragraph')
    ->get();

// Get one level 2 heading (with nested heading and existing document)
$heading2 = $phprosemirror->query(null, true)
    ->where([
        'type' => 'heading',
        'attrs' => ['level' => 2],
    ])
    ->first();

// Create new prosemirror document from query builder result
$html = $phprosemirror->query()
    ->where('type', 'paragraph')
    ->createDocument();
```

## TODOs
- [ ] Document custom node & marks renderer
- [ ] Query marks
- [ ] Advanced where operator

### Testing

``` bash
composer test
```

## Credits

- [Ngopibareng](https://github.com/ngopibareng)
