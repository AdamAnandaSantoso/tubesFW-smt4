<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="section-body">
            <div class="col-12 mb-4">
              <div class="hero text-white hero-bg-image hero-bg-parallax"
                    data-background="<?= base_url() ?>/stisla/assets/img/unsplash/aaa.jpg">
                  <div class="hero-inner">
                     <h2 class="text-capitalize">Hi, <?= session("user_name"); ?></h2>
                     <p class="lead">Welcome again, keep the spirit and enjoy today</p>
                     <div class="mt-4">
                        <a href="http://localhost:8080/Login/index" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i> Logout</a>
                     </div>
                   </div>
                </div>
             </div>
         <div class="p-3">
            <h3>Cuaca <?php 
                  echo $apiweather->name;
                ?> Hari Ini</h3>
            <div class="card card-danger">
              <div class="card-header bg-dark text-ligt">
                <h4>
                <?php 
                  echo $apiweather->name;
                ?> 
                </h4> 
                <div class="card-header-action">
                <form class="card-header-form" method="POST" action="<?= base_url('Dashboard/Dashboard') ?>">
                      <div class="input-group">
                        <input type="text" name="kota" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                          <button name="submit" class="btn btn-danger btn-icon"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
              </div>
              <div class="card-body bg-dark text-light">
                <?php 
                foreach ($apiweather->weather as $row){
                } 
                $fahrenheit_now = $apiweather->main->temp ;
                $fahrenheit_like = $apiweather->main->feels_like ;
                $fahrenheit_max = $apiweather->main->temp ;
                $fahrenheit_min = $apiweather->main->temp ;
                $celcius_now = ($fahrenheit_now - 32) * 5 / 9;
                $celcius_like = ($fahrenheit_like - 32) * 5 / 9;
                $celcius_max = ($fahrenheit_max - 32) * 5 / 9;
                $celcius_min = ($fahrenheit_min - 32) * 5 / 9;
                ?>
               
               <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column">
                      <p><?php echo date("l, d M h:ia"); ?> <span class="text-primary">( UTC+07:00 )</span></p>
                      <div class="d-flex">
                        <img src="http://openweathermap.org/img/wn/<?=$row->icon?>@2x.png" alt="" height="75px">
                        <span style="font-size: 48px;"><?= ceil($celcius_now) ?> C&deg;</span>
                      </div>
                    </div>
                    <div>
                      <p class="text-capitalize font-weight-bold">
                      <?= $row->description; ?>
                      </p>
                      <p class="font-weight-bold">
                      <?= ceil($celcius_max) ?> C&deg; / <?= ceil($celcius_min) ?> C&deg;
                      </p>
                      <p class="font-weight-bold">
                      Feel likes <?= ceil($celcius_like) ?> C&deg;
                      </p>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</div>


