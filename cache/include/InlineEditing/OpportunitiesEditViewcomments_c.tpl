
{if strlen($fields.comments_c.value) <= 0}
{assign var="value" value=$fields.comments_c.default_value }
{else}
{assign var="value" value=$fields.comments_c.value }
{/if}  
<input type='text' name='{$fields.comments_c.name}' 
    id='{$fields.comments_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >