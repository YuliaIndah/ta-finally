<section id="main-content">
  <section class="wrapper">            
    <!--overview start-->
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header text-center" style="margin-top: 0;"> Daftar Pengguna </h3>
        <!-- <ol class="breadcrumb">
          <li><i class="fa fa-user"></i><a href="#">Admin</a></li>
          <li><i class="fa fa-user"></i>Pengguna</li>                
        </ol> -->
      </div>
    </div>
    <!-- isi content disini -->

    <div class="row">
      <div class="col-lg-12">
       <?php
       // var_dump($data_pengguna("1")); 
       $data=$this->session->flashdata('sukses');
       if($data!=""){ ?>
         <div class="alert alert-success"><strong>Sukses! </strong> <?=$data;?></div>
         <?php } ?>
         <?php 
         $data2=$this->session->flashdata('error');
         if($data2!=""){ ?>
           <div class="alert alert-danger"><strong> Error! </strong> <?=$data2;?></div>
           <?php } ?>
           <div class="card mb-3">
            <div class="card-header">
              <div class="card-body">
                <div class="table-responsive">
                 <!--  <?php
                  $kadep = $PenggunaM->get_pengguna_by_kode_jabatan_unit('1');
                  $sekdep = $PenggunaM->get_pengguna_by_kode_jabatan_unit('2');
                  $manajer_sarpras = $PenggunaM->get_pengguna_by_kode_jabatan_unit('3');
                  $staf_sarpras = $PenggunaM->get_pengguna_by_kode_jabatan_unit('4');
                  $manajer_keuangan = $PenggunaM->get_pengguna_by_kode_jabatan_unit('5');
                  $staf_keuangan = $PenggunaM->get_pengguna_by_kode_jabatan_unit('6');
                  ?>
                  <div class="alert alert-danger">
                    <i class="glyphicon glyphicon-exclamation-sign"></i><strong> Perhatian!</strong> Masih ada Jabatan penting yang kosong. Silahkan dilengkapi terlebih dahulu, agar sistem dapat berjalan dengan baik.
                  </div>
                  <div class="alert alert-success">
                    <i class="glyphicon glyphicon-ok"></i><strong> Sukses!</strong> Semua Jabatan Penting telah terpenuhi, Sistem dapat berjalan dengan baik.
                  </div> -->
                  <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center" style="width: 150px;">Nama</th>
                        <th class="text-center">No. Identitas</th>
                        <th class="text-center">Unit</th>
                        <th class="text-center">Jabatan</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Akun</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i=0;
                      foreach ($data_pengguna as $pengguna) {
                        $i++;
                        ?>
                        <tr>
                          <td class="text-center"><?php echo $i;?></td>
                          <td class="relative">
                            <div class="relative">
                              <strong><?php echo $pengguna->nama;?></strong>
                              <a href="#detail_pengguna" id="custID" data-toggle="modal" data-id="<?php echo $pengguna->id_pengguna;?>" title="klik untuk melihat detail kegiatan"><small class="kecil">Lihat detail</small></a>
                            </div>
                          </td>
                          <td class="text-center"><?php echo $pengguna->no_identitas; ?></td>
                          <td class="text-center"><?php echo $pengguna->nama_unit; ?></td>                          
                          <td class="text-center"><?php echo $pengguna->nama_jabatan." ". $pengguna->nama_unit; ?></td>
                          <td class="text-center"><?php if($pengguna->status_email == 0){
                            ?>
                            <a title="Belum Aktif"><span class="glyphicon glyphicon-remove"></a>  
                              <?php
                            }else{
                             ?>
                             <a title="Aktif"><span class="glyphicon glyphicon-ok"></a>
                               <?php
                             } 
                             ?>
                           </td>
                           <?php
                           if($pengguna->status == "tidak aktif"){
                            ?>
                            <td class="text-center">
                              <a title="Belum Aktif"><span class="glyphicon glyphicon-remove"></a>
                              </td>
                              <?php 
                              if($pengguna->status_email == 0){
                                ?>
                                <td class="text-center">
                                  <div class="btn-group">
                                    <a data-toggle='tooltip' title='Aktifkan email terlebih dahulu' class="btn btn-info btn-sm" disabled><span class="glyphicon glyphicon-ok"></span></a>
                                    <a data-toggle='tooltip' title='Non-aktif' class="btn btn-danger btn-sm" disabled><span class="glyphicon glyphicon-remove"></span></a>  
                                    <a data-toggle='tooltip' title='Ganti Jabatan' class="btn btn-warning btn-sm" disabled><span class="glyphicon glyphicon-refresh"></span></a>  
                                  </div>
                                </td>
                                <?php
                              }else{?>
                               <td class="text-center">
                                <div class="btn-group">
                                  <a data-toggle='tooltip' title='Aktif' class="btn btn-info btn-sm" href="<?php echo base_url('PenggunaC/aktif')."/".$pengguna->id_pengguna;?>"><span class="glyphicon glyphicon-ok"></span></a>
                                  <a data-toggle='tooltip' title='Non-aktif' class="btn btn-danger btn-sm" disabled><span class="glyphicon glyphicon-remove"></span></a>   
                                  <a data-toggle='tooltip' title='Ganti Jabatan' class="btn btn-warning btn-sm" disabled><span class="glyphicon glyphicon-refresh"></span></a>  
                                </div>
                              </td>
                              <?php 
                            }
                          }else{
                            ?>
                            <td class="text-center">
                              <a title="Aktif"><span class="glyphicon glyphicon-ok"></a>
                              </td>
                              <td class="text-center">
                                <div class="btn-group">
                                  <a  data-toggle='tooltip' title='Aktif' class="btn btn-info btn-sm" disabled><span class="glyphicon glyphicon-ok"></span></a>
                                  <a data-toggle='tooltip' title='Non-aktif' class="btn btn-danger btn-sm" href="<?php echo base_url('PenggunaC/non_aktif')."/".$pengguna->id_pengguna;?>" ><span class="glyphicon glyphicon-remove"></span></a>

                                  <a data-toggle="modal" title="Ganti Jabatan" class="btn btn-warning btn-sm" data-target="#modal_ubah_jabatan-<?php echo $pengguna->kode_jabatan_unit?>"><span class="glyphicon glyphicon-refresh"></span></a>

                                  <!--  <a href="#ganti_jabatan" id="custId" data-toggle="modal" data-id="<?php echo $pengguna->kode_jabatan_unit;?>" data-toggle="tooltip" title="Ganti Jabatan" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-refresh"></span></a> -->
                                </div>
                                <?php
                              }
                              ?>
                            </td>
                          </tr>

                          <div aria-hidden="true" aria-labelledby="modal_ubah_jabatan-<?php echo $pengguna->kode_jabatan_unit?>" role="dialog" tabindex="-1" id="modal_ubah_jabatan-<?php echo $pengguna->kode_jabatan_unit?>" class="modal fade">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                  <h4 class="modal-title">Ubah Jabatan</h4>
                                </div>
                                <div class="modal-body">
                                  <?php echo form_open_multipart('PenggunaC/ganti_jabatan');?>
                                  <form role="form" action="<?php echo base_url(); ?>PenggunaC/ganti_jabatan" method="post">
                                    <div class="form-group">
                                      <input type="hidden" name="id_pengguna" value="<?php echo $pengguna->id_pengguna?>">
                                      <input type="text" name="own_kode_unit" value="<?php echo $pengguna->kode_unit?>">
                                      <input type="text" name="own_kode_jabatan" value="<?php echo $pengguna->kode_jabatan?>">
                                      <input type="text" name="own_kode_jabatan_unit" value="<?php echo $pengguna->kode_jabatan_unit?>">
                                      <input type="text" name="own_atasan" value="<?php echo $pengguna->atasan?>">
                                      <div class="relative">
                                        <h4><strong><?php echo $pengguna->nama?></strong></h4>
                                        <h5><?php echo $pengguna->nama_jabatan." ".$pengguna->nama_unit?></h5> 
                                      </div>
                                      <br>
                                      <label for="bidang"> Pindah Ke Jabatan Unit :</label> 
                                      <select class="form-control" name="kode_unit" id="kode_unit-<?php echo $pengguna->kode_jabatan_unit?>" required>

                                        <option value="">---- Pilih Unit ---- </option>
                                        <?php 
                                        foreach ($pilihan_unit as $unit) {
                                          ?>
                                          <option value="<?php echo $unit['kode_unit'] ;?>"> <?php echo $unit['nama_unit'] ;?> </option>
                                          <?php
                                        }
                                        ?>
                                      </select> 

                                      <span class="text-danger" style="color: red;"><?php echo form_error('kode_jabatan'); ?></span>  
                                    </div>
                                    <div class="form-group">
                                      <select class="form-control" name="kode_jabatan" id="kode_jabatan-<?php echo $pengguna->kode_jabatan_unit?>" required>
                                        <option>---- Pilih Jabatan ---- </option>
                                      </select>
                                      <span class="text-danger" style="color: red;"><?php echo form_error('kode_jabatan'); ?></span>  
                                    </div>
                                    <div class="modal-footer">
                                      <input type="submit" class="btn btn-primary"  value="Ganti Jabatan">
                                    </div> 
                                    <?php echo form_close()?>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>

                          <script type="text/javascript">
                             // kode_unit change
                             $('#kode_unit-<?php echo $pengguna->kode_jabatan_unit?>').change(function(){
                                var unit = $(this).val(); //ambil value dr kode_unit
                                  // AJAX request
                                  $.ajax({
                                    url:'<?=base_url()?>UserC/get_jabatan',
                                    method: 'post',
                                    asycn : false,
                                    data: {kode_unit: unit}, // data post ke controller 
                                    dataType: 'json',
                                    success: function(response){
                                          // Remove options
                                          $('#kode_jabatan-<?php echo $pengguna->kode_jabatan_unit?>').find('option').not(':first').remove();

                                          // Add options
                                          $.each(response,function(daftar,data){
                                            $('#kode_jabatan-<?php echo $pengguna->kode_jabatan_unit?>').append('<option value="'+data['kode_jabatan']+'">'+data['nama_jabatan']+' '+data['nama_unit']+'</option>');
                                          });
                                        }
                                      });
                                });
                              </script>
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

              <!-- batas content -->

            </section>
            <div class="text-center">
              <div class="credits">
                <!-- <a href="https://bootstrapmade.com/free-business-bootstrap-themes-website-templates/">Business Bootstrap Themes</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
              </div>
            </div>
          </section>


          <!-- modal detail kegiatan -->
          <div class="modal fade" id="detail_pengguna" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Detail Pengguna</h4>
                </div>
                <div class="modal-body">
                  <div class="fetched-data"></div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>

          <script type="text/javascript">
    // js detail pengajuan
    $(document).ready(function(){
      $('#detail_pengguna').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
              type : 'get',
              url : '<?php echo base_url().'PenggunaC/detail_pengguna/'?>'+rowid,
                //data :  'rowid='+ rowid, // $_POST['rowid'] = rowid
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
              }
            });
          });

       // City change
       $('#kode_unit').change(function(){
        alert("assassass");
        var unit = $(this).val(); //ambil value dr kode_unit
        // window.alert(unit);

          // AJAX request
          $.ajax({
            url:'<?=base_url()?>UserC/get_jabatan',
            method: 'post',
            asycn : false,
            data: {kode_unit: unit}, // data post ke controller 
            dataType: 'json',
            success: function(response){
                  // Remove options
                  $('#kode_jabatan').find('option').not(':first').remove();

                  // Add options
                  $.each(response,function(daftar,data){
                    $('#kode_jabatan').append('<option value="'+data['kode_jabatan']+'">'+data['nama_jabatan']+' '+data['nama_unit']+'</option>');
                  });
                }
              });
        });
     });
   </script>