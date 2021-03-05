<?php /* Smarty version 2.6.31, created on 2021-02-20 06:23:01
         compiled from modules/Calls/tpls/additionalDetails.caption.tpl */ ?>
<div id="qtip-6-title" class="qtip-title" aria-atomic="true">
    <div class="qtip-title-text">
       <?php echo $this->_tpl_vars['FIELD']['NAME']; ?>

    </div>
    <?php if ($this->_tpl_vars['PARAM']['show_buttons'] != 'false'): ?>
    <div class="qtip-title-buttons">
        <?php if ($this->_tpl_vars['ACL_EDIT_VIEW'] == true): ?><a href="index.php?action=DetailView&module=<?php echo $this->_tpl_vars['MODULE_NAME']; ?>
&record=<?php echo $this->_tpl_vars['FIELD']['ID']; ?>
" class="btn btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a><?php endif; ?>
        <?php if ($this->_tpl_vars['ACL_DETAIL_VIEW'] == true): ?><a href="index.php?action=EditView&module=<?php echo $this->_tpl_vars['MODULE_NAME']; ?>
&record=<?php echo $this->_tpl_vars['FIELD']['ID']; ?>
" class="btn btn-xs"><span class="glyphicon glyphicon-pencil"></span></a><?php endif; ?>
    </div>
    <?php endif; ?>
</div>