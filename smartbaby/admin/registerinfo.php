<?php
include("header.php");


$member_id = $_SESSION['userId'];
if(isset($_GET['i'])){
  if($_GET['i'] == ''){

  }else{
$merchant = $_GET['i'];
$sql2 = "SELECT * FROM register WHERE id = $merchant";
$result2 = $connect->query($sql2);
$row = $result2->fetch_assoc();

$user_id = $row['patient'];
$sql2a = "SELECT * FROM users WHERE user_id = $user_id";
$result2a = $connect->query($sql2a);
$rowa = $result2a->fetch_assoc();
$email = $rowa['email'];

  }
}



if(isset($_POST['edit'])){

  $description  = htmlentities(str_replace("'","&#x2019;",$_POST['description']));
  $date           = $_POST['date'];
  $user           = $_POST['user'];
  $datestamp      = $_POST['date'];
  $course         = $_POST['course'];
  $state          = $_POST['status'];
  $patient          = $_POST['patient'];
  $weight          = $_POST['weight'];

  $sql3a = "SELECT * FROM course WHERE id = $course";
  $result3a = $connect->query($sql3a);
  $row3a = $result3a->fetch_assoc();
  $days = $row3a['collectionperiod'];
  $lastdate = date('Y-m-d', strtotime($datestamp. ' - '.$days.' days'));

      $duedate = date('Y-m-d', strtotime($datestamp. ' + '.$days.' days'));
      $nextdate = date('Y-m-d', strtotime($duedate. ' + '.$days.' days'));
  

  $sql = "UPDATE register SET weight = '$weight', checkups = '$description', attendee =  $member_id, 
  validation = 1, status = '$state', alert = 2 WHERE id = $merchant";

$sql3b = "SELECT count(*) FROM register WHERE date = $duedate";
$result3b = $connect->query($sql3b);
$row3b = $result3b->fetch_row();

  $sql2 = "INSERT INTO register(patient, date, lastdate, nextdate, course, alert, status)
  VALUES($patient , '$duedate', '$date', '$nextdate', '$course',  2, 'waiting')";

if($connect->query($sql) === TRUE && $connect->query($sql2) === TRUE){

$valid['messages'] = "You have successfully validated the patient visit.";
//email sent starts here ... uzobvisa
$email = $email;
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);


$output='<p>Dear user,</p>';
$output.='<p>Your schedule has been set for you, your next visit to the hospital is '.$duedate.'';
$output.='<p>Your last record report : '.$description.'</p>';
$output.='<p>-------------------------------------------------------------</p>';

$output.='<p>Thank you,</p>';
$output.='<p>Retro Track Team</p>';
$body = $output; 
$subject = "Schedule reminder - Retro Track";

$email_to = $email;
$fromserver = "noreply@keynote.co.zw"; 
// require("PHPMailer-master/PHPMailerAutoload.php");
 
// include_once(FCPATH.'PHPMailer/src/PHPMailer.php');
// include_once(FCPATH.'PHPMailer/src/SMTP.php');
require "../vendor/mail/autoload.php";
$mail =  new PHPMailer\PHPMailer\PHPMailer();

$mail->IsSMTP();
$mail->Host = "mail.keynote.co.zw"; // Enter your host here
$mail->SMTPAuth = true;
$mail->SMTPDebug = 0;
$mail->Username = "noreply@keynote.co.zw"; // Enter your email here
$mail->Password = "KeyPlayer@23"; //Enter your password here
$mail->Port = 26;
$mail->SMTPSecure = 'SMTP';
$mail->IsHTML(true);
$mail->SetFrom('noreply@keynote.co.zw');
$mail->FromName = "Retro Track";
$mail->Sender = $fromserver; // indicates ReturnPath header
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email_to);
if(!$mail->Send()){
echo "Mailer Error: " . $mail->ErrorInfo;
}else{
  header("refresh: 6;  url=registerinfo.php?i=".$_GET['i']."");	
  }	
}else{
  $valid['messages'] = "An error has occured.$sql2 $sql";
}





}

?>
<section style="background-color: black;">
<div class="container-fluid p-0 text-center" style="height: 100px;">
<div class="text-center">
    <h1 class="text-light">Check Up Panel</h1>
</div>
<div class="messages">
							<?php if($valid) {
								foreach ($valid as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
                        </div>
</div>
</section>
<section style="background-color: white;">
<div class="container-fluid p-0 text-center" style="width: 95%;">
<form class="row g-3" action="registerinfo.php?i=<?php echo $merchant?>" method="POST">
<input type="hidden" name='user' value="<?php echo $member_id?>">
<input type="hidden" name='course' value="<?php echo $row['course'];?>">

<input type="hidden" name='patient' value="<?php echo $row['patient'];?>">
<div class="col-6">
    <label for="inputAddress2" class="form-label">Parent name</label>
    <input type="text"  class="form-control" readonly name="first" value="<?php echo $rowa['first_name'].' '.$rowa['last_name'];?>" id="inputAddress2" placeholder="Name">
  </div> 
  <div class="col-6">
    <label for="inputAddress2" class="form-label">course serial</label>
   <select name='status'  class="form-control" required>
   <option value="<?php echo $row['status'];?>"><?php echo $row['status'];?></option>
   <option value="waiting">waiting</option>
   <option value="visited">visited</option>
   <option value="missed">missed</option>
   </select>
  </div> 
  <div class="col-6">
    <label for="inputAddress2" class="form-label">collection day</label>
    <input type="text"  class="form-control" readonly name="date" value="<?php echo $row['date'];?>" id="inputAddress2">
  </div>

  <div class="col-6">Weight in kgs</label>
    <input type="text"  class="form-control" name="weight" value="<?php echo $row['weight'];?>" id="inputAddress2">
  </div>
  <div class="col-12">
  <br>
    <label for="inputAddress" class="form-label">Report</label>
    <textarea name='description' required class="form-control"><?php echo $row['checkups'];?></textarea>
  </div>
  <div class="col-12">
  <br>
  <?php
  if(isset($_GET['i'])){
    if($row['validation'] == 1 && $row['status'] != 'waiting'){

    }else{
  ?>
     <input type="hidden" value="<?php echo $row['id'];?>" name="id" >
        <button type="submit" name="edit" class="btn btn-primary">Edit</button>
  <?php
    }
}
?>
  </div>
</form>
</div>
</section>

<?php
include("footer.php");
?>