<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
require_once('include/MVC/Controller/SugarController.php');

?>
<html>

<head>
    <title> Dashboard </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- <script src="https://code.jquery.com/jquery-migrate-3.3.2.min.js" integrity="sha256-Ap4KLoCf1rXb52q+i3p0k2vjBsmownyBTE1EqlRiMwA=" crossorigin="anonymous"></script> -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        var jq = jQuery.noConflict();
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
    <!-- <link rel="stylesheet" type="text/css" href="index.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
    
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/handsontable@8.3.1/dist/handsontable.full.min.js"></script>
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable@8.3.1/dist/handsontable.full.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

</head>
<style>
        * {
            margin: 0;
            padding: 0;
            /* scroll-behavior: smooth; */
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .d-inline-block{ display: inline-block; }

        ul {
            list-style: none;
        }

        body {
            margin: 0px;
            font-family: "Noto Sans JP", sans-serif;
            font-size: 14px;
            background-color: #fffcf5;
        }

        /* Nav header */
        

        .show {
            display: block;
        }

        .daterangepicker {
            position: fixed !important;
            top: 100px !important;
            overflow-y: auto;
        }
        

        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }
        .container-fulid {
            display: none;
        }

        #search-btn {
            background-color: transparent;
            border: none;
            display: flex;
            outline: none;
            justify-content: flex-end;
            cursor: pointer;
        }

        #search-icon {
            font-size: 1.8rem;
            color: #fff;
            margin: 0;
            margin-top: 0.2rem;
            text-decoration: none;
            background-color: #3f3e3a;
        }

        #search-input {
            border-block: revert;
            min-width: 790px;
            /* margin-top: 20px; */
            height: 55px;
            margin: 0 0 10px 0;
        }

        #notification-icon {
            font-size: 1.3rem;
            color: #fff;
            margin-top: 0.2rem;
            text-decoration: none;
            background-color: #3f3e3a;
        }

        #user-icon {
            font-size: 1.3rem;
            color: #fff;
            margin-top: 0.2rem;
            text-decoration: none;
            background-color: #3f3e3a;
        }
        input[type="search"] {
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
            -webkit-appearance: searchfield !important;
        }

        input[type="search"]::-webkit-search-cancel-button {
            -webkit-appearance: searchfield-cancel-button !important;
        }

        /* Modal Content */
        .search_dialogbox_content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 80%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s;
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {
                top: -300px;
                opacity: 0;
            }

            to {
                top: 0;
                opacity: 1;
            }
        }

        @keyframes animatetop {
            from {
                top: -300px;
                opacity: 0;
            }

            to {
                top: 0;
                opacity: 1;
            }
        }

        /* The Close Button */
        .close {
            color: white;
            float: right;
            font-size: 28px;
            font-weight: bold;
            margin: -5px -5px;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .search-dialogbox-header {
            padding: 2px 16px;
            background-color: #5cb85c;
            color: white;
        }

        .modal-body {
            padding: 2px 16px;
        }

        .modal-footer {
            padding: 2px 16px;
            background-color: #5cb85c;
            color: white;
        }

        .searchhh {
            margin-top: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
            height: 30px;
        }

        .searchhh>.fa-search {
            padding-top: 5px;
            font-size: 1.5rem !important;
            align-self: center !important;
            color: #64635f !important;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 0 5px 5px 0;
            padding: 5px;
            height: 30px;
            margin-top: 5px;
            background-color: white !important;
        }

        .filter {
            margin-top: 5px;
            background-color: transparent;
            justify-content: center;
            align-items: center;
        }

        .cog {
            margin-top: 12px;
            margin-right: 10px;
            background-color: transparent;
            justify-content: center;
            align-items: center;
        }

        .filter>.fa-filter {
            font-size: 2rem;
            color: white;
            padding: 5px;
            margin: 0 5px;
        }

        .download{ border: none!important; }
        .cog>.fa-list,
        .download .fa {
            font-size: 2rem !important;
            background-color: transparent !important;
            color: white;
            padding: 5px;
        }

        .tag,.tag1 {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: transparent;
        }

        .tag>.fa-tag, .tag1>.fa-tag {
            color: black !important;
            background-color: transparent !important;
        }

        .eye {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .eye>.fa-eye {
            color: black !important;
            margin-left: 10px;
            background-color: transparent !important;
        }

        .search-box {
            line-height: 49px;
            display: flex;
            justify-content: flex-end;
        }

        .search-box>button {
            border: none !important;
        }

        .search-box input:first-child {
            height: 30px;
            background: white;
            border: none;
            background-color: white;
            margin-top: 5px;
            margin-bottom: 2px;
            border-radius: 4px 0 0 4px;
            min-width: 180px;
            padding-left: 10px;
        }

        .setArrow ::after {
            content: " ";
            position: absolute;
            right: 550px;
            bottom: 160px;
            border-top: 15px solid #242422;
            border-right: 15px solid transparent;
            border-left: 15px solid transparent;
            border-bottom: none;
        }

        .search-box input:last-child {
            min-width: 60px;
            border: none;
            height: 42px;
            margin-left: -5px;
            color: #fff;
            background: #343434;
            border-radius: 0 8px 8px 0;
        }

        .search-box-block {
            max-width: calc(100% - 580px);
            width: 100%;
            float: none;
            /* text-align: right; */
            margin-left: auto;
            margin-right: 10px;
        }

        #submit {
            font-size: 1.1rem;
            margin-top: 0.5rem;
            padding: 10px 10px;
            background-color: #2980b9;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 0.5rem;
        }

        div>.oppertunityBtn {
            font-size: 1rem !important;
            width: 200px;
            height: 40px;
            padding: 8px;
            margin-right: 40px;
            color: #fff;
            background-color: #000;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            outline: none;
            border: 2px solid transparent;
        }

        .oppertunityBtn>.fa-plus {
            font-size: 1rem;
        }

        div>.oppertunityBtn:hover {
            color: #000;
            background-color: #fff;
            border: 2px solid #212121;
        }

        .tab_30_days {
            overflow: hidden;
            display: flex;
            margin-left: 40px;
        }

        /* Style the buttons inside the tab */
        .tab_30_days button {
            background-color: inherit;
            font-family: 'Lato', Arial, Sans-serif;
            border: none;
            font-size: 12px;
            text-align: center;
            outline: none;
            padding: 0px 3px;
            cursor: pointer;
            height: 20px;
            display: inline-block;
            font-weight: 900;
            color: #c2c2c2;
            margin: 0;
        }

        .btn-30-days:hover {
            color: black;
            font-weight: bolder !important;
        }
        /*.btn-30-days:focus {*/
        /*    color: black !important;*/
            /* font-size: 1.6rem !important; */
        /*}*/

        /*.btn-30-days:active {*/
        /*    color: black !important;*/
        /*    font-size: 1.6rem !important;*/
        /*}*/

        /* checkbox fix  if it works then its  amazing*/

        input[type="checkbox"] {
            -webkit-appearance: initial;
            background: white;
            width: 20px !important;
            height: 20px !important;
            border: 1px solid black;
            position: relative;
        }

        input[type="checkbox"]:checked {
            background: white;
        }

        input[type="checkbox"]:checked:after {
            content: "\2713\0020";
            color: black;
            font-Size: 14px;
            position: absolute;
            top: 5%;
            left: 30%;

            /* content"";
        height: 100%;
        width : 100%;
        background: blue; */
        }



        /* #################################### */

        /* Change background color of buttons on hover */
        /* .tab_30_days button:hover {
            background-color: transparent;
            border-radius: 0.5rem;
            color: black;
        } */

        /* Create an active/current tablink class */
        .tab_30_days button:active {
            border-radius: 0.5rem;
            background-color: #fffefa;
            color: red;
            /* border-bottom: 2px solid orange; */
        }

        /* Style the tab content */
        #tab_30days_content {
            display: none;
            padding: 6px 12px;
            max-width: 1400px;
            margin: auto;
        }

        /* /sub tab */

        .inside_tab {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-left: 1rem;
            margin-top: 10px;
        }

        .tab_header_btn {
            cursor: pointer;
            padding: 10px 20px;
            margin: 0px 2px;
            display: inline-block;
            color: #000;
            font-size: 15px;
            border-radius: 3px 3px 0px 0px;
        }

        .tab_panels_container {
            min-height: 200px;
            width: 100%;
            border-radius: 3px;
            overflow: hidden;
            padding: 20px;
        }
        #filter_clear {
            cursor: pointer;
        }

        .tab_panel_inside {
            display: none;
            animation: fadein 0.8s;
        }

        @keyframes fadein {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .input_radio_insideTab {
            display: none !important;
        }

        #one:checked~.tab_panels_container #one-panel,
        #two:checked~.tab_panels_container #two-panel,
        #three:checked~.tab_panels_container #three-panel {
            display: block;
        }

        #one:checked~.tabs_container #one-tab,
        #two:checked~.tabs_container #two-tab,
        #three:checked~.tabs_container #three-tab {
            /* background: #fffefa; */
            color: #ef7647;
            text-decoration: underline;
            /* border-bottom: 2px solid orange; */
        }

        /* sub tab end */

        /* card */

        .main {
            /* max-width: 1200px; */
            margin: 0 auto;
        }

        .btn {
            color: #ffffff;
            padding: 0.8rem;
            font-size: 10px;
            text-transform: uppercase;
            border-radius: 4px;
            font-weight: 400;
            display: block;
            width: 30%;
            cursor: pointer;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: transparent;
        }

        .btn:hover {
            background-color: rgba(255, 255, 255, 0.12);
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .cards_item1 {
            display: flex;
            padding: 0.5rem;
        }

        .cards_item2 {
            display: flex;
            padding: 0.5rem;
        }

        .cards_item3 {
            display: flex;
            padding: 0.5rem;
        }

        @media (min-width: 40rem) {
            .cards_item1 {
                width: 10%;
            }

            .cards_item2 {
                width: 10%;
            }

            .cards_item3 {
                width: 10%;
            }
        }

        @media (min-width: 56rem) {
            .cards_item1 {
                width: 15%;
            }

            .cards_item2 {
                width: 15%;
            }

            .cards_item3 {
                width: 70%;
            }
        }

        .card {
            background-color: white;
            border-radius: 0.25rem;
            box-shadow: 0px 0px 1px 0px #444;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .card_content {
            padding: 10px;
        }

        .card_title {
            color: #000;
            opacity: 0.9;
            font-size: 12px;
            font-weight: normal;
            letter-spacing: 1px;
            text-transform: capitalize;
            margin: 0px;
            margin-bottom: 10px;
            display: block;
        }

        .card_text {
            color: #ffffff;
            font-size: 0.2rem;
            line-height: 1.5;
            font-weight: 400;
        }

        /* card end */

        /* card - status */
        .card-container {
            display: flex;
            flex-direction: row;
        }

        .card-status {
            /* box-shadow: 0 2px 2px 0 rgba(0,0,0,0.1); */
            transition: 0.3s;
            width: 30%;
            padding: 10px 6px;
            display: flex;
            background-color: white;
            justify-content: space-around;
            margin-right: 0.8rem;
            margin-top: 0.5rem;
            border-radius: 0.8rem;
            cursor: pointer;
        }

        .card-status:hover {
            box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.1);
            background-color: #212121;
            color: #fff;
        }

        .card-status-head {
            font-size: 12px;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            font-weight: bold;
            padding-top: 0.8rem;
        }
        .dropped-card-head {
            padding-top: 0;
        }

        .card-status-number,
        .card-status-number-two,
        .card-status-number-three {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 600;
            font-size: 12px;
            margin-left: 0.5rem;
        }

        .card-status-subtitle,
        .card-status-subtitle-two,
        .card-status-subtitle-three {
            opacity: 0.6;
            font-size: 1rem;
            margin-left: 0.5rem;
        }

        #card-status-icon {
            font-size: 0.6rem;
            width: 5%;
            cursor: pointer;
        }

        .card-status-top {
            margin-top: 0.7rem;
            text-align: center;
        }

        .card-status-number:hover {
            color: orange;
            border: 1px orange !important;
        }

        .card-status-number-two:hover {
            color: orange;
            border-top: 1px orange;
        }

        .card-status-number-three:hover {
            color: orange;
            border-top: 1px orange;
        }

        /*
    card-status-end */
        .approvalmodal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .approvalmodal-content {
            background-color: #fefefe;
            margin: 8% auto;
            /* 15% from the top and centered */
            border-radius: 5px;
            width: 50%;
            /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        /* Approval popup start */
        .approvalclose {
            color: #aaa;
            float: right;
            font-size: 28px;
            margin-top: 25px;
            padding-right: 20px;
        }

        .approvalclose:hover,
        .approvalclose:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .approvalheading {
            font-size: 20px;
            font-family: Arial;
            padding-top: 20px;
            padding-left: 20px;
        }

        .approvalsubhead {
            margin-top: -15px;
            font-family: Arial;
            font-size: 15px;
            padding-left: 20px;
        }

        .approvaltable {
            border-collapse: collapse;
            border-spacing: 0;
            width: 99.8%;
            box-shadow: 1px 1px 1px 1px #E5E4E2;
        }

        th,
        td {
            text-align: left;
            padding: 10px;
            font-family: 'Noto Sans JP', sans-serif;
        }

        .approvaltable-header-popup {
            font-size: 1.2rem;
        }
        

        .approvaltable-data-popup {
            font-size: 1.05rem;
        }

        tr:hover {
            background-color: transparent !important;
            color: black !important;
            /* font-weight: bold !important; */
        }

        .handsontable td, .handsontable th, .handsontable th:last-child {
            border: 0px !important;
        }
        .handsontable td, .handsontable th, .handsontable th:last-child {
            border: 0px !important;
        }
        .handsontable.htRowHeaders thead tr th:nth-child(2), .handsontable td:first-of-type, .handsontable th:first-child, .handsontable th:nth-child(2) {
            border: 0px !important;
        }

        .calendar-table .table-condensed tbody tr:hover {
            background-color: transparent !important;
            color: #000 !important;
        }

        .table-data-boolean-popup {
            font-size: .8rem;
            text-align: center;
        }

        span {
            font-family: Arial;
        }
        #deselectBtn, #reassignmentBtn {
            border: none !important;
            margin: 0;
        }
        .non-global-opportunities #deselectBtn #search-icon {
            color: green !important;
        }
        .global-opportunities #deselectBtn #search-icon{
            color: red !important;
        }

        .approvaltextarea {
            width: 94%;
            margin-top: 10px;
            margin-left: 20px;
            margin-bottom: 10px;
        }

        .approvalinput[type="radio"] {
            display: none;
        }

        .approvalinput[type="radio"]+*::before {
            content: "";
            display: inline-block;
            vertical-align: bottom;
            width: 0.8rem;
            height: 0.8rem;
            margin-right: 0.3rem;
            border-radius: 50%;
            border-style: solid;
            border-width: 0.1rem;
            border-color: black;
        }

        .approvalinput[type="radio"]:checked+* {
            color: black;
        }

        .approvalinput[type="radio"]:checked+*::before {
            background: radial-gradient(black 0%, black 40%, transparent 50%, transparent);
            border-color: black;
        }


        .btn2 {
            height: 35px;
            width: 90px;
            background: white;
            border-color: black;
            border-size: 0.4px;
            color: black;
            font-family: Arial;
            border-radius: 5px;
        }

        /* Approval popup end */
        /* table */

        .table-ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            border-radius: 10px 10px 0 0;
            overflow: hidden;
            background-color: #64635f;
            display: flex;
            flex-direction: row;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #111;
        }

        /* #option_one:checked~.option_tabs_container #option_one-tab,
        #option_two:checked~.option_tabs_container #option_two-tab,
        #option_three:checked~.option_tabs_container #option_three-tab {
            background: #fffefa;
            color: #ef7647;
        } */

        .option_tab_header_btn:hover {
            background: black;
            border-radius: 5px;
        }

        .selected-option-head {
            background: black;
        }

        .global-opportunities {
            font-size: 1.4rem;
            font-weight: bold;
            padding: 10px 10px;
            color: white;
            opacity: 0.8;
            border-radius: 10px;
            height: 45px;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .non-global-opportunities, .prt-top-headings {
            font-size: 1.4rem;
            font-weight: bold;
            padding: 10px 10px;
            opacity: 0.8;
            color: white;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            cursor: pointer;
            height: 45px;
        }
        .global-opportunities:hover, .non-global-opportunities:hover, .global-opportunities:focus ,.non-global-opportunities:focus  {
            background-color: black !important;
            border-radius: 5px;
        }

        .g-op:focus {
            background-color: black !important;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        .table-header-row {
            background-color: #e8e7e2;
        }

        .table-header {
            font-size: 12px;
            font-weight: bold;
            text-align: left;
            padding: 10px;
        }

        .table-data {
            text-align: left;
            font-size: 12px;
            padding: 10px;
            min-width: 85px;
            max-width: 200px;
        }

        /* tr:hover {
        background-color: grey;
        color: #fff;
    } */
        .table-data-boolean {
            font-size: 12px;
            text-align: left;
        }

        /* table-end */
        /*click here button starts here*/
        .click-me {
            display: inline-block;
            padding: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: black;
            font-weight: bolder;
            text-decoration: none;
        }

        .click-me:hover {
            background-color: unset;
            text-decoration: underline;
        }

        /*click here button ends here*/
        /*responsive for 1400px screen*/
        .W1400px {
            max-width: 1400px;
            margin: auto;
        }

        /*responsive for 1400px screen*/
        /*approved color block*/
        .approved-block {
            display: inline-block;
            vertical-align: middle;
            margin: 0 15px;
        }

        /*approved color block*/
        .color-block1 {
            width: 5px;
            height: 10px;
            background: #DDA0DD;
            display: inline-block;
            vertical-align: middle;
        }

        .color-block2 {
            width: 5px;
            height: 10px;
            background: #0000FF;
            display: inline-block;
            vertical-align: middle;
        }

        .color-block3 {
            width: 5px;
            height: 10px;
            background: #00FF00;
            display: inline-block;
            vertical-align: middle;
        }

        .color-block4 {
            width: 5px;
            height: 10px;
            background: #FFFF00;
            display: inline-block;
            vertical-align: middle;
        }

        .color-block5 {
            width: 5px;
            height: 10px;
            background: #FF7F00;
            display: inline-block;
            vertical-align: middle;
        }

        .color-block6 {
            width: 5px;
            height: 10px;
            background: #FF0000;
            display: inline-block;
            vertical-align: middle;
        }

        .color-block.light-red {
            background-color: yellow;
        }

        .color-block.green {
            background-color: green;
        }

        .color-list li {
            float: none;
            display: inline-block;
            vertical-align: middle;
            padding: 5px 0;
            min-width: 140px;
        }

        .color-text {
            margin: 0 5px;
            display: inline-block;
            vertical-align: middle;
            font-size: 14px;
        }

        .graph {
            display: inline-block;
            vertical-align: middle;
            padding: 5px;
        }
        #graph > .graph-bar-each {
            min-width: 12px;
            max-width: 210px;
        }

        .graph-bar1 {
            width: 50px;
            height: 70px;
            background-color: #DDA0DD;
            display: inline-block;
        }

        .graph-bar2 {
            width: 50px;
            height: 70px;
            background-color: #0000FF;
            display: inline-block;
        }

        .graph-bar3 {
            width: 50px;
            height: 70px;
            background-color: #00FF00;
            display: inline-block;
        }

        .graph-bar4 {
            width: 75px;
            height: 70px;
            background-color: #FFFF00;
            display: inline-block;
        }

        .graph-bar5 {
            width: 50px;
            height: 70px;
            background-color: #FF7F00;
            display: inline-block;
        }

        .graph-bar6 {
            width: 3px;
            height: 70px;
            background-color: #FF0000;
            display: inline-block;
        }

        /* delegate  */
        .delegatemodal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .delegatemodal-content {
            background-color: #fefefe;
            margin: 8% auto;
            /* 15% from the top and centered */
            border-radius: 5px;
            width: 55%;
            /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .delegateclose {
            color: #aaa;
            float: right;
            font-size: 28px;
            margin-top: 25px;
            padding-right: 20px;
        }

        .delegateclose:hover,
        .delegateclose:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .delegateheading {
            font-size: 18px;
            font-weight: bolder;
            font-family: Arial;
            padding-top: 20px;
            padding-left: 20px;
            color: #000;
        }

        .delegatesubhead {
            margin-top: -5px;
            font-family: Arial;
            font-weight: bold;
            font-size: 12px;
            padding-left: 20px;
        }

        .delegatetable-container{
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-top: 2px solid rgba(200,200,200,0.4);
            border-bottom: 2px solid rgba(200,200,200,0.4);

        }

        .delegetable-item-table{
            flex-grow: 6;
        }


        .delegatetable {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: none;
        }
        .delegatetable th{
            font-size: 1.5rem;
            font-family: arial;
            font-weight: bolder;
            color: #000;
        }
        .search-column-container {
            display: flex;
            width: 100%;
            justify-content: flex-end;
            align-items: center;
            padding-right: 50px;
        }
        #search-column1, #search-column2 {
            padding: 12px 5px;
            background-color: #FCAFA8;
            border-color: #FCAFA8;
        }
        .search-column-container i{
            margin-left: -22px;
            font-size: 17px;
            color: #333;
        }
        .search-column-heading-container {
            display: flex;
            justify-content: space-around;
        }
        .search-column-heading {
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

    .delegate-item-button button{
        border: 1px solid black !important;
    }

        th,
        td {
            text-align: left;
            padding: 10px;
            font-family: 'Noto Sans JP', sans-serif;
        }


        .delegatetable-data-popup {
            font-size: 1.2rem;
        }

        tr:hover {
            background-color: grey;
            color: #fff;
        }

        .delegatetable-data-boolean-popup {
            font-size: .8rem;
            text-align: center;
        }

        label {
            font-family: Arial;
        }

        .delegateselect {
            width: 260px;
            padding: 5px 35px 5px 5px;
            font-size: 16px;
            border: 1px solid #CCC;
            height: 34px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background: 95% / 15% no-repeat #fff;
            border-radius: 5px;
        }

        .delegateselect::-ms-expand {
            display: none;
            /* Remove default arrow in Internet Explorer 10 and 11 */
        }

        /* Target Internet Explorer 9 to undo the custom arrow */
        @media screen and (min-width:0\0) {
            .delegateselect {
                background: none\9;
                padding: 5px\9;
            }
        }

        .btn2 {
            height: 35px;
            width: 90px;
            background: white;
            border-color: black;
            border-size: 1px;
            color: black;
            font-family: Arial;
            border-radius: 5px;
        }

        a {
            text-decoration: none;
            font-size: 15px;
            font-family: Arial;
        }

        /* delegate end */

        .filter_modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .filtermodal-content {
            background-color: #fefefe;
            margin: 5% auto;
            /* 15% from the top and centered */
            padding: 10px 20px;
            border-radius: 5px;
            width: 40%;
            /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .filterclose {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .filterclose:hover,
        .filterclose:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .filterheading {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 0;
            font-family: Arial;
        }

        .responsibility {
            width: 100%;
            padding: 0 52px 0 9px;
            border-color: #dee0e3;
            background: none;
            height: 40px !important;
        }

        .icon-dropdown-filter {
            position: relative;
            top: -30px;
            left: 94%;
        }
        .icon-dropdown-deselect {
            position: relative;
            left: -4%;
        }

        .filtersolid {
            margin-top: 10px;
            margin-bottom: 0;
            width: 108%;
            margin-left: -20px;
            background-color: #dee0e3;
            color: #dee0e3;
        }

        .primary-responsibilty-filter-head {
            font-size: 13px;
            font-weight: bold;
        }

        .filtersubhead {

            font-family: Arial;
            font-size: 11px;
            font-weight: bolder;
            margin-bottom: 20px;
        }

        label {
            font-family: Arial;
        }

        span {
            font-family: Arial;
        }

        .filterprselect {
            width: 100%;
        }

        .filterchecklist {
            margin-bottom: 30px;
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            width: 55%;
        }
        .filterchecklist input {
            background: none !important;
        }
        .filter-name {
            background-color: white !important;
            border: 1px solid #aaa !important;
        }

        .filter-checkbox-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .filter-checkbox-label {
            margin: 0;
            margin-left: 10px;
            font-weight: initial;
        }

        .btn1 {
            height: 35px;
            width: 90px;
            background: black;
            color: white;
            font-family: Arial;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .pending-button-class .pending-request-count #bootstrap-container{
            display: none;
        }
        .btn2 {
            height: 35px;
            width: 90px;
            background: white;
            border-color: black;
            border-size: 1px;
            color: black;
            font-family: Arial;
            border-radius: 5px;
        }

        .rangeslider input {
            position: absolute;
        }

        /* price range slider */
        input[type='range'] {
            width: 95%;
            height: 30px;
            overflow: hidden;
            cursor: pointer;
            outline: none;
        }

        input[type='range'],
        input[type='range']::-webkit-slider-runnable-track,
        input[type='range']::-webkit-slider-thumb {
            -webkit-appearance: none;
            background: none;
        }

        input[type='range']::-webkit-slider-runnable-track {
            width: 100%;
            height: 5px;
            background: gray;
        }

        input[type='range']:nth-child(2)::-webkit-slider-runnable-track {
            background: none;
        }

        input[type='range']::-webkit-slider-thumb {
            position: relative;
            height: 15px;
            width: 15px;
            margin-top: -6px;
            background: black;
            border: 1px solid #003D7C;
            border-radius: 25px;
            z-index: 1;
        }

        input[type='range']:nth-child(1)::-webkit-slider-thumb {
            z-index: 2;
        }

        .rangeslider {
            position: relative;
            height: 60px;
            width: 100%;
            display: inline-block;
            margin-top: 10px;
            margin-left: 10px;
        }


        .rangeslider {
            width: 100%;
            position: relative;
        }

        .rangeslider span {
            position: absolute;
            margin-top: 30px;
            left: 0;
        }

        .rangeslider .right {
            position: relative;
            float: right;
            margin-right: 10px;
        }

        #delegate_submit:hover {
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }

        .max {
            float: right;
        }

        .filtercontainer1 {
            width: 50%;
            float: left;
        }

        .filtermodalmax {
            margin-top: 20px;
            margin-left: 300px;
            margin-bottom: 20px;
        }

        .filtermodalmin {
            margin-top: 20px;
            float: left;
            margin-left: 20px;

        }

        .filtercontainer2 {
            width: 50%;
            float: right;
        }

        .filterdatebox {
            width: 80px;
            padding: 5px 10px;
            background: none !important;
            border: 2px solid #8a8a8a !important;
            border-radius: 9px !important;
            font-size: 9px;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 20px;
        }


        /* //setings */

        .setting-modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .setting-modal-content {
            background-color: #fefefe;
            margin: 8% auto;
            /* 15% from the top and centered */
            border-radius: 5px;
            width: 50%;
            /* Could be more or less, depending on screen size */
        }
        .setting-modal-content .section{ padding: 10px 20px; max-height: 320px; overflow: scroll; }
        .setting-modal-content .section .opportunity-settings{ display: flex; }
        .setting-modal-content .sort-column{ width: 45%; padding-right: 0px; display: inline-block; vertical-align: top; }
        .setting-modal-content .section form ul{ height: 100%; }
        .setting-modal-content .section li{ display: block; float: none; }
        .setting-modal-content .sortable1 li,
        .setting-modal-content #sortable2 li,
        .nondrag{ background: #CDE8E2; color: #333333; padding: 5px; margin-bottom: 5px; cursor: pointer; }
        .setting-modal-content #sortable2 li{ background: #FCAFA8; color: #111111; }
        .setting-modal-content #sortable2{ position: relative; }
        .setting-modal-content #sortable2:before{ content: ''; width: 3px; height: 100%; position: absolute; left: -30px; background: #FCAFA8; }
        .setting-modal-content .divider{ width: 10%; }
        .setting-modal-content li,
        .setting-modal-content li label{ cursor: pointer; user-select: none; }


        /* The Close Button */
        .closeSetting {
            color: #aaa;
            float: right;
            font-size: 28px;
            margin-top: 25px;
            padding-right: 20px;
        }
        .action-item-space {
            margin-right: 15px;
            width: 18px;
        }

        .closeSetting:hover,
        .closeSetting:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .setting_heading {
            font-size: 17px;
            font-family: Arial;
            padding-top: 20px;
            padding-left: 18px;
        }

        input[type=radio] {
            /* display: inline-block; */
            background: url(../../../../../themes/SuiteP/images/forms/radio.png) no-repeat;
            padding: 0;
            margin: 0;
            width: 16px;
            height: 16px;
            vertical-align: middle;
            visibility: visible;
        }

        .setting_subhead {
            margin-top: 5px;
            font-family: Arial;
            font-size: 13px;
            padding-left: 20px;
        }

        .checklist_settings {
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .settingInputs input[type='checkbox'] {
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeSpeed;
            width: 15px;
            height: 15px;
            margin: 0;
            margin-right: 5px;
            display: block;
            float: left;
            position: relative;
            cursor: pointer;
        }

        .settingInputs input[type='checkbox']:after {
            content: "";
            vertical-align: middle;
            text-align: center;
            line-height: 13px;
            position: absolute;
            cursor: pointer;
            height: 13px;
            width: 13px;
            left: 0;
            top: 0;
            font-size: 10px;
            background: #fff;
        }

        .settingInputs input[type='checkbox']:hover:after,
        .settingInputs input[type='checkbox']:checked:hover:after {
            background: #fff;
            content: '\2714';
            color: #726E6D;
        }

        .settingInputs input[type='checkbox']:checked:after {
            background: #fff;
            content: '\2714';
            color: #726E6D;
        }

        .settings_btn1 {
            height: 35px;
            width: 90px;
            background: #000;
            color: white;
            font-family: Arial;
            border-radius: 5px;
        }

        .settings_btn2 {
            height: 35px;
            width: 90px;
            background: white;
            border: 1px solid black;
            color: black;
            font-family: Arial;
            border-radius: 5px;
        }

        .pending-request-table-container {
            display: none;
            padding: 50px;
            background: #fafafa;
        }
        #status-card-container:focus {
            background: black;
        }

        @media screen and (min-width: 1024px) and (max-height: 710px) {
            .header a {
                font-size: 24px;
            }
        }

        @media only screen and (min-width: 992px) {
            .header a {
                font-size: 24px;
            }
        }

        /* med  device below */
        @media only screen and (max-width: 768px) and (max-height: 1024px) {
            .header a {
                font-size: 24px;
            }
        }

        /* small screen below */
        @media screen and (max-width: 600px) {
            .header a {
                font-size: 23px;
            }
        }
        .pending-request-count #ajaxHeader {
            display: none !important;
        }
        #moduleTab_2_Home {
            display: none !important;
        }
        #toolbar .navbar-nav {
            display: flex;
            flex-direction: row;
            align-items: center;
            height: 60px;
        }
        #toolbar .navbar-nav .navbar-brand-container {
            display: flex;
            align-self: center;
        }
        #toolbar .navbar-nav .navbar-brand-container .suitepicon-action-home {
            line-height: 20px;
        }
        #toolbar .navbar-nav .topnav {
            display: flex;
            align-items: center;
            height: 30px;
        }

        .container-fluid .desktop-bar {
            margin-top: 0 !important;
        }
        #toolbar #globalLinks #with-label{
            display: flex;
            width: 125px;
            align-items: center;
            justify-content: space-evenly;
        }
        #toolbar #globalLinks #with-label .suitepicon-action-caret {
            margin-bottom: 4px;
        }
        #toolbar .navbar-nav #searchbutton {
            font-size: 25px !important;
        }

        #toolbar .navbar-search .dropdown-menu {
            margin-top: 10px !important;
        }

        .desModal, .raModal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }
        
        
        #size{
                width: 42% !important;
        }

        /* Modal Content/Box */
        .deselect-modal-content, .ra-modal-content {
            
            background-color: #fefefe;
            margin: 5% auto;
            /* 15% from the top and centered */
            padding: 25px;
            border-radius: 5px;
            width: 55%;
            /* Could be more or less, depending on screen size */
        }
        .ra-modal-content {
            width: 30%;
        }

        /* The Close Button */
        .deselectclose {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .deselectclose:hover,
        .deselectclose:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .deselectheading {
            font-size: 20px;
            font-family: Arial;
            font-weight: bold;
            margin: 0;
        }

        .deselectsubhead {
            margin-top: -20px;
            font-family: Arial;
        }

        .deselecttabname {
            font-family: Arial;
        }

        .deselecttabvalue {
            font-family: Arial;
            text-align: center;
        }
        .tabvalue td{
            text-align: left;
        }
        .tabname th {
            text-align: left;
        }

        label {
            font-family: Arial;
        }

        input {
            width: 250px;
            height: 20px;
            margin-bottom: 20px;
            margin-top: 10px;
        }

        .saveBtnDeselect {
            height: 35px;
            width: 90px;
            background: black;
            color: white;
            font-family: Arial;
            border-radius: 5px;
        }

        .submitBtnDeselect {
            height: 35px;
            width: 90px;
            background: white;
            border-color: black;
            color: black;
            font-family: Arial;
            border-radius: 5px;
        }
        .pagination{ padding: 10px; background: #efefef;}
        .pagination p{ margin-right: 10px; }
        .pagination ul li{ display: inline-block; float: none; padding: 2px 8px; margin-right: 5px; cursor: pointer; }
        .pagination ul li.active{ border: thin solid #000; }
        .label-red{ color: #db351f!important; }
        .label-green{ color: #2ab500!important; }
        .label-yellow{ color: #ebc034!important; }
        .label-blue{ color: #0000ff !important; }

        /* Sequence Flow */
        .no-scroll{ overflow: hidden; }
        .backdrop{ width: 100%; height: 100%; top: 0; left: 0; right: 0; bottom: 0; background: #fff; opacity: 0.5; position: fixed; z-index: 99; display: none; }
        .status-display{ max-width: 450px; width: 100%; height: 450px; position: fixed; top: 0; left: 0; right: 0; bottom: 0; margin: auto; background: #ffffff; overflow-y: scroll; overflow-x: hidden; display: none; z-index: 9999; box-shadow: 0 0 2px 2px #eeeeee; }
        .status-display .wrap{padding: 0px 0 15px;}
        .status-display .row{display: -ms-flexbox; display: flex; -ms-flex-wrap: wrap; flex-wrap: wrap; position: relative;}
        .status-display .d-block{display: block;}
        .status-display .d-inlin-block{display: inline-block;}
        .d-inline-block h5{ padding-left: 0; position: relative; }
        .status-display .w-100{width: 100%;}
        .status-display .w-50{width: 50%;}
        .status-display .black-color{color: #000000;}
        .status-display .gray-color{color: #999999;}
        .status-display .red-color {color: #e91e63;}
        .status-display .green-color{color: #86a085;}
        .status-display .blue-color{color: #0000ff;}
        .status-display .yellow-color{color: #ebc034;}
        .status-display h2,h3,h4,h5{margin: 0;}
        .status-display .padding{padding: 15px 25px;}
        .status-display .half-padding-tb{padding: 4px 25px;}
        .status-display .padding-tb{padding: 0 0 15px;}
        .status-display .padding-b{padding: 0 0 15px 0;}
        .status-display .align-self-end{align-self: flex-end;}
        .status-display .align-self-center{align-self: center;}
        .status-display .text-right{text-align: right;}
        .status-display .text-center{text-align: center;}
        .status-display .text-left{text-align: left;}
        .status-display .status-badge{position: relative; display: inline-block; width: 22px; height: 22px; border-radius: 50%; margin-left: 8px; font-size: 8px; vertical-align: middle; line-height: 22px; text-align: center;}
        .status-display .status-badge-green-b{position: relative; display: inline-block; width: 22px; height: 22px; border-radius: 50%; margin-right: 8px; font-size: 8px; vertical-align: middle; line-height: 22px; text-align: center; border: solid 1px #86a085; background-color: #e9fce6; color: #86a085;}
        .status-display .status-badge-red-b{position: relative; display: inline-block; width: 22px; height: 22px; border-radius: 50%; margin-right: 8px; font-size: 8px; vertical-align: middle; line-height: 22px; text-align: center; border: solid 1px #e91e63; background-color: #ffe3e3; color: #e91e63;}
        .status-display .status-badge-yellow-b{position: relative; display: inline-block; width: 22px; height: 22px; border-radius: 50%; margin-right: 8px; font-size: 8px; vertical-align: middle; line-height: 22px; text-align: center; border: solid 1px #e91e63; background-color: #ffea00; color: #e91e63;}
        .status-display .status-badge-blue-b{position: relative; display: inline-block; width: 22px; height: 22px; border-radius: 50%; margin-right: 8px; font-size: 8px; vertical-align: middle; line-height: 22px; text-align: center; border: solid 1px #0000ff; background-color: #ccccff; color: #0000ff;}
        .status-display .status-badge-gray-b{position: relative; display: inline-block; width: 22px; height: 22px; border-radius: 50%; margin-right: 8px; font-size: 8px; vertical-align: middle; line-height: 22px; text-align: center; border: solid 1px #999999; background-color: #e1e1e1; color: #999999;}
        .status-display .red-bg{background-color: #ffe3e3;}
        .status-display .green-bg{background-color: #e9fce6;}
        .status-display .yellow-bg{background-color: #ebc034;}
        .status-display .blue-bg{background-color: #ccccff;}
        
        .status-display .line-bottom{position: absolute; top: 22px; left: 10px; height: 19.5px; width: 1px;}
        .status-display .line-bottom:before{content: ''; position: absolute; bottom: -2px; right: -2px; width: 1px; height: 7px; transform: rotate(45deg);}
        .status-display .line-bottom:after{content: ''; position: absolute; bottom: -2px; left: -2px; width: 1px; height: 7px; transform: rotate(-45deg);}

        .status-display .line-bottom.green{background-color: #86a085;}
        .status-display .line-bottom.green:before{background-color: #86a085;}
        .status-display .line-bottom.green:after{background-color: #86a085;}

        .status-display .line-bottom.red{background-color: #e91e63;}
        .status-display .line-bottom.red:before{background-color: #e91e63;}
        .status-display .line-bottom.red:after{background-color: #e91e63;}

        .status-display .line-bottom.yellow{background-color: #ffbf00;}
        .status-display .line-bottom.yellow:before{background-color: #ffbf00;}
        .status-display .line-bottom.yellow:after{background-color: #ffbf00;}
        .status-display .line-bottom.blue{background-color: #ccccff;}
        .status-display .line-bottom.blue:before{background-color: #ccccff;}
        .status-display .line-bottom.blue:after{background-color: #e5e5ff;}

        .status-display .line-up{position: absolute; top: -19px; left: 10px; height: 18.5px; width: 1px; background-color:#e91e63; }
        .status-display .line-up:before{content: ''; position: absolute; top: -2px; right: -2px; width: 1px; height: 7px; transform: rotate(-45deg); background-color: #e91e63;}
        .status-display .line-up:after{content: ''; position: absolute; top: -2px; left: -2px; width: 1px; height: 7px; transform: rotate(45deg); background-color: #e91e63;}
        
        .status-display .approved .row:last-child .line-bottom{ display: none; }

        .status-display h2{ font-size: 20px; }
        .status-display h3{ font-size: 12px; margin: 5px 0; }
        .status-display h4{ padding: 0; font-size: 13px; }
        .status-display hr{ margin: 0; border-color: #cccccc; background-color: #cccccc; }

        .close-sequence-flow{ cursor: pointer; position: absolute; top: 0px; right: 5px; font-size: 34px; z-index: 999999; }

        .form-group{ display: block; }
        .form-group span{ display: block; }
        .form-control,
        .form-group select{ display: block; width: 100%; }

        .select2-results__option{ float: none!important; }

        .color-red{ color: red; }

        .color-palette{ width: 20px; height: 20px; border-radius: 50%; display: inline-block; margin: 0 10px; }
        .bg-red{ background: red; }
        .bg-yellow{ background: green; }
        .bg-green{ background: yellow; }
        .bg-default{ background-color: white; border: 1px solid; }
        
        /* reassignment */
        .ui-autocomplete.ui-menu{width:341px !important; position: fixed; max-height:350px; overflow-y:auto;}
        .ui-autocomplete.ui-menu li:first-child a{
            color:blue !important;
        }
        #assigned_to_new_c{
            width: 341px !important;
        padding: 15px 5px;
        }
        #hot-display-license-info {
            display: none;
        }
        .htCore {
            font-size: 11px !important;
        }

/* Hands on table style */
.ht_master .wtHolder {
    overflow-y: auto !important;
    /* overflow-x: hidden !important; */
}
.handsontable .ht_clone_left thead, .handsontable .ht_master thead, .handsontable .ht_master tr th {
    visibility: unset !important;
}

.ht_master tr:last-child > td {
    border-top: 1px solid black !important;
}

.employee-report-table-container {
    width: 1200px;
}
#example1 {
    visibility: hidden;
}
#team-lead-dropdown-container {
    visibility: hidden;
    margin-top: 25px;
}
#team_lead_dropdown {
    width: 205px;
}

.collapsibleIndicator {
    text-align: center !important;
}
.collapsibleIndicator::before {
    content: 'Show Detailed View';
    position: absolute;
    left: -100px;
    font-weight: bold;
    color: black;
}

/* width */
::-webkit-scrollbar {
    width: 0px !important;
    height: 0px !important;
  }
  
  /* Track */
  ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey !important; 
    border-radius: 10px !important;
    height: 0px !important;

  }
    
</style>

<body onload="dateBetween(event, '30')">

    <!-- Navbar start -->

    <!-- Navbar end -->
    <div class="W1400px">
        <div style="
display: flex;
justify-content: space-between;
align-items: center;
">
            <h3 style="
margin-left: 45px;
font-size: 2rem;
font-weight: bold;
font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
">
                Dashboard
            </h3>
            <button onclick="location.href = './index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26action%3DEditView%26return_module%3DOpportunities%26return_action%3DDetailView';" class="oppertunityBtn" style="font-size: 20px;display: flex;
    justify-content: space-evenly;
    align-items: center;" id='add_opportunity'>
                <i class="fa fa-plus" style="padding-right: 1rem; font-size: 20px" aria-hidden="true"></i><h3 style="margin: 0;
    font-weight: bold;
    font-family: 'Lato', Lato, Arial, sans-serif;">Create Opportunity</h3>
            </button>
        </div>

        <!-- last 30's day tab -->


        <div class="tab_30_days">

            <button onclick="dateBetween(event, '30')" id="btn-30-days" class="btn-30-days">Last 30 days </button>
            <button onclick="dateBetween(event, '60')" id="btn-60-days" class="btn-30-days">/ Last 60 days </button>
            <button onclick="dateBetween(event, '1200')" id="btn-90-days" class="btn-30-days">/ All </button>

        </div>

        <div id="tab_30days_content">

            <!-- sub tab under -->
            <br>
            <div class="inside_tab">
                <input class="input_radio_insideTab" id="one" name="group" type="radio" checked>
                <!-- <input class="input_radio_insideTab" id="two" name="group" type="radio">
                <input class="input_radio_insideTab" id="three" name="group" type="radio"> -->
                <div class="tabs_container">
                    <label class="tab_header_btn" id="one-tab" for="one">Opportunity</label>
                    <label class="tab_header_btn" id="two-tab" for="two" style="cursor: no-drop;color: #c2c2c2">Activity</label>
                    <label class="tab_header_btn" id="three-tab" for="three" style="cursor: no-drop;color: #c2c2c2">Document</label>
                </div>
                <div class="tab_panels_container">
                    <div class="tab_panel_inside" id="one-panel">

                        <section id="content1" class="tab-content">
                            <div class="main">
                                <div style="display: flex; min-width: 1000px !important;  width: 100%; padding: 15px 0;">
                                    <div style="display: flex; justify-content: space-between; width: 390px; height: 125px;">
                                        <div style="
display: flex;
flex-direction: column;
background-color: white;
border-radius: 5px;
padding: 10px;
width: 170px;
">
                                            <div style="color: grey; padding: 5px" id="click-pending-request">
                                                <b id="click-here-text" style="float: left; padding-right: 5px;">
                                                        Click here
                                                </b>
                                                <p id="approve-pending-text">No Requests Pending For Approval</p>
                                            </div>

                                            <div style="
                                                        display: flex;
                                                        margin-top: 10px;
                                                        justify-content: space-around;
                                                        " class="pending-button-class">
                                                <button style="
                                                                background-color: #efefef;
                                                                width: 50px;
                                                                height: 30px;
                                                                border: 1px solid #efefef;
                                                                border-radius: 10px;
                                                                display: flex;
                                                                    justify-content: space-evenly;
                                                                    align-items: center;" 
                                                    onclick="openPendingRequestTable()" 
                                                    class="pending-request-count">
                                                    0
                                                </button>
                                                

                                                <button id="delegateBtn"
                                                        onclick="fetchDelegateDialog()"
                                                        style="
                                                            background-color: #242422;
                                                            color: white;
                                                            height: 30px;
                                                            width: 90px;
                                                            border-radius: 5px;
                                                            padding: 5px;
                                                            font-size: 14px;
                                                            box-shadow: 0px 2px 2px rgba(0,0,0,0.4);
                                                            ">
                                                    Delegate
                                                </button>

                                                <!-- <button class=""
style="font-size: 12px;border-radius: .5rem;border:none;color:#fff;padding: 10px 15px;background-color:#000;">
Delegate
</button> -->
                                            </div>
                                        </div>
                                        <div style="
display: flex;
flex-direction: column;
width: 160px;
border-radius: 5px;
background-color: white;
padding: 10px;
justify-content: space-around;
margin-left: 10px;
">
                                            <p style="padding-left: 5px">Delegated requests</p>
                                            <ul style="
margin-top: 10px;
list-style: none;
align-self: flex-start;
display: flex;
flex-direction: column;
padding-left: 5px;
">
                                                    <li style="padding-left: 5px" ><span id="delegateName"></span>
                                                     <span id="delegateCount">0 (No Delegations)</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div style="
display: flex;
background-color: white;
border-radius: 5px;
margin-left: 10px;
height: 125px;
width: 100%;
">
                                        <div style="display: flex; flex-direction: column; margin: 10px; margin-right: 0;width: 200px;">
                                            <p style="
width: 150px;
color: grey;
font-size: 16px;
padding-left: 5px;
" id="daysFilterContainer">
                                                <span id="daysFilterAllLabel"></span> 
                                                <span id="daysFilterOpp">Opportunities over last</span> 
                                                <span id="daysFilter">30</span> 
                                                <span id="daysFilterDays">days</span> 
                                            </p>
                                            <div style="display: flex; margin-top: 10px">
                                                <button id="organizationTotal" style="
background-color: transparent;
color: #000000;
border-radius: 5px;
margin: 0 5px;
border: 1px solid transparent;
display: flex;
align-items: center;
flex-direction: column;
cursor: pointer;
">
                                                    <span style="font-size: 18px; font-weight: 600px; text-align: center" id="orgCount"></span>
                                                    <span style="color: grey; font-size: 10px;">Organization</span>
                                                </button>
                                                <button id="teamsTotal" style="
margin: 0 5px;
background-color: transparent;
color: #000000;
border-radius: 5px;
border: 1px solid transparent;
display: flex;
align-items: center;
flex-direction: column;
cursor: pointer;
">
                                                    <span style="font-size: 18px; font-weight: 600px; text-align: center" id="myTeamCount"></span>
                                                    <span style="color: grey; font-size: 10px;">My Team</span>
                                                </button>
                                                <button id="selfTotal" style="
background-color: #fff;
color: black;
margin: 0 5px;
width: 40px;
border-radius: 5px;
border: none;
display: flex;
align-items: center;
flex-direction: column;
cursor: pointer;
">
                                                    <span style="font-size: 18px; font-weight: 600px; text-align: center" id="selfCount"></span>
                                                    <span style="color: black; font-size: 10px;">Self</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div style="display: flex; align-items: center;">
                                            <div style="display: flex; min-width: 210px;">
                                                <div>
                                                    <ul style="list-style: none; display: flex;
                                                                flex-direction: column;">
                                                        <li style="font-size: 11px; padding: 2px;">
                                                            <span style="
                                                                        background-color: #DDA0DD;
                                                                        color: #DDA0DD;
                                                                        height: 3px;
                                                                        width: 3px;
                                                                        font-size: xx-small;
                                                                        margin-right: 5px;
                                                                        ">1</span>
                                                            Lead
                                                        </li>             
                                                        <li style="font-size: 11px; padding: 2px;">
                                                            <span style="
                                                                        background-color: #4B0082;
                                                                        color: #4B0082;
                                                                        height: 3px;
                                                                        width: 3px;
                                                                        font-size: xx-small;
                                                                        margin-right: 5px;
                                                                        ">1</span>
                                                            Qualified Lead
                                                        </li>
                                                        <li style="font-size: 11px; padding: 2px;">
                                                            <span style="
                                                                        background-color: #0000FF;
                                                                        color: #0000FF;
                                                                        height: 3px;
                                                                        width: 3px;
                                                                        font-size: xx-small;
                                                                        margin-right: 5px;
                                                                        ">1</span>
                                                            Qualified Opportunity
                                                        </li>
                                                        <li style="font-size: 11px; padding: 2px;">
                                                            <span style="
                                                                        background-color: #FFFF00;
                                                                        color: #FFFF00;
                                                                        height: 3px;
                                                                        width: 3px;
                                                                        font-size: xx-small;
                                                                        margin-right: 5px;
                                                                        ">1</span>
                                                            Qualified DPR
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div>
                                                    <ul style="list-style: none;  display: flex;
                                                                flex-direction: column; margin-left: 10px;">
                                                        <li style="font-size: 11px; padding: 2px;">
                                                            <span style="
                                                                        background-color: #00FF00;
                                                                        color: #00FF00;
                                                                        height: 3px;
                                                                        width: 3px;
                                                                        font-size: xx-small;
                                                                        margin-right: 5px;
                                                                        ">1</span>
                                                            Qualified Bid
                                                        </li>
                                                        <li style="font-size: 11px; padding: 2px;">
                                                            <span style="
                                                                        background-color: #006400;
                                                                        color: #006400;
                                                                        height: 3px;
                                                                        width: 3px;
                                                                        font-size: xx-small;
                                                                        margin-right: 5px;
                                                                        ">1</span>
                                                            Closed Won
                                                        </li>
                                                        <li style="font-size: 11px; padding: 2px;">
                                                            <span style="
                                                                        background-color: #FF7F00;
                                                                        color: #FF7F00;
                                                                        height: 3px;
                                                                        width: 3px;
                                                                        font-size: xx-small;
                                                                        margin-right: 5px;
                                                                        ">1</span>
                                                            Closed Lost
                                                        </li>
                                                        <li style="font-size: 11px; padding: 2px;">
                                                            <span style="
                                                                        background-color: #FF0000;
                                                                        color: #FF0000;
                                                                        height: 3px;
                                                                        width: 3px;
                                                                        font-size: xx-small;
                                                                        margin-right: 5px;
                                                                        ">1</span>
                                                            Dropped
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div id="graph-container">
                                                <div id="graph" style="min-width: 360px; min-height: 100px; display: flex; margin-left: 10px; margin-right: 10px;align-items: center;">No Data</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pending-request-table -->
                                <div id="pending-request-table-container" class="pending-request-table-container">
                                    <!-- <span class="filterclose" onclick="openPendingRequestTable('close')" style="cursor:pointer;font-size:18px;float: right;">&times;</span> -->
                                    <div style="background-color: white;" id="pending-requests"></div>
                                </div>
                                

                                <!-- /card-status -->


                                <section class=" card-container" id="fetchedByStatus">

                                </section>


                                <br />

                                <!-- card-status-end -->

                                <!-- table -->


                                <div style="overflow-x:auto;" id="tableContent">

                                </div>
                                <br>

                                <!--
table end -->

                            </div>
                        </section>
                    </div>
                    <div class="tab_panel_inside" id="two-panel">
                        <div class="tab_panel_header">Take-Away Skills</div>
                        <p>You will learn many aspects of styling web pages! You’ll be able to set up the correct file structure, edit text and colors, and create attractive layouts. With these skills, you’ll be able to customize the appearance of your web pages to suit your every need!</p>
                    </div>
                    <div class="tab_panel_inside" id="three-panel">
                        <div class="tab_panel_header">Note on Prerequisites</div>
                        <p>We recommend that you complete Learn HTML before learning CSS.</p>
                    </div>
                </div>
            </div>




            <!-- 	< sub tab under end  -->

        </div>
    </div>

    <?php /* 
        * Old Settings Form *
    <div id="setting_myModal" class="setting-modal">
        <!-- Modal content -->
        <div class="setting-modal-content">
            <span class="closeSetting" onclick="openSettingDialog('close')">&times;</span>
            <form class="settings-form">
                <input type="hidden" name="settings-section" class="settings-section" value="" />
                <input type="hidden" name="settings-type" class="settings-type" value="" />
                <input type="hidden" name="settings-type-value" class="settings-type-value" value="" />
                <h2 class="setting_heading">Select Columns</h2>
                <p class="setting_subhead">Select 6 columns for the table</p>
                <hr style="color: #D1D0CE">
                <section class="section">
                    <div style="margin-top: 20px;">
                        <label style="font-family: '.'Noto Sans JP'.', sans-serif; padding-left: 20px; margin-top: 20px; font-size: 15px;">Master List</label><br>
                    </div>
                    <div style="border: 1px solid #D1D0CE; margin-left: 20px;margin-right: 20px;margin-top: 5px;margin-bottom: 20px; padding:5px;" class="checklist_settings">
                        <input class="settingInputs" type="checkbox" id="name-select" name="name" value="name" checked="True" disabled>
                        <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Name</label><br>

                        <input class="settingInputs" type="checkbox" id="Primary-Responsbility-select" name="Primary-Responsbility" value="Primary-Responsbility" checked="True" disabled>
                        <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="Primary-Responsbility"> Primary Responsbility</label><br>

                        <input class="settingInputs" type="checkbox" id="Ammount-select" name="Amount" value="Amount" checked="True">
                        <label for="Amount" style="font-family: Arial; font-size: 13px;"> Amount</label><br>

                        <input class="settingInputs" type="checkbox" id="REP-EOI-Published-select" name="REP-EOI-Published" value="REP-EOI-Published" checked="True">
                        <label for="REP-EOI-Published" style="font-family: Arial; font-size: 13px;"> RFP/EOI Published</label><br>

                        <input class="settingInputs" type="checkbox" id="Closed-Date-select" name="Closed-Date" value="Closed-Date" checked="True">
                        <label for="Closed-Date" style="font-family: Arial; font-size: 13px;"> Modified Date</label><br>

                        <input class="settingInputs" type="checkbox" id="Closed-by-select" name="Closed-by" value="Closed-by" checked="True">
                        <label for="Closed-by" style="font-family: Arial; font-size: 13px;"> Modified By</label><br>

                        <input class="settingInputs" type="checkbox" id="Date-Created-select" name="Date-Created" value="Date-Created" checked="True">
                        <label for="Date-Created" style="font-family: Arial; font-size: 13px;"> Date Created</label><br>

                        <input class="settingInputs" type="checkbox" id="Date-Closed-select" name="Date-Closed" value="Date-Closed">
                        <label for="Date-Closed-select" style="font-family: Arial; font-size: 13px;"> Date Closed</label><br>

                        <input class="settingInputs" type="checkbox" id="Tagged-Members-select" name="Tagged-Members" value="Tagged-Members">
                        <label for="Tagged-Members" style="font-family: Arial; font-size: 13px;"> Tagged Members</label><br>

                        <!-- <input class="settingInputs" type="checkbox" id="Team-Members-select" name="Team-Members" value="Team-Members">
                        <label for="Team-Members" style="font-family: Arial; font-size: 13px;"> Team Members</label><br> -->

                        <input class="settingInputs" type="checkbox" id="Viewed-by-select" name="Viewed-by" value="Viewed-by">
                        <label for="Viewed-by" style="font-family: Arial; font-size: 13px;"> Viewed by</label><br>

                        <input class="settingInputs" type="checkbox" id="Previous-Responsbility-select" name="Previous-Responsbility" value="Previous-Responsbility">
                        <label for="Previous-Responsbility" style="font-family: Arial; font-size: 13px;"> Previous Responsbility</label><br>

                        <!-- <input class="settingInputs" type="checkbox" id="Members-select" name="Members" value="Members">
                        <label for="Members" style="font-family: Arial; font-size: 13px;"> Members</label><br> -->

                        <!-- <input class="settingInputs" type="checkbox" id="Date-of-creation-select" name="Date-of-creation" value="Date-of-creation">
                        <label for="Date-of-creation" style="font-family: Arial; font-size: 13px;"> Date of creation</label><br> -->

                        <!-- <input class="settingInputs" type="checkbox" id="Activities-select" name="Activities" value="Activities">
                        <label for="Activities" style="font-family: Arial; font-size: 13px;"> Activities</label><br> -->

                        <input class="settingInputs" type="checkbox" id="Attachment-select" name="Attachment" value="Attachment">
                        <label for="Attachment" style="font-family: Arial; font-size: 13px;"> Attachment</label><br>

                    </div>
                    <div style=" padding-top: 10px;padding-bottom: 20px;padding-left: 20px;">
                        <button class="settings_btn1" type="button" onclick="commitFilter();">Save</button>
                        <button style="margin-left: 10px;" class="settings_btn2" type="button" onclick="openSettingDialog('discard')">Close</button>
                    </div>
                </section>
            </form>
        </div>
    </div>
    */ ?>

    <?php /* New Settings Form */ ?>
    <div id="setting_myModal" class="setting-modal">
        <!-- Modal content -->
        <div class="setting-modal-content">
            <span class="closeSetting" onclick="openSettingDialog('close')">&times;</span>
            
            <h2 class="setting_heading">Drag / Drop Columns to be Displayed / Hidden</h2>
            <p class="setting_subhead">Select 7 columns for the table</p>
            <!-- <hr style="color: #D1D0CE"> -->
            <div class="search-column-container">
                <input type="text" id="search-column1" placeholder="Search here" />
                <i class="fa fa-search"></i>
            </div>
            <div class="search-column-heading-container">
                <h2 class="search-column-heading">Displayed</h2>
                <h2 class="search-column-heading">Hidden</h2>
            </div>
            <section class="section">
                <div class="opportunity-settings" id="opportunity-settings">
                    <form class="settings-form sort-column">
                        <input type="hidden" name="settings-section" class="settings-section" value="">
                        <input type="hidden" name="settings-type" class="settings-type" value="">
                        <input type="hidden" name="settings-type-value" class="settings-type-value" value="">
                        <ul id="sortable1" class="sortable1 connectedSortable ui-sortable">
                            <li style="pointer-events:none;" class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="name" value="name" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Opportunity Name</label>
                            </li>
                            <li style="pointer-events:none;" class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Primary-Responsbility" value="Primary-Responsbility" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Primary Responsibility</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Amount" value="Amount" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Amount (in Cr)</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="REP-EOI-Published" value="REP-EOI-Published" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> RFP/EOI Published</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Closed-Date" value="Closed-Date" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified date</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Closed-by" value="Closed-by" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified by</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Date-Created" value="Date-Created" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Created Date</label>
                            </li>
                        </ul>
                    </form>
                    <ul id="sortable2" class="sortable2 connectedSortable">
                        <li style="pointer-events:none;" class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="name" value="name" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Opportunity Name</label>
                            </li>
                            <li style="pointer-events:none;" class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Primary-Responsbility" value="Primary-Responsbility" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Primary Responsibility</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Amount" value="Amount" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Amount (in Cr)</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="REP-EOI-Published" value="REP-EOI-Published" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> RFP/EOI Published</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Closed-Date" value="Closed-Date" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified date</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Closed-by" value="Closed-by" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified by</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Date-Created" value="Date-Created" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Created Date</label>
                            </li>
                    </ul>
                </div>
            </section>
            <div style=" padding-top: 10px;padding-bottom: 20px;padding-left: 20px;">
                <button class="settings_btn1" type="button" onclick="commitFilter();">Save</button>
                <button style="margin-left: 10px;" class="settings_btn2" type="button" onclick="openSettingDialog('discard')">Close</button>
            </div>
        </div>
    </div>

    <div id="pending_setting_myModal" class="setting-modal">
        <!-- Modal content -->
        <div class="setting-modal-content">
            <span class="closeSetting" onclick="openPendingSettingsDialog('close')">&times;</span>
            
            <h2 class="setting_heading">Drag / Drop Columns to be Displayed / Hidden</h2>
            <p class="setting_subhead">Select 7 columns for the table</p>
            <div class="search-column-container">
                <input type="text" id="search-column2" placeholder="Search here" />
                <i class="fa fa-search"></i>
            </div>
            <div class="search-column-heading-container">
                <h2 class="search-column-heading">Displayed</h2>
                <h2 class="search-column-heading">Hidden</h2>
            </div>
            <!-- <hr style="color: #D1D0CE"> -->
            <section class="section">
                <div class="opportunity-settings" id="pending-settings">
                    <form class="pending-settings-form sort-column">
                        <input type="hidden" name="settings-section" class="pending-settings-section" value="">
                        <input type="hidden" name="settings-type" class="pending-settings-type" value="">
                        <input type="hidden" name="settings-type-value" class="pending-settings-type-value" value="">
                        <ul id="sortable1" class="sortable1 connectedSortable ui-sortable">
                            <li style="pointer-events:none;" class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="name" value="name" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Opportunity Name</label>
                            </li>
                            <li style="pointer-events:none;" class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Primary-Responsbility" value="Primary-Responsbility" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Primary Responsibility</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Amount" value="Amount" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Amount (in Cr)</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="REP-EOI-Published" value="REP-EOI-Published" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> RFP/EOI Published</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Closed-Date" value="Closed-Date" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified date</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Closed-by" value="Closed-by" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified by</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Date-Created" value="Date-Created" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Created Date</label>
                            </li>
                        </ul>
                    </form>
                    <ul id="sortable2" class="sortable2 connectedSortable ui-sortable">
                        <li style="pointer-events:none;" class="ui-sortable-handle">
                            <input class="settingInputs" type="checkbox" id="name-select" name="name" value="name" checked="True" style="display: none">
                            <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Opportunity Name</label>
                        </li>
                        <li style="pointer-events:none;" class="ui-sortable-handle">
                            <input class="settingInputs" type="checkbox" id="name-select" name="Primary-Responsbility" value="Primary-Responsbility" checked="True" style="display: none">
                            <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Primary Responsibility</label>
                        </li>
                        <li class="ui-sortable-handle">
                            <input class="settingInputs" type="checkbox" id="name-select" name="Amount" value="Amount" checked="True" style="display: none">
                            <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Amount (in Cr)</label>
                        </li>
                        <li class="ui-sortable-handle">
                            <input class="settingInputs" type="checkbox" id="name-select" name="REP-EOI-Published" value="REP-EOI-Published" checked="True" style="display: none">
                            <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> RFP/EOI Published</label>
                        </li>
                        <li class="ui-sortable-handle">
                            <input class="settingInputs" type="checkbox" id="name-select" name="Closed-Date" value="Closed-Date" checked="True" style="display: none">
                            <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified date</label>
                        </li>
                        <li class="ui-sortable-handle">
                            <input class="settingInputs" type="checkbox" id="name-select" name="Closed-by" value="Closed-by" checked="True" style="display: none">
                            <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified by</label>
                        </li>
                        <li class="ui-sortable-handle">
                            <input class="settingInputs" type="checkbox" id="name-select" name="Date-Created" value="Date-Created" checked="True" style="display: none">
                            <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Created Date</label>
                        </li>
                    </ul>
                </div>

            </section>
            <div style=" padding-top: 10px;padding-bottom: 20px;padding-left: 20px;">
                <button class="settings_btn1" type="button" onclick="commitPendingFilter();">Save</button>
                <button style="margin-left: 10px;" class="settings_btn2" type="button" onclick="openPendingSettingsDialog('discard')">Close</button>
            </div>
        </div>
    </div>

    <div id="filter_myModal" class="filter_modal">
        <!-- Modal content -->
        <div class="filtermodal-content">
            <span class="filterclose" onclick="openFilterDialog('close')" style="cursor:pointer;font-size:18px;float: right;">&times;</span>
            <form class="opportunity-filter">

                <input type="hidden" class="filter-type" name="type" value="" />
                <input type="hidden" class="filter-value" name="value" value="" />
                <input type="hidden" class="filter-status" name="status" value="" />

                <h2 class="filterheading">Filter</h2>
                <p class="filtersubhead">Fill out the following details</p>
                <hr class="filtersolid">
                <section class="filtersection" style="margin-top: 10px;">
                    <div class="filter-body" style="padding-top: 10px; padding-right: 15px; margin-bottom: 20px; display: block; max-height: 350px; overflow: hidden; overflow-y: scroll"></div>
                    <div>
                        <button class="btn1" type="button" id="filter_submit" onclick="openFilterDialog('submit')">Filter</button>
                        <button class="btn2" type="button" id="filter_discard" onclick="openFilterDialog('close')" style="border-color: #8a8a8a">Close</button>
                        <a id="filter_clear" class="filter_clear">Clear Filter</a>
                    </div>
                </section>
            </form>
        </div>

    </div>


    <div id="pending_filter_myModal" class="filter_modal">
        <!-- Modal content -->
        <div class="filtermodal-content">
            <span class="filterclose" onclick="openPendingFilterDialog('close')" style="cursor:pointer;font-size:18px;float: right;">&times;</span>
            <form class="pending-filter">

                <input type="hidden" class="filter-type" name="type" value="" />
                <input type="hidden" class="filter-value" name="value" value="" />
                <input type="hidden" class="filter-status" name="status" value="" />

                <h2 class="filterheading">Filter</h2>
                <p class="filtersubhead">Fill out the following details</p>
                <hr class="filtersolid">
                <section class="filtersection" style="margin-top: 10px;">
                    <div class="filter-body" style="padding-top: 10px; padding-right: 15px; margin-bottom: 20px; display: block; max-height: 350px; overflow: hidden; overflow-y: scroll"></div>

                    <div>
                        <button class="btn1" type="button" id="filter_submit" onclick="openPendingFilterDialog('submit')">Filter</button>
                        <button class="btn2" type="button" id="filter_discard" onclick="openPendingFilterDialog('close')" style="border-color: #8a8a8a">Close</button>
                        <a id="filter_clear" class="filter_clear">Clear Filter</a>
                    </div>
                </section>
            </form>
        </div>

    </div>

    <!-- RA Modal Container -->
    <div id="reassignmentModal" class="raModal">
        <!-- Modal content -->
        <div class="ra-modal-content" id="size">
            <span class="deselectclose" onclick="handleReassignmentDialog('close')">&times;</span>
           <form>
                    <!-- <input type="hidden" id="hidden_multi_select" value="" />
                    <input name="hidden_user" id="hidden_user" style="cursor: pointer;padding-right: 40px;" onclick="deselectDropDownClicked()" readonly/> -->
                    <input name="hidden_user" type="hidden" id="assigned_opp_id"/>
                    <div class="reassignmentModal-header" style="margin-bottom: 30px;">
                        <h3 style="margin:0; padding: 0;font-size: 20px;">Change the Assigned User</h3></br>
                        <h4 id="ra_op_name" style="margin:0; font-size: 15px;">Opportunity Name</h4> </br>
                        <h4 id="ass_name" style="margin:0; font-size: 15px;">Assigned User Name</h4> 
                    </div>
                    
                    <h5 style="padding: 0">Re-assign User:</h5>
                    <input type="text" id="assigned_to_new_c" style="width: 250px; padding: 15px 5px;"/>
                    <br><div style="height: 20px;"></div>
                    <div>
                        <button class="saveBtnDeselect" type="button" onclick="handleReassignmentDialog('submit')">Save</button>
                        <button class="submitBtnDeselect" type="button" onclick="handleReassignmentDialog('discard')">Close</button>
                    </div>
                </section>
            </form>
        </div>

    </div>


    <!-- Modal content -->
    <div id="deSelectModal" class="desModal">
        <!-- Modal content -->
        <div class="deselect-modal-content">
            <span class="deselectclose" onclick="openDeselectDialog('close')">&times;</span>
            <form>
                    <div id="opportunity_info">
                        <!-- /.col-md-12 -->
                    </div>
                    <input type="hidden" id="hidden_multi_select" value="" />
                    <input name="hidden_user" id="hidden_user" style="cursor: pointer;padding-right: 40px;" onclick="deselectDropDownClicked()" readonly/>
                    <i class="fa fa-caret-down icon-dropdown-deselect" style="cursor: pointer;" id="deselect-drop-icon" onclick="clearDeselectDropDownValue()"></i>
                    <select id="deselect_members" name="multi_search_filter" onfocusout="deselectDropDownClicked()" multiple class="form-control selectpicker" 
                                                 style="width:250px;
                                                        padding: 0px;
                                                        border-color: #dee0e3;
                                                        background: white;
                                                        position: absolute;
                                                        height: 105px !important;
                                                        ">
                    </select>
                    <br><div style="height: 20px;"></div>
                    <div>
                        <button class="saveBtnDeselect" type="button" onclick="openDeselectDialog('submit')">Save</button>
                        <button class="submitBtnDeselect" type="button" onclick="openDeselectDialog('discard')">Close</button>
                    </div>
                </section>
            </form>
        </div>

    </div>

    <!-- The Modal -->
    <div id="delegatemyModel" class="delegatemodal">
        <!-- Modal content -->
        <div class="delegatemodal-content">
            <span class="delegateclose">&times;</span>
            <form>
                <input type="hidden" id="hidden_value" name="hidden_value" />
                <h2 class="delegateheading">Delegate</h2>
                <p class="delegatesubhead">Delegated member will be able to perform action on your behalf</p>
                <section style="margin-top: 15px;">
                    <div class="delegatetable-container">
                        <div class="delegetable-item-table">
                            <div id="delegated_info"></div>
                        </div>
                        <!-- <div class="delegate-item-button">
                            <button style="margin-left: 100px; margin-bottom: 10px; margin-top: 20px;" class="btn2" type="submit" href="/">Remove</button>
                        </div> -->
                    </div>
                    <div style="margin-top: 30px; margin-left: 20px;">
                        <div style="width: 36%;float: left;">
                            <label for="Select_Proxy">Select Proxy</label><br>
                            <select class="delegateselect" id="Select_Proxy">
                            </select>


                            <div style="margin-top: -1px;">
                                <!-- <a style="color: black;font-size: 10px;" href="#">Delegated Prevlously - <span style="font-size: 10px;font-weight: bold;">No</span></a> -->
                            </div>
                        </div>
                        <div style="width: 50%;float: left; margin-left: 20px;">
                            <label>Permissions to</label><br>
                            <input style="width: 15px;" type="checkbox" id="delegate_Edit" name="delegate_Edit" value="Edit" checked>
                            <label for="Edit" style="margin: 0;"> Edit(Approve/Reject)</label>
                        </div>
                    </div>
                    <div style="margin-top: 130px; margin-left: 20px;">
                        <!-- <a style="color: #3090C7;" href="#">+ Add another proxy</a> -->
                    </div>

                    <div style="margin-top: 15px;padding-bottom: 20px;margin-left: 20px;">
                        <a class="btn1" id="delegate_submit" style="padding: 5px 20px;">Save</a>
                    </div>
                </section>
            </form>
        </div>

    </div>

    <!-- Sequence Flow -->
    <div class="backdrop"></div>
    <section class="white-bg status-display sequence-flow"></section>


    <!-- The Modal -->
    <div id="approvalModal" class="approvalmodal">
        <!-- Modal content -->
        <div class="approvalmodal-content">
            <span class="approvalclose" onClick="openApprovalDialog('close');">&times;</span>
            <form class="approval-form" name="approval-form">
                <div id="approval-data"></div>
            </form>
        </div>
    </div>

    <!-- <button class="get-emp-report-button button" id="get-emp-report-button button" onclick="openUserReport()">GET EMPLOYEE REPORT</button>
        <div class="form-group" id="team-lead-dropdown-container">
                <span class="primary-responsibilty-filter-head">Select Team Lead:</span>
                <select class="" name="filter-team_lead" id="team_lead_dropdown">
                </select>
        </div>
        <div class="report-container" id="report-container">
            <div class="employee-report-table-container">
                <div id="example1" class="hot handsontable htRowHeaders"></div>
            </div>
        </div> -->


    <!-- amount range slider -->
    <script>
        (function() {

            function addSeparator(nStr) {
                nStr += '';
                var x = nStr.split('.');
                var x1 = x[0];
                var x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }

            function rangeInputChangeEventHandler(e) {
                var rangeGroup = $(this).attr('range_1'),
                    minBtn = $(this).parent().children('.min'),
                    maxBtn = $(this).parent().children('.max'),
                    isUSD = $(this).parent()[0].classList.contains('usd'),
                    currency = isUSD ? ' Mn' : ' Cr';
                    difference = isUSD ? 5 : 10;
                    range_min = $(this).parent().parent().find('.range_min'),
                    range_max = $(this).parent().parent().find('.range_max'),

                    minVal = parseInt($(minBtn).val()),
                    maxVal = parseInt($(maxBtn).val()),
                    origin = $(this).context.className;
                if (origin === 'min lowerVal' && minVal >= (maxVal - difference)) {
                    $(minBtn).val(maxVal - difference);
                }
                var minVal = parseInt($(minBtn).val());
                $(range_min).html(addSeparator(minVal * 1) + currency);


                if (origin === 'max upperVal' && (maxVal - difference) < minVal) {
                    $(maxBtn).val(difference + minVal);
                }
                var maxVal = parseInt($(maxBtn).val());
                $(range_max).html(addSeparator(maxVal * 1) + currency);
            }

            $(document).on('input', 'input[type="range"]', rangeInputChangeEventHandler);

            //$('input[type="range"]').on('input', rangeInputChangeEventHandler);
        })();
    </script>


    <!--date picker start date -->
    <script>
        $(function(){
            $('body').on('focus',".filterdatebox", function(){
                
            });
        });
        function initDatePicker(){
            jq('.filterdatebox').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoApply: true,
                open: 'left',
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'), 10) + 1,
                locale: {
                    format: 'DD/MM/YYYY'
                },
                autoUpdateInput: false
            }, function(start, end, label) {
                var difference = moment().diff(start, 'years');
            });

            jq('.filterdatebox').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY'));
            });

            jq('.filterdatebox').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });
        }

        function initRangeSlider(){
            // $('.select2').select2();
        }

        function initSelect2(){
            jq('.select2').select2();
            initDatePicker();
        }

        $(document).ready(function() {
            // $('input[name="datepicker"]').daterangepicker({
            initDatePicker();
            initSelect2();
            /* Download Button Click */
            $(document).on('click', '.download', function(){
                var type    = $(this).data('type');
                var value   = $(this).data('value');
                var action  = $(this).data('action');
                var formData = '';
                var dropped = '';

                if(action == 'dayFilter'){
                    formData = { day: value, filter: 1 };
                }else if(action == 'type'){
                    formData = { csvtype: value, filter: 1 }
                }else{
                    dropped = $(this).data('dropped') ? $(this).data('dropped') : '';
                    formData = { status_c: value, dropped: dropped, filter: 1 }
                }

                if(type == 'opportunity')
                    var url = "index.php?module=Home&action=export&"+$('.opportunity-filter').serialize();
                else
                    var url = "index.php?module=Home&action=export&"+$('.pending-filter').serialize();

                $.ajax({
                    url: url,
                    method: "GET",
                    data: formData,
                    success: function(data) {
                        data = JSON.parse(data);
                        console.log(data);
                        if(data.status == 'success'){
                            window.location.href = 'index.php?module=Home&action=downloadCSV';
                        }else{
                            alert('Somthing went wrong. Please try again');
                        }
                    }
                });
            });
        });

    </script>
    <!--- date picker end -->

    <!-- last 30's day tab end -->

    <script type="text/javascript">

        $(document).ready(function() {
            document.getElementById('deselect_members').style.display = "none";
            var addOpportunity = document.getElementById('add_opportunity');
            $.ajax({
                url: "index.php?module=Home&action=get_user_details",
                method: "GET",
                success: function(data) {
                    var parsed_data = JSON.parse(data);
                    if ((parsed_data && parsed_data.user_team && !(parsed_data.user_team.includes('^sales^')))
                    || parsed_data.user_id == '1') {
                        addOpportunity.style.display = "none";
                        setTimeout(function(){ 
                            var hideOpportunity = document.getElementsByClassName('dashboard_opp_hide');
                            for (let i = 0; i < hideOpportunity.length; i++) {
                                hideOpportunity[i].style.display = "none";
                            }
                         }, 100);
                        
                    }
                    if (parsed_data.mc_c == "no") {
                        var reportContainerBtn = document.getElementById('get-emp-report-button button');
                        reportContainerBtn.style.display = "none";
                    }
                }
            });
            $.ajax({
                url: "index.php?module=Home&action=delegate_members",
                method: "GET",
                success: function(data) {
                    var parsed_data = JSON.parse(data);
                    console.log(parsed_data);
                    $('#Select_Proxy').html(parsed_data.members);
                    $('#Select_Proxy').val('');
                    $('.responsibility').html(parsed_data.members);
                    if (document.getElementById('responsibility1') && document.getElementById('responsibility')) {
                        document.getElementById('responsibility1').value = null;
                        document.getElementById('responsibility').value = null;
                    }
                }
            });
            $.ajax({
                url: "index.php?module=Home&action=tag_list",
                method: "GET",
                success: function(data) {
                    var parsed_data = JSON.parse(data);
                    $('#deselect_members').html(parsed_data.members);
                }
            });
        });

        function deselectDropDownClicked() {
            document.getElementById('deselect_members').style.display == "none" ?
            document.getElementById('deselect_members').style.display = "block" : 
            document.getElementById('deselect_members').style.display = "none";
        }
        function deselectDropDownUnclicked() {
            document.getElementById('deselect_members').style.display = "none";
        }
        function clearDeselectDropDownValue() {
            $('#hidden_user').val('');
            $('#deselect_members').val('');
            $('#hidden_multi_select').val('');
        }

        function openSettingDialog(event, type = null, value = null) {

            var dialog = document.getElementById('setting_myModal');
            $('#search-column1').val('');
            searchColumns('');
            if (event === "discard") {
                dialog.style.display = "none";
            } else if (event === "close") {
                dialog.style.display = "none";
            } else if (event === "submit") {

            } else {
                dialog.style.display = "block"
            }

            if(event == 'opportunities'){
                $('.settings-section').val('opportunities');
            }else if(event == 'pendings'){
                $('.settings-section').val('pendings');
            }

            if(type){
                $('.settings-type').val(type);
            }
            if(value){
                $('.settings-type-value').val(value);
            }

        }

        function openPendingSettingsDialog(event, type = null, value = null) {
            var dialog = document.getElementById('pending_setting_myModal');
            $('#search-column2').val('');
            searchColumns('');
            if (event === "discard") {
                dialog.style.display = "none";
            } else if (event === "close") {
                dialog.style.display = "none";
            } else if (event === "submit") {

            } else {
                dialog.style.display = "block"
            }

            $('.pending-settings-section').val('pendings');
            if(type){
                $('.pending-settings-type').val(type);
            }
            if(value){
                $('.pending-settings-type-value').val(value);
            }
        }


        function openFilterDialog(event) {

            var dialog = document.getElementById('filter_myModal');
            if (event === "discard") {
                dialog.style.display = "none";
            } else if (event === "close") {
                dialog.style.display = "none";
            } else if(event == 'submit'){
                filterHelper('opportunity-filter');
                dialog.style.display = "none";
            } else {
                dialog.style.display = "block"
            }

        }

        function openPendingFilterDialog(event){
            console.log(event);
            var dialog = document.getElementById('pending_filter_myModal');
            if (event === "discard") {
                dialog.style.display = "none";
            } else if (event === "close") {
                dialog.style.display = "none";
            } else if(event == 'submit'){
                filterHelper('pending-filter');
                dialog.style.display = "none";
            } else {
                dialog.style.display = "block"
            }
        }

        function openPendingRequestTable(event) {
            var temp = document.getElementsByClassName('pending-request-count');
            var pendingReqCount = temp[0].innerText;
            var dialog = document.getElementById('pending-request-table-container');
            if (pendingReqCount != '0') {
                if (dialog.style.display === "block") {
                    dialog.style.display = "none";
                } else {
                    dialog.style.display = "block"
                }
            } else {
                dialog.style.display = "none";
            }
        }

        function handleReassignmentDialog(event) {
            var dialog = document.getElementById('reassignmentModal');
            switch (event) {
                case "discard":
                case "close":
                    dialog.style.display = "none";
                    break;
                case "submit":
                    if (document.getElementById('hidden_value') && document.getElementById('hidden_multi_select')) {
                        var assigned_opportunity_id = document.getElementById('assigned_opp_id').value;
                        var assigned_name = document.getElementById('assigned_to_new_c').value;
                        
                    }
                    $.ajax({
                        url: 'index.php?module=Home&action=update_home_assigned_id',
                        type: 'POST',
                        data: {
                            opp_id: assigned_opportunity_id,
                            assigned_name: assigned_name
                        },
                        success: function(data) {
                            dat=JSON.parse(data)
                            if(dat.message == "false"){
                                alert("Please check assigned user name");
                            }
                            
                            else{
                                
                                $.ajax({
                                url: 'index.php?module=Home&action=assigned_history',
                                type: 'POST',
                                data: {
                                    opp_id: assigned_opportunity_id,
                                    assigned_name: assigned_name
                                },
                                success: function(data) {
                                }
                                });
                                
                                dialog.style.display = "none";
                                location.reload();
                            }
                        }
                    });
                    break;
                default:
                    dialog.style.display = "block";
            }
        }


        function openDeselectDialog(event) {

            var dialog = document.getElementById('deSelectModal');
            if (event === "discard") {
                dialog.style.display = "none";
            } else if (event === "close") {
                dialog.style.display = "none";
            } else if (event === "submit") {
                if (document.getElementById('hidden_value') && document.getElementById('hidden_multi_select')) {
                    var hidden_id = document.getElementById('hidden_value').value;
                    var user_id = document.getElementById('hidden_multi_select').value;
                }
                $.ajax({
                    url: 'index.php?module=Home&action=deselect_members_from_global_opportunity',
                    type: 'POST',
                    data: {
                        opportunityId: hidden_id,
                        userIdList: user_id
                    },
                    success: function(data) {
                        console.log(data);
                        dialog.style.display = "none";
                    }
                });
            } else {
                dialog.style.display = "block"
            }

        }
        function fetchReassignmentDialog(oppID) {
            var dialog = document.getElementById('reassignmentModal');
            dialog.style.display = "block";
            var res1;
            var oppss_id = oppID;
            $.ajax({
                    url : 'index.php?module=Home&action=new_assigned_list',
                    type : 'POST',
                     data: {
                         oppss_id,
                    },
                    
                    success : function(data1){
                         datw=JSON.parse(data1);
                          res1=datw.a;
                          op_name = datw.op_name;
                          var user_list= []; 
                          $('#ra_op_name').html("Opportunity Name: "+op_name);
                          $('#assigned_opp_id').val(datw.id);
                          $('#ass_name').html("Assigned User Name: "+datw.present_assigned_user);
                          
                          for(var z in res1){
                              res1[z]=res1[z].replace(/\^/g,' ');
                              res1[z]=res1[z].replace('team_lead','TL');
                              res1[z]=res1[z].replace('team_member_l1','TM L1');
                              res1[z]=res1[z].replace('team_member_l2','TM L2');
                              res1[z]=res1[z].replace('team_member_l3','TM L3');
                              
                          }
                              
                            for(var i in res1) {
                                user_list.push(res1[i])
                            };

                           
                          
                          $('#assigned_to_new_c').autocomplete({
                            source: user_list,
                            minLength: 0,
                            scroll: true
                        }).keydown(function() {
                            $(this).autocomplete("search", "");
                        });
                         
                    }
                 
             });
    }
    $(document).on('click','.ui-autocomplete',function(){
        var f=$('#assigned_to_new_c').val();
        
        var e=f.length;
        
        var s=f.indexOf("/");
    
        f = f.slice(0,s);
        
        f=f.replace(/[^ \, a-zA-Z]+/g,'');
        
        f=f.replace(/^\s+/g, '');
        $('#assigned_to_new_c').val(f);
    });

        function fetchDeselectDialog(id) {
            var dialog = document.getElementById('deSelectModal');

            $.ajax({
                url: 'index.php?module=Home&action=opportunity_dialog_info',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    var parsed_data = JSON.parse(data);
                    $('#opportunity_info').html(parsed_data.opportunity_info);
                    if (document.getElementById('hidden_value')) {
                        document.getElementById('hidden_value').value = parsed_data.opportunity_id;
                    }
                    dialog.style.display = "block";
                    $('#hidden_user').val(parsed_data.msuname);
                    var temp = parsed_data.msuid.split(',');
                    $('#deselect_members').val(temp);
                }
            })

        }



        function dateBetween(evt, dateBetween, searchTerm = null, page = null, filter = 0, changeColumns = 1) {
            Cookies.set('day', dateBetween, { expires: 1 });
            if(changeColumns) // reset columns
                getDefaultColumns('opportunity');

            var tabContent = document.getElementById('tab_30days_content');
            document.getElementById('btn-30-days').style.color = "black";
            $.ajax({
                url: 'index.php?module=Home&action=show_data_between_date&'+$('.settings-form').serialize()+'&'+$('.opportunity-filter').serialize()+'&filter='+filter,
                type: 'GET',
                data: {
                    days: dateBetween,
                    searchTerm: searchTerm,
                    page: page,
                },
                success: function(check) {
                    if (dateBetween == '1200') {
                        $('#daysFilterAllLabel').html('All Opportunities');
                        $('#daysFilterOpp').html('');
                        $('#daysFilter').html('');
                        $('#daysFilterDays').html('');
                    } else {
                        $('#daysFilterAllLabel').html('');
                        $('#daysFilterOpp').html('Opportunities Over Last');
                        $('#daysFilterDays').html('Days');
                        $('#daysFilter').html(dateBetween);
                    }
                    var data = JSON.parse(check);
                    if(!data.delegate){
                        $('#delegateBtn').remove();
                    }

                    if(changeColumns){
                        $('#opportunity-settings').html(data.columnFilter);
                        initSortable();
                    }                  
                    
                    if(!filter){
                        $('.opportunity-filter .filter-body').html(data.filters);
                        initSelect2();
                    }

                    if (dateBetween === '30') {
                        document.getElementById('btn-30-days').style.color = "#000";
                        $('#tableContent').html(data.data);
                        $('#orgCount').html(data.total);
                        $('#myTeamCount').html(data.team_count);
                        $('#selfCount').html(data.self_count);
                        if(data.delegateDetails)
                            $('#delegateCount').html(data.delegateDetails);
                        /*if (data.delegate_name != '') {
                            $('#delegateCount').html(data.delegated_count);
                        }*/
                        $('#fetchedByStatus').html(data.fetched_by_status);
                        

                        /* Filter Values */
                        $('.opportunity-filter .filter-type').val('show_data_between_date');
                        $('.opportunity-filter .filter-value').val('30');
                        document.getElementById('btn-60-days').style.color = "#c2c2c2";
                        document.getElementById('btn-90-days').style.color = "#c2c2c2";

                        tabContent.style.display = 'block';
                    } else if (dateBetween === '60') {
                        document.getElementById('btn-60-days').style.color = "#000";
                        $('#tableContent').html(data.data);
                        $('#orgCount').html(data.total);
                        $('#selfCount').html(data.self_count);
                        $('#myTeamCount').html(data.team_count);
                        $('#delegateName').html(data.delegate_name);
                        if (data.delegate_name != '') {
                            $('#delegateCount').html(data.delegated_count);
                        }
                        $('#fetchedByStatus').html(data.fetched_by_status)
                        tabContent.style.display = 'block';

                        /* Filter Values */
                        $('.opportunity-filter .filter-type').val('show_data_between_date');
                        $('.opportunity-filter .filter-value').val('60');
                        document.getElementById('btn-30-days').style.color = "#c2c2c2";
                        document.getElementById('btn-90-days').style.color = "#c2c2c2";
                    } else {
                        document.getElementById('btn-90-days').style.color = "#000";
                        $('#tableContent').html(data.data);
                        $('#orgCount').html(data.total);
                        $('#selfCount').html(data.self_count);
                        $('#myTeamCount').html(data.team_count);
                        $('#delegateName').html(data.delegate_name);
                        if (data.delegate_name != '') {
                            $('#delegateCount').html(data.delegated_count);
                        }
                        $('#fetchedByStatus').html(data.fetched_by_status)
                        tabContent.style.display = 'block';

                        /* Filter Values */
                        $('.opportunity-filter .filter-type').val('show_data_between_date');
                        $('.opportunity-filter .filter-value').val('1200');
                        document.getElementById('btn-30-days').style.color = "#c2c2c2";
                        document.getElementById('btn-60-days').style.color = "#c2c2c2";

                    }
                    getGraph(dateBetween);
                    reinitializeCardColors();
                    document.getElementById('search-icon').style.color = "green";
                    // document.getElementById('deselectBtn').disabled = "disabled";
                    // $('#deselectBtn').attr('disabled', 'disabled');
                    // document.getElementById('global-opportunities').style.background = "black";
                    // document.getElementById('global-opportunities').style.borderRadius ="5px";
                    if (data && data.loggedin_user == '1') {
                    }
                }
            });
            var i, tabcontent, tablinks;

        }

        function fetchDelegateDialog() {
            var dialog = document.getElementById('delegatemyModel');
            dialog.style.display = "block";
            $.ajax({
                url: 'index.php?module=Home&action=delegated_dialog_info',
                type: 'GET',
                data: {},
                success: function(data) {
                    var parsed_data = JSON.parse(data);
                    $('#delegated_info').html(parsed_data.delegated_info);
                    // dialog.style.display = "block";
                }
            });
        }

        function fetchRecordByStatus_C(status_c, day, searchTerm = null, page = null, filter = 0, dropped = null, changeColumns = 1) {
            
            if(changeColumns)
                getDefaultColumns('opportunity');

            $("#Dropped span").click(function(e) {
                e.stopPropagation();
            });
            $.ajax({
                url: 'index.php?module=Home&action=filter_opportunities_by_status&'+$('.settings-form').serialize()+'&'+$('.opportunity-filter').serialize()+'&filter='+filter,
                type: 'GET',
                data: {
                    status_c: status_c,
                    day: day,
                    searchTerm: searchTerm,
                    page: page,
                    dropped: dropped
                },
                success: function(data) {

                    data = JSON.parse(data);
                    
                    if(changeColumns){
                        $('#opportunity-settings').html(data.columnFilter);
                        initSortable();
                    }

                    if(!filter){
                        $('.opportunity-filter .filter-body').html(data.filters);
                        initSelect2();
                    }

                    if (day === '30') {
                        $('#tableContent').html(data.data);
                    } else if (day === '60') {
                        $('#tableContent').html(data.data);
                    } else {
                        $('#tableContent').html(data.data);
                    }
                    
                    reinitializeCardColors();

                    if (status_c == "Dropped" && dropped && (dropped == "ClosedLost")) {
                        document.getElementById("ClosedLost").style.background = "black";
                        document.getElementById("ClosedLost").style.color = "#fff";
                    } else {
                        document.getElementById(status_c).style.background = "black";
                        document.getElementById(status_c).style.color = "#fff";
                    }
                    $('.opportunity-filter .filter-type').val('filter_opportunities_by_status');
                    $('.opportunity-filter .filter-value').val(status_c);
                }
            });

        }

        function getDefaultColumns(type){
            if(type == 'opportunity'){
                var html = $('#opportunity-settings');
                var DefaultColumns = '<form class="settings-form sort-column">';
            }else if(type == 'pending'){
                var html = $('#pending-settings');
                var DefaultColumns = '<form class="pending-settings-form sort-column">';
            }
            DefaultColumns += '<input type="hidden" name="settings-section" class="settings-section" value=""> <input type="hidden" name="settings-type" class="settings-type" value=""> <input type="hidden" name="settings-type-value" class="settings-type-value" value=""> <ul id="sortable1" class="sortable1 connectedSortable ui-sortable"> <li style="pointer-events:none;" class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="name" value="name" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Opportunity Name</label> </li><li style="pointer-events:none;" class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="Primary-Responsbility" value="Primary-Responsbility" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Primary Responsibility</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="new_department_c" value="new_department_c" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Department </label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="REP-EOI-Published" value="REP-EOI-Published" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> RFP/EOI Published</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="Closed-Date" value="Closed-Date" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified date</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="Closed-by" value="Closed-by" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified by</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="Date-Created" value="Date-Created" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Created Date</label> </li></ul> </form>';
            html.html(DefaultColumns);
            initSortable();
        }

        function reinitializeCardColors() {
            var temp = document.getElementsByClassName('card-status');
            for (let index = 0; index < temp.length; index++) {
                temp[index].style.background = "#fff";
                temp[index].style.color = "black";
            }
        }
        

        function filter_by_type(type, day, searchTerm = null, page = null, filter = 0, changeColumns = 1) {
            console.log(type, day);

            if(changeColumns) // reset columns
                getDefaultColumns('opportunity');

            $.ajax({
                url: 'index.php?module=Home&action=filter_by_opportunity_type&'+$('.settings-form').serialize()+'&'+$('.opportunity-filter').serialize()+'&filter='+filter,
                type: 'GET',
                data: {
                    type: type,
                    day: day,
                    searchTerm: searchTerm,
                    page: page
                },
                success: function(data) {

                    data = JSON.parse(data);

                    if(changeColumns){
                        $('#opportunity-settings').html(data.columnFilter);
                        initSortable();
                    }

                    if(!filter){
                        $('.opportunity-filter .filter-body').html(data.filters);
                        initSelect2();
                    }

                    if (day === '30') {
                        $('#tableContent').html(data.data);
                    } else if (day === '60') {
                        $('#tableContent').html(data.data);
                    } else {
                        $('#tableContent').html(data.data);
                    }
                    reinitializeCardColors();
                    if (type === 'global') {
                        document.getElementById('global-opportunities').style.background = "black";
                        document.getElementById('global-opportunities').style.borderRadius ="5px";

                    } else {
                        document.getElementById('non-global-opportunities').style.background = "black";
                        document.getElementById('non-global-opportunities').style.borderRadius ="5px";
                    }
                    $('.opportunity-filter .filter-type').val('filter_by_opportunity_type');
                    $('.opportunity-filter .filter-value').val(type);
                }
            });
        }

        var delegateModel = document.getElementById("delegatemyModel");

        // Get the button that opens the modal
        var btn12 = document.getElementById("delegateBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("delegateclose")[0];

        // When the user clicks on the button, open the modal
        // btn.onclick = function() {
        //     fetchDelegateDialog();
        //     delegateModel.style.display = "block";
        // }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            delegateModel.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        // window.onclick = function(event) {
        //     if (event.target == delegateModel) {
        //         delegateModel.style.display = "none";
        //     }
        // }

        function fetchByStatus(status, filter = 0, page = null, changeColumns = 1){

            if(changeColumns) // reset columns
                getDefaultColumns('pending');

            $.ajax({
                url: 'index.php?module=Home&action=filter_by_opportunity_status&'+$('.pending-settings-form').serialize()+'&'+$('.pending-filter').serialize()+'&filter='+filter,
                type: 'GET',
                data: {
                    status: status,
                    page: page
                },
                success: function(data) {

                    data = JSON.parse(data);

                    if(changeColumns){
                        $('#pending-settings').html(data.columnFilter);
                        initSortable();
                    }
                    if(!filter){
                        $('.pending-filter .filter-body').html(data.filters);
                        initSelect2();
                    }


                    $('#pending-requests').html(data.data);
                    document.getElementById(status).style.background = "black";
                    document.getElementById(status).style.borderRadius = "4px";
                    $('.pending-filter .filter-type').val('filter_by_opportunity_status');
                    $('.pending-filter .filter-value').val(status);
                }
            });    
        }

        function openApprovalDialog(event, status = null, id = null){
            console.log(id);
            var dialog = document.getElementById('approvalModal');
            if (event === "discard") {
                dialog.style.display = "none";
            } else if (event === "close") {
                dialog.style.display = "none";
            } else {
                dialog.style.display = "block"
            }

            if(id){
                $.ajax({
                    url: 'index.php?module=Home&action=get_approval_item',
                    type: 'POST',
                    data: {
                        opp_id: id,
                        status: status,
                        event: event
                    },
                    success: function(data) {
                        $('#approval-data').html(data);
                    }
                });
            }
        }

        function updateStatus(){
            var Status = $('.changed-status').val();
            $.ajax({
                url: 'index.php?module=Home&action=opportunity_status_update',
                type: 'POST',
                data: $('.approval-form').serialize(),
                success: function(data) {
                    var day = Cookies.get('day');
                    data = JSON.parse(data);
                    if(data.status){
                        fetchByStatus(Status);
                        getPendingRequestCount();
                        openApprovalDialog('close');
                        dateBetween(event, day)
                    }else{
                        alert(data.message);
                    }
                    //$('#approval-data').html(data);
                    
   var assigned_name = data.assigned_name;
   var assigned_id = data.assigned_id;
    var s=data.opp_status;
    var r=data.rfp; 
    var opps_id= data.opps_id
    if(r=="Yes"){
        r="yes";
    }
    else if(r=="No"){
        r="no";
    }
     else if(r=="Not Required"){
        r="not_required";
    }
    $.ajax({
                url : 'index.php?module=Opportunities&action=fetch_reporting_manager',
                type : 'POST',
                dataType: "json",
                 data:{
                  opps_id,
                 assigned_name,
                 assigned_id,
                 s,
                 r
                },
                success : function(data_approver){
                 
                  
               // data=JSON.parse(data_approver);
                 var multiple_approvers_id=data_approver.approvers_id;
                if(r=='no'){
                    
                    if(s=='Qualified'){
                        
                        $.ajax({
                                url : 'index.php?module=Home&action=update_multiple_approver',
                                type : 'POST',
                                dataType: "json",
                                 data:{
                                  opps_id,
                                  multiple_approvers_id
                                },
                                success : function(data_approver){
                                    
                                }
                                        })
                        
                    }
                    
                }
                else if(r=='yes'){
                    if(s=='QualifiedLead'){
                        $.ajax({
                                url : 'index.php?module=Home&action=update_multiple_approver',
                                type : 'POST',
                                dataType: "json",
                                 data:{
                                  opps_id,
                                  multiple_approvers_id
                                },
                                success : function(data_approver){
                                    
                                }
                                        })
                        
                        
                    }
                    
                }
                else if(r=='not_required'){
                    if(s=='Qualified'){
                        $.ajax({
                                url : 'index.php?module=Home&action=update_multiple_approver',
                                type : 'POST',
                                dataType: "json",
                                 data:{
                                  opps_id,
                                  multiple_approvers_id
                                },
                                success : function(data_approver){
                                    
                                }
                                        })
                        
                        
                    }
                    
                }
                
                
               } 
            });
 
                }
            });
        }

        function getPendingRequestCount(){
            $.ajax({
                url: 'index.php?module=Home&action=opportunity_pending_count',
                type: 'POST',
                data: $('.approval-form').serialize(),
                success: function(data) {
                    data = JSON.parse(data)
                    $('.pending-request-count').html(data.data);                    
                    if (data && data.count == 0) {
                        $('#click-here-text').html('');
                        $('#approve-pending-text').html('No Requests Pending For Approval');
                    } else {
                        $('#click-here-text').html('Click here');
                        $('#approve-pending-text').html('to Approve Pending request');
                    }
                }
            });
        }

        function getGraph(dateBetween){
            $.ajax({
                url: 'index.php?module=Home&action=get_graph&dateBetween=' + dateBetween,
                type: 'GET',
                success: function(data) {
                    document.getElementById('graph').innerHTML = data;
                    // $('#graph').html(data);
                }
            });
        }

        $('#delegate_submit').click(function() {
            var Select_Proxy = $('#Select_Proxy').val();
            var delegate_Edit = $('#delegate_Edit').val();
            if (Select_Proxy == '' && delegate_Edit == '') {
                $('#delegate_response').html('<span class="text-danger">All Fields are required</span>');
            } else {
                $.ajax({
                    url: 'index.php?module=Home&action=store_delegate_result',
                    method: 'POST',
                    data: {
                        Select_Proxy: Select_Proxy,
                        // delegate_Edit: delegate_Edit,
                    },
                    success: function(data) {
                        var delegateModel = document.getElementById("delegatemyModel");
                        delegateModel.style.display = "none";
                        // fetchDelegateDialog();
                    }
                });
            }
        });        

        $('#search-column1').keyup(function(){
            var text = $(this).val().toUpperCase();
            searchColumns(text);
        });
        $('#search-column2').keyup(function(){
            var text = $(this).val().toUpperCase();
            searchColumns(text);
        });

        function searchColumns(text) {
            // Search text
            //case-insensitive
            class1 = "opportunity-settings";
            class2 = "pending-settings";
            jQuery.expr[':'].contains = function(a, i, m) {
            return jQuery(a).text().toUpperCase()
                .indexOf(m[3].toUpperCase()) >= 0;
            };
            //hiding other that matching
            if(text!=''){
                $("#" + class1 + " #sortable2 li")
                    .hide()
                    .filter(':contains("' + text + '")')
                    .show();
                $("#" + class2 + " #sortable2 li")
                    .hide()
                    .filter(':contains("' + text + '")')
                    .show();
            }
            else{
                $("#" + class1 + " li").show();
                $("#" + class2 + " li").show();
            }
        }

        $('.filter_clear').click(function(event) {
            event.preventDefault();
            $('.opportunity-filter input:not([type=hidden]').val('');
            $('.opportunity-filter select').val('');
            $('.pending-filter input:not([type=hidden]').val('');
            $('.pending-filter select').val('');
            $('.select2-selection__rendered').html('');
            $('.responsibility').val('');
            $('.filterdatebox').val('');
            $('.rfp-checkbox').each(function(index) {
                $(this).prop('checked', false);
            });
            var lower = document.getElementsByClassName('lowerVal');
            var upper = document.getElementsByClassName('upperVal');
            var rangeMin = document.getElementsByClassName('range_min');
            var rangeMax = document.getElementsByClassName('range_max');
            for (let index = 0; index < lower.length; index++) {
                lower[index].value = '0';
                upper[index].value = '200';
                rangeMin[index].innerHTML = '0 Cr';
                rangeMax[index].innerHTML = '200 Cr';
            }
        })

        /*$('#filter_submit').click(function(event) {
            event.preventDefault();
            var responsibility = $('#responsibility').val();
            var lowerVal = $('#lowerVal').val();
            var required_field = $('#required_field').val();
            var upperVal = $('#upperVal').val();
            var date_from = $('#date_from').val();
            var date_to = $('#date_to').val();
            var closed_date_from = $('#closed_date_from').val();
            var closed_date_to = $('#closed_date_to').val();
            if (responsibility == '' && lowerVal == '' && upperVal == '' && required_field == '' && date_from == '' && date_to == '' && closed_date_from == '' && closed_date_to == '') {
                $('#filter_response').html('<span class="text-danger">You need to make selection</span>');
            } else {
                $.ajax({
                    url: "index.php?module=Home&action=custom_filters",
                    method: "POST",
                    data: {
                        responsibility: responsibility,
                        lowerVal: lowerVal,
                        required_field: required_field,
                        upperVal: upperVal,
                        date_from: date_from,
                        date_to: date_to,
                        closed_date_from: closed_date_from,
                        closed_date_to: closed_date_to,
                        day: '30'
                    },
                    beforeSend: function() {
                        $('#filter_response').html('<span class="text-info">Loading filter_response...</span>');
                    },
                    success: function(data) {
                        // console.log(data);
                        $('#tableContent').html(data);
                    }
                });
            }
        });*/

        function commitFilter(){
            var settingsSection = $('.settings-section').val();
            var settingsType = $('.settings-type').val();
            var settingsValue = $('.settings-type-value').val();
            var day = Cookies.get('day');
            $('#search-column1').val('');
            searchColumns('');
            if(settingsSection == 'opportunities' && settingsType == 'action_show_data_between_date'){
                dateBetween(event, day, '', '', '', 0);
            }else if(settingsSection == 'opportunities' && settingsType == 'action_filter_by_opportunity_type' && settingsValue){
                filter_by_type(settingsValue, day, '', '', '', 0);
            }else if(settingsSection == 'opportunities' && settingsType == 'action_filter_opportunities_by_status' && settingsValue){
                var closedLost = '';
                if (document.getElementById("ClosedLost").style.background == "black") {
                    closedLost = 'ClosedLost';
                }
                fetchRecordByStatus_C(settingsValue, day, '', '', '', closedLost, 0);
            }else if(settingsSection == 'pendings' && settingsType == 'action_filter_by_opportunity_status' && settingsValue){
                settingsValue = settingsValue.replace('-', ' ');
                fetchByStatus(settingsValue, '', '', 0);
            }
            openSettingDialog('close');
        }

        function commitPendingFilter(){
            var settingsSection = $('.pending-settings-section').val();
            var settingsType = $('.pending-settings-type').val();
            var settingsValue = $('.pending-settings-type-value').val();
            $('#search-column1').val('');
            searchColumns('');
            settingsValue = settingsValue.replace('-', ' ');
            fetchByStatus(settingsValue, '', '', 0);
            
            openPendingSettingsDialog('close');
        }


        var limit = 7;
        $('input.settingInputs').on('change', function(evt) {
            if($(this).siblings(':checked').length >= limit) {
                this.checked = false;
            }
        });

        $(document).on('click', '.opportunity-search-btn', function(){
            searchHelper();
        })

        $(document).on('keyup', '#opportunity-search', function (event) {
            if (event.keyCode === 13) {
                searchHelper();
            }
        });

        function paginate(page, type, value, searchTerm = null, filter = 0){
            var day = Cookies.get('day');
            if(type == 'show_data_between_date'){
                dateBetween(event, value, searchTerm, page, filter, 0);
            }else if(type == 'filter_opportunities_by_status'){
                var closedLost = '';
                if (document.getElementById("ClosedLost").style.background == "black") {
                    closedLost = 'ClosedLost';
                }
                fetchRecordByStatus_C(value, day, searchTerm, page, filter, closedLost, 0);
                
            }else if(type == 'filter_by_opportunity_type'){
                filter_by_type(value, day, searchTerm, page, filter, 0);
                
            }else if(type == 'filter_by_opportunity_status'){
                fetchByStatus(value, filter, page, 0);
            }
        }


        $(window).on('load', function(){
            fetchByStatus('qualifylead');
            getPendingRequestCount();
        });
        $('#hidden_user').hover(
            function(){ 
                $('#deselect-drop-icon').removeClass('fa-caret-down');
                $('#deselect-drop-icon').addClass('fa-times');
            },
            function(){ 
                $('#deselect-drop-icon').removeClass('fa-times');
                $('#deselect-drop-icon').addClass('fa-caret-down')
            }
        )
        $('#deselect-drop-icon').hover(
            function(){ 
                $(this).removeClass('fa-caret-down');
                $(this).addClass('fa-times');
            },
            function(){ 
                $(this).removeClass('fa-times');
                $(this).addClass('fa-caret-down')
            }
        )
        

        $('.rfp-checkbox').click(function() {
            $('.rfp-checkbox').not(this).prop('checked', false);
        });

        function searchHelper () {
            var day = Cookies.get('day');
            var $this = $('#opportunity-search');
            var searchTerm = $this.val();
            var type = $this.data('type');
            var value = $this.data('value');
            if(type == 'filter_opportunities_by_status'){
                var closedLost = '';
                if (document.getElementById("ClosedLost").style.background == "black") {
                    closedLost = 'ClosedLost';
                }
                fetchRecordByStatus_C(value, day, searchTerm, '', '', closedLost, 0);
            }else if(type == 'show_data_between_date'){
                dateBetween(value, day, searchTerm, '', '', 0);
            }else if(type == 'filter_by_opportunity_type'){
                filter_by_type(value, day, searchTerm, '', '', 0);
            }
        }
        function closeSequenceFlow(){
            debugger;
            $('.backdrop').fadeOut();
            $('.sequence-flow').slideUp();
            $('.sequence-flow').html('');
            $('body').removeClass('no-scroll');
        }

        function filterHelper(ref){
            var day = Cookies.get('day');
            if(ref == 'opportunity-filter'){
                var filterType = $('.opportunity-filter .filter-type').val();
                var filterValue = $('.opportunity-filter .filter-value').val();
                // var filterValue = day;
            }else{
                var filterType = $('.pending-filter .filter-type').val();
                var filterValue = $('.pending-filter .filter-value').val();
            }
            if(filterType == 'show_data_between_date'){
                dateBetween('', filterValue, '', '', 1, 0);
            }else if(filterType == 'filter_by_opportunity_type'){
                filter_by_type(filterValue, day, '', '', 1, 0);
            }else if(filterType == 'filter_opportunities_by_status'){
                var closedLost = '';
                if (document.getElementById("ClosedLost").style.background == "black") {
                    closedLost = 'ClosedLost';
                }
                fetchRecordByStatus_C(filterValue, day, '', '', 1, closedLost, 0);
            }else if(filterType == 'filter_by_opportunity_status'){
                fetchByStatus(filterValue, 1, '', 0);
            }
        }

        $(document).on('click', '.remove-delegate', function(){
            $.ajax({
                url: 'index.php?module=Home&action=remove_delegate_user',
                method: 'POST',
                success: function(data) {
                    //var delegateModel = document.getElementById("delegatemyModel");
                    //delegateModel.style.display = "none";
                    fetchDelegateDialog();
                }
            });
        })

    </script>
    <script>
        $(document).ready(function(){

            load_data();

            initSortable();
            initializeReportTable();
            teamFilterForReport();

            function load_data(query='')
            {
                $.ajax({
                    url:"index.php?module=Home&action=load_multi_select",
                    method:"POST",
                    data:{query:query},
                    success:function(data)
                    {
                        $('test_table').html(data);
                    }
                })
            }

            $(document).on('click', '.close-sequence-flow', function(){
                // debugger;
                // $('.backdrop').fadeOut();
                // $('.sequence-flow').slideUp();
                // $('.sequence-flow').html('');
                // $('body').removeClass('no-scroll');
            })

            $('#deselect_members').change(function(){
                var csu = $('#deselect_members').val();
                display = trimLeft(csu);
                actual = trimRight(csu);
                $('#hidden_multi_select').val(actual);
                $('#hidden_user').val(display);
                var query = $('#hidden_user').val();
                load_data(query);
            });
            
        });
        function trimLeft(csu) {
            if (csu && csu.length > 0) {
                csu = csu.map(x => x.split('---')[1]);
            }
            return csu.join();
        }
        function trimRight(csu) {
            if (csu && csu.length > 0) {
                csu = csu.map(x => x.split('---')[0]);
            }
            return csu.join();
        }

        function getSequenceFlow(oppID){
            $.ajax({
                url:"index.php?module=Home&action=getOpportunityStatusTimeline",
                method:"POST",
                data:{oppID: oppID},
                success:function(response)
                {
                    var html = JSON.parse(response).data;
                    $('.sequence-flow').html(html);
                    $('.backdrop').fadeIn();
                    $('.sequence-flow').fadeIn();
                    $('body').addClass('no-scroll');
                }
            });
        }

        function initSortable(){
            
            $('.sortable1, .sortable2').sortable({
                connectWith: ".connectedSortable",
                receive: function(event, ui){
                    if( $(this).children('li').length > 5 && $(this).attr('id') != "sortable2" ){
                        $(ui.sender).sortable('cancel');
                        alert('Maximum allowed columns are already selected');
                    }
                }
            });
            
            $( ".sortable1 .nondrag" ).disableSelection();
        }

        function initializeReportTable(changedVal = '3.14') {
            var example1 = document.getElementById('example1');
            example1.innerHTML = "";
            var url = 'index.php?module=Home&action=get_report_table_data';
            if (changedVal) {
                url += '&team_lead=' + changedVal;
            }
            $.ajax({
                url: url,
                method: "GET",
                success: function (data) {
                    var parsed_data = JSON.parse(data);
                    if(parsed_data) {
                        var hot = new Handsontable(example1, {
                            data: parsed_data.data,
                            colHeaders: true,
                            rowHeaders: true,
                            manualColumnResize: true,
                            columns: [{type: 'text', readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true},
                            {readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true},
                            {readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true},
                            {readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true}],
                            colWidths: [200, 60, 150, 60, 150,
                                60, 150, 60, 150, 60,
                                150, 60, 150, 60, 150,
                                60, 150, 60, 150, 100, 100],
                            // filters: true,
                            // dropdownMenu: true,
                            width: '100%',
                            height: 320,
                            // rowHeights: 25,
                            nestedHeaders: [
                            ['', {label: '', colspan: 18}, ''],
                            ['', {label: 'Number of Contracts Created and Total Value of Contracts', colspan: 2}, {label: 'Lead Stage', colspan: 2}, {label: 'Qualified Lead Stage', colspan: 2},
                            {label: 'Qualified Opportunity Stage', colspan: 2}, {label: 'Qualified DPR Stage', colspan: 2}, {label: 'Qualified Bid Stage', colspan: 2},
                            {label: 'Closed Win Stage', colspan: 2},{label: 'Closed Lost Stage', colspan: 2}, {label: 'Dropped Stage', colspan: 2}],
                            ['Users', 'Number Of Contracts', 'Total Value Of Contracts', 'Number', 'Value', 'Number', 'Value', 'Number', 'Value',
                            'Number', 'Value', 'Number', 'Value', 'Number', 'Value', 'Number', 'Value', 'Number', 'Value',
                            'Participated In', 'Expected Inflow Date']
                            ],
                            collapsibleColumns: [
                            {row: -3, col: 1, collapsible: true},
                            ],
                            columnSorting: true,
                            // fixedRowsBottom: 1,
                            afterGetColHeader: function (col, TH) {
                                $(TH).css('text-align', 'left');
                            }
                    
                        });
                        hot.getPlugin('collapsibleColumns').collapseSection({row: -3, col: 1});
                        window.hot = hot;
                    }
                }
            });
        }

        function openUserReport() {
            var reportContainer = document.getElementById('example1');
            var reportDropdownContainer = document.getElementById('team-lead-dropdown-container');
            reportDropdownContainer.style.visibility = (reportDropdownContainer.style.visibility == "visible") ? "hidden" : "visible";
            reportContainer.style.visibility = (reportContainer.style.visibility == "visible") ? "hidden" : "visible";
        }
        function teamFilterForReport() {
            $.ajax({
                url: 'index.php?module=Home&action=get_team_filter_report_table',
                type: 'GET',
                success: function (data) {
                    data = JSON.parse(data);
                    if (data) {
                        $('#team_lead_dropdown').html(data.data);
                    }
                }
            });
        }
        $(document).on('change', '#team_lead_dropdown', function (event) {
            initializeReportTable(event.target.value);
        });
        
//-------------------------------for reassignment-------------------------------//


// var res1;
// var oppss_id = $('[name=record]').val();
// var rfp = $("#rfporeoipublished_c").val();
// var p_status=$("#status_c").val();
// $.ajax({
//         url : 'index.php?module=Opportunities&action=new_assigned_list',
//         type : 'POST',
//          data: {
//              oppss_id,
//              rfp,
//             p_status
//         },
        
//         success : function(data1){
           
           
//              datw=JSON.parse(data1);
           
          
           
//           if(datw=='block'){
//           $('#assigned_to_new_c').attr('disabled',true);
             
//           }
           
//           res1=datw.a;
//           var user_list= []; 
          
//           for(var z in res1){
//               res1[z]=res1[z].replace(/\^/g,' ');
//               res1[z]=res1[z].replace('team_lead','Team Lead');
//               res1[z]=res1[z].replace('team_member_l1','Team Memeber L1');
//               res1[z]=res1[z].replace('team_member_l2','Team Memeber L2');
//               res1[z]=res1[z].replace('team_member_l3','Team Member L3');
              
//           }
              
//             for(var i in res1) {
//                 user_list.push(res1[i])
                
//             }; 
            
           
          
//           $('#assigned_to_new_c').autocomplete({
//             source: user_list,
//             minLength: 0,
//             scroll: true
//         }).keydown(function() {
//             $(this).autocomplete("search", "");
//         });
             
//         }
     
//  });

// $('#assigned_to_new_c').on('change',function(){
    
    
//     var f=$('#assigned_to_new_c').val();
    
//     var e=f.length;
    
//   var s=f.indexOf("/");

// f = f.slice(0,s);

// f=f.replace(/[^ \, a-zA-Z]+/g,'');

// f=f.replace(/^\s+/g, '');



// $('#assigned_to_new_c').val(f);


// var a_name= f.split(/\s+/);

// var f_name=a_name[0];
// var l_name=a_name[1];

// $.ajax({
//         url : 'index.php?module=Opportunities&action=fetch_assigned_id',
//         type : 'POST',
//          data: {
           
//             f,
//             f_name,
//             l_name
//         },
        
//         success : function(data){
           
//           $('#assigned_user_id').val(data);
//           $('[name=assigned_user_name]').val(f);
          
//              var assigned_name = $("#assigned_to_new_c").val();
//   var assigned_id = $("#assigned_user_id").val();
//     var s=$('#status_c').val();
//     var r=$('#rfporeoipublished_c').val(); 
 
   
//     $.ajax({
//                 url : 'index.php?module=Opportunities&action=fetch_reporting_manager',
//                 type : 'POST',
//                 dataType: "json",
//                  data:{
//                   opps_id,
//                  assigned_name,
//                  assigned_id
//                 },
//                 success : function(data_approver){
                 
                  
//               // data=JSON.parse(data_approver);
                
                
//                  $("#select_approver_c").val(data_approver.reporting_name);
//                  $("#user_id2_c").val(data_approver.reporting_id);
//                 $('#multiple_approver_c').val(data_approver.reporting_id);
                
//                       if(r=="no")  {
               
//                 if (s=="Qualified"||s=="QualifiedDpr"){
                  
                  
                   
//                      $("#select_approver_c").val(data_approver.approvers_name);
//                 // $("#user_id2_c").val(data.reporting_id);
//                 $('#multiple_approver_c').val(data_approver.approvers_id);
                  
        
//                 }
                
//                  }
                 
//                     else  if(r=="not_required"){
                     
//                   if (s=="Qualified"){
                  
//                         $("#select_approver_c").val(data_approver.approvers_name);
//                 // $("#user_id2_c").val(data.reporting_id);
//                 $('#multiple_approver_c').val(data_approver.approvers_id);
                  
                 
                 
//                  }
                  
//                     }
                    
//                       else  if(r=="yes")  {
               
//                 if (s=="QualifiedLead"){
                 
//                   $("#select_approver_c").val(data_approver.approvers_name);
//                 // $("#user_id2_c").val(data.reporting_id);
//                 $('#multiple_approver_c').val(data_approver.approvers_id);
//                   }
//                 }
        
//                 }
//         })    
//         }
// //      })
     
     
     
// });
        
        
        
        
    </script>
</body>

</html>
