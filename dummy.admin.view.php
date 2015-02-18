<?php

	/**
	* @class 	dummyAdminView
	* @author 	changeme (changeme@example.com)
	* @brief 	dummy module admin view
	**/

	class dummyAdminView extends dummy {
		public function init()
		{
            Context::set('config', $config);
            $this->setTemplatePath($this->module_path.'tpl');
		}

		public function dispDummyAdminConfig()
		{
			$oModuleModel = getModel('module');
            $config = $oModuleModel->getModuleConfig('dummy');

            $oLayoutModel = &getModel('layout');
            $layout_list = $oLayoutModel->getLayoutList();

            $skin_list = $oModuleModel->getSkins($this->module_path);
            Context::set('skin_list',$skin_list);

            Context::set('layout_list', $layout_list);
            Context::set('config', $config);

            $this->setTemplateFile('config');
		}
	}

?>