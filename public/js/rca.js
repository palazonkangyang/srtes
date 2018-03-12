$(function () {

 /**
  * start date and end date
  * @type {date}
  */

	$('.from_date').datetimepicker({
		format:'YYYY-MM-DD',
		sideBySide:true,
	});

	$('.to_date').datetimepicker({
		format:'YYYY-MM-DD',
		sideBySide:true,
		useCurrent: false,
	});

	$(".from_date").on("dp.change", function (e) {
		$('.to_date').data("DateTimePicker").minDate(e.date);
	});

	$(".to_date").on("dp.change", function (e) {
		$('.from_date').data("DateTimePicker").maxDate(e.date);
	});

	 /**
	  * start date and end date
	  * @type {date}
	  */
	$('.start_date').datetimepicker({
		format:'YYYY-MM-DD h:mm:ss a',
		sideBySide:true,
		defaultDate: new Date()
	});

	$('.end_date').datetimepicker({
		format:'YYYY-MM-DD h:mm:ss a',
		sideBySide:true,
		useCurrent: false, //Important! See issue #1075
		defaultDate : new Date()
	});

	$(".start_date").on("dp.change", function (e) {
		$('.end_date').data("DateTimePicker").minDate(e.date);
	});

	$(".end_date").on("dp.change", function (e) {
		$('.start_date').data("DateTimePicker").maxDate(e.date);
	});


	/**
	  * only date
	  * @type {date}
	  */
	$('.start_date_only').datetimepicker({
		format:'YYYY-MM-DD',
		sideBySide:true,
		defaultDate: new Date()
	});

	$('.end_date_only').datetimepicker({
		format:'YYYY-MM-DD',
		sideBySide:true,
		useCurrent: false, //Important! See issue #1075
		defaultDate : new Date()
	});

	$(".start_date_only").on("dp.change", function (e) {
		$('.end_date_only').data("DateTimePicker").minDate(e.date);
	});

	$(".end_date_only").on("dp.change", function (e) {
		$('.start_date_only').data("DateTimePicker").maxDate(e.date);
	});

	/**
	 * only hours without conditions
	 * @type {String}
	 */
	$('.start_date_nh').datetimepicker({
		format:'YYYY-MM-DD h a',
		sideBySide:true,
		defaultDate: new Date()
	});

	$('.end_date_nh').datetimepicker({
		format:'YYYY-MM-DD h a',
		sideBySide:true,
		useCurrent: false, //Important! See issue #1075
		defaultDate : new Date()
	});

	$(".start_date_nh").on("dp.change", function (e) {
		$('.end_date_nh').data("DateTimePicker").minDate(e.date);
	});

	$(".end_date_nh").on("dp.change", function (e) {
		$('.start_date_nh').data("DateTimePicker").maxDate(e.date);
	});

	/**
	 * only hours with conditions
	 */
	$('.start_date_hour').datetimepicker({
		format:'YYYY-MM-DD h:mm a',
		sideBySide:true,
		defaultDate: new Date()
	});

	$('.end_date_hour').datetimepicker({
		format:'YYYY-MM-DD h:mm a',
		sideBySide:true,
		useCurrent: false, //Important! See issue #1075
		defaultDate : new Date()
	});

	var now  = moment($('.start_date_hour').val(), ["YYYY-MM-DD hh:mm:ss a"]);
	var then = moment($('.end_date_hour').val(), ["YYYY-MM-DD hh:mm:ss a"]);
	calculateTime(now,then);


	$(".start_date_hour").on("dp.change", function (e) {

		var getVal =  $(this).val();
    var mydate = new Date(getVal);
    var n = mydate.getDay();

    var rates = document.getElementsByName('driver_requested');
		var rate_value;
		for(var i = 0; i < rates.length; i++)
		{
	    if(rates[i].checked){
	        getdriver = rates[i].value;
	    }
		}

		$('.end_date_hour').data("DateTimePicker").minDate(e.date);

		var now  = moment($('.start_date_hour').val(), ["YYYY-MM-DD hh:mm:ss a"]);
		var then = moment($('.end_date_hour').val(), ["YYYY-MM-DD hh:mm:ss a"]);

		if( n == 6 || n == 0 )
		{
			calculateTime(now,then);

			if(getdriver =='2' || getdriver=='3')
			{
				total = 0;
				$('#total_amount').val(total.toFixed(2));
 			}

			else
 			{
  			calculateTotalAmountVan();
 			}
		}

		else
		{
			calculateTime(now,then);
			calculateTotalAmountVan();
    }
	});

	$(".end_date_hour").on("dp.change", function (e) {

		var getVal  = moment($('.start_date_hour').val(), ["YYYY-MM-DD hh:mm:ss a"]);
	  var getdriver =  $('input[name=driver_requested]').val();
  	var mydate = new Date(getVal);
    var n = mydate.getDay();

		$('.start_date_hour').data("DateTimePicker").maxDate(e.date);

		var now  = moment($('.start_date_hour').val(), ["YYYY-MM-DD hh:mm:ss a"]);
		var then = moment($('.end_date_hour').val(), ["YYYY-MM-DD hh:mm:ss a"]);

		if( n == 6 || n == 0 )
		{
			calculateTime(now,then);
			total = 0;
 			$('#total_amount').val(total.toFixed(2));
		}

		else
		{
			calculateTime(now,then);
			calculateTotalAmountVan();
    }
	});

	function calculateTotalAmountVan()
	{
		if($('input[name=vehicle_type]').is(':checked'))
		{
			var getInitial =  $('input[name=number_of_minutes]').val();
	    getMin = (getInitial != '' ? getInitial : 0 );

	    total = parseFloat(getMin, 10) * parseFloat(0.33333334, 10);
	    $('#total_amount').val(total.toFixed(2));
	 }
	}

	function calculateTime(now, then)
	{
		var diff = moment.duration(moment(then).diff(moment(now)));
		var hrs = parseInt(diff.asHours());
		var mins = Math.floor(diff.asMinutes()) - hrs * 60;

		$('input[name=number_of_hours]').val(hrs + ' hours and ' + mins + ' minutes');

		var calulcatedMinute = parseInt(diff.asMinutes());
		$('input[name=number_of_minutes]').val(calulcatedMinute);
	}

	/**
	 * general date and time
	 * @type {date and time}
	 */
	$('.datetimepicker').datetimepicker({
		format:'YYYY-MM-DD h:mm:ss a',
	  sideBySide: true
	});

	window.setTimeout(function() {
	  $(".flash").fadeTo(500, 0).slideUp(500, function(){
	      $(this).remove();
	  });
	}, 5000);

	$('.btn-toggle .btn').click(function(e)
	{
		e.preventDefault();

		$('.success-settings').find('.alert-success').remove();
		$('.btn-toggle .btn').removeClass('active');
		$(this).addClass('active');

		if($(this).text() == 'ON')
		{
			$('.ooo-value').find('input').val('1');
		}

		else
		{
			$('.ooo-value').find('input').val('0');
		}

		var oooval = $('.ooo-value').find('input').val();
		var form = $('form.accountsettings');
		var action = form.attr('action');
		var method = form.attr('method');
		var formdata = new FormData(form[0]);

		$.ajaxSetup({
      headers: {
	    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
		});

		console.log();

		$.ajax({
	  	url     : action,
	    type    : method,
	    data    : formdata,
	    dataType: "json",
	    processData: false,
	    contentType: false,

			beforeSend:function()
			{
	    	$('.panel-heading').find('h4').append(' <span class="processing-time"><i class="fa fa-spinner fa-spin"></i></span>');
	    },

			success : function ( data )
	    {
	      $('.panel-heading').find('h4').find('.processing-time').remove();
	    	$('.success-settings').append(' <span class="alert-success save-stat-set">SAVE!</span> ');

		    setTimeout(function() {
		    	$('.save-stat-set').fadeOut();
		    }, 2000);

	      if(oooval == 1)
				{
					$('.ooo-header').fadeIn(500);

					$(".approver").empty();

					if(data.temp_approval_user.length > 0)
					{
						$.each(data.temp_approval_user, function(index, data) {
							$('.approver').append(
								'<div class="form-check"><label class="form-check-label">' +
								'<input type="radio" class="form-check-input temp_approver_id" name="temp_approver_id" value="' + data.idsrc_login + '"> ' +
								data.loginname +
								'</label></div>');
						});
					}

					$('#temp-approver-list').modal('toggle');
				}

				else
				{
					$('.ooo-header').fadeOut(500);
				}
	    }

	  });
	});

	// $(".btn-toggle .active").attr('disabled', true);

	$('body').on('click', '.temp_approver_id', function() {
    $("#temp_approver_btn").attr('disabled', false);
  });

	$("#temp_approver_btn").click(function() {

		$("#temp-approver-list").modal('hide');

		var temp_approver_id = $("input[name='temp_approver_id']:checked").val();

		var formData = {
			_token: $('meta[name="csrf-token"]').attr('content'),
			temp_approver_id: temp_approver_id,
		};

		$.ajax({
			type: 'POST',
			url: '/controller/tempapproveruser',
			data: formData,
			dataType: 'json',

			success: function(response)
			{
				$('#approver-success-message').modal('toggle');
			},

			error: function (response) {
				console.log(response);
			}
		});
	});


  $('[data-toggle="tooltip"]').tooltip();

  // $('.input-daterange').datepicker({ format: 'yyyy-mm-dd' });
  $(".clickable-row, .clickable-div").click(function() {
  	window.document.location = $(this).data("href");
  });

	$.fn.editable.defaults.mode = 'popup';
	$('.xedit').editable();
	$(document).on('click','.editable-submit',function() {

		var w = $(this).closest('td').children('span').attr('data-name');
		var x = $(this).closest('td').children('span').attr('id');
		var y = $('.input-cs').val();
		var z = $(this).closest('td').children('span');
		var url = "/settings/request/editablerequest/"+x+"/"+w+"/"+y;

		$.ajax({
			url: url,
			type: 'GET',
			success: function(s){
			if(s == 'status'){
				$(z).html(y);
			}
				if(s == 'error') {
				console.log('Error! Processing your Request!');}
			},
			error: function(e){
				console.log('Error! Processing your Request!!');
			}
		});
	});

	$('input.width-control-hour').bind('keypress', function (e) {
	   if(this.value.length >= 3) return false;

	    return !(e.which != 8 && e.which != 0 &&
	            (e.which < 48 || e.which > 57) && e.which != 46);
	});


	$('.approver, .ccperson').autocomplete({

	    serviceUrl: '/application/getjsonuser',
	    dataType: 'json',
	    contentType: "application/json; charset=utf-8",
	    type: 'GET',

	    onSelect: function (suggestion) {
	        getselector = $(this);

	        if(suggestion.data.id != '') {
		        switch (getselector.attr('id'))
						{
			        case 'approver':
			            $('.approver-selected').html('<div class="approver-selected-row"><b>You selected: </b>' +suggestion.value+ ' - '+suggestion.data.email+' <a class="add-approver" id="add-approver">[ADD]</a></div>');
		    			loadAddPerson('.add-approver', '.approver-selected-row', '.approver-added', '.approver-selected', suggestion, approver_limit, cc_limit);
		    			break;

		    		 	case 'approver_project_claims':
			          $('.approver-selected').html('<div class="approver-selected-row"><b>You selected: </b>' +suggestion.value+ ' - '+suggestion.data.email+' <a class="add-approver_project_claims" id="add-approver_project_claims">[ADD]</a></div>');
		    			loadAddPerson('.add-approver_project_claims', '.approver-selected-row', '.approver-added1', '.approver-selected', suggestion, approver_limit, cc_limit);
		    			break;

            	case 'approver_cashadvance_acquittal':
			          $('.approver-selected').html('<div class="approver-selected-row"><b>You selected: </b>' +suggestion.value+ ' - '+suggestion.data.email+' <a class="add-approver_cashadvance_acquittal" id="add-approver_cashadvance_acquittal">[ADD]</a></div>');
		    			loadAddPerson('.add-approver_cashadvance_acquittal', '.approver-selected-row', '.approver-added1', '.approver-selected', suggestion, approver_limit, cc_limit);
		    			break;

			      	case 'ccperson':
			            $('.ccperson-selected').html('<div class="ccperson-selected-row"><b>You selected: </b>' +suggestion.value+ ' - '+suggestion.data.email+' <a class="add-ccperson" id="add-ccperson">[ADD]</a></div>');
		    			loadAddPerson('.add-ccperson', '.ccperson-selected-row', '.ccperson-added', '.ccperson-selected', suggestion, approver_limit, cc_limit);

			        break;
			    	}
					}
	    },

	    onInvalidateSelection: function() {
	        getselector = $(this);

	          switch (getselector.attr('id')) {
		        case 'approver':
		          	$('.approver-selected').html('<b>You selected: </b>none');
		            break;

		        case 'ccperson':
		          	$('.ccperson-selected').html('<b>You selected: </b>none');
		            break;
		    }
	    },

	    showNoSuggestionNotice: true,
	    noSuggestionNotice: 'Sorry, no matching results'
	});


	$('.flexigroup').autocomplete({

	    serviceUrl: '/application/getjsonflexigroup',
	    dataType: 'json',
	    contentType: "application/json; charset=utf-8",
	    type: 'GET',

	    onSelect: function (suggestion) {
	        getselector = $(this);

	        if(suggestion.data.id != '') {
		        switch (getselector.attr('id')) {
			        case 'flexigroup':
			            $('.approver-selected').html('<div class="approver-selected-row"><b>You selected: </b>' +suggestion.value+ ' - '+suggestion.data.email+' <a class="add-approver" id="add-approver">[ADD]</a></div>');
		    			loadAddPerson('.add-approver', '.approver-selected-row', '.approver-added', '.approver-selected', suggestion, approver_limit, cc_limit);
		    			break;
			    	}
					}
	   	},

	    onInvalidateSelection: function() {
	        getselector = $(this);

	          switch (getselector.attr('id')) {
		        case 'flexigroup':
		          	$('.approver-selected').html('<b>You selected: </b>none');
		            break;
		    }
	    },

	    showNoSuggestionNotice: true,
	    noSuggestionNotice: 'Sorry, no matching results'
	});

	$('.approver-with-me').autocomplete({

	    serviceUrl: '/application/getjsonuser/?with=true',
	    dataType: 'json',
	    contentType: "application/json; charset=utf-8",
	    type: 'GET',

	    onSelect: function (suggestion) {
	        getselector = $(this);

	        if(suggestion.data.id != '') {
		        switch (getselector.attr('id')) {
			        case 'approver':
			            $('.approver-selected').html('<div class="approver-selected-row"><b>You selected: </b>' +suggestion.value+ ' - '+suggestion.data.email+' <a class="add-approver" id="add-approver">[ADD]</a></div>');
		    			loadAddPerson('.add-approver', '.approver-selected-row', '.approver-added', '.approver-selected', suggestion, approver_limit, cc_limit);
		    			break;

			         case 'groupmember':
			            $('.approver-selected').html('<div class="approver-selected-row"><b>You selected: </b>' +suggestion.value+ ' - '+suggestion.data.email+' <a class="add-groupmember" id="add-groupmember">[ADD]</a></div>');
		    			loadAddPerson('.add-groupmember', '.approver-selected-row', '.approver-added', '.approver-selected', suggestion, approver_limit, cc_limit);
		    			break;

			        case 'ccperson':
			            $('.ccperson-selected').html('<div class="ccperson-selected-row"><b>You selected: </b>' +suggestion.value+ ' - '+suggestion.data.email+' <a class="add-ccperson" id="add-ccperson">[ADD]</a></div>');
		    			loadAddPerson('.add-ccperson', '.ccperson-selected-row', '.ccperson-added', '.ccperson-selected', suggestion, approver_limit, cc_limit);

			            break;

			    }
			}


	    },
	    onInvalidateSelection: function() {
	        getselector = $(this);

	          switch (getselector.attr('id')) {
		        case 'approver':
		          	$('.approver-selected').html('<b>You selected: </b>none');
		            break;

		        case 'ccperson':
		          	$('.ccperson-selected').html('<b>You selected: </b>none');
		            break;

		    }

	    },
	    showNoSuggestionNotice: true,
	    noSuggestionNotice: 'Sorry, no matching results'
	});


});

function loadAddPerson(selector, selected, addclass, wrapaddclass, suggestion, apprlimit, cclimit){
	$(selector).on('click', function(e,i){

		var countIn = (selector == '.add-ccperson' ? cclimit : apprlimit);

		if(countAddedPerson(addclass) < countIn) {

				getselector = $(this);
				switch (getselector.attr('id')) {
			        case 'add-approver':
			        	getid = suggestion.data.id;
			        	selid = $(addclass).find('input').get(0);
			        	compid = $('input[name^=approver], input[name^=ccperson]');

			        	if(selid){

			        		if(!existPerson(compid, getid, this.value)){
			        			errDisp(wrapaddclass, 'Already added on the list!', '6000');
			        		}else {
			        			appendSelected(addclass,selected,suggestion,'approver');
			        		}

			          	} else {
			          		if(!existPerson(compid, getid, this.value)){
			        			errDisp(wrapaddclass, 'Already added on the list!', '6000');
			        		}else {
			        			appendSelected(addclass,selected,suggestion,'approver');
			        		}

			          		//appendSelected(addclass,selected,suggestion,'approver');
						}

			            break;

                                case 'add-approver_project_claims':
			        	getid = suggestion.data.id;
			        	selid = $(addclass).find('input').get(0);
			        	compid = $('input[name^=approver], input[name^=ccperson]');

			        	if(selid){

			        		if(!existPerson(compid, getid, this.value)){
			        			errDisp(wrapaddclass, 'Already added on the list!', '6000');
			        		}else {
			        			appendSelectedproject_claims(addclass,selected,suggestion,'approver');
			        		}

			          	} else {
			          		if(!existPerson(compid, getid, this.value)){
			        			errDisp(wrapaddclass, 'Already added on the list!', '6000');
			        		}else {
			        			appendSelectedproject_claims(addclass,selected,suggestion,'approver');
			        		}

			          		//appendSelected(addclass,selected,suggestion,'approver');
						}

			            break;

                                  case 'add-approver_cashadvance_acquittal':
			        	getid = suggestion.data.id;
			        	selid = $(addclass).find('input').get(0);
			        	compid = $('input[name^=approver], input[name^=ccperson]');

			        	if(selid){

			        		if(!existPerson(compid, getid, this.value)){
			        			errDisp(wrapaddclass, 'Already added on the list!', '6000');
			        		}else {
			        			appendSelectedcashadvance_acquittal(addclass,selected,suggestion,'approver');
			        		}

			          	} else {
			          		if(!existPerson(compid, getid, this.value)){
			        			errDisp(wrapaddclass, 'Already added on the list!', '6000');
			        		}else {
			        			appendSelectedcashadvance_acquittal(addclass,selected,suggestion,'approver');
			        		}

			          		//appendSelected(addclass,selected,suggestion,'approver');
						}

			            break;

                                case 'add-groupmember':
			        	getid = suggestion.data.id;
			        	selid = $(addclass).find('input').get(0);
			        	compid = $('input[name^=approver], input[name^=ccperson]');

			        	if(selid){

			        		if(!existPerson(compid, getid, this.value)){
			        			errDisp(wrapaddclass, 'Already added on the list!', '6000');
			        		}else {
			        			appendSelected_group(addclass,selected,suggestion,'approver');
			        		}

			          	} else {
			          		if(!existPerson(compid, getid, this.value)){
			        			errDisp(wrapaddclass, 'Already added on the list!', '6000');
			        		}else {
			        			appendSelected_group(addclass,selected,suggestion,'approver');
			        		}

			          		//appendSelected(addclass,selected,suggestion,'approver');
						}

			            break;


			        case 'add-ccperson':
			          	getid = suggestion.data.id;
			        	selid = $(addclass).find('input').get(0);
			        	compid = $('input[name^=ccperson], input[name^=approver]');

			        	if(selid){

			        		if(!existPerson(compid, getid, this.value)){
			        			errDisp(wrapaddclass, 'Already added on the list!', '6000');
			        		}else {
			        			appendSelected(addclass,selected,suggestion,'ccperson');
			        		}

			          	} else {
			          		if(!existPerson(compid, getid, this.value)){
			        			errDisp(wrapaddclass, 'Already added on the list!', '6000');
			        		}else {
			        			appendSelected(addclass,selected,suggestion,'ccperson');
			        		}
			          		//appendSelected(addclass,selected,suggestion,'ccperson');
						}

			            break;

			    }


		} else {
			errDisp(wrapaddclass, 'You can only add upto '+countIn+' Person!', '6000')
		}



		$(addclass).parent().find('input.form-control').val('');



	});
}

function loadRemovePerson(selector){

	$(selector).on('click', function(e,i){
		$('span.numbering_method').remove();
		$(this).parent().remove();
		append_numbering();
	});
}


function errDisp(selector, errmsg, speed){
	speed = speed || "3000";

	$(selector).html('<span class="alert alert-danger tp">'+errmsg+'</span>');
	setTimeout(function(){
	  $(selector+ '> span').remove();
	}, speed);
}

function existPerson(a,b){
	isValid = true;
		a.each(function() {
		  if(b == this.value){
		  	isValid = false;
		  }
		});
	return isValid;
}

function appendSelected(a,b,c,d){
	$('span.numbering_method').remove();

	if(c.temp_approver_data.temp_approver_id > 0)
	{
		$(a).append(
			'<div><i class="glyphicon glyphicon-minus-sign minus-'+d+'"></i> '+
			c.value + ' <small><b>'+c.data.email+'</b></small><input type="hidden" name="'+d+'[]" value="'+c.data.id+'" /><br>' +
			'<span class="temp_approver"><strong>[Replacer]</strong></span> ' + c.temp_approver_data.temp_approver_name + ' <small><b>'+ c.temp_approver_data.temp_approver_email +'</b></small><input type="hidden" name="temp_approver[]" value="'+c.temp_approver_data.temp_approver_id+'" />' +
			'</div>');
	}

	else
	{
		$(a).append(
			'<div><i class="glyphicon glyphicon-minus-sign minus-'+d+'"></i> '+
			c.value+ ' <small><b>'+c.data.email+'</b></small><input type="hidden" name="'+d+'[]" value="'+c.data.id+'" />' +
			'<span class="temp_approver"></span><input type="hidden" name="temp_approver[]" value="" />' +
			'</div>');
	}

	$(b).hide();
	loadRemovePerson('.minus-'+d);

	append_numbering();
}


function appendSelectedproject_claims(a,b,c,d){


	$(a).append('<div><i class="glyphicon glyphicon-minus-sign minus-'+d+'"></i><span class="numbering_method"> <strong>[ 1st Verify ] </strong> </span> '+c.value+ ' <small><b>'+c.data.email+'</b></small><input type="hidden" name="'+d+'[]" value="'+c.data.id+'" /></div>');
	$(b).hide();
	loadRemovePerson('.minus-'+d);

}

function appendSelectedcashadvance_acquittal(a,b,c,d){


	$(a).append('<div><i class="glyphicon glyphicon-minus-sign minus-'+d+'"></i><span class="numbering_method"> <strong>[ 2rd Verify ] </strong> </span> '+c.value+ ' <small><b>'+c.data.email+'</b></small><input type="hidden" name="'+d+'[]" value="'+c.data.id+'" /></div>');
	$(b).hide();
	loadRemovePerson('.minus-'+d);

}



function appendSelected_group(a,b,c,d){
	$('span.numbering_method').remove();

	$(a).append('<div><i class="glyphicon glyphicon-minus-sign minus-'+d+'"></i> '+c.value+ ' <small><b>'+c.data.email+'</b></small><input type="hidden" name="'+d+'[]" value="'+c.data.id+'" /></div>');
	$(b).hide();
	loadRemovePerson('.minus-'+d);

	append_numbering_group();

}

function countAddedPerson(selector){
	return $(selector + "> div").length;
}

function append_numbering(){
	$(".approver-added > div").each(function(i) {

		switch (i) {
		case 0:
			$(this).find("i").after('<span class="numbering_method"> <strong>['+ ++i +'st Approver] </strong> <span>');
			break;
		case 1:
			$(this).find("i").after('<span class="numbering_method"> <strong>['+ ++i +'nd Approver] </strong> <span>');
			break;
		case 2:
			$(this).find("i").after('<span class="numbering_method"> <strong>['+ ++i +'rd Approver] </strong> <span>');
			break;
		case 3:
			$(this).find("i").after('<span class="numbering_method"> <strong>['+ ++i +'th Approver] </strong> <span>');
			break;
		}


	});
}

 function append_numbering_group(){
	$(".approver-added > div").each(function(i) {
			$(this).find("i").after('<span class="numbering_method"> <strong>['+ ++i +'. Member] </strong> <span>');
	});
}
