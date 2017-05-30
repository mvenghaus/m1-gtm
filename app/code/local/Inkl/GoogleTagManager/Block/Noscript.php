<?php

use Inkl\GoogleTagManager\GoogleTagManager;
use Inkl\GoogleTagManager\Schema\Id;

class Inkl_GoogleTagManager_Block_NoScript extends Mage_Core_Block_Template
{

	protected function _toHtml()
	{
		return GoogleTagManager::getInstance()->getNoScriptTag(new Id(Mage::helper('inkl_googletagmanager/config')->getId()));
	}

}
