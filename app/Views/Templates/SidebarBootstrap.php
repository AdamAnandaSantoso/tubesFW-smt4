<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span data-feather="database"></span>
              Masterdata
            </a>
            <ul class="ms-3 dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="<?= base_url('Kos/View') ?>">Kosan</a></li>
              <li><a class="dropdown-item" href="<?= base_url('penghuni/view') ?>">Penghuni</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart"></span>
              Transaksi
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="archive"></span>
              Laporan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Grafik
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Analisis Data
            </a>
          </li>
        </ul>

      </div>
    </nav>