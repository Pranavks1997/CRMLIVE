<?php 
            global $current_user;
            $log_in_user_id = $current_user->id;
            foreach($response as $row):
                /*$created_by_id          = $row['created_by'];
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
                $tagged_users = $tagged_user_query_fetch_row && $tagged_user_query_fetch_row['user_id'];*/

                

        ?>
        <tr>
            <?php echo $this->getDocumentColumnFiltersBody($_GET, $row); ?>

            <td class="table-data">
                <div style="display: flex; width: 65%; align-items: center; padding: 0px; justify-content: space-between; margin-left: 20px;">
                

                    <button class="tag1" id="deselectBtn" style="margin-right: 7px;width: 15px;" onclick="fetchDocumentTagDialog('<?php echo $row['id']; ?>')">
                        <?php if ($this->is_document_tagging_applicable($row['id'])) { ?>

                            <i id="search-icon" title="Tag User" class="fa fa-tag" aria-hidden="true"> </i>

                        <?php } ?>
                    </button>

                    <button class="tag1" id="deselectBtn" style="margin-right: 7px;width: 15px;" onclick="fetchNoteDialog('<?php echo $row['id']; ?>')">
                        <?php if ($this->is_document_note_applicable($row['id'])) { ?>

                            <i id="search-icon" title="Note" class="fa fa-pencil-square-o" aria-hidden="true" style="background-color: transparent; color: black;"> </i>

                        <?php } ?>
                    </button>
                    <a style="width: 15px;" href="index.php?module=Documents&action=DetailView&record=<?php echo $row['id']; ?>" class="eye" id="search-btn">
                        <i id="search-icon" title="View Details" class="fa fa-eye" aria-hidden="true"> </i>
                    </a>
                    <!-- <button class="" id="reminderBtn" style="width: 15px;" onclick="fetchReminderDialog('<?php echo $row['id']; ?>')">
                        <?php //if ($this->is_activity_reminder_applicable($row['id'])) { ?>
                            <i id="reminder-icon" class="fa fa-bell" aria-hidden="true"> </i>
                        <?php// } ?>
                    </button> -->
                </div>
            </td>
        </tr>
        <?php endforeach; ?>

    </tbody>
</table>