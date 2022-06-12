<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Chart Of Account</h1>
        </div>
        <div class="section-body">

   <!-- Awal Grafik Line -->
   <div class="row">
                <div class="mb-3">
                        <?php
                                // masukkan data ke dalam array
                                foreach($hasil as $dt){
                                    $Bulan[] = $dt->Bulan;
                                    $Total_Pemesanan[] = $dt->Total_Pemesanan;
                                    $Total_Pembayaran[] = $dt->Total_Pembayaran;
                                }
                                //echo json_encode($Region);
                        ?>   
 
                    <div id="canvas-holder" style="width:50%">
                        <canvas id="chart-area" width="300" height="200" />
                    </div>
                </div>    
                
        </div>

        <!-- Script konfigurasi chart -->
        <script>

                var config = {
                type: 'line',
                data: {
                    datasets: [
                        {
                            label: 'Total Pemesanan',
                            data: <?php echo json_encode($Total_Pemesanan);?>,
                            fill:"false",
                            "borderColor":"rgba(255, 26, 0, 0.7)",
                            "lineTension":0
                        },
                        {
                            label: 'Total Pembayaran',
                            data: <?php echo json_encode($Total_Pembayaran);?>,
                            fill:"false",
                            "borderColor": "rgba(0,9,255,0.5)",
                            "lineTension":0
                        }
                    ],
                    labels: <?php echo json_encode($Bulan);?>
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Grafik Jumlah Pemesanan dan Pembayaran'
                    }
                }
            };

            window.onload = function() {
                var ctx = document.getElementById("chart-area").getContext("2d");
                window.myLine  = new Chart(ctx, config);
            };
    </script>                    

    <!-- Akhir Grafik batang -->
        </div>
    </section>
</div>