<?php

	/**
	* @class 	dummy
	* @author 	changeme (changeme@example.com)
	* @brief 	dummy module
	**/

	class dummy extends ModuleObject {
		public function moduleInstall()
		{
			return new Object();
		}

		public function checkUpdate()
		{
			return false;
		}

		public function moduleUpdate()
		{
			return new Object(0, 'success_updated');
		}

		public function moduleUninstall()
		{
			return new Object();
		}

		public function recompileCache()
		{
			
		}
	}

?>