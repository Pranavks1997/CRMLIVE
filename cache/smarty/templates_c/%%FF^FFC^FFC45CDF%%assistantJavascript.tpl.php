<?php /* Smarty version 2.6.31, created on 2021-03-12 18:27:08
         compiled from modules/ModuleBuilder/tpls/assistantJavascript.tpl */ ?>
<script>
<?php echo '
if(typeof(Assistant)!="undefined" && Assistant.mbAssistant){
	//Assistant.mbAssistant.render(document.body);
'; ?>

<?php if ($this->_tpl_vars['userPref']): ?>
	<?php echo 'Assistant.processUserPref("'; ?>
<?php echo $this->_tpl_vars['userPref']; ?>
<?php echo '");'; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['assistant']['key'] && $this->_tpl_vars['assistant']['group']): ?>
	<?php echo 'Assistant.mbAssistant.setBody(SUGAR.language.get(\'ModuleBuilder\',\'assistantHelp\').'; ?>
<?php echo $this->_tpl_vars['assistant']['group']; ?>
<?php echo '.'; ?>
<?php echo $this->_tpl_vars['assistant']['key']; ?>
<?php echo ');'; ?>

<?php endif; ?>
<?php echo '
	if(Assistant.mbAssistant.visible){
		Assistant.mbAssistant.show();
		}
}
'; ?>

</script>