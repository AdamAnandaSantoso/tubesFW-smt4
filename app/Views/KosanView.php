<h1>Contoh Pertama</h1>
<table border="1">
    <tr>
        <th>ID Kos</th>
        <th>Nama Kos</th>
        <th>Jenis Kos</th>
        <th>Alamat</th>
    </tr>
    <?php
    foreach ($datakosan as $row) :
    ?>
        <tr>
            <td><?= $row['id_kos']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['jenis_kos']; ?></td>
            <td><?= $row['alamat']; ?></td>
        </tr>
    <?php endforeach;
    ?>
</table>