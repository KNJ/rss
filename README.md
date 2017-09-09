# RSS

[![StyleCI](https://styleci.io/repos/95765597/shield?branch=master)](https://styleci.io/repos/95765597)

## Example

```php
<?php
namespace Wazly\Feed;

header('Content-Type: text/xml; charset=UTF-8');

require_once __DIR__ . '/../vendor/autoload.php';

use DateTime;

$now = new DateTime;

$rss = new Rss([
    'xmlns:content' => 'http://purl.org/rss/1.0/modules/content/',
    'xmlns:gnf' => 'http://assets.gunosy.com/media/gnf',
    'xmlns:media' => 'http://search.yahoo.com/mrss/',
    'xmlns:dc' => 'http://purl.org/dc/elements/1.1/',
]);

$rss->addTextElement('title', 'Wazly', true)
    ->addTextElement('link', 'https://example.wazly.net')
    ->addTextElement(
        'description',
        'Site description here.',
        true
    )
    ->addTextElement(
        'lastBuildDate',
        $now->format(DateTime::RFC2822)
    )
    ->addTextElement('language', 'ja')
    ->addElement('image', function ($elem) {
        $url = Creator::createElement('url')->addText('https://example.wazly.net/img/logo.png');
        $title = Creator::createElement('title')->addText('Wazly')->cdata();
        $link = Creator::createElement('link')->addText('https://example.wazly.net');
        $elem->push($url, $title, $link);

        return $elem;
    });

$item = new Item;
$item->addTextElement('title', 'How to Build Your Application on CircleCI 2.0', true)
    ->addTextElement('link', 'https://example.wazly.net/article/1234')
    ->addTextElement('guid', 'https://example.wazly.net/article/1234')
    ->addTextElement('description', 'CircleCI 2.0 gives your team more speed and configurability than ever before...', true)
    ->addTextElement('pubDate', $now->format(DateTime::RFC2822))
    ->addTextElement('content:encoded', 'Flexible, automated provisioning allows teams to take full advantage of parallel execution for less downtime waiting for a workflow to complete...', true)
    ->addTextElement('gnf:category', 'technology')
    ->addFlatElement('enclosure', [
        'url' => 'https://example.wazly.net/img/article/915fb.jpg',
        'type' => 'image/jpeg',
        'length' => '626124',
    ])
    ->addFlatElement('gnf:relatedLink', [
        'title' => 'How to Build, Test and Deploy Your Project with AWS CodePipeline',
        'link' => 'https://example.wazly.net/article/660?utm_source=unko&utm_medium=banner',
    ])
    ->addFlatElement('gnf:relatedLink', [
        'title' => 'CircleCI 2.0 is Now Released',
        'link' => 'https://example.wazly.net/article/1001?utm_source=unko&utm_medium=banner',
    ])
    ->addElement('rel', function ($elem) {
        $rel_title = Creator::createElement('rel_title')->addText('Introduction to Continuous Integration')->cdata();
        $rel_link = Creator::createElement('rel_link')->addText('https://example.wazly.net/article/563?utm_source=unko&utm_medium=banner')->cdata();
        $rel_creator = Creator::createElement('rel_creator')->addText('knj')->cdata();

        return $elem->push($rel_title, $rel_link, $rel_creator);
    });

$rss->add($item->dump());

echo $rss->publish();
```
