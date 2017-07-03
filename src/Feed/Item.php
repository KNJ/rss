<?php

namespace Wazly\Feed;

class Item extends Creator
{
    protected $element;

    public function __construct()
    {
        $this->element = new Element('item');
    }

    public function add(Element $elem)
    {
        $this->element->push($elem);

        return $this;
    }

    public function dump()
    {
        return $this->element;
    }
}
