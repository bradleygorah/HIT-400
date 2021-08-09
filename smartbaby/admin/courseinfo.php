<?php
include("header.php");



if(isset($_GET['i'])){
  if($_GET['i'] == ''){

  }else{
$merchant = $_GET['i'];
$sql2 = "SELECT * FROM course WHERE id = $merchant";
$result2 = $connect->query($sql2);
$row = $result2->fetch_assoc();
  }
}

if(isset($_POST['merchant'])){

    $first    = $_POST['first'];
    $days     = $_POST['days'];
    $description  = htmlentities(str_replace("'","&#x2019;",$_POST['description']));
    $code  = $_POST['code'];
    $phone    = $_POST['phone'];
    $city     = $_POST['city'];
    $date     = date("Y-m-d H:i:s");

    $sql3 = "SELECT count(*) FROM course WHERE code = '$code'";
    $result3 = $connect->query($sql3);
    $row3 = $result3->fetch_row();


if($row3[0] == 0){
    $sql = "INSERT INTO course(name, code, description, collectionperiod, status, date)
           VALUES('$first', '$code', '$description', '$days',  1, '$date')";

if($connect->query($sql) === TRUE){

  $sql3 = "SELECT * FROM course WHERE code = '$code'";
$result3 = $connect->query($sql3);
$row3 = $result3->fetch_assoc();
$id = $row3['id'];
  $valid['messages'] = "You have successfully added a course into the system.";
  header("refresh: 3;  url=courseinfo.php?i=$id");	
}else{
  $valid['messages'] = "An error has occured while adding a course into the system";
}
}else{
  $valid['messages'] = "The email you have submitted  a code already in use";	
}

}


if(isset($_POST['edit'])){

  $id       = $_POST['id'];
  $first    = $_POST['first'];
  $last     = $_POST['last'];
  $email    = $_POST['email'];
  $username = $_POST['username'];
  $website  = $_POST['website'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $address  = $_POST['description'];
  $code    = $_POST['code'];
  $days     = $_POST['days'];
  $date     = date("Y-m-d H:i:s");



  $sql = "UPDATE course SET name = '$first', code = '$code', description = '$address', collectionperiod = '$days' 
  WHERE id = $id";

if($connect->query($sql) === TRUE){

$valid['messages'] = "You have successfully edited a merchant in the system.";
header("refresh: 6;  url=couseinfo.php?i=$id");

}else{
$valid['messages'] = "An error has occured while saving your edits.$sql";
}

}

?>
<section style="background-color: black;">
<div class="container-fluid p-0 text-center" style="height: 100px;">
<div class="text-center">
    <h1 class="text-light">Add Course</h1>
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
<form class="row g-3" action="courseinfo.php?i=<?php echo $merchant?>" method="POST">
<div class="col-6">
    <label for="inputAddress2" class="form-label">name</label>
    <input type="text"  class="form-control" name="first" value="<?php echo $row['firstname'];?>" id="inputAddress2" placeholder="Name">
  </div> 
  <div class="col-6">
    <label for="inputAddress2" class="form-label">course serial</label>
    <input type="text"  class="form-control" name="code" value="<?php echo $row['code'];?>" id="inputAddress2" placeholder="Name">
  </div> 
  <div class="col-6">
    <label for="inputAddress2" class="form-label">collection period(days)</label>
    <input type="text"  class="form-control" name="days" value="<?php echo $row['collectionperiod'];?>" id="inputAddress2" placeholder="days">
  </div>
  <div class="col-12">
  <br>
    <label for="inputAddress" class="form-label">Descripton</label>
    <textarea name='description' class="form-control"><?php echo $row['description'];?></textarea>
  </div>
  <div class="col-12">
  <br>
  <?php
  if(isset($_GET['i'])){
    if($_GET['i'] == ""){
  ?>
  <button type="submit" name="merchant" class="btn btn-primary">Add Course</button>
    <?php
  }else{
    ?>
     <input type="hidden" value="<?php echo $row['id'];?>" name="id" >
        <button type="submit" name="edit" class="btn btn-primary">Edit Course</button>
    <?php
  }
}else{
  ?>
   <button type="submit" name="merchant" class="btn btn-primary">Add Course</button>
  <?php
}
?>
  </div>
</form>
</div>
</section>

<?php
include("footer.php");
?>