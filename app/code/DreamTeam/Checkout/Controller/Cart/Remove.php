<?php

namespace DreamTeam\Checkout\Controller\Cart;

use DreamTeam\Framework\Controller\FrontAction;

class Remove extends FrontAction
{
    public function execute()
    {
        $rootBlock = new \DreamTeam\Framework\Block\Root();
        $rootBlock->addBlock('head', \DreamTeam\Framework\Block\Html\Head::class)
            ->addBlock('page', \DreamTeam\Framework\Block\Html\Page::class);
        $pageBlock = $rootBlock->getChild('page')->setTempValue('Hello World!!!!');
        $output = $rootBlock->toHtml();
        echo $output;
        return;
//        $block = new \DreamTeam\Framework\Block\Html\Page\Header();
//        $block->getTemplate();
    }
}