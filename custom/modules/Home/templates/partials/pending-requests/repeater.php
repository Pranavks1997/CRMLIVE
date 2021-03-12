        <?php 
            global $current_user;
            $log_in_user_id = $current_user->id;
            foreach($response as $row):
                $created_by_id  = $row['created_by'];
                $full_name      = getUsername($created_by_id);

                $id         = $row['id'];
                $closed_by  = '';
                
                if (!empty($row['date_modified'])) {
                    $modified_user_id  = $row['modified_user_id'];
                    $closed_by         = getUsername($modified_user_id);
                }

                $name           = $row['name'];
                $approvalStatus = $this->pendingApprovalStatus($row['id'], $status);
                $amount         = beautify_amount($row['budget_allocated_oppertunity_c']);
                $rfpEOI         = beautify_label((beautify_label($row['rfporeoipublished_c'])));
                $modifiedDate   = date_format(date_create($row['date_modified']),'d/m/Y');
                $dateCreated    = date_format(date_create($row['date_entered']),'d/m/Y');
                
                if($row['date_closed']){
                    $closedDate = date_format(date_create($row['date_closed']),'d/m/Y');
                }else{
                    $closedDate = '';
                }

                $taggedMembers          = beautify_label((beautify_label( $this->getTaggedMembers($row['id']) )));
                $modifiedUser           = beautify_label((beautify_label( $this->getModifiedUser($row['modified_user_id']) )));
                $previousresponsibility = beautify_label((beautify_label( $this->getModifiedUser($row['created_by']) )));
                $attachment             = beautify_label((beautify_label( $row['file_url'] ? $row['file_url'] : '' )));
                
                $status_c               = $row['status_c'];
                $approvalID             = addslashes($row['approval_id']);
                $oppID                  = $row['id'];
                $delegated_u_id         = $row['delegate_id'];
        ?>
        <tr>
            <td class="table-data">
                <a href="index.php?action=DetailView&module=Opportunities&record=<?php echo $row['id']?>">
                    <?php echo $name; ?>
                </a>
                <?php if (strpos($delegated_u_id, $log_in_user_id) !== false): ?>
                    <img src="modules/Home/assets/Delegate-icon.svg" style="width: 25px; color:green" />
                <?php endif; ?>
            </td>
            <td class="table-data"><?php echo $full_name; ?></td>

            <?php if(!@$_GET['customColumns']): ?>

            <td class="table-data" style="text-align: center"><?php echo $approvalStatus; ?></td>

            <?php if(@$columnAmount): ?>
                <td class="table-data"><?php echo $amount; ?></td>
            <?php endif; ?>
                            
            <?php if($columnREPEOI): ?>
                <td class="table-data"><?php echo $rfpEOI; ?></td>
            <?php endif; ?>
            
            <?php if($columnClosedDate): ?>
                <td class="table-data"><?php echo $modifiedDate; ?></td>
            <?php endif; ?>
            
            <?php if($columnClosedBy): ?>
                <td class="table-data" ><?php echo $closed_by; ?></td>
            <?php endif; ?>
                            
            <?php if($columnDateCreated): ?>
                <td class="table-data"><?php echo $dateCreated; ?></td>
            <?php endif; ?>
            
            <?php if($columnDateClosed): ?>
                <td class="table-data"><?php echo $closedDate; ?></td>
            <?php endif; ?>

            <?php if($columnTaggedMembers): ?>
                <td class="table-data"><?php echo $taggedMembers; ?></td>
            <?php endif; ?>
            
            <?php if($columnViewedBy): ?>
                <td class="table-data"><?php echo $modifiedUser; ?></td>
            <?php endif; ?>
            
            <?php if($columnPreviousResponsibility): ?>
                <td class="table-data"><?php echo $previousresponsibility; ?></td>
            <?php endif; ?>
            
            <?php if($columnAttachment): ?>
                <td class="table-data"><?php echo $attachment; ?></td>
            <?php endif; ?>

            <?php endif; ?>

            <?php echo $this->getColumnFiltersBody($_GET, $row); ?>
            
            <td class="table-data">
                <div style="font-size: 20px;">
                    <i class="fa fa-check-circle" onClick="openApprovalDialog('Approve','<?php echo $status_c; ?>','<?php echo $approvalID; ?>')"></i>
                    <i class="fa fa-times-circle" onClick="openApprovalDialog('Reject','<?php echo $status_c; ?>','<?php echo $approvalID; ?>')"></i>
                    <a style="color: #534d64; font-size: 20px;" href="index.php?action=DetailView&module=Opportunities&record=<?php echo $oppID; ?>">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>