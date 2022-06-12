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

      <!-- Tambahan Alert Jika Sukses DML -->
          <?php
              if(session()->has("status_dml")){
                ?>
                <div class="row">
                  <div class="col">
                    <div class="alert alert-primary" role="alert">
                      <b><?=session("status_dml");?></b>
                    </div>
                  </div>  
                </div>  
                <?php
              }
          ?>
      <!-- Akhir Alert Jika Sukses DML -->
      <!-- Tambahan untuk table -->
      <a href="<?=base_url('penghuni/add')?>" class="btn btn-success btn-sm">Tambah</a>

      <!-- Tambahan untuk Input Pakai Pop Up -->
      <button href="#" class="btn btn-primary btn-sm tomboltambah">Tambah Pop Up</button>
      <!-- Akhir input pakai Pop Up -->
      <br><br>        
      <!-- Untuk tempat modal input pop up -->
      <div class="viewmodal" style="display:none;"></div>
      <!-- Akhir tempat modal input pop up -->

      <p class="viewdata"></p>  
      <!-- Akhir tambahan table-->

    </main>
  </div>
</div>


    <!-- <script src="../assets/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- Modal Delete -->
    <script>
          function deleteConfirm(url){
              var tomboldelete = document.getElementById('btn-delete')  
              tomboldelete.setAttribute("href", url); //akan meload kontroller delete

              var pesan = "Data dengan ID <b>"
              var pesan2 = " </b>akan dihapus"
              var n = url.lastIndexOf("/")
              var res = url.substring(n+1);
              document.getElementById("xid").innerHTML = pesan.concat(res,pesan2);

              var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {  keyboard: false });
              
              myModal.show();
            
          }
      </script>
      <!-- Logout Delete Confirmation-->
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
              <a id="btn-tutup" class="btn btn-secondary" data-bs-dismiss="modal">X</a>
            </div>
            <div class="modal-body" id="xid"></div>
            <div class="modal-footer">
              <a id="btn-batal" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</a>
              <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
            </div>
          </div>
        </div>
      </div>   
    <!-- Akhir Modal Delete -->


    <!-- Modal Untuk Tambah Pop Up -->
    <script>
        function datapenghuni(){
            $.ajax(
                    {
                        url: "<?=base_url('penghuni/ambildata')?>",
                        dataType: "json",
                        success: function(response){
                            $('.viewdata').html(response.data);
                        },
                        error: function(xhr, ajaxOptions, thrownError){
                                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                                } 
                    }
            )
        }
        $(document).ready(function()
            {
                datapenghuni().DataTable();
            }
        );
    </script>
    <script>
        $(document).ready(function(){
            datapenghuni();
                $('.tomboltambah').click(function(e)
                    {
                        e.preventDefault();
                        $.ajax(
                            {
                                url: "<?= base_url('penghuni/addPopUp')?>",
                                dataType: "json",
                                success: function (response){
                                    $('.viewmodal').html(response.data).show();
                                    $('#modaladd').modal('show');
                                },
                                error: function(xhr, ajaxOptions, thrownError){
                                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                                } 
                            } 
                        );
                    }
                );
            }
        
        );
    </script>
    <!-- Akhir Modal Untuk Tambah Pop Up -->

    <!-- Data Penghuni -->
    
    <!-- Akhir Data Penghuni -->

    
