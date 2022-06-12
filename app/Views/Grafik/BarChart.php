<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Chart Of Account</h1>
        </div>
        <div class="section-body">

        <!-- Awal Grafik Batang -->
      <div class="row">
                <div class="mb-3">
                        <?php
                                // masukkan data ke dalam array
                                foreach($hasil as $dt){
                                    $bulan[] = $dt->bulan;
                                    $total1[] = $dt->total1;
                                    $total2[] = $dt->total2;
                                }
                                //echo json_encode($Region);
                        ?>   
 
                    <div id="canvas-holder" style="width:50%">
                    <canvas id="myChart2" width="900px" height="700px"></canvas>
                        <!-- <canvas id="chart-area" width="800px" height="700px"/> -->
                    </div>
                </div>    
                
        </div>
 
        <!-- Script konfigurasi chart -->
        <script>

var config = {
    type: 'bar',
    data: {
        datasets: [
            {
                label: 'Nominal Pemesanan',
                data: <?php echo json_encode($total1);?>,
                fill:"false",
                backgroundColor: "rgba(255, 26, 0, 0.7)",
                "lineTension":0
            },
            {
                label: 'Nominal Pembayaran',
                data: <?php echo json_encode($total2);?>,
                fill:"false",
                backgroundColor: "rgba(0,9,255,0.5)",
                "lineTension":0
            }
        ],
        labels: <?php echo json_encode($bulan);?>
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Grafik Nominal Pemesanan dan Nominal Pembayaran'
        }
    }
};

window.onload = function() {
    var ctx = document.getElementById("myChart2").getContext("2d");
    window.MyBar = new Chart(ctx, config);
};
</script>                    

<!-- Akhir Grafik batang -->
        </div>
    </section>
</div>