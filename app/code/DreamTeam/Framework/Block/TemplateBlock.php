<?php

namespace DreamTeam\Framework\Block;

class TemplateBlock extends AbstractBlock
{
    protected $template = null;

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

    public function toHtml()
    {
        ob_start();
        $fileName = $this->getTemplatePath();
        include $fileName;
        /** Get output buffer. */
        $this->html = ob_get_clean();
        return parent::toHtml();
    }
}