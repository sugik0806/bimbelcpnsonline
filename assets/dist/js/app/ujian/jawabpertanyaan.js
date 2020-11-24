var table;

    $(document).ready(function () {
        load_pertanyaan(2);

        ajaxcsrf();

        $("[data-widget='collapse']").click(function() {
            //Find the box parent........
            var box = $(this).parents(".box").first();
            //Find the body and the footer
            var bf = box.find(".box-body, .box-footer");
            if (!$(this).children().hasClass("fa-plus")) {
                $(this).children(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
                bf.slideUp();
            } else {
                //Convert plus into minus
                $(this).children(".fa-plus").removeClass("fa-plus").addClass("fa-minus");
                bf.slideDown();
            }
        });

      $('#filter_by').on('change', function(){
          // let id = $(this).val();
          load_pertanyaan($(this).val());
      });
    });


    function load_pertanyaan(id){

        $.ajax({
            type  : 'ajax',
            url   : base_url+'ujian/datapertanyaan/' + id,
            async : true,
            dataType : 'json',
            success : function(data){
                var count = data.length;
                $('#count').html(count);
                var html = '';
                var i;
                
                for(i=0; i<data.length; i++){
                    var plus = "";
                    var plusjwb = "";
                    var plusmhs = "";
                    var plusjwbper = "";

                    if (data[i].file) {
                        plus = ` <img style="margin-bottom: 25px" class="rounded mx-auto d-block img-fluid" src="`+data[i].fileimage+`">`;
                    }

                    if (data[i].file_a) {
                        plusjwb = ` <img style="margin-bottom: 25px" class="rounded mx-auto d-block img-fluid" src="`+data[i].fileimagejwb+`">`;
                    }

                    if (data[i].file_a) {
                        plusmhs = ` <img style="margin-bottom: 25px" class="rounded mx-auto d-block img-fluid" src="`+data[i].fileimagemhs+`">`;
                    }

                    if (data[i].jawaban_pertanyaan) {
                        plusjwbper = `<div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-right">Anda</span>
                                        <span class="direct-chat-timestamp pull-left">`+data[i].answer_date+`</span>
                                    </div>
                                    <img class="direct-chat-img" src="`+ base_url+'assets/dist/img/b.png'+`" alt="message user image">
                                    <div class="direct-chat-text" style="background: #FEFFE1">
                                        `+data[i].jawaban_pertanyaan+`
                                    </div>`;
                    }

                    html += `<div class="col-md-4">
                            <div class="box box-success direct-chat direct-chat-default">
                                <div class="box-header with-border">
                                    <h3 class="box-title">`+data[i].nama_ujian+`</h3>
                                    <div class="box-tools pull-right">
                                        <span data-toggle="tooltip" title="" class="badge bg-yellow">`+data[i].id_soal+`</span>
                                        
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                        <button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>
                                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-12 alert">
                                        <div class="text-justify">
                                         `+data[i].soal+`
                                        </div><hr>
                                        <div class="text-justify">
                                         `+data[i].pembahasan+`
                                        </div><hr>
                                          `+ plus +`
                                    </div>

                                        <div class="col-md-12" style="margin-top: -40px; margin-bottom: 10px;">
                                            <div class="col-md-6 text-center">

                                                <div class="text-justify badge bg-green">
                                                 Kunci : `+data[i].jawaban_benar+`
                                                </div></br>

                                                  `+ plusjwb +`
                                                `+data[i].opsi+`

                                            </div>

                                            <div class="col-md-6 text-center">
                                                <div class="text-center badge bg-blue">
                                                     Jawaban : `+data[i].jawabanmhs+`
                                                 </div></br>

                                                 `+ plusmhs +`
                                                `+data[i].opsimhs+`

                                            </div>
                                        </div>

                                        <div class="direct-chat-messages" style="background: #F9FFF9">
                                           <div class="direct-chat-msg">
                                                <div class="direct-chat-info clearfix">
                                                    <span class="direct-chat-name pull-left">`+data[i].nama+`</span>
                                                    <span class="direct-chat-timestamp pull-right">`+data[i].created_date+`</span>
                                                </div>
                                                <img class="direct-chat-img" src="`+ base_url+'assets/dist/img/b.png'+`" alt="message user image">
                                                <div class="direct-chat-text" style="background: #E8FFE9">
                                                    `+data[i].pertanyaan+`
                                                </div>
                                           </div>

                                            <div class="direct-chat-msg right">
                                                
                                                `+ plusjwbper +`
                                            </div>
                                        </div>

                                        <div class="direct-chat-contacts">
                                            <ul class="contacts-list">
                                              <li>
                                                <a href="#">
                                                  <img class="contacts-list-img" src="`+ base_url+'assets/dist/img/b.png'+`" alt="Contact Avatar">
                                                  <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                      Count Dracula
                                                      <small class="contacts-list-date pull-right">2/28/2015</small>
                                                      </span>
                                                      <span class="contacts-list-msg">How have you been? I was...</span>
                                                 </div>
                                                </a>
                                            </li>
                                            </ul>
                                        </div>
                                </div>
                                <div class="box-footer">
                                    <div class="input-group">

                                        <textarea rows="1" id="`+'message_'+i+`" name="`+'message_'+i+`" placeholder="Tulis Jawaban" class="form-control"></textarea>

                                        <span class="input-group-btn">
                                          <button type="button" onclick="return kirim(`+data[i].id_pertanyaan+`, `+i+`);" class="btn btn-success btn-flat">Jawab</button>
                                      </span>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                }
                $('#id_per').html(html);
                //$("#filter_by").val("sdfgsf");
                
            }

        });
    }

function kirim(id, no) {
    console.info(id, no);

    let mes = document.getElementById("message_"+no);
    console.info(mes);
    
    //simpan();
    ajaxcsrf();
    $.ajax({
        type: "POST",
        url: base_url + "ujian/kirim",
        data: { id: id, mes: mes.value},
        beforeSend: function () {
            //simpan();
            // $('.ajax-loading').show();    
        },
        success: function (r) {
            console.log(r);
            if (r.status) {
                //reload_ajax();
                load_pertanyaan(2);

                $("#filter_by").val("");
                ///window.location.href = base_url + 'ujian/jawabpertanyaan';
            }
        }
    });
}

// function bulk_delete() {
//     if ($('#ujian tbody tr .check:checked').length == 0) {
//         Swal({
//             title: "Gagal",
//             text: 'Tidak ada data yang dipilih',
//             type: 'error'
//         });
//     } else {
//         Swal({
//             title: 'Anda yakin?',
//             text: "Data akan dihapus!",
//             type: 'warning',
//             showCancelButton: true,
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             confirmButtonText: 'Hapus!'
//         }).then((result) => {
//             if (result.value) {
//                 $('#bulk').submit();
//             }
//         });
//     }
// }