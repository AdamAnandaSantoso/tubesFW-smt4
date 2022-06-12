 <!-- Main Content -->

 <div class="main-content">
     <section class="section">
         <div class="section-header">
             <h1>Data Pemesanan</h1>
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

             <div class="viewmodal" style="display:none;"></div>

             <br><br>
             <table class="table table-hover" id="myTable">
                 <thead>
                     <tr>

                         <th scope="col">ID</th>
                         <th scope="col">Nama</th>
                         <th scope="col">Order ID</th>
                         <th scope="col">Nominal</th>
                         <th scope="col">Tipe</th>
                         <th scope="col">Waktu Transaksi</th>
                         <th scope="col">Bank</th>
                         <th scope="col">VA Number</th>
                         <th scope="col">Kode Status</th>
                         <th scope="col">Waktu Pembayaran</th>
                         <th scope="col">Status</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $no = 1; ?>
                     <?php
                        // looping hasil penghuni dari database
                        foreach ($datapemesanan as $row) :
                        ?>
                         <tr>
                             <th scope="row"><?= $row['id_pasien'] ?></th>
                             <td><?= $row['nama_pasien'] ?></td>
                             <td><?= $row['order_id'] ?></td>
                             <td><?= $row['gross_amount'] ?></td>
                             <td><?= $row['payment_type'] ?></td>
                             <td><?= $row['transaction_time'] ?></td>
                             <td><?= $row['bank'] ?></td>
                             <td><?= $row['va_number'] ?></td>
                             <td><?= $row['status_code'] ?></td>
                             <td><?= $row['payment_time'] ?></td>
                             <td><?= $row['status_pemesanan'] ?></td>
                         </tr>
                         <?php $no++; ?>
                     <?php
                        endforeach;

                        ?>
                 </tbody>
             </table>






   
 <script>
     $(document).ready(function() {
         $('#myTable').DataTable();
     });
 </script>
 <!-- Akhir script untuk mengakfitkan tabel menjadi data tables -->