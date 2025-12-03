<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Kelola Dokter</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <!-- HEADER CARD -->
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title">Data Dokter</h4>
                    <button 
                        class="btn btn-primary btn-round ms-auto"
                        data-bs-toggle="modal"
                        data-bs-target="#addDokterModal">
                        <i class="fa fa-plus"></i> Tambah Dokter
                    </button>
                </div>

                <!-- TABLE DOKTER -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            id="basic-datatables"
                            class="display table table-striped table-hover"
                        >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Dokter</th>
                                    <th>Spesialisasi</th>
                                    <th>Nomor STR</th>
                                    <th>Nomor Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1; foreach ($dataDokter as $dokter): ?>

                                <?php
                                    // AMANKAN DATA DOKTER (menghindari undefined index dan null)
                                    $namaDokter = $dokter['nama']
                                                ?? $dokter['nama_dokter']
                                                ?? '';

                                    $namaSpesialisasi = $dokter['nama_spesialisasi']
                                                ?? $dokter['spesialisasi']
                                                ?? '';

                                    $noStr   = $dokter['no_str']  ?? '';
                                    $noTelp  = $dokter['no_telp'] ?? '';
                                    $dokterId = $dokter['dokter_id'] ?? '';
                                    $spesialisasiId = $dokter['spesialisasi_id'] ?? '';
                                ?>

                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars((string)$namaDokter); ?></td>
                                    <td><?= htmlspecialchars((string)$namaSpesialisasi); ?></td>
                                    <td><?= htmlspecialchars((string)$noStr); ?></td>
                                    <td><?= htmlspecialchars((string)$noTelp); ?></td>
                                    <td>
                                        <!-- EDIT BUTTON -->
                                        <button 
                                            class="btn btn-warning btn-edit"
                                            data-id="<?= $dokterId; ?>"
                                            data-nama="<?= htmlspecialchars((string)$namaDokter); ?>"
                                            data-spesialis_id="<?= $spesialisasiId; ?>"
                                            data-no_str="<?= htmlspecialchars((string)$noStr); ?>"
                                            data-no_telp="<?= htmlspecialchars((string)$noTelp); ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editDokterModal">
                                            <i class="fas fa-pen"></i>
                                        </button>

                                        <!-- DELETE BUTTON -->
                                        <button 
                                            class="btn btn-danger btn-delete"
                                            data-id="<?= $dokterId; ?>"
                                            data-nama="<?= htmlspecialchars((string)$namaDokter); ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteDokterModal">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>

                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>

            <!-- ========================== -->
            <!-- TOMBOL LAPORAN DI BAWAH   -->
            <!-- ========================== -->
            <div class="mt-3 d-flex justify-content-end">
                <a href="index.php?page=laporan-pendapatan-dokter" class="btn btn-outline-primary">
                    <i class="fas fa-chart-bar"></i> Lihat Laporan Pendapatan Dokter
                </a>
            </div>

        </div>
    </div>
</div>
