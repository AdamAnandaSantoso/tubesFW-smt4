<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Penggajian Karyawan</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>
        </div>
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="380" hidden></canvas>

    <?php
    if (isset($validation)) {
        echo $validation->listErrors();
    }
    ?>
    <div class="row">
        <?= form_open('penggajian') ?>
        <div class="mb-3">
            <label for="waktu" class="form-label">Tanggal</label>
            <?php
            if (isset($validation)) {
                //untuk mengecek apakah ada error pada elemen field nama_produk
                if ($validation->hasError('waktu')) { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
            ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error: <?= $validation->getError('waktu') ?> </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php
                }
            }
            ?>
            <input type="date" class="form-control" id="waktu" name="waktu" value="<?= set_value('waktu') ?>" placeholder="Diisi dengan waktu">
        </div>


        <div class="mb-3">
            <label for="id_karyawan" class="form-label">Karyawan</label>
            <?php
            if (isset($validation)) {
                //untuk mengecek apakah ada error pada elemen field nama_produk
                if ($validation->hasError('id_karyawan')) { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
            ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error: <?= $validation->getError('id_karyawan') ?> </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php
                }
            }
            ?>
            <input type="text" class="form-control" id="id_karyawan" name="id_karyawan" value="<?= set_value('nama_karyawan') ?>" placeholder="Diisi dengan nama karyawan">
        </div>

        <div class="mb-3">
            <label for="hadir" class="form-label">Hadir</label>
            <?php
            if (isset($validation)) {
                //untuk mengecek apakah ada error pada elemen field nama_produk
                if ($validation->hasError('hadir')) { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
            ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error: <?= $validation->getError('hadir') ?> </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php
                }
            }
            ?>
            <input type="number" class="form-control" id="hadir" name="hadir" value="<?= set_value('hadir') ?>" placeholder="Diisi dengan hadir" onkeyup="myFunction();">
        </div>

        <div class="mb-3">
            <label for="gaji" class="form-label">Gaji</label>
            <?php
            if (isset($validation)) {
                //untuk mengecek apakah ada error pada elemen field nama_produk
                if ($validation->hasError('gaji')) { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
            ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error: <?= $validation->getError('gaji') ?> </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php
                }
            }
            ?>
            <input type="text" class="form-control" id="gaji" name="gaji" value="<?= set_value('gaji') ?>" placeholder="Diisi dengan gaji" onkeyup="myFunction();">
        </div>

        <div class="mb-3">
            <label for="hpp" class="form-label">Potongan</label>
            <?php
            if (isset($validation)) {
                //untuk mengecek apakah ada error pada elemen field nama_produk
                if ($validation->hasError('potongan')) { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
            ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error: <?= $validation->getError('potongan') ?> </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php
                }
            }
            ?>
            <input type="text" class="form-control" id="potongan" name="potongan" value="<?= set_value('potongan') ?>" placeholder="Diisi dengan potongan" onkeyup="myFunction();">
        </div>

        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="text" class="form-control" id="total" name="total" value="<?= set_value('total') ?>" placeholder="Total gaji" onkeyup="myFunction();">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</main>
</div>
</div>

<!-- Bootstrap JS -->
<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="<?= base_url('dashboard/dashboard.js') ?>"></script>

<script>
    $(document).ready(function() {
        // Format mata uang.
        $('#gaji,#potongan,#total').mask('0,000,000,000,000,000,000,000', {
            reverse: true
        });

    })
</script>
<script>
    function number_format(number, decimals, decPoint, thousandsSep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
        var n = !isFinite(+number) ? 0 : +number
        var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
        var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
        var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
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
        var var_gaji = Number(document.getElementById("gaji").value.replace(/[^\d.-]/g, ''));
        var hadir = document.getElementById("hadir").value;
        var var_potongan = Number(document.getElementById("potongan").value.replace(/[^\d.-]/g, ''));
        var total = document.getElementById("total");
        total.value = number_format(var_gaji - var_potongan); //jumlah dikali harga
        //document.getElementById("x").innerHTML = myarr[0];
    }
</script>
</body>

</html>