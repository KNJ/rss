<?php

namespace Wazly\Feed;

class Rss extends Creator
{
    const HEADER = '<?xml version="1.0" encoding="utf-8" ?>';

    protected $rssElem;
    protected $channelElem;

    public function __construct(array $namespaces = [])
    {
        $this->document = new Document;
        $this->document->add(self::HEADER.PHP_EOL);
        $this->rssElem = new Element('rss', array_merge($namespaces, ['version' => '2.0']));
        $this->channelElem = new Element('channel');
    }

    public function add(Element $elem)
    {
        $this->channelElem->push($elem);

        return $this;
    }

    public function publish()
    {
        $this->rssElem->push($this->channelElem);
        $this->document->add($this->rssElem);

        return $this->document;
    }
}
