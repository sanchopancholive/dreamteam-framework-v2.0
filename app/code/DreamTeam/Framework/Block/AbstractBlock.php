<?php

namespace DreamTeam\Framework\Block;

use DreamTeam\Framework\MainObject;

abstract class AbstractBlock extends MainObject
{
    protected $layout;

    protected $children = [];

    protected $sortedChildren = [];

    public $html = '';

    public function addBlock($block, $name, $before = null)
    {
        if (!is_object($block)) {
            $block = $this->createBlock($block);
        }

        if ($block) {
            $this->children[$name] = $block;
            if ($after === null) {
                $this->sortedChildren[] = $name;
            } else {
                $keyAfter = array_search($after, $this->sortedChildren);
                array_splice( $this->sortedChildren, $keyAfter, 0, $name);
            }
        }

        return $this;
    }

    public function createBlock($block)
    {
        $object = new $block;

        if (!($object instanceof AbstractBlock)) {
            return false;
        }

        return $object;
    }

    public function getChildHtml($name = null)
    {
        $html = '';
        if ($name === null) {
            foreach ($this->sortedChildren as $key => $value) {
                $html .= $this->getChildHtml($value);
            }

            return $html;
        }
        return $this->getChild($name)->toHtml();
    }

    public function getChild($name)
    {
        return $this->children[$name];
    }

    public function toHtml()
    {
        return $this->html;
    }

}