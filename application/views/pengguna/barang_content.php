<section id="main-content">
  <section class="wrapper">            
    <!--overview start-->
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header" style="margin-top: 0;"><center>Daftar Barang</center></h3>
      </div>
    </div>
    
    <div class="row">
      <div class="col-lg-12">
        <!-- Alert -->
        <?php
        $data=$this->session->flashdata('sukses');
        if($data!=""){ ?>
        <div class="alert alert-success" id="success-alert"><strong>Sukses! </strong> <?=$data;?></div>
        <?php } ?>
        <?php 
        $data2=$this->session->flashdata('error');
        if($data2!=""){ ?>
        <div class="alert alert-danger" id="success-alert"><strong> Error! </strong> <?=$data2;?></div>
        <?php } ?>
        <!-- sampai sini -->

        <button data-toggle="collapse" data-target="#demo" class="btn btn-info btn-md" title="klik untuk melihat informasi"><i class="glyphicon glyphicon-alert"> Informasi</i></button><br><br>

        <div class="collapse" id="demo">
          <!-- Keterangan Tolak dan Setuju -->
              <div class="alert alert-info">
                <strong>Perhatian!</strong>
                <p>Berikut adalah penjelasan <strong>tombol ubah</strong> pada tabel barang<strong>:</strong></p>
                <table border="3" style="border-color: transparent;" >
                  <tr style="height: 30px">
                    <td style="width: 10%"><a class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span></a></td>
                    <td style="width: 6%"><i class="glyphicon glyphicon-arrow-right"></td>
                      <td style="width: 62%"> Tombol ini digunakan untuk mengubah jenis klasifikasi barang maupun nama barang.</td>
                    </tr>
                  </table>
                  
                </div>
                <!-- End Ket Tolak dan Setuju -->
        </div>

        <div class="card mb-3">
          <div class="card-header">
            <div class="card-body">
                <a class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="icon_plus_alt2"> </i> Tambah Barang</a>
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($data_barang as $barang) {
                        ?>
                        <tr class="text-center">
                          <td><?php echo $barang->nama_barang; ?></td>
                          <td><?php echo $barang->nama_jenis_barang; ?></td>
                          <td>
                            <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-<?php echo $barang->kode_barang; ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                          </td>
                        </tr>

                        <!-- Modal Edit Barang -->
                        <div aria-hidden="true" aria-labelledby="myModal" role="dialog" tabindex="-1" id="modal-<?php echo $barang->kode_barang; ?>" class="modal fade">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title" id="titlemodal">Edit Barang</h4>
                              </div>
                              <form id="formadd" class="form-horizontal" action="<?php echo base_url('BarangC/post_ubah_barang');?>" method="post" enctype="multipart/form-data" role="form">
                                <input type="text" name="id" id="idbarang" hidden="true">
                                <div class="modal-body">
                                  <div class="form-group">
                                    <div class="modal-body">
                                      <!-- mengirim kode_barang-->
                                      <input class="form-control" type="hidden" id="kode_barang" name="kode_barang" value="<?php echo $barang->kode_barang;?>" required> 
                                      <label class="col-lg-4 col-sm-2 control-label">Nama Barang :</label>
                                      <div class="col-lg-8">
                                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $barang->nama_barang;?>" required>
                                        <span class="text-danger" style="color: red;"><?php echo form_error('nama_barang'); ?></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="modal-body">
                                      <label class="col-lg-4 col-sm-2 control-label" for="jenis_barang"> Jenis Barang :</label>
                                      <div class="col-lg-8">
                                       <select class="form-control" name="kode_jenis_barang" id="kode_jenis_barang">
                                        <option value="">---- Pilih Jenis Barang ---- </option>
                                        <?php 
                                        foreach ($jenis_barang as $pilihan_jenis_barang) {
                                          if($pilihan_jenis_barang->kode_jenis_barang != 3){
                                            ?>
                                            <option required <?php if($pilihan_jenis_barang->kode_jenis_barang == $barang->kode_jenis_barang) {echo "selected=selected";}?> value="<?php echo $pilihan_jenis_barang->kode_jenis_barang ;?>"> <?php echo $pilihan_jenis_barang->nama_jenis_barang ;?> </option>
                                            <?php
                                          }
                                        }
                                        ?>
                                      </select>
                                      <span class="text-danger" style="color: red;"><?php echo form_error('kode_jenis_barang'); ?></span>  
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-info" type="submit"> Simpan </button>
                                <button  onclick="batal()"  id="buttonbatal" type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- END Modal Edit Barang -->


                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- project team & activity end -->

  </section>
  <div class="text-center">
    <div class="credits">
      <a href="https://bootstrapmade.com/free-business-bootstrap-themes-website-templates/">Business Bootstrap Themes</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </div>
</section>

<!-- Modal Tambah Barang -->
<div aria-hidden="true" aria-labelledby="myModal" role="dialog" tabindex="-1" id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
        <h4 class="modal-title" id="titlemodal">Tambah Barang</h4>
      </div>
      <form id="formadd" class="form-horizontal" action="<?php echo base_url('BarangC/post_tambah_barang');?>" method="post" enctype="multipart/form-data" role="form">
        <input type="text" name="id" id="idbarang" hidden="true">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-lg-4 col-sm-2 control-label">Nama Barang :</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 col-sm-2 control-label" for="jenis_barang"> Jenis Barang :</label>
            <div class="col-lg-8">
             <select required class="form-control" name="kode_jenis_barang" id="kode_jenis_barang">
              <option value="">---- Pilih Jenis Barang ---- </option>
              <?php 
              foreach ($jenis_barang as $pilihan_jenis_barang) {
                if($pilihan_jenis_barang->kode_jenis_barang != 3){
                  ?>
                  <option value="<?php echo $pilihan_jenis_barang->kode_jenis_barang ;?>"> <?php echo $pilihan_jenis_barang->nama_jenis_barang ;?> </option>
                  <?php
                }
              }
              ?>
            </select>
            <span class="text-danger" style="color: red;"><?php echo form_error('kode_jenis_barang'); ?></span>  
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-info" type="submit"> Simpan </button>
        <button  onclick="batal()"  id="buttonbatal" type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
      </div>
    </form>
  </div>
</div>
</div>
</div>
<!-- END Modal Tambah Barang -->

<script>
  $(document).ready(function() {
      // Untuk sunting
      $('#myModal').on('show.bs.modal', function (event) {

      });
    });

  // function edit(id) {
  //   $('#titlemodal').text("Edit Barang");
  //   $('#idbarang').val(id);
  //   $('#formadd').attr('action', '<?php //echo base_url('BarangC/ubah_data_barang');?>');
  //   $.ajax({
  //     type : 'get',
  //     url : '<?php //echo base_url().'BarangC/ubah_barang/'?>'+id,
  //     dataType :'JSON',
  //     success : function(data){
  //       $('#kode_jenis_barang').empty();
  //       $.each(data.pilihan_jenis_barang,function(key, value)
  //       {
  //         $("#kode_jenis_barang").append('<option value=' + value.kode_jenis_barang + '>' + value.nama_jenis_barang + '</option>');
  //       });
  //       $('#nama_barang').val(data.ubah_barang.nama_barang);
  //       $('#kode_jenis_barang option[value='+data.ubah_barang.kode_jenis_barang+']').attr('selected','selected');
  //     }
  //   });
  //   $('#buttonbatal').removeAttr('data-dismiss');
  //   $("#myModal").modal('show');


  // }

  // function batal() {

  //   $('#titlemodal').text("Tambah Barang");
  //   $('#formadd').attr('action', '<?php //echo base_url('BarangC/post_tambah_barang');?>');
  //   $('#idbarang').val("");
  //   $('#nama_barang').val("");
  //   $('#buttonbatal').attr('data-dismiss');
  //   $.ajax({
  //     type : 'get',
  //     url : '<?php //echo base_url().'BarangC/getListAjax/'?>',
  //     dataType :'JSON',
  //     success : function(data){
  //       $('#kode_jenis_barang').empty();
  //       $("#kode_jenis_barang").append('<option value="">---- Pilih Jenis Barang ----</option>');
  //       $.each(data,function(key, value)
  //       {
  //         $("#kode_jenis_barang").append('<option value=' + value.kode_jenis_barang + '>' + value.nama_jenis_barang + '</option>');
  //       });
  //     }
  //   });
  //   $("#myModal").modal('hide');

  // }

</script>
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
