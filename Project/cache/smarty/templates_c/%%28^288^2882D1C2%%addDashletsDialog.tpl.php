<?php /* Smarty version 2.6.31, created on 2021-03-08 09:41:21
         compiled from themes/SuiteP/include/MySugar/tpls/addDashletsDialog.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_translate', 'themes/SuiteP/include/MySugar/tpls/addDashletsDialog.tpl', 44, false),array('function', 'counter', 'themes/SuiteP/include/MySugar/tpls/addDashletsDialog.tpl', 72, false),array('modifier', 'lower', 'themes/SuiteP/include/MySugar/tpls/addDashletsDialog.tpl', 78, false),array('modifier', 'replace', 'themes/SuiteP/include/MySugar/tpls/addDashletsDialog.tpl', 78, false),)), $this); ?>
<div align="right" id="dashletSearch">
	<table>
		<tr>
			<td><?php echo smarty_function_sugar_translate(array('label' => 'LBL_DASHLET_SEARCH','module' => 'Home'), $this);?>
: <input id="search_string" type="text" length="15" onKeyPress="javascript:if(event.keyCode==13)SUGAR.mySugar.searchDashlets(this.value,document.getElementById('search_category').value);"  title="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_DASHLET_SEARCH','module' => 'Home'), $this);?>
"/>
			<input type="button" class="button" value="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_SEARCH','module' => 'Home'), $this);?>
" onClick="javascript:SUGAR.mySugar.searchDashlets(document.getElementById('search_string').value,document.getElementById('search_category').value);" />
			<input type="button" class="button" value="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_CLEAR','module' => 'Home'), $this);?>
" onClick="javascript:SUGAR.mySugar.clearSearch();" />			
			<?php if ($this->_tpl_vars['moduleName'] == 'Home'): ?>
			<input type="hidden" id="search_category" value="module" />
			<?php else: ?>
			<input type="hidden" id="search_category" value="chart" />
			<?php endif; ?>
			</td>
		</tr>
	</table>
	<br>
</div>

<?php if ($this->_tpl_vars['moduleName'] == 'Home'): ?>
 <ul class="subpanelTablist" id="dashletCategories">
	<li id="moduleCategory" class="active"><a href="javascript:SUGAR.mySugar.toggleDashletCategories('module');" class="current" id="moduleCategoryAnchor"><span class="suitepicon suitepicon-module-default"></span><?php echo smarty_function_sugar_translate(array('label' => 'LBL_MODULES','module' => 'Home'), $this);?>
</a></li>
	<li id="chartCategory" class=""><a href="javascript:SUGAR.mySugar.toggleDashletCategories('chart');" class="" id="chartCategoryAnchor"><span class="suitepicon suitepicon-dashlet-charts-groupby"></span><?php echo smarty_function_sugar_translate(array('label' => 'LBL_CHARTS','module' => 'Home'), $this);?>
</a></li>
	<li id="toolsCategory" class=""><a href="javascript:SUGAR.mySugar.toggleDashletCategories('tools');" class="" id="toolsCategoryAnchor"><span class="suitepicon suitepicon-dashlet-jotpad"></span><?php echo smarty_function_sugar_translate(array('label' => 'LBL_TOOLS','module' => 'Home'), $this);?>
</a></li>
	<li id="webCategory" class=""><a href="javascript:SUGAR.mySugar.toggleDashletCategories('web');" class="" id="webCategoryAnchor"><span class="suitepicon suitepicon-action-home"></span><?php echo smarty_function_sugar_translate(array('label' => 'LBL_WEB','module' => 'Home'), $this);?>
</a></li>
</ul>
<?php endif; ?>

<?php if ($this->_tpl_vars['moduleName'] == 'Home'): ?>
<div id="moduleDashlets" style="height:400px;display:;">
	<h3><span class="suitepicon suitepicon-module-default"></span><?php echo smarty_function_sugar_translate(array('label' => 'LBL_MODULES','module' => 'Home'), $this);?>
</h3>
	<div id="moduleDashletsList" style="height:394px;overflow:auto;display:;">
	<table width="95%">
		<?php echo smarty_function_counter(array('assign' => 'rowCounter','start' => 0,'print' => false), $this);?>

		<?php $_from = $this->_tpl_vars['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['module']):
?>
		<?php if ($this->_tpl_vars['rowCounter'] % 2 == 0): ?>
		<tr>
		<?php endif; ?>
			<td width="50%" align="left"><a id="<?php echo $this->_tpl_vars['module']['id']; ?>
_icon" href="javascript:void(0)" onclick="<?php echo $this->_tpl_vars['module']['onclick']; ?>
" style="text-decoration:none">
					<span class="suitepicon suitepicon-module-<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['module']['module_name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('replace', true, $_tmp, '_', '-') : smarty_modifier_replace($_tmp, '_', '-')); ?>
"></span>
					<span id="mbLBLL" class="mbLBLL"><?php echo $this->_tpl_vars['module']['title']; ?>
</span></a><br /></td>
		<?php if ($this->_tpl_vars['rowCounter'] % 2 == 1): ?>
		</tr>
		<?php endif; ?>
		<?php echo smarty_function_counter(array(), $this);?>

		<?php endforeach; endif; unset($_from); ?>
	</table>
	</div>
</div>
<?php endif; ?>
<div id="chartDashlets" style="<?php if ($this->_tpl_vars['moduleName'] == 'Home'): ?>height:400px;display:none;<?php else: ?>height:425px;display:;<?php endif; ?>">
	<?php if ($this->_tpl_vars['charts'] != false): ?>
	<h3><span id="basicChartDashletsExpCol"><a href="javascript:void(0)" onClick="javascript:SUGAR.mySugar.collapseList('basicChartDashlets');"><span class="suitepicon suitepicon-dashlet-charts-groupby"></span></span></a>&nbsp;<?php echo smarty_function_sugar_translate(array('label' => 'LBL_BASIC_CHARTS','module' => 'Home'), $this);?>
</h3>
	<div id="basicChartDashletsList">
	<table width="100%">
		<?php $_from = $this->_tpl_vars['charts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a'] => $this->_tpl_vars['chart']):
?>
		<tr>
			<td align="left"><a href="javascript:void(0)" onclick="<?php echo $this->_tpl_vars['chart']['onclick']; ?>
"><span class="suitepicon suitepicon-module-<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['chart']['icon'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('replace', true, $_tmp, '_', '-') : smarty_modifier_replace($_tmp, '_', '-')); ?>
"></span></a>&nbsp;<a class="mbLBLL" href="#" onclick="<?php echo $this->_tpl_vars['chart']['onclick']; ?>
"><?php echo $this->_tpl_vars['chart']['title']; ?>
</a><br /></td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
	</table>
	</div>
	<?php endif; ?>
</div>

<?php if ($this->_tpl_vars['moduleName'] == 'Home'): ?>
<div id="toolsDashlets" style="height:400px;display:none;">
	<h3><?php echo smarty_function_sugar_translate(array('label' => 'LBL_TOOLS','module' => 'Home'), $this);?>
</h3>
	<div id="toolsDashletsList">
	<table width="95%">
		<?php echo smarty_function_counter(array('assign' => 'rowCounter','start' => 0,'print' => false), $this);?>

		<?php $_from = $this->_tpl_vars['tools']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tool']):
?>
		<?php if ($this->_tpl_vars['rowCounter'] % 2 == 0): ?>
		<tr>
		<?php endif; ?>
			<td align="left"><a href="javascript:void(0)" onclick="<?php echo $this->_tpl_vars['tool']['onclick']; ?>
"<span class="suitepicon suitepicon-dashlet-<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tool']['icon'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('replace', true, $_tmp, '_', '-') : smarty_modifier_replace($_tmp, '_', '-')); ?>
"></span></a>&nbsp;<a class="mbLBLL" href="#" onclick="<?php echo $this->_tpl_vars['tool']['onclick']; ?>
"><?php echo $this->_tpl_vars['tool']['title']; ?>
</a><br /></td>
		<?php if ($this->_tpl_vars['rowCounter'] % 2 == 1): ?>
		</tr>
		<?php endif; ?>
		<?php echo smarty_function_counter(array(), $this);?>

		<?php endforeach; endif; unset($_from); ?>
	</table>
	</div>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['moduleName'] == 'Home'): ?>
<div id="webDashlets" style="height:400px;display:none;">
	<div id="webDashletsList">
	<table width="95%">
	    <tr>
	        <td scope="row"><?php echo smarty_function_sugar_translate(array('label' => 'LBL_WEBSITE_TITLE','module' => 'Home'), $this);?>
</td>
	        <td>
				<input type="text" id="web_address" value="http://" style="width: 400px"   title="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_WEBSITE_TITLE','module' => 'Home'), $this);?>
"/>
				<input type="button" name="create" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_BUTTON']; ?>
" onclick="return SUGAR.mySugar.addDashlet('iFrameDashlet', 'web', document.getElementById('web_address').value);" />
			</td>
        </tr>
		<tr>
			<td scope="row"><?php echo smarty_function_sugar_translate(array('label' => 'LBL_RSS_TITLE','module' => 'Home'), $this);?>
</td>
			<td>
				<input type="text" id="rss_address" value="http://" style="width: 400px"  title="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_RSS_TITLE','module' => 'Home'), $this);?>
" />
				<input type="button" name="create" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_BUTTON']; ?>
" onclick="return SUGAR.mySugar.addDashlet('RSSDashlet', 'web', document.getElementById('rss_address').value);" />
			</td>
		</tr>
    </table>
	</div>
</div>
<?php endif; ?>

<div id="searchResults" style="display:none;<?php if ($this->_tpl_vars['moduleName'] == 'Home'): ?>height:400px;<?php else: ?>height:425px;<?php endif; ?>">
</div>