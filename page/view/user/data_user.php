<?php 
if (isset($_GET['id_user']) && is_numeric($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    $stmt = $mysqli->prepare("DELETE FROM user WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);

    if ($stmt->execute()) {
        echo '
        <script>
            swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "User telah dihapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "?user=data_user";
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
                text: "User gagal dihapus!",
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
                            Data User | <button class="btn btn-info" id="button" data-toggle="modal" data-target="#modal-add">
                                <i class="fas fa-plus"> </i>
                                    Tambah Data User
                            </button>
                        </h3>
                    </div>

                    <div class="card-body">
                        <table id="user" class="table table-bordered table-hover">
                            <thead class="bg-navy">
                                <tr align="center">
                                    <th>No</th>
                                    <th>Id user</th>
                                    <th>Username</th>
                                    <th>Nama User</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                $user = $mysqli->query("SELECT * FROM user ORDER BY id_user");
                                $no = 0;
                                while ($data = mysqli_fetch_array($user)) {
                                    $no++;
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $no; ?></td> 
                                        <td><?php echo $data['id_user']; ?></td> 
                                        <td><?php echo $data['username']; ?></td> 
                                        <td><?php echo $data['nama_user']; ?></td>
                                        <td align="center">
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-<?php echo $data['id_user']; ?>">
                                            <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger" onclick="deleteUser(<?php echo $data['id_user']; ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td> 
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
$user = $mysqli->query("SELECT * FROM user ORDER BY id_user");
while ($data = mysqli_fetch_array($user)) {
?>
<div class="modal fade" id="modal-edit-<?php echo $data['id_user']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?user=fungsi/edit_user" method="post">
                    <div class="form-group">
                        <label for="id_user">Id User</label>
                        <input type="text" name="id_user" id="id_user" class="form-control" value="<?php echo $data['id_user']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="username">username <span class="text-danger">*</span></label>
                        <input type="text" name="username" id="username" class="form-control" value="<?php echo $data['username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukan Password" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_user">nama_user <span class="text-danger">*</span></label>
                        <input type="text" name="nama_user" id="nama_user" class="form-control" value="<?php echo $data['nama_user']; ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-warning float-right" value="Submit">
                        <input type="reset" class="btn btn-info" value="Reset">
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
                <h4 class="modal-title">Tambah Data User</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?user=fungsi/create_user" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id_user" id="id_user" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Masukan Username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukan Password" required>
                    </div>
                    <div class="form-group">
                        <label for="nama user">nama User <span class="text-danger">*</span></label>
                        <input type="text" name="nama_user" id="nama_user" class="form-control" placeholder="Masukan nama User" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary float-right" value="Submit">
                        <input type="reset" class="btn btn-warning" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
include "fungsi/notif.php";
?>