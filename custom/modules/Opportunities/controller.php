<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once ('include/MVC/Controller/SugarController.php');

class OpportunitiesController extends SugarController

{

    public function action_sales_create_opportunity()
    {
        try
        {
            global $current_user;

            $log_in_user_id = $current_user->id;

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            // $user_id = $_POST[''];
            $sql = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '" . $log_in_user_id . "' AND users.deleted = 0";
            $result = $GLOBALS['db']->query($sql);
            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                $check_sales = $row['teamfunction_c'];
                $check_mc = $row['mc_c'];
                $check_team_lead = $row['teamheirarchy_c'];

            }
            // $fields = unencodeMultienum($this->bean->report_vars);
            $team_func_array = explode(',', $check_sales);
            if (in_array("^sales^", $team_func_array) || $current_user->is_admin || $check_mc == "yes" || $check_team_lead == "team_lead")
            {
                // if(in_array("$team_func_array !== 'sales')){
                $can_create = 'yes';
            }
            else
            {
                $can_create = 'no';
            }

            echo json_encode(array(
                "status" => true,
                'view' => $can_create,
                "c" => $check_team_lead
            ));

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "some error occured"
            ));
        }
        die();
    }

    public function action_sector()
    {

        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT * FROM sector';

            $result = $GLOBALS['db']->query($sql);

            $sector_list = array();

            while ($row = mysqli_fetch_assoc($result))
            {

                $sector_list[] = $row;

            }
            echo json_encode($sector_list);

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    public function action_subSector()
    {

        if (isset($_POST['sector_name']))
        {
            $sector = $_POST['sector_name'];

        }
        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT sub_sector.name,sector_id FROM  sub_sector INNER JOIN sector ON sub_sector.sector_id=sector.id WHERE sector.name="' . $sector . '"';

            $result = $GLOBALS['db']->query($sql);

            $subSector_list = array();
            $status = array(
                status => true
            );

            while ($row = mysqli_fetch_assoc($result))
            {

                $subSector_list[] = $row;

            }
            echo json_encode($subSector_list);

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();

    }

    public function action_segment()
    {
        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT * FROM segment';

            $result = $GLOBALS['db']->query($sql);

            $segment_list = array();

            while ($row = mysqli_fetch_assoc($result))
            {

                $segment_list[] = $row;

            }
            echo json_encode($segment_list);

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    public function action_productService()
    {

        if (isset($_POST['segment_name']))
        {
            $segment = $_POST['segment_name'];

        }
        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT service.service_name, segment.id FROM service INNER JOIN segment ON service.segment_id= segment.id where segment.segment_name="' . $segment . '"';

            $result = $GLOBALS['db']->query($sql);

            $service_list = array();

            while ($row = mysqli_fetch_assoc($result))
            {

                $service_list[] = $row;

            }
            echo json_encode($service_list);

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();

    }

    public function action_stateList()
    {
        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT * FROM `states` WHERE country_id=101';

            $result = $GLOBALS['db']->query($sql);

            $state_list = array();

            while ($row = mysqli_fetch_assoc($result))
            {

                $state_list[] = $row;

            }
            echo json_encode($state_list);

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    public function action_firstSegment()
    {

        $segment_name = $_POST['segment'];

        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'INSERT INTO segment (segment_name) VALUES ("' . $segment_name . '")';

            if ($db->query($sql) == true)
            {

                echo "Segment Added Successfully";
            }
            else
            {
                echo "Refresh and add Segment again";
            }

            //   $result = 'SELECT id FROM segment WHERE segment_name="ECCE"';
            //  $res=$db->query($result);
            

            // echo $res;
            

            
        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    public function action_product()
    {

        $segment_name = $_POST['segment'];
        $service_name = $_POST['service'];

        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT id FROM `segment` WHERE segment_name="' . $segment_name . '"';

            $result = $GLOBALS['db']->query($sql);

            while ($row = mysqli_fetch_assoc($result))
            {

                $service = 'INSERT INTO service (segment_id,service_name) VALUES ("' . $row['id'] . '","' . $service_name . '")';

                if ($GLOBALS['db']->query($service) == true)
                {

                    echo "Product Added Successfully";
                }
                else
                {
                    echo "Refresh and add Product again";
                }
            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //------------saving l1 and l2 template to database------------------
    public function action_l1()
    {

        $id = $_POST['id'];
        $l1_html = base64_encode($_POST['l1_html']);
        $l1_input = base64_encode(serialize($_POST['l1_input']));
        $total_input_value = $_POST['total_input_value'];

        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT * FROM l1 WHERE opp_id="' . $id . '"';
            $result = $GLOBALS['db']->query($sql);

            if ($result->num_rows > 0)
            {

                $update_query = "UPDATE l1 SET l1_html='" . $l1_html . "',l1_input='" . $l1_input . "',total_input_value='" . $total_input_value . "' WHERE opp_id='" . $id . "'";
                $res0 = $db->query($update_query);
            }
            else
            {
                $insert_query = 'INSERT INTO l1 (opp_id,l1_html,l1_input,total_input_value) VALUES ("' . $id . '", "' . $l1_html . '","' . $l1_input . '","' . $total_input_value . '")';
                $res0 = $db->query($insert_query);
            }

            echo json_encode(array(
                "status" => true,
                "message" => "Data saved Successfully"
            ));
        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    public function action_l2()
    {

        $id = $_POST['id'];
        $l2_html = base64_encode($_POST['l2_html']);
        $l2_input = base64_encode(serialize($_POST['l2_input']));

        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            if ($id != '')
            {

                $sql = 'SELECT * FROM l2 WHERE opp_id="' . $id . '"';
                $result = $GLOBALS['db']->query($sql);
                // print_r($result->num_rows);
                if ($result->num_rows > 0)
                {
                    $update_query = "UPDATE l2 SET l2_html='" . $l2_html . "',l2_input='" . $l2_input . "' WHERE opp_id='" . $id . "'";
                    $res0 = $db->query($update_query);
                }
                else
                {
                    $insert_query = 'INSERT INTO l2 (opp_id,l2_html,l2_input) VALUES ("' . $id . '", "' . $l2_html . '","' . $l2_input . '")';
                    $res0 = $db->query($insert_query);
                }
            }
            echo json_encode(array(
                "status" => true,
                "message" => "Data saved Successfully"
            ));
        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //------------saving l1 and l2 template to database----ENDS------------
    //------------fetching l1 and l2 template data and displaying to FE------------
    public function action_fetch_l1()
    {

        $id = $_POST['id'];
        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT * FROM l1 WHERE opp_id="' . $id . '"';

            $result = $GLOBALS['db']->query($sql);

            if ($result->num_rows > 0)
            {

                while ($row = $GLOBALS['db']->fetchByAssoc($result))
                {

                    $l1_input = unserialize(base64_decode($row['l1_input']));
                    $l1_html = base64_decode($row['l1_html']);
                    $total_input_value = $row['total_input_value'];
                }
            }
            //      else{
            //            $l1_input ="";
            //            $l1_html ="";
            //             $total_input_value="";
            //      }
            echo json_encode(array(
                "status" => true,
                "l1_input" => $l1_input,
                "l1_html" => $l1_html,
                "total_input_value" => $total_input_value
            ));
        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();

    }

    public function action_fetch_l2()
    {

        $id = $_POST['id'];
        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT * FROM l2 WHERE opp_id="' . $id . '"';

            $result = $GLOBALS['db']->query($sql);

            if ($result->num_rows > 0)
            {

                while ($row = $GLOBALS['db']->fetchByAssoc($result))
                {

                    $l2_input = unserialize(base64_decode($row['l2_input']));
                    $l2_html = base64_decode($row['l2_html']);

                }
                echo json_encode(array(
                    "status" => true,
                    "l2_input" => $l2_input,
                    "l2_html" => $l2_html
                ));
            }
            else
            {
                $l2_input = "";
                $l2_html = "";
                echo json_encode(array(
                    "status" => false
                ));
            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();

    }

    //------------fetching l1 and l2 template data and displaying to FE----ENDS------------
    //------------ saving Year-quarters to database ---------------------------------------------------
    public function action_year_quarters()
    {

        $id = $_POST['id'];
        $start_year = $_POST['start_year'];
        $start_quarter = $_POST['start_quarter'];
        $end_year = $_POST['end_year'];
        $end_quarter = $_POST['end_quarter'];
        $num_of_bidders = $_POST['no_of_bidders'];
        $total = $_POST['total_input_value'];

        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            if ($num_of_bidders == "" || $num_of_bidders == 0)
            {
                $num_of_bidders = 1;
            }

            $sql = 'SELECT * FROM year_quarters WHERE opp_id="' . $id . '"';
            $result = $GLOBALS['db']->query($sql);
            // print_r($result->num_rows);
            if ($result->num_rows > 0)
            {

                while ($row = $GLOBALS['db']->fetchByAssoc($result))
                {

                    $start_year_old = $row['start_year'];
                    $start_quarter_old = $row['start_quarter'];
                    $end_year_old = $row['end_year'];
                    $end_quarter_old = $row['end_quarter'];
                    $num_of_bidders_old = $_POST['num_of_bidders'];
                    $total_old = $_POST['total_input_value'];

                }

                $update_query = "UPDATE year_quarters SET start_year='" . $start_year . "',start_quarter='" . $start_quarter . "',end_year='" . $end_year . "',end_quarter='" . $end_quarter . "',num_of_bidders='" . $num_of_bidders . "',total_input_value='" . $total . "' WHERE opp_id='" . $id . "'";
                $res0 = $db->query($update_query);

            }
            else
            {
                $insert_query = 'INSERT INTO year_quarters (opp_id,start_year,start_quarter,end_year,end_quarter,num_of_bidders,total_input_value) VALUES ("' . $id . '", "' . $start_year . '","' . $start_quarter . '", "' . $end_year . '", "' . $end_quarter . '", "' . $num_of_bidders . '", "' . $total . '")';
                $res0 = $db->query($insert_query);

            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //------------ saving Year-quarters to database-End ---------------------------------------------------
    //----------------------- fetching the year_quarters from database ----------------------------------
    public function action_fetch_year_quarters()
    {

        $id = $_POST['id'];

        try
        {

            if ($id != "")
            {

                $db = \DBManagerFactory::getInstance();
                $GLOBALS['db'];

                $sql = 'SELECT * FROM year_quarters WHERE opp_id="' . $id . '"';

                $result = $GLOBALS['db']->query($sql);

                while ($row = $GLOBALS['db']->fetchByAssoc($result))
                {
                    $start_year = $row['start_year'];
                    $start_quarter = $row['start_quarter'];
                    $end_year = $row['end_year'];
                    $end_quarter = $row['end_quarter'];
                    $num_of_bidders = $row['num_of_bidders'];
                    $total = $row['total_input_value'];
                }

                echo json_encode(array(
                    "status" => true,
                    "start_year" => $start_year,
                    "start_quarter" => $start_quarter,
                    "end_year" => $end_year,
                    "end_quarter" => $end_quarter,
                    "num_of_bidders" => $num_of_bidders,
                    "id" => $id,
                    "total" => $total
                ));
            }
            else
            {
                echo json_encode(array(
                    "status" => true,
                    "start_year" => "",
                    "start_quarter" => "",
                    "end_year" => "",
                    "end_quarter" => "",
                    "num_of_bidders" => "",
                    "id" => ""
                ));
            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();

    }

    //----------------------- fetching the year_quarters from database ----------------------------------
    //-------------------- saving the data to database dpr-bidcheckliist---------------------------------
    public function action_dpr_bidchecklist()
    {

        $id = $_POST['id'];
        $emd = $_POST['emd'];
        $pbg = $_POST['pbg'];
        $tenure = $_POST['tenure'];
        $project_value = $_POST['project_value'];
        $project_scope = $_POST['project_scope'];
        $total_input_value = $_POST['total_input_value'];

        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT * FROM DPR_bidchecklist WHERE opp_id="' . $id . '"';
            $result = $GLOBALS['db']->query($sql);
            // print_r($result->num_rows);
            if ($result->num_rows > 0)
            {
                $update_query = "UPDATE DPR_bidchecklist SET emd='" . $emd . "',pbg='" . $pbg . "',tenure='" . $tenure . "',project_value='" . $project_value . "',project_scope='" . $project_scope . "',total_input_value='" . $total_input_value . "' WHERE opp_id='" . $id . "'";
                $res0 = $db->query($update_query);
            }
            else
            {
                $insert_query = 'INSERT INTO DPR_bidchecklist (opp_id,emd,pbg,tenure,project_value,project_scope,total_input_value) VALUES ("' . $id . '", "' . $emd . '","' . $pbg . '", "' . $tenure . '", "' . $project_value . '", "' . $project_scope . '","' . $total_input_value . '")';
                $res0 = $db->query($insert_query);
            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //-------------------- saving the data to database dpr-bidcheckliist--end ---------------------------------
    //----------------------- fetching the bidchecklist from database ----------------------------------
    public function action_fetch_bidchecklist()
    {

        $id = $_POST['id'];
        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT * FROM DPR_bidchecklist WHERE opp_id="' . $id . '"';

            $result = $GLOBALS['db']->query($sql);

            if ($result->num_rows > 0)
            {

                while ($row = $GLOBALS['db']->fetchByAssoc($result))
                {

                    $emd = $row['emd'];
                    $pbg = $row['pbg'];
                    $tenure = $row['tenure'];
                    $project_value = $row['project_value'];
                    $project_scope = $row['project_scope'];
                    $total_input_value = $row['total_input_value'];

                }
            }

            $sql1 = 'SELECT * FROM bid_bidchecklist WHERE opp_id="' . $id . '"';

            $result1 = $GLOBALS['db']->query($sql1);

            if ($result1->num_rows > 0)
            {

                while ($row1 = $GLOBALS['db']->fetchByAssoc($result1))
                {

                    $emd1 = $row1['emd'];
                    $pbg1 = $row1['pbg'];
                    $tenure1 = $row1['tenure'];
                    $project_value1 = $row1['project_value'];
                    $project_scope1 = $row1['project_scope'];
                    $total_input_value1 = $row1['total_input_value'];

                }
            }

            echo json_encode(array(
                "status" => true,
                "emd" => $emd,
                "pbg" => $pbg,
                "tenure" => $tenure,
                "project_value" => $project_value,
                "project_scope" => $project_scope,
                "total_input_value" => $total_input_value,
                "emd1" => $emd1,
                "pbg1" => $pbg1,
                "tenure1" => $tenure1,
                "project_value1" => $project_value1,
                "project_scope1" => $project_scope1,
                "total_input_value1" => $total_input_value1
            ));

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();

    }

    //----------------------- fetching the  bidchecklist from database ----------------------------------
    //-------------------- saving the data to database bidcheckliist---------------------------------
    public function action_bid_bidchecklist()
    {

        $id = $_POST['id'];
        $emd = $_POST['emd'];
        $pbg = $_POST['pbg'];
        $tenure = $_POST['tenure'];
        $project_value = $_POST['project_value'];
        $project_scope = $_POST['project_scope'];
        $total_input_value = $_POST['total_input_value'];

        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT * FROM bid_bidchecklist WHERE opp_id="' . $id . '"';
            $result = $GLOBALS['db']->query($sql);
            // print_r($result->num_rows);
            if ($result->num_rows > 0)
            {
                $update_query = "UPDATE bid_bidchecklist SET emd='" . $emd . "',pbg='" . $pbg . "',tenure='" . $tenure . "',project_value='" . $project_value . "',project_scope='" . $project_scope . "',total_input_value='" . $total_input_value . "' WHERE opp_id='" . $id . "'";
                $res0 = $db->query($update_query);
            }
            else
            {
                $insert_query = 'INSERT INTO bid_bidchecklist (opp_id,emd,pbg,tenure,project_value,project_scope,total_input_value) VALUES ("' . $id . '", "' . $emd . '","' . $pbg . '", "' . $tenure . '", "' . $project_value . '", "' . $project_scope . '","' . $total_input_value . '")';
                $res0 = $db->query($insert_query);
            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //-------------------- saving the data to database bid-bidcheckliist--end ---------------------------------
    //---------------Detail View Opportunity creation checking----------------------------------------
    

    public function action_detailView_check()
    {

        $opportunity_id = $_POST['opp_id'];

        try
        {

            global $current_user;

            $log_in_user_id = $current_user->id;

            //  echo $log_in_user_id;
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql3 = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '" . $log_in_user_id . "' AND users.deleted = 0";
            $result3 = $GLOBALS['db']->query($sql3);
            while ($row3 = $GLOBALS['db']->fetchByAssoc($result3))
            {
                $check_sales = $row3['teamfunction_c'];
                $check_mc = $row3['mc_c'];
                $check_team_lead = $row3['teamheirarchy_c'];

            }

            //------------------------------------------new code--------------------------------------------
            $sql_opp = "SELECT opportunities.id,opportunities.assigned_user_id,opportunities.opportunity_type,opportunities_cstm.multiple_approver_c AS approvers,opportunities_cstm.delegate,tagged_user.user_id AS tagged_users_id, users_cstm.user_lineage as lineage FROM opportunities INNER JOIN opportunities_cstm ON opportunities_cstm.id_c=opportunities.id LEFT JOIN tagged_user ON tagged_user.opp_id = opportunities.id LEFT JOIN users_cstm ON users_cstm.id_c = opportunities.assigned_user_id WHERE opportunities.id='" . $opportunity_id . "' AND opportunities.deleted=0";
            $result_opp = $GLOBALS['db']->query($sql_opp);

            while ($row_opp = $GLOBALS['db']->fetchByAssoc($result_opp))
            {
                $opp_id = $row_opp['id'];
                $assigned_user_id = $row_opp['assigned_user_id'];
                $multiple_approver_id = $row_opp['approvers'];
                $lineage = $row_opp['lineage'];
                $tagged_users = $row_opp['tagged_users_id'];
                $opp_type = $row_opp['opportunity_type'];
                $delegte_id = $row_opp['delegate'];
            }

            $approver = explode(',', $multiple_approver_id);
            $lineage_array = explode(',', $lineage);
            $tagged_users_array = explode(',', $tagged_users);
            $delegte_id_array = explode(',', $delegte_id);
            //------------------------------------------new code--------------END------------------------------
            

            //-----Floew starts here----------
            

            if ($check_mc == "yes" || $current_user->is_admin || in_array($log_in_user_id, $lineage_array) || in_array($log_in_user_id, $approver) || in_array($log_in_user_id, $tagged_users_array) || in_array($log_in_user_id, $delegte_id_array) || $log_in_user_id == $assigned_user_id)
            {

                $message = 'true';
                echo json_encode(array(
                    "message" => $message,
                    "mc" => $check_mc
                ));

            }
            else
            {
                $message = 'false';
                echo json_encode(array(
                    "message" => $message,
                    "mc" => $check_mc
                ));
            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //---------------Detail View Opportunity creation checking--------END--------------------------------
    

    //------------------------untag users check in detailview--------------------------
    public function action_untag_users_check()
    {

        $opportunity_id = $_POST['opp_id'];

        try
        {

            global $current_user;

            $log_in_user_id = $current_user->id;

            //  echo $log_in_user_id;
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT * FROM untagged_user WHERE opp_id="' . $opportunity_id . '" ';
            $result = $GLOBALS['db']->query($sql);

            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                $untag_user = $row['user_id'];

            }

            $untag_array = explode(",", $untag_user);

            if (in_array($log_in_user_id, $untag_array))
            {

                echo json_encode(array(
                    "status" => true
                ));

            }
            else
            {
                echo json_encode("false");
            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //------------------------untag users check in detailview-----END---------------------
    //------------------------tag users check in detailview--------------------------
    public function action_tag_users_check()
    {

        $opportunity_id = $_POST['opp_id'];

        try
        {

            global $current_user;

            $log_in_user_id = $current_user->id;

            //  echo $log_in_user_id;
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT * FROM opportunities_users_1_c WHERE opportunities_users_1opportunities_ida="' . $opportunity_id . '" AND opportunities_users_1_c.deleted = 0';
            $result = $GLOBALS['db']->query($sql);

            $tag_user = array();

            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                $tag_user[] = $row['opportunities_users_1users_idb'];

            }

            $sql2 = 'SELECT * FROM opportunities WHERE id="' . $opportunity_id . '"';
            $result2 = $GLOBALS['db']->query($sql2);

            while ($row2 = $GLOBALS['db']->fetchByAssoc($result2))
            {
                $created_by = $row2['created_by'];

            }
            $sql1 = 'SELECT * FROM opportunities_cstm WHERE id_c="' . $opportunity_id . '"';
            $result1 = $GLOBALS['db']->query($sql1);

            while ($row1 = $GLOBALS['db']->fetchByAssoc($result1))
            {

                $approver = $row1['user_id2_c'];
                $deligate = $row1['delegate'];
                $assigned = $row1['user_id3_c'];

            }

            $team_func_array = explode(',', $deligate);

            if (in_array($log_in_user_id, $tag_user))
            {

                echo json_encode("true");

            }

            else if ($log_in_user_id == $created_by || $log_in_user_id == 1 || $log_in_user_id == $approver || in_array($log_in_user_id, $team_func_array) || $log_in_user_id == $assigned)
            {

                echo json_encode("true-readonly");

            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //------------------------tag users check in detailview-----END---------------------
    

    //--------------------------approver selection checking process ------------------------
    public function action_aprover_check()
    {

        $aprover_id = $_POST['aprover_id'];

        //echo json_encode($aprover_id);
        try
        {

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = "SELECT * FROM users_cstm WHERE id_c = '" . $aprover_id . "'";

            $result = $GLOBALS['db']->query($sql);

            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {

                $check_sales = $row['teamfunction_c'];
                $check_mc = $row['mc_c'];
                $check_team_lead = $row['teamheirarchy_c'];
            }

            $team_func_array = explode(',', $check_sales);

            //echo json_encode(array("check1"=>$check_sales,"check2"=>$check_team_lead,"check3"=>$check_mc));
            if ((in_array("^sales^", $team_func_array) && $check_team_lead == "team_lead") || $check_mc == "yes")
            {
                // if(in_array("$team_func_array !== 'sales')){
                $can_approve = 'yes';
                $message = "";
            }
            else
            {
                $can_approve = 'no';
                $message = "Select Team Lead from sales for approval.";
            }

            echo json_encode(array(
                "status" => true,
                "check2" => $check_team_lead,
                'approver' => $can_approve,
                'message' => $message
            ));

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Error Occurred"
            ));
        }
        die();

    }

    //--------------------------approver selection checking process ------END------------------
    //------------------------ for enabling first of a kind product and segment ------------
    

    public function action_first_of_kind()
    {

        $opportunity_id = $_POST['opp_id'];

        try
        {

            global $current_user;

            $log_in_user_id = $current_user->id;

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = "SELECT * FROM users_cstm WHERE id_c = '" . $log_in_user_id . "'";

            $result = $GLOBALS['db']->query($sql);

            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {

                $check_sales = $row['teamfunction_c'];
                $check_mc = $row['mc_c'];
                $check_team_lead = $row['teamheirarchy_c'];
            }

            $team_func_array = explode(',', $check_sales);

            //echo json_encode(array("check1"=>$check_sales,"check2"=>$check_team_lead,"check3"=>$check_mc));
            if (in_array("^sales^", $team_func_array) && $check_team_lead == "team_lead")
            {
                // if(in_array("$team_func_array !== 'sales')){
                $can_create_first_Kind = 'yes';

            }
            else
            {
                $can_create_first_Kind = 'no';

            }

            echo json_encode(array(
                "status" => true,
                "value" => $can_create_first_Kind
            ));
        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //------------------------ for enabling first of a kind product and segment ---END---------
    //---------------------Approval Buttons-----------------
    public function action_approval_buttons()
    {

        $opportunity_id = $_POST['opp_id'];
        $status = $_POST['status'];
        $rfp_eoi_published = $_POST['rfp_eoi_published'];
        $next_status = '';
        $assigned = $_POST['assigned_id'];

        try
        {

            global $current_user;

            $log_in_user_id = $current_user->id;

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = "SELECT * FROM opportunities WHERE id = '" . $opportunity_id . "'";

            $result = $GLOBALS['db']->query($sql);

            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {

                $created_by = $row['created_by'];
                //  $assigned=$row['assigned_user_id'];
                
            }
            $sql2 = "SELECT * FROM tagged_user WHERE opp_id='" . $opportunity_id . "'";
            $result2 = $GLOBALS['db']->query($sql2);

            while ($row2 = $GLOBALS['db']->fetchByAssoc($result2))
            {

                $tagged_user = $row2['user_id'];

            }

            $sq = "SELECT * FROM opportunities_cstm WHERE id_c = '" . $opportunity_id . "'";
            $resul = $GLOBALS['db']->query($sq);

            while ($ro = $GLOBALS['db']->fetchByAssoc($resul))
            {

                $opp_table_status = $ro['status_c'];
                $opp_table_published = $ro['rfporeoipublished_c'];
                $approver = $ro['multiple_approver_c'];
                $delegate = $ro['delegate'];
                $new_approver = $ro['user_id2_c'];

            }

            $tagged_user_array = array();
            $tagged_user_array = explode(',', $tagged_user);
            $team_func_array = explode(',', $delegate);
            $team_func_array1 = explode(',', $approver);

            $Approved_array = array();
            $Rejected_array = array();
            $pending_array = array();
            $id_mc = array();
            $sql_mc = "SELECT * FROM users_cstm WHERE mc_c='yes'";
            $result_mc = $GLOBALS['db']->query($sql_mc);
            while ($row_mc = $GLOBALS['db']->fetchByAssoc($result_mc))
            {

                array_push($id_mc, $row_mc['id_c']);

            }

            //------------------For MC-------------------------------------------
            if (in_array($log_in_user_id, $id_mc))
            {
                $mc = 'yes';
                if ($log_in_user_id == $assigned)
                {

                    $sql2 = "SELECT * FROM approval_table  WHERE opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "' AND row_count=(SELECT max(row_count) FROM approval_table WHERE sender='" . $log_in_user_id . "' AND opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "' ) ";

                    $result2 = $GLOBALS['db']->query($sql2);

                    if ($result2->num_rows > 0)
                    {

                        while ($row2 = $GLOBALS['db']->fetchByAssoc($result2))
                        {

                            array_push($Approved_array, $row2['Approved']);
                            array_push($Rejected_array, $row2['Rejected']);
                            array_push($pending_array, $row2['pending']);

                        }

                        $value = 1;
                        foreach ($Approved_array as $app)
                        {
                            $value = $app * $value;
                        }

                        $value1 = 0;
                        foreach ($Rejected_array as $rej)
                        {
                            $value1 = $rej + $value1;
                        }

                        $value2 = 0;
                        foreach ($pending_array as $pen)
                        {
                            $value2 = $pen + $value2;
                        }

                        if ($value2 > 0)
                        {
                            $value2 = 1;
                            $value1 = 0;
                        }
                        else
                        {
                            $value1 = 1;
                            $value2 = 0;
                        }

                        if ($value1 == 1)
                        {
                            $button = "send_approval_same";
                            echo json_encode(array(
                                "status" => true,
                                "button" => $button,
                                'message' => 'rejected',
                                "mc" => $mc
                            ));
                        }
                        else if ($value == 1)
                        {

                            $button = "approve_reject";
                            echo json_encode(array(
                                "status" => true,
                                "button" => $button,
                                "mc" => $mc
                            ));

                        }
                        else if ($value2 == 1)
                        {
                            $button = "pending";
                            echo json_encode(array(
                                "status" => true,
                                "button" => $button,
                                'message' => 'rejected',
                                "mc" => $mc
                            ));
                        }
                    }

                    else
                    {
                        $sql25 = "SELECT * FROM approval_table  WHERE approver_rejector='" . $log_in_user_id . "' AND opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "' AND row_count=(SELECT max(row_count) FROM approval_table WHERE approver_rejector='" . $log_in_user_id . "'  AND opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "' ) ";

                        $result25 = $GLOBALS['db']->query($sql25);

                        if ($result25->num_rows > 0)
                        {

                            while ($row25 = $GLOBALS['db']->fetchByAssoc($result25))
                            {

                                array_push($Approved_array, $row25['Approved']);
                                array_push($Rejected_array, $row25['Rejected']);
                                array_push($pending_array, $row25['pending']);

                            }

                            $value = 1;
                            foreach ($Approved_array as $app)
                            {
                                $value = $app * $value;
                            }

                            $value1 = 0;
                            foreach ($Rejected_array as $rej)
                            {
                                $value1 = $rej + $value1;
                            }

                            $value2 = 0;
                            foreach ($pending_array as $pen)
                            {
                                $value2 = $pen + $value2;
                            }

                            if ($value2 > 0)
                            {
                                $value2 = 1;
                                $value1 = 0;
                            }
                            else
                            {
                                $value1 = 1;
                                $value2 = 0;
                            }

                            if ($value2 == 1)
                            {
                                $button = "approve_reject";
                                echo json_encode(array(
                                    "status" => true,
                                    "button" => $button,
                                    'message' => 'rejected',
                                    "mc" => $mc
                                ));
                            }
                        }

                        else
                        {
                            $button = 'approve';
                            echo json_encode(array(
                                "status" => true,
                                "button" => $button,
                                "mc" => $mc
                            ));
                        }

                    }
                }
                else
                {
                    $sql25 = "SELECT * FROM approval_table  WHERE approver_rejector='" . $log_in_user_id . "' AND opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "' AND row_count=(SELECT max(row_count) FROM approval_table WHERE approver_rejector='" . $log_in_user_id . "'  AND opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "' ) ";

                    $result25 = $GLOBALS['db']->query($sql25);

                    if ($result25->num_rows > 0)
                    {

                        while ($row25 = $GLOBALS['db']->fetchByAssoc($result25))
                        {

                            array_push($Approved_array, $row25['Approved']);
                            array_push($Rejected_array, $row25['Rejected']);
                            array_push($pending_array, $row25['pending']);

                        }

                        $value = 1;
                        foreach ($Approved_array as $app)
                        {
                            $value = $app * $value;
                        }

                        $value1 = 0;
                        foreach ($Rejected_array as $rej)
                        {
                            $value1 = $rej + $value1;
                        }

                        $value2 = 0;
                        foreach ($pending_array as $pen)
                        {
                            $value2 = $pen + $value2;
                        }

                        if ($value2 > 0)
                        {
                            $value2 = 1;
                            $value1 = 0;
                        }
                        else
                        {
                            $value1 = 1;
                            $value2 = 0;
                        }

                        if ($value2 == 1)
                        {
                            $button = "approve_reject";
                            echo json_encode(array(
                                "status" => true,
                                "button" => $button,
                                'message' => 'rejected',
                                "mc" => $mc
                            ));
                        }
                    }

                    else
                    {
                        echo json_encode(array(
                            "status" => true,
                            "button" => 'hide_all',
                            "mc" => $mc
                        ));
                    }

                }

            }

            //------------For approver-----------------------------------------------------------------
            else if ((in_array($log_in_user_id, $team_func_array1) && $log_in_user_id != $assigned) || ($log_in_user_id == $new_approver && $log_in_user_id != $assigned))
            {

                $mc = 'no';
                $sql2 = "SELECT * FROM approval_table WHERE id=(SELECT max(id) FROM approval_table WHERE approver_rejector='" . $log_in_user_id . "' AND opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "')";

                $result2 = $GLOBALS['db']->query($sql2);

                if ($result2->num_rows > 0)
                {
                    while ($row2 = $GLOBALS['db']->fetchByAssoc($result2))
                    {

                        $Approved = $row2['Approved'];
                        $Rejected = $row2['Rejected'];
                        $pending = $row2['pending'];

                    }
                }
                if ($Approved == 0 && $Rejected == 0 && $pending == 1)
                {

                    echo json_encode(array(
                        "status" => true,
                        "button" => 'approve_reject',
                        "mc" => $mc
                    ));
                }
                else
                {
                    echo json_encode(array(
                        "status" => true,
                        "button" => 'hide_all',
                        "mc" => $mc
                    ));
                }

            }
            //---------------For sender----------------------------------------------------------------
            else if (($log_in_user_id == $created_by && $log_in_user_id == $assigned) || $log_in_user_id == $assigned || in_array($log_in_user_id, $tagged_user_array))
            {

                $mc = 'no';

                // removed sender condition from inside select where clause
                $sql2 = "SELECT * FROM approval_table  WHERE opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "' AND row_count=(SELECT max(row_count) FROM approval_table WHERE   opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "' ) ";

                $result2 = $GLOBALS['db']->query($sql2);

                if ($result2->num_rows > 0)
                {

                    while ($row2 = $GLOBALS['db']->fetchByAssoc($result2))
                    {

                        array_push($Approved_array, $row2['Approved']);
                        array_push($Rejected_array, $row2['Rejected']);
                        array_push($pending_array, $row2['pending']);

                    }

                    $value = 1;
                    foreach ($Approved_array as $app)
                    {
                        $value = $app * $value;
                    }

                    $value1 = 0;
                    foreach ($Rejected_array as $rej)
                    {
                        $value1 = $rej + $value1;
                    }

                    $value2 = 0;
                    foreach ($pending_array as $pen)
                    {
                        $value2 = $pen + $value2;
                    }

                    if ($value2 > 0)
                    {
                        $value2 = 1;
                        $value1 = 0;
                    }
                    else
                    {
                        $value1 = 1;
                        $value2 = 0;
                    }

                    if ($value1 == 1)
                    {
                        $button = "send_approval_same";
                        echo json_encode(array(
                            "status" => true,
                            "button" => $button,
                            'message' => 'rejected',
                            "mc" => $mc
                        ));
                    }
                    else if ($value == 1)
                    {

                        $button = "send_approval";
                        echo json_encode(array(
                            "status" => true,
                            "button" => $button,
                            "mc" => $mc
                        ));

                    }
                    else if ($value2 == 1)
                    {
                        $button = "pending";
                        echo json_encode(array(
                            "status" => true,
                            "button" => $button,
                            'message' => 'rejected',
                            "mc" => $mc
                        ));
                    }
                }

                else
                {

                    $button = 'send_approval';
                    echo json_encode(array(
                        "status" => true,
                        "button" => $button,
                        "mc" => $mc
                    ));

                }

            }
            //-----------------For deligate------------------------------------------------------------
            else if (in_array($log_in_user_id, $team_func_array))
            {
                $mc = 'no';
                $sql2 = "SELECT * FROM approval_table WHERE id=(SELECT max(id) FROM approval_table WHERE delegate_id='" . $log_in_user_id . "' AND opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "')";

                $result2 = $GLOBALS['db']->query($sql2);

                if ($result2->num_rows > 0)
                {
                    while ($row2 = $GLOBALS['db']->fetchByAssoc($result2))
                    {

                        $Approved = $row2['Approved'];
                        $Rejected = $row2['Rejected'];
                        $pending = $row2['pending'];

                    }
                }
                if ($Approved == 0 && $Rejected == 0 && $pending == 1)
                {

                    echo json_encode(array(
                        "status" => true,
                        "button" => 'approve_reject',
                        "mc" => $mc
                    ));
                }

            }

            else if ($log_in_user_id !== $assigned)
            {
                echo json_encode(array(
                    "status" => true,
                    "button" => 'hide_all',
                    "mc" => $mc
                ));
            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //---------------------Approval Buttons---------END--------
    //----------------------Opp icons in detail view-----------------------
    public function action_opp_icons()
    {

        $opportunity_id = $_POST['opp_id'];
        $status = $_POST['status'];
        $rfp_eoi_published = $_POST['rfp_eoi_published'];

        try
        {

            global $current_user;

            $log_in_user_id = $current_user->id;

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = "SELECT * FROM opportunities WHERE id = '" . $opportunity_id . "'";

            $result = $GLOBALS['db']->query($sql);

            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {

                $created_by = $row['created_by'];
                $assigned = $row['assigned_user_id'];

            }

            $sq = "SELECT * FROM opportunities_cstm WHERE id_c = '" . $opportunity_id . "'";
            $resul = $GLOBALS['db']->query($sq);

            while ($ro = $GLOBALS['db']->fetchByAssoc($resul))
            {

                $opp_table_status = $ro['status_c'];
                $approver = $ro['multiple_approver_c'];
                $delegate = $ro['delegate'];
                $new_approver = $ro['user_id2_c'];

            }

            $team_func_array = explode(',', $delegate);
            $team_func_array1 = explode(',', $approver);
            $team_func_array2 = explode(',', $new_approver);

            if (in_array($log_in_user_id, $team_func_array1))
            {

                $sql2 = "SELECT * FROM approval_table WHERE id=(SELECT max(id) FROM approval_table  WHERE approver_rejector='" . $log_in_user_id . "' AND opp_id='" . $opportunity_id . "'  AND rfp_eoi_published='" . $rfp_eoi_published . "'  ORDER BY id DESC LIMIT 1)";

                $result2 = $GLOBALS['db']->query($sql2);

                if ($result2->num_rows > 0)
                {
                    while ($row2 = $GLOBALS['db']->fetchByAssoc($result2))
                    {

                        $Approved = $row2['Approved'];
                        $Rejected = $row2['Rejected'];
                        $pending = $row2['pending'];

                    }
                }

                if ($Approved == 0 && $Rejected == 0 && $pending == 1)
                {

                    $button = 'pending';
                    echo json_encode(array(
                        "status" => true,
                        "button" => $button,
                        'rfp_eoi_published' => $rfp_eoi_published
                    ));

                }

                else if ($Approved == 1 && $Rejected == 0 && $pending == 0)
                {

                    $button = 'green';
                    echo json_encode(array(
                        "status" => true,
                        "button" => $button,
                        'rfp_eoi_published' => $rfp_eoi_published
                    ));

                }
                else if ($Approved == 0 && $Rejected == 1 && $pending == 0)
                {

                    $button = 'red';
                    echo json_encode(array(
                        "status" => true,
                        "button" => $button,
                        'message' => 'rejected'
                    ));

                }

            }

            else if (in_array($log_in_user_id, $team_func_array))
            {

                $sql2 = "SELECT * FROM approval_table WHERE id=(SELECT max(id) FROM approval_table WHERE delegate_id='" . $log_in_user_id . "' AND opp_id='" . $opportunity_id . "'  AND rfp_eoi_published='" . $rfp_eoi_published . "'  ORDER BY id DESC LIMIT 1)";

                $result2 = $GLOBALS['db']->query($sql2);

                if ($result2->num_rows > 0)
                {

                    while ($row2 = $GLOBALS['db']->fetchByAssoc($result2))
                    {

                        $Approved = $row2['Approved'];
                        $Rejected = $row2['Rejected'];
                        $pending = $row2['pending'];

                    }
                }

                if ($Approved == 0 && $Rejected == 0 && $pending == 1)
                {

                    $button = 'pending';
                    echo json_encode(array(
                        "status" => true,
                        "button" => $button,
                        'rfp_eoi_published' => $rfp_eoi_published
                    ));

                }

                else if ($Approved == 1 && $Rejected == 0 && $pending == 0)
                {

                    $button = 'green';
                    echo json_encode(array(
                        "status" => true,
                        "button" => $button,
                        'rfp_eoi_published' => $rfp_eoi_published
                    ));

                }
                else if ($Approved == 0 && $Rejected == 1 && $pending == 0)
                {

                    $button = 'red';
                    echo json_encode(array(
                        "status" => true,
                        "button" => $button,
                        'message' => 'rejected'
                    ));

                }

            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //------------------------Opp icons in detail view--END-------------
    //-----------------------Send for Approval--------------------
    public function action_send_for_approval()
    {

        $opportunity_id = $_POST['opp_id'];
        $status = $_POST['status'];
        $apply_for = $_POST['apply_for'];
        $date_time = $_POST['date_time'];
        $rfp_eoi_published = $_POST['rfp_eoi_published'];
        $base_url = $_POST['base_url'];
        $approver = $_POST['myJSON'];
        $approver_array = array();
        $Approved_array = array();
        $Rejected_array = array();
        $pending_array = array();
        $opp_name = $_POST['opp_name'];
        $approver_name = $_POST['multiple_approver_c'];
        $row_count = 1;
        try
        {

            global $current_user;

            $log_in_user_id = $current_user->id;

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql1 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id='" . $log_in_user_id . "'  ";
            $result1 = $GLOBALS['db']->query($sql1);
            while ($row1 = $GLOBALS['db']->fetchByAssoc($result1))
            {

                $sender_name = $row1['fullname'];
            }

            if ($apply_for == 'qualifylead')
            {
                $apply = 'Qualify Lead';

            }
            else if ($apply_for == 'qualifyOpportunity')
            {
                $apply = 'Qualify Opportunity';
            }
            else if ($apply_for == 'qualifyDpr')
            {
                $apply = 'Qualify DPR';
            }
            else if ($apply_for == 'qualifyBid')
            {
                $apply = 'Qualify BID';
            }
            else if ($apply_for == 'closure')
            {
                $apply = 'Closure';
            }
            else if ($apply_for == 'Dropping')
            {
                $apply = 'Dropping Opportunity';
            }

            $approver_array = explode(',', $approver);

            $email_array = array();
            $sql2 = "SELECT  * FROM users WHERE id IN ('" . implode("','", $approver_array) . "') ";
            $result2 = $GLOBALS['db']->query($sql2);
            while ($row2 = $GLOBALS['db']->fetchByAssoc($result2))
            {

                array_push($email_array, $row2['user_name']);
            }
            $row_array = array();

            $sql_i = "SELECT * FROM approval_table WHERE  opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "'";

            $result_i = $GLOBALS['db']->query($sql_i);

            while ($row_i = $GLOBALS['db']->fetchByAssoc($result_i))
            {
                array_push($row_array, $row_i['row_count']);

            }

            if (count($row_array) >= 1)
            {
                $row_count = max($row_array);
            }

            if ($row_count == 1 || $row_count > 1)
            {
                $row_count = $row_count + 1;
                foreach ($approver_array as $approvers)
                {

                    $sql = 'INSERT INTO approval_table( opp_id,rfp_eoi_published,sender,status,apply_for,Approved,Rejected,approver_rejector,comments,date_time,pending,row_count) VALUES ("' . $opportunity_id . '","' . $rfp_eoi_published . '","' . $log_in_user_id . '","' . $status . '","' . $apply_for . '","0","0","' . $approvers . '","","' . $date_time . '","1","' . $row_count . '")';

                    if ($db->query($sql) == true)
                    {

                        //alerts
                        $alert = BeanFactory::newBean('Alerts');
                        $alert->name = 'Opportunity "' . $opp_name . '"';
                        $alert->description = ' is recieved for approval to "' . $apply . '" from ' . $sender_name . '';
                        $alert->url_redirect = $base_url . '?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D' . $opportunity_id;
                        $alert->target_module = 'Opportunities';
                        $alert->assigned_user_id = $approvers;
                        $alert->type = 'info';
                        $alert->is_read = 0;
                        $alert->save();
                        //    echo json_encode(array("status"=>true, "message" => "All Forms Saved Successfully and Email Sent to Business Head for Approval"));
                        

                        
                    }

                    $message = "true";

                }

            }
            else
            {
                foreach ($approver_array as $approvers)
                {

                    $sql = 'INSERT INTO approval_table( opp_id,rfp_eoi_published,sender,status,apply_for,Approved,Rejected,approver_rejector,comments,date_time,pending,row_count) VALUES ("' . $opportunity_id . '","' . $rfp_eoi_published . '","' . $log_in_user_id . '","' . $status . '","' . $apply_for . '","0","0","' . $approvers . '","","' . $date_time . '","1","' . $row_count . '")';

                    if ($db->query($sql) == true)
                    {

                        //alerts
                        $alert = BeanFactory::newBean('Alerts');
                        $alert->name = 'Opportunity "' . $opp_name . '"';
                        $alert->description = ' is received for approval to "' . $apply . '" from ' . $sender_name . '';
                        $alert->url_redirect = $base_url . '?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D' . $opportunity_id;
                        $alert->target_module = 'Opportunities';
                        $alert->assigned_user_id = $approvers;
                        $alert->type = 'info';
                        $alert->is_read = 0;
                        $alert->save();
                        //    echo json_encode(array("status"=>true, "message" => "All Forms Saved Successfully and Email Sent to Business Head for Approval"));
                        

                        
                    }

                    $message = "true";

                }
            }

            if ($message == "true")
            {

                echo 'Opportunity  "' . $opp_name . '" has been sent to ' . $approver_name . ' for approval';
                foreach ($email_array as $email)
                {

                    $template = 'Opportunity "' . $opp_name . '" is received for approval to "' . $apply . '" from ' . $sender_name . '.<br><br>Click here to view: www.ampersandcrm.com';

                    //    require_once('include/SugarPHPMailer.php');
                    //    include_once('include/utils/db_utils.php');
                    //      $emailObj = new Email();
                    //      $defaults = $emailObj->getSystemDefaultEmail();
                    //      $mail = new SugarPHPMailer();
                    //      $mail->IsHTML(true);
                    //      $mail->setMailerForSystem();
                    //      $mail->From = $defaults['email'];
                    //                     $mail->FromName = $defaults['name'];
                    //      $mail->Subject = 'CRM ALERT - Approval Request';
                    //    $mail->Body =$template;
                    //      $mail->prepForOutbound();
                    //      $mail->AddAddress($email);
                    //      @$mail->Send();
                    $created_at_time = date('Y-m-d H:i:s');
                    $sql_email = "INSERT INTO `email_queue` (`subject`, `body`, `to`, `created_at`) VALUES ('CRM ALERT - Approval Request', '$template', '$email', '$created_at_time')";

                    $GLOBALS['db']->query($sql_email);
                }
            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }

        die();
    }

    //-----------------------Send for Approval-------END-------------
    //---------------------Approve or Reject -------------------------------------------
    public function action_approve()
    {

        $opportunity_id = $_POST['opp_id'];
        $status = $_POST['status'];
        $apply_for = $_POST['apply_for'];
        $date_time = $_POST['date_time'];
        $rfp_eoi_published = $_POST['rfp_eoi_published'];
        $Approved = $_POST['approved'];
        $Rejected = $_POST['rejected'];
        $Comments = $_POST['comments'];
        $pending = $_POST['pending'];
        $next_status = $_POST['next_status'];
        $base_url = $_POST['base_url'];
        $approver = $_POST['myJSON'];
        $Approved_array = array();
        $Rejected_array = array();
        $pending_array = array();
        $approver_array = array();
        $by_mc = $_POST['assigned_id'];
        $row_count = 1;

        $mes = '';
        try
        {

            global $current_user;

            $log_in_user_id = $current_user->id;

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sq = "SELECT * FROM opportunities_cstm WHERE id_c = '" . $opportunity_id . "'";
            $resul = $GLOBALS['db']->query($sq);

            while ($ro = $GLOBALS['db']->fetchByAssoc($resul))
            {

                $opp_table_status = $ro['status_c'];
                $opp_table_published = $ro['rfporeoipublished_c'];
                // $approver=$ro['multiple_approver_c'];
                $delegate = $ro['delegate'];
                $new_approver = $ro['user_id2_c'];

            }
            $team_func_array = explode(',', $delegate);
            $approver_array = explode(',', $approver);
            $alert_users = array();

            $sql = "SELECT * FROM opportunities WHERE id = '" . $opportunity_id . "'";

            $result = $GLOBALS['db']->query($sql);

            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                $opp_name = $row['name'];
                // array_push($alert_users, $row['created_by']);
                array_push($alert_users, $row['assigned_user_id']);

            }
            $sql2 = "SELECT * FROM tagged_user WHERE opp_id='" . $opportunity_id . "'";
            $result2 = $GLOBALS['db']->query($sql2);

            while ($row2 = $GLOBALS['db']->fetchByAssoc($result2))
            {

                $tag = $row2['user_id'];

            }
            $tag_array = array();
            $tag_array = explode(',', $tag);

            $alert_users = array_merge($alert_users, $tag_array);

            $alert_users = array_unique($alert_users);

            $sql1 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id='" . $log_in_user_id . "'  ";
            $result1 = $GLOBALS['db']->query($sql1);
            while ($row1 = $GLOBALS['db']->fetchByAssoc($result1))
            {

                $approver_name = $row1['fullname'];
            }

            if ($apply_for == 'qualifylead')
            {
                $apply = 'Qualify Lead';

            }
            else if ($apply_for == 'qualifyOpportunity')
            {
                $apply = 'Qualify Opportunity';
            }
            else if ($apply_for == 'qualifyDpr')
            {
                $apply = 'Qualify DPR';
            }
            else if ($apply_for == 'qualifyBid')
            {
                $apply = 'Qualify BID';
            }
            else if ($apply_for == 'closure')
            {
                $apply = 'Closure';
            }
            else if ($apply_for == 'Dropping')
            {
                $apply = 'Dropping Opportunity';

            }

            $email_array = array();
            $sql23 = "SELECT  * FROM users WHERE id IN ('" . implode("','", $alert_users) . "') ";
            $result23 = $GLOBALS['db']->query($sql23);
            while ($row23 = $GLOBALS['db']->fetchByAssoc($result23))
            {

                array_push($email_array, $row23['user_name']);
            }

            //for mc
            $id_mc = array();
            $sql_mc = "SELECT * FROM users_cstm WHERE mc_c='yes'";
            $result_mc = $GLOBALS['db']->query($sql_mc);
            while ($row_mc = $GLOBALS['db']->fetchByAssoc($result_mc))
            {

                array_push($id_mc, $row_mc['id_c']);

            }

            $opp_mc = 'SELECT * From opportunities WHERE id="' . $opportunity_id . '"';
            $re_mc = $GLOBALS['db']->query($opp_mc);
            while ($ow_mc = $GLOBALS['db']->fetchByAssoc($re_mc))
            {
                //$by_mc=$ow_mc['created_by'];
                
            }

            //-----------------flow starts here------------------------------------
            

            if (in_array($log_in_user_id, $id_mc) && $log_in_user_id == $by_mc)
            {

                $row_array = array();

                $sql_i = "SELECT * FROM approval_table WHERE  opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "'";

                $result_i = $GLOBALS['db']->query($sql_i);

                while ($row_i = $GLOBALS['db']->fetchByAssoc($result_i))
                {
                    array_push($row_array, $row_i['row_count']);

                }

                if (count($row_array) >= 1)
                {
                    $row_count = max($row_array);
                }

                if ($row_count == 1 || $row_count > 1)
                {
                    $row_count = $row_count + 1;

                    $sql_i11 = "SELECT * FROM approval_table WHERE  opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "' AND approver_rejector='" . $log_in_user_id . "' AND pending=1";

                    $result_i11 = $GLOBALS['db']->query($sql_i11);

                    if ($result_i11->num_rows > 0)
                    {

                        $sql_i12 = 'UPDATE approval_table SET Approved="' . $Approved . '" ,Rejected="' . $Rejected . '",pending="' . $pending . '",comments="' . $Comments . '",date_time="' . $date_time . '" WHERE opp_id="' . $opportunity_id . '"  AND approver_rejector="' . $log_in_user_id . '" AND status="' . $status . '" AND rfp_eoi_published="' . $rfp_eoi_published . '" AND pending=1';
                        $result_i12 = $GLOBALS['db']->query($sql_i12);

                        $sql27 = "SELECT * FROM approval_table  WHERE opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "' AND row_count=(SELECT max(row_count) FROM approval_table WHERE  opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "')";

                        $result27 = $GLOBALS['db']->query($sql27);

                        if ($result27->num_rows > 0)
                        {

                            while ($row27 = $GLOBALS['db']->fetchByAssoc($result27))
                            {

                                array_push($Approved_array, $row27['Approved']);
                                array_push($Rejected_array, $row27['Rejected']);
                                array_push($pending_array, $row27['pending']);

                            }

                            $value = 1;
                            foreach ($Approved_array as $app)
                            {

                                $value = $app * $value;
                                $value;
                            }

                        }

                        if ($value > 0)
                        {

                            $sql77 = "UPDATE opportunities_cstm SET status_c='" . $next_status . "',due_date_c='' WHERE id_c='" . $opportunity_id . "'";

                            if ($db->query($sql77) == true)
                            {

                                echo json_encode(array(
                                    "status" => true,
                                    "next_status" => $next_status
                                ));

                            }

                        }
                        else
                        {
                            echo json_encode("approved");

                        }

                    }

                    else
                    {

                        $sql_approve = 'INSERT INTO approval_table(opp_id,rfp_eoi_published,sender,status,apply_for,Approved,Rejected,approver_rejector,comments,date_time,pending,row_count) VALUES ("' . $opportunity_id . '","' . $rfp_eoi_published . '","' . $log_in_user_id . '","' . $status . '","' . $apply_for . '","1","0","' . $log_in_user_id . '","' . $Comments . '","' . $date_time . '","0","' . $row_count . '")';

                        //  $result_approve = $GLOBALS['db']->query($sql_approve);
                        if ($GLOBALS['db']->query($sql_approve) == true)
                        {

                            array_shift($approver_array);
                            foreach ($approver_array as $approvers)
                            {

                                $sql_1 = 'INSERT INTO approval_table( opp_id,rfp_eoi_published,sender,status,apply_for,Approved,Rejected,approver_rejector,comments,date_time,pending,row_count) VALUES ("' . $opportunity_id . '","' . $rfp_eoi_published . '","' . $log_in_user_id . '","' . $status . '","' . $apply_for . '","0","0","' . $approvers . '","","' . $date_time . '","1","' . $row_count . '")';

                                $result_approve1 = $GLOBALS['db']->query($sql_1);

                                //  if($GLOBALS['db']->query($sql_approve)==TRUE){}
                                
                            }

                            if ($rfp_eoi_published == 'no')
                            {

                                if ($status == "Lead" || $status == "QualifiedLead" || $status == "QualifiedBid" || $status == "Drop")
                                {

                                    $sql7 = "UPDATE opportunities_cstm SET status_c='" . $next_status . "' ,due_date_c='' WHERE id_c='" . $opportunity_id . "'";

                                    if ($db->query($sql7) == true)
                                    {

                                        // akash change here
                                        echo json_encode(array(
                                            "status" => true,
                                            "next_status" => $next_status
                                        ));
                                        //alerts
                                        
                                    }
                                }
                                else
                                {
                                    echo json_encode("approved");
                                }
                            }
                            else if ($rfp_eoi_published == 'yes')
                            {
                                if ($status == "Lead" || $status == "QualifiedBid" || $status == "Drop")
                                {

                                    $sql7 = "UPDATE opportunities_cstm SET status_c='" . $next_status . "',,due_date_c='' WHERE id_c='" . $opportunity_id . "'";

                                    if ($db->query($sql7) == true)
                                    {

                                        // akash change here
                                        echo json_encode(array(
                                            "status" => true,
                                            "next_status" => $next_status
                                        ));
                                        //alerts
                                        
                                    }
                                }
                                else
                                {
                                    echo json_encode("approved");
                                }
                            }
                            else if ($rfp_eoi_published == 'not_required' || $status == "Drop")
                            {

                                if ($status == "Lead" || $status == "QualifiedLead" || $status == "QualifiedDpr")
                                {

                                    $sql7 = "UPDATE opportunities_cstm SET status_c='" . $next_status . "',due_date_c='' WHERE id_c='" . $opportunity_id . "'";

                                    if ($db->query($sql7) == true)
                                    {

                                        // akash change here
                                        echo json_encode(array(
                                            "status" => true,
                                            "next_status" => $next_status
                                        ));
                                        //alerts
                                        
                                    }
                                }
                                else
                                {
                                    echo json_encode("approved");
                                }
                            }

                        }

                    }

                }

            }
            else
            {

                if (in_array($log_in_user_id, $team_func_array))
                {

                    $sql4 = "SELECT * FROM approval_table WHERE delegate_id='" . $log_in_user_id . "'";

                    $result4 = $GLOBALS['db']->query($sql4);

                    if ($result4->num_rows > 0)
                    {

                        $sql = 'UPDATE approval_table SET Approved="' . $Approved . '" ,Rejected="' . $Rejected . '",pending="' . $pending . '",delegate_comments="' . $Comments . '",delegate_date_time="' . $date_time . '"  WHERE opp_id="' . $opportunity_id . '"  AND delegate_id="' . $log_in_user_id . '" AND status="' . $status . '" AND rfp_eoi_published="' . $rfp_eoi_published . '" AND pending=1';
                        $result = $GLOBALS['db']->query($sql);
                        if ($GLOBALS['db']->query($sql) == true)
                        {

                            foreach ($alert_users as $user)
                            {
                                $alert = BeanFactory::newBean('Alerts');
                                $alert->name = 'Opportunity "' . $opp_name . '"';
                                $alert->description = ' is approved for ' . $apply . ' by ' . $approver_name . '';
                                $alert->url_redirect = $base_url . '?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D' . $opportunity_id;
                                $alert->target_module = 'Opportunities';
                                $alert->assigned_user_id = $user;
                                $alert->type = 'info';
                                $alert->is_read = 0;
                                $alert->save();

                            }

                            //            // //emails
                            foreach ($email_array as $email)
                            {
                                $template = 'Opportunity "' . $opp_name . '" is approved for ' . $apply . ' by ' . $approver_name . '.<br><br>Click here to view: www.ampersandcrm.com';
                                //    require_once('include/SugarPHPMailer.php');
                                //    include_once('include/utils/db_utils.php');
                                //      $emailObj = new Email();
                                //      $defaults = $emailObj->getSystemDefaultEmail();
                                //      $mail = new SugarPHPMailer();
                                //      $mail->IsHTML(true);
                                //      $mail->setMailerForSystem();
                                //                     $mail->From = $defaults['email'];
                                //                     $mail->FromName = $defaults['name'];
                                //      $mail->Subject = 'CRM ALERT - Approved';
                                //    $mail->Body =$template;
                                //      $mail->prepForOutbound();
                                //      $mail->AddAddress($email);
                                //      @$mail->Send();
                                $created_at_time = date('Y-m-d H:i:s');
                                $sql_email = "INSERT INTO `email_queue` (`subject`, `body`, `to`, `created_at`) VALUES ('CRM ALERT - Approved', '$template', '$email', '$created_at_time')";

                                $GLOBALS['db']->query($sql_email);
                            }
                        }

                    }

                    $sql2 = "SELECT * FROM approval_table  WHERE opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "' AND row_count=(SELECT max(row_count) FROM approval_table WHERE  opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "') ";

                    $result2 = $GLOBALS['db']->query($sql2);

                    if ($result2->num_rows > 0)
                    {

                        while ($row2 = $GLOBALS['db']->fetchByAssoc($result2))
                        {

                            array_push($Approved_array, $row2['Approved']);
                            array_push($Rejected_array, $row2['Rejected']);
                            array_push($pending_array, $row2['pending']);

                        }

                        $value = 1;
                        foreach ($Approved_array as $app)
                        {

                            $value = $app * $value;
                            $value;
                        }

                    }

                    if ($value > 0)
                    {

                        $sql7 = "UPDATE opportunities_cstm SET status_c='" . $next_status . "' ,due_date_c='' WHERE id_c='" . $opportunity_id . "'";

                        if ($db->query($sql7) == true)
                        {
                            // akash change here
                            echo json_encode(array(
                                "status" => true,
                                "next_status" => $next_status
                            ));
                            //alerts
                            
                        }

                    }
                    else
                    {
                        echo json_encode("approved");
                        //alerts
                        
                    }

                }

                else
                {

                    $sql4 = "SELECT * FROM approval_table WHERE approver_rejector='" . $log_in_user_id . "'";

                    $result4 = $GLOBALS['db']->query($sql4);

                    if ($result4->num_rows > 0)
                    {

                        $sql = 'UPDATE approval_table SET Approved="' . $Approved . '" ,Rejected="' . $Rejected . '",pending="' . $pending . '",comments="' . $Comments . '",date_time="' . $date_time . '" WHERE opp_id="' . $opportunity_id . '"  AND approver_rejector="' . $log_in_user_id . '" AND status="' . $status . '" AND rfp_eoi_published="' . $rfp_eoi_published . '" AND pending=1';
                        $result = $GLOBALS['db']->query($sql);
                        if ($GLOBALS['db']->query($sql) == true)
                        {

                            foreach ($alert_users as $user)
                            {
                                $alert = BeanFactory::newBean('Alerts');
                                $alert->name = 'Opportunity "' . $opp_name . '"';
                                $alert->description = ' is approved for ' . $apply . ' by ' . $approver_name . '';
                                $alert->url_redirect = $base_url . '?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D' . $opportunity_id;
                                $alert->target_module = 'Opportunities';
                                $alert->assigned_user_id = $user;
                                $alert->type = 'info';
                                $alert->is_read = 0;
                                $alert->save();

                            }

                            //                        // //emails
                            foreach ($email_array as $email)
                            {
                                $template = 'Opportunity "' . $opp_name . '" is approved for ' . $apply . ' by ' . $approver_name . '.<br><br>Click here to view: www.ampersandcrm.com';
                                //    require_once('include/SugarPHPMailer.php');
                                //    include_once('include/utils/db_utils.php');
                                //      $emailObj = new Email();
                                //      $defaults = $emailObj->getSystemDefaultEmail();
                                //      $mail = new SugarPHPMailer();
                                //      $mail->IsHTML(true);
                                //      $mail->setMailerForSystem();
                                //                     $mail->From = $defaults['email'];
                                //                     $mail->FromName = $defaults['name'];
                                //      $mail->Subject = 'CRM ALERT - Approved';
                                //    $mail->Body =$template;
                                //      $mail->prepForOutbound();
                                //      $mail->AddAddress($email);
                                //      @$mail->Send();
                                $created_at_time = date('Y-m-d H:i:s');
                                $sql_email = "INSERT INTO `email_queue` (`subject`, `body`, `to`, `created_at`) VALUES ('CRM ALERT - Approved', '$template', '$email', '$created_at_time')";

                                $GLOBALS['db']->query($sql_email);
                            }
                        }

                    }
                    $sql2 = "SELECT * FROM approval_table  WHERE opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "' AND row_count=(SELECT max(row_count) FROM approval_table WHERE  opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp_eoi_published . "')";

                    $result2 = $GLOBALS['db']->query($sql2);

                    if ($result2->num_rows > 0)
                    {

                        while ($row2 = $GLOBALS['db']->fetchByAssoc($result2))
                        {

                            array_push($Approved_array, $row2['Approved']);
                            array_push($Rejected_array, $row2['Rejected']);
                            array_push($pending_array, $row2['pending']);

                        }

                        $value = 1;
                        foreach ($Approved_array as $app)
                        {

                            $value = $app * $value;
                            $value;
                        }

                    }
                    //echo $value;
                    if ($value > 0)
                    {

                        $sql7 = "UPDATE opportunities_cstm SET status_c='" . $next_status . "',due_date_c='' WHERE id_c='" . $opportunity_id . "'";

                        if ($db->query($sql7) == true)
                        {

                            // akash change here
                            

                            echo json_encode(array(
                                "status" => true,
                                "next_status" => $next_status
                            ));

                        }

                    }
                    else
                    {
                        echo json_encode("approved");

                    }

                }
            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //---------------------Approve or Reject -------------------------------------------
    //---------------------Approve or Reject -------------------------------------------
    public function action_reject()
    {

        $opportunity_id = $_POST['opp_id'];
        $status = $_POST['status'];
        $apply_for = $_POST['apply_for'];
        $date_time = $_POST['date_time'];
        $rfp_eoi_published = $_POST['rfp_eoi_published'];
        $Approved = $_POST['approved_reject'];
        $Rejected = $_POST['rejected_reject'];
        $pending = $_POST['pending_reject'];
        $Comments = $_POST['comment_reject'];
        $base_url = $_POST['base_url'];

        try
        {

            global $current_user;

            $log_in_user_id = $current_user->id;

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sq = "SELECT * FROM opportunities_cstm WHERE id_c = '" . $opportunity_id . "'";
            $resul = $GLOBALS['db']->query($sq);

            while ($ro = $GLOBALS['db']->fetchByAssoc($resul))
            {

                $opp_table_status = $ro['status_c'];
                $opp_table_published = $ro['rfporeoipublished_c'];
                $approver = $ro['multiple_approver_c'];
                $delegate = $ro['delegate'];
                $new_approver = $ro['user_id2_c'];

            }

            $team_func_array = explode(',', $delegate);

            $alert_users = array();

            $sql = "SELECT opportunities.name,opportunities.assigned_user_id,opportunities_cstm.multiple_approver_c FROM opportunities LEFT JOIN opportunities_cstm ON opportunities_cstm.id_c = opportunities.id WHERE opportunities.id='$opportunity_id'";

            $result = $GLOBALS['db']->query($sql);

            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                $opp_name = $row['name'];
                //  array_push($alert_users, $row['created_by']);
                array_push($alert_users, $row['assigned_user_id']);
                $m_approver = $row['multiple_approver_c'];

            }
            $m_approver_array = array();
            $m_approver_array = explode(',', $m_approver);
            $sql2 = "SELECT * FROM tagged_user WHERE opp_id='" . $opportunity_id . "'";
            $result2 = $GLOBALS['db']->query($sql2);

            while ($row2 = $GLOBALS['db']->fetchByAssoc($result2))
            {

                $tag = $row2['user_id'];

            }
            $tag_array = array();
            $tag_array = explode(',', $tag);

            $alert_users = array_merge($alert_users, $tag_array);
            $alert_users = array_merge($alert_users, $m_approver_array);

            if (($key = array_search($log_in_user_id, $alert_users)) !== false)
            {

                unset($alert_users[$key]);
            }

            $alert_users = array_unique($alert_users);

            $sql1 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id='" . $log_in_user_id . "'  ";
            $result1 = $GLOBALS['db']->query($sql1);
            while ($row1 = $GLOBALS['db']->fetchByAssoc($result1))
            {

                $approver_name = $row1['fullname'];
            }

            if ($apply_for == 'qualifylead')
            {
                $apply = 'Qualify Lead';

            }
            else if ($apply_for == 'qualifyOpportunity')
            {
                $apply = 'Qualify Opportunity';
            }
            else if ($apply_for == 'qualifyDpr')
            {
                $apply = 'Qualify DPR';
            }
            else if ($apply_for == 'qualifyBid')
            {
                $apply = 'Qualify BID';
            }
            else if ($apply_for == 'closure')
            {
                $apply = 'Closure';
            }
            else if ($apply_for == 'Dropping')
            {
                $apply = 'Dropping Opportunity';

            }
            $email_array = array();
            $sql23 = "SELECT  * FROM users WHERE id IN ('" . implode("','", $alert_users) . "') ";
            $result23 = $GLOBALS['db']->query($sql23);
            while ($row23 = $GLOBALS['db']->fetchByAssoc($result23))
            {

                array_push($email_array, $row23['user_name']);
            }

            if (in_array($log_in_user_id, $team_func_array))
            {

                $sql4 = "SELECT * FROM approval_table WHERE delegate_id='" . $log_in_user_id . "'";

                $result4 = $GLOBALS['db']->query($sql4);

                if ($result4->num_rows > 0)
                {

                    $sql = 'UPDATE approval_table SET Approved="' . $Approved . '" ,Rejected="' . $Rejected . '",pending="' . $pending . '", delegate_comments="' . $Comments . '", delegate_date_time="' . $date_time . '" WHERE opp_id="' . $opportunity_id . '"   AND delegate_id="' . $log_in_user_id . '"  AND status="' . $status . '" AND rfp_eoi_published="' . $rfp_eoi_published . '" AND pending=1';
                    $result = $GLOBALS['db']->query($sql);
                    echo "rejected";
                    //   alerts
                    foreach ($alert_users as $user)
                    {
                        $alert = BeanFactory::newBean('Alerts');
                        $alert->name = 'Opportunity "' . $opp_name . '"';
                        $alert->description = ' is rejected for ' . $apply . ' by ' . $approver_name . '';
                        $alert->url_redirect = $base_url . '?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D' . $opportunity_id;
                        $alert->target_module = 'Opportunities';
                        $alert->assigned_user_id = $user;
                        $alert->type = 'info';
                        $alert->is_read = 0;
                        $alert->save();

                    }

                    foreach ($email_array as $email)
                    {
                        $template = 'Opportunity "' . $opp_name . '" is rejected for ' . $apply . ' by ' . $approver_name . '.<br><br>Click here to view: www.ampersandcrm.com';
                        //    require_once('include/SugarPHPMailer.php');
                        //    include_once('include/utils/db_utils.php');
                        //      $emailObj = new Email();
                        //      $defaults = $emailObj->getSystemDefaultEmail();
                        //      $mail = new SugarPHPMailer();
                        //      $mail->IsHTML(true);
                        //      $mail->setMailerForSystem();
                        //      $mail->From = $defaults['email'];
                        //                     $mail->FromName = $defaults['name'];
                        //      $mail->Subject = 'CRM ALERT - Rejected';
                        //    $mail->Body =$template;
                        //      $mail->prepForOutbound();
                        //      $mail->AddAddress($email);
                        //      @$mail->Send();
                        $created_at_time = date('Y-m-d H:i:s');
                        $sql_email = "INSERT INTO `email_queue` (`subject`, `body`, `to`, `created_at`) VALUES ('CRM ALERT - Rejected', '$template', '$email', '$created_at_time')";

                        $GLOBALS['db']->query($sql_email);

                    }
                }

            }

            else
            {
                $sql4 = "SELECT * FROM approval_table WHERE approver_rejector='" . $log_in_user_id . "'";

                $result4 = $GLOBALS['db']->query($sql4);

                if ($result4->num_rows > 0)
                {

                    $sql = 'UPDATE approval_table SET Approved="' . $Approved . '" ,Rejected="' . $Rejected . '",pending="' . $pending . '",comments="' . $Comments . '",date_time="' . $date_time . '" WHERE opp_id="' . $opportunity_id . '"  AND approver_rejector="' . $log_in_user_id . '"  AND  status="' . $status . '" AND rfp_eoi_published="' . $rfp_eoi_published . '" AND pending=1';
                    $result = $GLOBALS['db']->query($sql);
                    echo "rejected";

                    //alerts
                    foreach ($alert_users as $user)
                    {
                        $alert = BeanFactory::newBean('Alerts');
                        $alert->name = 'Opportunity "' . $opp_name . '"';
                        $alert->description = ' is rejected for ' . $apply . ' by ' . $approver_name . '';
                        $alert->url_redirect = $base_url . '?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D' . $opportunity_id;
                        $alert->target_module = 'Opportunities';
                        $alert->assigned_user_id = $user;
                        $alert->type = 'info';
                        $alert->is_read = 0;
                        $alert->save();

                    }

                    foreach ($email_array as $email)
                    {
                        $template = 'Opportunity "' . $opp_name . '" is rejected for ' . $apply . ' by ' . $approver_name . '.<br><br>Click here to view: www.ampersandcrm.com';
                        //    require_once('include/SugarPHPMailer.php');
                        //    include_once('include/utils/db_utils.php');
                        //      $emailObj = new Email();
                        //      $defaults = $emailObj->getSystemDefaultEmail();
                        //      $mail = new SugarPHPMailer();
                        //      $mail->IsHTML(true);
                        //      $mail->setMailerForSystem();
                        //      $mail->From = $defaults['email'];
                        //                     $mail->FromName = $defaults['name'];
                        //      $mail->Subject = 'CRM ALERT - Rejected';
                        //    $mail->Body =$template;
                        //      $mail->prepForOutbound();
                        //      $mail->AddAddress($email);
                        //      @$mail->Send();
                        $created_at_time = date('Y-m-d H:i:s');
                        $sql_email = "INSERT INTO `email_queue` (`subject`, `body`, `to`, `created_at`) VALUES ('CRM ALERT - Rejected', '$template', '$email', '$created_at_time')";

                        $GLOBALS['db']->query($sql_email);
                    }
                }

            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //--------------------- Reject -------------------------------------------
    //----------------------------fetch comments of tag users--------------------------
    public function action_tag_users_comments_fetch()
    {

        $opportunity_id = $_POST['opp_id'];

        try
        {

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT * FROM opportunities_cstm WHERE id_c="' . $opportunity_id . '"';
            $result = $GLOBALS['db']->query($sql);

            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                $comments = $row['comment_c'];

            }

            if ($comments != '')
            {

                echo json_encode(array(
                    "status" => true,
                    "comments" => $comments
                ));

            }
            else
            {
                echo json_encode(array(
                    "status" => false,
                    "comments" => ""
                ));
            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //----------------------------fetch comments of tag users--------------------------
    //------------------------------Save comments of tag users---------------------------
    public function action_tag_users_comments_save()
    {

        $opportunity_id = $_POST['opp_id'];
        $comments = $_POST['tagged_comments'];

        try
        {

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'UPDATE opportunities_cstm SET comment_c=concat(comment_c,",' . $comments . '") WHERE id_c="' . $opportunity_id . '"';

            $result = $GLOBALS['db']->query($sql);

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------custom popup------------------------------------------------------------------
    public function action_Popup()
    {
        $this->view = 'Popup';
    }

    //----------------------------------custom popup---------------END----------------------------------------------
    //----------------------------------------feedback saving-----------------------------------------------
    public function action_feedback()
    {
        $date = $_POST['date_time'];
        $link = $_POST['base_url'];
        $issue = $_POST['issue'];
        $module_id = $_POST['opp_id'];
        try
        {
            global $current_user;

            $log_in_user_id = $current_user->id;

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT * FROM users WHERE id="' . $log_in_user_id . '"';
            $result = $GLOBALS['db']->query($sql);
            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $email = $row['user_name'];

            }

            $sql1 = 'INSERT INTO feedback (user_id,link,date_time,first_name,last_name,issue,module_id,email) VALUES ("' . $log_in_user_id . '","' . $link . '","' . $date . '","' . $first_name . '","' . $last_name . '","' . $issue . '","' . $module_id . '","' . $email . '")';

            if ($db->query($sql1) == true)
            {

                echo "Issues Submitted Successfully";
            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "some error occured"
            ));
        }
        die();
    }

    //----------------------------------------feedback saving-------END----------------------------------------
    //----------------------------------------multiple approver-----------------------------------------------
    public function action_multiple_approver()
    {

        try
        {
            global $current_user;
            $op_id = $_POST['opps_id'];
            $log_in_user_id = $current_user->id;

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $id_array = array();
            $team_func_array = array();

            $sql = 'SELECT * FROM users_cstm WHERE teamheirarchy_c="team_lead"';
            $result = $GLOBALS['db']->query($sql);
            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                $id_array[] = $row['id_c'];
                $team_func_array[] = $row['teamfunction_c'];

            }

            $email_id = array();
            $full_name = array();
            $users_id = array();

            $sql1 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id IN ('" . implode("','", $id_array) . "')";
            $result1 = $GLOBALS['db']->query($sql1);
            while ($row1 = $GLOBALS['db']->fetchByAssoc($result1))
            {
                array_push($users_id, $row1['id']);
                array_push($email_id, $row1['user_name']);
                array_push($full_name, $row1['fullname']);
            }
            $sql2 = 'SELECT * FROM opportunities_cstm WHERE id_c="' . $op_id . '"';
            $result2 = $GLOBALS['db']->query($sql2);
            while ($row2 = $GLOBALS['db']->fetchByAssoc($result2))
            {
                $others = $row2['multiple_approver_c'];
            }
            //echo $others;
            $others_id_array = explode(",", $others);

            echo json_encode(array(
                "status" => true,
                "user_id" => $users_id,
                "email" => $email_id,
                "name" => $full_name,
                "teamfunction" => $team_func_array,
                "other_user_id" => $others_id_array
            ));

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "some error occured"
            ));
        }
        die();
    }

    //----------------------------------------multiple approver-------END----------------------------------------
    //-------------------------------Fetch Reporting manager------------------------------------------------
    public function action_fetch_reporting_manager()
    {
        $assigned_id = $_POST['assigned_id'];
        $assigned_name = $_POST['assigned_name'];
        $opportunity_id = $_POST['opps_id'];
        $status = $_POST['s'];
        $rfp_type = $_POST['r'];
        try
        {

            global $current_user;
            $log_in_user_id = $current_user->id;
            $bid_commercial_approvers_id = array();
            $bid_commercial_approvers_name = array();
            $id_mc = array();
            $approvers_name = array();
            $approvers_id = array();

            $sql_tl = "SELECT case when teamheirarchy_c='team_member_l1' then 'l1' when teamheirarchy_c ='team_member_l2' then 'l2' when teamheirarchy_c ='team_member_l3' then 'l3' when teamheirarchy_c='team_lead' then 'tl' end AS 'heirarchy' FROM users_cstm WHERE id_c='" . $assigned_id . "'";

            $result_tl = $GLOBALS['db']->query($sql_tl);

            while ($row_tl = mysqli_fetch_assoc($result_tl))
            {

                $team_h = $row_tl['heirarchy'];
            }

            if ($team_h == "tl")
            {

                $sql_tlr = 'SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="' . $assigned_id . '")';
                $result_tlr = $GLOBALS['db']->query($sql_tlr);
                while ($row_tlr = mysqli_fetch_assoc($result_tlr))
                {

                    $team_lead_name = $row_tlr['name'];
                    $team_lead_id = $row_tlr['id'];
                }

            }

            else if ($team_h == "l1")
            {

                $sql_tlr = 'SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="' . $assigned_id . '")';
                $result_tlr = $GLOBALS['db']->query($sql_tlr);
                while ($row_tlr = mysqli_fetch_assoc($result_tlr))
                {

                    $team_lead_name = $row_tlr['name'];
                    $team_lead_id = $row_tlr['id'];
                }

            }
            else if ($team_h == "l2")
            {

                $sql_tlr = 'SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="' . $assigned_id . '"))';
                $result_tlr = $GLOBALS['db']->query($sql_tlr);
                while ($row_tlr = mysqli_fetch_assoc($result_tlr))
                {

                    $team_lead_name = $row_tlr['name'];
                    $team_lead_id = $row_tlr['id'];
                }

            }
            else if ($team_h == "l3")
            {

                $sql_tlr = 'SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="' . $assigned_id . '")))';
                $result_tlr = $GLOBALS['db']->query($sql_tlr);
                while ($row_tlr = mysqli_fetch_assoc($result_tlr))
                {

                    $team_lead_name = $row_tlr['name'];
                    $team_lead_id = $row_tlr['id'];
                }

            }

            $sql_b_c = "SELECT users.id, users.employee_status, users.deleted, users_cstm.bid_commercial_head_c,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS fullname FROM users INNER JOIN users_cstm ON users_cstm.id_c = users.id WHERE users.employee_status='Active' AND users.deleted=0 AND users_cstm.bid_commercial_head_c IN ('bid_team_head','commercial_team_head')";

            $result_b_c = $GLOBALS['db']->query($sql_b_c);

            while ($row_b_c = mysqli_fetch_assoc($result_b_c))
            {

                array_push($bid_commercial_approvers_id, $row_b_c['id']);
                array_push($bid_commercial_approvers_name, $row_b_c['fullname']);
            }

            $sql_assigned = "SELECT users.id, users.employee_status, users.deleted,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS fullname FROM users INNER JOIN users_cstm ON users_cstm.id_c = users.id WHERE users.employee_status='Active' AND users.deleted=0 AND users.id IN (SELECT reports_to_id  FROM users WHERE id='" . $assigned_id . "')";
            $result_assigned = $GLOBALS['db']->query($sql_assigned);

            while ($row_assigned = mysqli_fetch_assoc($result_assigned))
            {

                $reporting_id = $row_assigned['id'];
                $reporting_name = $row_assigned['fullname'];

            }

            $sql_mc = "SELECT * FROM users_cstm WHERE mc_c='yes'";
            $result_mc = $GLOBALS['db']->query($sql_mc);
            while ($row_mc = $GLOBALS['db']->fetchByAssoc($result_mc))
            {

                array_push($id_mc, $row_mc['id_c']);

            }

            if (in_array($reporting_id, $bid_commercial_approvers_id))
            {

                if (($key = array_search($reporting_id, $bid_commercial_approvers_id)) !== false)
                {

                    unset($bid_commercial_approvers_id[$key]);
                }
            }

            if (in_array($reporting_name, $bid_commercial_approvers_name))
            {

                if (($key = array_search($reporting_name, $bid_commercial_approvers_name)) !== false)
                {

                    unset($bid_commercial_approvers_name[$key]);
                }
            }

            if (in_array($assigned_id, $bid_commercial_approvers_id))
            {

                if (($key = array_search($assigned_id, $bid_commercial_approvers_id)) !== false)
                {

                    unset($bid_commercial_approvers_id[$key]);
                }
            }

            if (in_array($assigned_name, $bid_commercial_approvers_name))
            {

                if (($key = array_search($assigned_name, $bid_commercial_approvers_name)) !== false)
                {

                    unset($bid_commercial_approvers_name[$key]);
                }
            }

            //-----------------------Flow starts here---------------------------------------------------------------
            if ($opportunity_id == '' && in_array($log_in_user_id, $id_mc))
            {

                if ($log_in_user_id == $assigned_id)
                {

                    $reporting_id = $assigned_id;
                    $reporting_name = $assigned_name;
                    array_push($approvers_name, $reporting_name);
                    array_push($approvers_id, $reporting_id);
                    $approvers_name = array_merge($approvers_name, $bid_commercial_approvers_name);
                    $approvers_id = array_merge($approvers_id, $bid_commercial_approvers_id);

                    echo json_encode(array(
                        "status" => true,
                        'mc' => 'yes',
                        'reporting_name' => $reporting_name,
                        'reporting_id' => $reporting_id,
                        'approvers_name' => $approvers_name,
                        'approvers_id' => $approvers_id
                    ));

                }

                else
                {
                    // change here
                    

                    if ($rfp_type == 'no')
                    {

                        if ($status == 'Qualified' || $status == 'QualifiedDpr' || $status == 'QualifiedBid' || $status == 'Closed' || $status == 'Drop')
                        {

                            $reporting_id = $team_lead_id;
                            $reporting_name = $team_lead_name;
                        }

                    }

                    else if ($rfp_type == 'yes')
                    {

                        if ($status == 'QualifiedLead' || $status == 'QualifiedBid' || $status == 'Closed' || $status == 'Drop')
                        {

                            $reporting_id = $team_lead_id;
                            $reporting_name = $team_lead_name;
                        }

                    }
                    else if ($rfp_type == 'not_required')
                    {

                        if ($status == 'Qualified' || $status == 'QualifiedDpr' || $status == 'QualifiedBid' || $status == 'Closed' || $status == 'Drop')
                        {

                            $reporting_id = $team_lead_id;
                            $reporting_name = $team_lead_name;
                        }
                    }

                    array_push($approvers_name, $reporting_name);
                    array_push($approvers_id, $reporting_id);
                    $approvers_name = array_merge($approvers_name, $bid_commercial_approvers_name);
                    $approvers_id = array_merge($approvers_id, $bid_commercial_approvers_id);

                    echo json_encode(array(
                        "status" => true,
                        'mc' => 'yes',
                        'reporting_name' => $reporting_name,
                        'reporting_id' => $reporting_id,
                        'approvers_name' => $approvers_name,
                        'approvers_id' => $approvers_id
                    ));
                }
            }

            else if (in_array($log_in_user_id, $id_mc))
            {

                if ($log_in_user_id == $assigned_id)
                {

                    $reporting_id = $assigned_id;
                    $reporting_name = $assigned_name;
                    array_push($approvers_name, $reporting_name);
                    array_push($approvers_id, $reporting_id);
                    $approvers_name = array_merge($approvers_name, $bid_commercial_approvers_name);
                    $approvers_id = array_merge($approvers_id, $bid_commercial_approvers_id);

                    echo json_encode(array(
                        "status" => true,
                        'mc' => 'yes',
                        'reporting_name' => $reporting_name,
                        'reporting_id' => $reporting_id,
                        'approvers_name' => $approvers_name,
                        'approvers_id' => $approvers_id
                    ));

                }
                else
                {

                    // change here
                    

                    if ($rfp_type == 'no')
                    {

                        if ($status == 'Qualified' || $status == 'QualifiedDpr' || $status == 'QualifiedBid' || $status == 'Closed' || $status == 'Drop')
                        {

                            $reporting_id = $team_lead_id;
                            $reporting_name = $team_lead_name;
                        }

                    }

                    else if ($rfp_type == 'yes')
                    {

                        if ($status == 'QualifiedLead' || $status == 'QualifiedBid' || $status == 'Closed' || $status == 'Drop')
                        {

                            $reporting_id = $team_lead_id;
                            $reporting_name = $team_lead_name;
                        }

                    }
                    else if ($rfp_type == 'not_required')
                    {

                        if ($status == 'Qualified' || $status == 'QualifiedDpr' || $status == 'QualifiedBid' || $status == 'Closed' || $status == 'Drop')
                        {

                            $reporting_id = $team_lead_id;
                            $reporting_name = $team_lead_name;
                        }
                    }

                    array_push($approvers_name, $reporting_name);
                    array_push($approvers_id, $reporting_id);
                    $approvers_name = array_merge($approvers_name, $bid_commercial_approvers_name);
                    $approvers_id = array_merge($approvers_id, $bid_commercial_approvers_id);

                    echo json_encode(array(
                        "status" => true,
                        'mc' => 'yes',
                        'reporting_name' => $reporting_name,
                        'reporting_id' => $reporting_id,
                        'approvers_name' => $approvers_name,
                        'approvers_id' => $approvers_id
                    ));
                }
            }

            else
            {

                if (in_array($assigned_id, $id_mc))
                {
                    $reporting_id = $assigned_id;
                    $reporting_name = $assigned_name;
                }

                // change here
                if ($rfp_type == 'no')
                {

                    if ($status == 'Qualified' || $status == 'QualifiedDpr' || $status == 'QualifiedBid' || $status == 'Closed' || $status == 'Drop')
                    {

                        $reporting_id = $team_lead_id;
                        $reporting_name = $team_lead_name;
                    }

                }

                else if ($rfp_type == 'yes')
                {

                    if ($status == 'QualifiedLead' || $status == 'QualifiedBid' || $status == 'Closed' || $status == 'Drop')
                    {

                        $reporting_id = $team_lead_id;
                        $reporting_name = $team_lead_name;
                    }

                }
                else if ($rfp_type == 'not_required')
                {

                    if ($status == 'Qualified' || $status == 'QualifiedDpr' || $status == 'QualifiedBid' || $status == 'Closed' || $status == 'Drop')
                    {

                        $reporting_id = $team_lead_id;
                        $reporting_name = $team_lead_name;
                    }
                }

                //  echo $rfp_type.'/'.$status;
                

                array_push($approvers_name, $reporting_name);
                array_push($approvers_id, $reporting_id);
                $approvers_name = array_merge($approvers_name, $bid_commercial_approvers_name);
                $approvers_id = array_merge($approvers_id, $bid_commercial_approvers_id);

                echo json_encode(array(
                    "status" => true,
                    'reporting_name' => $reporting_name,
                    'reporting_id' => $reporting_id,
                    'approvers_name' => $approvers_name,
                    'approvers_id' => $approvers_id
                ));
            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "some error occured"
            ));
        }
        die();
    }

    //-------------------------------Fetch Reporting manager--------------END----------------------------------
    //---------------------------------Editview untagged users ----------------------------------------------
    public function action_untagged_users_list()
    {
        try
        {
            global $current_user;
            $op_id = $_POST['opps_id'];
            $log_in_user_id = $current_user->id;

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $id_array = array();
            $team_func_array = array();

            $email_id = array();
            $full_name = array();
            $users_id = array();

            $reporting = array();
            array_push($reporting, '1');

            $opp = 'SELECT * From opportunities WHERE id="' . $op_id . '"';
            $re = $GLOBALS['db']->query($opp);
            while ($ow = $GLOBALS['db']->fetchByAssoc($re))
            {
                array_push($reporting, $ow['assigned_user_id']);

                $creator = $ow['assigned_user_id'];
                $sql_creater = 'SELECT * From users WHERE id="' . $creator . '"';

                $result_creater = $GLOBALS['db']->query($sql_creater);

                while ($row22 = $GLOBALS['db']->fetchByAssoc($result_creater))
                {
                    array_push($reporting, $row22['reports_to_id']);

                }

            }

            $sql3 = "SELECT * FROM opportunities_cstm WHERE id_c='" . $op_id . "'";
            $result3 = $GLOBALS['db']->query($sql3);

            while ($row3 = $GLOBALS['db']->fetchByAssoc($result3))
            {

                $string = $row3['multiple_approver_c'];

            }
            $array = explode(',', $string);

            $reporting = array_merge($reporting, $array);

            $sql_mc = 'SELECT * FROM users_cstm WHERE mc_c="yes"';
            $result_mc = $GLOBALS['db']->query($sql_mc);

            while ($row_mc = $GLOBALS['db']->fetchByAssoc($result_mc))
            {
                array_push($reporting, $row_mc['id_c']);

            }

            $sql1 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id NOT IN ('" . implode("','", $reporting) . "') AND deleted=0 ORDER BY first_name ASC";
            $result1 = $GLOBALS['db']->query($sql1);
            while ($row1 = $GLOBALS['db']->fetchByAssoc($result1))
            {
                array_push($users_id, $row1['id']);
                array_push($email_id, $row1['user_name']);
                array_push($full_name, $row1['fullname']);
            }
            $sql = "SELECT  * FROM untagged_user WHERE opp_id='" . $op_id . "' ";
            $result = $GLOBALS['db']->query($sql);
            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                $others = $row['user_id'];
            }

            $others_id_array = explode(",", $others);

            echo json_encode(array(
                "status" => true,
                "user_id" => $users_id,
                "email" => $email_id,
                "name" => $full_name,
                "other_user_id" => $others_id_array
            ));

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "some error occured"
            ));
        }
        die();
    }

    //---------------------------------Editview untagged users -------END--------------------------------------
    //---------------------------------Editview tagged users ----------------------------------------------
    public function action_tagged_users_list()
    {
        try
        {
            global $current_user;
            $op_id = $_POST['opps_id'];
            $log_in_user_id = $current_user->id;

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $id_array = array();
            $team_func_array = array();

            $email_id = array();
            $full_name = array();
            $users_id = array();

            $reporting = array();
            array_push($reporting, '1');

            $opp = 'SELECT * From opportunities WHERE id="' . $op_id . '"';
            $re = $GLOBALS['db']->query($opp);
            while ($ow = $GLOBALS['db']->fetchByAssoc($re))
            {
                array_push($reporting, $ow['assigned_user_id']);

                $creator = $ow['assigned_user_id'];
                $sql_creater = 'SELECT * From users WHERE id="' . $creator . '"';

                $result_creater = $GLOBALS['db']->query($sql_creater);

                while ($row22 = $GLOBALS['db']->fetchByAssoc($result_creater))
                {
                    array_push($reporting, $row22['reports_to_id']);

                }

            }

            $sql3 = "SELECT * FROM opportunities_cstm WHERE id_c='" . $op_id . "'";
            $result3 = $GLOBALS['db']->query($sql3);

            while ($row3 = $GLOBALS['db']->fetchByAssoc($result3))
            {

                $string = $row3['multiple_approver_c'];

            }
            $array = explode(',', $string);

            $reporting = array_merge($reporting, $array);

            $sql_mc = 'SELECT * FROM users_cstm WHERE mc_c="yes"';
            $result_mc = $GLOBALS['db']->query($sql_mc);

            while ($row_mc = $GLOBALS['db']->fetchByAssoc($result_mc))
            {
                array_push($reporting, $row_mc['id_c']);

            }

            $sql1 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id NOT IN ('" . implode("','", $reporting) . "') AND deleted=0 ORDER BY first_name ASC";
            $result1 = $GLOBALS['db']->query($sql1);
            while ($row1 = $GLOBALS['db']->fetchByAssoc($result1))
            {
                array_push($users_id, $row1['id']);
                array_push($email_id, $row1['user_name']);
                array_push($full_name, $row1['fullname']);
            }

            $sql = "SELECT  * FROM tagged_user WHERE opp_id='" . $op_id . "'";
            $result = $GLOBALS['db']->query($sql);
            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                $others = $row['user_id'];
            }

            $others_id_array = explode(",", $others);

            echo json_encode(array(
                "status" => true,
                "user_id" => $users_id,
                "email" => $email_id,
                "name" => $full_name,
                "other_user_id" => $others_id_array
            ));

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "some error occured"
            ));
        }
        die();
    }

    //---------------------------------Editview untagged users -------END--------------------------------------
    //--------------------------------------Save tagged and untagged user list-------------------------------------
    public function action_save_untagged_users_list()
    {
        try
        {
            global $current_user;
            $op_id = $_POST['opps_id'];
            $untagged = $_POST['untagged'];
            $log_in_user_id = $current_user->id;

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = "SELECT * FROM untagged_user WHERE opp_id='" . $op_id . "'";
            $result = $GLOBALS['db']->query($sql);

            if ($result->num_rows > 0)
            {

                $update_query = "UPDATE untagged_user SET user_id='" . $untagged . "'  WHERE opp_id='" . $op_id . "'";
                $res0 = $db->query($update_query);
            }
            else
            {
                $insert_query = 'INSERT INTO  untagged_user (opp_id,user_id) VALUES ("' . $op_id . '","' . $untagged . '")';
                $res0 = $db->query($insert_query);
            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "some error occured"
            ));
        }
        die();
    }

    public function action_save_tagged_users_list()
    {
        try
        {

            global $current_user;
            $op_id = $_POST['opps_id'];
            $tagged = $_POST['tagged'];
            $opp_name = $_POST['opp_name'];
            $base_url = $_POST['base_url'];
            $assigned_id = $_POST['assigned_id'];
            $log_in_user_id = $current_user->id;
            //$arr_2=array();
            $tagged_array = explode(',', $tagged);

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = "SELECT * FROM tagged_user WHERE opp_id='" . $op_id . "'";
            $result = $GLOBALS['db']->query($sql);

            if ($result->num_rows > 0)
            {

                $sql111 = 'SELECT * FROM tagged_user WHERE opp_id = "' . $op_id . '"';

                $result111 = $GLOBALS['db']->query($sql111);

                while ($row111 = mysqli_fetch_assoc($result111))
                {

                    $tag_id = $row111['user_id'];

                }

                $tagged_user_id_array = explode(",", $tag_id);

                $sql_opp = 'SELECT * FROM opportunities_cstm INNER JOIN opportunities ON opportunities.id =opportunities_cstm.id_c WHERE opportunities_cstm.id_c = "' . $op_id . '"';

                $result_opp = $GLOBALS['db']->query($sql_opp);

                while ($row_opp = mysqli_fetch_assoc($result_opp))
                {

                    $users_id2c = $row_opp['user_id2_c'];
                    $multi_approver = $row_opp['multiple_approver_c'];
                    $assigned_id_opp = $row_opp['assigned_user_id'];

                }

                $sql_reports = "SELECT reports_to_id FROM users WHERE id='" . $assigned_id . "'";

                $result_reports = $GLOBALS['db']->query($sql_reports);

                while ($row_reports = mysqli_fetch_assoc($result_reports))
                {

                    $reports_to = $row_reports['reports_to_id'];

                }

                $sql_tl = "SELECT case when teamheirarchy_c='team_member_l1' then 'l1' when teamheirarchy_c ='team_member_l2' then 'l2' when teamheirarchy_c ='team_member_l3' then 'l3' when teamheirarchy_c='team_lead' then 'tl' end AS 'heirarchy' FROM users_cstm WHERE id_c='" . $assigned_id . "'";

                $result_tl = $GLOBALS['db']->query($sql_tl);

                while ($row_tl = mysqli_fetch_assoc($result_tl))
                {

                    $team_h = $row_tl['heirarchy'];
                }

                if ($team_h == "tl")
                {

                    $sql_tlr = 'SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="' . $assigned_id . '")';
                    $result_tlr = $GLOBALS['db']->query($sql_tlr);
                    while ($row_tlr = mysqli_fetch_assoc($result_tlr))
                    {

                        $team_lead_name = $row_tlr['name'];
                        $team_lead_id = $row_tlr['id'];
                    }

                }

                else if ($team_h == "l1")
                {

                    $sql_tlr = 'SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="' . $assigned_id . '")';
                    $result_tlr = $GLOBALS['db']->query($sql_tlr);
                    while ($row_tlr = mysqli_fetch_assoc($result_tlr))
                    {

                        $team_lead_name = $row_tlr['name'];
                        $team_lead_id = $row_tlr['id'];
                    }

                }
                else if ($team_h == "l2")
                {

                    $sql_tlr = 'SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="' . $assigned_id . '"))';
                    $result_tlr = $GLOBALS['db']->query($sql_tlr);
                    while ($row_tlr = mysqli_fetch_assoc($result_tlr))
                    {

                        $team_lead_name = $row_tlr['name'];
                        $team_lead_id = $row_tlr['id'];
                    }

                }
                else if ($team_h == "l3")
                {

                    $sql_tlr = 'SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="' . $assigned_id . '")))';
                    $result_tlr = $GLOBALS['db']->query($sql_tlr);
                    while ($row_tlr = mysqli_fetch_assoc($result_tlr))
                    {

                        $team_lead_name = $row_tlr['name'];
                        $team_lead_id = $row_tlr['id'];
                    }

                }

                $multi_approver_array = explode(',', $multi_approver);
                $tagged_user_id_array = array_merge($tagged_user_id_array, $tagged_array);

                $tagged_user_id_array = array_unique($tagged_user_id_array);

                if (($key = array_search($assigned_id, $tagged_user_id_array)) !== false)
                {

                    unset($tagged_user_id_array[$key]);

                }
                if (($key = array_search($team_lead_id, $tagged_user_id_array)) !== false)
                {

                    unset($tagged_user_id_array[$key]);

                }
                if (($key = array_search($reports_to, $tagged_user_id_array)) !== false)
                {

                    unset($tagged_user_id_array[$key]);
                }

                $tagged_user_id_array = array_diff($tagged_user_id_array, $multi_approver_array);

                $tagged_user_id_array = array_unique($tagged_user_id_array);
                $tagged_user_id_array = array_intersect($tagged_user_id_array, $tagged_array);

                $tag_id = implode(",", $tagged_user_id_array);

                $update_sql = "UPDATE tagged_user SET user_id='" . $tag_id . "' WHERE opp_id='" . $op_id . "'";

                $GLOBALS['db']->query($update_sql);

                if ($db->query($update_sql) == true)
                {

                    while ($row = $GLOBALS['db']->fetchByAssoc($result))
                    {
                        $old = $row['user_id'];
                    }

                    $old_array = explode(',', $old);

                    $arr_1 = array_diff($tagged_array, $old_array);
                    $arr_2 = array_diff($old_array, $tagged_array);
                    // echo $old_array;
                    // echo $tagged_array;
                    

                    $email_array = array();
                    $name_array = array();
                    $email_array_old = array();
                    $name_array_old = array();
                    $sql23 = "SELECT  user_name,CONCAT(first_name,' ',last_name) as name FROM users WHERE id IN ('" . implode("','", $arr_1) . "') ";
                    $result23 = $GLOBALS['db']->query($sql23);
                    while ($row23 = $GLOBALS['db']->fetchByAssoc($result23))
                    {

                        array_push($email_array, $row23['user_name']);
                        array_push($name_array, $row23['name']);
                    }

                    $sql25 = "SELECT  user_name,CONCAT(first_name,' ',last_name) as name FROM users WHERE id IN ('" . implode("','", $arr_2) . "') ";
                    $result25 = $GLOBALS['db']->query($sql25);
                    while ($row25 = $GLOBALS['db']->fetchByAssoc($result25))
                    {

                        array_push($email_array_old, $row25['user_name']);
                        array_push($name_array_old, $row25['name']);
                    }

                    foreach ($arr_1 as $user)
                    {
                        $alert = BeanFactory::newBean('Alerts');
                        //$alert->name =$opp_name;
                        $alert->description = 'You have been tagged. Now you can edit /make changes to opportunity "' . $opp_name . '"';
                        $alert->url_redirect = $base_url . '?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D' . $op_id;
                        $alert->target_module = 'Opportunities';
                        $alert->assigned_user_id = $user;
                        $alert->type = 'info';
                        $alert->is_read = 0;
                        $alert->save();
                    }

                    // //emails
                    foreach ($email_array_old as $email)
                    {

                        $template = 'You have been untagged from opportunity "' . $opp_name . '".';
                        //    require_once('include/SugarPHPMailer.php');
                        //    include_once('include/utils/db_utils.php');
                        //      $emailObj = new Email();
                        //      $defaults = $emailObj->getSystemDefaultEmail();
                        //      $mail = new SugarPHPMailer();
                        //      $mail->IsHTML(true);
                        //      $mail->setMailerForSystem();
                        //      $mail->From = $defaults['email'];
                        //                     $mail->FromName = $defaults['name'];
                        //      $mail->Subject = 'CRM ALERT - Untagged';
                        //    $mail->Body =$template;
                        //      $mail->prepForOutbound();
                        //      $mail->AddAddress($email);
                        //      @$mail->Send();
                        $created_at_time = date('Y-m-d H:i:s');
                        $sql_email = "INSERT INTO `email_queue` (`subject`, `body`, `to`, `created_at`) VALUES ('CRM ALERT - Untagged', '$template', '$email', '$created_at_time')";

                        $GLOBALS['db']->query($sql_email);
                    }

                    foreach ($email_array as $email1)
                    {

                        $template = 'You have been tagged to opportunity "' . $opp_name . '".Now you can edit/make changes.<br><br>Click here to view: www.ampersandcrm.com';
                        //    require_once('include/SugarPHPMailer.php');
                        //    include_once('include/utils/db_utils.php');
                        //      $emailObj = new Email();
                        //      $defaults = $emailObj->getSystemDefaultEmail();
                        //      $mail = new SugarPHPMailer();
                        //      $mail->IsHTML(true);
                        //      $mail->setMailerForSystem();
                        //      $mail->From = $defaults['email'];
                        //                     $mail->FromName = $defaults['name'];
                        //      $mail->Subject = 'CRM ALERT - Tagged';
                        //    $mail->Body =$template;
                        //      $mail->prepForOutbound();
                        //      $mail->AddAddress($email1);
                        //      @$mail->Send();
                        $created_at_time = date('Y-m-d H:i:s');

                        $sql_email = "INSERT INTO `email_queue` (`subject`, `body`, `to`, `created_at`) VALUES ('CRM ALERT - Tagged', '$template', '$email1', '$created_at_time')";

                        $GLOBALS['db']->query($sql_email);

                    }

                    $name_new = implode(',', $name_array);
                    $name_old = implode(',', $name_array_old);
                    /*if($name_new!=""&&$name_old!=""){
                                        $echo_name=$name_new.' has been tagged successfully.'.$name_old.' has been untagged successfully.';
                                            }
                                            if($name_new==""&&$name_old!=""){
                                        $echo_name=$name_old.' has been untagged successfully.';
                                            }
                                            if($name_new!=""&&$name_old==""){
                                        $echo_name=$name_new.' has been tagged successfully.';
                                            }*/
                    if (!empty(trim($name_new)) && !empty(trim($name_old)))
                    {
                        $echo_name = $name_new . ' has been tagged successfully.' . $name_old . ' has been untagged successfully.';
                    }
                    if (!empty(trim($name_new)) && !empty(trim($name_old)))
                    {
                        $echo_name = $name_old . ' has been untagged successfully.';
                    }
                    if (!empty(trim($name_new)) && !empty(trim($name_old)))
                    {
                        $echo_name = $name_new . ' has been tagged successfully.';
                    }

                    echo $echo_name;
                }

            }

            else
            {
                $insert_query = 'INSERT INTO  tagged_user (opp_id,user_id) VALUES ("' . $op_id . '","' . $tagged . '")';
                //  $res0 = $db->query($insert_query);
                $email_array = array();
                $name_array = array();
                $sql23 = "SELECT  user_name,CONCAT(first_name,' ',last_name) as name FROM users WHERE id IN ('" . implode("','", $tagged_array) . "') ";
                $result23 = $GLOBALS['db']->query($sql23);
                while ($row23 = $GLOBALS['db']->fetchByAssoc($result23))
                {

                    array_push($email_array, $row23['user_name']);
                    array_push($name_array, $row23['name']);
                }
                if ($db->query($insert_query) == true)
                {
                    //alerts
                    foreach ($tagged_array as $user)
                    {

                        $alert = BeanFactory::newBean('Alerts');
                        //$alert->name =$opp_name;
                        $alert->description = 'You have been tagged. Now you can edit /make changes to opportunity "' . $opp_name . '"';
                        $alert->url_redirect = $base_url . '?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D' . $op_id;
                        $alert->target_module = 'Opportunities';
                        $alert->assigned_user_id = $user;
                        $alert->type = 'info';
                        $alert->is_read = 0;
                        $alert->save();
                    }

                    //                  // //emails
                    foreach ($email_array as $email)
                    {

                        $template = 'You have been tagged for opportunity "' . $opp_name . '".Now you can edit/make changes.<br><br>Click here to view: www.ampersandcrm.com';
                        //    require_once('include/SugarPHPMailer.php');
                        //    include_once('include/utils/db_utils.php');
                        //      $emailObj = new Email();
                        //      $defaults = $emailObj->getSystemDefaultEmail();
                        //      $mail = new SugarPHPMailer();
                        //      $mail->IsHTML(true);
                        //      $mail->setMailerForSystem();
                        //      $mail->From = $defaults['email'];
                        //                     $mail->FromName = $defaults['name'];
                        //      $mail->Subject = 'CRM ALERT - Tagged';
                        //    $mail->Body =$template;
                        //      $mail->prepForOutbound();
                        //      $mail->AddAddress($email);
                        //      @$mail->Send();
                        $created_at_time = date('Y-m-d H:i:s');

                        $sql_email = "INSERT INTO `email_queue` (`subject`, `body`, `to`, `created_at`) VALUES ('CRM ALERT - Tagged', '$template', '$email', '$created_at_time')";

                        $GLOBALS['db']->query($sql_email);

                    }

                    $name_new = implode(',', $name_array);

                    if (!empty(trim($name_new)))
                    {
                        $echo_name = $name_new . ' has been tagged successfully.';
                    }

                    if (!empty(trim($echo_name)))
                    {
                        echo $echo_name;
                    }
                }
            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "some error occured"
            ));
        }
        die();
    }
    //--------------------------------------Save tagged user list--------END-----------------------------
    

    //----------------------------------International----------------------------------------------
    

    public function action_international()
    {

        try
        {
            global $current_user;
            $op_id = $_POST['opp_id'];

            $sql = 'SELECT * FROM opportunities_cstm WHERE id_c="' . $op_id . '"';
            $result = $GLOBALS['db']->query($sql);
            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                $international = $row['international_c'];

            }

            echo $international;

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "some error occured"
            ));
        }
        die();
    }

    //---------------------------------International------------END---------------------------------
    //-----------------------------------countrylist---------------------------------------------------
    public function action_countryList()
    {
        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT * FROM `country`';

            $result = $GLOBALS['db']->query($sql);

            $country_list = array();

            while ($row = mysqli_fetch_assoc($result))
            {

                $country_list[] = $row;

            }
            echo json_encode($country_list);

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //---------------------------countrylist------------------------END-----------------------------
    

    // --------------------------------Depaartment List-------------------------------------
    

    public function action_fetch_dList()
    {
        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            //$sql='SELECT * FROM opportunities_cstm WHERE new_department_c!="" ORDER BY new_department_c ASC';
            $sql = 'SELECT * FROM accounts WHERE deleted=0 ORDER BY name ASC';
            $result = $GLOBALS['db']->query($sql);

            $dList1 = array();

            while ($row = mysqli_fetch_assoc($result))
            {

                //  array_push($dList1,$row['new_department_c']);
                array_push($dList1, $row['name']);

            }

            $dList = array_unique($dList1);

            echo json_encode(array(
                "dList" => $dList
            ));
            //echo json_encode($dList);
            

            
        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //---------------fetch non financial consideration-------------------------------------------------------------
    

    public function action_financial_consideration()
    {
        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql = 'SELECT * FROM financial_consideration';

            $result = $GLOBALS['db']->query($sql);

            $finance_list = array();

            while ($row = mysqli_fetch_assoc($result))
            {

                $finance_list[] = $row;

            }

            echo json_encode($finance_list);

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //-------------------------------------END------------------------------------------------------------------------
    

    //-----------------------department save-----------------------------------------------
    

    public function action_department_Save()
    {

        $dName = $_POST['d_name'];

        $sql = 'SELECT * FROM accounts WHERE deleted=0 ORDER BY name ASC';
        $result = $GLOBALS['db']->query($sql);

        $dList1 = array();

        while ($row = mysqli_fetch_assoc($result))
        {

            // array_push($dList1,$row['new_department_c']);
            array_push($dList1, $row['name']);

        }

        if (in_array($dName, $dList1))
        {

        }
        else if ($dName != '')
        {

            $bean = BeanFactory::newBean('Accounts'); //Create bean  using module name
            $bean->name = $dName; //Populate bean fields
            $bean->save();

        }

    }

    //---------------------department save------------END----------------------------
    

    //--------------------------------Assigned user list according to login user-------------------
    

    public function action_new_assigned_list()
    {
        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            global $current_user;

            $status = $_POST['p_status'];
            $rfp = $_POST['rfp'];
            $opportunity_id = $_POST['oppss_id'];
            $combined = array();
            $id_array1 = array();
            $id_array = array();
            $name_array = array();
            $func_array = array();
            $func1_array = array();
            $h_array = array();
            $r_name = array();
            $number = array();
            $Approved_array = array();
            $Rejected_array = array();
            $pending_array = array();
            $func2_array = array();
            $h1_array = array();
            $rr_name = array();
            $n = 1;
            $log_in_user_id = $current_user->id;

            $sql5 = 'SELECT * FROM opportunities WHERE id="' . $opportunity_id . '"';
            $result5 = $GLOBALS['db']->query($sql5);
            while ($row5 = $GLOBALS['db']->fetchByAssoc($result5))
            {
                $created_by = $row5['created_by'];
                $assigned_id = $row5['assigned_user_id'];

            }

            $sql6 = 'SELECT * FROM users WHERE id="' . $assigned_id . '"';
            $result6 = $GLOBALS['db']->query($sql6);
            while ($row6 = $GLOBALS['db']->fetchByAssoc($result6))
            {
                $reports_to = $row6['reports_to_id'];

            }
            $sql7 = "SELECT CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS name FROM users WHERE id='" . $log_in_user_id . "'";
            $result7 = $GLOBALS['db']->query($sql7);
            while ($row7 = $GLOBALS['db']->fetchByAssoc($result7))
            {
                $mc_name = $row7['name'];

            }

            $sql = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '" . $log_in_user_id . "' AND users.deleted = 0";
            $result = $GLOBALS['db']->query($sql);
            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                $check_sales = $row['teamfunction_c'];
                $check_mc = $row['mc_c'];
                $check_team_lead = $row['teamheirarchy_c'];

            }

            //*********************************** Flow Starts here**************************
            if ($check_mc == 'yes')
            {

                $sql3 = "SELECT * FROM users_cstm";
                $result3 = $GLOBALS['db']->query($sql3);
                while ($row3 = $GLOBALS['db']->fetchByAssoc($result3))
                {
                    $func_array = $row3['teamfunction_c'];

                    $array = explode(",", $func_array);

                    if ($rfp == 'no' || $rfp == 'select')
                    {

                        if ($status == 'Lead')
                        {

                            if (in_array("^sales^", $array))
                            {

                                $id_array1[] = $row3["id_c"];

                            };
                        }

                        else if ($status == 'QualifiedLead')
                        {
                            if (in_array("^sales^", $array) || in_array("^presales^", $array))
                            {
                                $id_array1[] = $row3["id_c"];

                            };
                        }
                        else if ($status == 'Qualified')
                        {

                            if (in_array("^sales^", $array) || in_array("^presales^", $array))
                            {
                                $id_array1[] = $row3["id_c"];

                            };

                        }
                        else if ($status == 'QualifiedDpr')
                        {

                            if (in_array("^sales^", $array) || in_array("^bid^", $array))
                            {
                                $id_array1[] = $row3["id_c"];

                            };

                        }
                        else if ($status == 'QualifiedBid')
                        {
                            if (in_array("^sales^", $array) || in_array("^bid^", $array))
                            {
                                $id_array1[] = $row3["id_c"];

                            };
                        }
                        else if ($status == 'Closed')
                        {
                            if (in_array("^sales^", $array))
                            {
                                $id_array1[] = $row3["id_c"];

                            };
                        }
                        else if ($status == 'Drop')
                        {
                            if (in_array("^sales^", $array))
                            {
                                $id_array1[] = $row3["id_c"];

                            };
                        }
                    }
                    else if ($rfp == 'yes' || $rfp == 'select')
                    {

                        if ($status == 'Lead')
                        {
                            if (in_array("^sales^", $array))
                            {
                                $id_array1[] = $row3["id_c"];

                            };
                        }

                        else if ($status == 'QualifiedLead')
                        {
                            if (in_array("^sales^", $array) || in_array("^presales^", $array) || in_array("^bid^", $array))
                            {
                                $id_array1[] = $row3["id_c"];

                            };
                        }

                        else if ($status == 'QualifiedBid')
                        {
                            if (in_array("^sales^", $array) || in_array("^bid^", $array))
                            {
                                $id_array1[] = $row3["id_c"];

                            };
                        }
                        else if ($status == 'Closed')
                        {
                            if (in_array("^sales^", $array))
                            {
                                $id_array1[] = $row3["id_c"];

                            };
                        }
                        else if ($status == 'Drop')
                        {
                            if (in_array("^sales^", $array))
                            {
                                $id_array1[] = $row3["id_c"];

                            };
                        }

                    }
                    else if ($rfp == 'not_required' || $rfp == 'select')
                    {

                        if ($status == 'Lead')
                        {
                            if (in_array("^sales^", $array))
                            {
                                $id_array1[] = $row3["id_c"];

                            };
                        }

                        else if ($status == 'QualifiedLead')
                        {
                            if (in_array("^sales^", $array) || in_array("^presales^", $array))
                            {
                                $id_array1[] = $row3["id_c"];

                            };
                        }
                        else if ($status == 'Qualified')
                        {
                            if (in_array("^sales^", $array) || in_array("^presales^", $array))
                            {
                                $id_array1[] = $row3["id_c"];

                            };
                        }
                        else if ($status == 'QualifiedDpr')
                        {
                            if (in_array("^sales^", $array) || in_array("^bid^", $array))
                            {
                                $id_array1[] = $row3["id_c"];

                            };
                        }

                        else if ($status == 'Closed')
                        {
                            if (in_array("^sales^", $array))
                            {
                                $id_array1[] = $row3["id_c"];

                            };
                        }
                        else if ($status == 'Drop')
                        {
                            if (in_array("^sales^", $array))
                            {
                                $id_array1[] = $row3["id_c"];

                            };
                        }

                    }

                }

                $sql1 = "SELECT users_cstm.teamfunction_c,users_cstm.teamheirarchy_c, users1.id,CONCAT(IFNULL(users1.first_name,''), ' ', IFNULL(users1.last_name,'')) AS name,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS r_name , rpt_cstm.teamfunction_c as r_r_tf, rpt_cstm.teamheirarchy_c as r_r_th FROM users INNER JOIN users as users1 ON users.id=users1.reports_to_id INNER JOIN users_cstm as rpt_cstm ON rpt_cstm.id_c= users1.reports_to_id INNER JOIN users_cstm ON users_cstm.id_c=users1.id  WHERE users1.id IN ('" . implode("','", $id_array1) . "') AND users1.deleted=0 ORDER BY `name` ASC";

                // $sql1="SELECT users_cstm.teamfunction_c,users_cstm.teamheirarchy_c, users1.id,CONCAT(IFNULL(users1.first_name,''), ' ', IFNULL(users1.last_name,'')) AS name,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS r_name FROM users INNER JOIN users as users1 ON users.id=users1.reports_to_id INNER JOIN users_cstm ON users_cstm.id_c=users1.id WHERE users1.id IN ('".implode("','",$id_array1)."') AND users1.deleted=0 ORDER BY `name` ASC";
                $result1 = $GLOBALS['db']->query($sql1);
                while ($row1 = $GLOBALS['db']->fetchByAssoc($result1))
                {
                    array_push($number, $n);
                    array_push($func1_array, $row1['teamfunction_c']);

                    array_push($name_array, $row1['name']);
                    array_push($h_array, $row1['teamheirarchy_c']);
                    array_push($r_name, $row1['r_name']);
                    array_push($func2_array, $row1['r_r_tf']);
                    array_push($h1_array, $row1['r_r_th']);
                    $n++;
                }

                $combined = array_map(function ($b, $c, $d, $e, $f, $g)
                {
                    if ($f == "")
                    {
                        $f = 'MC';
                    }
                    return $b . ' / ' . $c . ' / ' . $d . ' -> ' . $e . ' / ' . $f . ' / ' . $g;
                }
                , $name_array, $func1_array, $h_array, $r_name, $func2_array, $h1_array);

                $mc_no = $n + 1;
                $mc_no = strval($mc_no);

                $mc_details = $mc_name . ' / ';

                array_push($combined, $mc_details);

                $sql2 = "SELECT * FROM approval_table  WHERE opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp . "' AND row_count=(SELECT max(row_count) FROM approval_table WHERE   opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp . "' ) ";

                $result2 = $GLOBALS['db']->query($sql2);

                if ($result2->num_rows > 0)
                {

                    while ($row2 = $GLOBALS['db']->fetchByAssoc($result2))
                    {

                        array_push($Approved_array, $row2['Approved']);
                        array_push($Rejected_array, $row2['Rejected']);
                        array_push($pending_array, $row2['pending']);

                    }

                    $value = 1;
                    foreach ($Approved_array as $app)
                    {
                        $value = $app * $value;
                    }

                    $value1 = 0;
                    foreach ($Rejected_array as $rej)
                    {
                        $value1 = $rej + $value1;
                    }

                    $value2 = 0;
                    foreach ($pending_array as $pen)
                    {
                        $value2 = $pen + $value2;
                    }

                    if ($value2 > 0)
                    {
                        $value2 = 1;
                        $value1 = 0;
                    }
                    else
                    {
                        $value1 = 1;
                        $value2 = 0;
                    }

                    if ($value2 == 1)
                    {
                        echo json_encode("block");
                    }

                }

                else
                {
                    echo json_encode(array(
                        '1' => $name_array,
                        '2' => $h_array,
                        '3' => $r_name,
                        'a' => $combined
                    ));

                }

            }

            else if ($check_team_lead == 'team_member_l1' || $check_team_lead == 'team_member_l2' || $check_team_lead == 'team_member_l3' || $check_team_lead == 'team_lead')
            {

                $sql4 = 'SELECT * FROM users WHERE reports_to_id="' . $log_in_user_id . '" AND deleted=0';
                $result4 = $GLOBALS['db']->query($sql4);

                if ($result4->num_rows > 0)
                {

                    while ($row4 = $GLOBALS['db']->fetchByAssoc($result4))
                    {

                        $id_array1[] = $row4["id"];
                    }

                    array_push($id_array1, $log_in_user_id);

                    $sql_tl = "SELECT case when teamheirarchy_c='team_member_l1' then 'l1' when teamheirarchy_c ='team_member_l2' then 'l2' when teamheirarchy_c ='team_member_l3' then 'l3' when teamheirarchy_c='team_lead' then 'tl' end AS 'heirarchy' FROM users_cstm WHERE id_c='" . $assigned_id . "'";

                    $result_tl = $GLOBALS['db']->query($sql_tl);

                    while ($row_tl = mysqli_fetch_assoc($result_tl))
                    {

                        $team_h = $row_tl['heirarchy'];
                    }

                    if ($team_h == "tl")
                    {

                        $sql_tlr = 'SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="' . $assigned_id . '")';
                        $result_tlr = $GLOBALS['db']->query($sql_tlr);
                        while ($row_tlr = mysqli_fetch_assoc($result_tlr))
                        {

                            $team_lead_name = $row_tlr['name'];
                            $team_lead_id = $row_tlr['id'];
                        }

                    }

                    else if ($team_h == "l1")
                    {

                        $sql_tlr = 'SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="' . $assigned_id . '")';
                        $result_tlr = $GLOBALS['db']->query($sql_tlr);
                        while ($row_tlr = mysqli_fetch_assoc($result_tlr))
                        {

                            $team_lead_name = $row_tlr['name'];
                            $team_lead_id = $row_tlr['id'];
                        }

                    }
                    else if ($team_h == "l2")
                    {

                        $sql_tlr = 'SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="' . $assigned_id . '"))';
                        $result_tlr = $GLOBALS['db']->query($sql_tlr);
                        while ($row_tlr = mysqli_fetch_assoc($result_tlr))
                        {

                            $team_lead_name = $row_tlr['name'];
                            $team_lead_id = $row_tlr['id'];
                        }

                    }
                    else if ($team_h == "l3")
                    {

                        $sql_tlr = 'SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="' . $assigned_id . '")))';
                        $result_tlr = $GLOBALS['db']->query($sql_tlr);
                        while ($row_tlr = mysqli_fetch_assoc($result_tlr))
                        {

                            $team_lead_name = $row_tlr['name'];
                            $team_lead_id = $row_tlr['id'];
                        }

                    }

                    if ($log_in_user_id == $assigned_id || $log_in_user_id == $reports_to || $opportunity_id == '' || $log_in_user_id == $team_lead_id)
                    {

                        $sql1 = "SELECT users_cstm.teamfunction_c,users_cstm.teamheirarchy_c, users1.id,CONCAT(IFNULL(users1.first_name,''), ' ', IFNULL(users1.last_name,'')) AS name,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS r_name FROM users INNER JOIN users as users1 ON users.id=users1.reports_to_id INNER JOIN users_cstm ON users_cstm.id_c=users1.id WHERE users1.id IN ('" . implode("','", $id_array1) . "') AND users1.deleted=0 ORDER BY `name` ASC";
                        $result1 = $GLOBALS['db']->query($sql1);
                        while ($row1 = $GLOBALS['db']->fetchByAssoc($result1))
                        {
                            array_push($number, $n);
                            array_push($func1_array, $row1['teamfunction_c']);

                            array_push($name_array, $row1['name']);
                            array_push($h_array, $row1['teamheirarchy_c']);
                            array_push($r_name, $row1['r_name']);
                            $n++;
                        }

                        $combined = array_map(function ($b, $c, $d, $e)
                        {
                            return $b . ' / ' . $c . ' / ' . $d . ' -> ' . $e;
                        }
                        , $name_array, $func1_array, $h_array, $r_name);

                        $sql2 = "SELECT * FROM approval_table  WHERE opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp . "' AND row_count=(SELECT max(row_count) FROM approval_table WHERE   opp_id='" . $opportunity_id . "' AND status='" . $status . "' AND rfp_eoi_published='" . $rfp . "' ) ";

                        $result2 = $GLOBALS['db']->query($sql2);

                        if ($result2->num_rows > 0)
                        {

                            while ($row2 = $GLOBALS['db']->fetchByAssoc($result2))
                            {

                                array_push($Approved_array, $row2['Approved']);
                                array_push($Rejected_array, $row2['Rejected']);
                                array_push($pending_array, $row2['pending']);

                            }

                            $value = 1;
                            foreach ($Approved_array as $app)
                            {
                                $value = $app * $value;
                            }

                            $value1 = 0;
                            foreach ($Rejected_array as $rej)
                            {
                                $value1 = $rej + $value1;
                            }

                            $value2 = 0;
                            foreach ($pending_array as $pen)
                            {
                                $value2 = $pen + $value2;
                            }

                            if ($value2 > 0)
                            {
                                $value2 = 1;
                                $value1 = 0;
                            }
                            else
                            {
                                $value1 = 1;
                                $value2 = 0;
                            }

                            if ($value2 == 1)
                            {
                                echo json_encode("block");
                            }
                            else
                            {
                                echo json_encode(array(
                                    '1' => $name_array,
                                    '2' => $h_array,
                                    '3' => $r_name,
                                    'a' => $combined
                                ));
                            }

                        }

                        else
                        {

                            echo json_encode(array(
                                '1' => $name_array,
                                '2' => $h_array,
                                '3' => $r_name,
                                'a' => $combined
                            ));

                        }

                    }

                    else
                    {
                        echo json_encode("block");
                    }
                }

                else
                {

                    echo json_encode("block");
                }

            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //--------------------------------Assigned user list according to login user-------------------
    //-------------------------------------fetch assigned id---------------------------------------
    public function action_fetch_assigned_id()
    {
        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            global $current_user;
            $log_in_user_id = $current_user->id;
            $assigned_name = $_POST['f'];
            $f_name = $_POST['f_name'];
            $l_name = $_POST['l_name'];

            $sql = "SELECT id  FROM users WHERE CONCAT(first_name, ' ', last_name) ='" . $assigned_name . "' ";

            $result = $GLOBALS['db']->query($sql);

            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {

                $a_id = $row['id'];

            }

            echo $a_id;

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //---------------------------------------fetch assigned id------END---------------------------------
    //-------------------------------------mc_check---------------------------------------
    public function action_fetch_mc_check()
    {
        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            global $current_user;
            $log_in_user_id = $current_user->id;
            $assigned_name = $_POST['f'];
            $f_name = $_POST['f_name'];
            $l_name = $_POST['l_name'];

            $sql = "SELECT *  FROM users_cstm WHERE id_c='" . $log_in_user_id . "' ";

            $result = $GLOBALS['db']->query($sql);

            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {

                $check = $row['mc_c'];

            }

            echo json_encode(array(
                "status" => true,
                "mc" => $check
            ));

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //---------------------------------------mc_check------END---------------------------------
    //---------------tageed user edit_access -------------------------------------------------------------
    

    public function action_editView_access()
    {
        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            global $current_user;
            $log_in_user_id = $current_user->id;
            $opp_id = $_POST['opps_id'];
            $assigned_id = $_POST['assigned_id_edit'];
            $bid_commercial_approvers_id = array();

            $sql = 'SELECT * FROM tagged_user WHERE opp_id = "' . $opp_id . '"';

            $result = $GLOBALS['db']->query($sql);

            while ($row = mysqli_fetch_assoc($result))
            {

                $tag_id = $row['user_id'];

            }

            $tagged_user_id_array = explode(",", $tag_id);

            $sql_mc = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '" . $log_in_user_id . "' AND users.deleted = 0";
            $result_mc = $GLOBALS['db']->query($sql_mc);
            while ($row_mc = $GLOBALS['db']->fetchByAssoc($result_mc))
            {
                $check_sales = $row_mc['teamfunction_c'];
                $check_mc = $row_mc['mc_c'];
                $check_team_lead = $row_mc['teamheirarchy_c'];

            }

            $sql_logged_in = "SELECT case when teamheirarchy_c='team_member_l1' then 'l1' when teamheirarchy_c ='team_member_l2' then 'l2' when teamheirarchy_c ='team_member_l3' then 'l3' when teamheirarchy_c='team_lead' then 'tl' end AS 'heirarchy' FROM users_cstm WHERE id_c='" . $log_in_user_id . "'";

            $result_logged_in = $GLOBALS['db']->query($sql_logged_in);

            while ($row_logged_in = mysqli_fetch_assoc($result_logged_in))
            {

                $team_logged_in = $row_logged_in['heirarchy'];
            }

            $sql_tl = "SELECT case when teamheirarchy_c='team_member_l1' then 'l1' when teamheirarchy_c ='team_member_l2' then 'l2' when teamheirarchy_c ='team_member_l3' then 'l3' when teamheirarchy_c='team_lead' then 'tl' end AS 'heirarchy' FROM users_cstm WHERE id_c='" . $assigned_id . "'";

            $result_tl = $GLOBALS['db']->query($sql_tl);

            while ($row_tl = mysqli_fetch_assoc($result_tl))
            {

                $team_h = $row_tl['heirarchy'];
            }

            if ($team_h == "tl")
            {

                $sql_tlr = 'SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="' . $assigned_id . '")';
                $result_tlr = $GLOBALS['db']->query($sql_tlr);
                while ($row_tlr = mysqli_fetch_assoc($result_tlr))
                {

                    $team_lead_name = $row_tlr['name'];
                    $team_lead_id = $row_tlr['id'];
                }

            }

            else if ($team_h == "l1")
            {

                $sql_tlr = 'SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="' . $assigned_id . '")';
                $result_tlr = $GLOBALS['db']->query($sql_tlr);
                while ($row_tlr = mysqli_fetch_assoc($result_tlr))
                {

                    $team_lead_name = $row_tlr['name'];
                    $team_lead_id = $row_tlr['id'];
                }

            }
            else if ($team_h == "l2")
            {

                $sql_tlr = 'SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="' . $assigned_id . '"))';
                $result_tlr = $GLOBALS['db']->query($sql_tlr);
                while ($row_tlr = mysqli_fetch_assoc($result_tlr))
                {

                    $team_lead_name = $row_tlr['name'];
                    $team_lead_id = $row_tlr['id'];
                }

            }
            else if ($team_h == "l3")
            {

                $sql_tlr = 'SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="' . $assigned_id . '")))';
                $result_tlr = $GLOBALS['db']->query($sql_tlr);
                while ($row_tlr = mysqli_fetch_assoc($result_tlr))
                {

                    $team_lead_name = $row_tlr['name'];
                    $team_lead_id = $row_tlr['id'];
                }

            }

            $sql_b_c = "SELECT users.id, users.employee_status, users.deleted, users_cstm.bid_commercial_head_c,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS fullname FROM users INNER JOIN users_cstm ON users_cstm.id_c = users.id WHERE users.employee_status='Active' AND users.deleted=0 AND users_cstm.bid_commercial_head_c IN ('bid_team_head','commercial_team_head')";

            $result_b_c = $GLOBALS['db']->query($sql_b_c);

            while ($row_b_c = mysqli_fetch_assoc($result_b_c))
            {

                array_push($bid_commercial_approvers_id, $row_b_c['id']);

            }

            $sql_assigned = "SELECT users.id, users.employee_status, users.deleted,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS fullname FROM users INNER JOIN users_cstm ON users_cstm.id_c = users.id WHERE users.employee_status='Active' AND users.deleted=0 AND users.id IN (SELECT reports_to_id  FROM users WHERE id='" . $assigned_id . "')";
            $result_assigned = $GLOBALS['db']->query($sql_assigned);

            while ($row_assigned = mysqli_fetch_assoc($result_assigned))
            {

                $reporting_id = $row_assigned['id'];
                $reporting_name = $row_assigned['fullname'];

            }

            //----------flow starts here-------------------------
            if ($check_mc == 'yes')
            {

            }
            else if (in_array($log_in_user_id, $tagged_user_id_array))
            {
                if ($team_logged_in == 'tl')
                {
                    echo "block_tag_user";
                }
                else
                {
                    echo "block_tag_user_all";
                }
            }
            else if ($log_in_user_id == $assigned_id)
            {
                if ($team_logged_in !== 'tl')
                {
                    echo "block_assigned_user";
                }
            }
            else if ($log_in_user_id == $reporting_id)
            {
                if ($team_logged_in !== 'tl')
                {
                    echo "block_reports_to_user";
                }
            }
            else if (in_array($log_in_user_id, $bid_commercial_approvers_id))
            {
                echo "block_bid_commercial_user";
            }

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    //--------------------------tageed user edit_access -----------END------------------------------------------------------------------------
    //---------------------------------------------------l1 and l2-----------------------------------------------------------------------------
    public function action_l1_l2_audit_trail()
    {

        global $current_user;
        $log_in_user_id = $current_user->id;

        $id = $_POST['id'];
        $start_year = $_POST['start_year'];
        $start_quarter = $_POST['start_quarter'];
        $end_year = $_POST['end_year'];
        $end_quarter = $_POST['end_quarter'];
        $num_of_bidders = $_POST['no_of_bidders'];
        $total = $_POST['total_input_value'];
        $l2_html = base64_encode($_POST['l2_html']);
        $l2_input = base64_encode(serialize($_POST['l2_input']));

        $close = $_POST['close'];

        try
        {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            if ($num_of_bidders == "" || $num_of_bidders == 0)
            {
                $num_of_bidders = 1;
            }

            $sql = 'SELECT * FROM year_quarters WHERE opp_id="' . $id . '"';
            $result = $GLOBALS['db']->query($sql);
            // print_r($result->num_rows);
            if ($result->num_rows > 0)
            {

                while ($row = $GLOBALS['db']->fetchByAssoc($result))
                {

                    $start_year_old = $row['start_year'];
                    $start_quarter_old = $row['start_quarter'];
                    $end_year_old = $row['end_year'];
                    $end_quarter_old = $row['end_quarter'];
                    $num_of_bidders_old = $row['num_of_bidders'];
                    $total_old = $row['total_input_value'];

                }

                if ($start_year == $start_year_old && $start_quarter == $start_quarter_old && $end_year == $end_year_old && $end_quarter == $end_quarter_old && $num_of_bidders == $num_of_bidders_old && $total == $total_old)
                {

                    $message = "if l1";
                }
                else
                {

                    $message = "else l1";

                    $insert_audit_query = "INSERT INTO `l1_audit`(`opp_id`, `created_by`) VALUES ('" . $id . "','" . $log_in_user_id . "')";
                    $res1 = $db->query($insert_audit_query);

                }

            }

            else
            {

                $message = "else out l1";

                $insert_audit_query = "INSERT INTO `l1_audit`(`opp_id`, `created_by`) VALUES ('" . $id . "','" . $log_in_user_id . "')";
                $res1 = $db->query($insert_audit_query);

            }
            //-------------------------------------for L2---------------------------------------------------------------
            if ($close == 'l2')
            {
                $sql_l2 = 'SELECT * FROM l2 WHERE opp_id="' . $id . '"';
                $result_l2 = $GLOBALS['db']->query($sql_l2);
                // print_r($result->num_rows);
                if ($result_l2->num_rows > 0)
                {

                    while ($row_l2 = $GLOBALS['db']->fetchByAssoc($result_l2))
                    {
                        //        $l2_input_old =unserialize(base64_decode( $row_l2['l2_input']));
                        //    $l2_html_old = base64_decode($row_l2['l2_html']);
                        $l2_input_old = $row_l2['l2_input'];
                        $l2_html_old = $row_l2['l2_html'];

                    }

                    if ($l2_html == $l2_html_old && $l2_input == $l2_input_old)
                    {

                        $message = "if l2";

                    }
                    else
                    {

                        $message = "else l2";

                        $insert_audit_query_l2 = "INSERT INTO `l2_audit` (`opp_id`, `created_by`) VALUES ('" . $id . "','" . $log_in_user_id . "')";
                        $res1_l2 = $db->query($insert_audit_query_l2);

                    }

                }

                else
                {

                    $message = "else out l2";

                    $insert_audit_query_l2 = "INSERT INTO `l2_audit`(`opp_id`, `created_by`) VALUES ('" . $id . "','" . $log_in_user_id . "')";
                    $res1_l2 = $db->query($insert_audit_query_l2);

                }

            }
            echo json_encode($message);

        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        die();
    }

    // Check if current user is accessible to comments or not
    public function action_comments_access()
    {
        global $current_user;
        $opp_id = $_REQUEST['opp_id'];

        // check if current user is mc or not
        $sql_mc = "SELECT
                    COUNT(*) as mc
                FROM
                    `users_cstm`
                LEFT JOIN users ON
                    users_cstm.id_c = users.id
                WHERE
                    `mc_c` = 'yes'
                    AND users.deleted = 0
                    AND id_c = '$current_user->id'";

        $result_mc = $GLOBALS['db']->query($sql_mc);
        $is_mc = 0;

        while ($row_mc = $GLOBALS['db']->fetchByAssoc($result_mc))
        {
            $is_mc = $row_mc['mc'];
        }

        // Check if current user is bid or commericial head
        /*$sql = "SELECT
              users.id,
              users.employee_status,
              users.deleted,
              users_cstm.bid_commercial_head_c,
              CONCAT(IFNULL(users.first_name, ''), ' ', IFNULL(users.last_name, '')) AS fullname
            FROM
              users
            INNER JOIN users_cstm ON
              users_cstm.id_c = users.id
            WHERE
                users.id = '$current_user->id'
              AND users.employee_status = 'Active'
              AND users.deleted = 0
              AND users_cstm.bid_commercial_head_c IN ('bid_team_head', 'commercial_team_head')";
              
        $result = $GLOBALS['db']->query($sql);
        $bid = [];
        while($row = $GLOBALS['db']->fetchByAssoc($result) ){
        $bid[] = $row;
        }*/

        // Check if current user is in lineage or not
        $sql = "SELECT
              *
            FROM
              opportunities
            WHERE
              id = '$opp_id'";

        $result = $GLOBALS['db']->query($sql);

        while ($row = $GLOBALS['db']->fetchByAssoc($result))
        {
            $assigned_id = $row['assigned_user_id'];
        }

        $sql = "SELECT
              *
            FROM
              users_cstm
            WHERE
              id_c = '$assigned_id'
              AND FIND_IN_SET('$current_user->id', user_lineage)";

        $result = $GLOBALS['db']->query($sql);

        $opportunity = [];

        while ($row = $GLOBALS['db']->fetchByAssoc($result))
        {
            $opportunity[] = $row;
        }

        // Check if current user is in approvers or not
        $sql = "SELECT
              *
            FROM
              opportunities_cstm
            WHERE
              id_c = '$opp_id'
              AND FIND_IN_SET('$current_user->id', multiple_approver_c) ;";

        $result = $GLOBALS['db']->query($sql);
        $approvers = [];
        while ($row = $GLOBALS['db']->fetchByAssoc($result))
        {
            $approvers[] = $row;
        }

        // If current user is mc or lineage or approver
        if ($is_mc || count($opportunity) || count($approvers))
        {
            exit(json_encode(['accessible' => true]));
        }
        else
        {
            exit(json_encode(['accessible' => false]));
        }
    }

    // Insert Team Lead / MC comments
    function action_save_comment()
    {
        global $current_user;
        $log_in_user_id = $current_user->id;

        $id = $_REQUEST['opp_id'];
        $created_by = $current_user->id;
        $opp_description = $_REQUEST['write_note_c'];

        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];

        $sql = 'SELECT * FROM description_opportunity WHERE opp_id="' . $id . '" AND id=(SELECT MAX(id) FROM description_opportunity WHERE opp_id="' . $id . '")';
        $result = $GLOBALS['db']->query($sql);

        while ($row = $GLOBALS['db']->fetchByAssoc($result))
        {
            $latest_description = $row['description'];
        }

        if ($opp_description != $latest_description)
        {
            $sql = 'INSERT INTO `description_opportunity`(`opp_id`, `description`, `user_id`) VALUES ("' . $id . '","' . $opp_description . '","' . $created_by . '")';

            $GLOBALS['db']->query($sql);
        }

        exit(json_encode(['type' => 'success', 'message' => 'Note has been saved successfully.']));

    }

    // Retrive Team Lead / MC comments
    public function action_get_comments()
    {

        try
        {
            $opp_id = $_POST['opp_id'];

            $name = array();
            $date = array();
            $description = array();

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            $sql = 'SELECT CONCAT(users.first_name," ",users.last_name) as name,DATE_FORMAT(description_opportunity.date_time, "%d/%m/%Y") as "date_time",description_opportunity.description   FROM description_opportunity INNER JOIN users on users.id=description_opportunity.user_id WHERE description_opportunity.opp_id="' . $opp_id . '" ORDER BY `date_time` DESC';

            $result = $GLOBALS['db']->query($sql);

            while ($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                array_push($name, $row['name']);
                array_push($date, $row['date_time']);
                array_push($description, $row['description']);
            }

            $combined = array_map(function ($b, $c, $d)
            {
                return '<b>[' . $b . ' : ' . $c . ' ]</b> :- ' . $d;
            }
            , $name, $date, $description);

            echo json_encode(array(
                "status" => true,
                "opp_status" => $combined
            ));
        }
        catch(Exception $e)
        {
            echo json_encode(array(
                "status" => false,
                "message" => "Some error occured"
            ));
        }
        exit();
    }

    //-------------------------------------------------------l1 and l2------------------------------------------------------------------------
    

    //---------------------------udate existing users lineage function------------------------------------------
    // public function action_users_lineage_update(){
    //      try{
    //          $db = \DBManagerFactory::getInstance();
    //          $GLOBALS['db'];
    //             global $current_user;
    //              $log_in_user_id = $current_user->id;
    //              $opp_id=array();
    //              $hierarchy=array();
    //              $reports_to=array();
    //              $name=array();
    //              $l2=array();
    //              $l1=array();
    //              $tl=array();
    //       $sql="SELECT CONCAT(t2.first_name,' ',t2.last_name) as name,t1.id_c,CASE WHEN t1.teamheirarchy_c='team_lead' THEN 'tl' WHEN t1.teamheirarchy_c='team_member_l1' THEN 'l1' WHEN t1.teamheirarchy_c='team_member_l2' THEN 'l2' WHEN t1.teamheirarchy_c='team_member_l3' THEN 'l3' END AS 'h' FROM users_cstm as t1 LEFT JOIN users as t2 ON t1.id_c = t2.id WHERE t2.deleted=0 AND t1.mc_c!='yes' AND t2.is_admin=0";
    //     $result = $GLOBALS['db']->query($sql);
    //   while ($row = mysqli_fetch_assoc($result)){
    //             $name[]=$row['name'];
    //              $users_id[]=$row['id_c'];
    //              $hierarchy[]=$row['h'];
    //         }
    

    //          for ($i = 0; $i < count($name); $i++) {
    

    //              if($hierarchy[$i]=='tl'){
    //       $sql_r="SELECT reports_to_id FROM users WHERE id='".$users_id[$i]."'";
    //       $result_r = $GLOBALS['db']->query($sql_r);
    //   while ($row_r = mysqli_fetch_assoc($result_r)){
    //              array_push($reports_to,$row_r['reports_to_id']);
    //         }
    //              }
    //               else if($hierarchy[$i]=='l1'){
    //                   $sql_r="SELECT reports_to_id FROM users WHERE id='".$users_id[$i]."'";
    //                   $result_r = $GLOBALS['db']->query($sql_r);
    //                   while ($row_r = mysqli_fetch_assoc($result_r)){
    //                          array_push($reports_to,$row_r['reports_to_id']);
    

    //                      }
    //               }
    //               else if($hierarchy[$i]=='l2'){
    //                   $sql_r="SELECT reports_to_id FROM users WHERE id='".$users_id[$i]."'";
    //       $result_r = $GLOBALS['db']->query($sql_r);
    //   while ($row_r = mysqli_fetch_assoc($result_r)){
    //             $r=$row_r['reports_to_id'];
    //              array_push($reports_to,$row_r['reports_to_id']);
    //               $sql_r1="SELECT reports_to_id FROM users WHERE id='".$r."'";
    //       $result_r1 = $GLOBALS['db']->query($sql_r1);
    //   while ($row_r1 = mysqli_fetch_assoc($result_r1)){
    //             $r1=$row_r1['reports_to_id'];
    //              array_push($reports_to,$row_r1['reports_to_id']);
    

    //         }
    //         }
    //               }
    //               else if($hierarchy[$i]=='l3'){
    

    //                          $sql_r="SELECT reports_to_id FROM users WHERE id='".$users_id[$i]."'";
    //       $result_r = $GLOBALS['db']->query($sql_r);
    //   while ($row_r = mysqli_fetch_assoc($result_r)){
    //             $r=$row_r['reports_to_id'];
    //              array_push($reports_to,$row_r['reports_to_id']);
    //               $sql_r1="SELECT reports_to_id FROM users WHERE id='".$r."'";
    //       $result_r1 = $GLOBALS['db']->query($sql_r1);
    //   while ($row_r1 = mysqli_fetch_assoc($result_r1)){
    //             $r1=$row_r1['reports_to_id'];
    //              array_push($reports_to,$row_r1['reports_to_id']);
    //               $sql_r2="SELECT reports_to_id FROM users WHERE id='".$r1."'";
    //       $result_r2 = $GLOBALS['db']->query($sql_r2);
    //   while ($row_r2 = mysqli_fetch_assoc($result_r2)){
    //             $r2=$row_r2['reports_to_id'];
    //              array_push($reports_to,$row_r2['reports_to_id']);
    

    //         }
    //         }
    //         }
    

    //               }
    //               $reports=implode(',',$reports_to);
    //               $update_sql='UPDATE users_cstm SET user_lineage="'.$reports.'" WHERE id_c="'.$users_id[$i].'"';
    //               $GLOBALS['db']->query($update_sql);
    //              print_r($name[$i].'  --reports to-- '.json_encode($reports_to).'<br>');
    //              $reports_to=[];
    //              $r="";
    //              $r1="";
    //              $r2="";
    // }
    

    //      }catch(Exception $e){
    //        echo json_encode(array("status"=>false, "message" => "Some error occured"));
    //      }
    //    die();
    // }
    

    //------------------------------------------END---------------------------
    //===========================Write code above this line=========================================
    
}
?>
