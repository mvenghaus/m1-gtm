<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_CategoryName
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!$this->isCategoryView())
		{
			return;
		}

		$googleTagManager->addDataLayerVariable('categoryName', $this->getCategory()->getName());
	}

	private function getCategory()
	{
		return Mage::registry('current_category');
	}

	private function isCategoryView()
	{
		return (Mage::helper('inkl_googletagmanager/route')->getPath() === 'catalog/category/index');
	}

}
