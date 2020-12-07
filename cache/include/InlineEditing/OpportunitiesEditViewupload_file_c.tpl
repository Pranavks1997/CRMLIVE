


<script type="text/javascript">
    {literal}
        $( document ).ready(function() {
        $( "form#EditView" )
        .attr( "enctype", "multipart/form-data" )
        .attr( "encoding", "multipart/form-data" );
    });
{/literal}
</script>
<script type="text/javascript" src='include/SugarFields/Fields/Image/SugarFieldFile.js?v=fVRQvLcs9P37pXNVZx1n0A'></script>

{if !empty($fields.upload_file_c.value) }
    {assign var=showRemove value=true}
{else}
    {assign var=showRemove value=false}
{/if}

{assign var=noChange value=false}

<input type="hidden" name="deleteAttachment" value="0">
<input type="hidden" name="{$fields.upload_file_c.name}" id="{$fields.upload_file_c.name}" value="{$fields.upload_file_c.value}">
<input type="hidden" name="{$fields.upload_file_c.name}_record_id" id="{$fields.upload_file_c.name}_record_id" value="{$fields.id.value}">
<span id="{$fields.upload_file_c.name}_old" style="display:{if !$showRemove}none;{/if}">
  <a href="index.php?entryPoint=download&id={$fields.id.value}_{$fields.upload_file_c.name}&type={$module}&time={$fields.date_modified.value}" class="tabDetailViewDFLink">{$fields.upload_file_c.value}</a>

        {if !$noChange}
        <input type='button' class='button' id='remove_button' value='{$APP.LBL_REMOVE}' onclick='SUGAR.field.file.deleteAttachment("{$fields.upload_file_c.name}","",this);'>
    {/if}
</span>
{if !$noChange}
<span id="{$fields.upload_file_c.name}_new" style="display:{if $showRemove}none;{/if}">
<input type="hidden" name="{$fields.upload_file_c.name}_escaped">
<input id="{$fields.upload_file_c.name}_file" name="{$fields.upload_file_c.name}_file"
       type="file" title='' size="30"
                       maxlength='255'
                >

    {else}



{/if}

<script type="text/javascript">
$( "#{$fields.upload_file_c.name}_file{literal} " ).change(function() {
        $("#{/literal}{$fields.upload_file_c.name}{literal}").val($("#{/literal}{$fields.upload_file_c.name}_file{literal}").val());
});{/literal}
        </script>


</span>