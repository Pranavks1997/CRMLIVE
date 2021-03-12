        <?php 
            global $current_user;
            $log_in_user_id = $current_user->id;
            foreach($response as $row):
                $id = $row['id'];
                $query = "SELECT approval_status, id FROM activity_approval_table WHERE acc_id = '$id' AND ( approver = '$log_in_user_id' OR delegate_id = '$log_in_user_id' ) ORDER BY `id` DESC LIMIT 1";
                $query = $GLOBALS['db']->query($query);
                $result = $GLOBALS['db']->fetchByAssoc($query);
                if($result && isset($result['approval_status']) && $result['approval_status'] == '0'):
        ?>
        <tr>
            <?php echo $this->getActivityColumnFiltersBody($_GET, $row); ?>
            
            <td class="table-data">
                <div style="font-size: 20px;">
                    <i class="fa fa-check-circle" onClick="openActivityApprovalDialog('Approve','<?php echo $result['id']; ?>')"></i>
                    <i class="fa fa-times-circle" onClick="openActivityApprovalDialog('Reject','<?php echo $result['id']; ?>')"></i>
                    <a style="color: #534d64; font-size: 20px;" href="index.php?module=Calls&action=DetailView&record=<?php echo $row['id']; ?>">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </div>
            </td>
        </tr>
        <?php endif; endforeach; ?>
    </tbody>
</table>