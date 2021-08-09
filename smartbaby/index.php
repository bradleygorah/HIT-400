<?php
include("header.php");


       /* Database connection settings */
       $host = 'localhost';
       $user = 'root';
       $pass = '';
       $db = 'vaccination';
       $mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
   
       $data1 = '';
       $data2 = '';
   
       //query to get data from the table
       $sql = "SELECT nextdate, weight  FROM register WHERE validation = 1 and patient = $member_id ORDER BY nextdate ASC";
   
       $result = mysqli_query($mysqli, $sql);
   
       //loop through the returned data
       while ($row = mysqli_fetch_array($result)) {
   
           $data1 = $data1 . '"'. $row['nextdate'].'",';
           $data2 = $data2 . '"'. $row['weight'] .'",';
       }
   
       $data1 = trim($data1,",");
       $data2 = trim($data2,",");
    
 
?>
                                    
            <div class="container-fluid">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">Smart baby monitor</h3>
                    </div>
                    <h5 class="text-dark mb-4">Today is <?php echo $datestamp?></h5> <div class="row">
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span style="color: rgb(15,106,7);">next check up date</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span><?php
                                        if($row3[0] == 0){
                                            echo 'please register your baby to be monitored.<a href="profile.php"> Click here to register</a>';
                                        }else{
                                            echo $row4['date'];
                                        }
                                        ?></span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-success py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span style="color: rgb(167,16,16);">Missed check up dates</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span style="color: rgb(163,0,0);">
                                        <?php
                                        if($row3[0] == 0){
                                            echo 'please register your baby to be monitored.<a href="profile.php"> Click here to register</a>';
                                        }else{
                                            echo $row5[0];
                                        }
                                        ?>
                                        </span></div>
                                    </div>
                                    <div class="col-auto"><i class="far fa-calendar-times fa-2x text-gray-300" style="color: #a30909;"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-info py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>Total check up completion</span></div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="text-dark font-weight-bold h5 mb-0 mr-3"><span>
                                                <?php
                                        if($row3[0] == 0){
                                            echo 'please register your baby to be monitored.<a href="profile.php"> Click here to register</a>';
                                        }else{
                                            echo $percent.'%';
                                        }
                                        ?>
                                                </span></div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-info" aria-valuenow="<?php echo $percent;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent;?>%;"><span class="sr-only"><?php echo $percent;?>%</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-warning py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Total health check ups</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>
                                        <?php
                                        if($row3[0] == 0){
                                            echo 'please register your baby to be monitored.<a href="profile.php"> Click here to register</a>';
                                        }else{
                                            echo $row6[0].'/'.$row3[0];
                                        }
                                        ?>
                                        </span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-check-double fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="height:400px">
                    <div class="col-lg-6 col-xl-8">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="text-primary font-weight-bold m-0">Weight against baby age graph</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                            
                                <canvas id="chart" style="width: 100%; height: auto; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-2">
                    <img src="assets/img/chart (2).jpeg">
                    </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="text-primary font-weight-bold m-0">monthly health check up visits %</h6>
                        </div>
                        <div class="card-body">
                            <h4 class="small font-weight-bold">Missed visits<span class="float-right">   <?php
                                        if($row3[0] == 0){
                                            echo 'please register your baby to be monitored.<a href="profile.php"> Click here to register</a>';
                                        }else{
                                            echo $mpercent.'%';
                                        }
                                        ?></span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" aria-valuenow="<?php echo $mpercent;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $mpercent;?>%;"><span class="sr-only"><?php echo $mpercent;?>%</span></div>
                            </div>
                            <h4 class="small font-weight-bold">Attended visits<span class="float-right">   <?php
                                        if($row3[0] == 0){
                                            echo 'please register your baby to be monitored.<a href="profile.php"> Click here to register</a>';
                                        }else{
                                            echo $percent.'%';
                                        }
                                        ?></span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent;?>%;"><span class="sr-only"><?php echo $percent;?>%</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="text-primary font-weight-bold m-0">Next baby check up dates</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <h6 class="mb-0"><strong><?php
                                        if($row3[0] == 0){
                                            echo 'please register your baby to be monitored.<a href="profile.php"> Click here to register</a>';
                                        }else{
                                            echo $row4['date'].'<hr>'.$row4['nextdate'];
                                        }
                                        ?></strong></h6><span class="text-xs"></span></div>
                                    <div class="col-auto">
                                        <div class="custom-control custom-checkbox"><input class="custom-control-input" type="checkbox" id="formCheck-1"><label class="custom-control-label" for="formCheck-1"></label></div>
                                    </div>
                                </div>
                            </li>
                           
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card text-white bg-primary shadow">
                            
                    <a href="health.php" style="color: white;">
                                <div class="card-body">
                                    <p class="m-0">Health Tips</p>
                                    <p class="text-white-50 small m-0">click to check</p>
                                </div>
                                </a>

                            </div>
                        </div>
                    
                        
                       
                        <div class="col-lg-6 mb-4">
                            <div class="card text-white bg-success shadow">
                            <a href="table.php" style="color: white;">
                                <div class="card-body">
                                    <p class="m-0">Health Records&nbsp;</p>
                                    <p class="text-white-50 small m-0">click to view</p>
                                </div>
                            </a>
                            </div>
                        </div>
                       </a>
                       
                       <div class="col-lg-6 mb-4">
                            <div class="card text-white bg-info shadow">
                            <a href="maya.php" style="color: white;">
                                <div class="card-body">
                                    <p class="m-0">Get assistance from Bradley</p>
                                    <p class="text-white-50 small m-0">click for assistnce</p>
                                </div>
                            </a>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>


    
   <?php
   include("footer.php");
   ?>
  <script>
var ctx = document.getElementById("chart").getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo $data1; ?> ],
        datasets: 
        [

        {
            label: 'baby Weight',
            data: [<?php echo $data2; ?>, ],
            backgroundColor: 'transparent',
            borderColor:'rgba(0,255,255)',
            borderWidth: 3  
        }]
    },

    options: {
        scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
        tooltips:{mode: 'index'},
        legend:{display: false, position: 'top', labels: {fontColor: 'gold', fontSize: 16}},
        plugins: {
    datalabels: {
        display: false,
    }
}
    }
});
</script>