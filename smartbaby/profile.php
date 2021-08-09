<?php
include("header.php");
$merchant = $_SESSION['userId'];
$sql2 = "SELECT * FROM users WHERE user_id = $merchant";
$result2 = $connect->query($sql2);
$row2 = $result2->fetch_assoc();
$merchants = $row2['	user_id'];
$email = $row2['email'];
$datestamp           = date("Y-m-d");



if(isset($_POST['initial'])){

    $date           = $_POST['date'];
    $user           = $_POST['user'];
    $datestamp      = $_POST['datestamp'];
    $course         = $_POST['course'];
    $hospital       = $_POST['hospital'];
    $babyname       = $_POST['name'];
    $babyparent     = $_POST['parent'];
    $spouse         = $_POST['spouse'];
    

    $sql3a = "SELECT * FROM course WHERE id = $course";
    $result3a = $connect->query($sql3a);
    $row3a = $result3a->fetch_assoc();
    $days = $row3a['collectionperiod'];
    $lastdate = date('Y-m-d', strtotime($datestamp. ' - '.$days.' days'));

    if($lastdate > $date){
       $duedate = date('Y-m-d', strtotime($datestamp. ' + 2 days'));
     
       $nextdate = date('Y-m-d', strtotime($duedate. ' + '.$days.' days'));
    }else if($lastdate < $date){
        $duedate = date('Y-m-d', strtotime($datestamp. ' + '.$days.' days'));
        $nextdate = date('Y-m-d', strtotime($duedate. ' + '.$days.' days'));
    }

    $sql = "INSERT INTO register(patient, date, lastdate, nextdate, course, alert, status)
           VALUES($user , '$duedate', '$date', '$nextdate', '$course',  2, 'waiting')";

             $sql2 = "UPDATE users SET course = '$course', babydob = '$date', babyparent='$babyparent',
             parent = '$spouse', babyname = '$babyname' WHERE user_id = $user";

if($connect->query($sql) === TRUE && $connect->query($sql2) === TRUE){

  $sql3 = "SELECT * FROM register WHERE patient = $user";
$result3 = $connect->query($sql3);
$row3 = $result3->fetch_assoc();
$id = $row3['id'];
  
  //email sent starts here ... uzobvisa
  $email = $email;
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);


$output='<p>Dear user,</p>';
$output.='<p>Your schedule has been set for you, your next baby check up visit to the hospital is '.$duedate.'';
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>-------------------------------------------------------------</p>';

$output.='<p>Thank you,</p>';
$output.='<p>Smart Baby Monitor Team</p>';
$body = $output; 
$subject = "Schedule reminder - Smart Baby Monitor";

$email_to = $email;
$fromserver = "noreply@keynote.co.zw"; 
// require("PHPMailer-master/PHPMailerAutoload.php");
 
// include_once(FCPATH.'PHPMailer/src/PHPMailer.php');
// include_once(FCPATH.'PHPMailer/src/SMTP.php');
require "vendor/mail/autoload.php";
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
$mail->FromName = "Smart Baby Monitor";
$mail->Sender = $fromserver; // indicates ReturnPath header
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email_to);
if(!$mail->Send()){
header("location: 4;  url=profile.php?i=$id");
}else{
    $valid['messages'] = "Your schedule has been set for you, your next baby check up visit to the hospital is $duedate.";	
  }	
}else{
  $valid['messages'] = "An error has occured.$sql $sql2";
}

}

?>


            <div class="container-fluid">
                <h3 class="text-dark mb-4">Profile</h3>
                
                <h5 class="text-dark mb-4">Today is <?php echo $datestamp?></h5>
                <div class="messages">
							<?php if($valid) {
								foreach ($valid as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
                        </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col">
                            <div class="card shadow">
                                <?php
                                $sql3 = "SELECT * FROM users WHERE user_id = $merchant";
                                $result3 = $connect->query($sql3);
                                $row3 = $result3->fetch_assoc();
                                // $days = $row3a['collectionperiod'];
                                $dob = strtotime($row3['babydob']);
                                $today = strtotime(date('Y-m-d'));
                                $days = ($today - $dob)/60/60/24;
                                $months = $days/30;
                                $years = $days/365;
                                if($row3['babydob'] == ''){
                                ?>
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">Your baby's Info</p>
                                    </div>
                                    <div class="card-body">
                                    <form action="profile.php" method="POST">
                                    <input class="form-control" type="hidden" value="<?php echo $datestamp;?>" required name="datestamp">
                                    <input class="form-control" type="hidden" value="<?php echo $merchant;?>" required name="user">
                                            <div class="form-group"><label for="address"><strong>DOB</strong></label>
                                            <input class="form-control" type="date" required name="date"></div>
                                            <div class="form-group"><label for="address"><strong>Full Name</strong></label>
                                            <input class="form-control" type="text" required name="name"></div>
                                            <div class="form-group"><label for="address"><strong>Place Of Birth</strong></label>
                                            <input class="form-control" type="text" required name="hospital"></div>
                                            <div class="form-group"><label for="address"><strong>Baby's Father/Mother</strong></label>
                                            <input class="form-control" type="text" required name="parent"></div>
                                            <div class="form-check">
  <label class="form-check-label">
    <input class="form-check-input" type="radio" name="spouse" id="exampleRadios1" value="father" checked>
    Father
  </label>
</div>
<div class="form-check">
  <label class="form-check-label">
    <input class="form-check-input" type="radio" name="spouse" id="exampleRadios2" value="mother">
 Mother
  </label>
</div>
                                            <!-- <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="city"><strong>Choose medication course</strong></label>
                                                    <select class="form-control" name="course" required>
                                                    <option>Select</option>
                                                    <?php
                                                     $sql5 = "SELECT * FROM course WHERE status = 1";
                                                     $result5 = $connect->query($sql5);
                                                     while($row5 = $result5->fetch_assoc()){
                                                    ?>
                                                     <option value="<?php echo $row5['id'];?>"><?php echo $row5['name'];?></option>
                                                     <?php
                                                     }
                                                     ?>
                                                    </select>
                                                </div> -->
                                            </div>
                                            <input type="hidden" name='course' value="1">
                                            <div class="form-group"><button type="submit" class="btn btn-primary btn-sm" name="initial" >Submit</button></div>
                                        </form>
                                        
                                </div>
                                        <?php
                                }else{
                                        ?>
                                        <div class="card-header py-3">
                                        <p class="text-success m-0 font-weight-bold">Info
                                        </p>
                                    </div>
                                    <div class="card-body">
                                    <p class="text-success m-0 font-weight-bold">Your Baby's details :
                                        Name : <b class="text-primary"><?php echo $row3['babyname'];?></b>
                                        <hr>
                                        
                                        DOB : <b class="text-primary"><?php echo $row3['babydob'];?></b>
                                        <hr>
                                        
                                        Age : <b class="text-primary"><?php echo round($years).' years, '.round($months).' months, '. 
                                        $days.' days';?></b>
                                    </p>
                                    </div>
                                        <?php
                                }
                                        ?>
                            </div>
                            <br>
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">User Settings</p>
                                    </div>
                                    <div class="card-body">
                                        <form action="profile.php" method="POST">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="username"><strong>Username</strong></label>
                                                    <input class="form-control" type="text"  value="<?php echo $row2['username'];?>" 
                                                    name="username"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="email"><strong>Email Address</strong></label>
                                                    <input class="form-control" type="email" readonly value="<?php echo $row2['email'];?>" name="email"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="first_name"><strong>First Name</strong></label>
                                                    <input class="form-control" type="text" readonly value="<?php echo $row2['first_name'];?>" name="first_name"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="last_name"><strong>Last Name</strong></label>
                                                    <input class="form-control" type="text" readonly value="<?php echo $row2['last_name'];?>" name="last_name"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="last_name"><strong>Address</strong></label>
                                                    <input class="form-control" type="text" value="<?php echo $row2['Address'];?>" name="address"></div>
                                                </div>
                                                
                                                <div class="col">
                                                    <div class="form-group"><label for="last_name"><strong>Phone</strong></label>
                                                    <input class="form-control" type="text" readonly value="<?php echo $row2['Phone'];?>" name="last_name"></div>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group"><button class="btn btn-primary btn-sm" name='user' type="submit">update details</button></div> -->
                                        </form>
                                    </div>
                                </div>
                                <br>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
include("footer.php");
?>