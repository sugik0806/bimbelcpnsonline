$(document).ajaxStart(function () {
	Pace.restart();
});

$("select").closest("form").on("reset",function(ev){
var targetJQForm = $(ev.target);
	setTimeout((function(){
		$(this).find("select").trigger("change");
	}).bind(targetJQForm),0);
});

$('form').on('reset', function(){
	var inputs = $('form select, form input, form textarea');
	$(this).find('.help-block').text('');
	inputs.closest('.form-group').removeClass('has-error has-success');
});


$(document).ready(function(){

	// $.ajax({
 //            type  : 'ajax',
 //            url   : base_url+'dashboard/dataCalender',
 //            async : true,
 //            dataType : 'json',
 //            success : function(data){
 //                console.info(data);
                
 //                var events = data;
                	
 //                	var date = new Date()
 //                	var d    = date.getDate(),
 //                	    m    = date.getMonth(),
 //                	    y    = date.getFullYear()
                	       
 //                	$('#calendar').fullCalendar({
 //                	  header    : {
 //                	    left  : 'prev,next today',
 //                	    center: 'title',
 //                	    right : 'month,agendaWeek,agendaDay'
 //                	  },
 //                	  buttonText: {
 //                	    today: 'today',
 //                	    month: 'month',
 //                	    week : 'week',
 //                	    day  : 'day'
 //                	  },
 //                	  events    : data
 //                	})
                
 //            }

 //        });

 	$.ajax({
            type  : 'get',
            url   : base_url+'dashboard/getDataMahasiswa',
            async : true,
            dataType : 'json',
            success : function(data){
            	var total_skd = 0;
            	var total_skb = 0;
                if (data.total_skd) {
                	total_skd = data.total_skd;
                }

                if (data.total_skb) {
                	total_skb = data.total_skb;
                }


                $('#total_skd').html(total_skd);
                $('#total_skb').html(total_skb);
                
                // var events = data;
                	
                // 	var date = new Date()
                // 	var d    = date.getDate(),
                // 	    m    = date.getMonth(),
                // 	    y    = date.getFullYear()
                	       
                // 	$('#calendar').fullCalendar({
                // 	  header    : {
                // 	    left  : 'prev,next today',
                // 	    center: 'title',
                // 	    right : 'month,agendaWeek,agendaDay'
                // 	  },
                // 	  buttonText: {
                // 	    today: 'today',
                // 	    month: 'month',
                // 	    week : 'week',
                // 	    day  : 'day'
                // 	  },
                // 	  events    : data
                // 	})
                
            }

        });

 

	$('.select2').select2();

	$('.froala-editor').froalaEditor({
		theme: 'royal',
		quickInsertTags: null,
		toolbarButtons: ['fullscreen', '|', 'bold', 'italic', 'strikeThrough', 'underline', '|', 'align', 'insertTable', 'insertLink','formatOL', 'formatUL', '|', 'html']
	});

	setInterval(function() {
		var date = new Date();
		var h = date.getHours(), m = date.getMinutes(), s = date.getSeconds();
		h = ("0" + h).slice(-2);
		m = ("0" + m).slice(-2);
		s = ("0" + s).slice(-2);

		var time = h + ":" + m + ":" + s ;
		$('.live-clock').html(time);
	}, 1000);

	$('#logout').on('click', function(e){
		e.preventDefault();

		Swal({
			title: "Logout",
			text: "Anda yakin ingin logout?",
			type: "question",
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Logout!'
		}).then((result) => {
			if(result.value){
				location.href=base_url+"logout";
			}
		});
	});
});