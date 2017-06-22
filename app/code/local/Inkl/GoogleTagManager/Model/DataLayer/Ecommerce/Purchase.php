<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Ecommerce_Purchase
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!Mage::helper('inkl_googletagmanager/route')->isPurchase())
		{
			return;
		}

		$order = $this->getOrder();
		$ecommerce = [
			'purchase' => [
				'actionField' => $this->getActionField($order),
				'products' => $this->getProducts($order)
			]
		];

		$googleTagManager->addDataLayerVariable('ecommerce', $ecommerce, 'ecommerce_purchase');
	}

	private function getActionField(Mage_Sales_Model_Order $order)
	{
		return [
			'id' => $order->getIncrementId(),
			'affiliation' => 'Online Shop',
			'revenue' => round($order->getSubtotal(), 2),
			'tax' => round($order->getTaxAmount(), 2),
			'shipping' => round($order->getShippingAmount(), 2),
			'coupon' => (string)$order->getCouponCode()
		];
	}

	private function getProducts(Mage_Sales_Model_Order $order)
	{
		$products = [];
		/** @var Mage_Sales_Model_Order_Item $orderItem */
		foreach ($order->getAllVisibleItems() as $orderItem)
		{
			$products[] = [
				'id' => Mage::helper('inkl_googletagmanager/product')->getSkuById($orderItem->getProductId()),
				'name' => $orderItem->getName(),
				'price' => round($orderItem->getPrice(), 2),
				'quantity' => (int)$orderItem->getQtyOrdered()
			];
		}

		return $products;
	}

	private function getOrder()
	{
		return Mage::getSingleton('checkout/session')->getLastRealOrder();
	}

}
