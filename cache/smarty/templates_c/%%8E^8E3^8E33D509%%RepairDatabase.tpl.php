<?php /* Smarty version 2.6.31, created on 2021-03-23 12:28:21
         compiled from modules/Administration/templates/RepairDatabase.tpl */ ?>

<h3 class="error" style="width:100%"><?php echo $this->_tpl_vars['MOD']['LBL_REPAIR_DATABASE_DIFFERENCES']; ?>
</h3>
<p><?php echo $this->_tpl_vars['MOD']['LBL_REPAIR_DATABASE_TEXT']; ?>
</p>
<form name="RepairDatabaseForm" method="post">
<input type="hidden" name="module" value="Administration"/>
<input type="hidden" name="action" value="repairDatabase"/>
<input type="hidden" name="raction" value="execute"/>
<textarea name="sql" rows="14" cols="150" id="repairsql"><?php echo $this->_tpl_vars['qry_str']; ?>
</textarea>
<br/>
<input type="button" class="button" value="<?php echo $this->_tpl_vars['MOD']['LBL_REPAIR_DATABASE_EXECUTE']; ?>
" onClick="document.RepairDatabaseForm.submit();"/> 
<input type="button" class="button" value="<?php echo $this->_tpl_vars['MOD']['LBL_REPAIR_DATABASE_EXPORT']; ?>
" onClick="document.RepairDatabaseForm.raction.value='export'; document.RepairDatabaseForm.submit();"/>
<script>document.getElementById('repairsql').scrollIntoView(false);</script>