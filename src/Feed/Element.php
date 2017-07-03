<?php

namespace Wazly\Feed;

class Element
{
    protected $element;
    protected $name;
    protected $text = '';
    protected $cdata = false;

    public function __construct(string $name, array $attrs = [])
    {
        $this->name = $name;
        $attrsStr = '';
        foreach ($attrs as $key => $val) {
            $attrsStr .= " {$key}=\"{$val}\"";
        }
        $this->element = "<$name$attrsStr>";
    }

    public function push(Element ...$elem)
    {
        foreach ($elem as $e) {
            $this->element = $this->element.PHP_EOL.$e.PHP_EOL;
        }
    }

    public function addText(string $text)
    {
        $this->text .= $text;

        return $this;
    }

    public function cdata(bool $cdata = true)
    {
        $this->cdata = $cdata;

        return $this;
    }

    public function __toString()
    {
        $text = $this->text;
        $text = str_replace(']]>', ']]&gt;', $text);
        $text = str_replace('<![CDATA[', '&lt;![CDATA[', $text);
        if ($this->cdata === true) {
            $text = '<![CDATA['.$text.']]>';
        }
        return $this->element.$text."</{$this->name}>";
    }
}
