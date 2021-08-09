<?php
include("header.php");
$merchant = $_SESSION['userId'];
$sql2 = "SELECT * FROM users WHERE user_id = $merchant";
$result2 = $connect->query($sql2);
$row = $result2->fetch_assoc();
$merchants = $row['merchantId'];
?>


            <div class="container-fluid">
                <h3 class="text-dark mb-4">Settings</h3>
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <!-- <div class="card mb-3">
                            <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="assets/img/blank-profile-picture-973460.svg" width="160" height="160">
                                <div class="mb-3"><button class="btn btn-primary btn-sm" type="button">Add baby</button></div>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">Change password</p>
                                    </div>
                                    <div class="card-body">
                                        <form action="profile.php" method="POST">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="username"><strong>current</strong></label><input class="form-control" type="text" placeholder="password" name="pass"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="email"><strong>new password</strong></label><input class="form-control" type="email" placeholder="password" name="pass2"></div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group"><button class="btn btn-primary btn-sm" name='user' type="submit">Save Settings</button></div>
                                        </form>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
include("footer.php");
?>