<?php 
/** SportsManagement ein Programm zur Verwaltung f�r alle Sportarten
* @version         1.0.05
* @file                agegroup.php
* @author                diddipoeler, stony, svdoldie und donclumsy (diddipoeler@arcor.de)
* @copyright        Copyright: � 2013 Fussball in Europa http://fussballineuropa.de/ All rights reserved.
* @license                This file is part of SportsManagement.
*
* SportsManagement is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* SportsManagement is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with SportsManagement.  If not, see <http://www.gnu.org/licenses/>.
*
* Diese Datei ist Teil von SportsManagement.
*
* SportsManagement ist Freie Software: Sie k�nnen es unter den Bedingungen
* der GNU General Public License, wie von der Free Software Foundation,
* Version 3 der Lizenz oder (nach Ihrer Wahl) jeder sp�teren
* ver�ffentlichten Version, weiterverbreiten und/oder modifizieren.
*
* SportsManagement wird in der Hoffnung, dass es n�tzlich sein wird, aber
* OHNE JEDE GEW�HELEISTUNG, bereitgestellt; sogar ohne die implizite
* Gew�hrleistung der MARKTF�HIGKEIT oder EIGNUNG F�R EINEN BESTIMMTEN ZWECK.
* Siehe die GNU General Public License f�r weitere Details.
*
* Sie sollten eine Kopie der GNU General Public License zusammen mit diesem
* Programm erhalten haben. Wenn nicht, siehe <http://www.gnu.org/licenses/>.
*
* Note : All ini files need to be saved as UTF-8 without BOM
*/

defined('_JEXEC') or die('Restricted access');

// Make sure that in case extensions are written for mentioned (common) views,
// that they are loaded i.s.o. of the template of this view
$templatesToLoad = array('globalviews', 'results', 'ranking');
sportsmanagementHelper::addTemplatePaths($templatesToLoad, $this);

$this->kmlpath = JURI::root().'tmp'.DS.$this->project->id.'-ranking.kml';
$this->kmlfile = $this->project->id.'-ranking.kml';

?>
<div class="">
	<a name="jl_top" id="jl_top"></a>
	<?php 
    if ( COM_SPORTSMANAGEMENT_SHOW_DEBUG_INFO )
{
    echo $this->loadTemplate('debug');
}

	echo $this->loadTemplate('projectheading');

	if ($this->config['show_matchday_dropdown'])
	{
		echo $this->loadTemplate('selectround');
	}
    
?>    
    
<div role="tabpanel">

  <!-- Tabs-Navs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#ranking" role="tab" data-toggle="tab"><?PHP echo JText::_('COM_SPORTSMANAGEMENT_RANKING_PAGE_TITLE'); ?></a></li>
    <li role="presentation"><a href="#results" role="tab" data-toggle="tab"><?PHP echo JText::_('COM_SPORTSMANAGEMENT_RESULTS_ROUND_RESULTS'); ?></a></li>

  </ul>

  <!-- Tab-Inhalte -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="ranking">
    <?PHP   
    echo $this->loadTemplate('ranking');
    ?>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="results">
    <?PHP   
    echo $this->loadTemplate('results');
    ?>
    </div>
  </div>

</div>
    
<?PHP    
    
    
    if ($this->config['show_colorlegend'])
		{
			echo $this->loadTemplate('colorlegend');
		}
		
		if ($this->config['show_explanation']==1)
		{
			echo $this->loadTemplate('explanation');
		}
        if (($this->config['show_ranking_maps'])==1)
	{ 
		echo $this->loadTemplate('googlemap');
	}   
    	
	if ($this->config['show_pagnav']==1)
	{
		echo $this->loadTemplate('pagnav');
	}

	echo "<div>";
		echo $this->loadTemplate('backbutton');
		echo $this->loadTemplate('footer');
	echo "</div>";
	?>
</div>
