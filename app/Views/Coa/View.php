 <!-- Main Content -->

 <div class="main-content">
     <section class="section">
         <div class="section-header">
             <h1>Chart Of Account</h1>
         </div>
         <div class="section-body">
             <?php
                if (session()->has("status_dml")) {
                ?>
                 <div class="row">
                     <div class="col">
                         <div class="alert alert-primary" role="alert">
                             <b><?= session("status_dml"); ?></b>
                         </div>
                     </div>
                 </div>
             <?php
                }
                ?>

             <a href="<?= base_url('Coa/add') ?>" class="btn btn-success btn-sm">Tambah</a>

             <div class="viewmodal" style="display:none;"></div>

             <br><br>
             <table class="table table-hover" id="myTable">
                 <thead>
                     <tr>
                         <th scope="col">No</th>
                         <th scope="col">Kode Akun</th>
                         <th scope="col">Nama Akun</th>
                         <th scope="col">Header Akun</th>
                         <th scope="col">Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $no = 1; ?>
                     <?php
                        // looping hasil penghuni dari database
                        foreach ($datacoa as $row) :
                        ?>
                         <tr>
                             <td><?= $no; ?></td>
                             <th scope="row"><?= $row['kode_akun'] ?></th>
                             <td><?= $row['nama_akun'] ?></td>
                             <td><?= $row['header_akun'] ?></td>
                             <td>
                                 <a href="<?= base_url('Coa/viewData/' . $row['kode_akun']) ?>" class="btn btn-primary">Ubah</a>
                                 <a onclick="deleteConfirm('<?php echo base_url('coa/delete/' . $row['kode_akun']) ?>')" href="#" class="btn btn-danger" role="button" aria-pressed="true">Hapus</a>
                             </td>
                         </tr>
                         <?php $no++; ?>
                     <?php
                        endforeach;

                        ?>
                 </tbody>
             </table>


             <!-- Tambahan Sweet Alert -->
             <?php
                // jika session status_dml ada isinya maka tampilkan alert menggunakan sweet alert
                if (session()->has("status_dml")) {
                ?>
                 <script>
                     Swal.fire({
                         icon: 'success',
                         title: 'Berhasil!',
                         text: '<?= session("status_dml"); ?>'
                     });
                 </script>
             <?php
                }
                ?>

             <!-- Akhir Tambahan Sweet Alert -->

             <!-- Tambahan Alert Jika Sukses DML -->
             <?php
                if (session()->has("status_dml")) {
                ?>
                 <div class="row">
                     <div class="col">
                         <div class="alert alert-primary" role="alert">
                             <b><?= session("status_dml"); ?></b>
                         </div>
                     </div>
                 </div>
             <?php
                }
                ?>
             <!-- Akhir Alert Jika Sukses DML -->

             <!-- Modal Untuk Tambah Pop Up -->
             <script>
                 $(document).ready(function() {
                         $('.tomboltambah').click(function(e) {
                             e.preventDefault();
                             $.ajax({
                                 url: "<?= base_url('Coa/addPopUp') ?>",
                                 dataType: "json",
                                 success: function(response) {
                                     $('.viewmodal').html(response.data).show();
                                     $('#modaladd').modal('show');
                                 },
                                 error: function(xhr, ajaxOptions, thrownError) {
                                     alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                                 }
                             });
                         });
                     }

                 );
             </script>
             <!-- Akhir Modal Untuk Tambah Pop Up -->

         </div>

     </section>

 </div>


 <!-- Modal Delete -->
 <script>
     function deleteConfirm(url) {
         var tomboldelete = document.getElementById('btn-delete')
         tomboldelete.setAttribute("href", url); //akan meload kontroller delete

         var pesan = "Data dengan ID <b>"
         var pesan2 = " </b>akan dihapus"
         var n = url.lastIndexOf("/")
         var res = url.substring(n + 1);
         document.getElementById("xid").innerHTML = pesan.concat(res, pesan2);

         var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
             keyboard: false
         });

         myModal.show();

     }
 </script>
 <!-- Logout Delete Confirmation-->
 <div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                 <a id="btn-tutup" class="btn btn-secondary" data-dismiss="modal">X</a>
             </div>
             <div class="modal-body" id="xid"></div>
             <div class="modal-footer">
                 <a id="btn-batal" class="btn btn-secondary" data-dismiss="modal">Batalkan</a>
                 <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
             </div>
         </div>
     </div>
 </div>
 <!-- Akhir Modal Delete -->
 <!-- Script untuk mengaktifkan tabel menjadi data tables -->
 <script>
     $(document).ready(function() {
         $('#myTable').DataTable();
     });
 </script>
 <!-- Akhir script untuk mengakfitkan tabel menjadi data tables -->