<p>
<table class="table table-bordered table-sm">
    <thead>
        <tr class="table-secondary">
            <th colspan="3"><?= $namaakun ?></th>
            <th colspan="4" style="text-align:right"><?= $idakun ?></th>
        </tr>
        <tr class="table-secondary">
            <th rowspan="2">Tanggal</th>
            <th rowspan="2">Keterangan</th>
            <th rowspan="2" style="text-align:center">Ref</th>
            <th rowspan="2" style="text-align:center">Debit</th>
            <th rowspan="2" style="text-align:center">Kredit</th>
            <th colspan="2" style="text-align:center">Saldo</th>
        </tr>
        <tr class="table-secondary">
            <th style="text-align:center">Debit</th>
            <th style="text-align:center">Kredit</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php
            $waktu = $tahun . "-" . $bulan . "-01"; //tgl 1 di awal bulan untuk saldo awal
            $db = 0;
            $kr = 0;
            ?>
            <td><?= $waktu ?></td>
            <td style='background-color: #eee'>Saldo Awal</td>
            <td style="text-align:right"><?= $idakun; ?></td>
            <?php
            if (strcmp($posisisaldonormal, 'Debit') == 0) {
                echo "<td style='text-align:right'>-</td>";
                echo "<td style='text-align:right'>-</td>";
                echo "<td style='text-align:right;background-color: #eee'>" . format_rupiah($saldoawal) . "</td>";
                echo "<td style='text-align:right'>-</td>";
                $saldo_debit = $saldoawal;
                $saldo_kredit = 0;
            } else {
                echo "<td style='text-align:right'>-</td>";
                echo "<td style='text-align:right'>-</td>";
                echo "<td style='text-align:right'>-</td>";
                echo "<td style='text-align:right;background-color: #eee'>" . format_rupiah($saldoawal) . "</td>";
                $saldo_debit = 0;
                $saldo_kredit = $saldoawal;
            }
            ?>
        </tr>

        <?php
        //saldoawal
        foreach ($bukubesar as $row) :
        ?>
            <tr>
                <td><?= $row['tanggal_jurnal'] ?></td>
                <td><?= $row['nama_akun'] ?></td>
                <td style="text-align:right"><?= $row['no_transaksi'] ?></td>
                <?php
                if ($row['debit_kredit'] == 'Debit') {
                    $db = $db + $row['nominal_jurnal'];
                ?>
                    <td style="text-align:right"><?= format_rupiah($row['nominal_jurnal']) ?></td>
                    <td style="text-align:right">-</td>
                    <?php
                    //jika posisi saldo normal ada di debet, maka di tambah dan ditampilkan ke posisi debet
                    if ($posisisaldonormal == 'Debit') {
                        $saldo_debit = $saldo_debit  + $row['nominal_jurnal'];
                        echo "<td style='text-align:right'>" . format_rupiah($saldo_debit) . "</td>";
                        echo "<td style='text-align:right'>" . format_rupiah($saldo_kredit) . "</td>";
                    } else {
                        $saldo_kredit = $saldo_kredit  - $row['nominal_jurnal'];
                        echo "<td style='text-align:right'>" . format_rupiah($saldo_debit) . "</td>";
                        echo "<td style='text-align:right'>" . format_rupiah($saldo_kredit) . "</td>";
                    } ?>
                <?php
                } else {
                    $kr = $kr + $row['nominal_jurnal'];

                ?>
                    <td style="text-align:right">-</td>
                    <td style="text-align:right"><?= format_rupiah($row['nominal_jurnal']) ?></td>
                <?php
                    if ($posisisaldonormal == 'Debit') {
                        $saldo_debit = $saldo_debit  - $row['nominal_jurnal'];
                        echo "<td style='text-align:right'>" . format_rupiah($saldo_debit) . "</td>";
                        echo "<td style='text-align:right'>" . format_rupiah($saldo_kredit) . "</td>";
                    } else {
                        $saldo_kredit = $saldo_kredit  + $row['nominal_jurnal'];
                        echo "<td style='text-align:right'>" . format_rupiah($saldo_debit) . "</td>";
                        echo "<td style='text-align:right'>" . format_rupiah($saldo_kredit) . "</td>";
                    }
                }
                ?>
            </tr>
        <?php
        endforeach;
        ?>
        <td colspan="3" style='background-color: #eee'><b>Total</b></td>
        <td style='text-align:right;background-color: #eee'><b><?= format_rupiah($db) ?></b></td>
        <td style='text-align:right;background-color: #eee'><b><?= format_rupiah($kr) ?></b></td>
        <td style='text-align:right;background-color: #eee'><b><?= format_rupiah($saldo_debit) ?></b></td>
        <td style='text-align:right;background-color: #eee'><b><?= format_rupiah($saldo_kredit) ?></b></td>

        </tr>
    </tbody>
</table>