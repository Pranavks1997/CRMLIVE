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

        //  Hide Quick Edit Pencil
        
        # Hide Multiselect Pencil
        
        $this->lv = new AccountsListViewSmarty();
        $this->lv->quickViewLinks = false;
        $this->lv->multiSelect = false;
    }
}
