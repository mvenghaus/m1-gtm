<?php

class Inkl_GoogleTagManager_Block_Tag extends Mage_Core_Block_Template
{

	protected function _toHtml()
	{
		return Mage::helper('inkl_googletagmanager/config_general')->getTagPlaceholder();
	}

}
