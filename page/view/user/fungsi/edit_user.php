<?php 
if (isset($_POST['id_user'], $_POST['username'], $_POST['password'], $_POST['nama_user'])) {

    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama_user = $_POST['nama_user'];

    $stmt = $mysqli->prepare("UPDATE user SET username = ?, password = ?, nama_user = ? WHERE id_user = ?");

    $stmt->bind_param("ssss", $username, $password, $nama_user, $id_user);

    if ($stmt->execute()) {
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'User berhasil diubah!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = '?user=data_user';
                });
            </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'User gagal diubah!',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = '?user=data_user';
            });
        </script>";
    }
    $stmt->close();
    
} else {
echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Data tidak lengkap!',
            showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = '?user=data_user';
        });
    </script>";
}
?>