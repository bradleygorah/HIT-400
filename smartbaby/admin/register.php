<?php
include("header.php");

if(isset($_GET['i'])){
    if($_GET['i'] == ''){
  
    }else{
  $merchant = $_GET['i'];
  $sql2 = "SELECT * FROM register WHERE id = $merchant";
  $result2 = $connect->query($sql2);
  $row = $result2->fetch_assoc();


    }
  }
?>
<section style="background-color: black;">
<div class="container-fluid p-0 text-center" style="height: 100px;">
<div class="text-center">
    <h1 class="text-light"><?php 
    
if(isset($_GET['i'])){
    if($_GET['i'] == ''){ echo "All check up visits";
    }else{
    echo $row["company"]."'s  check up visits";
    }
    }else{
        echo "All check up visits";
    }
    ?>
    </h1>
</div>
</div>
</section>
<br>
<br>
<table id="example" class="display responsive nowrap" style="width:90%">
        <thead>
            <tr>
                <th>Patient name</th>
                <th>course id</th>
                <th>status</th>
                <th>date scheduled</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(isset($_GET['i'])){
            if($_GET['i'] == ''){
                $sql1 = "SELECT * FROM tips ORDER BY date ASC ";
                $result = $connect->query($sql1);
            }else{
$sql1 = "SELECT * FROM register WHERE id = $merchant ORDER BY date ASC ";
$result = $connect->query($sql1);
            }
        }else{
            $sql1 = "SELECT * FROM register ORDER BY date ASC ";
            $result = $connect->query($sql1);
        }
while($row = $result->fetch_assoc()){
    //if($row["categories_id"] != $product || $row["categories_id2"] != $product ||
    //$row["categories_id3"] != $product){
//here goes the data
$user_id = $row['patient'];
$sql2a = "SELECT * FROM users WHERE user_id = $user_id";
$result2a = $connect->query($sql2a);
$rowa = $result2a->fetch_assoc();
$email = $rowa['email'];
?>
            <tr>
                <td><?php echo $rowa['first_name'].' '.$rowa['last_name'];?></td>
                <td><?php echo $row['course'];?></td>
                <td><?php echo $row['status'];?></td>
                <td><?php echo $row['date'];?></td>
                <td><a href='registerinfo.php?i=<?php echo $row['id'];?>'><button type="button" class="btn btn-outline-primary">Edit</button></a></td>
            </tr>
            <?php
}
               ?>
</table>


<script></script>
    
<?php
include("footer.php");
?>
