

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}

	<input type="hidden" id="{$fields.teamfunction_c.name}_multiselect"
	name="{$fields.teamfunction_c.name}_multiselect" value="true">
	{multienum_to_array string=$fields.teamfunction_c.value default=$fields.teamfunction_c.default assign="values"}
	<select id="{$fields.teamfunction_c.name}"
	name="{$fields.teamfunction_c.name}[]"
	multiple="true" size='6' style="width:150" title='' tabindex="1"  
     	>
	{html_options options=$fields.teamfunction_c.options selected=$values}
	</select>

{else}

	{assign var="field_options" value=$fields.teamfunction_c.options }
	{capture name="field_val"}{$fields.teamfunction_c.value}{/capture}
	{assign var="field_val" value=$smarty.capture.field_val}
	{capture name="ac_key"}{$fields.teamfunction_c.name}{/capture}
	{assign var="ac_key" value=$smarty.capture.ac_key}

			<input type="hidden" id="{$fields.teamfunction_c.name}_multiselect"
		name="{$fields.teamfunction_c.name}_multiselect" value="true">
		{multienum_to_array string=$fields.teamfunction_c.value default=$fields.teamfunction_c.default assign="values"}
		<select style='display:none' id="{$fields.teamfunction_c.name}"
		name="{$fields.teamfunction_c.name}[]"
		multiple="true" size='6' style="width:150" title='' tabindex="1"  
		        >
		{html_options options=$fields.teamfunction_c.options selected=$values}
		</select>

		<input
	    id="{$fields.teamfunction_c.name}-input"
	    name="{$fields.teamfunction_c.name}-input"
	    size="60"
	    type="text" style="vertical-align: top;">
	
	<span class="id-ff multiple">
	    <button type="button">
	    	<img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.teamfunction_c.name}-image">
	    	</button>
	    	<button type="button"
	        id="btn-clear-{$fields.teamfunction_c.name}-input"
	        title="Clear"
	        onclick="SUGAR.clearRelateField(this.form, '{$fields.teamfunction_c.name}-input', '{$fields.teamfunction_c.name};');SUGAR.AutoComplete.{$ac_key}.inputNode.updateHidden()"><span class="suitepicon suitepicon-action-clear"></span></button>
	</span>

	{literal}
	<script>
	SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
	{/literal}

			{literal}
		YUI().use('datasource', 'datasource-jsonschema', function (Y) {
					SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
					    source: function (request) {
					    	var selectElem = document.getElementById("{/literal}{$fields.teamfunction_c.name}{literal}");
					    	var ret = [];
					    	for (i=0;i<selectElem.options.length;i++)
					    		if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
					    			ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
					    	return ret;
					    }
					});
				});
		{/literal}
	
	{literal}
	YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters","node-event-simulate", function (Y) {
		{/literal}
		
	    SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.teamfunction_c.name}-input');
	    SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.teamfunction_c.name}-image');
	    SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.teamfunction_c.name}');

					SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
			SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
			SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
			if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
				{/literal}
				SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
				SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
				{literal}
			}
			{/literal}
			if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
				{/literal}
				SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
				SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
				{literal}
			}
			{/literal}
				
				{literal}
	    SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
	        activateFirstItem: true,
	        allowTrailingDelimiter: true,
			{/literal}
	        minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
	        queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
	        queryDelimiter: ',',
	        zIndex: 99999,

						{literal}
			source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
			
	        resultTextLocator: 'text',
	        resultHighlighter: 'phraseMatch',
	        resultFilters: 'phraseMatch',
	        // Chain together a startsWith filter followed by a custom result filter
	        // that only displays tags that haven't already been selected.
	        resultFilters: ['phraseMatch', function (query, results) {
		        // Split the current input value into an array based on comma delimiters.
	        	var selected = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value').split(/\s*,\s*/);
	        
	            // Convert the array into a hash for faster lookups.
	            selected = Y.Array.hash(selected);

	            // Filter out any results that are already selected, then return the
	            // array of filtered results.
	            return Y.Array.filter(results, function (result) {
	               return !selected.hasOwnProperty(result.text);
	            });
	        }]
	    });
		{/literal}{literal}
		if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
		    // expand the dropdown options upon focus
		    SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
		        SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
		    });
		}

				    SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateHidden = function() {
				var index_array = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value').split(/\s*,\s*/);

				var selectElem = document.getElementById("{/literal}{$fields.teamfunction_c.name}{literal}");

				var oTable = {};
		    	for (i=0;i<selectElem.options.length;i++){
		    		if (selectElem.options[i].selected)
		    			oTable[selectElem.options[i].value] = true;
		    	}

				for (i=0;i<selectElem.options.length;i++){
					selectElem.options[i].selected=false;
				}

				var nTable = {};

				for (i=0;i<index_array.length;i++){
					var key = index_array[i];
					for (c=0;c<selectElem.options.length;c++)
						if (selectElem.options[c].innerHTML == key){
							selectElem.options[c].selected=true;
							nTable[selectElem.options[c].value]=1;
						}
				}

				//the following two loops check to see if the selected options are different from before.
				//oTable holds the original select. nTable holds the new one
				var fireEvent=false;
				for (n in nTable){
					if (n=='')
						continue;
		    		if (!oTable.hasOwnProperty(n))
		    			fireEvent = true; //the options are different, fire the event
		    	}
		    	
		    	for (o in oTable){
		    		if (o=='')
		    			continue;
		    		if (!nTable.hasOwnProperty(o))
		    			fireEvent=true; //the options are different, fire the event
		    	}

		    	//if the selected options are different from before, fire the 'change' event
		    	if (fireEvent){
		    		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
		    	}
		    };

		    SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateText = function() {
		    	//get last option typed into the input widget
		    	SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.set(SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'));
				var index_array = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value').split(/\s*,\s*/);
				//create a string ret_string as a comma-delimited list of text from selectElem options.
				var selectElem = document.getElementById("{/literal}{$fields.teamfunction_c.name}{literal}");
				var ret_array = [];

                if (selectElem==null || selectElem.options == null)
					return;

				for (i=0;i<selectElem.options.length;i++){
					if (selectElem.options[i].selected && selectElem.options[i].innerHTML!=''){
						ret_array.push(selectElem.options[i].innerHTML);
					}
				}

				//index array - array from input
				//ret array - array from select

				var sorted_array = [];
				var notsorted_array = [];
				for (i=0;i<index_array.length;i++){
					for (c=0;c<ret_array.length;c++){
						if (ret_array[c]==index_array[i]){
							sorted_array.push(ret_array[c]);
							ret_array.splice(c,1);
						}
					}
				}
				ret_string = ret_array.concat(sorted_array).join(', ');
				if (ret_string.match(/^\s*$/))
					ret_string='';
				else
					ret_string+=', ';
				
				//update the input widget
				SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.set('value', ret_string);
		    };

		    function updateTextOnInterval(){
		    	if (document.activeElement != document.getElementById("{/literal}{$fields.teamfunction_c.name}-input{literal}"))
		    		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateText();
		    	setTimeout(updateTextOnInterval,100);
		    }

		    updateTextOnInterval();
		
					SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
				SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
			});
			
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
				SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
			});

			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
				SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
			});

			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
				SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
			});

			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
				SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
			});

			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
				SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
			});
		
		SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function () {
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateHidden();
			SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateText();
		});
	
	    // when they click on the arrow image, toggle the visibility of the options
	    SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.on('click', function () {
			if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
				SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
				SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.show();
			}
			else{
				SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
			}
	    });
	
		if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
		    // After a tag is selected, send an empty query to update the list of tags.
		    SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.after('select', function () {
		      SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
		      SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.show();
			  SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateHidden();
			  SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateText();
		    });
		} else {
		    // After a tag is selected, send an empty query to update the list of tags.
		    SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.after('select', function () {
			  SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateHidden();
			  SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateText();
		    });
		}
	});
	</script>
	{/literal}
{/if}