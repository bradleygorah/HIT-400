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
  // $merchant     = $_POST['merchantid'];
  $price        = $_POST['price'];
  $status       = $_POST['status'];
  $description  = htmlentities(str_replace("'","&#x2019;",$_POST['description']));
  $date     = date("Y-m-d H:i:s");



  $sql = "UPDATE tip SET title = '$name', tip =  WHERE id = $merchant";

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
<section style="background-color: white; width:90%" >

<div class="card text-center">
  <div class="card-header">
   Tip : <?php echo $row['title'];?>
  </div>
  <div class="card-body">
  <img class="card-img-top" src="admin/<?php echo $row['image']; ?>"  style="width: 100%;height:25rem;" alt="Card image cap">
   <hr>
    <p class="card-text"><?php echo $row['tip'];?></p>
    <a href="health.php" class="btn btn-primary">More</a>
  </div>
  <div class="card-footer text-muted">
  <p>Date : </p><?php echo $row['date'];?>
  </div>
</div>

</div>
</section>



<?php
include("footer.php");
?>