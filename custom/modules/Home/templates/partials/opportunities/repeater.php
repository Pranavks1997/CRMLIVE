<?php 
            global $current_user;
            $log_in_user_id = $current_user->id;
            // $test = isset($_GET['isCritical']) ? $_GET['isCritical'] : false;
            foreach($response as $row):
                $created_by_id          = $row['assigned_user_id'];
                $full_name              = getUsername($created_by_id);
                $closed_by              = '';
                $reports_to_full_name   = '';
                if (!empty(date_format(date_create($row['date_modified']),'d/m/Y'))) {
                    $modified_user_id  = $row['modified_user_id'];
                    $closed_by         = getUsername($modified_user_id);
                }
                $user_name_fetch = "SELECT reports_to_id FROM users WHERE id='$created_by_id'";
                $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
                $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);
                if ($user_name_fetch_row['reports_to_id']) {
                    $reports_to = getUsername($user_name_fetch_row['reports_to_id']);
                    $reports_to_full_name = ' <i class="fa fa-arrow-right"></i> ' . $reports_to;
                }
                $oppID = $row['id'];
                $tagged_user_query = "SELECT user_id, count(*) FROM `tagged_user` WHERE `opp_id`='$oppID' GROUP BY user_id";
                $tagged_user_query_fetch = $GLOBALS['db']->query($tagged_user_query);
                $tagged_user_query_fetch_row = $GLOBALS['db']->fetchByAssoc($tagged_user_query_fetch);
                $tagged_users = ($tagged_user_query_fetch_row['user_id']) ? $tagged_user_query_fetch_row['user_id'] : '';
        ?>
        <tr>
            <td class="table-data"><a href="index.php?action=DetailView&module=Opportunities&record=<?php echo $row['id']?>"><?php echo $row['name'];
            if ((strpos($tagged_users, $log_in_user_id) !== false) && $log_in_user_id != 1) { ?>
            <i class="fa fa-tag" style="font-size: 12px; color:green"></i>
            <?php } ?></a></td>
            <td class="table-data"><?php echo $full_name . $reports_to_full_name?></td>

            <?php if(!@$_GET['customColumns']): ?>

            <?php if($columnAmount){ ?>
            <td class="table-data"><?php echo beautify_amount($row['budget_allocated_oppertunity_c']); ?></td>
            <?php } ?>
            <?php if($columnREPEOI){ ?>
            <td class="table-data"><?php echo beautify_label((beautify_label($row['rfporeoipublished_c']))); ?></td>
            <?php } if($columnClosedDate){ ?>
            <td class="table-data"><?php echo date_format(date_create($row['date_modified']),'d/m/Y'); ?></td>
            <?php } if($columnClosedBy){ ?>
            <td class="table-data" ><?php echo $closed_by; ?></td>
            <?php } if($columnDateCreated){ ?>
            <td class="table-data"><?php echo date_format(date_create($row['date_entered']),'d/m/Y'); ?></td>
            <?php } if($columnDateClosed){ ?>
                <?php 
                    if($row['date_closed']){
                        $closedDate = date_format(date_create($row['date_closed']),'d/m/Y');
                    }else{
                        $closedDate = '';
                    }
                ?>
                <td class="table-data"><?php $closedDate; ?></td>
            <?php } if($columnTaggedMembers){ ?>
            <td class="table-data"><?php echo beautify_label((beautify_label( $this->getTaggedMembers($row['id']) ))); ?></td>
            <?php } if($columnViewedBy){ ?>
            <td class="table-data"><?php echo beautify_label((beautify_label( $this->getModifiedUser($row['modified_user_id']) ))); ?></td>
            <?php } if($columnPreviousResponsibility){ ?>
            <td class="table-data"><?php echo beautify_label((beautify_label( $this->getModifiedUser($row['created_by']) ))); ?></td>
            <?php } if($columnAttachment){ ?>
            <td class="table-data"><?php echo beautify_label((beautify_label( $row['file_url'] ? $row['file_url'] : '' ))); ?></td>
            <?php } ?>

            <?php endif; ?>

            <?php echo $this->getColumnFiltersBody($_GET, $row); ?>

            <td class="table-data">
                <div style="display: flex; width: 90%; align-items: center; padding: 10px; justify-content: space-between; margin-left: 20px;">
                
                    <button class="tag1" id="reassignmentBtn" style="margin-right: 7px;width: 15px;" onclick="fetchReassignmentDialog('<?php echo $row['id']; ?>')">
                        <?php if ($this->is_reassignment_applicable($row['id'])): ?>
                            <i id="reassignment-icon" title="Re-assign User" class="fa fa-user" aria-hidden="true" style="color:black; font-size: 1.8rem;"> </i>
                        <?php endif; ?>
                    </button>
                    <button class="tag1" id="deselectBtn" style="margin-right: 7px;width: 15px;" onclick="getSequenceFlow('<?php echo $row['id']; ?>')">
                        <?php if($this->checkRecentActivity($row['id'])): ?>
                            <img id="search-icon" title="Sequence Flow" src="modules/Home/assets/Frame-12.svg" alt="svg" style="color: #333333;"/>
                        <?php endif; ?>
                    </button>
                    <button class="tag1" id="deselectBtn" style="margin-right: 7px;width: 15px;" onclick="fetchDeselectDialog('<?php echo $row['id']; ?>')">
                        <?php if ($this->is_tagging_applicable($row['id'])) { ?>
                            <i id="search-icon" title="Tag" class="fa fa-tag" aria-hidden="true"> </i>
                        <?php } ?>
                    </button>
                    <a style="width: 15px;" href="index.php?action=DetailView&module=Opportunities&record=<?php echo $row['id']; ?>" class="eye" id="search-btn">
                        <i id="search-icon" class="fa fa-eye" aria-hidden="true"> </i>
                    </a>
                    <?php if (($this->is_critical_applicable($log_in_user_id, $row['id'], 'no')) && ($check_mc=='yes')): ?>    
                        <button class="tag1 deselectBtn" id="criticalBtn<?php echo $row['id'];?>" style="margin-right: 1px;width: 15px;" onclick="criticalStatus('<?php echo $row['id']; ?>')">
                            <i id="<?php echo $row['id'];?>" title="Critical" class="fa fa-exclamation-triangle search-icon" aria-hidden="true"> </i>
                        </button>
                    <?php endif ?>
                    <?php if (($this->is_critical_applicable($log_in_user_id, $row['id'], 'yes'))&& ($check_mc=='yes')) : ?>
                        <button class="tag1 deselectBtn"  id="criticalBtn<?php echo $row['id'];?>"  style="margin-right: 1px;width: 15px;" onclick="criticalStatusChanged('<?php echo $row['id']; ?>')">
                            <i id="<?php echo $row['id'];?>" title="Critical" style="color: red; cursor: pointer;" class="fa fa-exclamation-triangle search-icon" aria-hidden="true"> </i>
                        </button>
                    <?php endif ?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>

    </tbody>
</table>