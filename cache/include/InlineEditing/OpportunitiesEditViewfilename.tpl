
<script type="text/javascript" src='include/SugarFields/Fields/File/SugarFieldFile.js?v=fVRQvLcs9P37pXNVZx1n0A'></script>

{if !empty($fields.filename.value) }
    {assign var=showRemove value=true}
{else}
    {assign var=showRemove value=false}
{/if}

    {assign var=noChange value=false}

<input type="hidden" name="deleteAttachment" value="0">
<input type="hidden" name="{$fields.filename.name}" id="{$fields.filename.name}" value="{$fields.filename.value}">
<span id="{$fields.filename.name}_old" style="display:{if !$showRemove}none;{/if}">
  <a href="index.php?entryPoint=download&id={$fields.id.value}&type={$module}" class="tabDetailViewDFLink">{$fields.filename.value}</a>

{if !$noChange}
<input type='button' class='button' id='remove_button' value='{$APP.LBL_REMOVE}' onclick='SUGAR.field.file.deleteAttachment("{$fields.filename.name}","",this);'>
{/if}
</span>
{if !$noChange}
<span id="{$fields.filename.name}_new" style="display:{if $showRemove}none;{/if}">
<input type="hidden" name="{$fields.filename.name}_escaped">
<input id="{$fields.filename.name}_file" name="{$fields.filename.name}_file" 
type="file" title='' size="30"
 
    maxlength='255'
>

{else}



{/if}


</span>