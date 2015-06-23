<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
/**
 * SportsManagementList Model
 */
class sportsmanagementModelsportsmanagements extends JModelList
{
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	protected function getListQuery()
	{
		// Create a new query object.		
		$db = sportsmanagementHelper::getDBConnection();
		$query = $db->getQuery(true);
		// Select some fields
		$query->select('id,greeting');
		// From the hello table
		$query->from('#__sportsmanagement');
		return $query;
	}
}
