<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Penggajian</h1>
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
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h4><?= $row->nama_jenis_kamar ?></h4>
                                    <div class="card-header-action">
                                        <a href="<?= base_url('TransGaji/add/' . $row->id_kamar . '/' . $row->nama_kamar . '/' . $row->nama_jenis_kamar . '/' . $row->id_jenis_kamar) ?>" class="btn btn-danger">Pesan</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p>Write something here</p>
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