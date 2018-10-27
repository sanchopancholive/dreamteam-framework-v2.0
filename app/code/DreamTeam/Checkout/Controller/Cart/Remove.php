<?php

namespace DreamTeam\Checkout\Controller\Cart;

use DreamTeam\Framework\Controller\FrontAction;

class Remove extends FrontAction
{
    public function execute()
    {
        $rootBlock = new \DreamTeam\Framework\Block\Root();
        $rootBlock->addBlock( \DreamTeam\Framework\Block\Html\Head::class, 'head')
            ->addBlock( \DreamTeam\Framework\Block\Html\Page::class, 'page');
        /** @var \DreamTeam\Framework\Block\Html\Page $pageBlock */
        $pageBlock = $rootBlock->getChild('page')
            ->addBlock(\DreamTeam\Framework\Block\Html\WrapperBlock::class, 'test');
        /** @var \DreamTeam\Framework\Block\Html\WrapperBlock $wrapper */
        $wrapper = $pageBlock->getChild('test');
        $wrapper->setBlockId('test-id')
            ->setClass(['test-class', 'test', 'class'])
            ->addClass(['new-test', 'new-test-class'])
            ->addBlock(\DreamTeam\Framework\Block\TemplateBlock::class, 'child-1')
            ->addBlock(\DreamTeam\Framework\Block\TemplateBlock::class, 'child-2')
            ->addBlock(\DreamTeam\Framework\Block\TemplateBlock::class, 'child-3', 'child-1');
        $wrapper->getChild('child-1')->setTemplate('DreamTeam_Checkout::view/children/child-1.phtml');
        $wrapper->getChild('child-2')->setTemplate('DreamTeam_Checkout::view/children/child-2.phtml');
        $wrapper->getChild('child-3')->setTemplate('DreamTeam_Checkout::view/children/child-3.phtml');
        $output = $rootBlock->toHtml();
        echo $output;
        return;
//        $block = new \DreamTeam\Framework\Block\Html\Page\Header();
//        $block->getTemplate();
    }
}