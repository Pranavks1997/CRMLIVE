<?php /* Smarty version 2.6.31, created on 2021-03-18 10:54:38
         compiled from cache/themes/SuiteP/modules/Opportunities/DetailView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_include', 'cache/themes/SuiteP/modules/Opportunities/DetailView.tpl', 38, false),array('function', 'sugar_translate', 'cache/themes/SuiteP/modules/Opportunities/DetailView.tpl', 47, false),array('function', 'counter', 'cache/themes/SuiteP/modules/Opportunities/DetailView.tpl', 142, false),array('function', 'multienum_to_array', 'cache/themes/SuiteP/modules/Opportunities/DetailView.tpl', 731, false),array('function', 'sugar_number_format', 'cache/themes/SuiteP/modules/Opportunities/DetailView.tpl', 1443, false),array('modifier', 'strip_semicolon', 'cache/themes/SuiteP/modules/Opportunities/DetailView.tpl', 135, false),array('modifier', 'escape', 'cache/themes/SuiteP/modules/Opportunities/DetailView.tpl', 798, false),array('modifier', 'url2html', 'cache/themes/SuiteP/modules/Opportunities/DetailView.tpl', 798, false),array('modifier', 'nl2br', 'cache/themes/SuiteP/modules/Opportunities/DetailView.tpl', 798, false),)), $this); ?>


<script language="javascript">
    <?php echo '
    SUGAR.util.doWhen(function () {
        return $("#contentTable").length == 0;
    }, SUGAR.themes.actionMenu);
    '; ?>

</script>
<table cellpadding="0" cellspacing="0" border="0" width="100%" id="">
<tr>
<td class="buttons" align="left" NOWRAP width="80%">
<div class="actionsContainer">
<form action="index.php" method="post" name="DetailView" id="formDetailView">
<input type="hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
<input type="hidden" name="record" value="<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
">
<input type="hidden" name="return_action">
<input type="hidden" name="return_module">
<input type="hidden" name="return_id">
<input type="hidden" name="module_tab">
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="offset" value="<?php echo $this->_tpl_vars['offset']; ?>
">
<input type="hidden" name="action" value="EditView">
<input type="hidden" name="sugar_body_only">
<?php if (! $this->_tpl_vars['config']['enable_action_menu']): ?>
<div class="buttons">
<?php if ($this->_tpl_vars['bean']->aclAccess('edit')): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_KEY']; ?>
" class="button primary" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Opportunities'; _form.return_action.value='DetailView'; _form.return_id.value='<?php echo $this->_tpl_vars['id']; ?>
'; _form.action.value='EditView';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Edit" id="edit_button" value="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_LABEL']; ?>
"><?php endif; ?> 
<?php if ($this->_tpl_vars['bean']->aclAccess('delete')): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_KEY']; ?>
" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Opportunities'; _form.return_action.value='ListView'; _form.action.value='Delete'; if(confirm('<?php echo $this->_tpl_vars['APP']['NTC_DELETE_CONFIRMATION']; ?>
')) SUGAR.ajaxUI.submitForm(_form); return false;" type="submit" name="Delete" value="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_LABEL']; ?>
" id="delete_button"><?php endif; ?> 
<?php if ($this->_tpl_vars['bean']->aclAccess('detail')): ?><?php if (! empty ( $this->_tpl_vars['fields']['id']['value'] ) && $this->_tpl_vars['isAuditEnabled']): ?><input id="btn_view_change_log" title="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
" class="button" onclick='open_popup("Audit", "600", "400", "&record=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&module_name=Opportunities", true, false,  { "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] } ); return false;' type="button" value="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
"><?php endif; ?><?php endif; ?>
</div>                    <?php endif; ?>
</form>
</div>
</td>
<td align="right" width="20%" class="buttons"><?php echo $this->_tpl_vars['ADMIN_EDIT']; ?>

</td>
</tr>
</table>
<?php echo smarty_function_sugar_include(array('include' => $this->_tpl_vars['includes']), $this);?>

<div class="detail-view">
<div class="mobile-pagination"><?php echo $this->_tpl_vars['PAGINATION']; ?>
</div>

<ul class="nav nav-tabs">


<li role="presentation" class="active">
<a id="tab0" data-toggle="tab" class="hidden-xs">
<?php echo smarty_function_sugar_translate(array('label' => 'DEFAULT','module' => 'Opportunities'), $this);?>

</a>


<a id="xstab0" href="#" class="visible-xs first-tab dropdown-toggle" data-toggle="dropdown">
<?php echo smarty_function_sugar_translate(array('label' => 'DEFAULT','module' => 'Opportunities'), $this);?>

</a>
</li>














<?php if ($this->_tpl_vars['config']['enable_action_menu'] && $this->_tpl_vars['config']['enable_action_menu'] != false): ?>
<li id="tab-actions" class="dropdown">
<a class="dropdown-toggle" data-toggle="dropdown" href="#">ACTIONS<span class="suitepicon suitepicon-action-caret"></span></a>
<ul class="dropdown-menu">
<li><?php if ($this->_tpl_vars['bean']->aclAccess('edit')): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_KEY']; ?>
" class="button primary" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Opportunities'; _form.return_action.value='DetailView'; _form.return_id.value='<?php echo $this->_tpl_vars['id']; ?>
'; _form.action.value='EditView';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Edit" id="edit_button" value="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_LABEL']; ?>
"><?php endif; ?> </li>
<li><?php if ($this->_tpl_vars['bean']->aclAccess('delete')): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_KEY']; ?>
" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Opportunities'; _form.return_action.value='ListView'; _form.action.value='Delete'; if(confirm('<?php echo $this->_tpl_vars['APP']['NTC_DELETE_CONFIRMATION']; ?>
')) SUGAR.ajaxUI.submitForm(_form); return false;" type="submit" name="Delete" value="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_LABEL']; ?>
" id="delete_button"><?php endif; ?> </li>
<li><?php if ($this->_tpl_vars['bean']->aclAccess('detail')): ?><?php if (! empty ( $this->_tpl_vars['fields']['id']['value'] ) && $this->_tpl_vars['isAuditEnabled']): ?><input id="btn_view_change_log" title="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
" class="button" onclick='open_popup("Audit", "600", "400", "&record=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&module_name=Opportunities", true, false,  { "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] } ); return false;' type="button" value="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
"><?php endif; ?><?php endif; ?></li>
</ul>        </li>
<li class="tab-inline-pagination">
<?php echo $this->_tpl_vars['PAGINATION']; ?>

</li>
<?php endif; ?>
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


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_RFP/EOIPUBLISHED','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="rfporeoipublished_c" >

<?php if (! $this->_tpl_vars['fields']['rfporeoipublished_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['rfporeoipublished_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['rfporeoipublished_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['rfporeoipublished_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['rfporeoipublished_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['rfporeoipublished_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['rfporeoipublished_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['rfporeoipublished_c']['options'][$this->_tpl_vars['fields']['rfporeoipublished_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_FILENAME','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="file" field="filename" >

<?php if (! $this->_tpl_vars['fields']['filename']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['filename']['name']; ?>
">
<a href="index.php?entryPoint=download&id=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&type=<?php echo $this->_tpl_vars['module']; ?>
" class="tabDetailViewDFLink" target='_blank'><?php echo $this->_tpl_vars['fields']['filename']['value']; ?>
</a>
&nbsp;
<a href="index.php?preview=yes&entryPoint=download&id=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&type=<?php echo $this->_tpl_vars['module']; ?>
" class="tabDetailViewDFLink" target='_blank' style="border-bottom: 0px;">
<i class="glyphicon glyphicon-eye-open"></i>
</a>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_TYPE','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="opportunity_type" >

<?php if (! $this->_tpl_vars['fields']['opportunity_type']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['opportunity_type']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['opportunity_type']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['opportunity_type']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['opportunity_type']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['opportunity_type']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['opportunity_type']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['opportunity_type']['options'][$this->_tpl_vars['fields']['opportunity_type']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_STATUS','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="status_c" >

<?php if (! $this->_tpl_vars['fields']['status_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['status_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['status_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['status_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['status_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['status_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['status_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['status_c']['options'][$this->_tpl_vars['fields']['status_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_APPLYFOR','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="applyfor_c" >

<?php if (! $this->_tpl_vars['fields']['applyfor_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['applyfor_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['applyfor_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['applyfor_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['applyfor_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['applyfor_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['applyfor_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['applyfor_c']['options'][$this->_tpl_vars['fields']['applyfor_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNED_TO','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="relate" field="assigned_user_name" >

<?php if (! $this->_tpl_vars['fields']['assigned_user_name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span id="assigned_user_id" class="sugar_field" data-id-value="<?php echo $this->_tpl_vars['fields']['assigned_user_id']['value']; ?>
"><?php echo $this->_tpl_vars['fields']['assigned_user_name']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>

</div>
                    </div>
</div>

<div class="panel-content">
<div>&nbsp;</div>







<?php if ($this->_tpl_vars['config']['enable_action_menu'] && $this->_tpl_vars['config']['enable_action_menu'] != false): ?>

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-0" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
<?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_PANEL3','module' => 'Opportunities'), $this);?>

</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-0"  data-id="LBL_EDITVIEW_PANEL3">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_OPPORTUNITY_NAME','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="name" field="name" >

<?php if (! $this->_tpl_vars['fields']['name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['name']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['name']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['name']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['name']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['name']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'Approver','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="relate" field="select_approver_c" >

<?php if (! $this->_tpl_vars['fields']['select_approver_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span id="user_id2_c" class="sugar_field" data-id-value="<?php echo $this->_tpl_vars['fields']['user_id2_c']['value']; ?>
"><?php echo $this->_tpl_vars['fields']['select_approver_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_INTERNATIONAL','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="radioenum" field="international_c" >

<?php if (! $this->_tpl_vars['fields']['international_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['international_c']['name']; ?>
">
<?php echo $this->_tpl_vars['fields']['international_c']['options'][$this->_tpl_vars['fields']['international_c']['value']]; ?>

</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_CURRENCY','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="currency_c" >

<?php if (! $this->_tpl_vars['fields']['currency_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['currency_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['currency_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['currency_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['currency_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['currency_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['currency_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['currency_c']['options'][$this->_tpl_vars['fields']['currency_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_STATE','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="state_c" >

<?php if (! $this->_tpl_vars['fields']['state_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['state_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['state_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['state_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['state_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['state_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_COUNTRY','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="country_c" >

<?php if (! $this->_tpl_vars['fields']['country_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['country_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['country_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['country_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['country_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['country_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SOURCE','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="source_c" >

<?php if (! $this->_tpl_vars['fields']['source_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['source_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['source_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['source_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['source_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['source_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['source_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['source_c']['options'][$this->_tpl_vars['fields']['source_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_NEW_DEPARTMENT','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="new_department_c" >

<?php if (! $this->_tpl_vars['fields']['new_department_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['new_department_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['new_department_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['new_department_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['new_department_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['new_department_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_NON_FINANCIAL_RADIO','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="radioenum" field="non_financial_radio_c" >

<?php if (! $this->_tpl_vars['fields']['non_financial_radio_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['non_financial_radio_c']['name']; ?>
">
<?php echo $this->_tpl_vars['fields']['non_financial_radio_c']['options'][$this->_tpl_vars['fields']['non_financial_radio_c']['value']]; ?>

</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SOURCE_DETAILS','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="source_details_c" >

<?php if (! $this->_tpl_vars['fields']['source_details_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['source_details_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['source_details_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['source_details_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['source_details_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['source_details_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_NON_FINANCIAL_CONSIDERATION','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="multienum" field="non_financial_consideration_c" >

<?php if (! $this->_tpl_vars['fields']['non_financial_consideration_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (! empty ( $this->_tpl_vars['fields']['non_financial_consideration_c']['value'] ) && ( $this->_tpl_vars['fields']['non_financial_consideration_c']['value'] != '^^' )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['non_financial_consideration_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['non_financial_consideration_c']['value']; ?>
">
<?php echo smarty_function_multienum_to_array(array('string' => $this->_tpl_vars['fields']['non_financial_consideration_c']['value'],'assign' => 'vals'), $this);?>

<?php $_from = $this->_tpl_vars['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<li style="margin-left:10px;"><?php echo $this->_tpl_vars['fields']['non_financial_consideration_c']['options'][$this->_tpl_vars['item']]; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNED_TO_NEW','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="assigned_to_new_c" >

<?php if (! $this->_tpl_vars['fields']['assigned_to_new_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['assigned_to_new_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['assigned_to_new_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['assigned_to_new_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['assigned_to_new_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['assigned_to_new_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_DESCRIPTION','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="description" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['description']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['description']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['description']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html_entity_decode') : smarty_modifier_escape($_tmp, 'html_entity_decode')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>

</div>


</div>

</div>
                                </div>
</div>
</div>
<?php else: ?>

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-0" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
<?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_PANEL3','module' => 'Opportunities'), $this);?>

</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-0" data-id="LBL_EDITVIEW_PANEL3">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_OPPORTUNITY_NAME','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="name" field="name" >

<?php if (! $this->_tpl_vars['fields']['name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['name']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['name']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['name']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['name']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['name']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'Approver','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="relate" field="select_approver_c" >

<?php if (! $this->_tpl_vars['fields']['select_approver_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span id="user_id2_c" class="sugar_field" data-id-value="<?php echo $this->_tpl_vars['fields']['user_id2_c']['value']; ?>
"><?php echo $this->_tpl_vars['fields']['select_approver_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_INTERNATIONAL','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="radioenum" field="international_c" >

<?php if (! $this->_tpl_vars['fields']['international_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['international_c']['name']; ?>
">
<?php echo $this->_tpl_vars['fields']['international_c']['options'][$this->_tpl_vars['fields']['international_c']['value']]; ?>

</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_CURRENCY','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="currency_c" >

<?php if (! $this->_tpl_vars['fields']['currency_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['currency_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['currency_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['currency_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['currency_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['currency_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['currency_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['currency_c']['options'][$this->_tpl_vars['fields']['currency_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_STATE','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="state_c" >

<?php if (! $this->_tpl_vars['fields']['state_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['state_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['state_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['state_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['state_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['state_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_COUNTRY','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="country_c" >

<?php if (! $this->_tpl_vars['fields']['country_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['country_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['country_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['country_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['country_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['country_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SOURCE','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="source_c" >

<?php if (! $this->_tpl_vars['fields']['source_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['source_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['source_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['source_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['source_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['source_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['source_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['source_c']['options'][$this->_tpl_vars['fields']['source_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_NEW_DEPARTMENT','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="new_department_c" >

<?php if (! $this->_tpl_vars['fields']['new_department_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['new_department_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['new_department_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['new_department_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['new_department_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['new_department_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_NON_FINANCIAL_RADIO','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="radioenum" field="non_financial_radio_c" >

<?php if (! $this->_tpl_vars['fields']['non_financial_radio_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['non_financial_radio_c']['name']; ?>
">
<?php echo $this->_tpl_vars['fields']['non_financial_radio_c']['options'][$this->_tpl_vars['fields']['non_financial_radio_c']['value']]; ?>

</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SOURCE_DETAILS','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="source_details_c" >

<?php if (! $this->_tpl_vars['fields']['source_details_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['source_details_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['source_details_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['source_details_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['source_details_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['source_details_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_NON_FINANCIAL_CONSIDERATION','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="multienum" field="non_financial_consideration_c" >

<?php if (! $this->_tpl_vars['fields']['non_financial_consideration_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (! empty ( $this->_tpl_vars['fields']['non_financial_consideration_c']['value'] ) && ( $this->_tpl_vars['fields']['non_financial_consideration_c']['value'] != '^^' )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['non_financial_consideration_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['non_financial_consideration_c']['value']; ?>
">
<?php echo smarty_function_multienum_to_array(array('string' => $this->_tpl_vars['fields']['non_financial_consideration_c']['value'],'assign' => 'vals'), $this);?>

<?php $_from = $this->_tpl_vars['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<li style="margin-left:10px;"><?php echo $this->_tpl_vars['fields']['non_financial_consideration_c']['options'][$this->_tpl_vars['item']]; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNED_TO_NEW','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="assigned_to_new_c" >

<?php if (! $this->_tpl_vars['fields']['assigned_to_new_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['assigned_to_new_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['assigned_to_new_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['assigned_to_new_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['assigned_to_new_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['assigned_to_new_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_DESCRIPTION','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="description" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['description']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['description']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['description']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html_entity_decode') : smarty_modifier_escape($_tmp, 'html_entity_decode')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>

</div>


</div>

</div>
                            </div>
</div>
</div>
<?php endif; ?>





<?php if ($this->_tpl_vars['config']['enable_action_menu'] && $this->_tpl_vars['config']['enable_action_menu'] != false): ?>

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-1" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
<?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_PANEL2','module' => 'Opportunities'), $this);?>

</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-1"  data-id="LBL_EDITVIEW_PANEL2">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_FINANCIAL_FEASIBILITY_L1','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="financial_feasibility_l1_c" >

<?php if (! $this->_tpl_vars['fields']['financial_feasibility_l1_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['financial_feasibility_l1_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['financial_feasibility_l1_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['financial_feasibility_l1_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['financial_feasibility_l1_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['financial_feasibility_l1_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_FINANCIAL_FEASIBILITY_L2','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="financial_feasibility_l2_c" >

<?php if (! $this->_tpl_vars['fields']['financial_feasibility_l2_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['financial_feasibility_l2_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['financial_feasibility_l2_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['financial_feasibility_l2_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['financial_feasibility_l2_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['financial_feasibility_l2_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_BUDGET_SOURCE','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="budget_source_c" >

<?php if (! $this->_tpl_vars['fields']['budget_source_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['budget_source_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['budget_source_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['budget_source_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['budget_source_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['budget_source_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_BUDGET_HEAD','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="budget_head_c" >

<?php if (! $this->_tpl_vars['fields']['budget_head_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['budget_head_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['budget_head_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['budget_head_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['budget_head_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['budget_head_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_BUDGET_HEAD_AMOUNT','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="float" field="budget_head_amount_c" >

<?php if (! $this->_tpl_vars['fields']['budget_head_amount_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['budget_head_amount_c']['name']; ?>
">
<?php echo smarty_function_sugar_number_format(array('var' => $this->_tpl_vars['fields']['budget_head_amount_c']['value'],'precision' => 2), $this);?>

</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_BUDGET_ALLOCATED_OPPERTUNITY','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="float" field="budget_allocated_oppertunity_c" >

<?php if (! $this->_tpl_vars['fields']['budget_allocated_oppertunity_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['budget_allocated_oppertunity_c']['name']; ?>
">
<?php echo smarty_function_sugar_number_format(array('var' => $this->_tpl_vars['fields']['budget_allocated_oppertunity_c']['value'],'precision' => 2), $this);?>

</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_PROJECT_IMPLEMENTATION_START','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="project_implementation_start_c" >

<?php if (! $this->_tpl_vars['fields']['project_implementation_start_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['project_implementation_start_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['project_implementation_start_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['project_implementation_start_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['project_implementation_start_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_PROJECT_IMPLEMENTATION_END','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="project_implementation_end_c" >

<?php if (! $this->_tpl_vars['fields']['project_implementation_end_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['project_implementation_end_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['project_implementation_end_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['project_implementation_end_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['project_implementation_end_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_FINANCIAL_FEASIBILITY_L3','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="financial_feasibility_l3_c" >

<?php if (! $this->_tpl_vars['fields']['financial_feasibility_l3_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['financial_feasibility_l3_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['financial_feasibility_l3_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['financial_feasibility_l3_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['financial_feasibility_l3_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['financial_feasibility_l3_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>

</div>
                                </div>
</div>
</div>
<?php else: ?>

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-1" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
<?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_PANEL2','module' => 'Opportunities'), $this);?>

</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-1" data-id="LBL_EDITVIEW_PANEL2">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_FINANCIAL_FEASIBILITY_L1','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="financial_feasibility_l1_c" >

<?php if (! $this->_tpl_vars['fields']['financial_feasibility_l1_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['financial_feasibility_l1_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['financial_feasibility_l1_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['financial_feasibility_l1_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['financial_feasibility_l1_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['financial_feasibility_l1_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_FINANCIAL_FEASIBILITY_L2','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="financial_feasibility_l2_c" >

<?php if (! $this->_tpl_vars['fields']['financial_feasibility_l2_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['financial_feasibility_l2_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['financial_feasibility_l2_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['financial_feasibility_l2_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['financial_feasibility_l2_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['financial_feasibility_l2_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_BUDGET_SOURCE','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="budget_source_c" >

<?php if (! $this->_tpl_vars['fields']['budget_source_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['budget_source_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['budget_source_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['budget_source_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['budget_source_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['budget_source_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_BUDGET_HEAD','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="budget_head_c" >

<?php if (! $this->_tpl_vars['fields']['budget_head_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['budget_head_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['budget_head_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['budget_head_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['budget_head_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['budget_head_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_BUDGET_HEAD_AMOUNT','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="float" field="budget_head_amount_c" >

<?php if (! $this->_tpl_vars['fields']['budget_head_amount_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['budget_head_amount_c']['name']; ?>
">
<?php echo smarty_function_sugar_number_format(array('var' => $this->_tpl_vars['fields']['budget_head_amount_c']['value'],'precision' => 2), $this);?>

</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_BUDGET_ALLOCATED_OPPERTUNITY','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="float" field="budget_allocated_oppertunity_c" >

<?php if (! $this->_tpl_vars['fields']['budget_allocated_oppertunity_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['budget_allocated_oppertunity_c']['name']; ?>
">
<?php echo smarty_function_sugar_number_format(array('var' => $this->_tpl_vars['fields']['budget_allocated_oppertunity_c']['value'],'precision' => 2), $this);?>

</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_PROJECT_IMPLEMENTATION_START','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="project_implementation_start_c" >

<?php if (! $this->_tpl_vars['fields']['project_implementation_start_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['project_implementation_start_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['project_implementation_start_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['project_implementation_start_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['project_implementation_start_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_PROJECT_IMPLEMENTATION_END','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="project_implementation_end_c" >

<?php if (! $this->_tpl_vars['fields']['project_implementation_end_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['project_implementation_end_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['project_implementation_end_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['project_implementation_end_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['project_implementation_end_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_FINANCIAL_FEASIBILITY_L3','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="financial_feasibility_l3_c" >

<?php if (! $this->_tpl_vars['fields']['financial_feasibility_l3_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['financial_feasibility_l3_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['financial_feasibility_l3_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['financial_feasibility_l3_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['financial_feasibility_l3_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['financial_feasibility_l3_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>

</div>
                            </div>
</div>
</div>
<?php endif; ?>





<?php if ($this->_tpl_vars['config']['enable_action_menu'] && $this->_tpl_vars['config']['enable_action_menu'] != false): ?>

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-2" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
<?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_PANEL7','module' => 'Opportunities'), $this);?>

</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-2"  data-id="LBL_EDITVIEW_PANEL7">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SEGMENT','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="segment_c" >

<?php if (! $this->_tpl_vars['fields']['segment_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['segment_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['segment_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['segment_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['segment_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['segment_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_PRODUCT_SERVICE','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="product_service_c" >

<?php if (! $this->_tpl_vars['fields']['product_service_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['product_service_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['product_service_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['product_service_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['product_service_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['product_service_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_ADD_NEW_SEGMENT','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="add_new_segment_c" >

<?php if (! $this->_tpl_vars['fields']['add_new_segment_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['add_new_segment_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['add_new_segment_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['add_new_segment_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['add_new_segment_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['add_new_segment_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_ADD_NEW_PRODUCT_SERVICE','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="add_new_product_service_c" >

<?php if (! $this->_tpl_vars['fields']['add_new_product_service_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['add_new_product_service_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['add_new_product_service_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['add_new_product_service_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['add_new_product_service_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['add_new_product_service_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SECTOR','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="sector_c" >

<?php if (! $this->_tpl_vars['fields']['sector_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sector_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sector_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sector_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sector_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sector_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SUB_SECTOR','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="sub_sector_c" >

<?php if (! $this->_tpl_vars['fields']['sub_sector_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sub_sector_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sub_sector_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sub_sector_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sub_sector_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sub_sector_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_RISK','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="risk_c" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['risk_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['risk_c']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['risk_c']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html_entity_decode') : smarty_modifier_escape($_tmp, 'html_entity_decode')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_PROJECT_SCOPE','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="project_scope_c" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['project_scope_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['project_scope_c']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['project_scope_c']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html_entity_decode') : smarty_modifier_escape($_tmp, 'html_entity_decode')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SELECTION','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="selection_c" >

<?php if (! $this->_tpl_vars['fields']['selection_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['selection_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['selection_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['selection_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['selection_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['selection_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['selection_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['selection_c']['options'][$this->_tpl_vars['fields']['selection_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_FUNDING','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="funding_c" >

<?php if (! $this->_tpl_vars['fields']['funding_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['funding_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['funding_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['funding_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['funding_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['funding_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['funding_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['funding_c']['options'][$this->_tpl_vars['fields']['funding_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_TIMING_BUTTON','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="timing_button_c" >

<?php if (! $this->_tpl_vars['fields']['timing_button_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['timing_button_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['timing_button_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['timing_button_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['timing_button_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['timing_button_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['timing_button_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['timing_button_c']['options'][$this->_tpl_vars['fields']['timing_button_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>

</div>
                                </div>
</div>
</div>
<?php else: ?>

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-2" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
<?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_PANEL7','module' => 'Opportunities'), $this);?>

</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-2" data-id="LBL_EDITVIEW_PANEL7">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SEGMENT','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="segment_c" >

<?php if (! $this->_tpl_vars['fields']['segment_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['segment_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['segment_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['segment_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['segment_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['segment_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_PRODUCT_SERVICE','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="product_service_c" >

<?php if (! $this->_tpl_vars['fields']['product_service_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['product_service_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['product_service_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['product_service_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['product_service_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['product_service_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_ADD_NEW_SEGMENT','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="add_new_segment_c" >

<?php if (! $this->_tpl_vars['fields']['add_new_segment_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['add_new_segment_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['add_new_segment_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['add_new_segment_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['add_new_segment_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['add_new_segment_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_ADD_NEW_PRODUCT_SERVICE','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="add_new_product_service_c" >

<?php if (! $this->_tpl_vars['fields']['add_new_product_service_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['add_new_product_service_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['add_new_product_service_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['add_new_product_service_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['add_new_product_service_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['add_new_product_service_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SECTOR','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="sector_c" >

<?php if (! $this->_tpl_vars['fields']['sector_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sector_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sector_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sector_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sector_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sector_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SUB_SECTOR','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="sub_sector_c" >

<?php if (! $this->_tpl_vars['fields']['sub_sector_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sub_sector_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sub_sector_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sub_sector_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sub_sector_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sub_sector_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_RISK','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="risk_c" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['risk_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['risk_c']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['risk_c']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html_entity_decode') : smarty_modifier_escape($_tmp, 'html_entity_decode')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_PROJECT_SCOPE','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="project_scope_c" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['project_scope_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['project_scope_c']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['project_scope_c']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html_entity_decode') : smarty_modifier_escape($_tmp, 'html_entity_decode')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SELECTION','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="selection_c" >

<?php if (! $this->_tpl_vars['fields']['selection_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['selection_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['selection_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['selection_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['selection_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['selection_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['selection_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['selection_c']['options'][$this->_tpl_vars['fields']['selection_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">
</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_FUNDING','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="funding_c" >

<?php if (! $this->_tpl_vars['fields']['funding_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['funding_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['funding_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['funding_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['funding_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['funding_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['funding_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['funding_c']['options'][$this->_tpl_vars['fields']['funding_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_TIMING_BUTTON','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="timing_button_c" >

<?php if (! $this->_tpl_vars['fields']['timing_button_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['timing_button_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['timing_button_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['timing_button_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['timing_button_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['timing_button_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['timing_button_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['timing_button_c']['options'][$this->_tpl_vars['fields']['timing_button_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>

</div>
                            </div>
</div>
</div>
<?php endif; ?>





<?php if ($this->_tpl_vars['config']['enable_action_menu'] && $this->_tpl_vars['config']['enable_action_menu'] != false): ?>

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-3" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
<?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_PANEL1','module' => 'Opportunities'), $this);?>

</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-3"  data-id="LBL_EDITVIEW_PANEL1">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SCOPE_BUDGET_PROJECTED','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="scope_budget_projected_c" >

<?php if (! $this->_tpl_vars['fields']['scope_budget_projected_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['scope_budget_projected_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['scope_budget_projected_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['scope_budget_projected_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['scope_budget_projected_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SCOPE_BUDGET_ACHIEVED','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="scope_budget_achieved_c" >

<?php if (! $this->_tpl_vars['fields']['scope_budget_achieved_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['scope_budget_achieved_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['scope_budget_achieved_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['scope_budget_achieved_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['scope_budget_achieved_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_RFP_EOI_PROJECTED','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="rfp_eoi_projected_c" >

<?php if (! $this->_tpl_vars['fields']['rfp_eoi_projected_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['rfp_eoi_projected_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['rfp_eoi_projected_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['rfp_eoi_projected_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['rfp_eoi_projected_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_RFP_EOI_ACHIEVED','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="rfp_eoi_achieved_c" >

<?php if (! $this->_tpl_vars['fields']['rfp_eoi_achieved_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['rfp_eoi_achieved_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['rfp_eoi_achieved_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['rfp_eoi_achieved_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['rfp_eoi_achieved_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_RFP_EOI_PUBLISHED_PROJECTED','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="rfp_eoi_published_projected_c" >

<?php if (! $this->_tpl_vars['fields']['rfp_eoi_published_projected_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['rfp_eoi_published_projected_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['rfp_eoi_published_projected_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['rfp_eoi_published_projected_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['rfp_eoi_published_projected_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_RFP_EOI_PUBLISHED_ACHIEVED','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="rfp_eoi_published_achieved_c" >

<?php if (! $this->_tpl_vars['fields']['rfp_eoi_published_achieved_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['rfp_eoi_published_achieved_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['rfp_eoi_published_achieved_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['rfp_eoi_published_achieved_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['rfp_eoi_published_achieved_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_WORK_ORDER_PROJECTED','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="work_order_projected_c" >

<?php if (! $this->_tpl_vars['fields']['work_order_projected_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['work_order_projected_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['work_order_projected_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['work_order_projected_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['work_order_projected_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_WORK_ORDER_ACHIEVED','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="work_order_achieved_c" >

<?php if (! $this->_tpl_vars['fields']['work_order_achieved_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['work_order_achieved_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['work_order_achieved_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['work_order_achieved_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['work_order_achieved_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

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
<?php else: ?>

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-3" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
<?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_PANEL1','module' => 'Opportunities'), $this);?>

</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-3" data-id="LBL_EDITVIEW_PANEL1">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SCOPE_BUDGET_PROJECTED','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="scope_budget_projected_c" >

<?php if (! $this->_tpl_vars['fields']['scope_budget_projected_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['scope_budget_projected_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['scope_budget_projected_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['scope_budget_projected_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['scope_budget_projected_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SCOPE_BUDGET_ACHIEVED','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="scope_budget_achieved_c" >

<?php if (! $this->_tpl_vars['fields']['scope_budget_achieved_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['scope_budget_achieved_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['scope_budget_achieved_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['scope_budget_achieved_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['scope_budget_achieved_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_RFP_EOI_PROJECTED','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="rfp_eoi_projected_c" >

<?php if (! $this->_tpl_vars['fields']['rfp_eoi_projected_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['rfp_eoi_projected_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['rfp_eoi_projected_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['rfp_eoi_projected_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['rfp_eoi_projected_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_RFP_EOI_ACHIEVED','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="rfp_eoi_achieved_c" >

<?php if (! $this->_tpl_vars['fields']['rfp_eoi_achieved_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['rfp_eoi_achieved_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['rfp_eoi_achieved_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['rfp_eoi_achieved_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['rfp_eoi_achieved_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_RFP_EOI_PUBLISHED_PROJECTED','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="rfp_eoi_published_projected_c" >

<?php if (! $this->_tpl_vars['fields']['rfp_eoi_published_projected_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['rfp_eoi_published_projected_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['rfp_eoi_published_projected_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['rfp_eoi_published_projected_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['rfp_eoi_published_projected_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_RFP_EOI_PUBLISHED_ACHIEVED','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="rfp_eoi_published_achieved_c" >

<?php if (! $this->_tpl_vars['fields']['rfp_eoi_published_achieved_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['rfp_eoi_published_achieved_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['rfp_eoi_published_achieved_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['rfp_eoi_published_achieved_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['rfp_eoi_published_achieved_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_WORK_ORDER_PROJECTED','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="work_order_projected_c" >

<?php if (! $this->_tpl_vars['fields']['work_order_projected_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['work_order_projected_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['work_order_projected_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['work_order_projected_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['work_order_projected_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_WORK_ORDER_ACHIEVED','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="work_order_achieved_c" >

<?php if (! $this->_tpl_vars['fields']['work_order_achieved_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['work_order_achieved_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['work_order_achieved_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['work_order_achieved_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['work_order_achieved_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

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
<?php endif; ?>





<?php if ($this->_tpl_vars['config']['enable_action_menu'] && $this->_tpl_vars['config']['enable_action_menu'] != false): ?>

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-4" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
<?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_PANEL8','module' => 'Opportunities'), $this);?>

</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-4"  data-id="LBL_EDITVIEW_PANEL8">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_RFP_EOI_SUMMARY','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="rfp_eoi_summary_c" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['rfp_eoi_summary_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['rfp_eoi_summary_c']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['rfp_eoi_summary_c']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html_entity_decode') : smarty_modifier_escape($_tmp, 'html_entity_decode')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_BID_STRATEGY','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="bid_strategy_c" >

<?php if (! $this->_tpl_vars['fields']['bid_strategy_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['bid_strategy_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['bid_strategy_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['bid_strategy_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['bid_strategy_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['bid_strategy_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SUBMISSIONSTATUS','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="submissionstatus_c" >

<?php if (! $this->_tpl_vars['fields']['submissionstatus_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['submissionstatus_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['submissionstatus_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['submissionstatus_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['submissionstatus_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['submissionstatus_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['submissionstatus_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['submissionstatus_c']['options'][$this->_tpl_vars['fields']['submissionstatus_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_BID_CHECKLIST','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="bid_checklist_c" >

<?php if (! $this->_tpl_vars['fields']['bid_checklist_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['bid_checklist_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['bid_checklist_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['bid_checklist_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['bid_checklist_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['bid_checklist_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'Bid Files','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="" field="" >

<?php if (! $this->_tpl_vars['fields']['multiple_file']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>

<span id="multiple_file" class="sugar_field"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['FILEUPLOAD'], 'smarty_include_vars' => array('filename' => $this->_tpl_vars['ATTACHMENTS'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span>
<?php endif; ?>

</div>


</div>

</div>
                                </div>
</div>
</div>
<?php else: ?>

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-4" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
<?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_PANEL8','module' => 'Opportunities'), $this);?>

</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-4" data-id="LBL_EDITVIEW_PANEL8">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_RFP_EOI_SUMMARY','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="rfp_eoi_summary_c" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['rfp_eoi_summary_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['rfp_eoi_summary_c']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['rfp_eoi_summary_c']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html_entity_decode') : smarty_modifier_escape($_tmp, 'html_entity_decode')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_BID_STRATEGY','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="bid_strategy_c" >

<?php if (! $this->_tpl_vars['fields']['bid_strategy_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['bid_strategy_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['bid_strategy_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['bid_strategy_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['bid_strategy_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['bid_strategy_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SUBMISSIONSTATUS','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="submissionstatus_c" >

<?php if (! $this->_tpl_vars['fields']['submissionstatus_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['submissionstatus_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['submissionstatus_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['submissionstatus_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['submissionstatus_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['submissionstatus_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['submissionstatus_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['submissionstatus_c']['options'][$this->_tpl_vars['fields']['submissionstatus_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_BID_CHECKLIST','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="bid_checklist_c" >

<?php if (! $this->_tpl_vars['fields']['bid_checklist_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['bid_checklist_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['bid_checklist_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['bid_checklist_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['bid_checklist_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['bid_checklist_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'Bid Files','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="" field="" >

<?php if (! $this->_tpl_vars['fields']['multiple_file']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>

<span id="multiple_file" class="sugar_field"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['FILEUPLOAD'], 'smarty_include_vars' => array('filename' => $this->_tpl_vars['ATTACHMENTS'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span>
<?php endif; ?>

</div>


</div>

</div>
                            </div>
</div>
</div>
<?php endif; ?>





<?php if ($this->_tpl_vars['config']['enable_action_menu'] && $this->_tpl_vars['config']['enable_action_menu'] != false): ?>

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-5" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
<?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_PANEL6','module' => 'Opportunities'), $this);?>

</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-5"  data-id="LBL_EDITVIEW_PANEL6">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_CLOSURE_STATUS','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="closure_status_c" >

<?php if (! $this->_tpl_vars['fields']['closure_status_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['closure_status_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['closure_status_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['closure_status_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['closure_status_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['closure_status_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['closure_status_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['closure_status_c']['options'][$this->_tpl_vars['fields']['closure_status_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_EXPECTED_INFLOW','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="expected_inflow_c" >

<?php if (! $this->_tpl_vars['fields']['expected_inflow_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['expected_inflow_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['expected_inflow_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['expected_inflow_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['expected_inflow_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_LEARNINGS','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="learnings_c" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['learnings_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['learnings_c']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['learnings_c']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html_entity_decode') : smarty_modifier_escape($_tmp, 'html_entity_decode')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_COMMENTS','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="comments_c" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['comments_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['comments_c']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['comments_c']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html_entity_decode') : smarty_modifier_escape($_tmp, 'html_entity_decode')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>

</div>


</div>

</div>
                                </div>
</div>
</div>
<?php else: ?>

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-5" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
<?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_PANEL6','module' => 'Opportunities'), $this);?>

</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-5" data-id="LBL_EDITVIEW_PANEL6">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_CLOSURE_STATUS','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="enum" field="closure_status_c" >

<?php if (! $this->_tpl_vars['fields']['closure_status_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['closure_status_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['closure_status_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['closure_status_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['closure_status_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['closure_status_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['closure_status_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['closure_status_c']['options'][$this->_tpl_vars['fields']['closure_status_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_EXPECTED_INFLOW','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="date" field="expected_inflow_c" >

<?php if (! $this->_tpl_vars['fields']['expected_inflow_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>



<?php if (! empty ( $this->_tpl_vars['vardef']['date_formatted_value'] )): ?>
<?php $this->assign('value', "{".($this->_tpl_vars['vardef']).".date_formatted_value"); ?> }
<?php else: ?>
<?php if (strlen ( $this->_tpl_vars['fields']['expected_inflow_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['expected_inflow_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['expected_inflow_c']['value']); ?>
<?php endif; ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['expected_inflow_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_LEARNINGS','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="learnings_c" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['learnings_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['learnings_c']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['learnings_c']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html_entity_decode') : smarty_modifier_escape($_tmp, 'html_entity_decode')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_COMMENTS','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="comments_c" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['comments_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['comments_c']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['comments_c']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html_entity_decode') : smarty_modifier_escape($_tmp, 'html_entity_decode')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>

</div>


</div>

</div>
                            </div>
</div>
</div>
<?php endif; ?>





<?php if ($this->_tpl_vars['config']['enable_action_menu'] && $this->_tpl_vars['config']['enable_action_menu'] != false): ?>

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-6" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
<?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_PANEL9','module' => 'Opportunities'), $this);?>

</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-6"  data-id="LBL_EDITVIEW_PANEL9">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_TAGGED_USERS','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="tagged_users_c" >

<?php if (! $this->_tpl_vars['fields']['tagged_users_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['tagged_users_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['tagged_users_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['tagged_users_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['tagged_users_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['tagged_users_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_MULTIPLE_APPROVER','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="multiple_approver_c" >

<?php if (! $this->_tpl_vars['fields']['multiple_approver_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['multiple_approver_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['multiple_approver_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['multiple_approver_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['multiple_approver_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['multiple_approver_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_TAGGED_USERS_COMMENTS','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="tagged_users_comments_c" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['tagged_users_comments_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['tagged_users_comments_c']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['tagged_users_comments_c']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html_entity_decode') : smarty_modifier_escape($_tmp, 'html_entity_decode')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_TAGGED_HIDEN','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="tagged_hiden_c" >

<?php if (! $this->_tpl_vars['fields']['tagged_hiden_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['tagged_hiden_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['tagged_hiden_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['tagged_hiden_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['tagged_hiden_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['tagged_hiden_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_UNTAGGED_HIDDEN','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="untagged_hidden_c" >

<?php if (! $this->_tpl_vars['fields']['untagged_hidden_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['untagged_hidden_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['untagged_hidden_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['untagged_hidden_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['untagged_hidden_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['untagged_hidden_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>
                                </div>
</div>
</div>
<?php else: ?>

<div class="panel panel-default tab-panel-0" style="display: block;">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel-6" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
<?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_PANEL9','module' => 'Opportunities'), $this);?>

</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel-6" data-id="LBL_EDITVIEW_PANEL9">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_TAGGED_USERS','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="tagged_users_c" >

<?php if (! $this->_tpl_vars['fields']['tagged_users_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['tagged_users_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['tagged_users_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['tagged_users_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['tagged_users_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['tagged_users_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_MULTIPLE_APPROVER','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="multiple_approver_c" >

<?php if (! $this->_tpl_vars['fields']['multiple_approver_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['multiple_approver_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['multiple_approver_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['multiple_approver_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['multiple_approver_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['multiple_approver_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_TAGGED_USERS_COMMENTS','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="text" field="tagged_users_comments_c" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['tagged_users_comments_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['tagged_users_comments_c']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['tagged_users_comments_c']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html_entity_decode') : smarty_modifier_escape($_tmp, 'html_entity_decode')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_TAGGED_HIDEN','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="tagged_hiden_c" >

<?php if (! $this->_tpl_vars['fields']['tagged_hiden_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['tagged_hiden_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['tagged_hiden_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['tagged_hiden_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['tagged_hiden_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['tagged_hiden_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_UNTAGGED_HIDDEN','module' => 'Opportunities'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="untagged_hidden_c" >

<?php if (! $this->_tpl_vars['fields']['untagged_hidden_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['untagged_hidden_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['untagged_hidden_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['untagged_hidden_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['untagged_hidden_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['untagged_hidden_c']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>
                            </div>
</div>
</div>
<?php endif; ?>
</div>
</div>

</form>
<script>SUGAR.util.doWhen("document.getElementById('form') != null",
        function(){SUGAR.util.buildAccessKeyLabels();});
</script>            <script type="text/javascript" src="include/InlineEditing/inlineEditing.js"></script>
<script type="text/javascript" src="modules/Favorites/favorites.js"></script>
<?php echo '
<script type="text/javascript">

                    let selectTabDetailView = function(tab) {
                        $(\'#content div.tab-content div.tab-pane-NOBOOTSTRAPTOGGLER\').hide();
                        $(\'#content div.tab-content div.tab-pane-NOBOOTSTRAPTOGGLER\').eq(tab).show().addClass(\'active\').addClass(\'in\');
                        $(\'#content div.detail-view div.panel-content div.panel.panel\').hide();
                        $(\'#content div.panel-content div.panel.tab-panel-\' + tab).show();
                    };

                    let selectTabOnError = function(tab) {
                        selectTabDetailView(tab);
                        $(\'#content ul.nav.nav-tabs > li\').removeClass(\'active\');
                        $(\'#content ul.nav.nav-tabs > li a\').css(\'color\', \'\');

                        $(\'#content ul.nav.nav-tabs > li\').eq(tab).find(\'a\').first().css(\'color\', \'red\');
                        $(\'#content ul.nav.nav-tabs > li\').eq(tab).addClass(\'active\');

                    };

                    var selectTabOnErrorInputHandle = function(inputHandle) {
                        var tab = $(inputHandle).closest(\'.tab-pane-NOBOOTSTRAPTOGGLER\').attr(\'id\').match(/^detailpanel_(.*)$/)[1];
                        selectTabOnError(tab);
                    };


                    $(function(){
                        $(\'#content ul.nav.nav-tabs > li > a[data-toggle="tab"]\').click(function(e){
                            if(typeof $(this).parent().find(\'a\').first().attr(\'id\') != \'undefined\') {
                                var tab = parseInt($(this).parent().find(\'a\').first().attr(\'id\').match(/^tab(.)*$/)[1]);
                                selectTabDetailView(tab);
                            }
                        });
                    });

                </script>
'; ?>