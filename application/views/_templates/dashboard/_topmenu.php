<a href="<?=base_url('dashboard')?>" class="logo">
    <span class="logo-mini"><b>BCO</b></span>
    <span class="logo-lg"><b>B</b>imbel <b>CPNS</b> <b>O</b>nline </span>
</a>

<nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    <img src="<?=base_url()?>assets/dist/img/bmerahp.png" class="user-image" alt="User Image">
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs">Hi, <?=$user->first_name?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- The user image in the menu -->
                    <li class="user-header">
                        <img src="<?=base_url()?>assets/dist/img/bmerahp.png" class="img-circle" alt="User Image">
                        <p>
                            
                            <?php if( $this->ion_auth->in_group('mahasiswa') ) : ?>
                            
                            <?=$mhs->nama?></br>
                            <!-- <?=$mhs->nama_jurusan?></br> -->
                            <?=$mhs->nama_kelas?></br>
                            <?php else : ?>
                                <?=$user->first_name?>
                            <?php endif; ?>     
                            <small>Terdaftar sejak <?=date('M, Y', $user->created_on)?></small>
                        </p>
                    </li>
                    <!-- Menu Body -->
                    <li class="user-footer">

                        <?php if( $this->ion_auth->is_admin() ) : ?>   
                            <?=form_open('auth/cek_login_as', array('id'=>'loginas'), array('identity'=>'copycut7@gmail.com', 'password'=>'123'))?> 

                                <div class="form-group col-md-12 pull-right">
                                  <!--  <label>Login Sebagai</label> -->
                                   <?php ?>
                                   <select name="username" required="required" id="username" class="select2 form-group" style="width:100% !important">
                                       <option value="" disabled selected>-- Login Sebagai --</option>
                                       <?php foreach ($loginas as $d) : ?>
                                           <option value="<?=$d->email?>"><?=$d->nama?></option>
                                       <?php endforeach; ?>
                                   </select>
                                   <small class="help-block" style="color: #dc3545"><?=form_error('username')?></small>
                                   
                                  <!--  <input type="hidden" name="id" value="<?=$jenis->id;?>"> -->
                                  
                                   <?php ?>
                               </div>

                               <input type="hidden" name="csrf_test_name" value="dsflkabsdf888ads888XXXXXX" />
                                        
                             <?=form_close()?>
                        <?php endif ?>

                        <div class="pull-left">
                            <a href="<?=base_url()?>users/edit/<?=$user->id?>" class="btn btn-default btn-flat">
                                <?=$this->ion_auth->is_admin() ? "Edit Profile" : "Ganti Password" ?>
                            </a>
                        </div>
                        <div class="pull-right">
                            <a href="#" id="logout" class="btn btn-default btn-flat">Keluar</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<script type="text/javascript">
    
    $('#username').on('change', function () {
         loginas($(this).val());

    });



    function loginas(id) {
        //get CSRF token
        var csrf = $('[name="csrf_test_name"]').val();

        //build the form data array
        var form_data = {
            csrf_test_name: csrf,
            identity: id,
            password: 123,
            username: id
        }

       $.ajax({
            url: base_url + 'auth/cek_login_as',
            type: 'POST',
            data: form_data,
            cache: false,
            success: function (data) {

                //console.info(data);
                var count = data.length;
                //$('#countduplikat').html(count);
                var html = '';
                var i;
                
                // for(i=0; i<data.length; i++){

                //     html += `<div class="alert with-border"><span class="badge bg-blue">`+data[i].nama+`</span> `+data[i].nama+`</div><hr>`;
                // }

                window.location.href = base_url+'dashboard';


                // $('#id_duplikasi').html(html);
                // $('#totalduplikasi').html(count);
                
                
            }
        });
    }
</script>