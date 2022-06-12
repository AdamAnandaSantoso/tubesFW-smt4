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
                             <h4>Kuitansi Pemesanan</h4><br>
                             <!-- Awal Isi Tabel -->
                             <div class="table-responsive">
                                 <table id="example" class="table table-striped" style="width:100%">
                                     <thead>
                                         <tr>
                                             <th>ID Pemesanan</th>
                                             <th>Nama Pasien</th>
                                             <th>Nama Kamar</th>
                                             <th>Jenis Kamar</th>
                                             <th>Nominal Pemesanan</th>
                                             <th>Status Pemesanan</th>
                                             <th>Kuitansi Pemesanan</th>
                                             <th>Aksi</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php
                                            foreach ($pemesanan as $row) :
                                            ?>
                                             <tr>
                                                 <td><?= $row->id_pemesanan; ?></td>
                                                 <td><?= $row->nama_pasien; ?></td>
                                                 <td><?= $row->nama_kamar ?></td>
                                                 <td><?= $row->nama_jenis_kamar ?></td>
                                                 <td><?= $row->nominal_pemesanan ?></td>
                                                 <td><?= $row->status_pemesanan ?></td>
                                                 <td><?= $row->kuitansi_pemesanan ?></td>
                                                 <td>
                                                     <a href="<?= base_url('KuitansiPemesanan/cetakKuitansi/' . $row->id_pemesanan) ?>" class="btn btn-success" target="_blank">
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