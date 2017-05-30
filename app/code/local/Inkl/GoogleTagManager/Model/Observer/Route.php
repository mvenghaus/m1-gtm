<?php

class Inkl_GoogleTagManager_Model_Observer_Route
{

	public function controller_action_predispatch(Varien_Event_Observer $observer)
	{
		$routeInfo = $this->getRouteInfo();

		Mage::getSingleton('inkl_googletagmanager/dataLayer_pageCategory')->handleRouteInfo($routeInfo);
	}

	private function getRouteInfo()
	{
		$request = Mage::app()->getRequest();

		return sprintf('%s/%s/%s', $request->getModuleName(), $request->getControllerName(), $request->getActionName());
	}

}
