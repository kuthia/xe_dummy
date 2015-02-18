<?php

	/**
	* @class 	dummyAdminController
	* @author 	changeme (changeme@example.com)
	* @brief 	dummy module admin controller
	**/

	class dummyAdminController extends dummy {
		public function procDummyAdminInsertConfig()
		{
		    $oModuleModel = getModel('module');
            $config = $oModuleModel->getModuleConfig('dummy');

            $config = Context::gets('layout_srl', 'skin');

            $oModuleController = &getController('module');
            $oModuleController->insertModuleConfig('dummy', $config);

			$returnUrl = Context::get('success_return_url') ? Context::get('success_return_url') : getNotEncodedUrl('', 'module', 'admin', 'act', 'dispDummyAdminConfig');
            $this->setRedirectUrl($returnUrl);
		}
	}

?>