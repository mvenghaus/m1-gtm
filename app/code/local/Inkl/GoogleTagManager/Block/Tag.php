<?php

use Inkl\GoogleTagManager\GoogleTagManager;
use Inkl\GoogleTagManager\Schema\Id;

class Inkl_GoogleTagManager_Block_Tag extends Mage_Core_Block_Template
{

	protected function _toHtml()
	{
		$googleTagManager = GoogleTagManager::getInstance();

		Mage::dispatchEvent('googletagmanager_render_tag_before', ['google_tag_manager' => $googleTagManager]);

		return $googleTagManager->renderTag(new Id(Mage::helper('inkl_googletagmanager/config')->getId()));
	}

}
