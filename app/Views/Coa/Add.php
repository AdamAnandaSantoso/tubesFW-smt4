<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Chart Of Account</h1>
        </div>
        <div class="section-body">

            <!-- Tambahan untuk Input Form -->
            <h4>Tambah Data Akun</h4>
            <form class="row g-3 needs-validation" action="<?= base_url('coa/add') ?>" method="post" novalidate>
                <div class="col-12 ">
                    <label for="kode_akun" class="col-md-4 col-form-label">Kode Akun</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="kode_akun" name="kode_akun" value="<?= set_value('kode_akun') ?>" placeholder="Masukkan Kode Akun">
                        <div class="invalid-feedback" id="errorkodeakun"></div>

                        <?php
                        // contoh mendapatkan error per komponen
                        if (isset($validation)) {
                            if ($validation->getError('kode_akun')) { ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('kode_akun').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorkodeakun').innerHTML = "<?= $validation->getError('kode_akun'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php
                            } else {
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                            ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('kode_akun').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorkodeakun').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                        <?php
                            }
                        } ?>

                    </div>
                </div>

                <div class="col-12">
                    <label for="nama_akun" class="col-md-4 col-form-label">Nama Akun</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="nama_akun" name="nama_akun" value="<?= set_value('nama_akun') ?>" placeholder="Masukkan Nama Akun">
                        <div class="invalid-feedback" id="errornamaakun"></div>

                        <?php
                        // contoh mendapatkan error per komponen
                        if (isset($validation)) {
                            if ($validation->getError('nama_akun')) { ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('nama_akun').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errornamaakun').innerHTML = "<?= $validation->getError('nama_akun'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php
                            } else {
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                            ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('nama_akun').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errornamakun').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                        <?php
                            }
                        } ?>

                    </div>
                </div>

                <div class="col-md-12">
                    <label for="header_akun" class="col-md-6 col-form-label">Header Akun</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="header_akun" name="header_akun" value="<?= set_value('header_akun') ?>" placeholder="Masukkan Header Akun">
                        <div class="invalid-feedback" id="errorheaderakun"></div>
                        <?php
                        // contoh mendapatkan error per komponen
                        if (isset($validation)) {
                            if ($validation->getError('header_akun')) { ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('header_akun').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorheaderakun').innerHTML = "<?= $validation->getError('header_akun'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php
                            } else {
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                            ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is valid
                                    document.getElementById('header_akun').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorheaderakun').innerHTML = "";
                                    // serta tambahkan div class invalid
                                </script>
                        <?php
                            }
                        } ?>

                    </div>
                    <br>
                    <div class="col-md-4">
                        <div class="col-md-2"></div>
                        <input class="col-md-4 btn btn-success" type="submit" value="Input">
                        <div class="col-md-2"></div>
                    </div>

                </div>

                <!-- <div class="col-md-4">
                <div class="col-md-2"></div>
                <input class="col-md-4 btn btn-success" type="submit" value="Input">
                <div class="col-md-2"></div>
            </div> -->

                <!-- <div class="mb-3 row"> -->
                <?php
                //if (isset($validation)) {
                ?>
                <!-- <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <div> -->
                <?php //$validation->listErrors(); 
                ?>
                <!-- </div>
                </div> -->
                <?php
                // }
                ?>
                <!-- </div> -->

            </form>
            <!-- Akhir tambahan untuk card -->


        </div>
    </section>
</div>