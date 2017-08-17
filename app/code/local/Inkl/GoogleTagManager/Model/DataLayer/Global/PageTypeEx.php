<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Global_PageTypeEx extends Inkl_GoogleTagManager_Model_DataLayer_Global_PageType
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!$this->isEnabled())
		{
			return;
		}

		$pageTypeEx = $this->determine();
		if ($pageTypeEx)
		{
			$googleTagManager->addDataLayerVariable('pageTypeEx', $pageTypeEx, 'page_type_ex');
		}
	}

	protected function determine()
	{
		$routeHelper = Mage::helper('inkl_googletagmanager/route');

		if ($routeHelper->isCheckout()) return 'checkout';

		return parent::determine();
	}

}
