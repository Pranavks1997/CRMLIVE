

<script>
    {literal}
    $(document).ready(function(){
	    $("ul.clickMenu").each(function(index, node){
	        $(node).sugarActionMenu();
	    });

        if($('.edit-view-pagination').children().length == 0) $('.saveAndContinue').remove();
    });
    {/literal}
</script>
<div class="clear"></div>
<form action="index.php" method="POST" name="{$form_name}" id="{$form_id}" {$enctype}>
<div class="edit-view-pagination-mobile-container">
<div class="edit-view-pagination edit-view-mobile-pagination">
</div>
</div>
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="dcQuickEdit">
<tr>
<td class="buttons">
<input type="hidden" name="module" value="{$module}">
{if isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true"}
<input type="hidden" name="record" value="">
<input type="hidden" name="duplicateSave" value="true">
<input type="hidden" name="duplicateId" value="{$fields.id.value}">
{else}
<input type="hidden" name="record" value="{$fields.id.value}">
{/if}
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="action">
<input type="hidden" name="return_module" value="{$smarty.request.return_module}">
<input type="hidden" name="return_action" value="{$smarty.request.return_action}">
<input type="hidden" name="return_id" value="{$smarty.request.return_id}">
<input type="hidden" name="module_tab"> 
<input type="hidden" name="contact_role">
{if (!empty($smarty.request.return_module) || !empty($smarty.request.relate_to)) && !(isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true")}
<input type="hidden" name="relate_to" value="{if $smarty.request.return_relationship}{$smarty.request.return_relationship}{elseif $smarty.request.relate_to && empty($smarty.request.from_dcmenu)}{$smarty.request.relate_to}{elseif empty($isDCForm) && empty($smarty.request.from_dcmenu)}{$smarty.request.return_module}{/if}">
<input type="hidden" name="relate_id" value="{$smarty.request.return_id}">
{/if}
<input type="hidden" name="offset" value="{$offset}">
{assign var='place' value="_HEADER"} <!-- to be used for id for buttons with custom code in def files-->
<input type="hidden" name="isSaveAndNew" value="false">   
<input type="hidden" name="send_invites">   
<input type="hidden" name="user_invitees">   
<input type="hidden" name="lead_invitees">   
<input type="hidden" name="contact_invitees">   
<div class="buttons">
{if $bean->aclAccess("save")}<input title="{$APP.LBL_SAVE_BUTTON_TITLE}"  class="button" onclick="var _form = document.getElementById('form_SubpanelQuickCreate_Calls'); disableOnUnloadEditView(); _form.action.value='Save';if(check_form('form_SubpanelQuickCreate_Calls'))return SUGAR.subpanelUtils.inlineSave(_form.id, 'Calls_subpanel_save_button');return false;" type="submit" name="Calls_subpanel_save_button" id="Calls_subpanel_save_button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">{/if} 
<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" class="button" onclick="return SUGAR.subpanelUtils.cancelCreate($(this).attr('id'));return false;" type="submit" name="Calls_subpanel_cancel_button" id="Calls_subpanel_cancel_button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}"> 
<input title="{$APP.LBL_FULL_FORM_BUTTON_TITLE}" class="button" onclick="var _form = document.getElementById('form_SubpanelQuickCreate_Calls'); disableOnUnloadEditView(_form); _form.return_action.value='DetailView'; _form.action.value='EditView'; if(typeof(_form.to_pdf)!='undefined') _form.to_pdf.value='0';" type="submit" name="Calls_subpanel_full_form_button" id="Calls_subpanel_full_form_button" value="{$APP.LBL_FULL_FORM_BUTTON_LABEL}"> <input type="hidden" name="full_form" value="full_form">
{if $showVCRControl}
<button type="button" id="save_and_continue" class="button saveAndContinue" title="{$app_strings.LBL_SAVE_AND_CONTINUE}" onClick="SUGAR.saveAndContinue(this);">
{$APP.LBL_SAVE_AND_CONTINUE}
</button>
{/if}
{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Calls", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}
</div>
</td>
<td align='right' class="edit-view-pagination-desktop-container">
<div class="edit-view-pagination edit-view-pagination-desktop">
</div>
</td>
</tr>
</table>
{sugar_include include=$includes}
<div id="EditView_tabs">

<ul class="nav nav-tabs">
</ul>
<div class="clearfix"></div>
<div class="tab-content" style="padding: 0; border: 0;">

<div class="tab-pane panel-collapse">&nbsp;</div>
</div>

<div class="panel-content">
<div>&nbsp;</div>




<div class="panel panel-default">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse-edit" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_CALL_INFORMATION' module='Calls'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="detailpanel_-1" data-id="LBL_CALL_INFORMATION">
<div class="tab-content">
<!-- tab_panel_content.tpl -->
<div class="row edit-view-row">



<div class="col-xs-12 col-sm-6 edit-view-row-item">


<div class="col-xs-12 col-sm-4 label" data-label="LBL_ACTIVITY_TYPE">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_ACTIVITY_TYPE' module='Calls'}{/capture}
{$label|strip_semicolon}:

{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="enum" field="activity_type_c"  >
{counter name="panelFieldCount" print=false}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.activity_type_c.name}" 
id="{$fields.activity_type_c.name}" 
title=''       
>
{if isset($fields.activity_type_c.value) && $fields.activity_type_c.value != ''}
{html_options options=$fields.activity_type_c.options selected=$fields.activity_type_c.value}
{else}
{html_options options=$fields.activity_type_c.options selected=$fields.activity_type_c.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.activity_type_c.options }
{capture name="field_val"}{$fields.activity_type_c.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.activity_type_c.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.activity_type_c.name}" 
id="{$fields.activity_type_c.name}" 
title=''          
>
{if isset($fields.activity_type_c.value) && $fields.activity_type_c.value != ''}
{html_options options=$fields.activity_type_c.options selected=$fields.activity_type_c.value}
{else}
{html_options options=$fields.activity_type_c.options selected=$fields.activity_type_c.default}
{/if}
</select>
<input
id="{$fields.activity_type_c.name}-input"
name="{$fields.activity_type_c.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.activity_type_c.name}-image"></button><button type="button"
id="btn-clear-{$fields.activity_type_c.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.activity_type_c.name}-input', '{$fields.activity_type_c.name}');sync_{$fields.activity_type_c.name}()"><span class="suitepicon suitepicon-action-clear"></span></button>
</span>
{literal}
<script>
	SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
	{/literal}

			{literal}
		(function (){
			var selectElem = document.getElementById("{/literal}{$fields.activity_type_c.name}{literal}");
			
			if (typeof select_defaults =="undefined")
				select_defaults = [];
			
			select_defaults[selectElem.id] = {key:selectElem.value,text:''};

			//get default
			for (i=0;i<selectElem.options.length;i++){
				if (selectElem.options[i].value==selectElem.value)
					select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
			}

			//SUGAR.AutoComplete.{$ac_key}.ds = 
			//get options array from vardefs
			var options = SUGAR.AutoComplete.getOptionsArray("");

			YUI().use('datasource', 'datasource-jsonschema',function (Y) {
				SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
				    source: function (request) {
				    	var ret = [];
				    	for (i=0;i<selectElem.options.length;i++)
				    		if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
				    			ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
				    	return ret;
				    }
				});
			});
		})();
		{/literal}
	
	{literal}
		YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
	{/literal}
			
	SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.activity_type_c.name}-input');
	SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.activity_type_c.name}-image');
	SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.activity_type_c.name}');
	
			{literal}
			function SyncToHidden(selectme){
				var selectElem = document.getElementById("{/literal}{$fields.activity_type_c.name}{literal}");
				var doSimulateChange = false;
				
				if (selectElem.value!=selectme)
					doSimulateChange=true;
				
				selectElem.value=selectme;

				for (i=0;i<selectElem.options.length;i++){
					selectElem.options[i].selected=false;
					if (selectElem.options[i].value==selectme)
						selectElem.options[i].selected=true;
				}

				if (doSimulateChange)
					SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
			}

			//global variable 
			sync_{/literal}{$fields.activity_type_c.name}{literal} = function(){
				SyncToHidden();
			}
			function syncFromHiddenToWidget(){

				var selectElem = document.getElementById("{/literal}{$fields.activity_type_c.name}{literal}");

				//if select no longer on page, kill timer
				if (selectElem==null || selectElem.options == null)
					return;

				var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');

				SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');

				for (i=0;i<selectElem.options.length;i++){

					if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.activity_type_c.name}-input{literal}'))
						SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
				}
			}

            YAHOO.util.Event.onAvailable("{/literal}{$fields.activity_type_c.name}{literal}", syncFromHiddenToWidget);
		{/literal}

		SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
		SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
		SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
		if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
			{/literal}
			SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
			SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
			{literal}
		}
		{/literal}
		if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
			{/literal}
			SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
			SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
			{literal}
		}
		{/literal}
		
	SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
	
	{literal}
	SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
		activateFirstItem: true,
		{/literal}
		minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
		queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
		zIndex: 99999,

				
		{literal}
		source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
		
		resultTextLocator: 'text',
		resultHighlighter: 'phraseMatch',
		resultFilters: 'phraseMatch',
	});

	SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
		var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
		if(hover[0] != null){
			if (ex) {
				var h = '1000px';
				hover[0].style.height = h;
			}
			else{
				hover[0].style.height = '';
			}
		}
	}
		
	if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
		// expand the dropdown options upon focus
		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
		});
	}

			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
		});
		
		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
		});

		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
		});

		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
		});

		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
		});

		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
			var selectElem = document.getElementById("{/literal}{$fields.activity_type_c.name}{literal}");
			//if typed value is a valid option, do nothing
			for (i=0;i<selectElem.options.length;i++)
				if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
					return;
			
			//typed value is invalid, so set the text and the hidden to blank
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
			SyncToHidden(select_defaults[selectElem.id].key);
		});
	
	// when they click on the arrow image, toggle the visibility of the options
	SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
		if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
		} else {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
		}
	});

	SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
	});

	SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
	});

	// when they select an option, set the hidden input with the KEY, to be saved
	SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
		SyncToHidden(e.result.raw.key);
	});
 
});
</script> 
{/literal}
{/if}
</div>

<!-- [/hide] -->
</div>


<div class="col-xs-12 col-sm-6 edit-view-row-item">


<div class="col-xs-12 col-sm-4 label" data-label="LBL_STATUS_NEW">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_STATUS_NEW' module='Calls'}{/capture}
{$label|strip_semicolon}:

{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="varchar" field="status_new_c"  >
{counter name="panelFieldCount" print=false}

{if strlen($fields.status_new_c.value) <= 0}
{assign var="value" value=$fields.status_new_c.default_value }
{else}
{assign var="value" value=$fields.status_new_c.value }
{/if}  
<input type='text' name='{$fields.status_new_c.name}' 
id='{$fields.status_new_c.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
</div>

<!-- [/hide] -->
</div>
<div class="clear"></div>
<div class="clear"></div>



<div class="col-xs-12 col-sm-6 edit-view-row-item">


<div class="col-xs-12 col-sm-4 label" data-label="LBL_SUBJECT">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBJECT' module='Calls'}{/capture}
{$label|strip_semicolon}:

<span class="required">*</span>
{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="name" field="name"  >
{counter name="panelFieldCount" print=false}

{if strlen($fields.name.value) <= 0}
{assign var="value" value=$fields.name.default_value }
{else}
{assign var="value" value=$fields.name.value }
{/if}  
<input type='text' name='{$fields.name.name}' 
id='{$fields.name.name}' size='30' 
maxlength='50' 
value='{$value}' title=''      >
</div>

<!-- [/hide] -->
</div>


<div class="col-xs-12 col-sm-6 edit-view-row-item">


<div class="col-xs-12 col-sm-4 label" data-label="LBL_APPROVER">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_APPROVER' module='Calls'}{/capture}
{$label|strip_semicolon}:

{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="relate" field="approver_c"  >
{counter name="panelFieldCount" print=false}

<input type="text" name="{$fields.approver_c.name}" class="sqsEnabled" tabindex="0" id="{$fields.approver_c.name}" size="" value="{$fields.approver_c.value}" title='' autocomplete="off"  	 >
<input type="hidden" name="{$fields.approver_c.id_name}" 
id="{$fields.approver_c.id_name}" 
value="{$fields.user_id_c.value}">
<span class="id-ff multiple">
<button type="button" name="btn_{$fields.approver_c.name}" id="btn_{$fields.approver_c.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_SELECT_USERS_TITLE"}" class="button firstChild" value="{sugar_translate label="LBL_ACCESSKEY_SELECT_USERS_LABEL"}"
onclick='open_popup(
"{$fields.approver_c.module}", 
600, 
395,
"", 
true, 
false, 
{literal}{"call_back_function":"set_return","form_name":"form_SubpanelQuickCreate_Calls","field_to_name_array":{"id":"user_id_c","name":"approver_c"}}{/literal}, 
"single", 
true
);' ><span class="suitepicon suitepicon-action-select"></span></button><button type="button" name="btn_clr_{$fields.approver_c.name}" id="btn_clr_{$fields.approver_c.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_CLEAR_USERS_TITLE"}"  class="button lastChild"
onclick="SUGAR.clearRelateField(this.form, '{$fields.approver_c.name}', '{$fields.approver_c.id_name}');"  value="{sugar_translate label="LBL_ACCESSKEY_CLEAR_USERS_LABEL"}" ><span class="suitepicon suitepicon-action-clear"></span></button>
</span>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['{$form_name}_{$fields.approver_c.name}']) != 'undefined'",
		enableQS
);
</script>
</div>

<!-- [/hide] -->
</div>
<div class="clear"></div>
<div class="clear"></div>



<div class="col-xs-12 col-sm-6 edit-view-row-item">


<div class="col-xs-12 col-sm-4 label" data-label="LBL_TYPE_OF_INTERACTION">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_TYPE_OF_INTERACTION' module='Calls'}{/capture}
{$label|strip_semicolon}:

<span class="required">*</span>
{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="enum" field="type_of_interaction_c"  >
{counter name="panelFieldCount" print=false}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.type_of_interaction_c.name}" 
id="{$fields.type_of_interaction_c.name}" 
title=''       
>
{if isset($fields.type_of_interaction_c.value) && $fields.type_of_interaction_c.value != ''}
{html_options options=$fields.type_of_interaction_c.options selected=$fields.type_of_interaction_c.value}
{else}
{html_options options=$fields.type_of_interaction_c.options selected=$fields.type_of_interaction_c.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.type_of_interaction_c.options }
{capture name="field_val"}{$fields.type_of_interaction_c.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.type_of_interaction_c.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.type_of_interaction_c.name}" 
id="{$fields.type_of_interaction_c.name}" 
title=''          
>
{if isset($fields.type_of_interaction_c.value) && $fields.type_of_interaction_c.value != ''}
{html_options options=$fields.type_of_interaction_c.options selected=$fields.type_of_interaction_c.value}
{else}
{html_options options=$fields.type_of_interaction_c.options selected=$fields.type_of_interaction_c.default}
{/if}
</select>
<input
id="{$fields.type_of_interaction_c.name}-input"
name="{$fields.type_of_interaction_c.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.type_of_interaction_c.name}-image"></button><button type="button"
id="btn-clear-{$fields.type_of_interaction_c.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.type_of_interaction_c.name}-input', '{$fields.type_of_interaction_c.name}');sync_{$fields.type_of_interaction_c.name}()"><span class="suitepicon suitepicon-action-clear"></span></button>
</span>
{literal}
<script>
	SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
	{/literal}

			{literal}
		(function (){
			var selectElem = document.getElementById("{/literal}{$fields.type_of_interaction_c.name}{literal}");
			
			if (typeof select_defaults =="undefined")
				select_defaults = [];
			
			select_defaults[selectElem.id] = {key:selectElem.value,text:''};

			//get default
			for (i=0;i<selectElem.options.length;i++){
				if (selectElem.options[i].value==selectElem.value)
					select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
			}

			//SUGAR.AutoComplete.{$ac_key}.ds = 
			//get options array from vardefs
			var options = SUGAR.AutoComplete.getOptionsArray("");

			YUI().use('datasource', 'datasource-jsonschema',function (Y) {
				SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
				    source: function (request) {
				    	var ret = [];
				    	for (i=0;i<selectElem.options.length;i++)
				    		if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
				    			ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
				    	return ret;
				    }
				});
			});
		})();
		{/literal}
	
	{literal}
		YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
	{/literal}
			
	SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.type_of_interaction_c.name}-input');
	SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.type_of_interaction_c.name}-image');
	SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.type_of_interaction_c.name}');
	
			{literal}
			function SyncToHidden(selectme){
				var selectElem = document.getElementById("{/literal}{$fields.type_of_interaction_c.name}{literal}");
				var doSimulateChange = false;
				
				if (selectElem.value!=selectme)
					doSimulateChange=true;
				
				selectElem.value=selectme;

				for (i=0;i<selectElem.options.length;i++){
					selectElem.options[i].selected=false;
					if (selectElem.options[i].value==selectme)
						selectElem.options[i].selected=true;
				}

				if (doSimulateChange)
					SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
			}

			//global variable 
			sync_{/literal}{$fields.type_of_interaction_c.name}{literal} = function(){
				SyncToHidden();
			}
			function syncFromHiddenToWidget(){

				var selectElem = document.getElementById("{/literal}{$fields.type_of_interaction_c.name}{literal}");

				//if select no longer on page, kill timer
				if (selectElem==null || selectElem.options == null)
					return;

				var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');

				SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');

				for (i=0;i<selectElem.options.length;i++){

					if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.type_of_interaction_c.name}-input{literal}'))
						SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
				}
			}

            YAHOO.util.Event.onAvailable("{/literal}{$fields.type_of_interaction_c.name}{literal}", syncFromHiddenToWidget);
		{/literal}

		SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
		SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
		SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
		if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
			{/literal}
			SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
			SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
			{literal}
		}
		{/literal}
		if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
			{/literal}
			SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
			SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
			{literal}
		}
		{/literal}
		
	SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
	
	{literal}
	SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
		activateFirstItem: true,
		{/literal}
		minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
		queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
		zIndex: 99999,

				
		{literal}
		source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
		
		resultTextLocator: 'text',
		resultHighlighter: 'phraseMatch',
		resultFilters: 'phraseMatch',
	});

	SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
		var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
		if(hover[0] != null){
			if (ex) {
				var h = '1000px';
				hover[0].style.height = h;
			}
			else{
				hover[0].style.height = '';
			}
		}
	}
		
	if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
		// expand the dropdown options upon focus
		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
		});
	}

			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
		});
		
		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
		});

		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
		});

		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
		});

		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
		});

		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
			var selectElem = document.getElementById("{/literal}{$fields.type_of_interaction_c.name}{literal}");
			//if typed value is a valid option, do nothing
			for (i=0;i<selectElem.options.length;i++)
				if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
					return;
			
			//typed value is invalid, so set the text and the hidden to blank
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
			SyncToHidden(select_defaults[selectElem.id].key);
		});
	
	// when they click on the arrow image, toggle the visibility of the options
	SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
		if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
		} else {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
		}
	});

	SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
	});

	SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
	});

	// when they select an option, set the hidden input with the KEY, to be saved
	SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
		SyncToHidden(e.result.raw.key);
	});
 
});
</script> 
{/literal}
{/if}
</div>

<!-- [/hide] -->
</div>


<div class="col-xs-12 col-sm-6 edit-view-row-item">


<div class="col-xs-12 col-sm-4 label" data-label="LBL_ASSIGNED_TO_C">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO_C' module='Calls'}{/capture}
{$label|strip_semicolon}:

{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="varchar" field="assigned_to_c"  >
{counter name="panelFieldCount" print=false}

{if strlen($fields.assigned_to_c.value) <= 0}
{assign var="value" value=$fields.assigned_to_c.default_value }
{else}
{assign var="value" value=$fields.assigned_to_c.value }
{/if}  
<input type='text' name='{$fields.assigned_to_c.name}' 
id='{$fields.assigned_to_c.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
</div>

<!-- [/hide] -->
</div>
<div class="clear"></div>
<div class="clear"></div>



<div class="col-xs-12 col-sm-6 edit-view-row-item">


<div class="col-xs-12 col-sm-4 label" data-label="LBL_ACTIVITY_DATE">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_ACTIVITY_DATE' module='Calls'}{/capture}
{$label|strip_semicolon}:

<span class="required">*</span>
{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="date" field="activity_date_c"  >
{counter name="panelFieldCount" print=false}

<span class="dateTime">
{assign var=date_value value=$fields.activity_date_c.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.activity_date_c.name}" id="{$fields.activity_date_c.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
<button type="button" id="{$fields.activity_date_c.name}_trigger" class="btn btn-danger" onclick="return false;"><span class="suitepicon suitepicon-module-calendar" alt="{$APP.LBL_ENTER_DATE}"></span></button>
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.activity_date_c.name}",
form : "form_SubpanelQuickCreate_Calls",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.activity_date_c.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</div>

<!-- [/hide] -->
</div>


<div class="col-xs-12 col-sm-6 edit-view-row-item">


<div class="col-xs-12 col-sm-4 label" data-label="LBL_NEXT_DATE">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_NEXT_DATE' module='Calls'}{/capture}
{$label|strip_semicolon}:

<span class="required">*</span>
{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="date" field="next_date_c"  >
{counter name="panelFieldCount" print=false}

<span class="dateTime">
{assign var=date_value value=$fields.next_date_c.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.next_date_c.name}" id="{$fields.next_date_c.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
<button type="button" id="{$fields.next_date_c.name}_trigger" class="btn btn-danger" onclick="return false;"><span class="suitepicon suitepicon-module-calendar" alt="{$APP.LBL_ENTER_DATE}"></span></button>
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.next_date_c.name}",
form : "form_SubpanelQuickCreate_Calls",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.next_date_c.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</div>

<!-- [/hide] -->
</div>
<div class="clear"></div>
<div class="clear"></div>



<div class="col-xs-12 col-sm-6 edit-view-row-item">


<div class="col-xs-12 col-sm-4 label" data-label="LBL_LIST_RELATED_TO">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_LIST_RELATED_TO' module='Calls'}{/capture}
{$label|strip_semicolon}:

{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="parent" field="parent_name"  >
{counter name="panelFieldCount" print=false}

<select name='parent_type' tabindex="0" id='parent_type' title=''  onchange='document.{$form_name}.{$fields.parent_name.name}.value="";document.{$form_name}.parent_id.value=""; changeParentQS("{$fields.parent_name.name}"); checkParentType(document.{$form_name}.parent_type.value, document.{$form_name}.btn_{$fields.parent_name.name});'>
{html_options options=$fields.parent_name.options selected=$fields.parent_type.value sortoptions=true}
</select>
{if empty($fields.parent_name.options[$fields.parent_type.value])}
{assign var="keepParent" value = 0}
{else}
{assign var="keepParent" value = 1}
{/if}
<input type="text" name="{$fields.parent_name.name}" id="{$fields.parent_name.name}" class="sqsEnabled" tabindex="0"
size="" {if $keepParent}value="{$fields.parent_name.value}"{/if} autocomplete="off"><input type="hidden" name="{$fields.parent_id.name}" id="{$fields.parent_id.name}"  
{if $keepParent}value="{$fields.parent_id.value}"{/if}>
<span class="id-ff multiple">
<button type="button" name="btn_{$fields.parent_name.name}" id="btn_{$fields.parent_name.name}" tabindex="0"	
title="{sugar_translate label="LBL_SELECT_BUTTON_TITLE"}" class="button firstChild" value="{sugar_translate label="LBL_SELECT_BUTTON_LABEL"}"
onclick='open_popup(document.{$form_name}.parent_type.value, 600, 400, "", true, false, {literal}{"call_back_function":"set_return","form_name":"form_SubpanelQuickCreate_Calls","field_to_name_array":{"id":"parent_id","name":"parent_name"}}{/literal}, "single", true);' ><span class="suitepicon suitepicon-action-select"></span></button><button type="button" name="btn_clr_{$fields.parent_name.name}" id="btn_clr_{$fields.parent_name.name}" tabindex="0" title="{sugar_translate label=""}" class="button lastChild" onclick="this.form.{$fields.parent_name.name}.value = ''; this.form.{$fields.parent_id.name}.value = '';" value="{sugar_translate label=""}" ><span class="suitepicon suitepicon-action-clear"></span></button>
</span>
{literal}
<script type="text/javascript">
if (typeof(changeParentQS) == 'undefined'){
function changeParentQS(field) {
    if(typeof sqs_objects == 'undefined') {
       return;
    }
	field = YAHOO.util.Dom.get(field);
    var form = field.form;
    var sqsId = form.id + "_" + field.id;
    var typeField =  form.elements.parent_type;
    var new_module = typeField.value;
    //Update the SQS globals to reflect the new module choice
    if (typeof(QSFieldsArray[sqsId]) != 'undefined')
    {
        QSFieldsArray[sqsId].sqs.modules = new Array(new_module);
    }
	if(typeof QSProcessedFieldsArray != 'undefined')
    {
	   QSProcessedFieldsArray[sqsId] = false;
    }
    if(sqs_objects[sqsId] == undefined){
    	return;
    }
    sqs_objects[sqsId]["modules"] = new Array(new_module);
    if(typeof(disabledModules) != 'undefined' && typeof(disabledModules[new_module]) != 'undefined') {
		sqs_objects[sqsId]["disable"] = true;
		field.readOnly = true;
	} else {
		sqs_objects[sqsId]["disable"] = false;
		field.readOnly = false;
    }
    enableQS(false);
}}
</script>
<script>var disabledModules=[];</script>
<script language="javascript">if(typeof sqs_objects == 'undefined'){var sqs_objects = new Array;}sqs_objects['form_SubpanelQuickCreate_Calls_parent_name']={"form":"form_SubpanelQuickCreate_Calls","method":"query","modules":["{/literal}{if !empty($fields.parent_type.value)}{$fields.parent_type.value}{else}Accounts{/if}{literal}"],"group":"or","field_list":["name","id"],"populate_list":["parent_name","parent_id"],"required_list":["parent_id"],"conditions":[{"name":"name","op":"like_custom","end":"%","value":""}],"order":"name","limit":"30","no_match_text":"No Match"};</script>
<script>
//change this in case it wasn't the default on editing existing items.
$(document).ready(function(){
	changeParentQS("parent_name")
});
</script>
{/literal}
</div>

<!-- [/hide] -->
</div>


<div class="col-xs-12 col-sm-6 edit-view-row-item">


<div class="col-xs-12 col-sm-4 label" data-label="LBL_NAME_OF_PERSON">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_NAME_OF_PERSON' module='Calls'}{/capture}
{$label|strip_semicolon}:

{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="varchar" field="name_of_person_c"  >
{counter name="panelFieldCount" print=false}

{if strlen($fields.name_of_person_c.value) <= 0}
{assign var="value" value=$fields.name_of_person_c.default_value }
{else}
{assign var="value" value=$fields.name_of_person_c.value }
{/if}  
<input type='text' name='{$fields.name_of_person_c.name}' 
id='{$fields.name_of_person_c.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
</div>

<!-- [/hide] -->
</div>
<div class="clear"></div>
<div class="clear"></div>



<div class="col-xs-12 col-sm-6 edit-view-row-item">


<div class="col-xs-12 col-sm-4 label" data-label="LBL_FOR_QUICK_CREATE">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_FOR_QUICK_CREATE' module='Calls'}{/capture}
{$label|strip_semicolon}:

{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="varchar" field="for_quick_create_c"  >
{counter name="panelFieldCount" print=false}

{if strlen($fields.for_quick_create_c.value) <= 0}
{assign var="value" value=$fields.for_quick_create_c.default_value }
{else}
{assign var="value" value=$fields.for_quick_create_c.value }
{/if}  
<input type='text' name='{$fields.for_quick_create_c.name}' 
id='{$fields.for_quick_create_c.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
</div>

<!-- [/hide] -->
</div>


<div class="col-xs-12 col-sm-6 edit-view-row-item">
</div>
<div class="clear"></div>
<div class="clear"></div>



<div class="col-xs-12 col-sm-12 edit-view-row-item">


<div class="col-xs-12 col-sm-2 label" data-label="LBL_AUDIT_TRAIL">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_AUDIT_TRAIL' module='Calls'}{/capture}
{$label|strip_semicolon}:

{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="text" field="audit_trail_c" colspan='3' >
{counter name="panelFieldCount" print=false}

{if empty($fields.audit_trail_c.value)}
{assign var="value" value=$fields.audit_trail_c.default_value }
{else}
{assign var="value" value=$fields.audit_trail_c.value }
{/if}
<textarea  id='{$fields.audit_trail_c.name}' name='{$fields.audit_trail_c.name}'
rows="4"
cols="20"
title='' tabindex="0" 
 >{$value}</textarea>
{literal}{/literal}
</div>

<!-- [/hide] -->
</div>
<div class="clear"></div>



<div class="col-xs-12 col-sm-12 edit-view-row-item">


<div class="col-xs-12 col-sm-2 label" data-label="LBL_NEW_CURRENT_STATUS">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_NEW_CURRENT_STATUS' module='Calls'}{/capture}
{$label|strip_semicolon}:

<span class="required">*</span>
{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="text" field="new_current_status_c" colspan='3' >
{counter name="panelFieldCount" print=false}

{if empty($fields.new_current_status_c.value)}
{assign var="value" value=$fields.new_current_status_c.default_value }
{else}
{assign var="value" value=$fields.new_current_status_c.value }
{/if}
<textarea  id='{$fields.new_current_status_c.name}' name='{$fields.new_current_status_c.name}'
rows="6"
cols="80"
title='' tabindex="0" 
 >{$value}</textarea>
{literal}{/literal}
</div>

<!-- [/hide] -->
</div>
<div class="clear"></div>



<div class="col-xs-12 col-sm-12 edit-view-row-item">


<div class="col-xs-12 col-sm-2 label" data-label="LBL_DESCRIPTION">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_DESCRIPTION' module='Calls'}{/capture}
{$label|strip_semicolon}:

{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="text" field="description" colspan='3' >
{counter name="panelFieldCount" print=false}

{if empty($fields.description.value)}
{assign var="value" value=$fields.description.default_value }
{else}
{assign var="value" value=$fields.description.value }
{/if}
<textarea  id='{$fields.description.name}' name='{$fields.description.name}'
rows="6"
cols="80"
title='' tabindex="0" 
 >{$value}</textarea>
{literal}{/literal}
</div>

<!-- [/hide] -->
</div>
<div class="clear"></div>



<div class="col-xs-12 col-sm-12 edit-view-row-item">


<div class="col-xs-12 col-sm-2 label" data-label="LBL_NEW_KEY_ACTION">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_NEW_KEY_ACTION' module='Calls'}{/capture}
{$label|strip_semicolon}:

<span class="required">*</span>
{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="text" field="new_key_action_c" colspan='3' >
{counter name="panelFieldCount" print=false}

{if empty($fields.new_key_action_c.value)}
{assign var="value" value=$fields.new_key_action_c.default_value }
{else}
{assign var="value" value=$fields.new_key_action_c.value }
{/if}
<textarea  id='{$fields.new_key_action_c.name}' name='{$fields.new_key_action_c.name}'
rows="4"
cols="20"
title='' tabindex="0" 
 >{$value}</textarea>
{literal}{/literal}
</div>

<!-- [/hide] -->
</div>
<div class="clear"></div>
</div>                    </div>
</div>
</div>




<div class="panel panel-default">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse-edit" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
{sugar_translate label='LBL_EDITVIEW_PANEL1' module='Calls'}
</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="detailpanel_0" data-id="LBL_EDITVIEW_PANEL1">
<div class="tab-content">
<!-- tab_panel_content.tpl -->
<div class="row edit-view-row">



<div class="col-xs-12 col-sm-6 edit-view-row-item">


<div class="col-xs-12 col-sm-4 label" data-label="LBL_UNTAG">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_UNTAG' module='Calls'}{/capture}
{$label|strip_semicolon}:

{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="varchar" field="untag_c"  >
{counter name="panelFieldCount" print=false}

{if strlen($fields.untag_c.value) <= 0}
{assign var="value" value=$fields.untag_c.default_value }
{else}
{assign var="value" value=$fields.untag_c.value }
{/if}  
<input type='text' name='{$fields.untag_c.name}' 
id='{$fields.untag_c.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
</div>

<!-- [/hide] -->
</div>


<div class="col-xs-12 col-sm-6 edit-view-row-item">
</div>
<div class="clear"></div>
<div class="clear"></div>



<div class="col-xs-12 col-sm-6 edit-view-row-item">


<div class="col-xs-12 col-sm-4 label" data-label="LBL_TAG">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_TAG' module='Calls'}{/capture}
{$label|strip_semicolon}:

{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="varchar" field="tag_c"  >
{counter name="panelFieldCount" print=false}

{if strlen($fields.tag_c.value) <= 0}
{assign var="value" value=$fields.tag_c.default_value }
{else}
{assign var="value" value=$fields.tag_c.value }
{/if}  
<input type='text' name='{$fields.tag_c.name}' 
id='{$fields.tag_c.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
</div>

<!-- [/hide] -->
</div>


<div class="col-xs-12 col-sm-6 edit-view-row-item">
</div>
<div class="clear"></div>
<div class="clear"></div>



<div class="col-xs-12 col-sm-12 edit-view-row-item">


<div class="col-xs-12 col-sm-2 label" data-label="LBL_TAGGED_COMMENTS">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_TAGGED_COMMENTS' module='Calls'}{/capture}
{$label|strip_semicolon}:

{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="text" field="tagged_comments_c" colspan='3' >
{counter name="panelFieldCount" print=false}

{if empty($fields.tagged_comments_c.value)}
{assign var="value" value=$fields.tagged_comments_c.default_value }
{else}
{assign var="value" value=$fields.tagged_comments_c.value }
{/if}
<textarea  id='{$fields.tagged_comments_c.name}' name='{$fields.tagged_comments_c.name}'
rows="4"
cols="20"
title='' tabindex="0" 
 >{$value}</textarea>
{literal}{/literal}
</div>

<!-- [/hide] -->
</div>
<div class="clear"></div>



<div class="col-xs-12 col-sm-6 edit-view-row-item">


<div class="col-xs-12 col-sm-4 label" data-label="LBL_TAG_HIDDEN">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_TAG_HIDDEN' module='Calls'}{/capture}
{$label|strip_semicolon}:

{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="varchar" field="tag_hidden_c"  >
{counter name="panelFieldCount" print=false}

{if strlen($fields.tag_hidden_c.value) <= 0}
{assign var="value" value=$fields.tag_hidden_c.default_value }
{else}
{assign var="value" value=$fields.tag_hidden_c.value }
{/if}  
<input type='text' name='{$fields.tag_hidden_c.name}' 
id='{$fields.tag_hidden_c.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
</div>

<!-- [/hide] -->
</div>


<div class="col-xs-12 col-sm-6 edit-view-row-item">


<div class="col-xs-12 col-sm-4 label" data-label="LBL_UNTAG_HIDDEN">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_UNTAG_HIDDEN' module='Calls'}{/capture}
{$label|strip_semicolon}:

{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="varchar" field="untag_hidden_c"  >
{counter name="panelFieldCount" print=false}

{if strlen($fields.untag_hidden_c.value) <= 0}
{assign var="value" value=$fields.untag_hidden_c.default_value }
{else}
{assign var="value" value=$fields.untag_hidden_c.value }
{/if}  
<input type='text' name='{$fields.untag_hidden_c.name}' 
id='{$fields.untag_hidden_c.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
</div>

<!-- [/hide] -->
</div>
<div class="clear"></div>
<div class="clear"></div>



<div class="col-xs-12 col-sm-12 edit-view-row-item">


<div class="col-xs-12 col-sm-2 label" data-label="LBL_ASSIGNED_TO_NAME">

{minify}
{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='Calls'}{/capture}
{$label|strip_semicolon}:

{/minify}
</div>

<div class="col-xs-12 col-sm-8 edit-view-field " type="relate" field="assigned_user_name" colspan='3' >
{counter name="panelFieldCount" print=false}

<input type="text" name="{$fields.assigned_user_name.name}" class="sqsEnabled" tabindex="0" id="{$fields.assigned_user_name.name}" size="" value="{$fields.assigned_user_name.value}" title='' autocomplete="off"  	 >
<input type="hidden" name="{$fields.assigned_user_name.id_name}" 
id="{$fields.assigned_user_name.id_name}" 
value="{$fields.assigned_user_id.value}">
<span class="id-ff multiple">
<button type="button" name="btn_{$fields.assigned_user_name.name}" id="btn_{$fields.assigned_user_name.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_SELECT_USERS_TITLE"}" class="button firstChild" value="{sugar_translate label="LBL_ACCESSKEY_SELECT_USERS_LABEL"}"
onclick='open_popup(
"{$fields.assigned_user_name.module}", 
600, 
395,
"", 
true, 
false, 
{literal}{"call_back_function":"set_return","form_name":"form_SubpanelQuickCreate_Calls","field_to_name_array":{"id":"assigned_user_id","user_name":"assigned_user_name"}}{/literal}, 
"single", 
true
);' ><span class="suitepicon suitepicon-action-select"></span></button><button type="button" name="btn_clr_{$fields.assigned_user_name.name}" id="btn_clr_{$fields.assigned_user_name.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_CLEAR_USERS_TITLE"}"  class="button lastChild"
onclick="SUGAR.clearRelateField(this.form, '{$fields.assigned_user_name.name}', '{$fields.assigned_user_name.id_name}');"  value="{sugar_translate label="LBL_ACCESSKEY_CLEAR_USERS_LABEL"}" ><span class="suitepicon suitepicon-action-clear"></span></button>
</span>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['{$form_name}_{$fields.assigned_user_name.name}']) != 'undefined'",
		enableQS
);
</script>
</div>

<!-- [/hide] -->
</div>
<div class="clear"></div>
</div>                    </div>
</div>
</div>
</div>
</div>

<script language="javascript">
    var _form_id = '{$form_id}';
    {literal}
    SUGAR.util.doWhen(function(){
        _form_id = (_form_id == '') ? 'EditView' : _form_id;
        return document.getElementById(_form_id) != null;
    }, SUGAR.themes.actionMenu);
    {/literal}
</script>
{assign var='place' value="_FOOTER"} <!-- to be used for id for buttons with custom code in def files-->
<div class="buttons">
{if $bean->aclAccess("save")}<input title="{$APP.LBL_SAVE_BUTTON_TITLE}"  class="button" onclick="var _form = document.getElementById('form_SubpanelQuickCreate_Calls'); disableOnUnloadEditView(); _form.action.value='Save';if(check_form('form_SubpanelQuickCreate_Calls'))return SUGAR.subpanelUtils.inlineSave(_form.id, 'Calls_subpanel_save_button');return false;" type="submit" name="Calls_subpanel_save_button" id="Calls_subpanel_save_button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">{/if} 
<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" class="button" onclick="return SUGAR.subpanelUtils.cancelCreate($(this).attr('id'));return false;" type="submit" name="Calls_subpanel_cancel_button" id="Calls_subpanel_cancel_button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}"> 
<input title="{$APP.LBL_FULL_FORM_BUTTON_TITLE}" class="button" onclick="var _form = document.getElementById('form_SubpanelQuickCreate_Calls'); disableOnUnloadEditView(_form); _form.return_action.value='DetailView'; _form.action.value='EditView'; if(typeof(_form.to_pdf)!='undefined') _form.to_pdf.value='0';" type="submit" name="Calls_subpanel_full_form_button" id="Calls_subpanel_full_form_button" value="{$APP.LBL_FULL_FORM_BUTTON_LABEL}"> <input type="hidden" name="full_form" value="full_form">
{if $showVCRControl}
<button type="button" id="save_and_continue" class="button saveAndContinue" title="{$app_strings.LBL_SAVE_AND_CONTINUE}" onClick="SUGAR.saveAndContinue(this);">
{$APP.LBL_SAVE_AND_CONTINUE}
</button>
{/if}
{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Calls", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}
</div>
</form>
{$set_focus_block}
<!-- Begin Meta-Data Javascript -->
<script type="text/javascript">{$JSON_CONFIG_JAVASCRIPT}</script>{sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}<script>toggle_portal_flag();function toggle_portal_flag()  {literal} { {/literal} {$TOGGLE_JS} {literal} } {/literal} </script>
<!-- End Meta-Data Javascript -->
<script>SUGAR.util.doWhen("document.getElementById('EditView') != null",
        function(){ldelim}SUGAR.util.buildAccessKeyLabels();{rdelim});
</script>
<script type="text/javascript">
YAHOO.util.Event.onContentReady("form_SubpanelQuickCreate_Calls",
    function () {ldelim} initEditView(document.forms.form_SubpanelQuickCreate_Calls) {rdelim});
//window.setTimeout(, 100);
window.onbeforeunload = function () {ldelim} return onUnloadEditView(); {rdelim};
// bug 55468 -- IE is too aggressive with onUnload event
if ($.browser.msie) {ldelim}
$(document).ready(function() {ldelim}
    $(".collapseLink,.expandLink").click(function (e) {ldelim} e.preventDefault(); {rdelim});
  {rdelim});
{rdelim}
</script>
{literal}
<script type="text/javascript">

    var selectTab = function(tab) {
        $('#EditView_tabs div.tab-content div.tab-pane-NOBOOTSTRAPTOGGLER').hide();
        $('#EditView_tabs div.tab-content div.tab-pane-NOBOOTSTRAPTOGGLER').eq(tab).show().addClass('active').addClass('in');
        $('#EditView_tabs div.panel-content div.panel').hide();
        $('#EditView_tabs div.panel-content div.panel.tab-panel-' + tab).show()
    };

    var selectTabOnError = function(tab) {
        selectTab(tab);
        $('#EditView_tabs ul.nav.nav-tabs li').removeClass('active');
        $('#EditView_tabs ul.nav.nav-tabs li a').css('color', '');

        $('#EditView_tabs ul.nav.nav-tabs li').eq(tab).find('a').first().css('color', 'red');
        $('#EditView_tabs ul.nav.nav-tabs li').eq(tab).addClass('active');

    };

    var selectTabOnErrorInputHandle = function(inputHandle) {
        var tab = $(inputHandle).closest('.tab-pane-NOBOOTSTRAPTOGGLER').attr('id').match(/^detailpanel_(.*)$/)[1];
        selectTabOnError(tab);
    };


    $(function(){
        $('#EditView_tabs ul.nav.nav-tabs li > a[data-toggle="tab"]').click(function(e){
            if(typeof $(this).parent().find('a').first().attr('id') != 'undefined') {
                var tab = parseInt($(this).parent().find('a').first().attr('id').match(/^tab(.)*$/)[1]);
                selectTab(tab);
            }
        });

        $('a[data-toggle="collapse-edit"]').click(function(e){
            if($(this).hasClass('collapsed')) {
              // Expand panel
                // Change style of .panel-header
                $(this).removeClass('collapsed');
                // Expand .panel-body
                $(this).parents('.panel').find('.panel-body').removeClass('in').addClass('in');
            } else {
              // Collapse panel
                // Change style of .panel-header
                $(this).addClass('collapsed');
                // Collapse .panel-body
                $(this).parents('.panel').find('.panel-body').removeClass('in').removeClass('in');
            }
        });
    });

    </script>
{/literal}{literal}
<script type="text/javascript">
addForm('form_SubpanelQuickCreate_Calls');addToValidate('form_SubpanelQuickCreate_Calls', 'name', 'name', true,'{/literal}{sugar_translate label='LBL_SUBJECT' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'date_entered_date', 'date', false,'Date Created' );
addToValidate('form_SubpanelQuickCreate_Calls', 'date_modified_date', 'date', false,'Date Modified' );
addToValidate('form_SubpanelQuickCreate_Calls', 'modified_user_id', 'assigned_user_name', false,'{/literal}{sugar_translate label='LBL_MODIFIED' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'modified_by_name', 'relate', false,'{/literal}{sugar_translate label='LBL_MODIFIED_NAME' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'created_by', 'assigned_user_name', false,'{/literal}{sugar_translate label='LBL_CREATED' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'created_by_name', 'relate', false,'{/literal}{sugar_translate label='LBL_CREATED' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'description', 'text', false,'{/literal}{sugar_translate label='LBL_DESCRIPTION' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'deleted', 'bool', false,'{/literal}{sugar_translate label='LBL_DELETED' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'assigned_user_id', 'relate', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO_ID' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'assigned_user_name', 'relate', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'duration_hours', 'int', true,'{/literal}{sugar_translate label='LBL_DURATION_HOURS' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'duration_minutes', 'int', false,'{/literal}{sugar_translate label='LBL_DURATION_MINUTES' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'date_start_date', 'date', true,'Start Date' );
addToValidate('form_SubpanelQuickCreate_Calls', 'date_end_date', 'date', false,'End Date' );
addToValidate('form_SubpanelQuickCreate_Calls', 'parent_type', 'parent_type', false,'{/literal}{sugar_translate label='LBL_PARENT_TYPE' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'parent_name', 'parent', false,'{/literal}{sugar_translate label='LBL_LIST_RELATED_TO' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'status', 'enum', true,'{/literal}{sugar_translate label='LBL_STATUS' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'direction', 'enum', false,'{/literal}{sugar_translate label='LBL_DIRECTION' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'parent_id', 'id', false,'{/literal}{sugar_translate label='LBL_LIST_RELATED_TO_ID' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'reminder_checked', 'bool', false,'{/literal}{sugar_translate label='LBL_REMINDER' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'reminder_time', 'enum', false,'{/literal}{sugar_translate label='LBL_REMINDER_TIME' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'email_reminder_checked', 'bool', false,'{/literal}{sugar_translate label='LBL_EMAIL_REMINDER' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'email_reminder_time', 'enum', false,'{/literal}{sugar_translate label='LBL_EMAIL_REMINDER_TIME' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'email_reminder_sent', 'bool', false,'{/literal}{sugar_translate label='LBL_EMAIL_REMINDER_SENT' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'reminders', 'function', false,'{/literal}{sugar_translate label='LBL_REMINDER' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'outlook_id', 'varchar', false,'{/literal}{sugar_translate label='LBL_OUTLOOK_ID' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'accept_status', 'varchar', false,'{/literal}{sugar_translate label='LBL_ACCEPT_STATUS' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'set_accept_links', 'varchar', false,'{/literal}{sugar_translate label='LBL_ACCEPT_LINK' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'contact_name', 'relate', false,'{/literal}{sugar_translate label='LBL_CONTACT_NAME' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'repeat_type', 'enum', false,'{/literal}{sugar_translate label='LBL_REPEAT_TYPE' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'repeat_interval', 'int', false,'{/literal}{sugar_translate label='LBL_REPEAT_INTERVAL' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'repeat_dow', 'varchar', false,'{/literal}{sugar_translate label='LBL_REPEAT_DOW' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'repeat_until', 'date', false,'{/literal}{sugar_translate label='LBL_REPEAT_UNTIL' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'repeat_count', 'int', false,'{/literal}{sugar_translate label='LBL_REPEAT_COUNT' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'repeat_parent_id', 'id', false,'{/literal}{sugar_translate label='LBL_REPEAT_PARENT_ID' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'recurring_source', 'varchar', false,'{/literal}{sugar_translate label='LBL_RECURRING_SOURCE' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'reschedule_history', 'varchar', false,'{/literal}{sugar_translate label='LBL_RESCHEDULE_HISTORY' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'reschedule_count', 'varchar', false,'{/literal}{sugar_translate label='LBL_RESCHEDULE_COUNT' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'status_new_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_STATUS_NEW' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'tag_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_TAG' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'approver_c', 'relate', false,'{/literal}{sugar_translate label='LBL_APPROVER' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'untag_hidden_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_UNTAG_HIDDEN' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'assigned_to_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO_C' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'user_id_c', 'id', false,'{/literal}{sugar_translate label='LBL_APPROVER_USER_ID' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'untag_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_UNTAG' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'tag_hidden_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_TAG_HIDDEN' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'audit_trail_c', 'text', false,'{/literal}{sugar_translate label='LBL_AUDIT_TRAIL' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'tagged_comments_c', 'text', false,'{/literal}{sugar_translate label='LBL_TAGGED_COMMENTS' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'activity_type_c', 'enum', false,'{/literal}{sugar_translate label='LBL_ACTIVITY_TYPE' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'new_current_status_c', 'text', true,'{/literal}{sugar_translate label='LBL_NEW_CURRENT_STATUS' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'type_of_interaction_c', 'enum', true,'{/literal}{sugar_translate label='LBL_TYPE_OF_INTERACTION' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'activity_date_c', 'date', true,'{/literal}{sugar_translate label='LBL_ACTIVITY_DATE' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'edit_purpose_field_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_EDIT_PURPOSE_FIELD' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'for_quick_create_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_FOR_QUICK_CREATE' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'key_action_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_KEY_ACTION' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'name_of_person_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_NAME_OF_PERSON' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'new_key_action_c', 'text', true,'{/literal}{sugar_translate label='LBL_NEW_KEY_ACTION' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'new_status_c', 'enum', false,'{/literal}{sugar_translate label='LBL_NEW_STATUS' module='Calls' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_Calls', 'next_date_c', 'date', true,'{/literal}{sugar_translate label='LBL_NEXT_DATE' module='Calls' for_js=true}{literal}' );
addToValidateBinaryDependency('form_SubpanelQuickCreate_Calls', 'assigned_user_name', 'alpha', false,'{/literal}{sugar_translate label='ERR_SQS_NO_MATCH_FIELD' module='Calls' for_js=true}{literal}: {/literal}{sugar_translate label='LBL_ASSIGNED_TO' module='Calls' for_js=true}{literal}', 'assigned_user_id' );
addToValidateBinaryDependency('form_SubpanelQuickCreate_Calls', 'approver_c', 'alpha', false,'{/literal}{sugar_translate label='ERR_SQS_NO_MATCH_FIELD' module='Calls' for_js=true}{literal}: {/literal}{sugar_translate label='LBL_APPROVER' module='Calls' for_js=true}{literal}', 'user_id_c' );
</script><script language="javascript">if(typeof sqs_objects == 'undefined'){var sqs_objects = new Array;}sqs_objects['form_SubpanelQuickCreate_Calls_approver_c']={"form":"form_SubpanelQuickCreate_Calls","method":"query","modules":["Users"],"group":"or","field_list":["name","id"],"populate_list":["approver_c","user_id_c"],"required_list":["parent_id"],"conditions":[{"name":"name","op":"like_custom","end":"%","value":""}],"order":"name","limit":"30","no_match_text":"No Match"};sqs_objects['form_SubpanelQuickCreate_Calls_parent_name']={"form":"form_SubpanelQuickCreate_Calls","method":"query","modules":["Accounts"],"group":"or","field_list":["name","id"],"populate_list":["parent_name","parent_id"],"required_list":["parent_id"],"conditions":[{"name":"name","op":"like_custom","end":"%","value":""}],"order":"name","limit":"30","no_match_text":"No Match"};sqs_objects['form_SubpanelQuickCreate_Calls_assigned_user_name']={"form":"form_SubpanelQuickCreate_Calls","method":"get_user_array","field_list":["user_name","id"],"populate_list":["assigned_user_name","assigned_user_id"],"required_list":["assigned_user_id"],"conditions":[{"name":"user_name","op":"like_custom","end":"%","value":""}],"limit":"30","no_match_text":"No Match"};</script>{/literal}
