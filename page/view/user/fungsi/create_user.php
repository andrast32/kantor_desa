<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_user']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['nama_user'])) {
        $id_user    = $_POST['id_user'];
        $username   = $_POST['username'];
        $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $nama_user  = $_POST['nama_user'];

        $stmt = $mysqli->prepare("INSERT INTO user(id_user, username, password, nama_user) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $id_user, $username, $password, $nama_user);

        if ($stmt->execute()) {
            echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'User berhasil disimpan!',
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
                    text: 'User gagal disimpan!',
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
} else {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data tidak lengkap!',
            });
        </script>";
}
?>