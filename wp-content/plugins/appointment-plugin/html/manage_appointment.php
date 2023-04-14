<?php
global $wpdb;
global $table_prefix;
$table = $table_prefix . 'appointment';

$event_name = "";
$event_description = "";
$event_date = "";
$event_time = "";
$event_location = "";
$event_organizer_name = "";
$event_organizer_email = "";
$event_added_on = date('Y-m-d h:i:s');
$event_id = "";

if(isset($_GET['id']) && $_GET['id']>0){
	$event_id  = $_GET['id'];
	$sql = "SELECT * FROM `$table` WHERE `Event_ID`='$event_id';";
	$wpdb->query($sql);
	$res = $wpdb->get_results($sql);
	
	$event_name = $res[0]->Event_Name;
	$event_description = $res[0]->Event_Description;
	$event_date = $res[0]->Event_Date;
	$event_time = $res[0]->Event_Time;
	$event_location = $res[0]->Event_Location;
	$event_organizer_name = $res[0]->Event_Organizer_Name;
	$event_organizer_email = $res[0]->Event_Organizer_Email;
}

if (isset($_POST['event_submit'])) {
	$event_name = $_POST['event_name'];
	$event_description = $_POST['event_description'];
	$event_date = $_POST['event_date'];
	$event_time = $_POST['event_time'];
	$event_location = $_POST['event_location'];
	$event_organizer_name = $_POST['event_organizer_name'];
	$event_organizer_email = $_POST['event_organizer_email'];
	
	if($event_id==''){	
		$sql = "INSERT INTO `$table` (`Event_Name`, `Event_Description`, `Event_Date`, `Event_Time`, `Event_Location`, `Event_Organizer_Name`, `Event_Organizer_Email`, `Event_AddeOn`)
		VALUES ('$event_name', '$event_description', '$event_date', '$event_time', '$event_location', '$event_organizer_name', '$event_organizer_email','$event_added_on' );
		";
	} else {
		
		$sql = "UPDATE `$table` SET `Event_Name` = '$event_name',`Event_Description` ='$event_description', `Event_Date` ='$event_date',`Event_Time` ='$event_time',`Event_Location` = '$event_location',`Event_Organizer_Name` =  'event_organizer_name',`Event_Organizer_Email` = '$event_organizer_email' WHERE `Event_ID`='$event_id';";
	}
	$wpdb->query($sql);
	
	$html = apportmentEmail($event_name,$event_description,$event_date,$event_time,$event_location,$event_organizer_name,$event_organizer_email);
	$subject = "Event Management System";
	
	if($event_id=='') {
		if (send_email($event_organizer_email, $html, $subject) == false) {
			echo "<h1>Send Email Fail</h1>";
			die();
		}
	}
	
	redirect('http://localhost/wpplugin18_32/wp-admin/admin.php?page=appointment-view');
}
?>
<link rel="stylesheet" href="<?php echo PLUGIN_URL . '/appointment-plugin/assets/css/style.css' ?>"
    integrity="sha512-j9V7W1zS/5YUabCkUZztRIM6M0U6aE7GzTKT93TJrWz3OLP3blAeZoLAVd0nB+xEJ1v/Jck1UV+jnXH+C/mxhQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class=" container mt-4">
    <h1 class="text-center mb-4">Event Management Form</h1>
    <form name="frmAppointment" id="frmAppointment" class="forms-sample" method="POST">
        <div class=" mb-3">
            <div class="form-group mb-3">
                <label for="event-name" class="form-label">Event Name</label>
                <input type="text" class="form-control" name="event_name" id="event_name" value="<?php echo $event_name?>" required />
            </div>
            <div class="form-group mb-3">
                <label for="event-description" class="form-label">Event Description</label>
                <textarea class="form-control" name="event_description" id="event_description" rows="3"
                    required><?php echo $event_description?></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="event-date" class="form-label">Event Date</label>
                <input type="date" class="form-control" name="event_date" id="event_date" value="<?php echo $event_date?>" required />
            </div>
            <div class="form-group mb-3">
                <label for="event-time" class="form-label">Event Time</label>
                <input type="time" class="form-control" name="event_time" id="event_time" value="<?php echo $event_time?>" required />
            </div>
            <div class="form-group mb-3">
                <label for="event-location" class="form-label">Event Location</label>
                <input type="text" class="form-control" name="event_location" id="event_location" value="<?php echo $event_location?>" required />
            </div>
            <div class="form-group mb-3">
                <label for="event-organizer-name" class="form-label">Event Organizer Name</label>
                <input type="text" class="form-control" name="event_organizer_name" id="event_organizer_name"
                    value="<?php echo $event_organizer_name?>" required />
            </div>
            <div class="form-group mb-3">
                <label for="event-organizer-email" class="form-label">Event Organizer Email</label>
                <input type="text" class="form-control" name="event_organizer_email" id="event_organizer_email"
                    value="<?php echo $event_organizer_email?>"required />
            </div>
            <div class="form-group mb-3">
                <div id="form_msg"
                    style="margin-top: 18px; margin-bottom: 3px; color: green;font: bolder;font-size: larger;"></div>
            </div>
            <div class="form-group mb-3">
                <button name="event_submit" id="event_submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
    </form>
</div>
<script src="<?php echo PLUGIN_URL . '/appointment-plugin/assets/js/script.js' ?>"
    integrity="sha512-EyU6G9U6Vi4I4/U4z4fMgRwE1/uZS1Cfu2/aL//xcOg26qXeTzPZo0uDmgvvBSt0w2ROZgGt+gzuv1spLfljCg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script src="<?php echo PLUGIN_URL . '/appointment-plugin/assets/js/jquery-1.12.0.min.js' ?>"></script>
<script src="<?php echo PLUGIN_URL . '/appointment-plugin/assets/js/custom.js' ?>"></script> -->