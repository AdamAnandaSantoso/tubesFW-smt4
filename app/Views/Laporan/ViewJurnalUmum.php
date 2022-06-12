<p>
<table class="table table-bordered table-striped" id="myTable">
    <thead>
        <tr class="table-secondary">
            <th>#ID</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th style="text-align:center">Ref</th>
            <th style="text-align:center">Debet</th>
            <th style="text-align:center">Kredit</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($datajurnal as $row) :
        ?>
            <tr>
                <td><?= $row['no_transaksi']; ?></td>
                <td><?= $row['tanggal_jurnal']; ?></td>
                <td><?= ($row['debit_kredit'] == 'Debit') ? $row['nama_akun'] : '&nbsp;&nbsp;&nbsp;&nbsp;' . $row['nama_akun'] ?></td>
                <td style="text-align:right"><?= $row['kode_akun'] ?></td>
                <td style="text-align:right"><?= ($row['debit_kredit'] == 'Debit') ? format_rupiah($row['nominal_jurnal']) : '-' ?></td>
                <td style="text-align:right"><?= ($row['debit_kredit'] == 'Debit') ? '-' : format_rupiah($row['nominal_jurnal']) ?></td>
            </tr>
        <?php
        endforeach;
        ?>
    </tbody>
</table>