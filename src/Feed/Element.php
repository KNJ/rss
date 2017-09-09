<?php

namespace Wazly\Feed;

class Element
{
    protected $element;
    protected $name;
    protected $text = '';
    protected $cdata = false;
    protected $raw = false;

    public function __construct(string $name, array $attrs = [])
    {
        $this->name = $name;
        $attrsStr = '';
        foreach ($attrs as $key => $val) {
            $val = htmlspecialchars($val);
            $attrsStr .= " {$key}=\"{$val}\"";
        }
        $this->element = "<$name$attrsStr>";
    }

    /**
     * Add elements into the element.
     *
     * @param  \Wazly\Feed\Element $elem
     * @return \Wazly\Feed\Element
     */
    public function push(Element ...$elem): Element
    {
        foreach ($elem as $e) {
            $this->element = $this->element.$e;
        }

        return $this;
    }

    /**
     * Add text into the element.
     *
     * @param string $text
     * @return \Wazly\Feed\Element
     */
    public function addText(string $text): Element
    {
        $this->text .= $text;

        return $this;
    }

    /**
     * Whether to convert special characters (in text node) to HTML entities.
     *
     * @param  bool $raw
     * @return \Wazly\Feed\Element
     */
    public function raw(bool $raw = true): Element
    {
        $this->raw = $raw;

        return $this;
    }

    /**
     * Whether to wrap the text with CDATA section.
     *
     * @param  bool $cdata
     * @param  bool $raw
     * @return \Wazly\Feed\Element
     */
    public function cdata(bool $cdata = true, bool $raw = true): Element
    {
        $this->cdata = $cdata;
        $this->raw = $raw;

        return $this;
    }

    public function __toString()
    {
        if ($this->raw === false) {
            $text = htmlspecialchars($this->text);
        } else {
            $text = $this->text;
        }

        if ($this->cdata === true) {
            $text = '<![CDATA['.$text.']]>';
        }

        return $this->element.$text."</{$this->name}>";
    }
}
