<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_surat']) && isset($_POST['ringkasan']) && isset($_POST['pengolah']) && isset($_POST['tgl_surat']) && isset($_POST['kepada']) && isset($_POST['ket'])) {

        $id_surat   = $_POST['id_surat'];
        $ringkasan  = $_POST['ringkasan'];
        $pengolah   = $_POST['pengolah'];
        $tgl_surat  = $_POST['tgl_surat'];
        $kepada     = $_POST['kepada'];
        $ket        = $_POST['ket'];

        $stmt = $mysqli->prepare("INSERT INTO surat(id_surat, ringkasan, pengolah, tgl_surat, kepada, ket) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $id_surat, $ringkasan, $pengolah, $tgl_surat, $kepada, $ket);
        if ($stmt->execute()) {
            echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Surat berhasil disimpan!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = '?surat=data_surat';
                    });
                </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Surat gagal disimpan!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = '?surat=data_surat';
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
                window.location.href = '?surat=data_surat';
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