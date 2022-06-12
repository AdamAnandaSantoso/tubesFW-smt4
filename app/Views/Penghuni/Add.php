<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= esc($title) ?></h1>
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
      <br>
      <!-- Tambahan untuk Input Form -->
        <form class="row g-3" action="<?=base_url('penghuni/add')?>" method="post">
            <div class="mb-3 row">
                <label for="ktp" class="col-sm-2 col-form-label">KTP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ktp" name="ktp" value="<?= set_value('ktp')?>" placeholder="Masukkan Nomer KTP, cth: 1380000131231231">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama')?>" placeholder="Masukkan Nama, cth: Benhard Sitanggang">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= set_value('email')?>" placeholder="Masukkan Email, cth: sangpemenang@gmail.com">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telepon" name="telepon" value="<?= set_value('telepon')?>" placeholder="Masukkan Nomor Telepon, cth: 08123123123123">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-5"></div>
                <input class="col-sm-1 btn btn-success" type="submit" value="Input">
                <div class="col-sm-5"></div>
            </div>
            <div class="mb-3 row">
                <?php
                    if(isset($validation)){
                ?>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        <div>
                            <?=$validation->listErrors();?>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
            
        </form>
      <!-- Akhir tambahan untuk card -->
        

    </main>
  </div>
</div>

