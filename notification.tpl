<?php
    if(!isset($_COOKIE['notification']))
    {
        $cookie_value="popup";
        setcookie("notification",$cookie_value, 0);
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Example of Auto Loading Bootstrap Modal on Page Load</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>
</head>
<body>

<?php
    $date = date("Y/m/d");
    $today=strtotime("$date");
    
    $ending=strtotime("$notification_ending_date");
    $starting=strtotime("$notification_starting_date");
?>
<?php if($ending >= $today && $starting <= $today) {?>
<?php if(!isset($_COOKIE['notification'])) { ?>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $notification_title;?></h4>
            </div>
            <div class="modal-body">
				<p><?php echo $notification_message." from ".$notification_starting_date." to ".$notification_ending_date; ?></p>
            </div>
        </div>
    </div>
</div>

<?php } ?>
<?php } ?>
</body>
</html> 
