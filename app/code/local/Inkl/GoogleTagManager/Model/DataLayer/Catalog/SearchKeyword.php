<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Catalog_SearchKeyword
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!Mage::helper('inkl_googletagmanager/route')->isSearch())
		{
			return;
		}

		$googleTagManager->addDataLayerVariable('searchKeyword', Mage::app()->getRequest()->getParam('q'));
	}

}
