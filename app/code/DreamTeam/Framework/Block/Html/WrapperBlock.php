<?php

namespace DreamTeam\Framework\Block\Html;

use DreamTeam\Framework\Block\AbstractBlock;

class WrapperBlock extends AbstractBlock
{
    protected $blockId = null;

    protected $class = [];

    protected $styles = null;

    protected $dataAttributes = [];

    public function setBlockId($blockId)
    {
        $this->blockId = $blockId;

        return $this;
    }

    public function getBlockId()
    {
        return $this->blockId;
    }

    public function setClass($class = [])
    {
        $this->class = $class;

        return $this;
    }

    public function addClass($class = [])
    {
        $this->class = array_merge($this->class, $class);

        return $this;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function render()
    {
        $html = '';
        $html .= '<div';

        if ($this->blockId !== null) {
            $html .= ' id="' . $this->blockId . '"';
        }

        if (count($this->getClass())) {
            $html .= ' class="';
            foreach ($this->getClass() as $class) {
                $html .= $class . ' ';
            }
            $html = rtrim($html);
            $html .= '"';
        }
        $html .= '>';
        $html .= $this->getChildHtml();
        $html .= '</div>';

        $this->html = $html;
    }

    public function toHtml()
    {
        $this->render();
        return parent::toHtml();
    }
}