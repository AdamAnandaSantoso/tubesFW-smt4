 <!-- Main Content -->

 <div class="main-content">
     <section class="section">
         <div class="section-header">
             <h1>Satu</h1>
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



             <a href="<?= base_url('Satu/add') ?>" class="btn btn-success btn-sm">Tambah</a>

             <div class="viewsatu" style="display:none;"></div>

             <br><br>
             <div class="table-responsive">
                 <table id="myTable" class="table table-striped" style="width:100%">
                     <thead>
                         <tr>
                             <th>ID</th>
                             <th>Input Text</th>
                             <th>Input Radio</th>
                             <th>Input Check</th>
                             <th>Input Combo</th>
                             <th>Input Tanggal</th>
                             <th>Input Uang</th>
                             <th>Input Foto</th>
                             <th>Input Dokumen</th>
                             <th>Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            //print_r($form_input);
                            foreach ($datasatu as $row) :
                            ?>
                             <tr>
                                 <td><?= $row->id_satu; ?></td>
                                 <td><?= $row->input_text; ?></td>
                                 <td><?= $row->input_radio; ?></td>
                                 <td><?= $row->input_check; ?></td>
                                 <td><?= $row->input_combo; ?></td>
                                 <td><?= $row->input_tanggal; ?></td>
                                 <td><?= $row->input_uang; ?></td>
                                 <td>
                                     <a data-fancybox data-src="<?php echo base_url('images/upload/' . $row->input_foto) ?>" data-caption="<?= $row->input_foto ?>" target="_blank">
                                         <img src="<?php echo base_url('images/upload/' . $row->input_foto) ?>" class="img-thumbnail" width="100">
                                     </a>
                                 </td>
                                 <td>
                                     <a href="<?php echo base_url('dokumen/upload/' . $row->input_dokumen) ?>" target="_blank">
                                         <?= $row->input_dokumen; ?>
                                 </td>
                                 <td>
                                     <a class="btn btn-success btn-sm" href="<?= base_url('satu/viewData/' . $row->id_satu) ?>" role="button">
                                         <i class="icon-edit"></i> Ubah
                                     </a>
                                     <a onclick="deleteConfirm('<?php echo base_url('satu/delete/' . $row->id_satu) ?>')" class="btn btn-danger btn-sm" href="#" role="button">
                                         <i class="icon-trash"></i> Hapus
                                     </a>
                                 </td>
                             </tr>
                         <?php
                            endforeach;
                            ?>
                     </tbody>
                 </table>
             </div>

             <!-- Untuk image pakai fancy box -->
             <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
             <!-- Akhir fancy box image -->

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



             <!-- Script untuk mengaktifkan tabel menjadi data tables -->
             <script>
                 $(document).ready(function() {
                     $('#myTable').DataTable();
                 });
             </script>
             <!-- Akhir script untuk mengakfitkan tabel menjadi data tables -->



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