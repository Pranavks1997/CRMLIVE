<?php /* Smarty version 2.6.31, created on 2021-03-09 15:28:47
         compiled from include/SugarFields/Fields/Time/EditView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugarvar', 'include/SugarFields/Fields/Time/EditView.tpl', 42, false),array('modifier', 'cat', 'include/SugarFields/Fields/Time/EditView.tpl', 47, false),)), $this); ?>
{*
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2018 SalesAgility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for technical reasons, the Appropriate Legal Notices must
 * display the words "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */

*}
<?php ob_start(); ?><?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
<?php $this->_smarty_vars['capture']['idname'] = ob_get_contents();  $this->assign('idname', ob_get_contents());ob_end_clean(); ?>
<?php if (! empty ( $this->_tpl_vars['displayParams']['idName'] )): ?>
<?php $this->assign('idname', $this->_tpl_vars['displayParams']['idName']); ?>
<?php endif; ?>

<?php $this->assign('flag_field', ((is_array($_tmp=$this->_tpl_vars['vardef']['name'])) ? $this->_run_mod_handler('cat', true, $_tmp, '_flag') : smarty_modifier_cat($_tmp, '_flag'))); ?>

<table border="0" cellpadding="0" cellspacing="0">
	<tr valign="middle">
		<td nowrap>
			<div id="<?php echo $this->_tpl_vars['idname']; ?>
_time"></div>
			<?php if ($this->_tpl_vars['displayParams']['showFormats']): ?>
			<span class="timeFormat">{$TIME_FORMAT}</span>
			<?php endif; ?>
		</td>
	</tr>
</table>
<input type="hidden" id="<?php echo $this->_tpl_vars['idname']; ?>
" name="<?php echo $this->_tpl_vars['idname']; ?>
" value="{$fields[<?php echo smarty_function_sugarvar(array('key' => 'name','stringFormat' => true), $this);?>
].value}">
<script type="text/javascript" src="include/SugarFields/Fields/Time/Time.js"></script>
<script type="text/javascript">
	var combo_<?php echo $this->_tpl_vars['idname']; ?>
 = new Time("{$fields[<?php echo smarty_function_sugarvar(array('key' => 'name','stringFormat' => true), $this);?>
].value}", "<?php echo $this->_tpl_vars['idname']; ?>
", "{$TIME_FORMAT}", "<?php echo $this->_tpl_vars['tabindex']; ?>
");
	//Render the remaining widget fields
	text = combo_<?php echo $this->_tpl_vars['idname']; ?>
.html('<?php echo $this->_tpl_vars['displayParams']['updateCallback']; ?>
');
	document.getElementById('<?php echo $this->_tpl_vars['idname']; ?>
_time').innerHTML = text;
</script>

<script type="text/javascript">
	function update_<?php echo $this->_tpl_vars['idname']; ?>
_available() {ldelim}
		YAHOO.util.Event.onAvailable("<?php echo $this->_tpl_vars['idname']; ?>
_time_hours", this.handleOnAvailable, this);
		{rdelim}

	update_<?php echo $this->_tpl_vars['idname']; ?>
_available.prototype.handleOnAvailable = function(me) {ldelim}
		//Call update for first time to round hours and minute values
		combo_<?php echo $this->_tpl_vars['idname']; ?>
.update();
		{rdelim}

	var obj_<?php echo $this->_tpl_vars['idname']; ?>
 = new update_<?php echo $this->_tpl_vars['idname']; ?>
_available();
</script>