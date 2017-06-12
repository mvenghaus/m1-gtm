<?php

class Inkl_GoogleTagManager_Helper_Product extends Mage_Core_Helper_Abstract
{

	public function getSkuById($productId)
	{
		$collection = Mage::getResourceModel('catalog/product_collection')
			->addAttributeToSelect('sku')
			->addAttributeToFilter('entity_id', ['eq' => $productId]);

		foreach ($collection as $product)
		{
			return $product->getSku();
		}

		return null;
	}

}
