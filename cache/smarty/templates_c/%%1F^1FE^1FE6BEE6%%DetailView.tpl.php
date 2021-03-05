<?php /* Smarty version 2.6.31, created on 2021-02-23 08:02:30
         compiled from cache/themes/SuiteP/modules/DocumentRevisions/DetailView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_include', 'cache/themes/SuiteP/modules/DocumentRevisions/DetailView.tpl', 37, false),array('function', 'sugar_translate', 'cache/themes/SuiteP/modules/DocumentRevisions/DetailView.tpl', 46, false),array('function', 'counter', 'cache/themes/SuiteP/modules/DocumentRevisions/DetailView.tpl', 100, false),array('function', 'sugar_getimage', 'cache/themes/SuiteP/modules/DocumentRevisions/DetailView.tpl', 217, false),array('modifier', 'strip_semicolon', 'cache/themes/SuiteP/modules/DocumentRevisions/DetailView.tpl', 93, false),)), $this); ?>


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
<input type="hidden" name="old_id" value="<?php echo $this->_tpl_vars['fields']['document_revision_id']['value']; ?>
">
<?php if (! $this->_tpl_vars['config']['enable_action_menu']): ?>
<div class="buttons">
<?php if ($this->_tpl_vars['bean']->aclAccess('detail')): ?><?php if (! empty ( $this->_tpl_vars['fields']['id']['value'] ) && $this->_tpl_vars['isAuditEnabled']): ?><input id="btn_view_change_log" title="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
" class="button" onclick='open_popup("Audit", "600", "400", "&record=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&module_name=DocumentRevisions", true, false,  { "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] } ); return false;' type="button" value="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
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

<?php if ($this->_tpl_vars['config']['enable_action_menu'] && $this->_tpl_vars['config']['enable_action_menu'] != false): ?>
<li role="presentation" class="active">
<a id="tab0" data-toggle="tab" class="hidden-xs">
<?php echo smarty_function_sugar_translate(array('label' => '','module' => 'DocumentRevisions'), $this);?>

</a>
<a id="xstab0" href="#" class="visible-xs first-tab dropdown-toggle" data-toggle="dropdown">
<?php echo smarty_function_sugar_translate(array('label' => '','module' => 'DocumentRevisions'), $this);?>

</a>
</li>
<?php endif; ?>
<?php if ($this->_tpl_vars['config']['enable_action_menu'] && $this->_tpl_vars['config']['enable_action_menu'] != false): ?>
<li id="tab-actions" class="dropdown">
<a class="dropdown-toggle" data-toggle="dropdown" href="#">ACTIONS<span class="suitepicon suitepicon-action-caret"></span></a>
<ul class="dropdown-menu">
<li><?php if ($this->_tpl_vars['bean']->aclAccess('detail')): ?><?php if (! empty ( $this->_tpl_vars['fields']['id']['value'] ) && $this->_tpl_vars['isAuditEnabled']): ?><input id="btn_view_change_log" title="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
" class="button" onclick='open_popup("Audit", "600", "400", "&record=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&module_name=DocumentRevisions", true, false,  { "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] } ); return false;' type="button" value="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
"><?php endif; ?><?php endif; ?></li>
</ul>        </li>
<li class="tab-inline-pagination">
<?php echo $this->_tpl_vars['PAGINATION']; ?>

</li>
<?php endif; ?>
</ul>
<div class="clearfix"></div>

<?php if ($this->_tpl_vars['config']['enable_action_menu'] && $this->_tpl_vars['config']['enable_action_menu'] != false): ?>

<div class="tab-content">
<?php else: ?>

<div class="tab-content" style="padding: 0; border: 0;">
<?php endif; ?>


<?php if ($this->_tpl_vars['config']['enable_action_menu'] && $this->_tpl_vars['config']['enable_action_menu'] != false): ?>
<div class="tab-pane-NOBOOTSTRAPTOGGLER active fade in" id='tab-content-0'>





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_DOC_NAME','module' => 'DocumentRevisions'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="document_name" >

<?php if (! $this->_tpl_vars['fields']['document_name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['document_name']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['document_name']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['document_name']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['document_name']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['document_name']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_CURRENT_DOC_VERSION','module' => 'DocumentRevisions'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="latest_revision" >

<?php if (! $this->_tpl_vars['fields']['latest_revision']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['latest_revision']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['latest_revision']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['latest_revision']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['latest_revision']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['latest_revision']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_REVISION','module' => 'DocumentRevisions'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="varchar" field="revision" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['revision']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['revision']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['revision']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['revision']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['revision']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['revision']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_FILENAME','module' => 'DocumentRevisions'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="file" field="filename" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['filename']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['filename']['name']; ?>
">
<a href="index.php?entryPoint=download&id=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&type=Documents" class="tabDetailViewDFLink" target='_blank'><?php echo $this->_tpl_vars['fields']['filename']['value']; ?>
</a>
&nbsp;
<a href="index.php?preview=yes&entryPoint=download&id=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&type=Documents" class="tabDetailViewDFLink" target='_blank' style="border-bottom: 0px;">
<i class="glyphicon glyphicon-eye-open"></i>
</a>
</span>
<?php if (isset ( $this->_tpl_vars['fields']['doc_type'] ) && ! empty ( $this->_tpl_vars['fields']['doc_type']['value'] ) && $this->_tpl_vars['fields']['doc_type']['value'] != 'SugarCRM' && ! empty ( $this->_tpl_vars['fields']['doc_url']['value'] )): ?>
<?php ob_start(); ?>
<?php echo $this->_tpl_vars['fields']['doc_type']['value']; ?>
_image_inline.png
<?php $this->_smarty_vars['capture']['imageNameCapture'] = ob_get_contents();  $this->assign('imageName', ob_get_contents());ob_end_clean(); ?>
<a href="<?php echo $this->_tpl_vars['fields']['doc_url']['value']; ?>
" class="tabDetailViewDFLink" target="_blank"><?php echo smarty_function_sugar_getimage(array('name' => $this->_tpl_vars['imageName'],'alt' => $this->_tpl_vars['imageName'],'other_attributes' => 'border="0" '), $this);?>
</a>
<?php endif; ?>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_DATE_ENTERED','module' => 'DocumentRevisions'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="datetime" field="date_entered" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['date_entered']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>

<span id="date_entered" class="sugar_field"><?php echo $this->_tpl_vars['fields']['date_entered']['value']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_BY']; ?>
 <?php echo $this->_tpl_vars['fields']['created_by_name']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_CHANGE_LOG','module' => 'DocumentRevisions'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="varchar" field="change_log" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['change_log']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['change_log']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['change_log']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['change_log']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['change_log']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['change_log']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>
                        </div>
<?php else: ?>

<div class="tab-pane-NOBOOTSTRAPTOGGLER panel-collapse"></div>
<?php endif; ?>
</div>

<div class="panel-content">
<div>&nbsp;</div>





<?php if ($this->_tpl_vars['config']['enable_action_menu'] && $this->_tpl_vars['config']['enable_action_menu'] != false): ?>

<?php else: ?>

<div class="panel panel-default">
<div class="panel-heading ">
<a class="" role="button" data-toggle="collapse" href="#top-panel--1" aria-expanded="false">
<div class="col-xs-10 col-sm-11 col-md-11">
<?php echo smarty_function_sugar_translate(array('label' => '','module' => 'DocumentRevisions'), $this);?>

</div>
</a>
</div>
<div class="panel-body panel-collapse collapse in panelContainer" id="top-panel--1" data-id="">
<div class="tab-content">
<!-- TAB CONTENT -->





<div class="row detail-view-row">



<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_DOC_NAME','module' => 'DocumentRevisions'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="document_name" >

<?php if (! $this->_tpl_vars['fields']['document_name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['document_name']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['document_name']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['document_name']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['document_name']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['document_name']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>




<div class="col-xs-12 col-sm-6 detail-view-row-item">


<div class="col-xs-12 col-sm-4 label col-2-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_CURRENT_DOC_VERSION','module' => 'DocumentRevisions'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-8 detail-view-field" type="varchar" field="latest_revision" >

<?php if (! $this->_tpl_vars['fields']['latest_revision']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['latest_revision']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['latest_revision']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['latest_revision']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['latest_revision']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['latest_revision']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_REVISION','module' => 'DocumentRevisions'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="varchar" field="revision" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['revision']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['revision']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['revision']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['revision']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['revision']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['revision']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_FILENAME','module' => 'DocumentRevisions'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="file" field="filename" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['filename']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['filename']['name']; ?>
">
<a href="index.php?entryPoint=download&id=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&type=Documents" class="tabDetailViewDFLink" target='_blank'><?php echo $this->_tpl_vars['fields']['filename']['value']; ?>
</a>
&nbsp;
<a href="index.php?preview=yes&entryPoint=download&id=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&type=Documents" class="tabDetailViewDFLink" target='_blank' style="border-bottom: 0px;">
<i class="glyphicon glyphicon-eye-open"></i>
</a>
</span>
<?php if (isset ( $this->_tpl_vars['fields']['doc_type'] ) && ! empty ( $this->_tpl_vars['fields']['doc_type']['value'] ) && $this->_tpl_vars['fields']['doc_type']['value'] != 'SugarCRM' && ! empty ( $this->_tpl_vars['fields']['doc_url']['value'] )): ?>
<?php ob_start(); ?>
<?php echo $this->_tpl_vars['fields']['doc_type']['value']; ?>
_image_inline.png
<?php $this->_smarty_vars['capture']['imageNameCapture'] = ob_get_contents();  $this->assign('imageName', ob_get_contents());ob_end_clean(); ?>
<a href="<?php echo $this->_tpl_vars['fields']['doc_url']['value']; ?>
" class="tabDetailViewDFLink" target="_blank"><?php echo smarty_function_sugar_getimage(array('name' => $this->_tpl_vars['imageName'],'alt' => $this->_tpl_vars['imageName'],'other_attributes' => 'border="0" '), $this);?>
</a>
<?php endif; ?>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_DATE_ENTERED','module' => 'DocumentRevisions'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="datetime" field="date_entered" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['date_entered']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>

<span id="date_entered" class="sugar_field"><?php echo $this->_tpl_vars['fields']['date_entered']['value']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_BY']; ?>
 <?php echo $this->_tpl_vars['fields']['created_by_name']['value']; ?>
</span>
<?php endif; ?>

</div>


</div>

</div>


<div class="row detail-view-row">



<div class="col-xs-12 col-sm-12 detail-view-row-item">


<div class="col-xs-12 col-sm-2 label col-1-label">


<?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_CHANGE_LOG','module' => 'DocumentRevisions'), $this);?>
<?php $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</div>


<div class="col-xs-12 col-sm-10 detail-view-field" type="varchar" field="change_log" colspan='3'>

<?php if (! $this->_tpl_vars['fields']['change_log']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','print' => false), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['change_log']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['change_log']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['change_log']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['change_log']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['change_log']['value']; ?>
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