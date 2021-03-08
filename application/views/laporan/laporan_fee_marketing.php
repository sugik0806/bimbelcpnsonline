
<style type="text/css">
    .big-box h2 {
        text-align: center;
        width: 100%;
        font-size: 1.8em;
        letter-spacing: 2px;
        font-weight: 700;
        text-transform: uppercase;
        cursor:pointer;
    }
    .modal-dialog {
        width: 100%;
        height: 100%;
        padding: 0;
        margin:0;
    }
    .modal-content {
        height: 100%;
        border-radius: 0;
        color:#333;
        overflow:auto;
    }
    .modal-title {
        font-size: 3em;
        font-weight: 300;
        margin: 0 0 10px 0;
    }
    .close {
        color:black ! important;
        opacity:1.0;
    }
</style>


<!-- modal -->
<div class="container-fluid">
    <div class="row">        
        <div class="col-md-12" >
            
            <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog text-justify">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h3 class="modal-title" id="myModalLabel"><strong>Pembayaran Fee</strong>
                            </br>
                            <!-- <small>Published Juni, 2015</small></h3> -->
                        </div>
                        <div class="modal-body">  
                            <div class="col-sm-3">
                                    <label class="pull-right">Periode</label>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input id="tgl_awal_modal" name="tgl_awal" type="text" class="datetimepicker form-control" placeholder="Tanggal Awal">
                                    <small class="help-block"></small>
                                </div>
                            </div>    
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input id="tgl_akhir_modal" name="tgl_akhir" type="text" class="datetimepicker form-control" placeholder="Tanggal Akhir">
                                    <small class="help-block"></small>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group col-md-8">
                                    
                                    <!-- <select id="penerima_fee" name="penerima_fee" class="form-control select2 pull-left">
                                        <option value="0">- Penerima Fee -</option>
                                        <option value="arw04032021">arw04032021</option>
                                        <option value="90000252298">90000252298</option>
                                    </select> -->
                                    <?php ?>
                                        <select id="penerima_fee_modal" class="select2" style="width:100% !important">
                                            <option value="0">-- Pilih Penerima Fee --</option>
                                            <?php foreach ($referal as $m) :?>
                                                <option value="<?=$m->referal?>"><?=$m->nama_marketing?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php ?>
                                    <small class="help-block"></small>
                                </div>
                                 <button class="btn btn-success btn-flat btn-sm pull-right" onclick="cetak()"><i class="fa fa-print"></i> Print</button>
                                <!-- <a type="button" target="_blank" href="<?=base_url()?>laporan/cetak_fee" class="btn btn-success btn-flat btn-sm pull-right"><i class="fa fa-print"></i> print</a> -->

                                <h6 class="btn btn-flat btn-sm btn-success" data-toggle="modal" data-target="#modal1">Bayar</h6>
                            </div>

                            <!-- table -->
                            
                            <div class="table-responsive px-4 pb-3 pull-left" style="border: 0">
                                <table id="pendapatanmodal" class="w-100 table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Nama Kelas</th>
                                        <th>Harga</th>
                                        <th>Angka Unik</th>
                                        <th>Diskon</th>
                                        <th>Fee</th>
                                        <th>Penerima Fee</th>
                                        <th class="text-center">
                                            <i class="fa fa-search"></i>
                                        </th>
                                    </tr>        
                                </thead>
                                 <!-- <?php 
                                $query = "select * from employee";
                                $result = mysqli_query($con,$query);
                                while($row = mysqli_fetch_array($result)){
                                  $id = $row['id'];
                                  $name = $row['emp_name'];
                                  $email = $row['email'];

                                  echo "<tr>";
                                  echo "<td>".$name."</td>";
                                  echo "<td>".$email."</td>";
                                  echo "<td><button data-id='".$id."' class='userinfo'>Info</button></td>";
                                  echo "</tr>";
                                }
                                ?> -->
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Nama Kelas</th>
                                        <th>Harga</th>
                                        <th>Angka Unik</th>
                                        <th>Diskon</th>
                                        <th>Fee</th>
                                        <th>Penerima Fee</th>
                                        <th class="text-center">
                                            <i class="fa fa-search"></i>
                                        </th>
                                    </tr>
                                </tfoot>
                                </table>


                                <p id="test"></p>
                                <p id="test2"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->


<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?=$subjudul?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-3">
                <button type="button" onclick="reload_ajax()" class="btn bg-purple btn-flat btn-sm">
                    <i class="fa fa-refresh"></i> Reload</button>
                    <label class="pull-right">Periode</label>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input id="tgl_awal" name="tgl_awal" type="text" class="datetimepicker form-control" placeholder="Tanggal Awal">
                    <small class="help-block"></small>
                </div>
            </div>    
            <div class="col-md-2">    
                <div class="form-group">
                    <input id="tgl_akhir" name="tgl_akhir" type="text" class="datetimepicker form-control" placeholder="Tanggal Akhir">
                    <small class="help-block"></small>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-group col-md-8">
                    
                    <!-- <select id="penerima_fee" name="penerima_fee" class="form-control select2 pull-left">
                        <option value="0">- Penerima Fee -</option>
                        <option value="arw04032021">arw04032021</option>
                        <option value="90000252298">90000252298</option>
                    </select> -->
                    <?php ?>
                        <select id="penerima_fee" class="select2" style="width:100% !important">
                            <option value="0">-- Pilih Penerima Fee --</option>
                            <?php foreach ($referal as $m) :?>
                                <option value="<?=$m->referal?>"><?=$m->nama_marketing?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php ?>
                    <small class="help-block"></small>
                </div>
                 <button class="btn btn-success btn-flat btn-sm pull-right" onclick="cetak()"><i class="fa fa-print"></i> Print</button>
                <!-- <a type="button" target="_blank" href="<?=base_url()?>laporan/cetak_fee" class="btn btn-success btn-flat btn-sm pull-right"><i class="fa fa-print"></i> print</a> -->

                <h6  onclick="loadModal()" class="btn btn-flat btn-sm btn-success" data-toggle="modal" data-target="#modal1">Bayar</h6>
            </div>

        </div>
    </div>
    <div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="pendapatan" class="w-100 table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Nama Kelas</th>
                <th>Harga</th>
                <th>Angka Unik</th>
                <th>Diskon</th>
                <th>Fee</th>
                <th>Penerima Fee</th>
                <th class="text-center">
                    <i class="fa fa-search"></i>
                </th>
            </tr>        
        </thead>
        <tfoot>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Nama Kelas</th>
                <th>Harga</th>
                <th>Angka Unik</th>
                <th>Diskon</th>
                <th>Fee</th>
                <th>Penerima Fee</th>
                <th class="text-center">
                    <i class="fa fa-search"></i>
                </th>
            </tr>
        </tfoot>
        </table>
    </div>
</div>

<script src="<?=base_url()?>assets/dist/js/app/laporan/laporan_fee_marketing.js"></script>