<?php
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(90, 'Attachments', 'custom/modules/Opportunities/uploadAttchments.php','cls_attachments', 'fn_attachments'); 


$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(
    77,
    'notifyTagUntaggedUsers',
    'custom/modules/Documents/notify_tag_untag.php',
    'notify_tag_untag',
    'send'
);

$hook_array['after_save'] = [];
$hook_array['after_save'][] = [
	1,
	'Send Nofitication',
	'custom/modules/Documents/notification.php',
	'notification',
	'send'
];