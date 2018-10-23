<?php

namespace DreamTeam\Framework\Block;

use DreamTeam\Framework\MainObject;

abstract class AbstractBlock extends MainObject
{
    protected $layout;

    protected $children = [];

    protected $template = null;

    public function addBlock($name, $block)
    {
        if (!is_object($block)) {
            $block = $this->createBlock($block);
        }

        if ($block) {
            $this->children[$name] = $block;
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

    public function getChildHtml($name)
    {
        return $this->getChild($name)->toHtml();
    }

    public function getChild($name)
    {
        return $this->children[$name];
    }

    public function toHtml()
    {
        ob_start();
        $fileName = $this->getTemplatePath();
        include $fileName;
        /** Get output buffer. */
        $html = ob_get_clean();
        return $html;
    }

    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function getTemplatePath()
    {
        $moduleAlias = explode('::', $this->getTemplate())[0];
        $moduleClass = '\\' . explode('_', $moduleAlias)[0]
            . '\\' . explode('_', $moduleAlias)[1] . '\\Module';
        $moduleObj = new $moduleClass;
        $tmpClass = new \ReflectionClass(get_class($moduleObj));
        $path = dirname($tmpClass->getFileName()) . DIRECTORY_SEPARATOR
            . explode('::', $this->getTemplate())[1];

        return $path;
    }
}