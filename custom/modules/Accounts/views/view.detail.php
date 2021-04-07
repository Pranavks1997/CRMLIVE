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
        
        parent::preDisplay();
    }
}
