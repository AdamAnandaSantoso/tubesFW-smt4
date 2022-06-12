<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan</h1>
        </div>
        <div class="section-body">

            <!-- Tambahan untuk Input Form -->
            <h4>Buku Besar</h4>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Buku Besar (Pilih Periode Buku Besar)
                        </div>
                        <div class="card-body">
                            <!-- Awal dari Pilihan Tahun dan Bulan -->
                            <form action="#" class="formbukubesar" method="post">

                                <div class="col-12 form-group">
                                    <label for="tahunlabel" class="col-md-6 form-control-md">Tahun</label>
                                    <div class="col-md-12">
                                        <select class="form-control form-control-md" name="tahun" id="tahun">
                                            <!-- <div class="mb-3 row">
                                    <label for="tahunlabel" class="col-sm-2 col-form-label">Tahun</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="tahun" id="tahun"> -->
                                            <?php
                                            foreach ($tahun as $row) :
                                            ?>
                                                <option value="<?= $row['tahun'] ?>"><?= $row['tahun'] ?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                        <div class="invalid-feedback errortahun"></div>
                                    </div>
                                </div>

                                <div class="col-12 form-group">
                                    <label for="bulanlabel" class="col-md-6 form-control-md">Bulan</label>
                                    <div class="col-md-12">
                                        <select class="form-control form-control-md" name="bulan" id="bulan">
                                            <option value="01|Januari">Januari</option>
                                            <option value="02|Februari">Februari</option>
                                            <option value="03|Maret">Maret</option>
                                            <option value="04|April">April</option>
                                            <option value="05|Mei">Mei</option>
                                            <option value="06|Juni">Juni</option>
                                            <option value="07|Juli">Juli</option>
                                            <option value="08|Agustus">Agustus</option>
                                            <option value="09|September">September</option>
                                            <option value="10|Oktober">Oktober</option>
                                            <option value="11|November">November</option>
                                            <option value="12|Desember">Desember</option>

                                        </select>
                                        <div class="invalid-feedback errortahun"></div>
                                    </div>
                                </div>

                                <div class="col-12 form-group">
                                    <label for="akunlabel" class="col-md-6 form-control-md">Akun</label>
                                    <div class="col-md-12">
                                        <select class="form-control form-control-md" aria-label="Default select example" name="akun" id="akun">
                                            <?php
                                            foreach ($akun as $row) :
                                            ?>
                                                <option value="<?= $row['kode_akun'] ?>|<?= $row['nama_akun'] ?>"><?= $row['nama_akun'] ?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                        <div class="invalid-feedback errorakun"></div>
                                    </div>
                                </div>


                            </form>
                            <!-- Akhir dari Pilihan Tahun dan Bulan -->
                            <p align="center">
                                <a href="#" class="btn btn-primary btn-sm prosesbukubesar"><span data-feather="refresh-ccw"></span> Proses</a>
                            </p>
                            <!-- Untuk Tempat Jurnal Umum -->
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center" id="header_kosan">Rumah Sakit</div>
                                            <div class="text-center" id="judul"><b>Buku Besar</b></div>
                                            <div class="text-center" id="periode">Periode</div>
                                            <p class="viewdata"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Akhir Tempat Jurnal Umum -->

                        </div>
                    </div>
                </div>
            </div>


            </main>
        </div>
</div>


<!-- Script aktivasi Data Tables -->
<script>
    $(document).ready(function() {
        $('.prosesbukubesar').on('click', function() {

            // var kosan = document.getElementById('idkosan').value.split("|");
            var bln = document.getElementById('bulan').value.split("|");
            var tahun = document.getElementById('tahun').value;
            var akun = document.getElementById('akun').value.split("|");
            var periode = bln[1] + ' ' + tahun;
            // console.log(bln[0]);
            // $('#header_kosan').html('Kosan <b>' + kosan[1] + '</b>');
            $('#periode').html('Periode <b>' + periode + '</b>');
            $('#judul').html('Buku Besar <b>' + akun[1] + '</b>');
            $.ajax({
                // hasil split ada 2: index[0] menunjukkan id-nya sedangkan index[1] menunjukkan namanya
                url: "<?= base_url('BukuBesar/ambildatabukubesar') ?>/" + tahun + "/" + bln[0] + "/" + akun[0] + "/" + akun[1],
                dataType: "json",
                success: function(response) {
                    $('.viewdata').html(response.data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
</script>
<!-- Akhir script aktivasi data tables -->

<!-- <script>
    $('select').select2();
</script>
<script>
    $('select').selectric({
        maxHeight: 200
    });
</script> -->