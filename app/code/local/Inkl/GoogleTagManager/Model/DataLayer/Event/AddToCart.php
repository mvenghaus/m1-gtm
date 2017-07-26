<?php

class Inkl_GoogleTagManager_Model_DataLayer_Event_AddToCart
{

	public function addAssets()
	{
		if (!$this->isEnabled())
		{
			return;
		}

		Mage::app()->getLayout()->getBlock('head')->addItem('skin_js', 'js/googletagmanager/event/addToCart.js');
	}

	public function isEnabled()
	{
		return Mage::helper('inkl_googletagmanager/config_dataLayer_event')->isAddToCartEnabled();
	}

}