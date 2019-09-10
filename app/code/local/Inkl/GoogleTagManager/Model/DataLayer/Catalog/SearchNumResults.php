<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Catalog_SearchNumResults
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!$this->isEnabled() || !Mage::helper('inkl_googletagmanager/route')->isSearch())
		{
			return;
		}

		$googleTagManager->addDataLayerVariable('searchNumResults', $this->getSearchNumResults());
	}

	private function getSearchNumResults()
	{
		/** @var Mage_Catalog_Block_Product_List $searchProductListBlock */
		$searchProductListBlock = Mage::app()->getLayout()->getBlock('search_result_list');
		if (!$searchProductListBlock) return [];

		return $searchProductListBlock->getLoadedProductCollection()->getSize();
	}

	private function isEnabled()
	{
		return Mage::helper('inkl_googletagmanager/config_dataLayer_catalog')->isSearchNumResultsEnabled();
	}

}
