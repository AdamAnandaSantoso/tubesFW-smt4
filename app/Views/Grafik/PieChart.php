<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Chart Of Account</h1>
        </div>
        <div class="section-body">

       <!-- Awal Grafik Pie -->
    <?php
        foreach($hasil as $dt){
            $nama_kamar[] = $dt->nama_kamar;
            $total[] = $dt->total;
        }
		//echo json_encode($Region);
     ?>   
    <div id="canvas-holder" style="width:40%">
        <canvas id="chart-area" width="100" height="100" />
    </div>

    <script>
        
function randomRgbColor() {
        const r = Math.floor(Math.random() * 256);
        const g = Math.floor(Math.random() * 256);
        const b = Math.floor(Math.random() * 256);
        const a = 0.8;

        return "rgba(" + r + ", " + g + ", " + b + ", " + a + ")";
        
        
}
       
// var ict_unit = [];
//          var efficiency = [];
//          var coloR = [];

//          var dynamicColors = function() {
//             var r = Math.floor(Math.random() * 256);
//             var g = Math.floor(Math.random() * 256);
//             var b = Math.floor(Math.random() * 256);
//             return "rgb(" + r + "," + g + "," + b + ")";
//          };

//          for (var i in $nama_kamar) {
//             ict_unit.push("ICT Unit " + data[i].ict_unit);
//             efficiency.push(data[i].efficiency);
//             coloR.push(dynamicColors());
//          }
        

        var config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: <?php echo json_encode($total);?>,
                    backgroundColor: randomRgbColor,
                }],
                labels: <?php echo json_encode($nama_kamar);?> 
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                }
            },
            
        };

        window.onload = function() {
            var ctx = document.getElementById("chart-area").getContext("2d");
            window.myPie = new Chart(ctx, config);
        };

    </script>

    <!-- Akhir Grafik Pie -->
        </div>
    </section>
</div>