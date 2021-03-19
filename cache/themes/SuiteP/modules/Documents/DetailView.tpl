

{if $fields.recurring_source.value != '' && $fields.recurring_source.value != 'Sugar'}
<div class="clear"></div>
<div class="error">{$MOD.LBL_SYNCED_RECURRING_MSG}</div>
{/if}

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
{if $bean->aclAccess("edit")}<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button primary" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Documents'; _form.return_action.value='DetailView'; _form.return_id.value='{$id}'; _form.action.value='EditView';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}">{/if} 
{if $bean->aclAccess("edit")}<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Documents'; _form.return_action.value='DetailView'; _form.isDuplicate.value=true; _form.action.value='EditView'; _form.return_id.value='{$id}';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}" id="duplicate_button">{/if} 
{if $bean->aclAccess("delete")}<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Documents'; _form.return_action.value='ListView'; _form.action.value='Delete'; if(confirm('{$APP.NTC_DELETE_CONFIRMATION}')) SUGAR.ajaxUI.submitForm(_form); return false;" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}" id="delete_button">{/if} 
{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Documents", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}
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

{if $config.enable_action_menu and $config.enable_action_menu != false}
<li role="presentation" class="active">
<a id="tab0" data-toggle="tab" class="hidden-xs">
{sugar_translate label='LBL_DOCUMENT_INFORMATION' module='Documents'}
</a>
<a id="xstab0" href="#" class="visible-xs first-tab dropdown-toggle" data-toggle="dropdown">
{sugar_translate label='LBL_DOCUMENT_INFORMATION' module='Documents'}
</a>
</li>

{/if}
{if $config.enable_action_menu and $config.enable_action_menu != false}
<li id="tab-actions" class="dropdown">
<a class="dropdown-toggle" data-toggle="dropdown" href="#">ACTIONS<span class="suitepicon suitepicon-action-caret"></span></a>
<ul class="dropdown-menu">
<li>{if $bean->aclAccess("edit")}<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button primary" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Documents'; _form.return_action.value='DetailView'; _form.return_id.value='{$id}'; _form.action.value='EditView';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}">{/if} </li>
<li>{if $bean->aclAccess("edit")}<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Documents'; _form.return_action.value='DetailView'; _form.isDuplicate.value=true; _form.action.value='EditView'; _form.return_id.value='{$id}';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}" id="duplicate_button">{/if} </li>
<li>{if $bean->aclAccess("delete")}<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Documents'; _form.return_action.value='ListView'; _form.action.value='Delete'; if(confirm('{$APP.NTC_DELETE_CONFIRMATION}')) SUGAR.ajaxUI.submitForm(_form); return false;" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}" id="delete_button">{/if} </li>
<li>{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Documents", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}</li>
</ul>        </li>
<li class="tab-inline-pagination">
{$PAGINATION}
</li>
{/if}
</ul>
<div class="clearfix"></div>

{if $config.enable_action_menu and $config.enable_action_menu != false}

<div class="tab-content">
{else}

<div class="tab-content" style="padding: 0; border: 0;">
{/if}


{if $config.enable_action_menu and $config.enable_action_menu != false}
<div class="tab-pane-NOBOOTSTRAPTOGGLER active fade in" id='tab-content-0'>





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_DOCUMENT_VISIBILITY' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="document_visibility_c" >

{if !$fields.document_visibility_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.document_visibility_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.document_visibility_c.name}" value="{ $fields.document_visibility_c.options }">
{ $fields.document_visibility_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.document_visibility_c.name}" value="{ $fields.document_visibility_c.value }">
{ $fields.document_visibility_c.options[$fields.document_visibility_c.value]}
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_STATUS' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="status_c" >

{if !$fields.status_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.status_c.value) <= 0}
{assign var="value" value=$fields.status_c.default_value }
{else}
{assign var="value" value=$fields.status_c.value }
{/if} 
<span class="sugar_field" id="{$fields.status_c.name}">{$fields.status_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_FILENAME' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="file" field="filename" >

{if !$fields.filename.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.filename.name}">
<a href="index.php?entryPoint=download&id={$fields.document_revision_id.value}&type={$module}" class="tabDetailViewDFLink" target='_blank'>{$fields.filename.value}</a>
&nbsp;
<a href="index.php?preview=yes&entryPoint=download&id={$fields.document_revision_id.value}&type={$module}" class="tabDetailViewDFLink" target='_blank' style="border-bottom: 0px;">
<i class="glyphicon glyphicon-eye-open"></i>
</a>
</span>
{if isset($fields.doc_type) && !empty($fields.doc_type.value) && $fields.doc_type.value != 'SugarCRM' && !empty($fields.doc_url.value) }
{capture name=imageNameCapture assign=imageName}
{$fields.doc_type.value}_image_inline.png
{/capture}
<a href="{$fields.doc_url.value}" class="tabDetailViewDFLink" target="_blank">{sugar_getimage name=$imageName alt=$imageName other_attributes='border="0" '}</a>
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_DOC_NAME' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="document_name" >

{if !$fields.document_name.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.document_name.value) <= 0}
{assign var="value" value=$fields.document_name.default_value }
{else}
{assign var="value" value=$fields.document_name.value }
{/if} 
<span class="sugar_field" id="{$fields.document_name.name}">{$fields.document_name.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_DET_TEMPLATE_TYPE' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="template_type" >

{if !$fields.template_type.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.template_type.options)}
<input type="hidden" class="sugar_field" id="{$fields.template_type.name}" value="{ $fields.template_type.options }">
{ $fields.template_type.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.template_type.name}" value="{ $fields.template_type.value }">
{ $fields.template_type.options[$fields.template_type.value]}
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_APPROVER' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="relate" field="approver_c" >

{if !$fields.approver_c.hidden}
{counter name="panelFieldCount" print=false}

<span id="user_id_c" class="sugar_field" data-id-value="{$fields.user_id_c.value}">{$fields.approver_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='RELATED TO' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="parent" field="parent_name" >

{if !$fields.parent_name.hidden}
{counter name="panelFieldCount" print=false}

<input type="hidden" class="sugar_field" id="{$fields.parent_name.name}" value="{$fields.parent_name.value}">
<input type="hidden" class="sugar_field" id="parent_id" value="{$fields.parent_id.value}">
<a href="index.php?module={$fields.parent_type.value}&action=DetailView&record={$fields.parent_id.value}" class="tabDetailViewDFLink">{$fields.parent_name.value}</a>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="relate" field="assigned_user_name" >

{if !$fields.assigned_user_name.hidden}
{counter name="panelFieldCount" print=false}

<span id="assigned_user_id" class="sugar_field" data-id-value="{$fields.assigned_user_id.value}">{$fields.assigned_user_name.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_CATEGORY' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="category_c" >

{if !$fields.category_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.category_c.value) <= 0}
{assign var="value" value=$fields.category_c.default_value }
{else}
{assign var="value" value=$fields.category_c.value }
{/if} 
<span class="sugar_field" id="{$fields.category_c.name}">{$fields.category_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SUB_CATEGORY' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="sub_category_c" >

{if !$fields.sub_category_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.sub_category_c.value) <= 0}
{assign var="value" value=$fields.sub_category_c.default_value }
{else}
{assign var="value" value=$fields.sub_category_c.value }
{/if} 
<span class="sugar_field" id="{$fields.sub_category_c.name}">{$fields.sub_category_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='Follow-up Documents' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="" field="" >

{if !$fields.multiple_file.hidden}
{counter name="panelFieldCount" print=false}
<span id="multiple_file" class="sugar_field">{include file=$FILEUPLOAD filename=$ATTACHMENTS}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_FOLLOW_UP_DATE' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="follow_up_date_c" >

{if !$fields.follow_up_date_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.follow_up_date_c.value) <= 0}
{assign var="value" value=$fields.follow_up_date_c.default_value }
{else}
{assign var="value" value=$fields.follow_up_date_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.follow_up_date_c.name}">{$value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_DESCRIPTION' module='Documents'}{/capture}
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
{else}

<div class="tab-pane-NOBOOTSTRAPTOGGLER panel-collapse"></div>
{/if}
</div>

<div class="panel-content">
<div>&nbsp;</div>





{if $config.enable_action_menu and $config.enable_action_menu != false}

{else}

<div class="panel panel-default">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel--1" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_DOCUMENT_INFORMATION' module='Documents'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel--1" data-id="LBL_DOCUMENT_INFORMATION">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_DOCUMENT_VISIBILITY' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="document_visibility_c" >

{if !$fields.document_visibility_c.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.document_visibility_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.document_visibility_c.name}" value="{ $fields.document_visibility_c.options }">
{ $fields.document_visibility_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.document_visibility_c.name}" value="{ $fields.document_visibility_c.value }">
{ $fields.document_visibility_c.options[$fields.document_visibility_c.value]}
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_STATUS' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="status_c" >

{if !$fields.status_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.status_c.value) <= 0}
{assign var="value" value=$fields.status_c.default_value }
{else}
{assign var="value" value=$fields.status_c.value }
{/if} 
<span class="sugar_field" id="{$fields.status_c.name}">{$fields.status_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_FILENAME' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="file" field="filename" >

{if !$fields.filename.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.filename.name}">
<a href="index.php?entryPoint=download&id={$fields.document_revision_id.value}&type={$module}" class="tabDetailViewDFLink" target='_blank'>{$fields.filename.value}</a>
&nbsp;
<a href="index.php?preview=yes&entryPoint=download&id={$fields.document_revision_id.value}&type={$module}" class="tabDetailViewDFLink" target='_blank' style="border-bottom: 0px;">
<i class="glyphicon glyphicon-eye-open"></i>
</a>
</span>
{if isset($fields.doc_type) && !empty($fields.doc_type.value) && $fields.doc_type.value != 'SugarCRM' && !empty($fields.doc_url.value) }
{capture name=imageNameCapture assign=imageName}
{$fields.doc_type.value}_image_inline.png
{/capture}
<a href="{$fields.doc_url.value}" class="tabDetailViewDFLink" target="_blank">{sugar_getimage name=$imageName alt=$imageName other_attributes='border="0" '}</a>
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_DOC_NAME' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="document_name" >

{if !$fields.document_name.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.document_name.value) <= 0}
{assign var="value" value=$fields.document_name.default_value }
{else}
{assign var="value" value=$fields.document_name.value }
{/if} 
<span class="sugar_field" id="{$fields.document_name.name}">{$fields.document_name.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_DET_TEMPLATE_TYPE' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="template_type" >

{if !$fields.template_type.hidden}
{counter name="panelFieldCount" print=false}


{if is_string($fields.template_type.options)}
<input type="hidden" class="sugar_field" id="{$fields.template_type.name}" value="{ $fields.template_type.options }">
{ $fields.template_type.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.template_type.name}" value="{ $fields.template_type.value }">
{ $fields.template_type.options[$fields.template_type.value]}
{/if}
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_APPROVER' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="relate" field="approver_c" >

{if !$fields.approver_c.hidden}
{counter name="panelFieldCount" print=false}

<span id="user_id_c" class="sugar_field" data-id-value="{$fields.user_id_c.value}">{$fields.approver_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='RELATED TO' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="parent" field="parent_name" >

{if !$fields.parent_name.hidden}
{counter name="panelFieldCount" print=false}

<input type="hidden" class="sugar_field" id="{$fields.parent_name.name}" value="{$fields.parent_name.value}">
<input type="hidden" class="sugar_field" id="parent_id" value="{$fields.parent_id.value}">
<a href="index.php?module={$fields.parent_type.value}&action=DetailView&record={$fields.parent_id.value}" class="tabDetailViewDFLink">{$fields.parent_name.value}</a>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="relate" field="assigned_user_name" >

{if !$fields.assigned_user_name.hidden}
{counter name="panelFieldCount" print=false}

<span id="assigned_user_id" class="sugar_field" data-id-value="{$fields.assigned_user_id.value}">{$fields.assigned_user_name.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_CATEGORY' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="category_c" >

{if !$fields.category_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.category_c.value) <= 0}
{assign var="value" value=$fields.category_c.default_value }
{else}
{assign var="value" value=$fields.category_c.value }
{/if} 
<span class="sugar_field" id="{$fields.category_c.name}">{$fields.category_c.value}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_SUB_CATEGORY' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="sub_category_c" >

{if !$fields.sub_category_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.sub_category_c.value) <= 0}
{assign var="value" value=$fields.sub_category_c.default_value }
{else}
{assign var="value" value=$fields.sub_category_c.value }
{/if} 
<span class="sugar_field" id="{$fields.sub_category_c.name}">{$fields.sub_category_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='Follow-up Documents' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="" field="" >

{if !$fields.multiple_file.hidden}
{counter name="panelFieldCount" print=false}
<span id="multiple_file" class="sugar_field">{include file=$FILEUPLOAD filename=$ATTACHMENTS}</span>
{/if}

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_FOLLOW_UP_DATE' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="follow_up_date_c" >

{if !$fields.follow_up_date_c.hidden}
{counter name="panelFieldCount" print=false}


{if !empty($vardef.date_formatted_value) }
{assign var="value" value={$vardef.date_formatted_value} }
{else}
{if strlen($fields.follow_up_date_c.value) <= 0}
{assign var="value" value=$fields.follow_up_date_c.default_value }
{else}
{assign var="value" value=$fields.follow_up_date_c.value }
{/if}
{/if}
<span class="sugar_field" id="{$fields.follow_up_date_c.name}">{$value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_DESCRIPTION' module='Documents'}{/capture}
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

<div class="panel panel-default">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-0" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL1' module='Documents'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-0"  data-id="LBL_EDITVIEW_PANEL1">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_TAGGED_USERS' module='Documents'}{/capture}
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


{capture name="label" assign="label"}{sugar_translate label='LBL_TAGGED_HIDDEN' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="tagged_hidden_c" >

{if !$fields.tagged_hidden_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.tagged_hidden_c.value) <= 0}
{assign var="value" value=$fields.tagged_hidden_c.default_value }
{else}
{assign var="value" value=$fields.tagged_hidden_c.value }
{/if} 
<span class="sugar_field" id="{$fields.tagged_hidden_c.name}">{$fields.tagged_hidden_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_TAG_COMMENTS' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="tag_comments_c" colspan='3'>

{if !$fields.tag_comments_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.tag_comments_c.name|escape:'html'|url2html|nl2br}">{$fields.tag_comments_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}

</div>


</div>

</div>
                                </div>
</div>
</div>
{else}

<div class="panel panel-default">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-0" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL1' module='Documents'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-0" data-id="LBL_EDITVIEW_PANEL1">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_TAGGED_USERS' module='Documents'}{/capture}
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


{capture name="label" assign="label"}{sugar_translate label='LBL_TAGGED_HIDDEN' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="tagged_hidden_c" >

{if !$fields.tagged_hidden_c.hidden}
{counter name="panelFieldCount" print=false}

{if strlen($fields.tagged_hidden_c.value) <= 0}
{assign var="value" value=$fields.tagged_hidden_c.default_value }
{else}
{assign var="value" value=$fields.tagged_hidden_c.value }
{/if} 
<span class="sugar_field" id="{$fields.tagged_hidden_c.name}">{$fields.tagged_hidden_c.value}</span>
{/if}

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


{capture name="label" assign="label"}{sugar_translate label='LBL_TAG_COMMENTS' module='Documents'}{/capture}
{$label|strip_semicolon}:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="tag_comments_c" colspan='3'>

{if !$fields.tag_comments_c.hidden}
{counter name="panelFieldCount" print=false}

<span class="sugar_field" id="{$fields.tag_comments_c.name|escape:'html'|url2html|nl2br}">{$fields.tag_comments_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
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