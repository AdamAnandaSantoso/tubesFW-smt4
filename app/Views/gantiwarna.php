<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Mencoba DOM Untuk Ganti Warna</h1>
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

  <div class="row">
    <?= form_open('helloworld/cobadomgantiwarna') ?>
    <div class="mb-3">
      <label for="warna" class="form-label">Pilih Kelas Warna</label>
      <select class="form-select" aria-label="Default select example" id="warna" name="warna" onchange="myFunction()">
        <option value="btn btn-primary">Primary</option>
        <option value="btn btn-warning">Warning</option>
        <option value="btn btn-dark">Dark</option>
      </select>
    </div>
    <br>
    <br>
    <br>
    <div id="x"></div>
    <button type="submit" class="btn btn-primary" id="idtombolsubmit">Submit</button>
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


<!-- Letak Javascript Untuk myFunction -->
<script>
  //fungsi ini akan terpicu jika ada perubahan nilai pada elemen combo box 
  function myFunction() {
    //pilih elemen yang akan kita manipulasi atribut obyeknya
    var var_combobox = document.getElementById("warna");
    var var_tombol = document.getElementById("idtombolsubmit");
    var var_divx = document.getElementById("x");

    //atribut class pada elemen tombol dengan id idtombolsubmit class="btn btn-primary" menjadi sesuai dengan value dari 
    //combo box yang dipilih
    var_tombol.setAttribute("class", var_combobox.value);

    //tambahkan text pada isian div dengan id x
    var_divx.innerHTML = "Warna dirubah karena elemen class dirubah menjadi <b>" + var_combobox.value + "</b>";

  }
</script>

</body>

</html>