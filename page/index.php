<?php
include "../control/koneksi.php";
include "theme/head.php";
include "theme/navbar.php";
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Kantor desa bulu</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <?php 
        include "fungsi/page.php";
        ?>
    </section>
</div>

<?php 
include "theme/footer.php";
include "theme/script.php";
?>