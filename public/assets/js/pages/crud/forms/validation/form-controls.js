// Class definition
var KTFormControls = function () {
	// Private functions
	var _initInstituteForm = function () {
		FormValidation.formValidation(
			document.getElementById('add_institute_form'),
			{
				fields: {
					institute_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},

					institute_status: {
						validators: {
							choice: {
								min:1,
								message: 'Please kindly check this'
							}
						}
					},
				},

				plugins: { //Learn more: https://formvalidation.io/guide/plugins
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
					// Submit the form when all fields are valid
					defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
				}
			}
		);
	}

	var _initChangePassword = function () {
		FormValidation.formValidation(
			document.getElementById('change_password_form'),
			{
				fields: {
					old_password: {
						validators: {
							notEmpty: {
								message: 'Old Password is required'
							},

						}
					},
					new_password: {
						validators: {
							notEmpty: {
								message: 'New Password is required'
							},

						}
					},
					cpassword: {
						validators: {
							notEmpty: {
								message: 'Confirm Password is required'
							},
							identical: {
								compare: function() {
									return change_password_form.querySelector('[name="new_password"]').value;
								},
								message: 'New password and its confirm are not the same'
							}
						}
					},

				},
				plugins: { //Learn more: https://formvalidation.io/guide/plugins
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
            		// Submit the form when all fields are valid
            		defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
				}
			}
		);
	}

	var _initUpdateProfile = function () {
		FormValidation.formValidation(
			document.getElementById('update_profile'),
			{
				fields: {
					admin_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},
					admin_username: {
						validators: {
							notEmpty: {
								message: 'Username is required'
							}
						}
					},
					admin_phone_number: {
						validators: {
							notEmpty: {
								message: 'Phone Number is required'
							},
							digits: {
								message: 'Phone Number is not a valid digits'
							}
						}
					},
					admin_email: {
						validators: {
							notEmpty: {
								message: 'Email is required'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							}
						}
					},
				},

				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
            		// Submit the form when all fields are valid
            		defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		);
	}

	return {
		// public functions
		init: function() {
			if(current_controller == "auth" && current_method == "change_password") {
				_initChangePassword();
			}
			if(current_controller == "auth" && current_method == "update_profile") {
				_initUpdateProfile();
			}
			if(current_controller == "institutes" && current_method == "add") {
				_initInstituteForm();
			}
		}
	};
}();

jQuery(document).ready(function() {
	KTFormControls.init();
});
