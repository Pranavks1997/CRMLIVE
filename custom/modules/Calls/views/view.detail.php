<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}


class CallsViewDetail extends ViewDetail
{
    public function display(){

        global $current_user;
        $log_in_user_id = $current_user->id;
        // Check if logged in user is admin or not sales person
        if($current_user->is_admin || !$this->isSalesPerson()){
            echo "<script>
                $('#opp_hide').hide()
            </script>";
        } 

        if(isset($_SESSION['flash'][$log_in_user_id])){
            echo '<script>
                alert(\''.$_SESSION['flash'][$log_in_user_id]['message'].'\')
            </script>';

            unset($_SESSION['flash'][$log_in_user_id]);
        }

        parent::display();
    }

    // Function to check if logged in user is salesperson or not
    private function isSalesPerson(){
        global $current_user;
        return (bool)in_array('^sales^', explode(',', $current_user->teamfunction_c));
    } 
}