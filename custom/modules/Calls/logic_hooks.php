<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['process_record'] = Array(); 
$hook_array['process_record'][] = Array(1, 'count', 'modules/Calls_Reschedule/reschedule_count.php','reschedule_count', 'count'); 


$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(
    77,
    'notifyTagUntaggedUsers',
    'custom/modules/Calls/notify_tag_untag.php',
    'notify_tag_untag',
    'send'
);

$hook_array['before_save'][] = Array(
    79,
    'notifyTagUntaggedUsers',
    'custom/modules/Calls/notify_reassigned.php',
    'notify_reassigned',
    'send'
);


$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(
    79,
    'Retrieve and compare values',
    'custom/modules/Calls/tag_untag.php',
    'taguntag',
    'tag_untag_save'
);

$hook_array['after_save'][] = Array(
    80,
    'Retrieve and compare values',
    'custom/modules/Calls/activity_assign_flow.php',
    'activity_assign',
    'activity_reassign_save'
);

?>