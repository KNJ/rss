<?php

namespace Wazly\Feed;

class Document
{
    protected $content = '';

    public function __construct()
    {
        //
    }

    public function add(string $str)
    {
        $this->content .= $str;

        return $this;
    }

    public function __toString()
    {
        return $this->content;
    }
}
