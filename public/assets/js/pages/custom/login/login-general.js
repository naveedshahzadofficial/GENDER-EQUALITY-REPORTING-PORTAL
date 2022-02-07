"use strict";

// Class Definition
var KTLogin = function() {
    var _login;

    var _handleSignInForm = function() {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_signin_form'),
			{
				fields: {
					institute_id: {
						validators: {
							notEmpty: {
								message: 'Institute is required'
							}
						}
					},
					batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch is required'
							}
						}
					},
					username: {
						validators: {
							notEmpty: {
								message: 'Username is required'
							}
						}
					},
					user_email: {
						validators: {
							notEmpty: {
								message: 'Email/User Name is required'
							}
						}
					},
					password: {
						validators: {
							notEmpty: {
								message: 'Password is required'
							}
						}
					}
				},
				plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);
    }

    var _handleForgotForm = function(e) {
        var validation;
        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_forgot_form'),
			{
				fields: {
					username: {
						validators: {
							notEmpty: {
								message: 'Username is required'
							}
						}
					},
					institute: {
						validators: {
							notEmpty: {
								message: 'Institute is required'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					submitButton: new FormValidation.plugins.SubmitButton(),
					defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);
    }

	var _handleVerificationForm = function () {
		FormValidation.formValidation(
			document.getElementById('kt_forgot_verification_form'),
			{
				fields: {
					forgot_code: {
						validators: {
							notEmpty: {
								message: 'verification code is required'
							},
							stringLength: {
								min: 6,
								max: 6,
							},
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
	};

	var _handleResetForm = function () {
		FormValidation.formValidation(
			document.getElementById('reset_form'),
			{
				fields: {
					password: {
						validators: {
							notEmpty: {
								message: 'New Password is required'
							},
							stringLength: {
								min: 8,
								max: 16,
								message: "Please enter password with minimum 8 digits"
							},
						}
					},
					cpassword: {
						validators: {
							notEmpty: {
								message: 'Confirm Password is required'
							},
							stringLength: {
								min: 8,
								max: 16,
								message: "Please enter confirm password with minimum 8 digits"
							},
							identical: {
								compare: function() {
									return reset_form.querySelector('[name="password"]').value;
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
	};

    // Public Functions
    return {
        // public functions
        init: function() {
            _login = $('#kt_login');
			if(current_controller == "auth" && (current_method == "login" || current_method == "verifyLogin")) {
				_handleSignInForm();
			}
			if(current_controller == "auth" && current_method == "forgot_password") {
				_handleForgotForm();
			}
			if(current_controller == "auth" && current_method == "verification_forgot_password") {
				_handleVerificationForm();
			}

			if(current_controller == "auth" && current_method == "reset_password") {
				_handleResetForm();
			}
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});
