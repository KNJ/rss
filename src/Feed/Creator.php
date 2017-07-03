<?php

namespace Wazly\Feed;

use Closure;

abstract class Creator
{
    static public function createElement(string $name, array $attrs = [])
    {
        $elem = new Element($name, $attrs);

        return $elem;
    }

    public abstract function add(Element $elem);

    public function addTextElement(string $name, string $text, bool $cdata = false)
    {
        $elem = new Element($name);
        $elem->addText($text)->cdata($cdata);
        $this->add($elem);

        return $this;
    }

    public function addFlatElement(string $name, array $attrs = [])
    {
        $elem = new Element($name, $attrs);
        $this->add($elem);

        return $this;
    }

    public function addElement(string $name, Closure $closure)
    {
        $elem = new Element($name);
        $elem = $closure($elem);
        $this->add($elem);
    }
}
