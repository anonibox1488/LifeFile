function loadEmployed(data){
	let employed = JSON.parse(data)
	let access = 'no';
	$('#id').val(employed.id)
	$('#code').val(employed.code)
	$('#name_update').val(employed.name)
	$('#middle_name_update').val(employed.middle_name)
	$('#last_name_update').val(employed.last_name)
	$('#email_update').val(employed.email)
	$("#departments_update > option[value="+employed.department_id+"]").attr("selected",true);
	if (employed.access_room_911) {
		access = 'yes';
	}
	$("#access_room_911_update > option[value="+access+"]").attr("selected",true);
}

function newEmployed() {

	let parameters = {
		"name"  : $('#name').val(),
		"middle_name"  : $('#middle_name').val(),
		"last_name"  : $('#last_name').val(),
		"email"  : $('#email').val(),
		"departments"  : $('#departments').val(),
		"access_room_911"  : $('#access_room_911').val(),
	};
	$.ajax({
		url     :  "api/employed",
		type    :  'POST',
		data    :   parameters,
		dataType:  'json',
		success :   function (data) {
			$('#new-employed').modal('hide');
			$('#success').show();
			$('#error_success').text(data.resp);
			$(location).attr('href','/room-911');
		},
		error   :   function(err) {
			if (err.status == 422) {
					$.each(err.responseJSON.errors, function( index, value ) {
						$("#"+index).addClass("is-invalid");
						$("#error_"+index).text(value);
					});	
				}else{
					$('#new-employed').modal('hide');
					$('#error').show();
				}
			}
	});
}

function updateEmployed() {

	let parameters = {
		"id"  : $('#id').val(),
		"name_update"  : $('#name_update').val(),
		"middle_name_update"  : $('#middle_name_update').val(),
		"last_name_update"  : $('#last_name_update').val(),
		"departments_update"  : $('#departments_update').val(),
		"access_room_911_update"  : $('#access_room_911_update').val(),
	};
	$.ajax({
		url     :  "api/employed",
		type    :  'PUT',
		data    :   parameters,
		dataType:  'json',
		success :   function (data) {
			$('#update').modal('hide');
			$('#success').show();
			$('#error_success').text(data.resp);
			$(location).attr('href','/room-911');
		},
		error   :   function(err) {
			if (err.status == 422) {
				$.each(err.responseJSON.errors, function( index, value ) {
					$("#"+index).addClass("is-invalid");
					$("#error_"+index).text(value);
				});	
			}else{
				$('#update').modal('hide');
				$('#error').show();
			}
		}
	});
}

