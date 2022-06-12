<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pembayaran</h1>
        </div>
        <div class="section-body">

            <!-- Tambahan untuk Input Form -->
            <h4>Form Penggajian</h4>
            <?= form_open('TransGaji/add/' . $id_kamar . '/' . $nama_kamar . '/' . $nama_jenis_kamar . '/' . $id_jenis_kamar) ?>
            <input type="hidden" id="id_kamar" name="id_kamar" value="<?= $id_kamar ?>">
            <input type="hidden" id="nama_kamar" name="nama_kamar" value="<?= $nama_kamar ?>">
            <input type="hidden" id="nama_jenis_kamar" name="nama_jenis_kamar" value="<?= $nama_jenis_kamar ?>">
            <input type="hidden" id="id_jenis_kamar" name="id_jenis_kamar" value="<?= $id_jenis_kamar ?>">

            <div class="col-12 form-group">
                <label for="id_pasien" class="col-md-6 form-control-md">ID Petugas</label>
                <div class="col-md-10">
                    <select class="form-control form-control-md" id="id_petugas" name="id_petugas">
                        <option selected disabled value="">Pilih ID Petugas</option>
                        <?php
                        //looping penghuni
                        foreach ($datapetugas as $petugas) :
                            $nama_petugas = $petugas['nama_petugas'];
                            $id_petugas = $petugas['id_petugas'];
                            if (set_value('id_petugas') == $id_petugas) {
                        ?>
                                <option value="<?= $id_petugas ?>" selected><?= $id_petugas . ' - ' . $nama_petugas ?></option>
                            <?php
                            } else {
                            ?>
                                <option value="<?= $id_petugas ?>"><?= $id_petugas . ' - ' . $nama_petugas ?></option>
                        <?php
                            }
                        endforeach;
                        ?>
                    </select>
                    <div class="invalid-feedback" id="erroridpetugas"></div>
                </div>

                <?php
                // contoh mendapatkan error per komponen
                if (isset($validation)) {
                    if ($validation->getError('id_petugas')) { ?>
                        <script>
                            // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                            document.getElementById('id_petugas').setAttribute("class", "form-control is-invalid");
                            document.getElementById('erroridpemesanan').innerHTML = "<?= $validation->getError('id_petugas'); ?>";
                            // serta tambahkan div class invalid
                        </script>
                    <?php
                    } else {
                        // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                    ?>
                        <script>
                            // modifikasi elemen class input form untuk nama_kos menjadi is valid
                            document.getElementById('id_petugas').setAttribute("class", "form-control is-valid");
                            document.getElementById('erroridpemesanan').innerHTML = "";
                            // serta tambahkan div class invalid
                        </script>
                <?php
                    }
                } ?>
            </div>

            <div class="col-12 form-group">
                <label class="col-md-6 form-control-md" for="tanggal_gaji">Tanggal Gaji</label>
                <div class="col-md-10">
                    <input type="date" class="form-control" name="tanggal_gaji" id="tanggal_gaji" value="<?= set_value('tanggal_gaji') ?>">
                    <div class="invalid-feedback" id="errortanggalgaji"></div>

                    <?php
                    // contoh mendapatkan error per komponen
                    if (isset($validation)) {
                        if ($validation->getError('tanggal_gaji')) { ?>
                            <script>
                                // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                document.getElementById('tanggal_gaji').setAttribute("class", "form-control is-invalid");
                                document.getElementById('errortanggalpembayaran').innerHTML = "<?= $validation->getError('tanggal_gaji'); ?>";
                                // serta tambahkan div class invalid
                            </script>
                        <?php
                        } else {
                            // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                        ?>
                            <script>
                                // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                document.getElementById('tanggal_gaji').setAttribute("class", "form-control is-valid");
                                document.getElementById('errortanggalpembayaran').innerHTML = "";
                                // serta tambahkan div class is valid
                            </script>
                    <?php
                        }
                    } ?>
                </div>
            </div>
            <div class="col-12 form-group">
                <label for="total_hari_kerja" class="col-md-4 col-form-label">Total Hari Kerja</label>
                <div class="col-md-10">
                    <input type="number" class="form-control" id="total_hari_kerja" name="total_hari_kerja" placeholder="Masukkan Jumlah Hari" onkeyup="myFunction();">
                    <div class=" invalid-feedback" id="errortotalrawat">
                    </div>

                    <?php
                    // contoh mendapatkan error per komponen
                    if (isset($validation)) {
                        if ($validation->getError('total_hari_kerja')) { ?>
                            <script>
                                // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                document.getElementById('total_hari_kerja').setAttribute("class", "form-control is-invalid");
                                document.getElementById('errortotalrawat').innerHTML = "<?= $validation->getError('total_hari_kerja'); ?>";
                                // serta tambahkan div class invalid
                            </script>
                        <?php
                        } else {
                            // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                        ?>
                            <script>
                                // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                document.getElementById('total_hari_kerja').setAttribute("class", "form-control is-valid");
                                document.getElementById('errortotalrawat').innerHTML = "";
                                // serta tambahkan div class is valid
                            </script>
                    <?php
                        }
                    } ?>

                </div>
            </div>

            <div class="col-12 form-group">
                <label for="nominal_gaji" class="col-md-4 col-form-label">Nominal Gaji</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="nominal_gaji" name="nominal_gaji" readonly>
                    <div class="invalid-feedback" id="errornominalgaji"></div>

                    <?php
                    // contoh mendapatkan error per komponen
                    if (isset($validation)) {
                        if ($validation->getError('nominal_gaji')) { ?>
                            <script>
                                // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                document.getElementById('nominal_gaji').setAttribute("class", "form-control is-invalid");
                                document.getElementById('errornominalgaji').innerHTML = "<?= $validation->getError('nominal_gaji'); ?>";
                                // serta tambahkan div class invalid
                            </script>
                        <?php
                        } else {
                            // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                        ?>
                            <script>
                                // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                document.getElementById('nominal_gaji').setAttribute("class", "form-control is-valid");
                                document.getElementById('errornominalgaji').innerHTML = "";
                                // serta tambahkan div class is valid
                            </script>
                    <?php
                        }
                    } ?>

                </div>
                <br>
                <div class="col-md-4">
                    <div class="col-md-2"></div>
                    <button type="submit" class="col-md-4 btn btn-success">Submit</button>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
        </form>
</div>
</section>
</div>
<script>
    function number_format(number, decimals, decPoint, thousandsSep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
        var n = !isFinite(+number) ? 0 : +number
        var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
        var sep = (typeof thousandsSep === 'undefined') ? '.' : thousandsSep
        var dec = (typeof decPoint === 'undefined') ? ',' : decPoint
        var s = ''
        var toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec)
            return '' + (Math.round(n * k) / k)
                .toFixed(prec)
        }
        // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
        }

        return s.join(dec)
    }
    //fungsi ini akan terpicu jika ada perubahan nilai pada elemen combo box 
    function myFunction() {
        var total_hari_kerja = parseInt($("#total_hari_kerja").val())

        var hasil = number_format(total_hari_kerja * 150000);
        $("#nominal_gaji").attr("value", hasil);
    }
</script>
<!-- <script type="text/javascript">
    function number_format(number, decimals, decPoint, thousandsSep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
        var n = !isFinite(+number) ? 0 : +number
        var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
        var sep = (typeof thousandsSep === 'undefined') ? '.' : thousandsSep
        var dec = (typeof decPoint === 'undefined') ? ',' : decPoint
        var s = ''
        var toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec)
            return '' + (Math.round(n * k) / k)
                .toFixed(prec)
        }
        // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
        }

        return s.join(dec)
    }
    // $(".perhitungan").keyup(function() {
    //     var bil1 = parseInt($("#bil1").val())
    //     var bil2 = parseInt($("#bil2").val())

    //     var hasil = number_format(bil1 * 150000);
    //     $("#nominal_gaji").attr("value", hasil)
    // });
</script> -->



<!-- <script>
    $('select').select2();
</script>
<script>
    $('select').selectric({
        maxHeight: 200
    });
</script> -->