{if $fields.id.value != ''}
<br>
{foreach from=$filename key=k item=v}
<label name={$v.id}>{$v.value} : </label>
   <a href='#' name={$v.id} class='tabDetailViewDFLink downloadAttachment'>{$v.filename} &nbsp<i class="glyphicon glyphicon-eye-open"></i></a><br />
{/foreach}
{/if}