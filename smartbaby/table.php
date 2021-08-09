<?php
include("header.php");
$merchant = $_SESSION['userId'];
$sql2 = "SELECT * FROM users WHERE user_id = $merchant";
$result2 = $connect->query($sql2);
$row2 = $result2->fetch_assoc();
$merchants = $row2['	user_id'];
$email = $row2['email'];
$datestamp           = date("Y-m-d");
if(isset($_GET['i'])){
    $id = $_GET['i'];

    $sql = "UPDATE register SET alert = 1 WHERE id = $id";
    if($connect->query($sql) === TRUE){
        header("location: table.php");
    }
}



                                    $sql3 = "SELECT count(*) FROM register WHERE patient = $merchant";
                                    $result3 = $connect->query($sql3);
                                    $row3 = $result3->fetch_row();

                                    $sql5 = "SELECT count(*) FROM register WHERE patient = $merchant AND status = 'missed'";
                                    $result5 = $connect->query($sql5);
                                    $row5 = $result5->fetch_row();

                                    $sql6 = "SELECT count(*) FROM register WHERE patient = $merchant AND status = 'visited'";
                                    $result6 = $connect->query($sql6);
                                    $row6 = $result6->fetch_row();

                                    $percent = ($row6[0]/$row3[0])*100;
                                    $mpercent = ($row5[0]/$row3[0])*100;
?>
            <div class="container-fluid">
                <h3 class="text-dark mb-4">List of recorded check up dates</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Appointments set by this system also included</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-nowrap">
                                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="10" selected="">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                            </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <thead>
                                    <tr>
                                    
                                        <th>Date</th>
                                        <th>Name&nbsp;</th>
                                        <th>weight</th>
                                        <th>report</th>
                                        <th>Check ups completed&nbsp;</th>
                                        <th>Validated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql4 = "SELECT * FROM register WHERE patient = $merchant ORDER by date DESC";
                                $result4 = $connect->query($sql4);
                                while($row4 = $result4->fetch_assoc()){

                                ?>
                                    <tr>
                                        <td><?php echo $row4['date'];?></td>
                                        <td>
                                        <?php if($row4['attendee']  == ''){ 
                                            echo '<img class="rounded-circle mr-2" width="30" height="30" 
                                        src="assets/img/blank-profile-picture-973460.svg">';
                                        }else{
                                            echo $row4['attendee'];
                                        }?>
                                        </td>
                                        <td>
                                        <?php  echo $row4['weight'];?></td>
                                        <td>
                                        <?php  echo $row4['checkups'];?></td>
                                        <td><?php echo $row4['status'];?></td>
                                        <td><?php if($row4['validation'] == 1){
                                            echo 'yes';
                                        }else{
                                            echo 'no';
                                        } ;?></td>
                                    </tr>
                                  <?php
                                }
                                  ?>
                                </tbody>
                                <tfoot>
                                    <tr></tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                            </div>
                            <div class="col-md-6">
                                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                    <ul class="pagination">
                                        <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
include("footer.php");
?>