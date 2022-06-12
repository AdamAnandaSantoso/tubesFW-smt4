<!-- Modal -->
<div class="modal fade" id="modaladd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Penghuni</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form untuk input -->
        <form action="<?=site_url('penghuni/prosesAddPopUp')?>" class="formtambahpenghuni">
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">KTP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ktp" name="ktp" placeholder="Masukkan Nomer KTP, harus 16 digit">
                    <div class="invalid-feedback errorktp"></div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama, cth: Benhard Sitanggang">
                    <div class="invalid-feedback errornama"></div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email, cth: sangpemenang@gmail.com">
                    <div class="invalid-feedback erroremail"></div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukkan Nomor Telepon, cth: 08123123123123">
                    <div class="invalid-feedback errortelepon"></div>
                </div>
            </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
      </div>

        </form>
        <!-- Akhir form untuk input -->
    </div>
  </div>
</div>

<!-- script untuk jquery -->
<script>
    $(document).ready(function()
        {
            $('.formtambahpenghuni').submit(function(e)
                {
                    e.preventDefault();
                        $.ajax(
                            {
                                type: "post",
                                url: $(this).attr('action'),
                                data: $(this).serialize(),
                                dataType: "json",
                                success: function (response){
                                    // jika responsenya adalah error
                                    if(response.error){
                                        if(response.error.ktp){
                                            $('#ktp').addClass('is-invalid');
                                            $('.errorktp').html(response.error.ktp);
                                        }else{
                                            $('#ktp').removeClass('is-invalid');
                                            $('.errorktp').html();
                                        }
                                        if(response.error.nama){
                                            $('#nama').addClass('is-invalid');
                                            $('.errornama').html(response.error.nama);
                                        }else{
                                            $('#nama').removeClass('is-invalid');
                                            $('.errornama').html();
                                        }
                                        if(response.error.email){
                                            $('#email').addClass('is-invalid');
                                            $('.erroremail').html(response.error.email);
                                        }else{
                                            $('#email').removeClass('is-invalid');
                                            $('.erroremail').html();
                                        }
                                        if(response.error.telepon){
                                            $('#telepon').addClass('is-invalid');
                                            $('.errortelepon').html(response.error.telepon);
                                        }else{
                                            $('#telepon').removeClass('is-invalid');
                                            $('.errortelepon').html();
                                        }
                                    }else{
                                        // muncul pesan sukses
                                        // alert(response.sukses);
                                        // tutup modal
                                        $('#modaladd').modal('hide');
                                        datapenghuni(); //refresh data penghuni otomatis
                                        // tampilkan alert pesan

                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: response.sukses,
                                            icon: 'success',
                                            confirmButtonText: 'Ok'
                                        })

                                    }
                                },
                                error: function(xhr, ajaxOptions, thrownError){
                                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                                } 
                            } 
                        );
                        return false;
                }
            );
        }
    );
</script>
<!-- akhir script untuk jquery -->