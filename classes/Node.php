<?php

namespace parseLog\classes;

require_once 'ChildNode.php';

use parseLog\classes\ChildNode as ChildNode;

class Node
{
    public $name;
    public $childNode;
    public $prp_childs;

    public function __construct($name, $childName)
    {
        $this->name = $name;
        $this->childNode = new ChildNode($childName);
        $this->prp_childs = array();
    }
}