<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pemesanan</h1>
        </div>
        <div class="section-body">

            <!-- Tambahan untuk Input Form -->
            <h4>Pilih Jenis Kamar</h4>

            <div class="row">
                <?php
                $i = 1;
                foreach ($datasatu as $row) :
                    if (fmod($i, 1) == 0) {
                ?>
                        <?php $total = $row->kapasitas;
                        $terpakai = $row->terpakai;
                        $sisa = $total - $terpakai ?>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h4><?= $row->nama_jenis_kamar ?></h4>
                                    <?php if ($sisa == 0) { ?>
                                        <div class="card-header-action">
                                            <a href="<?= base_url('TransPemesanan/add/' . $row->id_kamar . '/' . $row->nama_kamar . '/' . $row->nama_jenis_kamar . '/' . $row->id_jenis_kamar) ?>" class="btn btn-danger disabled">Pesan</a>
                                        </div>
                                    <?php } elseif ($sisa > 0) { ?>

                                        <div class="card-header-action">
                                            <a href="<?= base_url('TransPemesanan/add/' . $row->id_kamar . '/' . $row->nama_kamar . '/' . $row->nama_jenis_kamar . '/' . $row->id_jenis_kamar) ?>" class="btn btn-danger">Pesan</a>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="card-body">
                                    <span class="badge bg-primary rounded-pill" style="color: white;"><b><?= $row->kapasitas ?></b></span>
                                    <span class="badge bg-success rounded-pill" style="color: white;"><b> <?= $row->terpakai ?></b></span>
                                    <span class="badge bg-danger rounded-pill" style="color: white;"><b>
                                            <?= $sisa; ?></b></span>&emsp;
                                    <span class="ms-50"> <a href="<?= base_url('TransPemesanan/ViewData/' . $row->id_kamar . '/' . $row->id_jenis_kamar) ?>"><b>Lihat Data Pemesanan</b></a>
                                    </span>
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
    </section>
</div>