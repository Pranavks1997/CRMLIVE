<div id="tab_30days_content">
    <!-- sub tab under -->
    <br>
    <div class="inside_tab">
        <input class="input_radio_insideTab" id="one" name="group" type="radio" checked>
        <input class="input_radio_insideTab" id="two" name="group" type="radio">
        <input class="input_radio_insideTab" id="three" name="group" type="radio">
        <div class="tabs_container">
            <label class="tab_header_btn" id="one-tab" for="one" onclick="changeAddLabel('Create Opportunity')">Opportunity</label>
            <label class="tab_header_btn" id="two-tab" for="two" onclick="changeAddLabel('Create Activity')">Activity</label>
            <label class="tab_header_btn" id="three-tab" for="three">Document</label>
        </div>
        <div class="tab_panels_container">
            <div class="tab_panel_inside" id="one-panel">
                <?php include_once 'opportunity.php'; ?>
            </div>
            <div class="tab_panel_inside" id="two-panel">
                <?php include_once 'activity.php'; ?>
            </div>
            <div class="tab_panel_inside" id="three-panel">
                <?php include_once 'document.php'; ?>
            </div>
        </div>
    </div>
    <!-- sub tab under end  -->
</div>