 <!-- Main Content -->

 <div class="main-content">
     <section class="section">
         <div class="section-header">
             <h1>Kuitansi</h1>
         </div>
         <div class="section-body">
             <div class="row">
                 <div class="col">
                     <div class="card">
                         <div class="card-body">
                             <h4>Kuitansi Penggajian</h4><br>
                             <!-- Awal Isi Tabel -->
                             <div class="table-responsive">
                                 <table id="example" class="table table-striped" style="width:100%">
                                     <thead>
                                         <tr>
                                             <th>ID Gaji</th>
                                             <th>Nama Petugas</th>
                                             <th>Nama Kamar</th>
                                             <th>Jenis Kamar</th>
                                             <th>Tanggal Gaji</th>
                                             <th>Nominal Gaji</th>
                                             <th>Kuitansi Gaji</th>
                                             <th>Aksi</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php
                                            foreach ($penggajian as $row) :
                                            ?>
                                             <tr>
                                                 <td><?= $row->id_gaji; ?></td>
                                                 <td><?= $row->nama_petugas; ?></td>
                                                 <td><?= $row->nama_kamar ?></td>
                                                 <td><?= $row->nama_jenis_kamar ?></td>
                                                 <td><?= $row->tanggal_gaji ?></td>
                                                 <td><?= $row->nominal_gaji ?></td>
                                                 <td><?= $row->kuitansi_gaji ?></td>
                                                 <td>
                                                     <a href="<?= base_url('KuitansiPenggajian/cetakKuitansi/' . $row->id_gaji) ?>" class="btn btn-success" target="_blank">
                                                         <span data-feather="printer"></span> Cetak
                                                     </a>
                                                 </td>
                                             </tr>
                                         <?php
                                            endforeach;
                                            ?>
                                     </tbody>
                                 </table>
                             </div>
                             <!-- Akhir isi tabel -->
                         </div>
                     </div>
                 </div>
             </div>


             </main>
         </div>


         <!-- Script aktivasi Data Tables -->
         <script>
             $(document).ready(function() {
                 $('#example').DataTable();
             });
         </script>
         <!-- Akhir script aktivasi data tables -->

         <!-- <script src="../assets/dist/js/bootstrap.bundle.min.js"></script> -->




     </section>

 </div>