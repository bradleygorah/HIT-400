<?php
include("header.php");

if(isset($_GET['i'])){
    if($_GET['i'] == ''){
  
    }else{
  $merchant = $_GET['i'];
  $sql2 = "SELECT * FROM tips WHERE id = $merchant";
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
    if($_GET['i'] == ''){ echo "All Users";
    }else{
    echo $row["company"]."'s  User";
    }
    }else{
        echo "All Users";
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
                <th>Name</th>
                <th>email</th>
                <th>phone</th>
                <th>status</th>
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
$sql1 = "SELECT * FROM users WHERE user_id = $merchant ORDER BY joined_date ASC ";
$result = $connect->query($sql1);
            }
        }else{
            $sql1 = "SELECT * FROM users ORDER BY joined_date ASC ";
            $result = $connect->query($sql1);
        }
while($row = $result->fetch_assoc()){
    //if($row["categories_id"] != $product || $row["categories_id2"] != $product ||
    //$row["categories_id3"] != $product){
//here goes the data
?>
            <tr>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['phone'];?></td>
                <td><?php echo $row['status'];?></td>
                <td><a href='prodinfo.php?i=<?php echo $row['id'];?>'><button type="button" class="btn btn-outline-primary">Edit</button></a></td>
            </tr>
            <?php
}
               ?>
</table>


<script></script>
    
<?php
include("footer.php");
?>
