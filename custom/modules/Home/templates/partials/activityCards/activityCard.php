<div style="display: flex; flex-direction: column; margin: 10px;width: 200px;">
    <p style="width: 150px;color: grey;font-size: 16px;padding-left: 5px;" id="daysFilterContainer">
        <span id="daysFilterAllLabelAct"></span> 
        <span id="daysFilterAct">Activities over last</span> 
        <span id="act-daysFilter">30</span> 
        <span id="daysFilterDays">days</span> 
    </p>
    <div style="display: flex; margin-top: 10px">
        <button id="organizationTotal" style="background-color: transparent;color: #000000;border-radius: 5px;margin: 0 5px;border: 1px solid transparent;display: flex;align-items: center;flex-direction: column;cursor: pointer;">
            <span style="font-size: 18px; font-weight: 600px; text-align: center" id="orgActivityCount"></span>
            <span style="color: grey; font-size: 10px;">Organization</span>
        </button>
        <button style="margin: 0 5px;background-color: transparent;color: #000000;border-radius: 5px;border: 1px solid transparent;display: flex;align-items: center;flex-direction: column;cursor: pointer;">
            <span style="font-size: 18px; font-weight: 600px; text-align: center" id="myTeamActivityCount"></span>
            <span style="color: grey; font-size: 10px;">My Team</span>
        </button>
        <button style="background-color: #fff;color: black;margin: 0 5px;width: 40px;border-radius: 5px;border: none;display: flex;align-items: center;flex-direction: column;cursor: pointer;">
            <span style="font-size: 18px; font-weight: 600px; text-align: center" id="selfActivityCount"></span>
            <span style="color: grey; font-size: 10px;">Self</span>
        </button>
    </div>
</div>