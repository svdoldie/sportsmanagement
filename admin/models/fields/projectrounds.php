<?php


defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('list');


class JFormFieldprojectrounds extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var        string
	 * @since   1.6
	 */
	protected $type = 'projectrounds';

	/**
	 * Method to get the field options.
	 *
	 * @return  array  The field option objects.
	 * @since   1.6
	 */
	protected function getOptions()
	{
		$mainframe = JFactory::getApplication();
        $options = array();

		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
			->select('a.id AS value, a.name AS text')
			->from('#__sportsmanagement_round AS a')
			;

$mainframe->enqueueMessage(JText::_(__METHOD__.' '.__LINE__.' ' .  ' <br><pre>'.print_r($this->form->getValue('project'),true).'</pre>'),'');

		if ($menuType = $this->form->getValue('project'))
		{
			$query->where('a.project_id = ' . $db->quote($menuType));
		}




		// Get the options.
		$db->setQuery($query);
        $options = $db->loadObjectList();
/*
		try
		{
			$options = $db->loadObjectList();
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}

		// Pad the option text with spaces using depth level as a multiplier.
		for ($i = 0, $n = count($options); $i < $n; $i++)
		{
			$options[$i]->text = str_repeat('- ', $options[$i]->value) . $options[$i]->text;
		}
*/
		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}