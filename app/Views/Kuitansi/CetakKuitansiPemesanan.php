<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .body {
            height: 20cm;
        }

        h1 {
            text-align: center;
        }

        .info-1 {
            float: left;
            width: 50%;
            height: 100%;
        }

        .info-2 {
            float: left;
            width: 50%;
            height: 100%;
            text-align: right;
        }

        .table {
            font-family: sans-serif;
            color: #232323;
            border-collapse: collapse;
        }

        .table,
        th,
        td {
            border: 1px solid #999;
            padding: 8px 20px;
        }

        .footer {
            float: right;
        }

        .footer h4,
        h5 {
            text-align: center;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body>
    <?php
    foreach ($kuitansi as $row) :
        $no_kuitansi = $row->kuitansi_pemesanan;
        $id_pemesanan = $row->id_pemesanan;
        $nama_pasien = $row->nama_pasien;
        $alamat_pasien = $row->alamat_pasien;
        $no_telp_pasien = $row->no_telp_pasien;
        $nama_kamar = $row->nama_kamar;
        $nama_jenis_kamar = $row->nama_jenis_kamar;
        $tanggal_pemesanan = $row->tanggal_pemesanan;
        $nominal_pemesanan = $row->nominal_pemesanan;
        $status_pemesanan = $row->status_pemesanan;
    endforeach;
    ?>

    <h1>Rumah Sakit</h1>
    <hr>
    <h3>Data Pemesanan : <?= $no_kuitansi ?></h3>
    <table>
        <tr>
            <td>ID Pemesanan</td>
            <td>Nama Pasien</td>
            <td>Nama Kamar</td>
            <td>Jenis Kamar</td>
            <td>Tanggal Pemesanan</td>
            <td>Nominal Pemesanan</td>
            <td>Status Pemesanan</td>
        </tr>
        <tr>
            <td><?= $id_pemesanan ?></td>
            <td><?= $nama_pasien; ?></td>
            <td><?= $nama_kamar; ?></td>
            <td><?= $nama_jenis_kamar; ?></td>
            <td><?= $tanggal_pemesanan; ?></td>
            <td><?= format_rupiah($nominal_pemesanan); ?></td>
            <td><?= $status_pemesanan; ?></td>
        </tr>
    </table>
    <hr>
    <div class="footer">
        <h4>Hormat Kami</h4>
        <br>
        <?php $date = date("d F Y") ?>
        <h5>Bandung, <?= $date; ?></h5>
    </div>

</body>

</html>