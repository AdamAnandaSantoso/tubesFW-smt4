<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pemesanan</h1>
        </div>
        <div class="section-body">

            <!-- Tambahan untuk Input Form -->
            <h4>Form Pemesanan</h4>
            <form method="post" action="<?= base_url('TransPemesanan/add/' . $id_kamar . '/' . $nama_kamar . '/' . $nama_jenis_kamar . '/' . $id_jenis_kamar) ?>" id="payment-form">
    
                    <input type="hidden" id="id_kamar" name="id_kamar" value="<?= $id_kamar ?>">
                    <input type="hidden" id="nama_kamar" name="nama_kamar" value="<?= $nama_kamar ?>">
                    <input type="hidden" id="nama_jenis_kamar" name="nama_jenis_kamar" value="<?= $nama_jenis_kamar ?>">
                    <input type="hidden" id="id_jenis_kamar" name="id_jenis_kamar" value="<?= $id_jenis_kamar ?>">
                    <input type="hidden" name="result_type" id="result-type" value="">
                    <input type="hidden" name="result_data" id="result-data" value="">

                    <div class="col-12 form-group">
                        <label for="id_pasien" class="col-md-6 form-control-md">ID Pasien</label>
                        <div class="col-md-10">
                            <select class="form-control form-control-md" id="id_pasien" name="id_pasien" >
                                <option selected disabled value="">Pilih ID Pasien</option>
                                <?php
                                //looping penghuni
                                foreach ($datapasien as $pasien) :
                                    $id_pasien = $pasien->id_pasien;
                                    $nama_pasien = $pasien->nama_pasien;
                                    if (set_value('id_pasien') == $id_pasien) {
                                ?>
                                        <option value="<?= $id_pasien ?>" selected><?= $id_pasien . ' - ' . $nama_pasien ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?= $id_pasien ?>"><?= $id_pasien . ' - ' . $nama_pasien ?></option>
                                <?php
                                    }
                                endforeach;
                                ?>
                            </select>
                            <div class="invalid-feedback" id="erroridpasien"></div>
                        </div>

                        <?php
                        // contoh mendapatkan error per komponen
                        if (isset($validation)) {
                            if ($validation->getError('id_pasien')) { ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('id_pasien').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('erroridpasien').innerHTML = "<?= $validation->getError('id_pasien'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php
                            } else {
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                            ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is valid
                                    document.getElementById('id_pasien').setAttribute("class", "form-control is-valid");
                                    document.getElementById('erroridpasien').innerHTML = "";
                                    // serta tambahkan div class invalid
                                </script>
                        <?php
                            }
                        } ?>
                    </div>

                    <div class="col-12 form-group">
                        <label class="col-md-6 form-control-md" for="tanggal_pemesanan">Tanggal Pemesanan</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="tanggal_pemesanan" id="tanggal_pemesanan" value="<?= set_value('tanggal_pemesanan') ?>">
                            <div class="invalid-feedback" id="errorinputtanggal"></div>

                            <?php
                            // contoh mendapatkan error per komponen
                            if (isset($validation)) {
                                if ($validation->getError('tanggal_pemesanan')) { ?>
                                    <script>
                                        // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                        document.getElementById('tanggal_pemesanan').setAttribute("class", "form-control is-invalid");
                                        document.getElementById('errorinputtanggal').innerHTML = "<?= $validation->getError('tanggal_pemesanan'); ?>";
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
                        <label for="nominal_pemesanan" class="col-md-4 col-form-label">Nominal Pemesanan</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="nominal_pemesanan" name="nominal_pemesanan" value=" <?= $tarif ?>" readonly>
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
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-tSBB9_Fqw9jii9Ew"></script>
<script type="text/javascript">
    
                $('#pay-button').click(function (event) {
                event.preventDefault();
                $(this).attr("disabled", "disabled");
                
                var id_pasien= $('#id_pasien').val();
                var nominal_pemesanan = $('#nominal_pemesanan').val();    

                $.ajax({
                type: 'POST',  
                url: '<?=base_url()?>/TransPemesanan/token',
                data : {
                    id_pasien: id_pasien, 
                    nominal_pemesanan: nominal_pemesanan
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
