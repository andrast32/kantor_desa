<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Data Surat 
                        </h3>
                    </div>

                    <div class="card-body">
                        <table id="laporan" class="table table-bordered table-hover">
                            <thead class="bg-navy">
                                <tr align="center">
                                    <th>No</th>
                                    <th>Ringkasan</th>
                                    <th>Pengolah</th>
                                    <th>Tanggal Surat</th>
                                    <th>Kepada</th>
                                    <th>Keterangan</th>
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