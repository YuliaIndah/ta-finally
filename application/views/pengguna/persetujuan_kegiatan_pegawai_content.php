<section id="main-content">
  <section class="wrapper">            
    <!--overview start-->
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header text-center" style="margin-top: 0;">Persetujuan Kegiatan Pegawai</h3>
       <!--  <ol class="breadcrumb">
          <li><i class="fa fa-user"></i><a href="#">Kepala Departemen</a></li>
          <li><i class="fa fa-pencil"></i>Pengajuan Kegiatan</li>                
        </ol> -->
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <!-- Alert -->
        <?php 
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
                <?php
                  // var_dump($detail_kegiatan);
                ?>
                <table id="example" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
                  <thead>
                    <tr class="text-center">
                      <th class="text-center">Nama Kegiatan</th>
                      <th class="text-center">Nama Pengaju</th>
                      <th class="text-center">Jabatan Pengaju</th>
                      <th class="text-center">Tgl Pengajuan</th>
                      <th class="text-center">Tgl Kegiatan</th>
                      <th class="text-center">Dana Diajukan</th>
                      <th class="text-center">File</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($data_pengajuan_kegiatan_pegawai as $kegiatan) {
                      ?>
                      <tr>
                        <td class="text-center relative">
                          <div class="relative">
                            <strong><?php echo $kegiatan->nama_kegiatan;?></strong>
                            <a href="#myModal1" id="custID" data-toggle="modal" data-id="<?php echo $kegiatan->kode_kegiatan;?>" title="klik untuk melihat detail kegiatan"><small class="kecil">Lihat detail</small></a>
                          </div>
                        </td>
                        <?php 
                        $jabatan        = $KegiatanM->get_data_pengajuan_by_id($kegiatan->kode_kegiatan)->result()[0];
                        $unit           = $KegiatanM->get_data_pengajuan_by_id($kegiatan->kode_kegiatan)->result()[0];
                        $progress       = $KegiatanM->get_progress($kegiatan->kode_kegiatan);
                        $progress_tolak = $KegiatanM->get_progress_tolak($kegiatan->kode_kegiatan);
                        ?>
                        <td class="text-center"><?php echo $jabatan->nama;?></td>
                        <td class="text-center"><?php echo $jabatan->nama_jabatan." ".$unit->nama_unit;?></td>
                        <?php 
                        $tgl_pengajuan = $kegiatan->tgl_pengajuan;
                        $new_tgl_pengajuan = date('d-m-Y',strtotime($tgl_pengajuan));
                        $tgl_kegiatan = $kegiatan->tgl_kegiatan;
                        $new_tgl_kegiatan = date('d-m-Y', strtotime($tgl_kegiatan));
                        $tgl_selesai = $kegiatan->tgl_selesai_kegiatan;
                        $new_tgl_selesai = date('d-m-Y', strtotime($tgl_selesai));
                        ?>
                        <td class="text-center"><?php echo $new_tgl_pengajuan; ?></td>
                        <td class="text-center">
                          <div class="relative">
                           <small class="kecil"><strong><?php echo $new_tgl_kegiatan?></strong></small>
                           <small class="kecil">sampai</small>
                           <small class="kecil"><strong><?php echo $new_tgl_selesai; ?></strong></small>
                         </div>
                       </td>
                       <td><?php echo $kegiatan->dana_diajukan;?></td>
                       <?php $link = base_url()."assets/file_upload/".$kegiatan->nama_file;?>
                       <td class="text-center"><a target="_blank" href="<?php echo $link?>"><span><img src="<?php echo base_url()?>assets/image/logo/pdf.svg" style="height: 30px;"></span></a></td>
                       <td class="text-center">
                        <?php 
                        $progress       = $KegiatanM->get_progress($kegiatan->kode_kegiatan);
                        $progress_tolak = $KegiatanM->get_progress_tolak($kegiatan->kode_kegiatan);
                        $own_id     = $data_diri->kode_jabatan_unit; //id sendri
                        $max        = $cek_max_pegawai->ranking; //id pengguna rank tertinggi
                        $id_max     = $KegiatanM->cek_id_by_rank_pegawai($max)->kode_jabatan_unit; //id yang rank nya max
                        $kode = $kegiatan->kode_kegiatan; 
                        $own  = $KegiatanM->get_own_progress($kode, $own_id);
                          // echo $progress;
                          // echo $progress_tolak;
                        $id_staf_keu = $cek_id_staf_keu[0]->kode_jabatan_unit; 
                        $progress_staf_keu = $KegiatanM->get_own_progress($kode, $id_staf_keu);
                        if($progress_staf_keu > 0){ //sudah ada input staf keu
                          $progress_nama = $KegiatanM->get_progress_by_id($id_staf_keu, $kode)->result()[0]->nama_progress;
                          ?>
                          <a class="label label-warning" href="#modal_progress" id="custID" data-toggle="modal" data-id="<?php echo $kegiatan->kode_kegiatan;?>" title="klik untuk melihat detail progress"><?php echo $progress_nama?></a>
                          <?php
                        }else{
                          
                          if($progress_tolak == 1){
                            ?>
                            <a class="label label-danger" href="#modal_progress" id="custID" data-toggle="modal" data-id="<?php echo $kegiatan->kode_kegiatan;?>" title="klik untuk melihat detail progress"><b>Ditolak</b></a>
                            <?php
                          }else{
                           if($progress == 1){ //jika sudah punya porgress 1
                          $input_id = $KegiatanM->get_progress_who($kode)[0]->kode_jabatan_unit;//jika yang input dia sendiri
                          if($input_id == $own_id && $id_max == $own_id){ //yang inputin progress dia dan dia adalah max
                            ?>
                            <a class="label label-success" href="#modal_progress" id="custID" data-toggle="modal" data-id="<?php echo $kegiatan->kode_kegiatan;?>" title="klik untuk melihat detail progress">Disetujui</a>
                            <?php
                          }else{
                            ?>
                            <a class="label label-default" href="#modal_progress" id="custID" data-toggle="modal" data-id="<?php echo $kegiatan->kode_kegiatan;?>" title="klik untuk melihat detail progress">Proses</a>
                            <?php
                          }
                        }elseif ($progress > 1) {
                          ?>
                          <a class="label label-success" href="#modal_progress" id="custID" data-toggle="modal" data-id="<?php echo $kegiatan->kode_kegiatan;?>" title="klik untuk melihat detail progress">Disetujui</a>
                          <?php
                        }elseif ($progress == 0) {
                          ?>
                          <span class="label label-info">Baru</span>
                          <?php
                        }
                      }
                    }
                    ?>
                  </td>
                  <td class="text-center">
                    <?php
                    if($own_id == $id_max){
                       if($own > 0){ //SUDAH INPUT 
                        ?>
                        <a disabled title="Sudah"><span class="glyphicon glyphicon-ok"></a>
                          <?php
                        }else{
                         $progress_tolak = $KegiatanM->get_progress_tolak($kegiatan->kode_kegiatan);
                         if($progress_tolak == 1){
                           ?>
                           <a href="#" id="custId" disabled data-toggle="modal" data-id="<?php echo $kegiatan->kode_kegiatan;?>" data-toggle="tooltip" title="Selesai" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
                           <?php
                         }else{
                          $acc_atasan = $KegiatanM->get_own_progress($kode, $kegiatan->pimpinan);
                          if ($acc_atasan > 0){
                           ?>
                           <a href="#myModal" id="custId" data-toggle="modal" data-id="<?php echo $kegiatan->kode_kegiatan;?>" data-toggle="tooltip" title="Masukkan Persetujuan" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
                           <?php
                         }else{
                           ?>
                           <a id="custId" disabled data-toggle="modal" data-id="<?php echo $kegiatan->kode_kegiatan;?>" data-toggle="tooltip" title="Belum disetujui atasan" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
                           <?php
                         }
                       }
                     }

                   }else{
                      $own_rank   = $KegiatanM->cek_rank_by_id_pegawai($own_id)->ranking; //rank sendiri
                      $rank_next  = ((int)$own_rank + 1); //id yang punya rank sendri + 1
                      $id_next    = $KegiatanM->cek_id_by_rank_pegawai($rank_next)->kode_jabatan_unit; //id yang ranknya ranksendiri + 1
                      $progress_id_next = $KegiatanM->get_own_progress($kegiatan->kode_kegiatan, $id_next); //progress id yang ranknya ranksendiri + 1
                      if($progress_id_next == "1"){
                       if($own > 0){?>
                       <a disabled title="Sudah"><span class="glyphicon glyphicon-ok"></a>
                        <?php
                      }else{
                       $progress_tolak = $KegiatanM->get_progress_tolak($kegiatan->kode_kegiatan);
                       if ($progress_tolak == 1) {
                         ?>
                         <a href="#" id="custId" disabled data-toggle="modal" data-id="<?php echo $kegiatan->kode_kegiatan;?>" data-toggle="tooltip" title="Selesai" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
                         <?php
                       }else{
                         ?>
                         <a href="#myModal" id="custId" data-toggle="modal" data-id="<?php echo $kegiatan->kode_kegiatan;?>" data-toggle="tooltip" title="Masukkan Persetujuan" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
                         <?php 
                       }
                     }
                   }else{
                    ?>
                    <a href="#" id="custId" disabled data-toggle="modal" data-id="<?php echo $kegiatan->kode_kegiatan;?>" data-toggle="tooltip" title="Selesai" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
                    <?php
                  }
                }
                ?>
              </td>
            </tr>
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
</section>
<div class="text-center">
  <div class="credits">
    <a href="https://bootstrapmade.com/free-business-bootstrap-themes-website-templates/">Business Bootstrap Themes</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a>
  </div>
</div>
</section>
<!-- modal detail pengajuan -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Persetujuan Kegiatan</h4>
      </div>
      <div class="modal-body">
        <div class="fetched-data"></div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<!-- modal detail kegiatan -->
<div class="modal fade" id="myModal1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail Kegiatan</h4>
      </div>
      <div class="modal-body">
        <div class="fetched-data"></div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
    // js detail pengajuan
    $(document).ready(function(){
      $('#myModal').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
              type : 'get',
              url : '<?php echo base_url().'KegiatanC/detail_pengajuan/'?>'+rowid,
                //data :  'rowid='+ rowid, // $_POST['rowid'] = rowid
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
              }
            });
          });
    });

// js detail kegiatan
$(document).ready(function(){
  $('#myModal1').on('show.bs.modal', function (e) {
    var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
              type : 'get',
              url : '<?php echo base_url().'KegiatanC/detail_kegiatan/'?>'+rowid,
                //data :  'rowid='+ rowid, // $_POST['rowid'] = rowid
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
              }
            });
          });
});

</script>