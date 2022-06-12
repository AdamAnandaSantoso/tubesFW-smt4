<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Penggajian</h1>
        </div>
        <div class="section-body">

            <!-- Tambahan untuk Input Form -->
            <h4>Pilih Kamar</h4>
            <div class="row">
                <?php
                $i = 1;
                foreach ($datakamar as $row) :
                    if (fmod($i, 4) == 0) {
                ?>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h4><?= $row->nama_kamar ?></h4>
                                    <div class="card-header-action">
                                        <a href="<?= base_url('TransGaji/ViewKamar/' . $row->nama_kamar) ?>" class="btn btn-danger">
                                            View All
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h6><?= $row->kategori_kamar ?></h6>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                    $i = $i + 1;
                endforeach;
                //echo count($koskosan);
                ?>
            </div>
            <!-- Tambahan Sweet Alert -->
            <?php
            // jika session status_dml ada isinya maka tampilkan alert menggunakan sweet alert
            if (session()->has("status_dml")) {
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '<?= session("status_dml"); ?>'
                    });
                </script>
            <?php
            }
            ?>

            <!-- Akhir Tambahan Sweet Alert -->
    </section>
</div>