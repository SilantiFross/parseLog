<?php

namespace parseLog\classes;


class ChildNode
{
    public $name;
    public $childPrpArray;

    public function __construct($name)
    {
        $this->name = $name;
        $this->childPrpArray = array();
    }
}