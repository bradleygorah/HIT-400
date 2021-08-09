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
    if($_GET['i'] == ''){ echo "All Health tips";
    }else{
    echo $row["company"]."'s  Health tips";
    }
    }else{
        echo "All Health tips";
    }
    ?>
    </h1>
</div>
</div>
</section>
<br>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <a href="prodinfo.php"><button class="btn btn-primary me-md-2" type="button">Add Health Tips</button></a>
</div>
<br>
<table id="example" class="display responsive nowrap" style="width:90%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(isset($_GET['i'])){
            if($_GET['i'] == ''){
                $sql1 = "SELECT * FROM tips ORDER BY date ASC ";
                $result = $connect->query($sql1);
            }else{
$sql1 = "SELECT * FROM tips WHERE merchantId = $merchant ORDER BY date ASC ";
$result = $connect->query($sql1);
            }
        }else{
            $sql1 = "SELECT * FROM tips ORDER BY date ASC ";
            $result = $connect->query($sql1);
        }
while($row = $result->fetch_assoc()){
    //if($row["categories_id"] != $product || $row["categories_id2"] != $product ||
    //$row["categories_id3"] != $product){
//here goes the data
?>
            <tr>
                <td><?php echo $row['title'];?></td>
                <td>
                <img class="card-img-top" src="<?php echo $row['image'];?>"  style="width: 50px;height:50px" alt="Card image cap">
                </td>
                <td><?php echo $row['date'];?></td>
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
