<?php 
$j_use = $mysqli->query("SELECT * FROM user");
$jum_use = mysqli_num_rows($j_use);

$j_su = $mysqli->query("SELECT * FROM surat");
$jum_su = mysqli_num_rows($j_su);


$date = date('d-m-Y');
                            
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?php echo $jum_use?></h3>

                    <p>User</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
            
            <div class="col-lg-4 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php echo $jum_su?></h3>
                        
                        <p>Data surat</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?php echo $date?></h3>
                        <p>Tanggal</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
            </div>

    </div>
</div>