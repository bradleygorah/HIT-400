<?php
include("header.php");



if(isset($_GET['i'])){
  if($_GET['i'] == ''){

  }else{
$merchant = $_GET['i'];
$sql2 = "SELECT * FROM tips WHERE id = $merchant";
$result2 = $connect->query($sql2);
$row = $result2->fetch_assoc();
$merchants = $row['merchantId'];
  }
}

if(isset($_POST['merchant'])){

    $name         = $_POST['name'];
    $merchant     = $_POST['merchantid'];
    $price        = $_POST['price'];
    $description  = htmlentities(str_replace("'","&#x2019;",$_POST['description']));
    $date     = date("Y-m-d H:i:s");

    $type1 = explode('.', $_FILES['first']['name']);
	$type1 = $type1[count($type1)-1];		
	$url1 = 'images/images'.uniqid(rand()).'.'.$type1;
	if(in_array($type1, array('gif', 'jpg', 'jpeg', 'png', 'mp4', 'avi', '3gp','JPG', 'GIF', 'JPEG', 'PNG', 'MP4',
        'AVI', '3GP'))) {
		if(is_uploaded_file($_FILES['first']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['first']['tmp_name'], $url1)) {

                

    $sql = "INSERT INTO tips(title, course, tip, image, status,  date)
           VALUES('$name', $merchant, '$description', '$url1', 1,  '$date')";

if($connect->query($sql) === TRUE){

  $sql3 = "SELECT * FROM tips ORDER BY id DESC LIMIT 1";
$result3 = $connect->query($sql3);
$row3 = $result3->fetch_assoc();
$id = $row3['id'];
  $valid['messages'] = "You have successfully added a healthtip into the system.";
  header("refresh: 3;  url=prodinfo.php?i=$id");	
}else{
  $valid['messages'] = "An error has occured while adding a product into the system.$sql";
}

}	else {
    return false;
}	// /else	
} // if
} // if in_array 

}


if(isset($_POST['edit'])){

  $name         = $_POST['name'];
  $merchant     = $_POST['tipid'];
  $price        = $_POST['price'];
  $status       = $_POST['status'];
  $description  = htmlentities(str_replace("'","&#x2019;",$_POST['description']));
  $date     = date("Y-m-d H:i:s");



  $sql = "UPDATE tips SET title = '$name', tip = '$description'  WHERE id = $merchant";

if($connect->query($sql) === TRUE){

$valid['messages'] = "You have successfully edited a tip in the system.";
header("refresh: 2;  url=prodinfo.php?i=".$_GET['i']."");

}else{
$valid['messages'] = "An error has occured while saving your edits.$sql";
}

}


if(isset($_POST['first'])) {		

  $productId   = $_POST['id'];
  $description = htmlentities(str_replace("'","&#x2019;",$_POST['editDescription']));
  $website      = htmlentities(str_replace("'","&#x2019;",$_POST['website']));
  $email       = htmlentities(str_replace("'","&#x2019;",$_POST['email']));
  $title       = htmlentities(str_replace("'","&#x2019;",$_POST['title']));
  // $type        = $_POST['type'];
  $date        = date("Y-m-d H:i:s");
  
  $type1 = explode('.', $_FILES['img4']['name']);
    $type1 = $type1[count($type1)-1];		
    $url1 = 'images/images'.uniqid(rand()).'.'.$type1;
    if(in_array($type1, array('gif', 'jpg', 'jpeg', 'png', 'mp4', 'avi', '3gp','JPG', 'GIF', 'JPEG', 'PNG', 'MP4',
          'AVI', '3GP'))) {
      if(is_uploaded_file($_FILES['img4']['tmp_name'])) {			
        if(move_uploaded_file($_FILES['img4']['tmp_name'], $url1)) {
  
  
                 
                  $sql = "UPDATE tips SET image = '$url1' WHERE id = $productId";				
  
          if($connect->query($sql) === TRUE) {
            $valid['messages'] = "Successfully Updated";
            header("refresh:2; url=prodinfo.php?i=$productId");	
          } else {
            $valid['messages'] = "An error occured whilist updating image";
          }
        }	else {
          return false;
        }	// /else	
      } // if
      } // if in_array 
      
      $connect->close();
  
    echo json_encode($valid);
   
  } // /if $_POST


?>
<section style="background-color: black;">
<div class="container-fluid p-0 text-center" style="height: 100px;">
<div class="text-center">
<h1>Health tip</h1>
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
<form class="row g-3" action="prodinfo.php?i=<?php echo $merchant?>" method="POST" enctype="multipart/form-data">


<?php
  if(isset($_GET['i'])){
 ?>
 <input type="hidden" value="<?php echo $merchant;?>" name="tipid">
 <?php
}else{
  ?>
  <div class="col-6">
<br>
  <label for="inputAddress2" class="form-label">Image One</label>
  <input type="file"  class="form-control" name="first" value="" id="inputAddress2" placeholder="Name">
</div> 
  <?php
}
  ?>
  <div class="col-6">
  <br>
    <label for="inputAddress2" class="form-label">Heath tip name</label>
    <input type="text"  class="form-control" name="name" value="<?php echo $row['title'];?>" id="inputAddress2" placeholder="name">
  </div>
  <div class="col-12">
  <br>
    <label for="inputAddress" class="form-label">Tip</label>
    <textarea name='description' class="form-control"><?php echo $row['tip'];?></textarea>
  </div>
  <div class="col-6">

  <?php
  if(isset($_GET['i'])){
    if($_GET['i'] == ''){
  
  ?>
  <div class="col-6">
  <br>
  <label for="inputAddress2" class="form-label">Course</label>

<select name="merchantid" class="form-control">
<?php
$sql4 = "SELECT * FROM course";
$result4 = $connect->query($sql4);
While($row4 = $result4->fetch_assoc()){
?>
<option value="<?php echo $row4['id'] ?>"><?php echo $row4['name'] ?></option>
    <?php
    }
    ?>
    </select>
  </div>
  <?php
  
}else{

}
  }else{
  ?>
<div class="col-6">
  <br>
    <label for="inputAddress2" class="form-label">Course</label>

    <select name="merchantid" class="form-control">
    <?php
    $sql4 = "SELECT * FROM course";
    $result4 = $connect->query($sql4);
    While($row4 = $result4->fetch_assoc()){
    ?>
    <option value="<?php echo $row4['id'] ?>"><?php echo $row4['name'] ?></option>
    <?php
    }
    ?>
    </select>
  </div>
  <?php
  }
  ?>
  <div class="col-12">
  
  <?php
  if(isset($_GET['i'])){
    if($_GET['i'] == ""){
  ?>
  <br>
  <button type="submit" name="merchant" class="btn btn-primary">Add Tip</button>
  <br>
    <?php
  }else{
    ?>
    <br>
        <button type="submit" name="edit" class="btn btn-primary">Edit Tip</button>
        <br>
    <?php
  }
}else{
  ?>
  <br>
   <button type="submit" name="merchant" class="btn btn-primary">Add Tip</button>
   <br>
  <?php
}
?>
  </div>
</form>

<?php
if(isset($_GET['i'])){
?>
<div class="card-deck"  style="width: 100%;">

<div class="card"  style="width: 100%;">
<img class="card-img-top" src="<?php echo $row['image']; ?>"  style="width: 100%;height:25rem;" alt="Card image cap">
<div class="card-body">
<form class="form-horizontal" action="prodinfo.php?i=<?php echo $merchant?>" method="POST" enctype="multipart/form-data">
  <h4 class="card-title">Header (image should be not more than 250kb or it will report null.)</h4>
  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
   <input type="file" class="form-control" id="img4" placeholder="image 4" name="img4" class="file-loading" style="width:auto;"/ required>
   <button type='submit' name="first" class="btn btn-primary">Update image</button>
</div>
  </form>
</div>

  </div>
  <?php
}
?>

</div>
</section>



<?php
include("footer.php");
?>