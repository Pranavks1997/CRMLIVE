

<script language="javascript">
    {literal}
    SUGAR.util.doWhen(function () {
        return $("#contentTable").length == 0;
    }, SUGAR.themes.actionMenu);
    {/literal}
</script>
<table cellpadding="0" cellspacing="0" border="0" width="100%" id="">
<tr>
<td class="buttons" align="left" NOWRAP width="80%">
<div class="actionsContainer">
<form action="index.php" method="post" name="DetailView" id="formDetailView">
<input type="hidden" name="module" value="{$module}">
<input type="hidden" name="record" value="{$fields.id.value}">
<input type="hidden" name="return_action">
<input type="hidden" name="return_module">
<input type="hidden" name="return_id">
<input type="hidden" name="module_tab">
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="offset" value="{$offset}">
<input type="hidden" name="action" value="EditView">
<input type="hidden" name="sugar_body_only">
{if !$config.enable_action_menu}
<div class="buttons">
{if $bean->aclAccess("edit")}<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button primary" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Opportunities'; _form.return_action.value='DetailView'; _form.return_id.value='{$id}'; _form.action.value='EditView';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}">{/if} 
{if $bean->aclAccess("delete")}<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Opportunities'; _form.return_action.value='ListView'; _form.action.value='Delete'; if(confirm('{$APP.NTC_DELETE_CONFIRMATION}')) SUGAR.ajaxUI.submitForm(_form); return false;" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}" id="delete_button">{/if} 
{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Opportunities", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}
</div>                    {/if}
</form>
</div>
</td>
<td align="right" width="20%" class="buttons">{$ADMIN_EDIT}
</td>
</tr>
</table>
{sugar_include include=$includes}
<div class="detail-view">
<div class="mobile-pagination">{$PAGINATION}</div>

<ul class="nav nav-tabs">


<li role="presentation" class="active">
<a id="tab0" data-toggle="tab" class="hidden-xs">
{sugar_translate label='DEFAULT' module='Opportunities'}
</a>


<a id="xstab0" href="#" class="visible-xs first-tab dropdown-toggle" data-toggle="dropdown">
{sugar_translate label='DEFAULT' module='Opportunities'}
</a>
</li>
















{if $config.enable_action_menu and $config.enable_action_menu != false}
<li id="tab-actions" class="dropdown">
<a class="dropdown-toggle" data-toggle="dropdown" href="#">ACTIONS<span class="suitepicon suitepicon-action-caret"></span></a>
<ul class="dropdown-menu">
<li>{if $bean->aclAccess("edit")}<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button primary" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Opportunities'; _form.return_action.value='DetailView'; _form.return_id.value='{$id}'; _form.action.value='EditView';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}">{/if} </li>
<li>{if $bean->aclAccess("delete")}<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Opportunities'; _form.return_action.value='ListView'; _form.action.value='Delete'; if(confirm('{$APP.NTC_DELETE_CONFIRMATION}')) SUGAR.ajaxUI.submitForm(_form); return false;" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}" id="delete_button">{/if} </li>
<li>{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Opportunities", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}</li>
</ul>        </li>
<li class="tab-inline-pagination">
{$PAGINATION}
</li>
{/if}
</ul>
<div class="clearfix"></div>

<div class="tab-content">

<div class="tab-pane-NOBOOTSTRAPTOGGLER active fade in" id='tab-content-0'>





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_RFP/EOIPUBLISHED' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="rfporeoipublished_c" >

{if !$fields.rfporeoipublished_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.rfporeoipublished_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.rfporeoipublished_c.name}" value="{ $fields.rfporeoipublished_c.options }">
{ $fields.rfporeoipublished_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.rfporeoipublished_c.name}" value="{ $fields.rfporeoipublished_c.value }">
{ $fields.rfporeoipublished_c.options[$fields.rfporeoipublished_c.value]}
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_FILENAME' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="file" field="filename" >

{if !$fields.filename.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.filename.name}">
<a href="index.php?entryPoint=download&id={$fields.id.value}&type={$module}" class="tabDetailViewDFLink" target='_blank'>{$fields.filename.value}</a>
&nbsp;
<a href="index.php?preview=yes&entryPoint=download&id={$fields.id.value}&type={$module}" class="tabDetailViewDFLink" target='_blank' style="border-bottom: 0px;">
<i class="glyphicon glyphicon-eye-open"></i>
</a>
</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_TYPE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="opportunity_type" >

{if !$fields.opportunity_type.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.opportunity_type.options)}
<input type="hidden" class="sugar_field" id="{$fields.opportunity_type.name}" value="{ $fields.opportunity_type.options }">
{ $fields.opportunity_type.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.opportunity_type.name}" value="{ $fields.opportunity_type.value }">
{ $fields.opportunity_type.options[$fields.opportunity_type.value]}
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_DUE_DATE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="due_date_c" >

{if !$fields.due_date_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.due_date_c.value) <= 0}
{assign var="value" value=$fields.due_date_c.default_value }
{else}
{assign var="value" value=$fields.due_date_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.due_date_c.name}">{$value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_STATUS' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="status_c" >

{if !$fields.status_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.status_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.status_c.name}" value="{ $fields.status_c.options }">
{ $fields.status_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.status_c.name}" value="{ $fields.status_c.value }">
{ $fields.status_c.options[$fields.status_c.value]}
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_APPLYFOR' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="applyfor_c" >

{if !$fields.applyfor_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.applyfor_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.applyfor_c.name}" value="{ $fields.applyfor_c.options }">
{ $fields.applyfor_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.applyfor_c.name}" value="{ $fields.applyfor_c.value }">
{ $fields.applyfor_c.options[$fields.applyfor_c.value]}
{/if}
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="relate" field="assigned_user_name" >

{if !$fields.assigned_user_name.hidden}
{counter name="panelFieldCount" print=false}

<span id="assigned_user_id" class="sugar_field" data-id-value="{$fields.assigned_user_id.value}">{$fields.assigned_user_name.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>

</div>
                    </div>
</div>

<div class="panel-content">
<div>&nbsp;</div>







{if $config.enable_action_menu and $config.enable_action_menu != false}

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-0" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL3' module='Opportunities'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-0"  data-id="LBL_EDITVIEW_PANEL3">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_OPPORTUNITY_NAME' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="name" field="name" >

{if !$fields.name.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.name.value) <= 0}
{assign var="value" value=$fields.name.default_value }
{else}
{assign var="value" value=$fields.name.value }
{/if} 
<span class="sugar_field" id="{$fields.name.name}">{$fields.name.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='Approver' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="relate" field="select_approver_c" >

{if !$fields.select_approver_c.hidden}
{counter name="panelFieldCount" print=false}

<span id="user_id2_c" class="sugar_field" data-id-value="{$fields.user_id2_c.value}">{$fields.select_approver_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_INTERNATIONAL' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="radioenum" field="international_c" >

{if !$fields.international_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.international_c.name}">
{ $fields.international_c.options[$fields.international_c.value]}
</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_CURRENCY' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="currency_c" >

{if !$fields.currency_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.currency_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.currency_c.name}" value="{ $fields.currency_c.options }">
{ $fields.currency_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.currency_c.name}" value="{ $fields.currency_c.value }">
{ $fields.currency_c.options[$fields.currency_c.value]}
{/if}
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_STATE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="state_c" >

{if !$fields.state_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.state_c.value) <= 0}
{assign var="value" value=$fields.state_c.default_value }
{else}
{assign var="value" value=$fields.state_c.value }
{/if} 
<span class="sugar_field" id="{$fields.state_c.name}">{$fields.state_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_COUNTRY' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="country_c" >

{if !$fields.country_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.country_c.value) <= 0}
{assign var="value" value=$fields.country_c.default_value }
{else}
{assign var="value" value=$fields.country_c.value }
{/if} 
<span class="sugar_field" id="{$fields.country_c.name}">{$fields.country_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SOURCE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="source_c" >

{if !$fields.source_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.source_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.source_c.name}" value="{ $fields.source_c.options }">
{ $fields.source_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.source_c.name}" value="{ $fields.source_c.value }">
{ $fields.source_c.options[$fields.source_c.value]}
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_NEW_DEPARTMENT' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="new_department_c" >

{if !$fields.new_department_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.new_department_c.value) <= 0}
{assign var="value" value=$fields.new_department_c.default_value }
{else}
{assign var="value" value=$fields.new_department_c.value }
{/if} 
<span class="sugar_field" id="{$fields.new_department_c.name}">{$fields.new_department_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_NON_FINANCIAL_RADIO' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="radioenum" field="non_financial_radio_c" >

{if !$fields.non_financial_radio_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.non_financial_radio_c.name}">
{ $fields.non_financial_radio_c.options[$fields.non_financial_radio_c.value]}
</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SOURCE_DETAILS' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="source_details_c" >

{if !$fields.source_details_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.source_details_c.value) <= 0}
{assign var="value" value=$fields.source_details_c.default_value }
{else}
{assign var="value" value=$fields.source_details_c.value }
{/if} 
<span class="sugar_field" id="{$fields.source_details_c.name}">{$fields.source_details_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_NON_FINANCIAL_CONSIDERATION' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="multienum" field="non_financial_consideration_c" >

{if !$fields.non_financial_consideration_c.hidden}
{counter name="panelFieldCount" print=false}

{if !empty($fields.non_financial_consideration_c.value) && ($fields.non_financial_consideration_c.value != '^^')}
<input type="hidden" class="sugar_field" id="{$fields.non_financial_consideration_c.name}" value="{$fields.non_financial_consideration_c.value}">
{multienum_to_array string=$fields.non_financial_consideration_c.value assign="vals"}
{foreach from=$vals item=item}
<li style="margin-left:10px;">{ $fields.non_financial_consideration_c.options.$item }</li>
{/foreach}
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO_NEW' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="assigned_to_new_c" >

{if !$fields.assigned_to_new_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.assigned_to_new_c.value) <= 0}
{assign var="value" value=$fields.assigned_to_new_c.default_value }
{else}
{assign var="value" value=$fields.assigned_to_new_c.value }
{/if} 
<span class="sugar_field" id="{$fields.assigned_to_new_c.name}">{$fields.assigned_to_new_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_DESCRIPTION' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="description" colspan='3'>

{if !$fields.description.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.description.name|escape:'html'|url2html|nl2br}">{$fields.description.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>
                                </div>
</div>
</div>
{else}

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-0" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL3' module='Opportunities'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-0" data-id="LBL_EDITVIEW_PANEL3">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_OPPORTUNITY_NAME' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="name" field="name" >

{if !$fields.name.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.name.value) <= 0}
{assign var="value" value=$fields.name.default_value }
{else}
{assign var="value" value=$fields.name.value }
{/if} 
<span class="sugar_field" id="{$fields.name.name}">{$fields.name.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='Approver' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="relate" field="select_approver_c" >

{if !$fields.select_approver_c.hidden}
{counter name="panelFieldCount" print=false}

<span id="user_id2_c" class="sugar_field" data-id-value="{$fields.user_id2_c.value}">{$fields.select_approver_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_INTERNATIONAL' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="radioenum" field="international_c" >

{if !$fields.international_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.international_c.name}">
{ $fields.international_c.options[$fields.international_c.value]}
</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_CURRENCY' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="currency_c" >

{if !$fields.currency_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.currency_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.currency_c.name}" value="{ $fields.currency_c.options }">
{ $fields.currency_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.currency_c.name}" value="{ $fields.currency_c.value }">
{ $fields.currency_c.options[$fields.currency_c.value]}
{/if}
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_STATE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="state_c" >

{if !$fields.state_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.state_c.value) <= 0}
{assign var="value" value=$fields.state_c.default_value }
{else}
{assign var="value" value=$fields.state_c.value }
{/if} 
<span class="sugar_field" id="{$fields.state_c.name}">{$fields.state_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_COUNTRY' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="country_c" >

{if !$fields.country_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.country_c.value) <= 0}
{assign var="value" value=$fields.country_c.default_value }
{else}
{assign var="value" value=$fields.country_c.value }
{/if} 
<span class="sugar_field" id="{$fields.country_c.name}">{$fields.country_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SOURCE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="source_c" >

{if !$fields.source_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.source_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.source_c.name}" value="{ $fields.source_c.options }">
{ $fields.source_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.source_c.name}" value="{ $fields.source_c.value }">
{ $fields.source_c.options[$fields.source_c.value]}
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_NEW_DEPARTMENT' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="new_department_c" >

{if !$fields.new_department_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.new_department_c.value) <= 0}
{assign var="value" value=$fields.new_department_c.default_value }
{else}
{assign var="value" value=$fields.new_department_c.value }
{/if} 
<span class="sugar_field" id="{$fields.new_department_c.name}">{$fields.new_department_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_NON_FINANCIAL_RADIO' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="radioenum" field="non_financial_radio_c" >

{if !$fields.non_financial_radio_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.non_financial_radio_c.name}">
{ $fields.non_financial_radio_c.options[$fields.non_financial_radio_c.value]}
</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SOURCE_DETAILS' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="source_details_c" >

{if !$fields.source_details_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.source_details_c.value) <= 0}
{assign var="value" value=$fields.source_details_c.default_value }
{else}
{assign var="value" value=$fields.source_details_c.value }
{/if} 
<span class="sugar_field" id="{$fields.source_details_c.name}">{$fields.source_details_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_NON_FINANCIAL_CONSIDERATION' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="multienum" field="non_financial_consideration_c" >

{if !$fields.non_financial_consideration_c.hidden}
{counter name="panelFieldCount" print=false}

{if !empty($fields.non_financial_consideration_c.value) && ($fields.non_financial_consideration_c.value != '^^')}
<input type="hidden" class="sugar_field" id="{$fields.non_financial_consideration_c.name}" value="{$fields.non_financial_consideration_c.value}">
{multienum_to_array string=$fields.non_financial_consideration_c.value assign="vals"}
{foreach from=$vals item=item}
<li style="margin-left:10px;">{ $fields.non_financial_consideration_c.options.$item }</li>
{/foreach}
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO_NEW' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="assigned_to_new_c" >

{if !$fields.assigned_to_new_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.assigned_to_new_c.value) <= 0}
{assign var="value" value=$fields.assigned_to_new_c.default_value }
{else}
{assign var="value" value=$fields.assigned_to_new_c.value }
{/if} 
<span class="sugar_field" id="{$fields.assigned_to_new_c.name}">{$fields.assigned_to_new_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_DESCRIPTION' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="description" colspan='3'>

{if !$fields.description.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.description.name|escape:'html'|url2html|nl2br}">{$fields.description.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>
                            </div>
</div>
</div>
{/if}





{if $config.enable_action_menu and $config.enable_action_menu != false}

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-1" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL2' module='Opportunities'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-1"  data-id="LBL_EDITVIEW_PANEL2">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_FINANCIAL_FEASIBILITY_L1' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="financial_feasibility_l1_c" >

{if !$fields.financial_feasibility_l1_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.financial_feasibility_l1_c.value) <= 0}
{assign var="value" value=$fields.financial_feasibility_l1_c.default_value }
{else}
{assign var="value" value=$fields.financial_feasibility_l1_c.value }
{/if} 
<span class="sugar_field" id="{$fields.financial_feasibility_l1_c.name}">{$fields.financial_feasibility_l1_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_FINANCIAL_FEASIBILITY_L2' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="financial_feasibility_l2_c" >

{if !$fields.financial_feasibility_l2_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.financial_feasibility_l2_c.value) <= 0}
{assign var="value" value=$fields.financial_feasibility_l2_c.default_value }
{else}
{assign var="value" value=$fields.financial_feasibility_l2_c.value }
{/if} 
<span class="sugar_field" id="{$fields.financial_feasibility_l2_c.name}">{$fields.financial_feasibility_l2_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_BUDGET_SOURCE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="budget_source_c" >

{if !$fields.budget_source_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.budget_source_c.value) <= 0}
{assign var="value" value=$fields.budget_source_c.default_value }
{else}
{assign var="value" value=$fields.budget_source_c.value }
{/if} 
<span class="sugar_field" id="{$fields.budget_source_c.name}">{$fields.budget_source_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_BUDGET_HEAD' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="budget_head_c" >

{if !$fields.budget_head_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.budget_head_c.value) <= 0}
{assign var="value" value=$fields.budget_head_c.default_value }
{else}
{assign var="value" value=$fields.budget_head_c.value }
{/if} 
<span class="sugar_field" id="{$fields.budget_head_c.name}">{$fields.budget_head_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_BUDGET_HEAD_AMOUNT' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="float" field="budget_head_amount_c" >

{if !$fields.budget_head_amount_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.budget_head_amount_c.name}">
{sugar_number_format var=$fields.budget_head_amount_c.value precision=2 }
</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_BUDGET_ALLOCATED_OPPERTUNITY' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="float" field="budget_allocated_oppertunity_c" >

{if !$fields.budget_allocated_oppertunity_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.budget_allocated_oppertunity_c.name}">
{sugar_number_format var=$fields.budget_allocated_oppertunity_c.value precision=2 }
</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_PROJECT_IMPLEMENTATION_START' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="project_implementation_start_c" >

{if !$fields.project_implementation_start_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.project_implementation_start_c.value) <= 0}
{assign var="value" value=$fields.project_implementation_start_c.default_value }
{else}
{assign var="value" value=$fields.project_implementation_start_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.project_implementation_start_c.name}">{$value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_PROJECT_IMPLEMENTATION_END' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="project_implementation_end_c" >

{if !$fields.project_implementation_end_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.project_implementation_end_c.value) <= 0}
{assign var="value" value=$fields.project_implementation_end_c.default_value }
{else}
{assign var="value" value=$fields.project_implementation_end_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.project_implementation_end_c.name}">{$value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_FINANCIAL_FEASIBILITY_L3' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="financial_feasibility_l3_c" >

{if !$fields.financial_feasibility_l3_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.financial_feasibility_l3_c.value) <= 0}
{assign var="value" value=$fields.financial_feasibility_l3_c.default_value }
{else}
{assign var="value" value=$fields.financial_feasibility_l3_c.value }
{/if} 
<span class="sugar_field" id="{$fields.financial_feasibility_l3_c.name}">{$fields.financial_feasibility_l3_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>

</div>
                                </div>
</div>
</div>
{else}

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-1" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL2' module='Opportunities'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-1" data-id="LBL_EDITVIEW_PANEL2">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_FINANCIAL_FEASIBILITY_L1' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="financial_feasibility_l1_c" >

{if !$fields.financial_feasibility_l1_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.financial_feasibility_l1_c.value) <= 0}
{assign var="value" value=$fields.financial_feasibility_l1_c.default_value }
{else}
{assign var="value" value=$fields.financial_feasibility_l1_c.value }
{/if} 
<span class="sugar_field" id="{$fields.financial_feasibility_l1_c.name}">{$fields.financial_feasibility_l1_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_FINANCIAL_FEASIBILITY_L2' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="financial_feasibility_l2_c" >

{if !$fields.financial_feasibility_l2_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.financial_feasibility_l2_c.value) <= 0}
{assign var="value" value=$fields.financial_feasibility_l2_c.default_value }
{else}
{assign var="value" value=$fields.financial_feasibility_l2_c.value }
{/if} 
<span class="sugar_field" id="{$fields.financial_feasibility_l2_c.name}">{$fields.financial_feasibility_l2_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_BUDGET_SOURCE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="budget_source_c" >

{if !$fields.budget_source_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.budget_source_c.value) <= 0}
{assign var="value" value=$fields.budget_source_c.default_value }
{else}
{assign var="value" value=$fields.budget_source_c.value }
{/if} 
<span class="sugar_field" id="{$fields.budget_source_c.name}">{$fields.budget_source_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_BUDGET_HEAD' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="budget_head_c" >

{if !$fields.budget_head_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.budget_head_c.value) <= 0}
{assign var="value" value=$fields.budget_head_c.default_value }
{else}
{assign var="value" value=$fields.budget_head_c.value }
{/if} 
<span class="sugar_field" id="{$fields.budget_head_c.name}">{$fields.budget_head_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_BUDGET_HEAD_AMOUNT' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="float" field="budget_head_amount_c" >

{if !$fields.budget_head_amount_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.budget_head_amount_c.name}">
{sugar_number_format var=$fields.budget_head_amount_c.value precision=2 }
</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_BUDGET_ALLOCATED_OPPERTUNITY' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="float" field="budget_allocated_oppertunity_c" >

{if !$fields.budget_allocated_oppertunity_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.budget_allocated_oppertunity_c.name}">
{sugar_number_format var=$fields.budget_allocated_oppertunity_c.value precision=2 }
</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_PROJECT_IMPLEMENTATION_START' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="project_implementation_start_c" >

{if !$fields.project_implementation_start_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.project_implementation_start_c.value) <= 0}
{assign var="value" value=$fields.project_implementation_start_c.default_value }
{else}
{assign var="value" value=$fields.project_implementation_start_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.project_implementation_start_c.name}">{$value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_PROJECT_IMPLEMENTATION_END' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="project_implementation_end_c" >

{if !$fields.project_implementation_end_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.project_implementation_end_c.value) <= 0}
{assign var="value" value=$fields.project_implementation_end_c.default_value }
{else}
{assign var="value" value=$fields.project_implementation_end_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.project_implementation_end_c.name}">{$value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_FINANCIAL_FEASIBILITY_L3' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="financial_feasibility_l3_c" >

{if !$fields.financial_feasibility_l3_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.financial_feasibility_l3_c.value) <= 0}
{assign var="value" value=$fields.financial_feasibility_l3_c.default_value }
{else}
{assign var="value" value=$fields.financial_feasibility_l3_c.value }
{/if} 
<span class="sugar_field" id="{$fields.financial_feasibility_l3_c.name}">{$fields.financial_feasibility_l3_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>

</div>
                            </div>
</div>
</div>
{/if}





{if $config.enable_action_menu and $config.enable_action_menu != false}

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-2" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL7' module='Opportunities'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-2"  data-id="LBL_EDITVIEW_PANEL7">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SEGMENT' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="segment_c" >

{if !$fields.segment_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.segment_c.value) <= 0}
{assign var="value" value=$fields.segment_c.default_value }
{else}
{assign var="value" value=$fields.segment_c.value }
{/if} 
<span class="sugar_field" id="{$fields.segment_c.name}">{$fields.segment_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_PRODUCT_SERVICE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="product_service_c" >

{if !$fields.product_service_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.product_service_c.value) <= 0}
{assign var="value" value=$fields.product_service_c.default_value }
{else}
{assign var="value" value=$fields.product_service_c.value }
{/if} 
<span class="sugar_field" id="{$fields.product_service_c.name}">{$fields.product_service_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_ADD_NEW_SEGMENT' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="add_new_segment_c" >

{if !$fields.add_new_segment_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.add_new_segment_c.value) <= 0}
{assign var="value" value=$fields.add_new_segment_c.default_value }
{else}
{assign var="value" value=$fields.add_new_segment_c.value }
{/if} 
<span class="sugar_field" id="{$fields.add_new_segment_c.name}">{$fields.add_new_segment_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_ADD_NEW_PRODUCT_SERVICE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="add_new_product_service_c" >

{if !$fields.add_new_product_service_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.add_new_product_service_c.value) <= 0}
{assign var="value" value=$fields.add_new_product_service_c.default_value }
{else}
{assign var="value" value=$fields.add_new_product_service_c.value }
{/if} 
<span class="sugar_field" id="{$fields.add_new_product_service_c.name}">{$fields.add_new_product_service_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SECTOR' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="sector_c" >

{if !$fields.sector_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.sector_c.value) <= 0}
{assign var="value" value=$fields.sector_c.default_value }
{else}
{assign var="value" value=$fields.sector_c.value }
{/if} 
<span class="sugar_field" id="{$fields.sector_c.name}">{$fields.sector_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SUB_SECTOR' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="sub_sector_c" >

{if !$fields.sub_sector_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.sub_sector_c.value) <= 0}
{assign var="value" value=$fields.sub_sector_c.default_value }
{else}
{assign var="value" value=$fields.sub_sector_c.value }
{/if} 
<span class="sugar_field" id="{$fields.sub_sector_c.name}">{$fields.sub_sector_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_RISK' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="risk_c" colspan='3'>

{if !$fields.risk_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.risk_c.name|escape:'html'|url2html|nl2br}">{$fields.risk_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_PROJECT_SCOPE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="project_scope_c" colspan='3'>

{if !$fields.project_scope_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.project_scope_c.name|escape:'html'|url2html|nl2br}">{$fields.project_scope_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SELECTION' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="selection_c" >

{if !$fields.selection_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.selection_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.selection_c.name}" value="{ $fields.selection_c.options }">
{ $fields.selection_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.selection_c.name}" value="{ $fields.selection_c.value }">
{ $fields.selection_c.options[$fields.selection_c.value]}
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_FUNDING' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="funding_c" >

{if !$fields.funding_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.funding_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.funding_c.name}" value="{ $fields.funding_c.options }">
{ $fields.funding_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.funding_c.name}" value="{ $fields.funding_c.value }">
{ $fields.funding_c.options[$fields.funding_c.value]}
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_TIMING_BUTTON' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="timing_button_c" >

{if !$fields.timing_button_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.timing_button_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.timing_button_c.name}" value="{ $fields.timing_button_c.options }">
{ $fields.timing_button_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.timing_button_c.name}" value="{ $fields.timing_button_c.value }">
{ $fields.timing_button_c.options[$fields.timing_button_c.value]}
{/if}
{/if}

</div>


</div>

</div>
                                </div>
</div>
</div>
{else}

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-2" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL7' module='Opportunities'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-2" data-id="LBL_EDITVIEW_PANEL7">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SEGMENT' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="segment_c" >

{if !$fields.segment_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.segment_c.value) <= 0}
{assign var="value" value=$fields.segment_c.default_value }
{else}
{assign var="value" value=$fields.segment_c.value }
{/if} 
<span class="sugar_field" id="{$fields.segment_c.name}">{$fields.segment_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_PRODUCT_SERVICE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="product_service_c" >

{if !$fields.product_service_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.product_service_c.value) <= 0}
{assign var="value" value=$fields.product_service_c.default_value }
{else}
{assign var="value" value=$fields.product_service_c.value }
{/if} 
<span class="sugar_field" id="{$fields.product_service_c.name}">{$fields.product_service_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_ADD_NEW_SEGMENT' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="add_new_segment_c" >

{if !$fields.add_new_segment_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.add_new_segment_c.value) <= 0}
{assign var="value" value=$fields.add_new_segment_c.default_value }
{else}
{assign var="value" value=$fields.add_new_segment_c.value }
{/if} 
<span class="sugar_field" id="{$fields.add_new_segment_c.name}">{$fields.add_new_segment_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_ADD_NEW_PRODUCT_SERVICE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="add_new_product_service_c" >

{if !$fields.add_new_product_service_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.add_new_product_service_c.value) <= 0}
{assign var="value" value=$fields.add_new_product_service_c.default_value }
{else}
{assign var="value" value=$fields.add_new_product_service_c.value }
{/if} 
<span class="sugar_field" id="{$fields.add_new_product_service_c.name}">{$fields.add_new_product_service_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SECTOR' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="sector_c" >

{if !$fields.sector_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.sector_c.value) <= 0}
{assign var="value" value=$fields.sector_c.default_value }
{else}
{assign var="value" value=$fields.sector_c.value }
{/if} 
<span class="sugar_field" id="{$fields.sector_c.name}">{$fields.sector_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SUB_SECTOR' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="sub_sector_c" >

{if !$fields.sub_sector_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.sub_sector_c.value) <= 0}
{assign var="value" value=$fields.sub_sector_c.default_value }
{else}
{assign var="value" value=$fields.sub_sector_c.value }
{/if} 
<span class="sugar_field" id="{$fields.sub_sector_c.name}">{$fields.sub_sector_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_RISK' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="risk_c" colspan='3'>

{if !$fields.risk_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.risk_c.name|escape:'html'|url2html|nl2br}">{$fields.risk_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_PROJECT_SCOPE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="project_scope_c" colspan='3'>

{if !$fields.project_scope_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.project_scope_c.name|escape:'html'|url2html|nl2br}">{$fields.project_scope_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SELECTION' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="selection_c" >

{if !$fields.selection_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.selection_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.selection_c.name}" value="{ $fields.selection_c.options }">
{ $fields.selection_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.selection_c.name}" value="{ $fields.selection_c.value }">
{ $fields.selection_c.options[$fields.selection_c.value]}
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_FUNDING' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="funding_c" >

{if !$fields.funding_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.funding_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.funding_c.name}" value="{ $fields.funding_c.options }">
{ $fields.funding_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.funding_c.name}" value="{ $fields.funding_c.value }">
{ $fields.funding_c.options[$fields.funding_c.value]}
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_TIMING_BUTTON' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="timing_button_c" >

{if !$fields.timing_button_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.timing_button_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.timing_button_c.name}" value="{ $fields.timing_button_c.options }">
{ $fields.timing_button_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.timing_button_c.name}" value="{ $fields.timing_button_c.value }">
{ $fields.timing_button_c.options[$fields.timing_button_c.value]}
{/if}
{/if}

</div>


</div>

</div>
                            </div>
</div>
</div>
{/if}





{if $config.enable_action_menu and $config.enable_action_menu != false}

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-3" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL1' module='Opportunities'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-3"  data-id="LBL_EDITVIEW_PANEL1">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SCOPE_BUDGET_PROJECTED' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="scope_budget_projected_c" >

{if !$fields.scope_budget_projected_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.scope_budget_projected_c.value) <= 0}
{assign var="value" value=$fields.scope_budget_projected_c.default_value }
{else}
{assign var="value" value=$fields.scope_budget_projected_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.scope_budget_projected_c.name}">{$value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SCOPE_BUDGET_ACHIEVED' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="scope_budget_achieved_c" >

{if !$fields.scope_budget_achieved_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.scope_budget_achieved_c.value) <= 0}
{assign var="value" value=$fields.scope_budget_achieved_c.default_value }
{else}
{assign var="value" value=$fields.scope_budget_achieved_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.scope_budget_achieved_c.name}">{$value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_RFP_EOI_PROJECTED' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="rfp_eoi_projected_c" >

{if !$fields.rfp_eoi_projected_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.rfp_eoi_projected_c.value) <= 0}
{assign var="value" value=$fields.rfp_eoi_projected_c.default_value }
{else}
{assign var="value" value=$fields.rfp_eoi_projected_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.rfp_eoi_projected_c.name}">{$value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_RFP_EOI_ACHIEVED' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="rfp_eoi_achieved_c" >

{if !$fields.rfp_eoi_achieved_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.rfp_eoi_achieved_c.value) <= 0}
{assign var="value" value=$fields.rfp_eoi_achieved_c.default_value }
{else}
{assign var="value" value=$fields.rfp_eoi_achieved_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.rfp_eoi_achieved_c.name}">{$value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_RFP_EOI_PUBLISHED_PROJECTED' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="rfp_eoi_published_projected_c" >

{if !$fields.rfp_eoi_published_projected_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.rfp_eoi_published_projected_c.value) <= 0}
{assign var="value" value=$fields.rfp_eoi_published_projected_c.default_value }
{else}
{assign var="value" value=$fields.rfp_eoi_published_projected_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.rfp_eoi_published_projected_c.name}">{$value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_RFP_EOI_PUBLISHED_ACHIEVED' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="rfp_eoi_published_achieved_c" >

{if !$fields.rfp_eoi_published_achieved_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.rfp_eoi_published_achieved_c.value) <= 0}
{assign var="value" value=$fields.rfp_eoi_published_achieved_c.default_value }
{else}
{assign var="value" value=$fields.rfp_eoi_published_achieved_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.rfp_eoi_published_achieved_c.name}">{$value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_WORK_ORDER_PROJECTED' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="work_order_projected_c" >

{if !$fields.work_order_projected_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.work_order_projected_c.value) <= 0}
{assign var="value" value=$fields.work_order_projected_c.default_value }
{else}
{assign var="value" value=$fields.work_order_projected_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.work_order_projected_c.name}">{$value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_WORK_ORDER_ACHIEVED' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="work_order_achieved_c" >

{if !$fields.work_order_achieved_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.work_order_achieved_c.value) <= 0}
{assign var="value" value=$fields.work_order_achieved_c.default_value }
{else}
{assign var="value" value=$fields.work_order_achieved_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.work_order_achieved_c.name}">{$value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>

</div>
                                </div>
</div>
</div>
{else}

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-3" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL1' module='Opportunities'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-3" data-id="LBL_EDITVIEW_PANEL1">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SCOPE_BUDGET_PROJECTED' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="scope_budget_projected_c" >

{if !$fields.scope_budget_projected_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.scope_budget_projected_c.value) <= 0}
{assign var="value" value=$fields.scope_budget_projected_c.default_value }
{else}
{assign var="value" value=$fields.scope_budget_projected_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.scope_budget_projected_c.name}">{$value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SCOPE_BUDGET_ACHIEVED' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="scope_budget_achieved_c" >

{if !$fields.scope_budget_achieved_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.scope_budget_achieved_c.value) <= 0}
{assign var="value" value=$fields.scope_budget_achieved_c.default_value }
{else}
{assign var="value" value=$fields.scope_budget_achieved_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.scope_budget_achieved_c.name}">{$value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_RFP_EOI_PROJECTED' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="rfp_eoi_projected_c" >

{if !$fields.rfp_eoi_projected_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.rfp_eoi_projected_c.value) <= 0}
{assign var="value" value=$fields.rfp_eoi_projected_c.default_value }
{else}
{assign var="value" value=$fields.rfp_eoi_projected_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.rfp_eoi_projected_c.name}">{$value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_RFP_EOI_ACHIEVED' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="rfp_eoi_achieved_c" >

{if !$fields.rfp_eoi_achieved_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.rfp_eoi_achieved_c.value) <= 0}
{assign var="value" value=$fields.rfp_eoi_achieved_c.default_value }
{else}
{assign var="value" value=$fields.rfp_eoi_achieved_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.rfp_eoi_achieved_c.name}">{$value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_RFP_EOI_PUBLISHED_PROJECTED' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="rfp_eoi_published_projected_c" >

{if !$fields.rfp_eoi_published_projected_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.rfp_eoi_published_projected_c.value) <= 0}
{assign var="value" value=$fields.rfp_eoi_published_projected_c.default_value }
{else}
{assign var="value" value=$fields.rfp_eoi_published_projected_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.rfp_eoi_published_projected_c.name}">{$value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_RFP_EOI_PUBLISHED_ACHIEVED' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="rfp_eoi_published_achieved_c" >

{if !$fields.rfp_eoi_published_achieved_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.rfp_eoi_published_achieved_c.value) <= 0}
{assign var="value" value=$fields.rfp_eoi_published_achieved_c.default_value }
{else}
{assign var="value" value=$fields.rfp_eoi_published_achieved_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.rfp_eoi_published_achieved_c.name}">{$value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_WORK_ORDER_PROJECTED' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="work_order_projected_c" >

{if !$fields.work_order_projected_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.work_order_projected_c.value) <= 0}
{assign var="value" value=$fields.work_order_projected_c.default_value }
{else}
{assign var="value" value=$fields.work_order_projected_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.work_order_projected_c.name}">{$value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_WORK_ORDER_ACHIEVED' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="work_order_achieved_c" >

{if !$fields.work_order_achieved_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.work_order_achieved_c.value) <= 0}
{assign var="value" value=$fields.work_order_achieved_c.default_value }
{else}
{assign var="value" value=$fields.work_order_achieved_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.work_order_achieved_c.name}">{$value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>

</div>
                            </div>
</div>
</div>
{/if}





{if $config.enable_action_menu and $config.enable_action_menu != false}

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-4" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL8' module='Opportunities'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-4"  data-id="LBL_EDITVIEW_PANEL8">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_RFP_EOI_SUMMARY' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="rfp_eoi_summary_c" colspan='3'>

{if !$fields.rfp_eoi_summary_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.rfp_eoi_summary_c.name|escape:'html'|url2html|nl2br}">{$fields.rfp_eoi_summary_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_BID_STRATEGY' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="bid_strategy_c" >

{if !$fields.bid_strategy_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.bid_strategy_c.value) <= 0}
{assign var="value" value=$fields.bid_strategy_c.default_value }
{else}
{assign var="value" value=$fields.bid_strategy_c.value }
{/if} 
<span class="sugar_field" id="{$fields.bid_strategy_c.name}">{$fields.bid_strategy_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SUBMISSIONSTATUS' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="submissionstatus_c" >

{if !$fields.submissionstatus_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.submissionstatus_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.submissionstatus_c.name}" value="{ $fields.submissionstatus_c.options }">
{ $fields.submissionstatus_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.submissionstatus_c.name}" value="{ $fields.submissionstatus_c.value }">
{ $fields.submissionstatus_c.options[$fields.submissionstatus_c.value]}
{/if}
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_BID_CHECKLIST' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="bid_checklist_c" >

{if !$fields.bid_checklist_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.bid_checklist_c.value) <= 0}
{assign var="value" value=$fields.bid_checklist_c.default_value }
{else}
{assign var="value" value=$fields.bid_checklist_c.value }
{/if} 
<span class="sugar_field" id="{$fields.bid_checklist_c.name}">{$fields.bid_checklist_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='Bid Files' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="" field="" >

{if !$fields.multiple_file.hidden}
{counter name="panelFieldCount" print=false}
<span id="multiple_file" class="sugar_field">{include file=$FILEUPLOAD filename=$ATTACHMENTS}</span>
{/if}

</div>


</div>

</div>
                                </div>
</div>
</div>
{else}

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-4" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL8' module='Opportunities'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-4" data-id="LBL_EDITVIEW_PANEL8">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_RFP_EOI_SUMMARY' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="rfp_eoi_summary_c" colspan='3'>

{if !$fields.rfp_eoi_summary_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.rfp_eoi_summary_c.name|escape:'html'|url2html|nl2br}">{$fields.rfp_eoi_summary_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_BID_STRATEGY' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="bid_strategy_c" >

{if !$fields.bid_strategy_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.bid_strategy_c.value) <= 0}
{assign var="value" value=$fields.bid_strategy_c.default_value }
{else}
{assign var="value" value=$fields.bid_strategy_c.value }
{/if} 
<span class="sugar_field" id="{$fields.bid_strategy_c.name}">{$fields.bid_strategy_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SUBMISSIONSTATUS' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="submissionstatus_c" >

{if !$fields.submissionstatus_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.submissionstatus_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.submissionstatus_c.name}" value="{ $fields.submissionstatus_c.options }">
{ $fields.submissionstatus_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.submissionstatus_c.name}" value="{ $fields.submissionstatus_c.value }">
{ $fields.submissionstatus_c.options[$fields.submissionstatus_c.value]}
{/if}
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_BID_CHECKLIST' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="bid_checklist_c" >

{if !$fields.bid_checklist_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.bid_checklist_c.value) <= 0}
{assign var="value" value=$fields.bid_checklist_c.default_value }
{else}
{assign var="value" value=$fields.bid_checklist_c.value }
{/if} 
<span class="sugar_field" id="{$fields.bid_checklist_c.name}">{$fields.bid_checklist_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='Bid Files' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="" field="" >

{if !$fields.multiple_file.hidden}
{counter name="panelFieldCount" print=false}
<span id="multiple_file" class="sugar_field">{include file=$FILEUPLOAD filename=$ATTACHMENTS}</span>
{/if}

</div>


</div>

</div>
                            </div>
</div>
</div>
{/if}





{if $config.enable_action_menu and $config.enable_action_menu != false}

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-5" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL6' module='Opportunities'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-5"  data-id="LBL_EDITVIEW_PANEL6">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_CLOSURE_STATUS' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="closure_status_c" >

{if !$fields.closure_status_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.closure_status_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.closure_status_c.name}" value="{ $fields.closure_status_c.options }">
{ $fields.closure_status_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.closure_status_c.name}" value="{ $fields.closure_status_c.value }">
{ $fields.closure_status_c.options[$fields.closure_status_c.value]}
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_EXPECTED_INFLOW' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="expected_inflow_c" >

{if !$fields.expected_inflow_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.expected_inflow_c.value) <= 0}
{assign var="value" value=$fields.expected_inflow_c.default_value }
{else}
{assign var="value" value=$fields.expected_inflow_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.expected_inflow_c.name}">{$value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_LEARNINGS' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="learnings_c" colspan='3'>

{if !$fields.learnings_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.learnings_c.name|escape:'html'|url2html|nl2br}">{$fields.learnings_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_COMMENTS' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="comments_c" colspan='3'>

{if !$fields.comments_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.comments_c.name|escape:'html'|url2html|nl2br}">{$fields.comments_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>
                                </div>
</div>
</div>
{else}

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-5" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL6' module='Opportunities'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-5" data-id="LBL_EDITVIEW_PANEL6">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_CLOSURE_STATUS' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="closure_status_c" >

{if !$fields.closure_status_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.closure_status_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.closure_status_c.name}" value="{ $fields.closure_status_c.options }">
{ $fields.closure_status_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.closure_status_c.name}" value="{ $fields.closure_status_c.value }">
{ $fields.closure_status_c.options[$fields.closure_status_c.value]}
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_EXPECTED_INFLOW' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="expected_inflow_c" >

{if !$fields.expected_inflow_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.expected_inflow_c.value) <= 0}
{assign var="value" value=$fields.expected_inflow_c.default_value }
{else}
{assign var="value" value=$fields.expected_inflow_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.expected_inflow_c.name}">{$value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_LEARNINGS' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="learnings_c" colspan='3'>

{if !$fields.learnings_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.learnings_c.name|escape:'html'|url2html|nl2br}">{$fields.learnings_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_COMMENTS' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="comments_c" colspan='3'>

{if !$fields.comments_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.comments_c.name|escape:'html'|url2html|nl2br}">{$fields.comments_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>
                            </div>
</div>
</div>
{/if}





{if $config.enable_action_menu and $config.enable_action_menu != false}

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-6" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL10' module='Opportunities'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-6"  data-id="LBL_EDITVIEW_PANEL10">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_NOTE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="note_c" colspan='3'>

{if !$fields.note_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.note_c.name|escape:'html'|url2html|nl2br}">{$fields.note_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_WRITE_NOTE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="write_note_c" colspan='3'>

{if !$fields.write_note_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.write_note_c.name|escape:'html'|url2html|nl2br}">{$fields.write_note_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_POST_NOTE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="varchar" field="post_note_c" colspan='3'>

{if !$fields.post_note_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.post_note_c.value) <= 0}
{assign var="value" value=$fields.post_note_c.default_value }
{else}
{assign var="value" value=$fields.post_note_c.value }
{/if} 
<span class="sugar_field" id="{$fields.post_note_c.name}">{$fields.post_note_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>

</div>
                                </div>
</div>
</div>
{else}

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-6" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL10' module='Opportunities'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-6" data-id="LBL_EDITVIEW_PANEL10">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_NOTE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="note_c" colspan='3'>

{if !$fields.note_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.note_c.name|escape:'html'|url2html|nl2br}">{$fields.note_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_WRITE_NOTE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="write_note_c" colspan='3'>

{if !$fields.write_note_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.write_note_c.name|escape:'html'|url2html|nl2br}">{$fields.write_note_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_POST_NOTE' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="varchar" field="post_note_c" colspan='3'>

{if !$fields.post_note_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.post_note_c.value) <= 0}
{assign var="value" value=$fields.post_note_c.default_value }
{else}
{assign var="value" value=$fields.post_note_c.value }
{/if} 
<span class="sugar_field" id="{$fields.post_note_c.name}">{$fields.post_note_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>

</div>
                            </div>
</div>
</div>
{/if}





{if $config.enable_action_menu and $config.enable_action_menu != false}

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-7" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL9' module='Opportunities'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-7"  data-id="LBL_EDITVIEW_PANEL9">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_TAGGED_USERS' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="tagged_users_c" >

{if !$fields.tagged_users_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.tagged_users_c.value) <= 0}
{assign var="value" value=$fields.tagged_users_c.default_value }
{else}
{assign var="value" value=$fields.tagged_users_c.value }
{/if} 
<span class="sugar_field" id="{$fields.tagged_users_c.name}">{$fields.tagged_users_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_MULTIPLE_APPROVER' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="multiple_approver_c" >

{if !$fields.multiple_approver_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.multiple_approver_c.value) <= 0}
{assign var="value" value=$fields.multiple_approver_c.default_value }
{else}
{assign var="value" value=$fields.multiple_approver_c.value }
{/if} 
<span class="sugar_field" id="{$fields.multiple_approver_c.name}">{$fields.multiple_approver_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_TAGGED_USERS_COMMENTS' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="tagged_users_comments_c" colspan='3'>

{if !$fields.tagged_users_comments_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.tagged_users_comments_c.name|escape:'html'|url2html|nl2br}">{$fields.tagged_users_comments_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_TAGGED_HIDEN' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="tagged_hiden_c" >

{if !$fields.tagged_hiden_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.tagged_hiden_c.value) <= 0}
{assign var="value" value=$fields.tagged_hiden_c.default_value }
{else}
{assign var="value" value=$fields.tagged_hiden_c.value }
{/if} 
<span class="sugar_field" id="{$fields.tagged_hiden_c.name}">{$fields.tagged_hiden_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_UNTAGGED_HIDDEN' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="untagged_hidden_c" >

{if !$fields.untagged_hidden_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.untagged_hidden_c.value) <= 0}
{assign var="value" value=$fields.untagged_hidden_c.default_value }
{else}
{assign var="value" value=$fields.untagged_hidden_c.value }
{/if} 
<span class="sugar_field" id="{$fields.untagged_hidden_c.name}">{$fields.untagged_hidden_c.value}</span>
{/if}

</div>


</div>

</div>
                                </div>
</div>
</div>
{else}

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-7" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL9' module='Opportunities'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-7" data-id="LBL_EDITVIEW_PANEL9">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_TAGGED_USERS' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="tagged_users_c" >

{if !$fields.tagged_users_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.tagged_users_c.value) <= 0}
{assign var="value" value=$fields.tagged_users_c.default_value }
{else}
{assign var="value" value=$fields.tagged_users_c.value }
{/if} 
<span class="sugar_field" id="{$fields.tagged_users_c.name}">{$fields.tagged_users_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_MULTIPLE_APPROVER' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="multiple_approver_c" >

{if !$fields.multiple_approver_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.multiple_approver_c.value) <= 0}
{assign var="value" value=$fields.multiple_approver_c.default_value }
{else}
{assign var="value" value=$fields.multiple_approver_c.value }
{/if} 
<span class="sugar_field" id="{$fields.multiple_approver_c.name}">{$fields.multiple_approver_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_TAGGED_USERS_COMMENTS' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="tagged_users_comments_c" colspan='3'>

{if !$fields.tagged_users_comments_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.tagged_users_comments_c.name|escape:'html'|url2html|nl2br}">{$fields.tagged_users_comments_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_TAGGED_HIDEN' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="tagged_hiden_c" >

{if !$fields.tagged_hiden_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.tagged_hiden_c.value) <= 0}
{assign var="value" value=$fields.tagged_hiden_c.default_value }
{else}
{assign var="value" value=$fields.tagged_hiden_c.value }
{/if} 
<span class="sugar_field" id="{$fields.tagged_hiden_c.name}">{$fields.tagged_hiden_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_UNTAGGED_HIDDEN' module='Opportunities'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="untagged_hidden_c" >

{if !$fields.untagged_hidden_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.untagged_hidden_c.value) <= 0}
{assign var="value" value=$fields.untagged_hidden_c.default_value }
{else}
{assign var="value" value=$fields.untagged_hidden_c.value }
{/if} 
<span class="sugar_field" id="{$fields.untagged_hidden_c.name}">{$fields.untagged_hidden_c.value}</span>
{/if}

</div>


</div>

</div>
                            </div>
</div>
</div>
{/if}
</div>
</div>

</form>
<script>SUGAR.util.doWhen("document.getElementById('form') != null",
        function(){ldelim}SUGAR.util.buildAccessKeyLabels();{rdelim});
</script>            <script type="text/javascript" src="include/InlineEditing/inlineEditing.js"></script>
<script type="text/javascript" src="modules/Favorites/favorites.js"></script>
{literal}
<script type="text/javascript">

                    let selectTabDetailView = function(tab) {
                        $('#content div.tab-content div.tab-pane-NOBOOTSTRAPTOGGLER').hide();
                        $('#content div.tab-content div.tab-pane-NOBOOTSTRAPTOGGLER').eq(tab).show().addClass('active').addClass('in');
                        $('#content div.detail-view div.panel-content div.panel.panel').hide();
                        $('#content div.panel-content div.panel.tab-panel-' + tab).show();
                    };

                    let selectTabOnError = function(tab) {
                        selectTabDetailView(tab);
                        $('#content ul.nav.nav-tabs > li').removeClass('active');
                        $('#content ul.nav.nav-tabs > li a').css('color', '');

                        $('#content ul.nav.nav-tabs > li').eq(tab).find('a').first().css('color', 'red');
                        $('#content ul.nav.nav-tabs > li').eq(tab).addClass('active');

                    };

                    var selectTabOnErrorInputHandle = function(inputHandle) {
                        var tab = $(inputHandle).closest('.tab-pane-NOBOOTSTRAPTOGGLER').attr('id').match(/^detailpanel_(.*)$/)[1];
                        selectTabOnError(tab);
                    };


                    $(function(){
                        $('#content ul.nav.nav-tabs > li > a[data-toggle="tab"]').click(function(e){
                            if(typeof $(this).parent().find('a').first().attr('id') != 'undefined') {
                                var tab = parseInt($(this).parent().find('a').first().attr('id').match(/^tab(.)*$/)[1]);
                                selectTabDetailView(tab);
                            }
                        });
                    });

                </script>
{/literal}