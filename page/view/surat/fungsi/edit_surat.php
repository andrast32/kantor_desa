<?php 
    if (isset($_POST['id_surat'], $_POST['ringkasan'], $_POST['pengolah'], $_POST['tgl_surat'], $_POST['kepada'], $_POST['ket'])) {

        $id_surat   = $_POST['id_surat'];
        $ringkasan  = $_POST['ringkasan'];
        $pengolah   = $_POST['pengolah'];
        $tgl_surat  = $_POST['tgl_surat'];
        $kepada     = $_POST['kepada'];
        $ket        = $_POST['ket'];

        $stmt = $mysqli->prepare("UPDATE surat SET ringkasan = ?, pengolah = ?, tgl_surat = ?, kepada = ?, ket = ? WHERE id_surat = ?");

        $stmt->bind_param("ssssss", $ringkasan, $pengolah, $tgl_surat, $kepada, $ket, $id_surat);

        if ($stmt->execute()) {
            echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Surat berhasil diubah!',
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
                    text: 'Surat gagal diubah!',
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
?>