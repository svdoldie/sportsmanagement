<?php


// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

//jimport('joomla.application.component.controller');
// import Joomla controllerform library
//jimport('joomla.application.component.controllerform');



/**
 * sportsmanagementControllerTreeto
 * 
 * @package 
 * @author Dieter Pl�ger
 * @copyright 2016
 * @version $Id$
 * @access public
 */
class sportsmanagementControllerTreeto extends JSMControllerForm
{
//	protected $view_list = 'treetos';
//	

	/**
	 * sportsmanagementControllerTreeto::__construct()
	 * 
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
//
//		// Register Extra tasks
////		$this->registerTask('add','display');
////		$this->registerTask('edit','display');
////		$this->registerTask('apply','save');
//        
        // Reference global application object
        $this->jsmapp = JFactory::getApplication();
        // JInput object
        $this->jsmjinput = $this->jsmapp->input;
        $this->jsmoption = $this->jsmjinput->getCmd('option');
        $this->jsmdocument = JFactory::getDocument();
	}

	//public function display($cachable = false, $urlparams = false)
//	{
//		$option = JFactory::getApplication()->input->getCmd('option');
//		$app = JFactory::getApplication();
//		$document = JFactory::getDocument();
//		$model = $this->getModel('treetos');
//		$viewType = $document->getType();
//		$view = $this->getView('treetos',$viewType);
//		$view->setModel($model,true);  // true is for the default model;
//
//		$projectws = $this->getModel('project');
//		//$projectws->setId($app->getUserState($option.'project',0));
//		$view->setModel($projectws);
//				
//		switch($this->getTask())
//		{
//			case 'add':
//			{
//				JFactory::getApplication()->input->setVar('hidemainmenu',0);
//				JFactory::getApplication()->input->setVar('layout','edit');
//				JFactory::getApplication()->input->setVar('view','treeto');
//				JFactory::getApplication()->input->setVar('edit',false);
//
//				$model=$this->getModel('treeto');
//				//$model->checkout();
//				break;
//			} 
//
//			case 'edit':
//			{
//				JFactory::getApplication()->input->setVar('hidemainmenu',0);
//				JFactory::getApplication()->input->setVar('layout','edit');
//				JFactory::getApplication()->input->setVar('view','treeto');
//				JFactory::getApplication()->input->setVar('edit',true);
//
//				$model=$this->getModel('treeto');
//				//$model->checkout();
//				break;
//			}
//		}
//		parent::display();
//	}

	// save the checked rows inside the treetos list (save division assignment)
	public function saveshort()
	{
//		$option		= JFactory::getApplication()->input->getCmd('option');
//		$app	= JFactory::getApplication();
 		$project_id = $this->jsmjinput->get('pid');
		
		$post = $this->jsmjinput->post->getArray();
		$cid = $cid = $this->jsmjinput->get('cid',array(),'array');;
		JArrayHelper::toInteger($cid);
		
		$model = $this->getModel('treetos');
		
		if ($model->storeshort($cid, $post))
		{
			$msg = JText::_('COM_SPORTSMANAGEMENT_ADMIN_TREETO_CTRL_SAVED');
		}
		else
		{
			$msg = JText::_('COM_SPORTSMANAGEMENT_ADMIN_TREETO_CTRL_ERROR_SAVED') . $model->getError();
		}

		$link = 'index.php?option=com_sportsmanagement&view=treetos&task=treeto.display';
		$this->setRedirect($link, $msg);
	}

	/**
	 * sportsmanagementControllerTreeto::genNode()
	 * 
	 * @return void
	 */
	public function genNode()
	{
	   /*
		//$option = JFactory::getApplication()->input->getCmd('option');
//		$app = JFactory::getApplication();
//		$document = JFactory::getDocument();
		$proj = $this->jsmapp->getUserState($this->jsmoption.'.pid',0);
		$post = $this->jsmjinput->post->getArray(array());
		$cid = $this->jsmjinput->post->get('cid');
		JArrayHelper::toInteger($cid);

		$model = $this->getModel('treeto');

		$viewType = $this->jsmdocument->getType();
		$view = $this->getView('treeto',$viewType);
		$view->setModel($model,true);	// true is for the default model;

		$projectws = $this->getModel('project');
		//$projectws->setId($app->getUserState($option.'project',0));
		$view->setModel($projectws);

		JFactory::getApplication()->input->setVar('hidemainmenu',0);
		JFactory::getApplication()->input->setVar('layout','gennode');
		JFactory::getApplication()->input->setVar('view','treeto');
		JFactory::getApplication()->input->setVar('edit',true);

		// Checkout the project
		//$model=$this->getModel('treeto');
		$model->checkout();
		parent::display();
        */
	}


	public function generatenode()
	{
		JSession::checkToken() or die(JText::_('COM_SPORTSMANAGEMENT_GLOBAL_INVALID_TOKEN'));
		//$option = JFactory::getApplication()->input->getCmd('option');
//		$app = JFactory::getApplication();
		$post = $this->jsmjinput->post->getArray(array());
		$model = $this->getModel('treeto');
		$project_id = $this->jsmapp->getUserState($this->jsmoption.'.pid');
        //$this->jsmapp->enqueueMessage(JText::_(__METHOD__.' '.__LINE__.' project_id<br><pre>'.print_r($project_id,true).'</pre>'),'Notice');
		if ( $model->setGenerateNode() )
		{
			$msg = JText::_('COM_SPORTSMANAGEMENT_ADMIN_TREETO_CTRL_GENERATE_NODE');
			$link = 'index.php?option=com_sportsmanagement&view=treetonodes&task=treetonode.display&tid='.$this->jsmjinput->post->get('id').'&pid='.$this->jsmjinput->post->get('pid');
		}
		else
		{
			$msg = JText::_('COM_SPORTSMANAGEMENT_ADMIN_TREETO_CTRL_ERROR_GENERATE_NODE').$model->getError();
			$link = 'index.php?option=com_sportsmanagement&view=treetos&task=treeto.display';
		}
		$this->setRedirect( $link, $msg );
	}

//	/**
//	 * sportsmanagementControllerTreeto::save()
//	 * 
//	 * @return void
//	 */
//	public function save()
//	{
//		JSession::checkToken() or die('COM_SPORTSMANAGEMENT_GLOBAL_INVALID_TOKEN');
//		//$app = JFactory::getApplication();
//        $post = $this->jsmjinput->post->getArray(array());
//        $cid = $this->jsmjinput->post->get('cid');
//        
//        $this->jsmapp->enqueueMessage(__METHOD__.' '.__LINE__.' $post <pre>'.print_r($post, true).'</pre><br>',''); 
//        $this->jsmapp->enqueueMessage(__METHOD__.' '.__LINE__.' $cid <pre>'.print_r($cid, true).'</pre><br>',''); 
//        
//        /*
//		$post = JFactory::getApplication()->input->post->getArray(array());
//		$cid = JFactory::getApplication()->input->getVar('cid', array(0), 'post', 'array');
//		$post['id'] = (int) $cid[0];
//		$msg='';
//
//		$model = $this->getModel('treeto');
//		if ($model->store($post))
//		{
//			$msg=JText::_('COM_SPORTSMANAGEMENT_ADMIN_TREETO_CTRL_SAVED');
//		}
//		else
//		{
//			$msg=JText::_('COM_SPORTSMANAGEMENT_ADMIN_TREETO_CTRL_ERROR_SAVED').$model->getError();
//		}
//		// Check the table in so it can be edited.... we are done with it anyway
//		$model->checkin();
//		if ( $this->getTask() == 'save' )
//		{
//			$link = 'index.php?option=com_sportsmanagement&view=treetos&task=treeto.display';
//		}
//		else
//		{
//			$link = 'index.php?option=com_sportsmanagement&task=treeto.edit&cid[]='.$post['id'];
//		}
//		$this->setRedirect($link,$msg);
//        */
//	}

	public function remove()
	{
		$cid = $this->jsmjinput->get('cid',array(),'array');
		JArrayHelper::toInteger($cid);
		if (count($cid) < 1){JError::raiseError(500,JText::_('COM_SPORTSMANAGEMENT_GLOBAL_ISELECT_TO_DELETE'));}
		$model = $this->getModel('treeto');
		if (!$model->delete($cid)){echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";}
		$this->setRedirect('index.php?option=com_sportsmanagement&view=treetos&task=treeto.display');
	}

	public function cancel($key = NULL)
	{
		// Checkin the project
		#$model=$this->getModel('treeto');
		#$model->checkin();
		$this->setRedirect('index.php?option=com_sportsmanagement&task=treeto.display&view=treetos');
	}

	/**
	 * Proxy for getModel
	 *
	 * @param	string	$name	The model name. Optional.
	 * @param	string	$prefix	The class prefix. Optional.
	 *
	 * @return	object	The model.
	 * @since	1.6
	 */
	public function getModel($name = 'Treeto', $prefix = 'sportsmanagementModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}
?>
