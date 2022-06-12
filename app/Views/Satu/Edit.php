<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Satu</h1>
        </div>

        <div class="section-body">
            <!-- Tambahan untuk Input Form -->
            <h4>Edit Data Satu</h4>
        </div>


        <?php
        foreach ($datasatu as $row) {
            $id_satu = $row->id_satu;
            $input_text = $row->input_text;
            $input_radio = $row->input_radio;
            $input_combo = $row->input_combo;
            $input_tanggal = $row->input_tanggal;
            $input_uang = $row->input_uang;
            $input_foto = $row->input_foto;
            $input_dokumen = $row->input_dokumen;
        }
        ?>
        <?php
        $array_hobi = array();
        foreach ($datasatudetail as $row) {
            $id_satu = $row->id_satu;
            array_push($array_hobi, $row->input_check);
        }
        ?>

        <?= form_open_multipart('Satu/update') ?>

        <input type="hidden" id="id_satu" name="id_satu" value="<?= $id_satu ?>">
        <input type="hidden" id="foto_lama" name="foto_lama" value="<?= $input_foto ?>">
        <input type="hidden" id="dokumen_lama" name="dokumen_lama" value="<?= $input_dokumen ?>">

        <!-- <div class="col-12 form-group">
                <div class="col-md-10">
                    <label for="id_satu" class="col-md-4 col-form-label">ID</label>

                    <input type="text" id="id_satu" name="id_satu" class="form-control" value="<?= $id_satu ?>" readonly>

                </div>
            </div> -->

        <div class="col-12 form-group">
            <label for="input_text" class="col-md-4 col-form-label">Input Text</label>
            <div class="col-md-10">

                <?php
                //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                if (strlen(set_value('input_text')) > 0) {
                    $input_text = set_value('input_text');
                }
                ?>

                <input type="text" class="form-control" id="input_text" name="input_text" value="<?= $input_text; ?>" placeholder="Masukkan Kode Akun">
                <div class="invalid-feedback" id="errorinputtext"></div>

                <?php
                // contoh mendapatkan error per komponen
                if (isset($validation)) {
                    if ($validation->getError('input_text')) { ?>
                        <script>
                            // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                            document.getElementById('input_text').setAttribute("class", "form-control is-invalid");
                            document.getElementById('errorinputtext').innerHTML = "<?= $validation->getError('input_text'); ?>";
                            // serta tambahkan div class invalid
                        </script>
                    <?php
                    } else {
                        // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                    ?>
                        <script>
                            // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                            document.getElementById('input_text').setAttribute("class", "form-control is-valid");
                            document.getElementById('errorinputtext').innerHTML = "";
                            // serta tambahkan div class is valid
                        </script>
                <?php
                    }
                } ?>

            </div>
        </div>


        <div class="col-12 form-group">
            <label class="col-md-4 col-form-label d-block" for="input_radio">Input Radio</label>
            <div class="col-md-10">
                <div class="form-check">

                    <?php
                    //memberi notasi checked jika sudah dipilih
                    $pria = "";
                    $wanita = "";
                    if (strlen(set_value('input_radio')) > 0) {
                        $input_radio = set_value('input_radio');
                    }
                    if ($input_radio == 'pria') {
                        $pria = "checked";
                    } elseif ($input_radio == 'wanita') {
                        $wanita = "checked";
                    }

                    ?>
                    <?php
                    //memberi notasi checked jika sudah dipilih
                    // $pria = "";
                    // $wanita = "";
                    // if (set_value('input_radio') == 'pria') {
                    //     $pria = "checked";
                    // } elseif (set_value('input_radio') == 'wanita') {
                    //     $wanita = "checked";
                    // }

                    ?>
                    <input class="form-check-input" type="radio" id="pria" name="input_radio" value="pria" <?= $pria ?>><label class=" form-check-label" for="pria">Pria</label><br>
                    <input class="form-check-input" type="radio" id="wanita" name="input_radio" value="wanita" <?= $wanita ?>><label class=" form-check-label" for="wanita">Wanita</label><br>

                </div>

            </div>
        </div>


        <div class="col-12 form-group">
            <label class="col-md-4 col-form-label d-block">Input Checkbox</label>
            <div class="col-md-10">

                <!-- 
                    <input type="checkbox" id="hobi[]" name="hobi[]" value="Musik" <?= in_array("Musik", $array_hobi) ? "checked" : ""; ?>><label for="hobi1"> Musik</label><br>
                    <input type="checkbox" id="hobi[]" name="hobi[]" value="Renang" <?= in_array("Renang", $array_hobi) ? "checked" : ""; ?>><label for="hobi2"> Renang</label><br>
                    <input type="checkbox" id="hobi[]" name="hobi[]" value="Badminton" <?= in_array("Badminton", $array_hobi) ? "checked" : ""; ?>><label for="hobi3"> Badminton</label><br><br> -->

                <?php
                //print_r(set_value('input_check'));
                $a  = set_value('input_check');
                if (is_array($a)) {
                ?><div class="form-check">
                        <input class="form-check-input" type="checkbox" id="hobi1" name="input_check[]" value="Musik" <?= in_array("Musik", set_value('input_check')) ? "checked" : ""; ?>><label class="form-check-label" for="hobi1"> Musik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="hobi2" name="input_check[]" value="Renang" <?= in_array("Renang", set_value('input_check')) ? "checked" : ""; ?>><label class="form-check-label" for="hobi2"> Renang</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="hobi3" name="input_check[]" value="Badminton" <?= in_array("Badminton", set_value('input_check')) ? "checked" : ""; ?>><label class="form-check-label" for="hobi3"> Badminton</label>
                    </div>
                <?php
                } else {
                ?><div class="form-check">
                        <input class="form-check-input" type="checkbox" id="hobi1" name="input_check[]" value="Musik" <?= in_array("Musik", $array_hobi) ? "checked" : ""; ?>><label class="form-check-label" for="hobi1"> Musik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="hobi2" name="input_check[]" value="Renang" <?= in_array("Renang", $array_hobi) ? "checked" : ""; ?>><label class="form-check-label" for="hobi2"> Renang</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="hobi3" name="input_check[]" value="Badminton" <?= in_array("Badminton", $array_hobi) ? "checked" : ""; ?>><label class="form-check-label" for="hobi3"> Badminton</label>
                    </div> <?php
                        }
                            ?>
            </div>
        </div>


        <div class="col-12 form-group">
            <label for="input_combo" class="col-md-6 form-control-md">Input Combo Box</label>
            <div class="col-md-10">
                <select class="form-control form-control-md" id="input_combo" name="input_combo">
                    <?php
                    //jika set value jeniskosan tidak kosong maka isi $nama diganti dengan isian dari user
                    if (strlen(set_value('input_combo')) > 0) {
                        $input_combo = set_value('input_combo');
                    }
                    $bandung = "";
                    $jakarta = "";
                    if ($input_combo == 'Bandung') {
                        $bandung = "selected";
                    } elseif ($input_combo == 'Jakarta') {
                        $jakarta = "selected";
                    } else {
                        $cm = "selected";
                    }

                    ?>
                    <option selected disabled value="">Pilih Kota</option>
                    <option value="Bandung" <?= $bandung ?> <?= set_value('input_combo') == 'Bandung' ? 'selected' : ''; ?>>Bandung</option>
                    <option value="Jakarta" <?= $jakarta ?> <?= set_value('input_combo') == 'Jakarta' ? 'selected' : ''; ?>>Jakarta</option>
                </select>
                <div class="invalid-feedback" id="errorinputcombo"></div>


                <?php
                // contoh mendapatkan error per komponen
                if (isset($validation)) {
                    if ($validation->getError('input_combo')) { ?>
                        <script>
                            // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                            document.getElementById('input_combo').setAttribute("class", "form-control is-invalid");
                            document.getElementById('errorinputcombo').innerHTML = "<?= $validation->getError('input_combo'); ?>";
                            // serta tambahkan div class invalid
                        </script>
                    <?php
                    } else {
                        // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                    ?>
                        <script>
                            // modifikasi elemen class input form untuk nama_kos menjadi is valid
                            document.getElementById('input_combo').setAttribute("class", "form-control is-valid");
                            document.getElementById('errorinputcombo').innerHTML = "";
                            // serta tambahkan div class invalid
                        </script>
                <?php
                    }
                } ?>
            </div>
        </div>



        <!-- <div class="section-title">Select</div>
            <div class="form-group">
                <label>Select <code>.form-control-sm</code></label>
                <select class="form-control form-control-sm">
                    <option>Option 1</option>
                    <option>Option 2</option>
                    <option>Option 3</option>
                </select>
            </div> -->

        <div class="col-12 form-group">
            <label class="col-md-6 form-control-md" for="input_tangal">Input Tanggal</label>
            <div class="col-md-10">
                <input type="date" class="form-control" name="input_tanggal" id="input_tanggal" value="<?= $input_tanggal ?>">
                <div class="invalid-feedback" id="errorinputtanggal"></div>

                <?php
                // contoh mendapatkan error per komponen
                if (isset($validation)) {
                    if ($validation->getError('input_tanggal')) { ?>
                        <script>
                            // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                            document.getElementById('input_tanggal').setAttribute("class", "form-control is-invalid");
                            document.getElementById('errorinputtanggal').innerHTML = "<?= $validation->getError('input_tanggal'); ?>";
                            // serta tambahkan div class invalid
                        </script>
                    <?php
                    } else {
                        // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                    ?>
                        <script>
                            // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                            document.getElementById('input_tanggal').setAttribute("class", "form-control is-valid");
                            document.getElementById('errorinputtangal').innerHTML = "";
                            // serta tambahkan div class is valid
                        </script>
                <?php
                    }
                } ?>
            </div>
        </div>








        <div class="col-12 form-group">
            <label for="input_uang" class="col-md-4 col-form-label">Input Uang</label>
            <div class="col-md-10">
                <?php
                //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                if (strlen(set_value('input_uang')) > 0) {
                    $input_uang = set_value('input_uang');
                }
                ?>
                <input type="text" class="form-control" id="input_uang" name="input_uang" value=" <?= $input_uang ?> " placeholder="Masukkan Kode Akun">
                <div class="invalid-feedback" id="errorinputuang"></div>

                <?php
                // contoh mendapatkan error per komponen
                if (isset($validation)) {
                    if ($validation->getError('input_uang')) { ?>
                        <script>
                            // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                            document.getElementById('input_uang').setAttribute("class", "form-control is-invalid");
                            document.getElementById('errorinputuang').innerHTML = "<?= $validation->getError('input_uang'); ?>";
                            // serta tambahkan div class invalid
                        </script>
                    <?php
                    } else {
                        // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                    ?>
                        <script>
                            // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                            document.getElementById('input_uang').setAttribute("class", "form-control is-valid");
                            document.getElementById('errorinputuang').innerHTML = "";
                            // serta tambahkan div class is valid
                        </script>
                <?php
                    }
                } ?>

            </div>
        </div>

        <div class="col-12 form-group">
            <label for="input_foto" class="col-md-4 col-form-label">Input Foto <a href="<?php echo base_url('images/upload/' . $input_foto) ?>" target="_blank"><b>&emsp;(Foto Sebelumnya)</b>
                    <!-- <img src="<?php echo base_url('images/upload/' . $input_foto) ?>" class="img-thumbnail" width="100"> -->
                </a></label>
            <div class="col-md-10">
                <?php
                //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                if (strlen(set_value('input_foto')) > 0) {
                    $input_foto = set_value('input_foto');
                }
                ?>
                <input type="file" class="form-control" id="input_foto" name="input_foto" value="<?= $input_foto ?>">
                <div class="invalid-feedback" id="errorinputfoto"></div>
                <?php
                // contoh mendapatkan error per komponen
                if (isset($validation)) {
                    if ($validation->getError('input_foto')) { ?>
                        <script>
                            // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                            document.getElementById('input_foto').setAttribute("class", "form-control is-invalid");
                            document.getElementById('errorinputfoto').innerHTML = "<?= $validation->getError('input_foto'); ?>";
                            // serta tambahkan div class invalid
                        </script>
                    <?php
                    } else {
                        // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                    ?>
                        <script>
                            // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                            document.getElementById('input_foto').setAttribute("class", "form-control is-valid");
                            document.getElementById('errorinputfoto').innerHTML = "";
                            // serta tambahkan div class is valid
                        </script>
                <?php
                    }
                } ?>

            </div>
        </div>

        <div class="col-12 form-group">
            <label for="input_dokumen" class="col-md-4 col-form-label">Input Dokumen <a href="<?php echo base_url('dokumen/upload/' . $input_dokumen) ?>" target="_blank"><b>&emsp;(Dokumen Sebelumnya)</b>
                    <!-- <img src="<?php echo base_url('dokumen/upload/' . $input_dokumen) ?>" class="img-thumbnail" width="100"> -->
                </a></label>
            <div class="col-md-10">
                <input type="file" class="form-control" id="input_dokumen" name="input_dokumen" value=" <?= $input_foto ?> ">
                <div class="invalid-feedback" id="errorinputdokumen"></div>

                <?php
                // contoh mendapatkan error per komponen
                if (isset($validation)) {
                    if ($validation->getError('input_dokumen')) { ?>
                        <script>
                            // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                            document.getElementById('input_dokumen').setAttribute("class", "form-control is-invalid");
                            document.getElementById('errorinputdokumen').innerHTML = "<?= $validation->getError('input_dokumen'); ?>";
                            // serta tambahkan div class invalid
                        </script>
                    <?php
                    } else {
                        // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                    ?>
                        <script>
                            // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                            document.getElementById('input_dokumen').setAttribute("class", "form-control is-valid");
                            document.getElementById('errorinputdokumen').innerHTML = "";
                            // serta tambahkan div class is valid
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

</div>
</section>
</div>