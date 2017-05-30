<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Block_DataLayer extends Mage_Core_Block_Template
{

	protected function _toHtml()
	{
		return GoogleTagManager::getInstance()->getDataLayer()->render();
	}

}
