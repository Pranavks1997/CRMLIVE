<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}


class CallsViewDetail extends ViewDetail
{
    public function display(){

        global $current_user;
        $log_in_user_id = $current_user->id;

        if(isset($_SESSION['flash'][$log_in_user_id])){
            echo '<script>
                alert(\''.$_SESSION['flash'][$log_in_user_id]['message'].'\')
            </script>';

            unset($_SESSION['flash'][$log_in_user_id]);
        }

        parent::display();
    }
}