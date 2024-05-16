<?php 
if (isset($_GET['id_surat']) && is_numeric($_GET['id_surat'])) {
    $id_surat = $_GET['id_surat'];

    $stmt = $mysqli->prepare("DELETE FROM surat WHERE id_surat = ?");
    $stmt->bind_param("i", $id_surat);

    if ($stmt->execute()) {
        echo '
            <script>
                swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: "Surat telah dihapus!",
                }).then((result) => {
                    if (result.isConfrimed) {
                        window.location.href = "?surat=data_surat";
                    }
                });
            </script>
        ';
    } else {
        echo '
            <script>
                swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Surat gagal dihapus!"
                });
            </script>
        ';
    }
    $stmt->close();
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Data Surat | <button class="btn btn-info" id="button" data-toggle="modal" data-target="#modal-add">
                                <i class="fas fa-plus"></i>
                                Tambah data surat
                            </button>
                        </h3>
                        <a href="?surat=fungsi/laporan" class="float-right btn btn-info">
                            <i class="fas fa-file-invoice"></i>
                        </a>
                    </div>

                    <div class="card-body">
                        <table id="surat" class="table table-bordered table-hover">
                            <thead class="bg-navy">
                                <tr align="center">
                                    <th>No</th>
                                    <th>Ringkasan</th>
                                    <th>Pengolah</th>
                                    <th>Tanggal Surat</th>
                                    <th>Kepada</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                $surat = $mysqli->query("SELECT * FROM surat ORDER BY id_surat");
                                $no = 0;
                                while ($data = mysqli_fetch_array($surat)) {
                                    $no++;
                                ?>
                                
                                <tr>
                                    <td align="center"><?php echo $no; ?></td>
                                    <td><?php echo $data['ringkasan']; ?></td>
                                    <td><?php echo $data['pengolah']; ?></td>
                                    <td><?php echo $data['tgl_surat']; ?></td>
                                    <td><?php echo $data['kepada']; ?></td>
                                    <td><?php echo $data['ket']; ?></td>
                                    <td align="center">
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-<?php echo $data['id_surat'];?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger" onclick="deleteSurat(<?php echo $data['id_surat'];?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$surat = $mysqli->query("SELECT * FROM surat ORDER BY id_surat");
while ($data = mysqli_fetch_array($surat)) {
?>
<div class="modal fade" id="modal-edit-<?php echo $data['id_surat'];?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit surat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?surat=fungsi/edit_surat" method="post">
                    <div class="form-group">
                        <label for="id_surat">Id surat</label>
                        <input type="text" name="id_surat" id="id_surat" class="form-control" value="<?php echo $data['id_surat']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="ringkasan">Ringkasan <span class="text-danger">*</span></label>
                        <input type="text" name="ringkasan" id="ringkasan" class="form-control" value="<?php echo $data['ringkasan']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="pengolah">Pengolah <span class="text-danger">*</span></label>
                        <input type="text" name="pengolah" id="pengolah" class="form-control" value="<?php echo $data['pengolah']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="tgl_surat">Tanggal Surat <span class="text-danger">*</span></label>
                        <input type="text" name="tgl_surat" id="tgl_surat" class="form-control" value="<?php echo $data['tgl_surat']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="kepada">kepada <span class="text-danger">*</span></label>
                        <input type="text" name="kepada" id="kepada" class="form-control" value="<?php echo $data['kepada']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">keterangan <span class="text-danger">*</span></label>
                        <input type="text" name="ket" id="ket" class="form-control" value="<?php echo $data['ket']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-warning float-right">
                        <input type="reset" value="Reset" class="btn btn-info">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php }?>

<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah surat</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?surat=fungsi/create_surat" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id_surat" id="id_surat" class="form-control" placeholder="Masukan Id Surat" readonly>
                    </div>
                    <div class="form-group">
                        <label for="ringkasan">Ringkasan <span class="text-danger">*</span></label>
                        <input type="text" name="ringkasan" id="ringkasan" class="form-control" placeholder="Masukan ringkasan surat">
                    </div>
                    <div class="form-group">
                        <label for="pengolah">Pengolah <span class="text-danger">*</span></label>
                        <input type="text" name="pengolah" id="pengolah" class="form-control" placeholder="Masukan pengolah surat">
                    </div>
                    <div class="form-group">
                        <label for="tgl_surat">Tanggal Surat <span class="text-danger">*</span></label>
                        <input type="text" name="tgl_surat" id="tgl_surat" class="form-control" placeholder="masukan tanggal surat">
                    </div>
                    <div class="form-group">
                        <label for="kepada">kepada <span class="text-danger">*</span></label>
                        <input type="text" name="kepada" id="kepada" class="form-control" placeholder="masukan kepada siapa surat di tujukan">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">keterangan <span class="text-danger">*</span></label>
                        <input type="text" name="ket" id="ket" class="form-control" placeholder="masukan keterangan">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-info float-right">
                        <input type="reset" value="Reset" class="btn btn-warning">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "fungsi/notif.php";?>