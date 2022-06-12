<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pembayaran</h1>
        </div>
        <div class="section-body">

            <!-- Tambahan untuk Input Form -->
            <h4>Form Pembayaran</h4>
            <form method="post" action="<?= base_url('TransPembayaran/add/' . $id_kamar . '/' . $nama_kamar . '/' . $nama_jenis_kamar . '/' . $id_jenis_kamar) ?>" id="payment-form">
            <input type="hidden" id="id_kamar" name="id_kamar" value="<?= $id_kamar ?>">
            <input type="hidden" id="nama_kamar" name="nama_kamar" value="<?= $nama_kamar ?>">
            <input type="hidden" id="nama_jenis_kamar" name="nama_jenis_kamar" value="<?= $nama_jenis_kamar ?>">
            <input type="hidden" id="id_jenis_kamar" name="id_jenis_kamar" value="<?= $id_jenis_kamar ?>">

            <input type="hidden" name="result_type" id="result-type" value="">
            <input type="hidden" name="result_data" id="result-data" value="">

            <div class="col-12 form-group">
                <label for="id_pasien" class="col-md-6 form-control-md">ID Pemesanan</label>
                <div class="col-md-10">
                    <select class="form-control form-control-md" id="id_pemesanan" name="id_pemesanan">
                        <option selected disabled value="">Pilih ID Pemesanan</option>
                        <?php
                        //looping penghuni
                        foreach ($datapemesanan as $pemesanan) :
                            $nama_pasien = $pemesanan['nama_pasien'];
                            $id_pemesanan = $pemesanan['id_pemesanan'];
                            $tanggal_pemesanan = $pemesanan['tanggal_pemesanan'];
                            if (set_value('id_pemesanan') == $id_pemesanan) {
                        ?>
                                <option value="<?= $id_pemesanan ?>" selected><?= $id_pemesanan . ' - ' . '(' . ($tanggal_pemesanan) . ')'  ?></option>
                            <?php
                            } else {
                            ?>
                                <option value="<?= $id_pemesanan ?>"><?= $id_pemesanan . ' - ' . '(' . ($tanggal_pemesanan) . ')' ?></option>
                        <?php
                            }
                        endforeach;
                        ?>
                    </select>
                    <div class="invalid-feedback" id="erroridpemesanan"></div>
                </div>

                <?php
                // contoh mendapatkan error per komponen
                if (isset($validation)) {
                    if ($validation->getError('id_pemesanan')) { ?>
                        <script>
                            // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                            document.getElementById('id_pemesanan').setAttribute("class", "form-control is-invalid");
                            document.getElementById('erroridpemesanan').innerHTML = "<?= $validation->getError('id_pemesanan'); ?>";
                            // serta tambahkan div class invalid
                        </script>
                    <?php
                    } else {
                        // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                    ?>
                        <script>
                            // modifikasi elemen class input form untuk nama_kos menjadi is valid
                            document.getElementById('id_pemesanan').setAttribute("class", "form-control is-valid");
                            document.getElementById('erroridpemesanan').innerHTML = "";
                            // serta tambahkan div class invalid
                        </script>
                <?php
                    }
                } ?>
            </div>

            <div class="col-12 form-group">
                <label class="col-md-6 form-control-md" for="tanggal_pembayaran">Tanggal Pembayaran</label>
                <div class="col-md-10">
                    <input type="date" class="form-control" name="tanggal_pembayaran" id="tanggal_pembayaran" value="<?= set_value('tanggal_pembayaran') ?>">
                    <div class="invalid-feedback" id="errortanggalpembayaran"></div>

                    <?php
                    // contoh mendapatkan error per komponen
                    if (isset($validation)) {
                        if ($validation->getError('tanggal_pembayaran')) { ?>
                            <script>
                                // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                document.getElementById('tanggal_pembayaran').setAttribute("class", "form-control is-invalid");
                                document.getElementById('errortanggalpembayaran').innerHTML = "<?= $validation->getError('tanggal_pembayaran'); ?>";
                                // serta tambahkan div class invalid
                            </script>
                        <?php
                        } else {
                            // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                        ?>
                            <script>
                                // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                document.getElementById('tanggal_pembayaran').setAttribute("class", "form-control is-valid");
                                document.getElementById('errortanggalpembayaran').innerHTML = "";
                                // serta tambahkan div class is valid
                            </script>
                    <?php
                        }
                    } ?>
                </div>
            </div>

            <div class="col-12 form-group">
                <label for="total_rawat" class="col-md-4 col-form-label">Total Rawat</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="total_rawat" name="total_rawat" placeholder="Masukkan Jumlah Hari" onchange="myFunction()">
                    <div class=" invalid-feedback" id="errortotalrawat">
                    </div>

                    <?php
                    // contoh mendapatkan error per komponen
                    if (isset($validation)) {
                        if ($validation->getError('total_rawat')) { ?>
                            <script>
                                // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                document.getElementById('total_rawat').setAttribute("class", "form-control is-invalid");
                                document.getElementById('errortotalrawat').innerHTML = "<?= $validation->getError('total_rawat'); ?>";
                                // serta tambahkan div class invalid
                            </script>
                        <?php
                        } else {
                            // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                        ?>
                            <script>
                                // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                document.getElementById('total_rawat').setAttribute("class", "form-control is-valid");
                                document.getElementById('errortotalrawat').innerHTML = "";
                                // serta tambahkan div class is valid
                            </script>
                    <?php
                        }
                    } ?>

                </div>
            </div>

            <div class="col-12 form-group">
                <label for="nilai_pembayaran" class="col-md-4 col-form-label">Nilai Pembayaran</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="nilai_pembayaran" name="nilai_pembayaran" value=" <?= number_format($tarif) ?>" readonly>
                </div>
            </div>

            <div class="col-12 form-group">
                <label for="nominal_pembayaran" class="col-md-4 col-form-label">Nominal Pembayaran</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="nominal_pembayaran" name="nominal_pembayaran" placeholder="Masukkan Nominal Pembayaran" readonly>
                    <div class="invalid-feedback" id="errornominalpembayaran"></div>

                    <?php
                    // contoh mendapatkan error per komponen
                    if (isset($validation)) {
                        if ($validation->getError('nominal_pembayaran')) { ?>
                            <script>
                                // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                document.getElementById('nominal_pembayaran').setAttribute("class", "form-control is-invalid");
                                document.getElementById('errornominalpembayaran').innerHTML = "<?= $validation->getError('nominal_pembayaran'); ?>";
                                // serta tambahkan div class invalid
                            </script>
                        <?php
                        } else {
                            // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                        ?>
                            <script>
                                // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                document.getElementById('nominal_pembayaran').setAttribute("class", "form-control is-valid");
                                document.getElementById('errornominalpembayaran').innerHTML = "";
                                // serta tambahkan div class is valid
                            </script>
                    <?php
                        }
                    } ?>

                </div>
                <br>
                <div class="col-md-4">
                    <div class="col-md-2"></div>
                    <button id="pay-button" type="submit" class="col-md-4 btn btn-success">Submit</button>
                    <div class="col-md-2"></div>
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

        var total_rawat = parseInt($("#total_rawat").val())
        var nilai_pembayaran = parseInt($("#nilai_pembayaran").val())
        harga_awal_bersih = "<?php echo $tarif; ?>";

        var hasil = number_format(total_rawat * harga_awal_bersih);
        $("#nominal_pembayaran").attr("value", hasil);
    }
</script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-tSBB9_Fqw9jii9Ew"></script>
<script type="text/javascript">
    
                $('#pay-button').click(function (event) {
                event.preventDefault();
                $(this).attr("disabled", "disabled");
                
                var id_pemesanan= $('#id_pemesanan').val();
                var nominal_pembayaran = $('#nominal_pembayaran').val();    

                $.ajax({
                type: 'POST',  
                url: '<?=base_url()?>/TransPembayaran/token',
                data : {
                    id_pemesanan: id_pemesanan, 
                    nominal_pembayaran: nominal_pembayaran
                },
                cache: false,

                success: function(data) {
                    //location = data;

                    console.log('token = '+data);
                    
                    var resultType = document.getElementById('result-type');
                    var resultData = document.getElementById('result-data');

                    function changeResult(type,data){
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                    //resultType.innerHTML = type;
                    //resultData.innerHTML = JSON.stringify(data);
                    }

                    snap.pay(data, {
                    
                    onSuccess: function(result){
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result){
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result){
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                    });
                }
                });
            });

    </script>
<script>
    $('select').select2();
</script>
<script>
    $('select').selectric({
        maxHeight: 200
    });
</script>