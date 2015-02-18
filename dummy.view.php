<?php

	/**
	* @class 	dummyView
	* @author 	changeme (changeme@example.com)
	* @brief 	dummy module view
	**/

	class dummyView extends dummy {

		public function init()
		{
			// skin path
			$template_path = sprintf("%sskins/%s/",$this->module_path, $this->module_info->skin);
            if(!is_dir($template_path)||!$this->module_info->skin) {
                $this->module_info->skin = 'default';
                $template_path = sprintf("%sskins/%s/",$this->module_path, $this->module_info->skin);
            }

            $this->setTemplatePath($template_path);

            // module layout
            $oModuleModel = getModel('module');
            $config = $oModuleModel->getModuleConfig('dummy');
            Context::set('layout', $config->layout_srl);
            $oLayoutModel = &getModel('layout');
            $layout_info = $oLayoutModel->getLayout($config->layout_srl);
            if($layout_info)
            {
                $this->module_info->layout_srl = $config->layout_srl;
                $this->setLayoutPath($layout_info->path);
            }
		}

        public function dispDummyIndex()
        {
            $args->page = Context::get('page');            
            $args->list_order = Context::get('list_order');
            $args->order_type = Context::get('order_type') ? Context::get('order_type') : 'asc';

            $output = executeQueryArray('dummy.getDummy', $args);

            Context::set('page', $output->page);
            Context::set('page_navigation', $output->page_navigation);

            $this->setTemplateFile('index');
        }
	}

?>