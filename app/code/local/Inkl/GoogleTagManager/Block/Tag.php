<?php

use Inkl\GoogleTagManager\GoogleTagManager;
use Inkl\GoogleTagManager\Schema\Id;

class Inkl_GoogleTagManager_Block_Tag extends Mage_Core_Block_Template
{

	protected function _toHtml()
	{
		return GoogleTagManager::getInstance()->getTag(new Id(Mage::helper('inkl_googletagmanager/config')->getId()));
	}

}