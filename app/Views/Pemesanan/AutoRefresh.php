<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pemesanan</h1>
        </div>   
        <div class="section-body">
        <div class="container mt-3">
            <button class="bg primary"> <a href="http://localhost:8080/TransPemesanan/view" id="timerCountDown" class="lead text-white">Tunggu</a></button>
        </div>
              <!-- <p id="timerCountDown" class="lead">
                    Klik...
                </p> -->
    <script>
        const timerElement = document.getElementById('timerCountDown');
        let timer;

        function startTimeCountDown() {
            timer = 10;
            const timeCountdown = setInterval(countdown, 1000);
        }

        function countdown() {
            if (timer == 0) {
                clearTimeout(timer);
                timerElement.innerHTML = 'Kembali'

            } else {
                timerElement.innerHTML = timer + ' secs';
                timer--;
            }
        }

        timerElement.addEventListener('click', ev => {
            startTimeCountDown();
        }
        )
        ;
    </script>
   
        </div>
    </section>
</div>
z