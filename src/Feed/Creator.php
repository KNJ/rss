<?php

namespace Wazly\Feed;

use Closure;

abstract class Creator
{
    public static function createElement(string $name, array $attrs = [])
    {
        $elem = new Element($name, $attrs);

        return $elem;
    }

    abstract public function add(Element $elem);

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

    public function addElement(string $name, Closure $closure, array $attrs = [])
    {
        $elem = new Element($name, $attrs);
        $elem = $closure($elem);
        $this->add($elem);

        return $this;
    }
}
