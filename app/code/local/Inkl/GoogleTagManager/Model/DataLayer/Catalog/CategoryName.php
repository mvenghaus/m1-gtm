<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Catalog_CategoryName
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!$this->isEnabled() || !Mage::helper('inkl_googletagmanager/route')->isCategory())
		{
			return;
		}

		$googleTagManager->addDataLayerVariable('categoryName', $this->getCategory()->getName());
	}

	private function getCategory()
	{
		return Mage::registry('current_category');
	}

	private function isEnabled()
	{
		return Mage::helper('inkl_googletagmanager/config_dataLayer_catalog')->isCategoryNameEnabled();
	}

}
