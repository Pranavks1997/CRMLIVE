<?php

 require_once('include/MVC/View/views/view.popup.php');

    class CustomUsersViewPopup extends ViewPopup{

    public function listViewProcess(){

        parent::listViewProcess();

        $this->params['custom_select'] = "SELECT * ";
        $this->params['custom_from'] = "FROM users ";
        $this->where .= "WHERE id = 1";
    }

    function CustomRegistrationMetaViewPopup(){
        parent::ViewPopup();
    }

    function preDisplay(){
        parent::preDisplay();
    }
}