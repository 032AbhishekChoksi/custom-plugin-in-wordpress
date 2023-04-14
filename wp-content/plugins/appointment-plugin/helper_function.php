<?php
function pr($arr)
{
  echo '<pre>';
  print_r($arr);
}

function prx($arr)
{
  echo '<pre>';
  print_r($arr);
  die();
}

function get_safe_value($str)
{
  global $con;
  $str = mysqli_real_escape_string($con, $str);
  return $str;
}

function dateFormat($date)
{
  $str = strtotime($date);
  return date('d-m-Y', $str);
}

function timeFormat($time)
{
  $str = strtotime($time);
  return date('h:i a', $str);
}

function redirect($link)
{
?>
<script>
window.location.href = '<?php echo $link ?>';
</script>
<?php
  die();
}

function send_email($email, $html, $subject)
{

  $mail = new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 587;
  $mail->SMTPSecure = "tls";
  $mail->SMTPAuth = true;
  $mail->Username = "EMAIL ID";
  $mail->Password = "EMAIL ID PASSWORD";
  $mail->SetFrom("EMAIL ID");
  $mail->addAddress($email);
  $mail->IsHTML(true);
  $mail->Subject = $subject;
  $mail->Body = $html;
  $mail->SMTPOptions = array('ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => false
  ));
  if ($mail->send()) {
    return true;
  } else {
    return false;
  }
}

function rand_str()
{
  $str = str_shuffle("abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz");
  return $str = substr($str, 0, 15);
}

function apportmentEmail($event_name, $event_description, $event_date, $event_time, $event_location, $event_organizer_name, $event_organizer_email)
{
  $html = '
  <!DOCTYPE html>
  <html >
  <head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <style>
  body {
    font-family: "Helvetica Neue", Helvetica, Arial;
    font-size: 14px;
    line-height: 20px;
    font-weight: 400;
    color: #3b3b3b;
    -webkit-font-smoothing: antialiased;
    font-smoothing: antialiased;
  }
  
  .wrapper {
    margin: 0 auto;
    padding: 40px;
    max-width: 800px;
  }
  
  .table {
    margin: 0 0 40px 0;
    width: 100%;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    display: table;
  }
  @media screen and (max-width: 580px) {
    .table {
      display: block;
    }
  }
  
  .row {
    display: table-row;
    background: #f6f6f6;
  }
  .row:nth-of-type(odd) {
    background: #e9e9e9;
  }
  .row.header {
    font-weight: 900;
    color: #ffffff;
    background: #5e2572;
  }
  .row.green {
    background: #27ae60;
  }
  .row.blue {
    background: #2980b9;
  }
  @media screen and (max-width: 580px) {
    .row {
      padding: 8px 0;
      display: block;
    }
  }
  
  .cell {
    padding: 6px 12px;
    display: table-cell;
  }
  @media screen and (max-width: 580px) {
    .cell {
      padding: 2px 12px;
      display: block;
    }
  }
  </style>
  </head>
  <body>
   <div class="wrapper">
    <div class="table" style="margin-bottom:5px;">    
      <div class="row header">
        <div class="cell">Event Name</div>
        <div class="cell">Event Description</div>
        <div class="cell">Event Date</div>
        <div class="cell">Event Time</div>
        <div class="cell">Event Location On</div>
        <div class="cell">Event Organizer Name</div>
        <div class="cell">Event Organizer Email</div>
      </div>
      
      <div class="row">';
  $html .= ' 
        <div class="cell">' . $event_name . '</div>
        <div class="cell">' . $event_description . '</div>
        <div class="cell">' . dateFormat($event_date) . '</div>
        <div class="cell">' . timeFormat($event_time) . '</div>
        <div class="cell">' . $event_location . '</div>
        <div class="cell">' . $event_organizer_name . '</div>
        <div class="cell">' . $event_organizer_email . '</div>
      </div>    
    </div>
    <p>If you have any questions about this coupon code, simply reply to this email or reach out to our <a href="http://localhost/wpplugin18_32/wp-admin/admin.php?page=appointment-view" target="_blank" style="text-decoration: none; color: blue;">support team</a> for help.</p>
                          <p>Cheers,<br/>Event Management System</p>
  </div>
   
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  </body>
  </html>';
  return $html;
}
?>