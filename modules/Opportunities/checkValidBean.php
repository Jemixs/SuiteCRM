<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

/**
 * 
 */
class checkValidBean
{
	
	public function validBean($bean, $event, $arguments)
	{
		// Forbid change name and type field if bean exist
		if (!empty($bean->created_by_name)) {
			unset($bean->name);
			unset($bean->opportunity_type);
		} else {
			// If bean name used, generate new name
			if ($bean->opportunity_type == 'Existing Business' OR $bean->opportunity_type == 'New Business') {
				if ($bean->opportunity_type == 'Existing Business' AND !strripos($bean->opportunity_type, 'C')) {
					$bean->name = 'C0000';
				}else if ($bean->opportunity_type == 'New Business' AND !strripos($bean->opportunity_type, 'H')) {
					$bean->name = 'H0000';
				}

				$checkName = "SELECT * FROM opportunities WHERE name = '$bean->name'";
				$result = $GLOBALS['db']->getOne($checkName);

				if ($result OR $bean->name = 'C0000' OR $bean->name = 'H0000') {
					$nextId = "SELECT SUM(opportunity_type LIKE '$bean->opportunity_type') AS count FROM opportunities";
					$result = $GLOBALS['db']->getOne($nextId);

					(int)$result++;

					$bean->name = $bean->opportunity_type == 'New Business' ? "H000$result" : "C000$result";
				}
			}
		}
	}
}