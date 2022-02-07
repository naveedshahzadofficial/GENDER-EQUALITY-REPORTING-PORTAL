function activate_deactivate(obj, controller) {
	var url = $(obj).attr('href');
	var title = $(obj).attr('title');
	var color = "";
	if(title == "Deactivate"){
		color = "#F64E60";
	}else{
		color = "#1BC5BD";
	}
	Swal.fire({
		title: 'Are you sure?',
		text: "",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: color,
		confirmButtonText: title
	}).then((result) => {
		if (result.isConfirmed) {

			window.location.replace(url);
		}
	})
}


function activate_inactive(obj, controller) {
	var url = $(obj).attr('href');

	var title = $(obj).attr('title');
	var color = "";
	if(title == "Deactivate"){
		color = "#F64E60";
	}else{
		color = "#1BC5BD";
	}
	Swal.fire({
		title: 'Are you sure?',
		text: "",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: color,
		confirmButtonText: title
	}).then((result) => {
		if (result.isConfirmed) {
			
			var form = $('#form')[0];
			form.action = url;
			//form['_method'] = "DELETE";
		
			form.submit(); 
		}
	})
}
