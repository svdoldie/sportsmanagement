<?php 
/** SportsManagement ein Programm zur Verwaltung für alle Sportarten
* @version         1.0.05
* @file                agegroup.php
* @author                diddipoeler, stony, svdoldie und donclumsy (diddipoeler@arcor.de)
* @copyright        Copyright: © 2013 Fussball in Europa http://fussballineuropa.de/ All rights reserved.
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
* SportsManagement ist Freie Software: Sie können es unter den Bedingungen
* der GNU General Public License, wie von der Free Software Foundation,
* Version 3 der Lizenz oder (nach Ihrer Wahl) jeder späteren
* veröffentlichten Version, weiterverbreiten und/oder modifizieren.
*
* SportsManagement wird in der Hoffnung, dass es nützlich sein wird, aber
* OHNE JEDE GEWÄHELEISTUNG, bereitgestellt; sogar ohne die implizite
* Gewährleistung der MARKTFÄHIGKEIT oder EIGNUNG FÜR EINEN BESTIMMTEN ZWECK.
* Siehe die GNU General Public License für weitere Details.
*
* Sie sollten eine Kopie der GNU General Public License zusammen mit diesem
* Programm erhalten haben. Wenn nicht, siehe <http://www.gnu.org/licenses/>.
*
* Note : All ini files need to be saved as UTF-8 without BOM
*/

defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.modal');
$templatesToLoad = array('footer');
sportsmanagementHelper::addTemplatePaths($templatesToLoad, $this);
?>
<script language="javascript">
window.addEvent('domready',function(){
	$$('table.adminlist tr').each(function(el){
		var cb;
		if (cb=el.getElement("input[name^=cid]")) {
			el.getElement("input[name^=roundcode]").addEvent('change',function(){
				if (isNaN(this.value)) {
					alert(Joomla.JText._('COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_CSJS_MSG_NOTANUMBER'));
					return false;
				}
			});
		}
	});
});
</script>
<div id='alt_massadd_enter' style='display:<?php echo ($this->massadd == 0) ? 'none' : 'block'; ?>'>
	<fieldset class='adminform'>
		<legend><?php echo JText::sprintf('COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_MASSADD_LEGEND','<i>'.$this->project->name.'</i>'); ?></legend>
		<form id='copyform' method='post' style='display:inline' id='copyform'>
			<input type='hidden' name='project_id' value='<?php echo $this->project->id; ?>' />
			<input type='hidden' name='task' value='round.copyfrom' />
			<?php echo JHtml::_('form.token')."\n"; ?>
			<table class='admintable'><tbody><tr>
				<td class='key' nowrap='nowrap'><?php echo JText::_('COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_MASSADD_COUNT'); ?></td>
				<td><input type='text' name='add_round_count' id='add_round_count' value='0' size='3' class='inputbox' /></td>
				<td><input type='submit' class='button' value='<?php echo JText::_('COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_MASSADD_SUBMIT_BUTTON'); ?>' onclick='this.form.submit();' /></td>
			</tr></tbody></table>
		</form>
	</fieldset>
</div>

<form action="<?php echo $this->request_url; ?>" method="post" id="adminForm" name="adminForm">
	<div id="editcell">
		<fieldset class="adminform">
			<legend><?php echo JText::sprintf('COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_LEGEND','<i>'.$this->project->name.'</i>'); ?></legend>
			<table class="adminlist">
				<thead>
					<tr>
						<th width="1%"><?php echo JText::_('COM_SPORTSMANAGEMENT_GLOBAL_NUM'); ?></th>
						<th width="1%"><input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" /></th>
						<th width="20">&nbsp;</th>
 						<th width="20"><?php echo JHtml::_( 'grid.sort', 'COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_ROUND_NR', 'r.roundcode', $this->sortDirection, $this->sortColumn ); ?></th>
                        <th width="20"><?php echo JHtml::_( 'grid.sort', 'COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_ROUND_TITLE', 'r.name', $this->sortDirection, $this->sortColumn ); ?></th>
                        
                        <th width="20"><?php echo JHtml::_( 'grid.sort', 'COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_STARTDATE', 'r.round_date_first', $this->sortDirection, $this->sortColumn ); ?></th>
                        
						<th width="1%">&nbsp;</th>
                        <th width="20"><?php echo JHtml::_( 'grid.sort', 'COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_ENDDATE', 'r.round_date_last', $this->sortDirection, $this->sortColumn ); ?></th>
                        
						<th width="10%"><?php echo JText::_('COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_EDIT_MATCHES'); ?></th>
						<th width="20"><?php echo JText::_('COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_PUBLISHED_CHECK'); ?></th>
						<th width="20"><?php echo JText::_('COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_RESULT_CHECK'); ?></th>
                        <th width="20"><?php echo JText::_('COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_TOURNEMENT'); ?></th>
						<th width="5%" class="title">
						<?php
						echo JHtml::_('grid.sort','JSTATUS','r.published',$this->sortDirection,$this->sortColumn);
						?>
					</th>
            <th width="5%"><?php echo JHtml::_( 'grid.sort', 'JGRID_HEADING_ID', 'r.id', $this->sortDirection, $this->sortColumn ); ?></th>
					</tr>
				</thead>
				<tfoot><tr><td colspan="11"><?php echo $this->pagination->getListFooter(); ?></td>
                <td colspan='3'>
            <?php echo $this->pagination->getResultsCounter();?>
            </td>
                </tr></tfoot>
				<tbody>
					<?php
					$k=0;
					for ($i=0,$n=count($this->matchday); $i < $n; $i++)
					{
						$row =& $this->matchday[$i];
						$link1=JRoute::_('index.php?option=com_sportsmanagement&task=round.edit&id='.$row->id.'&pid='.$this->project->id);
						$link2=JRoute::_('index.php?option=com_sportsmanagement&view=matches&rid='.$row->id.'&pid='.$this->project->id);
						$checked=JHtml::_('grid.checkedout',$row,$i);
                        $published  = JHtml::_('grid.published',$row,$i,'tick.png','publish_x.png','rounds.');
						?>
						<tr class="<?php echo "row$k"; ?>">
							<td class="center"><?php echo $this->pagination->getRowOffset($i); ?></td>
							<td class="center"><?php echo $checked; ?></td>
							<td class="center"><?php
								$imageTitle=JText::_('COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_EDIT_DETAILS');
								$imageFile='administrator/components/com_sportsmanagement/assets/images/edit.png';
								$imageParams="title='$imageTitle'";
								echo JHtml::link($link1,JHtml::image($imageFile,$imageTitle,$imageParams));
							?></td>
							<td class="center">
								<input tabindex="1" type="text" style="text-align: center" size="5" class="inputbox" name="roundcode<?php echo $row->id; ?>" value="<?php echo $row->roundcode; ?>" onchange="document.getElementById('cb<?php echo $i; ?>').checked=true" />
							</td>
							<td class="center">
								<input tabindex="2" type="text" size="30" maxlength="64" class="inputbox" name="name<?php echo $row->id; ?>" value="<?php echo $row->name; ?>" onchange="document.getElementById('cb<?php echo $i; ?>').checked=true" />
							</td>
							<td class="center">
								<?php
								$date1= sportsmanagementHelper::convertDate($row->round_date_first, 1);
								$append='';
								if (($date1 == '00-00-0000') || ($date1 == ''))
								{
									$append=' style="background-color:#FFCCCC;" ';
								}
								echo JHtml::calendar(	$date1,
														'round_date_first'.$row->id,
														'round_date_first'.$row->id,
														'%d-%m-%Y',
														'size="10" '.$append .
														'tabindex="3" '.
														'class="center" '.
														'onchange="document.getElementById(\'cb'.$i.'\').checked=true"');
								?>
							</td>
							<td class="center">&nbsp;-&nbsp;</td>
							<td class="center"><?php
								$date2= sportsmanagementHelper::convertDate($row->round_date_last, 1);
								$append='';
								if (($date2 == '00-00-0000') || ($date2 == ''))
								{
									$append=' style="background-color:#FFCCCC;"';
								}
								echo JHtml::calendar(	$date2,
														'round_date_last'.$row->id,
														'round_date_last'.$row->id,
														'%d-%m-%Y',
														'size="10" '.$append .
														'tabindex="3" '.
														'class="center" '.
														'onchange="document.getElementById(\'cb'.$i.'\').checked=true"');
								?></td>
							<td class="center" class="nowrap"><?php
								$link2Title=JText::_('COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_EDIT_MATCHES_LINK');
								$link2Params="title='$link2Title'";
								echo JHtml::link($link2,$link2Title,$link2Params);
					  			?></td>
							<td class="center" class="nowrap"><?php
								if (($row->countUnPublished == 0) && ($row->countMatches > 0))
								{
									$imageTitle=JText::sprintf('COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_ALL_PUBLISHED',$row->countMatches);
									$imageFile='administrator/components/com_sportsmanagement/assets/images/ok.png';
									$imageParams="title='$imageTitle'";
									echo JHtml::image($imageFile,$imageTitle,$imageParams);
								}
								else
								{
									if ($row->countMatches == 0)
									{
										$imageTitle=JText::_('COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_ANY_MATCHES');
									}
									else
									{
										$imageTitle=JText::sprintf('COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_PUBLISHED_NR',$row->countUnPublished);
									}
									$imageFile='administrator/components/com_sportsmanagement/assets/images/error.png';
									$imageParams="title='$imageTitle'";
									echo JHtml::image($imageFile,$imageTitle,$imageParams);
								}
								?></td>
					  		<td class="center" class="nowrap"><?php
								if (($row->countNoResults == 0) && ($row->countMatches > 0))
								{
									$imageTitle=JText::sprintf('COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_ALL_RESULTS',$row->countMatches);
									$imageFile='administrator/components/com_sportsmanagement/assets/images/ok.png';
									$imageParams="title='$imageTitle'";
									echo JHtml::image($imageFile,$imageTitle,$imageParams);
								}
								else
								{
									if ($row->countMatches == 0)
									{
										$imageTitle=JText::_('COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_ANY_MATCHES');
									}
									else
									{
										$imageTitle=JText::sprintf('COM_SPORTSMANAGEMENT_ADMIN_ROUNDS_RESULTS_MISSING',$row->countNoResults);
									}
									$imageFile='administrator/components/com_sportsmanagement/assets/images/error.png';
									$imageParams="title='$imageTitle'";
									echo JHtml::image($imageFile,$imageTitle,$imageParams);
								}
								?></td>
                                
                                
                                <td class="center">
									<?php
                                    $append=' style="background-color:#bbffff"';
									echo JHtml::_(	'select.genericlist',
													$this->lists['tournementround'],
													'tournementround'.$row->id,
													$inputappend.'class="inputbox" size="1" onchange="document.getElementById(\'cb' .
													$i.'\').checked=true"'.$append,
													'value','text',$row->tournement);
									?>
								</td>
                                
                <td class="center"><?php echo $published; ?></td>
							<td class="center"><?php echo $row->id; ?></td>
						</tr>
						<?php
						$k=1 - $k;
					}
					?>
				</tbody>
			</table>
		</fieldset>
	</div>
	<input type="hidden" name="pid" value="<?php echo $this->project->id; ?>" />
	<input type="hidden" name="next_roundcode" value="<?php echo count($this->matchday) + 1; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->sortColumn; ?>" />
	<input type="hidden" name="filter_order_Dir" value="" />
	<?php echo JHtml::_('form.token')."\n"; ?>
</form>
<?PHP
echo "<div>";
echo $this->loadTemplate('footer');
echo "</div>";
?>   