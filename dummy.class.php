<?php

	/**
	* @class 	dummy
	* @author 	changeme (changeme@example.com)
	* @brief 	dummy module
	**/

	class dummy extends ModuleObject {
		// table, column, type, size, default, notnull
		private $columns = array(
			// array( 'table_name', 'column', 'type', 1, 'defualt', TRUE),
		);
		// table, index, column, unique
		private $indexes = array(
			// array( 'table_name', 'idx_index_name', array('column1'), FALSE ),
		);

		private $triggers = array(
			// array( 'moduleObject.proc', 'dummy', 'controller', '_triggerModuleProc', 'after')
		);

		function moduleInstall()
		{
			$oModuleController = getController('module');
			foreach ($this->triggers as $trigger)
			{
				$oModuleController->insertTrigger($trigger[0], $trigger[1], $trigger[2], $trigger[3], $trigger[4]);
			}

			return new Object();
		}

		function moduleUninstall()
		{
			$oModuleController = getController('module');
			foreach ($this->triggers as $trigger)
			{
				$oModuleController->deleteTrigger($trigger[0], $trigger[1], $trigger[2], $trigger[3], $trigger[4]);
			}

			return new Object();
		}

		function checkUpdate()
		{
			$oDB = DB::getInstance();
			$oModuleModel = getModel('module');
			foreach ($this->columns as $column)
			{
				if (!$oDB->isColumnExists($column[0], $column[1]))
				{
					return TRUE;
				}
			}
			foreach ($this->indexes as $index)
			{
				if (!$oDB->isIndexExists($index[0], $index[1]))
				{
					return TRUE;
				}
			}
			foreach ($this->triggers as $trigger)
			{
				if (!$oModuleModel->getTrigger($trigger[0], $trigger[1], $trigger[2], $trigger[3], $trigger[4]))
				{
					return TRUE;
				}
			}

			return FALSE;
		}

		function moduleUpdate()
		{
			$oDB = DB::getInstance();
			$oModuleModel = getModel('module');
			$oModuleController = getController('module');
			foreach ($this->columns as $column)
			{
				if (!$oDB->isColumnExists($column[0], $column[1]))
				{
					$oDB->addColumn($column[0], $column[1], $column[2], $column[3], $column[4], $column[5]);
				}
			}
			foreach ($this->indexes as $index)
			{
				if (!$oDB->isIndexExists($index[0], $index[1]))
				{
					$oDB->addIndex($index[0], $index[1], $index[2], $index[3]);
				}
			}
			foreach ($this->triggers as $trigger)
			{
				if (!$oModuleModel->getTrigger($trigger[0], $trigger[1], $trigger[2], $trigger[3], $trigger[4]))
				{
					$oModuleController->insertTrigger($trigger[0], $trigger[1], $trigger[2], $trigger[3], $trigger[4]);
				}
			}

			return new Object();
		}
	}
?>