<section id="main-content">
  <section class="wrapper">            
    <!--overview start-->
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header text-center" style="margin-top: 0;"></i> Pengaturan Akun </h3>
      </div>
    </div>
    <div class="row">
      <div class="container">

       <?php 
       $data=$this->session->flashdata('sukses');
       if($data!=""){ ?>
        <div class="alert alert-success fade in" id="success-alert"><strong>Sukses! </strong> <?=$data;?>
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      </div>
      <?php } ?>
      <?php 
      $data2=$this->session->flashdata('error');
      if($data2!=""){ ?>
        <div class="alert alert-danger fade in" id="success-alert"><strong> Galat! </strong> <?=$data2;?>
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      </div>
      <?php } ?>
      
      <div class="col-sm-1">
      </div>
      <div class="col-sm-10" style="margin-top: 30px;">
       <form role="form" method="post" action="<?php echo base_url();?>PenggunaC/post_ganti_password">
        <div class="form-group row">
          <label for="sandi_lama" class="col-sm-2 col-form-label">Kata Sandi Lama</label>
          <div class="col-sm-4">
            <input type="password" class="form-control" id="sandi_lama" name="sandi_lama" required placeholder="Kata Sandi Lama">
            <span class="text-danger"><?php echo form_error('sandi_lama'); ?></span>
            <input type="hidden" class="form-control" id="id_pengguna" name="id_pengguna" placeholder="Kata Sandi Baru" value="<?php echo $data_diri->id_pengguna;?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="sandi_baru" class="col-sm-2 col-form-label">Kata Sandi Baru</label>
          <div class="col-sm-4">
            <input type="password" class="form-control" id="sandi_baru" name="sandi_baru" required placeholder="Kata Sandi Baru">
            <span class="text-danger"><?php echo form_error('sandi_baru'); ?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="konfirmasi_sandi_baru" class="col-sm-2 col-form-label">Konfirmasi Kata Sandi Baru</label>
          <div class="col-sm-4">
            <input type="password" class="form-control" id="konfirmasi_sandi_baru" name="konfirmasi_sandi_baru" required placeholder="Konfirmasi Kata Sandi Baru">
            <span class="text-danger"><?php echo form_error('konfirmasi_sandi_baru'); ?></span>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary" id="btnSubmit">Ganti Kata Sandi</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-sm-1">
    </div>
  </div>
</div>

</section>

</section>

<script type="text/javascript">
  $(function () {
    $("#btnSubmit").click(function () {
      var password = $("#sandi_baru").val();
      var confirmPassword = $("#konfirmasi_sandi_baru").val();
      var pass_length = password.length;
      if (password != confirmPassword) {
        alert("Kata sandi tidak sama.");
                    // document.getElementById("demo").innerHTML = "Kata sandi tidak sama.";
                    return false;
                  }else{
                    if(pass_length < 6){
                      alert("Panjang Kata sandi minimal 6 karakter");
                      return false;
                    }else{
                      if(pass_length > 50){
                        alert("Panjang Kata sandi maksimal 50 karakter");
                        return false;
                      }else{
                        return true;
                      }
                    }
                  }
                });
  });
</script>