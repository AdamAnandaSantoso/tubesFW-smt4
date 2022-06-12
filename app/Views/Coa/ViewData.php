<table class="table table-hover" id="datapenghuni">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">KTP</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Telepon</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // looping hasil penghuni dari database
        foreach ($tampildata as $row) :
        ?>
            <tr>
                <th scope="row"><?= $row['id'] ?></th>
                <td><?= $row['ktp'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['telepon'] ?></td>
                <td>
                    <a href="<?= base_url('penghuni/viewData/' . $row['id']) ?>" class="btn btn-primary btn-sm">Ubah</a>
                    <a onclick="deleteConfirm('<?php echo base_url('penghuni/delete/' . $row['id']) ?>')" href="#" class="btn btn-danger btn-sm" role="button" aria-pressed="true">Hapus</a>

                </td>
            </tr>
        <?php
        endforeach;

        ?>

    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#datapenghuni').DataTable();
    });
</script>