<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

class AccountsViewDetail extends ViewDetail
{
    /**
     * @see ViewList::preDisplay()
     */
    public function preDisplay()
    {
        echo "<script>
            $('#toolbar').find('li.topnav:eq(0)').hide()
        </script>";

        global $current_user;
        // Check if logged in user is admin or not sales person
        if($current_user->is_admin || !$this->isSalesPerson()){
            echo "<script>
                $('#opp_hide').hide()
            </script>";
        } 
        
        parent::preDisplay();
    }

    // Function to check if logged in user is salesperson or not
    private function isSalesPerson(){
        global $current_user;
        return (bool)in_array('^sales^', explode(',', $current_user->teamfunction_c));
    } 
}
