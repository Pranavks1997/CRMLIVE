<?php /* Smarty version 2.6.31, created on 2021-04-03 05:21:29
         compiled from include/SugarFields/Fields/Parent/SearchView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugarvar', 'include/SugarFields/Fields/Parent/SearchView.tpl', 43, false),)), $this); ?>
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
<select name='<?php echo $this->_tpl_vars['vardef']['type_name']; ?>
' <?php if (! empty ( $this->_tpl_vars['tabindex'] )): ?> tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
" <?php endif; ?>  id='<?php echo $this->_tpl_vars['vardef']['type_name']; ?>
' title='<?php echo $this->_tpl_vars['vardef']['help']; ?>
'
onchange='document.<?php echo $this->_tpl_vars['form_name']; ?>
.<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
.value="";document.<?php echo $this->_tpl_vars['form_name']; ?>
.parent_id.value=""; 
        changeParentQSSearchView("<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
"); checkParentType(document.<?php echo $this->_tpl_vars['form_name']; ?>
.<?php echo $this->_tpl_vars['vardef']['type_name']; ?>
.value, document.<?php echo $this->_tpl_vars['form_name']; ?>
.btn_<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
);'>
{html_options options=<?php echo smarty_function_sugarvar(array('key' => 'options','string' => true), $this);?>
 selected=$fields.<?php echo $this->_tpl_vars['vardef']['type_name']; ?>
.value}
</select>
<br>
{if empty(<?php echo smarty_function_sugarvar(array('key' => 'options','string' => true), $this);?>
[$fields.<?php echo $this->_tpl_vars['vardef']['type_name']; ?>
.value])}
	{assign var="keepParent" value = 0}
{else}
	{assign var="keepParent value = 1}
{/if}
<input type="text" name="<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
" id="<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
" class="sqsEnabled" <?php if (! empty ( $this->_tpl_vars['tabindex'] )): ?> tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
" <?php endif; ?>  size="<?php echo $this->_tpl_vars['displayParams']['size']; ?>
" value="<?php echo smarty_function_sugarvar(array('key' => 'value'), $this);?>
" autocomplete="off"><input type="hidden" name="<?php echo $this->_tpl_vars['vardef']['id_name']; ?>
" id="<?php echo $this->_tpl_vars['vardef']['id_name']; ?>
"  {if $keepParent}value="<?php echo smarty_function_sugarvar(array('memberName' => 'vardef.id_name','key' => 'value'), $this);?>
"{/if}>
<span class="id-ff multiple">
<button type="button" name="btn_<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
" <?php if (! empty ( $this->_tpl_vars['tabindex'] )): ?> tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
" <?php endif; ?>  title="{$APP.LBL_SELECT_BUTTON_TITLE}"
	   class="button<?php if (empty ( $this->_tpl_vars['displayParams']['selectOnly'] )): ?> firstChild<?php endif; ?>" value="{$APP.LBL_SELECT_BUTTON_LABEL}"
	   onclick='if(document.<?php echo $this->_tpl_vars['form_name']; ?>
.<?php echo $this->_tpl_vars['vardef']['type_name']; ?>
.value != "") open_popup(document.<?php echo $this->_tpl_vars['form_name']; ?>
.<?php echo $this->_tpl_vars['vardef']['type_name']; ?>
.value, 600, 400, "", true, false, <?php echo $this->_tpl_vars['displayParams']['popupData']; ?>
, "single", true);'><span class="suitepicon suitepicon-action-select"></span></button>
<?php if (empty ( $this->_tpl_vars['displayParams']['selectOnly'] )): ?>
<button type="button" name="btn_clr_<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
" <?php if (! empty ( $this->_tpl_vars['tabindex'] )): ?> tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
" <?php endif; ?>  title="{$APP.LBL_CLEAR_BUTTON_TITLE}"  class="button lastChild" onclick="this.form.<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
.value = ''; this.form.<?php echo smarty_function_sugarvar(array('key' => 'id_name'), $this);?>
.value = '';" value="{$APP.LBL_CLEAR_BUTTON_LABEL}">
<span class="suitepicon suitepicon-action-clear"></span>
</button>
<?php endif; ?>
</span>
{literal}
<script type="text/javascript">
if (typeof(changeParentQSSearchView) == 'undefined'){
function changeParentQSSearchView(field) {
	field = YAHOO.util.Dom.get(field);
    var form = field.form;
    var sqsId = form.id + "_" + field.id;
    var typeField =  form.elements["<?php echo $this->_tpl_vars['vardef']['type_name']; ?>
"];
    var new_module = typeField.value;
    if(typeof(disabledModules[new_module]) != 'undefined') {
		sqs_objects[sqsId]["disable"] = true;
		field.readOnly = true;
	} else {
		sqs_objects[sqsId]["disable"] = false;
		field.readOnly = false;
    }
	//Update the SQS globals to reflect the new module choice
    sqs_objects[sqsId]["modules"] = new Array(new_module);
    if (typeof(QSFieldsArray[sqsId]) != 'undefined')
    {
        QSFieldsArray[sqsId].sqs.modules = new Array(new_module);
    }
	if(typeof QSProcessedFieldsArray != 'undefined')
    {
	   QSProcessedFieldsArray[sqsId] = false;
    }
    enableQS(false);
}}
YAHOO.util.Event.onContentReady(
{/literal}
"<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
"
{literal}
, function() {
    changeParentQSSearchView(
{/literal}
"<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
"
{literal}
    );
});
</script>
<?php echo $this->_tpl_vars['displayParams']['disabled_parent_types']; ?>

{/literal}