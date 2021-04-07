<?php

require_once('modules/Accounts/AccountsListViewSmarty.php');

class AccountsViewList extends ViewList
{
    /**
     * @see ViewList::preDisplay()
     */
    public function preDisplay()
    {
        echo '<script src="custom/modules/Accounts/list_view.js"></script>';
        require_once('modules/AOS_PDF_Templates/formLetter.php');
        formLetter::LVPopupHtml('Accounts');
        parent::preDisplay();

        global $current_user;
        // Check if logged in user is admin or not sales person
        if($current_user->is_admin || !$this->isSalesPerson()){
            echo "<script>
                $('#opp_hide').hide()
            </script>";
        } 

        
        //  Hide Quick Edit Pencil
        
        # Hide Multiselect Pencil
        
        $this->lv = new AccountsListViewSmarty();
        $this->lv->quickViewLinks = false;
        $this->lv->multiSelect = false;
    }

    // Function to check if logged in user is salesperson or not
    private function isSalesPerson(){
        global $current_user;
        return (bool)in_array('^sales^', explode(',', $current_user->teamfunction_c));
    } 
}
