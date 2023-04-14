<?php
global $wpdb;
global $table_prefix;
$table = $table_prefix . 'appointment';

if (isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['id']) && $_GET['id'] > 0) {
    $type = $_GET['type'];
    $id = $_GET['id'];
    if ($type == 'delete') {
        $sql = "DELETE FROM `$table` WHERE `Event_ID` = $id;
       ";
        $wpdb->query($sql);
        redirect('http://localhost/wpplugin18_32/wp-admin/admin.php?page=appointment-view');
    }
}

$sql = "SELECT * FROM `$table` ORDER BY `Event_ID`";
$wpdb->query($sql);
$res = $wpdb->get_results($sql);

?>
<link rel="stylesheet" href="<?php echo PLUGIN_URL . '/appointment-plugin/assets/css/style.css' ?>"
    integrity="sha512-j9V7W1zS/5YUabCkUZztRIM6M0U6aE7GzTKT93TJrWz3OLP3blAeZoLAVd0nB+xEJ1v/Jck1UV+jnXH+C/mxhQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container-fluid">
    <h1 class="grid_title">Event Manager</h1>
    <a href="http://localhost/wpplugin18_32/wp-admin/admin.php?page=add-new">Add Event</a>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">S.No #</th>
                            <th width="10%">Event Name</th>
                            <th width="10%">Event Description</th>
                            <th width="15%">Event Date</th>
                            <th width="10%">Event Time</th>
                            <th width="10%">Event Location</th>
                            <th width="10%">Event Organizer Name</th>
                            <th width="10%">Event Organizer Email</th>
                            <th width="10%">Event Add On</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($res) > 0) {
                            $i = 1;
                            foreach ($res as $row) {
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row->Event_Name ?></td>
                            <td><?php echo $row->Event_Description ?></td>
                            <td><?php echo dateFormat($row->Event_Date) ?></td>
                            <td><?php echo timeFormat($row->Event_Time) ?></td>
                            <td><?php echo $row->Event_Location ?></td>
                            <td><?php echo $row->Event_Organizer_Name ?></td>
                            <td><?php echo $row->Event_Organizer_Email ?></td>
                            <td><?php echo dateFormat($row->Event_AddeOn) ?></td>
                            <td>
                                <a
                                    href="http://localhost/wpplugin18_32/wp-admin/admin.php?page=add-new&id=<?php echo $row->Event_ID ?>"><label
                                        class="badge bg-light text-dark hand_cursor">Edit</label></a>
                                &nbsp;
                                <a
                                    href="http://localhost/wpplugin18_32/wp-admin/admin.php?page=appointment-view&id=<?php echo $row->Event_ID ?>&type=delete"><label
                                        class="badge bg-danger hand_cursor">Delete</label></a>
                            </td>

                        </tr>
                        <?php
                                $i++;
                            }
                        } else { ?>
                        <tr>
                            <td colspan="10">
                                <center>No data found</center>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo PLUGIN_URL . '/appointment-plugin/assets/js/script.js' ?>"
    integrity="sha512-EyU6G9U6Vi4I4/U4z4fMgRwE1/uZS1Cfu2/aL//xcOg26qXeTzPZo0uDmgvvBSt0w2ROZgGt+gzuv1spLfljCg=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>