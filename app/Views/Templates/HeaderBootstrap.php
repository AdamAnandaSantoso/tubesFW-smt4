<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>Dashboard Kosan</title>

  <link rel="icon" href="<?= base_url('images/icon.jpg') ?>" type="image/gif" sizes="16x16">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

  <!-- Bootstrap core CSS -->
  <!-- <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="<?= base_url('assets/dist/css/bootstrap.min.css') ?>" rel="stylesheet">

  <!-- Data Tables -->
  <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
  <!-- Akhir Data Tables -->

  <!-- Jquery maskin -->
  <script src="<?= base_url('jquery/jquery.mask.js') ?>"></script>

  <!-- Sweet Alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Akhir Sweet Alert -->



  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    .btn-primary.custom-btn {
      background-color: #9C19A8;
      border-color: #9C19A8;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <!-- <link href="dashboard.css" rel="stylesheet"> -->
  <link href="<?= base_url('dashboard/dashboard.css') ?>" rel="stylesheet">

  <!-- untuk jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
  <!-- akhir jquery -->

  <!-- Jquery Masking -->
  <script src="<?= base_url('jquery/jquery.mask.js') ?>"></script>
  <!-- Akhir Jquery Masking -->

</head>

<body>

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Kosan Milenial</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="<?= base_url('home') ?>">Sign out</a>
      </div>
    </div>
  </header>