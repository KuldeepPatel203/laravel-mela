<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
Hello <?php echo $company_name; ?>,<br><br>
It was published a new request for your profession <?php echo $company_name; ?>.<br>
The details of the request are:<br> 
title:  <?php echo $title; ?> <br>
Description: <?php echo $description; ?><br>
Maximum price for this request: <?php echo $budget; ?><br>
The order is valid until the day: <?php echo $expiry_date; ?><br>
Name: <?php echo $request_creator_name; ?><br>
Reply to username: <a href="<?php echo $base_url; ?>/request/reply/<?php echo $insert_id; ?>" title="Reply to user">Reply</a><br><br>

Regards,<br>
Team DoveCercare<br><br>
This message was sent by DoveCercare and may contain confidential information. Should not the intended recipient, please notify us immediately by the same way and delete the message and any attachments, without retaining a copy. Any unauthorized use of the content of this message is a violation of the obligation not to take cognizance of the correspondence between other parties, except for the most serious offense, and exposes the manager to the relevant legal consequences.
</body>
</html>