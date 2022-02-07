"use strict";
var KTDatatables = function() {

	var initRolesTable = function() {
		var table = $('#roles_table');

		// begin first table
		table.DataTable({
			responsive: true,
			lengthMenu: [10, 20, 30, 40, 50],
			pageLength: 20,
			language: {
				'lengthMenu': 'Display _MENU_',
			},
			order: [[0, 'asc']],
			columnDefs: [
				{
					targets: 2,
					title: 'Actions',
					orderable: false,
					width: '125px',
					render: function(data, type, full, meta) {
						var par = {'title': 'Delete Role', 'class': ' icon-xl fas fa-toggle-off', 'color': ' btn-outline-danger'};
						
						return '\
	                        <a href="roles/'+data+'/edit"" class="btn btn-icon btn-outline-success btn-circle btn-sm mr-2" title="Update">\
	                            <i class="flaticon2-edit"></i>\
	                        </a>\
	                        <a onclick="activate_inactive(this); return false;"  href="'+data+'" class="btn btn-icon '+par['color']+' btn-circle btn-sm mr-2" title="'+par['title']+'">\
	                           <i class="'+par['class']+'"></i>\
	                        </a>\
	                    ';
					},
				},
				
			],
		});
	};
	var initUsersTable = function() {
		var table = $('#users_table');

		// begin first table
		table.DataTable({
			responsive: true,
			lengthMenu: [10, 20, 30, 40, 50],
			pageLength: 20,
			language: {
				'lengthMenu': 'Display _MENU_',
			},
			order: [[0, 'asc']],
			columnDefs: [
				{
					targets: 2,
					title: 'Actions',
					orderable: false,
					width: '125px',
					render: function(data, type, full, meta) {
						
						if(full[5] == "Inactive")
						{
							var par = {'title': 'Activate', 'class': ' icon-xl fas fa-toggle-on', 'color': ' btn-outline-success'};
						}
						else
						{
							var par = {'title': 'Deactivate', 'class': ' icon-xl fas fa-toggle-off', 'color': ' btn-outline-danger'};
						}
						
						return '\
	                        <a href="'+base_url_user+'/users/update/'+data+'" class="btn btn-icon btn-outline-success btn-circle btn-sm mr-2" title="Update">\
	                            <i class="flaticon2-edit"></i>\
	                        </a>\
	                        <a onclick="activate_deactivate(this); return false;" href="'+base_url_user+'/users/delete/'+data+'" class="btn btn-icon '+par['color']+' btn-circle btn-sm mr-2" title="'+par['title']+'">\
	                           <i class="'+par['class']+'"></i>\
	                        </a>\
	                    ';
					},
				},
				{
					targets: 6,
					render: function(data, type, full, meta) {
						var status = {
							'Active': {'title': 'Active', 'class': ' label-light-success'},
							'Inactive': {'title': 'Inactive', 'class': ' label-light-danger'}
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
					},
				},
				{
					targets: 3,
					className: 'dt-center',
					orderable: true,
				},
			],
		});
	};
	return {

		//main function to initiate the module
		init: function() {
			initRolesTable();
			initUsersTable();
		}
	};
}();

jQuery(document).ready(function() {
	KTDatatables.init();
});
