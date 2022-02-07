// Class definition
var KTFormControls = function () {
	// Private functions
	var validator;

	var _initSubmissionCommentForm = function () {
		FormValidation.formValidation(
			document.getElementById('add_assignment_evaluation_form'),
			{
				fields: {
					comment_comments: {
						validators: {
							notEmpty: {
								message: 'Comment is required'
							}
						}
					},
					comment_file_name: {
						validators: {
							notEmpty: {
								message: 'Please select a file'
							},
							file: {
								extension: 'doc,docx,pdf',
								maxSize: 2097152,
								message: 'The selected file is not valid'
							}
						}
					}
				},

				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					declarative: new FormValidation.plugins.Declarative({
						html5Input: true,
					}),
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

	var _initSeatingPlanForm = function () {
		FormValidation.formValidation(
			document.getElementById('add_seating_plan_form'),
			{
				fields: {
					upload_week_term_no: {
						validators: {
							notEmpty: {
								message: 'Term is required'
							}
						}
					},
					email_activity: {
						validators: {
							notEmpty: {
								message: 'Email Send is required'
							}
						}
					},
					upload_file_name: {
						validators: {
							notEmpty: {
								message: 'Please select a file'
							},
							file: {
								extension: 'pdf',
								maxSize: 2097152,
								message: 'The selected file is not valid.Please upload file with  pdf extension.'
							}
						}
					}
				},

				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					declarative: new FormValidation.plugins.Declarative({
						html5Input: true,
					}),
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
	var _initSeatingUpdatePlanForm = function () {
		FormValidation.formValidation(
			document.getElementById('add_seating_update_plan_form'),
			{
				fields: {
					upload_week_term_no: {
						validators: {
							notEmpty: {
								message: 'Term is required'
							}
						}
					},
					email_activity: {
						validators: {
							notEmpty: {
								message: 'Email Send is required'
							}
						}
					},
					upload_file_name: {
						validators: {
							file: {
								extension: 'pdf',
								maxSize: 2097152,
								message: 'The selected file is not valid.Please upload file with  pdf extension.'
							}
						}
					}
				},

				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					declarative: new FormValidation.plugins.Declarative({
						html5Input: true,
					}),
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
	var _initSubmissionForm = function () {
		const form = document.getElementById('add_submission_form');
		var fv = FormValidation.formValidation(
			document.getElementById('add_submission_form'),
			{
				fields: {
					submission_document_type_id: {
						validators: {
							notEmpty: {
								message: 'Document type is required'
							}
						}
					},
					submission_document_name: {
						validators: {
							notEmpty: {
								message: 'Please select a file'
							},
							file: {
								extension: 'doc,docx,pdf,ppt,pptx',
								maxSize: 2097152,
								message: 'The selected file is not valid'
							}
						}
					}
				},

				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					declarative: new FormValidation.plugins.Declarative({
						html5Input: true,
					}),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
					// Submit the form when all fields are valid
					defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
				}
			}
		);

		var documentTypeId = $("#submission_document_type_id").val();
			var documentType = documentTypeArray[documentTypeId];
			if (documentType === '') {
					return;
			}
			let extension, message;
			
			if(documentType == "Document"){
				extension = 'doc,docx,pdf';
				message   = 'The file must be in doc, docx, pdf format.';
			}else if(documentType == "Presentation"){
				extension = 'ppt,pptx';
				message   = 'The file must be in ppt,pptx format.';
			}else if(documentType == "Sheet"){
				extension = 'xlx,xlxs,csv';
				message   = 'The file must be in xlx, xlxs, csv format.';
			}
				fv
					.updateValidatorOption('submission_document_name', 'file', 'extension', extension)
					.updateValidatorOption('submission_document_name', 'file', 'message', message)
					.revalidateField('submission_document_name');
	}

	var _initInstructionForm = function () {
		const form = document.getElementById('instructions_form');
		var fv = FormValidation.formValidation(
			document.getElementById('instructions_form'),
			{
				fields: {
					instruction_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch is required'
							}
						}
					},
					instruction_institute_id: {
						validators: {
							notEmpty: {
								message: 'Institute is required'
							}
						}
					},

					/* instruction_category_id: {
						validators: {
							notEmpty: {
								message: 'Category is required'
							}
						}
					}, */
					
					instruction_file: {
						validators: {
							notEmpty: {
								enabled: true,
								message: 'Please select an file'
							},
							file: {
								extension: 'doc,docx,pdf,jpeg,jpg,png',
								maxSize: 2097152,
								message: 'The selected file is not valid'
							}
						}
					},
					
					instruction_type: {
						validators: {
							notEmpty: {
								message: 'Recipient is required'
							}
						}
					}, 
					instruction_template: {
						validators: {
							notEmpty: {
								message: 'Type is required'
							}
						}
					},
					instruction_subject: {
						validators: {
							notEmpty: {
								message: 'Subject is required'
							}
						}
					},
				},

				plugins: { //Learn more: https://formvalidation.io/guide/plugins
					trigger: new FormValidation.plugins.Trigger(),
					declarative: new FormValidation.plugins.Declarative({
						html5Input: true,
					}),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
					// Submit the form when all fields are valid
					defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
				}
			}
		);
		form.querySelector('[name="instruction_file"]').addEventListener('input', function(e) {
			const file = e.target.value;
			if (file != '') {
				fv.disableValidator('instruction_description');
			}
		});
		form.querySelector('[name="instruction_description"]').addEventListener('input', function(e) {
			const description = e.target.value;
			if (description != '') {
				fv.disableValidator('instruction_file');
			}
		});
	};

var _initUpdateInstructionForm = function () {
		const form = document.getElementById('instructions_form');
		var fv = FormValidation.formValidation(
			document.getElementById('instructions_form'),
			{
				fields: {
					instruction_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch is required'
							}
						}
					},
					instruction_institute_id: {
						validators: {
							notEmpty: {
								message: 'Institute is required'
							}
						}
					},

					/* instruction_category_id: {
						validators: {
							notEmpty: {
								message: 'Category is required'
							}
						}
					}, */
					instruction_date: {
						validators: {
							notEmpty: {
								message: 'Date is required'
							}
						}
					},
					
				 	instruction_type: {
						validators: {
							notEmpty: {
								message: 'Recipient is required'
							}
						}
					}, 

				},
				instruction_template: {
						validators: {
							notEmpty: {
								message: 'Type is required'
							}
						}
					},
					instruction_subject: {
						validators: {
							notEmpty: {
								message: 'Subject is required'
							}
						}
					},

				plugins: { //Learn more: https://formvalidation.io/guide/plugins
					trigger: new FormValidation.plugins.Trigger(),
					declarative: new FormValidation.plugins.Declarative({
						html5Input: true,
					}),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
					// Submit the form when all fields are valid
					defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
				}
			}
		);
		form.querySelector('[name="instruction_file"]').addEventListener('input', function(e) {
			const file = e.target.value;
			if (file != '') {
				fv.disableValidator('instruction_description');
			}
		});
		form.querySelector('[name="instruction_description"]').addEventListener('input', function(e) {
			const description = e.target.value;
			if (description != '') {
				fv.disableValidator('instruction_file');
			}
		});
	};


	var _initNoticesForm = function () {
		const form = document.getElementById('notices_form');
		var fv = FormValidation.formValidation(
			document.getElementById('notices_form'),
			{
				fields: {
					notice_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch is required'
							}
						}
					},
				/* 	notice_type: {
						validators: {
							notEmpty: {
								message: 'Notice Type is required'
							}
						}
					}, */
					'recipient_user_id[]': {
						validators: {
							notEmpty: {
								message: 'Participant is required'
							}
						}
					},
					notice_institute_id: {
						validators: {
							notEmpty: {
								message: 'Institute is required'
							}
						}
					},

					notice_category_id: {
						validators: {
							notEmpty: {
								message: 'Subject is required'
							}
						}
					},
					notice_subject: {
						validators: {
							notEmpty: {
								message: 'Subject is required'
							}
						}
					},
					notice_date: {
						validators: {
							notEmpty: {
								message: 'Date is required'
							}
						}
					},
					notice_file: {
						validators: {
							notEmpty: {
								enabled: true,
								message: 'Please select an file'
							},
							file: {
								extension: 'doc,docx,pdf,jpeg,jpg,png',
								type: 'application/msword,application/pdf,image/jpeg,image/png',
								maxSize: 2097152,
								message: 'The selected file is not valid'
							}
						}
					},

				},

				plugins: { //Learn more: https://formvalidation.io/guide/plugins
					trigger: new FormValidation.plugins.Trigger(),
					declarative: new FormValidation.plugins.Declarative({
						html5Input: true,
					}),
					excluded: new FormValidation.plugins.Excluded(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
					// Submit the form when all fields are valid
					defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
				}
			}
		);
		form.querySelector('[name="notice_file"]').addEventListener('input', function(e) {
			const file = e.target.value;
			if (file != '') {
				fv.disableValidator('notice_description');
			}
		});
		form.querySelector('[name="notice_description"]').addEventListener('input', function(e) {
			const description = e.target.value;
			if (description != '') {
				fv.disableValidator('notice_file');
			}
		});
	};

	var _initUpdateNoticesForm = function () {
		const form = document.getElementById('notices_form');
		var fv = FormValidation.formValidation(
			document.getElementById('notices_form'),
			{
				fields: {
					notice_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch is required'
							}
						}
					},
				/* 	notice_type: {
						validators: {
							notEmpty: {
								message: 'Notice Type is required'
							}
						}
					}, */
					'recipient_user_id[]': {
						validators: {
							notEmpty: {
								message: 'Participant is required'
							}
						}
					},
					notice_institute_id: {
						validators: {
							notEmpty: {
								message: 'Institute is required'
							}
						}
					},

					notice_category_id: {
						validators: {
							notEmpty: {
								message: 'Subject is required'
							}
						}
					},
					notice_subject: {
						validators: {
							notEmpty: {
								message: 'Subject is required'
							}
						}
					},
					notice_date: {
						validators: {
							notEmpty: {
								message: 'Date is required'
							}
						}
					},
				
				},

				plugins: { //Learn more: https://formvalidation.io/guide/plugins
					trigger: new FormValidation.plugins.Trigger(),
					declarative: new FormValidation.plugins.Declarative({
						html5Input: true,
					}),
					excluded: new FormValidation.plugins.Excluded(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
					// Submit the form when all fields are valid
					defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
				}
			}
		);
		form.querySelector('[name="notice_file"]').addEventListener('input', function(e) {
			const file = e.target.value;
			if (file != '') {
				fv.disableValidator('notice_description');
			}
		});
		form.querySelector('[name="notice_description"]').addEventListener('input', function(e) {
			const description = e.target.value;
			if (description != '') {
				fv.disableValidator('notice_file');
			}
		});
	};

	var _initAdvicesForm = function () {
		FormValidation.formValidation(
			document.getElementById('advices_form'),
			{
				fields: {
					advice_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch is required'
							}
						}
					},
					advice_institute_id: {
						validators: {
							notEmpty: {
								message: 'Institute is required'
							}
						}
					},
					advice_against_user_id: {
						validators: {
							notEmpty: {
								message: 'Participant is required'
							}
						}
					},
					advice_category_id: {
						validators: {
							notEmpty: {
								message: 'Category is required'
							}
						}
					},
					advice_date: {
						validators: {
							notEmpty: {
								message: 'Date is required'
							}
						}
					},
					advice_intensity_id: {
						validators: {
							choice: {
								min:1,
								message: 'Please select intensity'
							}
						}
					},
					advice_file: {
						validators: {
							notEmpty: {
								enabled: true,
								message: 'Please select an file'
							},
							file: {
								extension: 'doc,docx,pdf,jpeg,jpg,png',
								type: 'application/msword,application/pdf,image/jpeg,image/png',
								maxSize: 2097152,
								message: 'The selected file is not valid'
							}
						}
					},
					advice_faculty_id: {
						validators: {
							notEmpty: {
								message: 'DS  is required'
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

	var _initUpdateAdvicesForm = function () {
		FormValidation.formValidation(
			document.getElementById('advices_form'),
			{
				fields: {
					advice_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch is required'
							}
						}
					},
					advice_institute_id: {
						validators: {
							notEmpty: {
								message: 'Institute is required'
							}
						}
					},
					advice_against_user_id: {
						validators: {
							notEmpty: {
								message: 'Participant is required'
							}
						}
					},
					advice_category_id: {
						validators: {
							notEmpty: {
								message: 'Category is required'
							}
						}
					},
					advice_date: {
						validators: {
							notEmpty: {
								message: 'Date is required'
							}
						}
					},
					advice_intensity_id: {
						validators: {
							choice: {
								min:1,
								message: 'Please select intensity'
							}
						}
					},
					advice_faculty_id: {
						validators: {
							notEmpty: {
								message: 'DS  is required'
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

	var _initLocalVisitsForm = function () {
		FormValidation.formValidation(
			document.getElementById('local_visits_form'),
			{
				fields: {
					local_visit_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch is required'
							}
						}
					},
					'lvd_department_ids[]': {
						validators: {
							notEmpty: {
								message: 'Department is required'
							}
						}
					},
					local_visit_date: {
						validators: {
							notEmpty: {
								message: 'Date is required'
							}
						}
					},
					local_visit_title: {
						validators: {
							notEmpty: {
								message: 'Title is required'
							}
						}
					},
					local_visit_status: {
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
	};

	var _initInlandStudyToursForm = function () {
		FormValidation.formValidation(
			document.getElementById('inland_study_tours_form'),
			{
				fields: {
					ist_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch is required'
							}
						}
					},
					'ist_state_id[]': {
						validators: {
							notEmpty: {
								message: 'State is required'
							}
						}
					},
					'fst_city_id[]': {
						validators: {
							notEmpty: {
								message: 'City is required'
							}
						}
					},
					ist_start_date: {
						validators: {
							notEmpty: {
								message: 'Start date is required'
							}
						}
					},
					ist_end_date: {
						validators: {
							notEmpty: {
								message: 'End date is required'
							}
						}
					},

					ist_status: {
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
	};

	var _initForeignStudyToursForm = function () {
		FormValidation.formValidation(
			document.getElementById('foreign_study_tours_form'),
			{
				fields: {
					fst_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch is required'
							}
						}
					},
					fst_title: {
						validators: {
							notEmpty: {
								message: 'Title is required'
							}
						}
					},
					fst_country_id: {
						validators: {
							notEmpty: {
								message: 'Country is required'
							}
						}
					},
					fst_state_id: {
						validators: {
							notEmpty: {
								message: 'State is required'
							}
						}
					},
					'fst_city_id[]': {
						validators: {
							notEmpty: {
								message: 'City is required'
							}
						}
					},
					fst_c_start_date: {
						validators: {
							notEmpty: {
								message: 'Start date is required'
							}
						}
					},
					fst_c_end_date: {
						validators: {
							notEmpty: {
								message: 'End date is required'
							}
						}
					},
					fst_start_date: {
						validators: {
							notEmpty: {
								message: 'Start date is required'
							}
						}
					},
					fst_end_date: {
						validators: {
							notEmpty: {
								message: 'End date is required'
							}
						}
					},

					fst_status: {
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
	};

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
							stringLength: {
								min: 8,
								max: 16
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
								max: 16
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
	};

	var _initUpdateProfile = function () {
		FormValidation.formValidation(
			document.getElementById('update_profile'),
			{
				fields: {
					user_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},
					user_username: {
						validators: {
							notEmpty: {
								message: 'Username is required'
							}
						}
					},
					user_mobile_number: {
						validators: {
							notEmpty: {
								message: 'Mobile Number is required'
							},
							digits: {
								message: 'Mobile Number is not a valid digits'
							},
							stringLength: {
								min: 11,
								max: 11
							},
						}
					},
					user_phone_number: {
						validators: {
							notEmpty: {
								message: 'Phone Number is required'
							},
							digits: {
								message: 'Phone Number is not a valid digits'
							},
							stringLength: {
								min: 11,
								max: 11
							},
						}
					},
					user_phone_extension: {
						validators: {
							digits: {
								message: 'Phone extension is not a valid digits'
							},
							stringLength: {
								max: 4
							},
						}
					},
					user_email: {
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
					excluded: new FormValidation.plugins.Excluded(),
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
	};

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
	};

	var _initInstituteUpdateForm = function () {
		FormValidation.formValidation(
			document.getElementById('update_institute_form'),
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
	};

	var _initDesignationForm = function () {
		FormValidation.formValidation(
			document.getElementById('add_designation_form'),
			{
				fields: {
					designation_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},

					designation_status: {
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
	};

	var _initDesignationUpdateForm = function () {
		FormValidation.formValidation(
			document.getElementById('update_designation_form'),
			{
				fields: {
					designation_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},

					designation_status: {
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
	};

	var _initBatchForm = function () {
		const form = document.getElementById('add_batch_form');
		var fv = FormValidation.formValidation(
			document.getElementById('add_batch_form'),
			{
				fields: {
					batch_category: {
						validators: {
							notEmpty: {
								message: 'Category is required'
							}
						}
					},
					batch_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							},
							// regexp: {
							// 	regexp: '^[A-Z]*[ ]?[0-9]{3}$',
							// 	message: 'i.e SMC XXX'
							// }
						}
					},
					batch_start_date: {
						validators: {
							notEmpty: {
								message: 'Batch start date is required'
							},
							date: {
								format: 'DD-MM-YYYY',
								max: 'batch_end_date',
								message: 'Batch start date is not a valid'
							}
						}
					},
					batch_end_date: {
						validators: {
							notEmpty: {
								message: 'Batch end date is required'
							},
							date: {
								format: 'DD-MM-YYYY',
								min: 'batch_start_date',
								message: 'Batch end date is not a valid'
							}
						}
					},
					batch_status: {
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
	};

	var _initBatchUpdateForm = function () {
		FormValidation.formValidation(
			document.getElementById('update_batch_form'),
			{
				fields: {
					batch_category: {
						validators: {
							notEmpty: {
								message: 'Category is required'
							}
						}
					},
					batch_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							},
							// regexp: {
							// 	regexp: '^[A-Z]*[ ]?[0-9]{3}$',
							// 	message: 'i.e SMC XXX'
							// }
						}
					},
					batch_start_date: {
						validators: {
							notEmpty: {
								message: 'Batch start date is required'
							},
							date: {
								format: 'DD-MM-YYYY',
								max: 'batch_end_date',
								message: 'Batch start date is not a valid'
							}
						}
					},
					batch_end_date: {
						validators: {
							notEmpty: {
								message: 'Batch end date is required'
							},
							date: {
								format: 'DD-MM-YYYY',
								min: 'batch_start_date',
								message: 'Batch end date is not a valid'
							}
						}
					},
					batch_status: {
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
	};

	var _initSportForm = function () {
		FormValidation.formValidation(
			document.getElementById('add_sport_form'),
			{
				fields: {
					sport_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},
					sport_status: {
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
	};

	var _initSportUpdateForm = function () {
		FormValidation.formValidation(
			document.getElementById('update_sport_form'),
			{
				fields: {
					sport_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},
					sport_status: {
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
	};

	var _initCommitteeTypeForm = function () {
		FormValidation.formValidation(
			document.getElementById('add_committee_type_form'),
			{
				fields: {
					committee_type_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},
					committee_type_status: {
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
	};

	var _initCommitteeTypeUpdateForm = function () {
		FormValidation.formValidation(
			document.getElementById('update_committee_type_form'),
			{
				fields: {
					committee_type_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},
					committee_type_status: {
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
	};

	var _initLocalDepartmentForm = function () {
		FormValidation.formValidation(
			document.getElementById('add_local_department_form'),
			{
				fields: {
					local_department_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},
					local_department_status: {
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
	};

	var _initLocalDepartmentUpdateForm = function () {
		FormValidation.formValidation(
			document.getElementById('update_local_department_form'),
			{
				fields: {
					local_department_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},

					local_department_status: {
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
	};

   var _initGuestSpeakerTopicForm = function () {
		FormValidation.formValidation(
			document.getElementById('add_guest_speaker_topic_form'),
			{
				fields: {
					gs_topic_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},
					gs_topic_status: {
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
	};

	var _initAddCoursePlanningForm = function () {
		FormValidation.formValidation(
			document.getElementById('module_coordinator_form'),
			{
				fields: {
					coordinator_module_id: {
						validators: {
							notEmpty: {
								message: 'Module Name is required'
							}
						}
					},

					coordinator_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch Name is required'
							}
						}
					},

					coordinator_sponsored_ds_user_id: {
						validators: {
							notEmpty: {
								message: 'Sponsor DS  is required'
							}
						}
					},

					/* coordinator_ds_coordinator_user_id: {
						validators: {
							notEmpty: {
								message: 'Co-Sponsor DS is required'
							}
						}
					}, */
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

	var _initResourceAddForm = function () {
		FormValidation.formValidation(
			document.getElementById('resource_managementp_form'),
			{
				fields: {
					session_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch Name is required'
							}
						}
					},
					session_module_id: {
						validators: {
							notEmpty: {
								message: 'Module Name is required'
							}
						}
					},

					session_category_id: {
						validators: {
							notEmpty: {
								message: 'Session Mode is required'
							}
						}
					},

					session_topic_id: {
						validators: {
							notEmpty: {
								message: 'Topic Name is required'
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

	var _initResourceMaterialForm = function () {
     
		const form = document.getElementById('resource_material_form');
		var fv = FormValidation.formValidation(
			document.getElementById('resource_material_form'),
			{
				fields: {
				
					userfile: {
						validators: {
							notEmpty: {
								enabled: true,
								message: 'Please select an file'
							},
							file: {
								extension: 'doc,docx,pdf,ppt,pptx',
								maxSize: 2097152,
								message: 'The selected file is not valid'
							}
						}
					},
				/* 	material_detail: {
						validators: {
						callback: {
                            
                            message: 'The Description must be 2 characters long',
                            callback: function(value) {
                                const text = tinyMCE.activeEditor.getContent({
                                    format: 'text'
                                });
                                return text.length >= 2;
                            }
                        }
					}
				}, */
				material_detail: {
					validators: {
						notEmpty: {
							message: 'Description is required'
						}
					}
				},
				provided_by: {
					validators: {
						notEmpty: {
							message: 'Provided By is required'
						}
					}
				},
				},

				plugins: { //Learn more: https://formvalidation.io/guide/plugins
					trigger: new FormValidation.plugins.Trigger(),
					declarative: new FormValidation.plugins.Declarative({
						html5Input: true,
					}),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
					// Submit the form when all fields are valid
					defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
				}
			}
		);
		form.querySelector('[name="userfile"]').addEventListener('input', function(e) {
			const file = e.target.value;
			if (file != '') {
				fv.disableValidator('material_detail');
			}
		});

	
		form.querySelector('[name="material_detail"]').addEventListener('input', function(e) {
			const description = e.target.value;
			if (description != '') {
				fv.disableValidator('userfile');
			}
		});


	
	 /*  tinymce.init({
          selector: 'textarea',
          plugins: 'image code',
 		  toolbar: 'undo redo | image code',
		  branding: false,
  		  menubar: true,
      	 content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        setup: function(editor) {
            editor.on('change', function() {
             const text = tinyMCE.activeEditor.getContent({
             format: 'text'
            });

            	 if(text.length>=2){
            	 fv.disableValidator('userfile');
            	 }else{
            	 fv.enableValidator('userfile');
            	 fv.revalidateField('userfile');
            	 }
               
            });
        }
    }); */
	/*	form.querySelector('[name="material_detail"]').addEventListener('input', function(e) {
			const description = e.target.value;
			if (description != '') {
				fv.disableValidator('userfile');
			}
		});*/
     
	};

	var _initModuleMaterialForm = function () {
     
		const form = document.getElementById('module_material_form');
		var fv = FormValidation.formValidation(
			document.getElementById('module_material_form'),
			{
				fields: {
				
					userfile: {
						validators: {
							notEmpty: {
								enabled: true,
								message: 'Please select an file'
							},
							file: {
								extension: 'doc,docx,pdf,ppt,pptx',
								maxSize: 2097152,
								message: 'The selected file is not valid'
							}
						}
					},
				
				material_detail: {
					validators: {
						notEmpty: {
							message: 'Description is required'
						}
					}
				},
				},

				plugins: { //Learn more: https://formvalidation.io/guide/plugins
					trigger: new FormValidation.plugins.Trigger(),
					declarative: new FormValidation.plugins.Declarative({
						html5Input: true,
					}),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
					// Submit the form when all fields are valid
					defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
				}
			}
		);
		form.querySelector('[name="userfile"]').addEventListener('input', function(e) {
			const file = e.target.value;
			if (file != '') {
				fv.disableValidator('material_detail');
			}
		});

	
		form.querySelector('[name="material_detail"]').addEventListener('input', function(e) {
			const description = e.target.value;
			if (description != '') {
				fv.disableValidator('userfile');
			}
		});
     
	};

	var _initAddParticipantForm = function () {
		const form = document.getElementById('add_participant_form');
		var fv = FormValidation.formValidation(
			document.getElementById('add_participant_form'),
			{
				fields: {
					user_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},
					/* user_username: {
						validators: {
							notEmpty: {
								message: 'College Name is required'
							}
						}
					}, */
					user_email: {
						validators: {
							notEmpty: {
								enabled: true,
								message: 'Email is required.'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							},
						}
					},
					user_mobile_number: {
						validators: {
							notEmpty: {
								enabled: true,
								message: 'Mobile is required.'
							},
							phone: {
								country: function() {
									return "PK";
								},
								message: 'The value is not a valid phone number'
							},
							digits: {
								message: 'Mobile Number is not a valid digits'
							},
							stringLength: {
								min: 11,
								max: 11,
								message: "Please enter a contact number with 11 digits"
							},
						}
					},
					user_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch is required'
							}
						}
					},
					user_enabled: {
						validators: {
							notEmpty: {
								message: 'Status is required'
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
			});
		/* form.querySelector('[name="user_email"]').addEventListener('input', function(e) {
			const email = e.target.value;
			if (email != '') {
				fv.disableValidator('user_mobile_number');
			}
		});
		form.querySelector('[name="user_mobile_number"]').addEventListener('input', function(e) {
			const user_mobile_number = e.target.value;
			if (user_mobile_number != '') {
				fv.disableValidator('user_email');
			}
		}); */
	};

	var _initUpdateParticipantForm = function () {
		const form = document.getElementById('update_participant_form');
		var fv = FormValidation.formValidation(
			document.getElementById('update_participant_form'),
			{
				fields: {
					user_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},
					user_username: {
						validators: {
							notEmpty: {
								message: 'College Name is required'
							}
						}
					},
					user_email: {
						validators: {
							notEmpty: {
								enabled: true,
								message: 'At least one contact is required either email or mobile number.'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							},
						}
					},
					user_mobile_number: {
						validators: {
							notEmpty: {
								enabled: true,
								message: 'At least one contact is required either email or mobile number.'
							},
							digits: {
								message: 'Mobile Number is not a valid digits'
							},
							stringLength: {
								min: 11,
								max: 11,
								message: "Please enter a contact number with 11 digits"
							},
						}
					},
					user_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch is required'
							}
						}
					},
					user_enabled: {
						validators: {
							notEmpty: {
								message: 'Status is required'
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
			});
		var email;
		var user_mobile_number;
		form.querySelector('[name="user_email"]').addEventListener('input', function(e) {
			 email = e.target.value;
			if (email != '') {
				fv.disableValidator('user_mobile_number');
			}
			if (user_mobile_number != '') {
				fv.disableValidator('user_email');
			}
		});
		form.querySelector('[name="user_mobile_number"]').addEventListener('input', function(e) {
			 user_mobile_number = e.target.value;
			if (user_mobile_number != '') {
				fv.disableValidator('user_email');
			}
			if (email != '') {
				fv.disableValidator('user_mobile_number');
			}
		});
	};

	var _initAddUserForm = function () {
		const form = document.getElementById('add_user_form');
		var fv = FormValidation.formValidation(
			document.getElementById('add_user_form'),
			{
				fields: {
					user_type: {
						validators: {
							notEmpty: {
								message: 'User type is required'
							}
						}
					},
					user_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							},
							stringLength: {
								min: 3,
								max: 100,
								message: 'Minimum 3 characters'
							}
						}
					},
					profile_avatar: {
						validators: {
							file: {
								extension: 'jpeg,jpg,png',
								type: 'image/jpeg,image/png',
								maxSize: 2097152,   // 2048 * 1024
								message: 'The selected file is not valid'
							}
						}
					},
					user_cnic: {
						validators: {
							// regexp: {
							// 	regexp: '^[0-9]{5}-[0-9]{7}-[0-9]{1}$',
							// 	message: 'Please enter correct cnic number i.e xxxxx-xxxxxxx-x'
							// }
						}
					},
					user_email: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Email is required'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							},
						}
					},
					user_mobile_number: {
						validators: {
							digits: {
								message: 'Mobile Number is not a valid digits'
							},
							stringLength: {
								min: 11,
								max: 11,
								message: "Please enter a mobile number with 11 digits"
							},
						}
					},
					user_phone_number: {
						validators: {
							digits: {
								message: 'Phone Number is not a valid digits'
							},
							stringLength: {
								min: 11,
								max: 11,
								message: "Please enter a phone number with 11 digits"
							},
						}
					},
					user_phone_extension: {
						validators: {
							digits: {
								message: 'Phone extension is not a valid digits'
							},
							stringLength: {
								max: 4,
								message: "Please enter a phone extension with maximum 4 digits"
							},
						}
					},
					user_designation_id: {
						validators: {
						/* 	notEmpty: {
								enabled: true,
								message: 'Designation is required'
							} */
						}
					},
					user_designation: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Designation is required'
							}
						}
					},
					detail_upload_cv: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'CV is required'
							},
							file: {
								extension: 'doc,docx,pdf',
								maxSize: 2097152,   // 2048 * 1024
								message: 'The selected file is not valid.Please upload file with doc, docx or pdf extension.'
							}
						}
					},
					detail_holds_passport: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport hold status is required'
							}
						}
					},
					detail_passport_type: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport type is required'
							}
						}
					},
					detail_passport_number: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport number is required'
							}
						}
					},
					detail_issue_date: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport issue date is required'
							},
							date: {
								format: 'DD-MM-YYYY',
								max: 'detail_passport_expiry_date',
								message: 'Passport issue date is not a valid'
							}
						}
					},
					detail_passport_expiry_date: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport issue date is required'
							},
							date: {
								format: 'DD-MM-YYYY',
								min: 'detail_issue_date',
								message: 'Passport expiry date is not a valid'
							}
						}
					},
					user_enabled: {
						validators: {
							notEmpty: {
								message: 'Status is required'
							}
						}
					}
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
			});
		$(".passport_holder_yes").on('click', function (event) {
			var detail_holds_passport = $("input[name='detail_holds_passport']:checked").val();
			if(detail_holds_passport == "Yes"){
				fv.enableValidator('detail_passport_type');
				fv.enableValidator('detail_passport_number');
				fv.enableValidator('detail_issue_date');
				fv.enableValidator('detail_passport_expiry_date');
			}else{
				fv.disableValidator('detail_passport_type');
				fv.disableValidator('detail_passport_number');
				fv.disableValidator('detail_issue_date');
				fv.disableValidator('detail_passport_expiry_date');
			}
		});
		$(".user_type").on('click', function (event) {
			var user_type = $("input[name='user_type']:checked").val();
			if(user_type == "Faculty"){
				fv.enableValidator('user_email');
				fv.enableValidator('user_designation_id');
				fv.disableValidator('detail_holds_passport');
				// fv.disableValidator('user_designation');
				$('.email_address_star').empty();
				$('.email_address_star').append('*');
			}else if(user_type == "Management"){
				fv.disableValidator('user_email');
				fv.enableValidator('user_designation_id');
				fv.disableValidator('detail_holds_passport');
				// fv.disableValidator('user_designation');
				$('.email_address_star').empty();
			}else if(user_type == "Guest Speaker"){
				fv.disableValidator('user_email');
				fv.disableValidator('user_designation_id');
				fv.disableValidator('detail_holds_passport');
				// fv.enableValidator('user_designation');
				$('.email_address_star').empty();
			}else if(user_type == "Staff"){
				fv.disableValidator('user_email');
				fv.enableValidator('user_designation_id');
				fv.disableValidator('detail_holds_passport');
				// fv.disableValidator('user_designation');
				$('.email_address_star').empty();
			}else{
				fv.disableValidator('user_email');
				fv.disableValidator('detail_holds_passport');
				fv.enableValidator('user_designation_id');
				// fv.disableValidator('user_designation');
				$('.email_address_star').empty();
			}
		});
	};

	var _initAddGuestSpeakerForm = function () {
		const form = document.getElementById('add_user_form');
		var fv = FormValidation.formValidation(
			document.getElementById('add_user_form'),
			{
				fields: {
					
					user_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							},
							stringLength: {
								min: 3,
								max: 100,
								message: 'Minimum 3 characters'
							}
						}
					},
					profile_avatar: {
						validators: {
							file: {
								extension: 'jpeg,jpg,png',
								type: 'image/jpeg,image/png',
								maxSize: 2097152,   // 2048 * 1024
								message: 'The selected file is not valid'
							}
						}
					},
					user_cnic: {
						validators: {
							// regexp: {
							// 	regexp: '^[0-9]{5}-[0-9]{7}-[0-9]{1}$',
							// 	message: 'Please enter correct cnic number i.e xxxxx-xxxxxxx-x'
							// }
						}
					},
					user_email: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Email is required'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							},
						}
					},
					user_mobile_number: {
						validators: {
							digits: {
								message: 'Mobile Number is not a valid digits'
							},
							stringLength: {
								min: 11,
								max: 11,
								message: "Please enter a mobile number with 11 digits"
							},
						}
					},
					user_phone_number: {
						validators: {
							digits: {
								message: 'Phone Number is not a valid digits'
							},
							stringLength: {
								min: 11,
								max: 11,
								message: "Please enter a phone number with 11 digits"
							},
						}
					},
					
					user_designation: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Designation is required'
							}
						}
					},
					detail_upload_cv: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'CV is required'
							},
							file: {
								extension: 'doc,docx,pdf',
								maxSize: 2097152,   // 2048 * 1024
								message: 'The selected file is not valid.Please upload file with doc, docx or pdf extension.'
							}
						}
					},
					detail_holds_passport: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport hold status is required'
							}
						}
					},
					detail_passport_type: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport type is required'
							}
						}
					},
					detail_passport_number: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport number is required'
							}
						}
					},
					detail_issue_date: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport issue date is required'
							},
							date: {
								format: 'DD-MM-YYYY',
								max: 'detail_passport_expiry_date',
								message: 'Passport issue date is not a valid'
							}
						}
					},
					detail_passport_expiry_date: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport issue date is required'
							},
							date: {
								format: 'DD-MM-YYYY',
								min: 'detail_issue_date',
								message: 'Passport expiry date is not a valid'
							}
						}
					},
					user_enabled: {
						validators: {
							notEmpty: {
								message: 'Status is required'
							}
						}
					}
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
			});
		$(".passport_holder_yes").on('click', function (event) {
			var detail_holds_passport = $("input[name='detail_holds_passport']:checked").val();
			if(detail_holds_passport == "Yes"){
				fv.enableValidator('detail_passport_type');
				fv.enableValidator('detail_passport_number');
				fv.enableValidator('detail_issue_date');
				fv.enableValidator('detail_passport_expiry_date');
			}else{
				fv.disableValidator('detail_passport_type');
				fv.disableValidator('detail_passport_number');
				fv.disableValidator('detail_issue_date');
				fv.disableValidator('detail_passport_expiry_date');
			}
		});
		$(".user_type").on('click', function (event) {
			var user_type = $("input[name='user_type']:checked").val();
			if(user_type == "Faculty"){
				fv.enableValidator('user_email');
				fv.enableValidator('user_designation_id');
				fv.disableValidator('detail_holds_passport');
				// fv.disableValidator('user_designation');
				$('.email_address_star').empty();
				$('.email_address_star').append('*');
			}else if(user_type == "Management"){
				fv.disableValidator('user_email');
				fv.enableValidator('user_designation_id');
				fv.disableValidator('detail_holds_passport');
				// fv.disableValidator('user_designation');
				$('.email_address_star').empty();
			}else if(user_type == "Guest Speaker"){
				fv.disableValidator('user_email');
				fv.disableValidator('user_designation_id');
				fv.disableValidator('detail_holds_passport');
				// fv.enableValidator('user_designation');
				$('.email_address_star').empty();
			}else if(user_type == "Staff"){
				fv.disableValidator('user_email');
				fv.enableValidator('user_designation_id');
				fv.disableValidator('detail_holds_passport');
				// fv.disableValidator('user_designation');
				$('.email_address_star').empty();
			}else{
				fv.disableValidator('user_email');
				fv.disableValidator('detail_holds_passport');
				fv.enableValidator('user_designation_id');
				// fv.disableValidator('user_designation');
				$('.email_address_star').empty();
			}
		});
	};

	var _initUpdateUserForm = function () {
		const form = document.getElementById('update_user_form');
		var fv = FormValidation.formValidation(
			document.getElementById('update_user_form'),
			{
				fields: {
					user_type: {
						validators: {
							notEmpty: {
								message: 'User type is required'
							}
						}
					},
					user_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							},
							stringLength: {
								min: 3,
								max: 100,
								message: 'Minimum 3 characters'
							}
						}
					},
					profile_avatar: {
						validators: {
							file: {
								extension: 'jpeg,jpg,png',
								type: 'image/jpeg,image/png',
								maxSize: 2097152,   // 2048 * 1024
								message: 'The selected file is not valid'
							}
						}
					},
					user_cnic: {
						validators: {
							// regexp: {
							// 	regexp: '^[0-9]{5}-[0-9]{7}-[0-9]{1}$',
							// 	message: 'Please enter correct cnic number i.e xxxxx-xxxxxxx-x'
							// }
						}
					},
					user_email: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Email is required'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							},
						}
					},
					user_mobile_number: {
						validators: {
							digits: {
								message: 'Mobile Number is not a valid digits'
							},
							stringLength: {
								min: 11,
								max: 11,
								message: "Please enter a mobile number with 11 digits"
							},
						}
					},
					user_phone_number: {
						validators: {
							digits: {
								message: 'Phone Number is not a valid digits'
							},
							stringLength: {
								min: 11,
								max: 11,
								message: "Please enter a phone number with 11 digits"
							},
						}
					},
					user_phone_extension: {
						validators: {
							digits: {
								message: 'Phone extension is not a valid digits'
							},
							stringLength: {
								max: 4,
								message: "Please enter a phone extension with maximum 4 digits"
							},
						}
					},
					/*user_designation_id: {
						validators: {
							notEmpty: {
								enabled: true,
								message: 'Designation is required'
							}
						}
					},*/
					user_designation: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Designation is required'
							}
						}
					},
					detail_upload_cv: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'CV is required'
							},
							file: {
								extension: 'doc,docx,pdf',
								maxSize: 2097152,   // 2048 * 1024
								message: 'The selected file is not valid.Please upload file with doc, docx or pdf extension.'
							}
						}
					},
					detail_holds_passport: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport hold status is required'
							}
						}
					},
					detail_passport_type: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport type is required'
							}
						}
					},
					detail_passport_number: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport number is required'
							}
						}
					},
					detail_issue_date: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport issue date is required'
							},
							date: {
								format: 'DD-MM-YYYY',
								max: 'detail_passport_expiry_date',
								message: 'Passport issue date is not a valid'
							}
						}
					},
					detail_passport_expiry_date: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport issue date is required'
							},
							date: {
								format: 'DD-MM-YYYY',
								min: 'detail_issue_date',
								message: 'Passport expiry date is not a valid'
							}
						}
					},
					user_enabled: {
						validators: {
							notEmpty: {
								message: 'Status is required'
							}
						}
					}
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
			});

		$(".passport_holder_yes").on('click', function (event) {
			var detail_holds_passport = $("input[name='detail_holds_passport']:checked").val();
			if(detail_holds_passport == "Yes"){
				fv.enableValidator('detail_passport_type');
				fv.enableValidator('detail_passport_number');
				fv.enableValidator('detail_issue_date');
				fv.enableValidator('detail_passport_expiry_date');
			}else{
				fv.disableValidator('detail_passport_type');
				fv.disableValidator('detail_passport_number');
				fv.disableValidator('detail_issue_date');
				fv.disableValidator('detail_passport_expiry_date');
			}
		});
		$(".user_type").on('click', function (event) {
			var user_type = $("input[name='user_type']:checked").val();
			var already_detail_upload_cv = $("input[name='already_detail_upload_cv']").val();
			if(user_type == "Faculty"){
				fv.enableValidator('user_email');
				fv.disableValidator('detail_holds_passport');
				fv.enableValidator('user_designation_id');
				// fv.disableValidator('user_designation');
				$('.email_address_star').empty();
				$('.email_address_star').append('*');
			}else if(user_type == "Management"){
				fv.disableValidator('user_email');
				fv.disableValidator('detail_holds_passport');
				fv.enableValidator('user_designation_id');
				// fv.disableValidator('user_designation');
				$('.email_address_star').empty();
			}else if(user_type == "Guest Speaker"){
				fv.disableValidator('user_email');
				fv.disableValidator('detail_holds_passport');
				fv.disableValidator('user_designation_id');
				// fv.enableValidator('user_designation');
				$('.email_address_star').empty();
			}else if(user_type == "Staff"){
				fv.disableValidator('user_email');
				fv.enableValidator('user_designation_id');
				fv.disableValidator('detail_holds_passport');
				// fv.disableValidator('user_designation');
				$('.email_address_star').empty();
			}else{
				fv.disableValidator('user_email');
				fv.disableValidator('detail_holds_passport');
				fv.enableValidator('user_designation_id');
				// fv.disableValidator('user_designation');
				$('.email_address_star').empty();
			}
		});
	};

	var _initUpdateGuestSpeakerForm = function () {
		const form = document.getElementById('update_user_form');
		var fv = FormValidation.formValidation(
			document.getElementById('update_user_form'),
			{
				fields: {
					user_type: {
						validators: {
							notEmpty: {
								message: 'User type is required'
							}
						}
					},
					user_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							},
							stringLength: {
								min: 3,
								max: 100,
								message: 'Minimum 3 characters'
							}
						}
					},
					profile_avatar: {
						validators: {
							file: {
								extension: 'jpeg,jpg,png',
								type: 'image/jpeg,image/png',
								maxSize: 2097152,   // 2048 * 1024
								message: 'The selected file is not valid'
							}
						}
					},
					user_cnic: {
						validators: {
							// regexp: {
							// 	regexp: '^[0-9]{5}-[0-9]{7}-[0-9]{1}$',
							// 	message: 'Please enter correct cnic number i.e xxxxx-xxxxxxx-x'
							// }
						}
					},
					user_email: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Email is required'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							},
						}
					},
					user_mobile_number: {
						validators: {
							digits: {
								message: 'Mobile Number is not a valid digits'
							},
							stringLength: {
								min: 11,
								max: 11,
								message: "Please enter a mobile number with 11 digits"
							},
						}
					},
					user_phone_number: {
						validators: {
							digits: {
								message: 'Phone Number is not a valid digits'
							},
							stringLength: {
								min: 11,
								max: 11,
								message: "Please enter a phone number with 11 digits"
							},
						}
					},
					user_phone_extension: {
						validators: {
							digits: {
								message: 'Phone extension is not a valid digits'
							},
							stringLength: {
								max: 4,
								message: "Please enter a phone extension with maximum 4 digits"
							},
						}
					},
					user_designation: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Designation is required'
							}
						}
					},
					detail_upload_cv: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'CV is required'
							},
							file: {
								extension: 'doc,docx,pdf',
								maxSize: 2097152,   // 2048 * 1024
								message: 'The selected file is not valid.Please upload file with doc, docx or pdf extension.'
							}
						}
					},
					detail_holds_passport: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport hold status is required'
							}
						}
					},
					detail_passport_type: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport type is required'
							}
						}
					},
					detail_passport_number: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport number is required'
							}
						}
					},
					detail_issue_date: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport issue date is required'
							},
							date: {
								format: 'DD-MM-YYYY',
								max: 'detail_passport_expiry_date',
								message: 'Passport issue date is not a valid'
							}
						}
					},
					detail_passport_expiry_date: {
						validators: {
							notEmpty: {
								enabled: false,
								message: 'Passport issue date is required'
							},
							date: {
								format: 'DD-MM-YYYY',
								min: 'detail_issue_date',
								message: 'Passport expiry date is not a valid'
							}
						}
					},
					user_enabled: {
						validators: {
							notEmpty: {
								message: 'Status is required'
							}
						}
					}
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
			});

		$(".passport_holder_yes").on('click', function (event) {
			var detail_holds_passport = $("input[name='detail_holds_passport']:checked").val();
			if(detail_holds_passport == "Yes"){
				fv.enableValidator('detail_passport_type');
				fv.enableValidator('detail_passport_number');
				fv.enableValidator('detail_issue_date');
				fv.enableValidator('detail_passport_expiry_date');
			}else{
				fv.disableValidator('detail_passport_type');
				fv.disableValidator('detail_passport_number');
				fv.disableValidator('detail_issue_date');
				fv.disableValidator('detail_passport_expiry_date');
			}
		});
		$(".user_type").on('click', function (event) {
			var user_type = $("input[name='user_type']:checked").val();
			var already_detail_upload_cv = $("input[name='already_detail_upload_cv']").val();
			if(user_type == "Faculty"){
				fv.enableValidator('user_email');
				fv.disableValidator('detail_holds_passport');
				fv.enableValidator('user_designation_id');
				// fv.disableValidator('user_designation');
				$('.email_address_star').empty();
				$('.email_address_star').append('*');
			}else if(user_type == "Management"){
				fv.disableValidator('user_email');
				fv.disableValidator('detail_holds_passport');
				fv.enableValidator('user_designation_id');
				// fv.disableValidator('user_designation');
				$('.email_address_star').empty();
			}else if(user_type == "Guest Speaker"){
				fv.disableValidator('user_email');
				fv.disableValidator('detail_holds_passport');
				fv.disableValidator('user_designation_id');
				// fv.enableValidator('user_designation');
				$('.email_address_star').empty();
			}else if(user_type == "Staff"){
				fv.disableValidator('user_email');
				fv.enableValidator('user_designation_id');
				fv.disableValidator('detail_holds_passport');
				// fv.disableValidator('user_designation');
				$('.email_address_star').empty();
			}else{
				fv.disableValidator('user_email');
				fv.disableValidator('detail_holds_passport');
				fv.enableValidator('user_designation_id');
				// fv.disableValidator('user_designation');
				$('.email_address_star').empty();
			}
		});
	};

	var _initAddAssignmentPlanningForm = function () {

		FormValidation.formValidation(
			document.getElementById('add_assignment_planning_form'),
			{
				fields: {
					/* assignment_type_id: {
						validators: {
							notEmpty: {
								message: 'Assignment type is required'
							}
						}
					}, */
				
					assignment_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch is required'
							}
						}
					}

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
			});

			
	};

	var _initPersonalInfoForm = function () {
		FormValidation.formValidation(
			document.getElementById('update_personal'),
			{
				fields: {
					user_name: {
						validators: {
							notEmpty: {
								message: 'Full name is required'
							}
						}
					},
				/* 	 user_email: {
					 	validators: {
					 		notEmpty: {
					 			message: 'Email is required'
					 		}
						}
					 }, */
					detail_guardian_name: {
						validators: {
							notEmpty: {
								message: 'Father\'s Name / Husband’s Name is required'
							}
						}
					},
					detail_gender: {
						validators: {
							notEmpty: {
								message: 'Gender is required'
							}
						}
					},
					user_marital_status_id: {
						validators: {
							notEmpty: {
								message: 'Marital Status is required'
							}
						}
					},
					detail_date_of_birth: {
						validators: {
							notEmpty: {
								message: 'DOB is required'
							}
						}
					},
					detail_country_id: {
						validators: {
							notEmpty: {
								message: 'Country is required'
							}
						}
					},
					detail_cnic: {
						validators: {
							notEmpty: {
								message: 'CNIC is required'
							}
						}
					},
					detail_domicile_province_id: {
						validators: {
							notEmpty: {
								message: 'Province is required'
							}
						}
					},
					detail_holds_passport: {
						validators: {
							notEmpty: {
								message: 'Passport holder is required'
							}
						}
					},
					detail_passport_type: {
						validators: {
							notEmpty: {
								message: 'Passport type is required'
							}
						}
					},
					detail_passport_number: {
						validators: {
							notEmpty: {
								message: 'Passport number is required'
							},
							digits: {
								message: 'The value added is not valid'
							}
						}
					},
					detail_issue_date: {
						validators: {
							notEmpty: {
								message: 'Issue date is required'
							},
						}
					},
					detail_passport_expiry_date: {
						validators: {
							notEmpty: {
								message: 'Expiry date is required'
							},
						}
					}
				},

				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					excluded: new FormValidation.plugins.Excluded(),
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
			});
	};

	var _initServiceInfoForm = function () {
		FormValidation.formValidation(
			document.getElementById('update_service'),
			{
				fields: {
					detail_service_category_id: {
						validators: {
							notEmpty: {
								message: 'Category is required'
							}
						}
					},
					detail_group_id: {
						validators: {
							notEmpty: {
								message: 'Group is required'
							}
						}
					},
					detail_allied_group: {
						validators: {
							notEmpty: {
								message: 'Group is required'
							}
						}
					},
					detail_ctp_number: {
						validators: {
							notEmpty: {
								message: 'CTP number is required'
							}
						}
					},
					detail_ctp_year: {
						validators: {
							notEmpty: {
								message: 'CTP year is required'
							}
						}
					},
					detail_stp_number: {
						validators: {
							notEmpty: {
								message: 'STP number is required'
							}
						}
					},
					detail_stp_year: {
						validators: {
							notEmpty: {
								message: 'STP year is required'
							}
						}
					},
					detail_designation: {
						validators: {
							notEmpty: {
								message: 'Designation is required'
							}
						}
					},
					detail_department: {
						validators: {
							enabled: false,
							notEmpty: {
								message: 'Department is required'
							}
						}
					},
					detail_governement_provinceid: {
						validators: {
							notEmpty: {
								enabled:false,
								message: 'Govt. Province  is required'
							}
						}
					},
					detail_service_joining_date: {
						validators: {
							notEmpty: {
								message: 'Joining date of Service is required'
							}
						}
					},
					detail_service_joining_grade: {
						validators: {
							notEmpty: {
								message: 'Joining grade of Service is required'
							}
						}
					},
					detail_mcmc_number: {
						validators: {
							notEmpty: {
								message: 'MCMC number is required'
							}
						}
					},
					detail_mcmc_institute_id: {
						validators: {
							notEmpty: {
								message: 'MCMC institute is required'
							}
						}
					},
					detail_smc_number: {
						validators: {
							notEmpty: {
								message: 'SMC number is required'
							}
						}
					},
					detail_smc_institute_id: {
						validators: {
							notEmpty: {
								message: 'SMC institute is required'
							}
						}
					},
					detail_publications: {
						validators: {
							enabled: false,
							notEmpty: {
								message: 'Publications is required'
							}
						}
					},
					detail_committees_memberships: {
						validators: {
							enabled: false,
							notEmpty: {
								message: 'Committee membership is required'
							}
						}
					},
					detail_academic_memberships: {
						validators: {
							enabled: false,
							notEmpty: {
								message: 'Academic membership is required'
							}
						}
					},
				},

				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					excluded: new FormValidation.plugins.Excluded(),
					submitButton: new FormValidation.plugins.SubmitButton(),
					defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
					bootstrap: new FormValidation.plugins.Bootstrap({
						eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			});
	};

	var _initQualificationInfoForm = function () {
		FormValidation.formValidation(
			document.getElementById('update_qualification'),
			{
				fields: {
					'qualification_degree[]': {
						validators: {
							notEmpty: {
								message: 'Diploma/ Degree is required'
							}
						}
					},
					'qualifications[0][qualification_subject]': {
						validators: {
							notEmpty: {
								message: 'Subject is required'
							}
						}
					},
					'qualifications[0][qualification_institute]': {
						validators: {
							notEmpty: {
								message: 'Institute is required'
							}
						}
					},
					'qualifications[0][qualification_year]': {
						validators: {
							notEmpty: {
								message: 'Year is required'
							}
						}
					},
				},

				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					excluded: new FormValidation.plugins.Excluded(),
					declarative: new FormValidation.plugins.Declarative({
						html5Input: true,
					}),
					submitButton: new FormValidation.plugins.SubmitButton(),
					defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
					bootstrap: new FormValidation.plugins.Bootstrap({
						eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			});
	};

	var _initContactInfoForm = function () {
		FormValidation.formValidation(
			document.getElementById('update_contacts'),
			{
				fields: {
					address_province_id: {
						validators: {
							notEmpty: {
								message: 'Province is required'
							}
						}
					},
					address_city_id: {
						validators: {
							notEmpty: {
								message: 'City is required'
							}
						}
					},
					address_street_address: {
						validators: {
							notEmpty: {
								message: 'Address is required'
							}
						}
					},
					'advisor_user_id[]': {
						validators: {
							notEmpty: {
								message: 'Faculty is required'
							}
						}
					},
					/* 'contact_number[]': {
						validators: {
							notEmpty: {
								message: 'Contact number is required'
							},
							digits: {
								message: 'The value added is not valid'
							}
						}
					}, */
					personal_mobile_number: {
						validators: {
							notEmpty: {
								message: 'Mobile number is required'
							}
						}
					},
					'contact_extension': {
						validators: {
							// notEmpty: {
							// 	message: 'Extension is required'
							// },
						}
					},
					contact_name: {
						validators: {
							notEmpty: {
								message: 'Person Name is required'
							}
						}
					},
					contact_relation_id: {
						validators: {
							notEmpty: {
								message: 'Relation is required'
							}
						}
					},
					contact_mobile_number: {
						validators: {
							notEmpty: {
								message: 'Mobile number is required'
							}
						}
					},
					contact_landline_code: {
						validators: {
							// notEmpty: {
							// 	enabled:false,
							// 	message: 'Landline code is required'
							// }
						}
					},
					contact_landline_number: {
						validators: {
							// notEmpty: {
							// 	enabled:false,
							// 	message: 'Landline number is required'
							// }
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					excluded: new FormValidation.plugins.Excluded(),
					declarative: new FormValidation.plugins.Declarative({
						html5Input: true,
					}),
					submitButton: new FormValidation.plugins.SubmitButton(),
					defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
					bootstrap: new FormValidation.plugins.Bootstrap({
						eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			});
	};

	var _initSessionTopicAddForm = function () {
		FormValidation.formValidation(
			document.getElementById('add_session_topic_form'),
			{
				fields: {
					topic_batch_type_id: {
						validators: {
							notEmpty: {
								message: 'Batch type is required'
							}
						}
					},

					topic_module_id: {
						validators: {
							notEmpty: {
								message: 'Module is required'
							}
						}
					},
					topic_session_category: {
						validators: {
							notEmpty: {
								message: 'Session type is required'
							}
						}
					},
					topic_name: {
						validators: {
							notEmpty: {
								message: 'Session topic is required'
							}
						}
					},
					topic_status: {
						validators: {
							notEmpty: {
								message: 'Status is required'
							}
						}
					},
					topic_reference_no: {
						validators: {
							notEmpty: {
								message: 'Reference No is required'
							}
						}
					},
					topic_remarks: {
						validators: {
						callback: {
                            
                            message: 'The Scope must be 2 characters long',
                            callback: function(value) {
                                const text = tinyMCE.activeEditor.getContent({
                                    format: 'text'
                                });
                                //return text.length >= 2;
                            }
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

		tinymce.init({
			selector: 'textarea',
			plugins: 'image code',
			 toolbar: 'undo redo | image code',
			branding: false,
			  menubar: true,
			 content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
		  setup: function(editor) {
			  editor.on('change', function() {
			   const text = tinyMCE.activeEditor.getContent({
			   format: 'text'
			  });
  
				  
				 
			  });
		  }
	  });

	};

	var _initSessionTopicUpdateForm = function () {
		FormValidation.formValidation(
			document.getElementById('update_session_topic_form'),
			{
				fields: {
					topic_batch_type_id: {
						validators: {
							notEmpty: {
								message: 'Batch type is required'
							}
						}
					},

					topic_module_id: {
						validators: {
							notEmpty: {
								message: 'Module is required'
							}
						}
					},
					topic_session_category: {
						validators: {
							notEmpty: {
								message: 'Session type is required'
							}
						}
					},
					topic_name: {
						validators: {
							notEmpty: {
								message: 'Session topic is required'
							}
						}
					},
					topic_status: {
						validators: {
							notEmpty: {
								message: 'Status is required'
							}
						}
					},
					topic_reference_no: {
						validators: {
							notEmpty: {
								message: 'Reference No is required'
							}
						}
					},
					topic_remarks: {
						validators: {
						callback: {
                            
                            message: 'The Scope must be 2 characters long',
                            callback: function(value) {
                                const text = tinyMCE.activeEditor.getContent({
                                    format: 'text'
                                });
                                //return text.length >= 2;
                            }
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

		tinymce.init({
			selector: 'textarea',
			plugins: 'image code',
			 toolbar: 'undo redo | image code',
			branding: false,
			  menubar: true,
			 content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
		  setup: function(editor) {
			  editor.on('change', function() {
			   const text = tinyMCE.activeEditor.getContent({
			   format: 'text'
			  });
  
				
				 
			  });
		  }
	  });

	};

	var _initAddCommitteeForm = function () {
		const chairpersonValidators = {
			validators: {
				notEmpty: {
					message: 'Chairperson/Leader is required'
				},
				choice: {
					min: 1,
					message: 'Please choose at least one'
				}
			}
		};
		const secretaryValidators = {
			validators: {
				notEmpty: {
					message: 'Secretary is required'
				},
				choice: {
					min: 1,
					message: 'Please choose at least one'
				}
			}
		};
		const participantValidators = {
			validators: {
				notEmpty: {
					message: 'Participant is required'
				},
				choice: {
					min: 1,
					message: 'Please choose at least one'
				}
			}
		};
		const form = document.getElementById('add_committee_form');
		var fv = FormValidation.formValidation(
			document.getElementById('add_committee_form'),
			{
				fields: {
					committee_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch is required'
							}
						}
					},
					committee_type_id: {
						validators: {
							notEmpty: {
								message: 'Type is required'
							}
						}
					}
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
			});
		form.querySelector('[name="committee_batch_id"]').addEventListener('change', function(e) {
			const batch = e.target.value;
			fv.addField('committee_chairperson_user_id', chairpersonValidators)
				.addField('committee_secretary_user_id', secretaryValidators)
				.addField('participants[]', participantValidators);
			fv.validateField('committee_chairperson_user_id');
		});
	};

	var _initUpdateCommitteeForm = function () {
		const chairpersonValidators = {
			validators: {
				notEmpty: {
					message: 'Chairperson/Leader is required'
				},
				choice: {
					min: 1,
					message: 'Please choose at least one'
				}
			}
		};
		const secretaryValidators = {
			validators: {
				notEmpty: {
					message: 'Secretary is required'
				},
				choice: {
					min: 1,
					message: 'Please choose at least one'
				}
			}
		};
		const participantValidators = {
			validators: {
				notEmpty: {
					message: 'Participant is required'
				},
				choice: {
					min: 1,
					message: 'Please choose at least one'
				}
			}
		};
		const form = document.getElementById('update_committee_form');
		var fv = FormValidation.formValidation(
			document.getElementById('add_committee_form'),
			{
				fields: {
					committee_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch is required'
							}
						}
					},
					committee_type_id: {
						validators: {
							notEmpty: {
								message: 'Type is required'
							}
						}
					}

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
			});

		form.querySelector('[name="committee_batch_id"]').addEventListener('change', function(e) {
			const batch = e.target.value;
			fv.addField('committee_chairperson_user_id', chairpersonValidators)
				.addField('committee_secretary_user_id', secretaryValidators)
				.addField('participants[]', participantValidators);
			fv.validateField('committee_chairperson_user_id');
		});
	};

	var _initPreferencesAddForm = function () {
		FormValidation.formValidation(
			document.getElementById('add_preferences_form'),
			{
				fields: {
					'topic_value[]': {
						validators: {
							notEmpty: {
								message: 'Current Issue topic is required'
							}
						}
					},
					'research_topic_value[]': {
						validators: {
							notEmpty: {
								message: 'Research paper is required'
							}
						}
					},

					'sports[]': {
						validators: {
							notEmpty: {
								message: 'Sports is required'
							},
							 choice: {
                            max: document.getElementById('maximum_sports').value,
                            message: 'Please choose '+document.getElementById('maximum_sports').value+' sports you use most'
                         }
						}
					},
					'committees[]': {
						validators: {
							notEmpty: {
								message: 'Committees is required'
							}
						}
					},
					/*'inland_tours[]': {
						validators: {
							notEmpty: {
								message: 'Inland Study tour is required'
							}
						}
					},*/
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

	var _initPreferencesUpdateForm = function () {
		FormValidation.formValidation(
			document.getElementById('update_preferences_form'),
			{
				fields: {
					'topic_value[]': {
						validators: {
							notEmpty: {
								message: 'Current Issue topic is required'
							}
						}
					},
					'research_topic_value[]': {
						validators: {
							notEmpty: {
								message: 'Research paper is required'
							}
						}
					},

					'sports[]': {
						validators: {
							notEmpty: {
								message: 'Sports is required'
							},
							 choice: {
                            max: document.getElementById('maximum_sports').value,
                            message: 'Please choose '+document.getElementById('maximum_sports').value+' sports you use most'
                         }
						}
					},
					'committees[]': {
						validators: {
							notEmpty: {
								message: 'Committees is required'
							}
						}
					},
					/*'inland_tours[]': {
						validators: {
							notEmpty: {
								message: 'Inland Study tour is required'
							}
						}
					},*/
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

	var _initAssignmentTopicsAddForm = function () {

		FormValidation.formValidation(
			document.getElementById('add_assignment_topics_form'),
			{
				fields: {
					topic_tour_assigment_id: {
						validators: {
							notEmpty: {
								message: 'Assignment type is required'
							}
						}
					},
					assignment_end_date: {
						validators: {
							notEmpty: {
								message: 'End Date is required'
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
			});
	};

	var _initMiscellaneousForm = function () {

		FormValidation.formValidation(
			document.getElementById('miscellaneous_form'),
			{
				fields: {
					miscellaneous_last_date_of_profile: {
						validators: {
							notEmpty: {
								message: 'Profile Last Date is required'
							}
						}
					},
					last_date_of_preferences_ci: {
						validators: {
							notEmpty: {
								message: 'Current Issue End Date is required'
							}
						}
					},
					last_date_of_preferences_irp: {
						validators: {
							notEmpty: {
								message: 'Individual Research Paper End Date is required'
							}
						}
					},
					last_date_of_preferences_sports: {
						validators: {
							notEmpty: {
								message: 'Sports End Date is required'
							}
						}
					},
					last_date_of_preferences_committee: {
						validators: {
							notEmpty: {
								message: 'Committees End Date is required'
							}
						}
					},
					last_date_of_preferences_ist: {
						validators: {
							notEmpty: {
								message: 'Inland Study tour End Date is required'
							}
						}
					},
					start_date_of_preferences_ist: {
						validators: {
							notEmpty: {
								message: 'Inland Study tour Start Date is required'
							}
						}
					},
					last_date_of_preferences_fst: {
						validators: {
							notEmpty: {
								message: 'Foreign Study Tour End Date is required'
							}
						}
					},
					miscellaneous_maximum_sports: {
						validators: {
							notEmpty: {
								message: 'Maximum Sports is required'
							}
						}
					},
					miscellaneous_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch is required'
							}
						}
					},
					// miscellaneous_status: {
					// 	validators: {
					// 		notEmpty: {
					// 			message: 'Status is required'
					// 		}
					// 	}
					// },


				},

				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
					excluded: new FormValidation.plugins.Excluded(),
					// Submit the form when all fields are valid
					defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			});
	};

	var _initAssignAdvisorForm = function () {

		FormValidation.formValidation(
			document.getElementById('assign_advisor_assignment_form'),
			{
				fields: {
					assignment_batch_id: {
						validators: {
							notEmpty: {
								message: 'Batch is required'
							}
						}
					},
					advisor_assignment_id: {
						validators: {
							notEmpty: {
								message: 'Assignment Type  is required'
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
			});
	};

	var _initModulesForm = function () {
		const form = document.getElementById('add_module_form');
		var fv = FormValidation.formValidation(
			document.getElementById('add_module_form'),
			{
				fields: {
					module_batch_type_id: {
						validators: {
							choice: {
								min:1,
								message: 'Please kindly check this'
							}
						}
					},
					module_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},
					module_status: {
						validators: {
							choice: {
								min:1,
								message: 'Please kindly check this'
							}
						}
					},
					module_no: {
						validators: {
							notEmpty: {
								message: 'Module No is required'
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

	var _initCategoriesForm = function () {
		const form = document.getElementById('add_category_form');
		var fv = FormValidation.formValidation(
			document.getElementById('add_category_form'),
			{
				fields: {
					
					category_for: {
						validators: {
							notEmpty: {
								message: 'Category For is required'
							}
						}
					},	
					category_short_name: {
						validators: {
							notEmpty: {
								message: 'Short Name is required'
							}
						}
					},category_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},
					category_status: {
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
	};
	var _initAssignmentTypesForm = function () {
		const form = document.getElementById('add_assignment_type_form');
		var fv = FormValidation.formValidation(
			document.getElementById('add_assignment_type_form'),
			{
				fields: {
					assignment_batch_type_id: {
						validators: {
							choice: {
								min:1,
								message: 'Please kindly check this'
							}
						}
					},
					assignment_type_level: {
						validators: {
							choice: {
								min:1,
								message: 'Please kindly check this'
							}
						}
					},
					assignment_type_prefence_based: {
						validators: {
							choice: {
								min:1,
								message: 'Please kindly check this'
							}
						}
					},
					assignment_type_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},
					assignment_type_status: {
						validators: {
							choice: {
								min:1,
								message: 'Please kindly check this'
							}
						}
					},
					'document_name[]': {
						validators: {
							notEmpty: {
								message: 'Document Name is required'
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

	var _initAddInstituteUserForm = function () {
		const form = document.getElementById('add_institute_user_form');
		var fv = FormValidation.formValidation(
			document.getElementById('add_institute_user_form'),
			{
				fields: {
					user_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},
					user_username: {
						validators: {
							notEmpty: {
								message: 'Institute/College Name is required'
							}
						}
					},
					user_email: {
						validators: {
							notEmpty: {
								enabled: true,
								message: 'Email address is required.'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							},
						}
					},
					user_mobile_number: {
						validators: {
							notEmpty: {
								enabled: true,
								message: 'Mobile No. is required.'
							},
							phone: {
								country: function() {
									return "PK";
								},
								message: 'The value is not a valid phone number'
							},
							digits: {
								message: 'Mobile Number is not a valid digits'
							},
							stringLength: {
								min: 11,
								max: 11,
								message: "Please enter a contact number with 11 digits"
							},
						}
					},
					user_phone_number: {
						validators: {
							notEmpty: {
								enabled: true,
								message: 'Landline No. is required.'
							},
							digits: {
								message: 'Mobile Number is not a valid digits'
							},
						}
					},
					user_institute_id: {
						validators: {
							notEmpty: {
								message: 'Institute is required'
							}
						}
					},
					'batch_type_id[]': {
						validators: {
							notEmpty: {
								message: 'Batch Type is required'
							}
						}
					},
					user_enabled: {
						validators: {
							notEmpty: {
								message: 'Status is required'
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
			});
		// form.querySelector('[name="user_email"]').addEventListener('input', function(e) {
		// 	const email = e.target.value;
		// 	if (email != '') {
		// 		fv.disableValidator('user_mobile_number');
		// 		$('.mobile_label').hide();
		// 	}else{
		// 		$('.mobile_label').show();
		// 	}
		// });
		// form.querySelector('[name="user_mobile_number"]').addEventListener('input', function(e) {
		// 	const user_mobile_number = e.target.value;
		// 	if (user_mobile_number != '') {
		// 		fv.disableValidator('user_email');
		// 		$('.email_label').hide();
		// 	}else{
		// 		$('.email_label').show();
		// 	}
		// });
	};

	var _initUpdateInstituteUserForm = function () {
		const form = document.getElementById('update_institute_user_form');
		var fv = FormValidation.formValidation(
			document.getElementById('update_institute_user_form'),
			{
				fields: {
					user_name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},
					user_username: {
						validators: {
							notEmpty: {
								message: 'Institute/College Name is required'
							}
						}
					},
					user_email: {
						validators: {
							notEmpty: {
								enabled: true,
								message: 'Email address is required.'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							},
						}
					},
					user_mobile_number: {
						validators: {
							notEmpty: {
								enabled: true,
								message: 'Mobile number is required.'
							},
							phone: {
								country: function() {
									return "PK";
								},
								message: 'The value is not a valid phone number'
							},
							digits: {
								message: 'Mobile Number is not a valid digits'
							},
							stringLength: {
								min: 11,
								max: 11,
								message: "Please enter a contact number with 11 digits"
							},
						}
					},
					user_phone_number: {
						validators: {
							notEmpty: {
								enabled: true,
								message: 'Landline No. is required.'
							},
							digits: {
								message: 'Mobile Number is not a valid digits'
							},
						}
					},
					user_institute_id: {
						validators: {
							notEmpty: {
								message: 'Institute is required'
							}
						}
					},
					'batch_type_id[]': {
						validators: {
							notEmpty: {
								message: 'Batch Type is required'
							},
							choice: {
								min:1,
								message: 'Please select at least one batch type.'
							}
						}
					},
					user_enabled: {
						validators: {
							notEmpty: {
								message: 'Status is required'
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
			});
		// form.querySelector('[name="user_email"]').addEventListener('input', function(e) {
		// 	const email = e.target.value;
		// 	if (email != '') {
		// 		fv.disableValidator('user_mobile_number');
		// 		$('.mobile_label').hide();
		// 	}else{
		// 		$('.mobile_label').show();
		// 	}
		// });
		// form.querySelector('[name="user_mobile_number"]').addEventListener('input', function(e) {
		// 	const user_mobile_number = e.target.value;
		// 	if (user_mobile_number != '') {
		// 		fv.disableValidator('user_email');
		// 		$('.email_label').hide();
		// 	}else{
		// 		$('.email_label').show();
		// 	}
		// });
	};
	var _initEvaluationsForm = function () {
		const form = document.getElementById('evaluation_form');
		var fv = FormValidation.formValidation(
			document.getElementById('evaluation_form'),
			{
				fields: {
					evaluation_content_lecture: {
						validators: {
							notEmpty: {
								message: 'Relevence to Topic is required'
							}
						}
					},
					
					evaluation_quality_substance: {
						validators: {
							notEmpty: {
								message: 'Quality of Substance is required'
							}
						}
					},
					evaluation_knowledge_preparation: {
						validators: {
							notEmpty: {
								message: 'Background Knowledge/Preparation is required'
							}
						}
					},
					evaluation_handling_qa: {
						validators: {
							notEmpty: {
								message: 'Hnadling of Q&A is required'
							}
						}
					},
					evaluation_delivery_technique: {
						validators: {
							notEmpty: {
								message: 'Delivery Technique is required'
							}
						}
					},evaluation_overall_assessment: {
						validators: {
							notEmpty: {
								message: 'Overall Assessmen is required'
							}
						}
					},
					evaluation_resource: {
						validators: {
							notEmpty: {
								message: 'Delivery Technique is required'
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
			});
		// form.querySelector('[name="user_email"]').addEventListener('input', function(e) {
		// 	const email = e.target.value;
		// 	if (email != '') {
		// 		fv.disableValidator('user_mobile_number');
		// 		$('.mobile_label').hide();
		// 	}else{
		// 		$('.mobile_label').show();
		// 	}
		// });
		// form.querySelector('[name="user_mobile_number"]').addEventListener('input', function(e) {
		// 	const user_mobile_number = e.target.value;
		// 	if (user_mobile_number != '') {
		// 		fv.disableValidator('user_email');
		// 		$('.email_label').hide();
		// 	}else{
		// 		$('.email_label').show();
		// 	}
		// });
	};
	var _initPictureGalleryForm = function () {
		const form = document.getElementById('picture_gallery_form');
		var fv = FormValidation.formValidation(
			document.getElementById('picture_gallery_form'),
			{
				fields: {
					gallery_category_id: {
						validators: {
							notEmpty: {
								message: 'Category is required'
							}
						}
					},
					
					gallery_album_id: {
						validators: {
							notEmpty: {
								message: 'Album is required'
							}
						}
					},
					'gallery_image_name[]': {
						validators: {
							notEmpty: {
								message: 'images is required'
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
			});
		// form.querySelector('[name="user_email"]').addEventListener('input', function(e) {
		// 	const email = e.target.value;
		// 	if (email != '') {
		// 		fv.disableValidator('user_mobile_number');
		// 		$('.mobile_label').hide();
		// 	}else{
		// 		$('.mobile_label').show();
		// 	}
		// });
		// form.querySelector('[name="user_mobile_number"]').addEventListener('input', function(e) {
		// 	const user_mobile_number = e.target.value;
		// 	if (user_mobile_number != '') {
		// 		fv.disableValidator('user_email');
		// 		$('.email_label').hide();
		// 	}else{
		// 		$('.email_label').show();
		// 	}
		// });
	};

	var _initUserTrainingForm = function () {
		const form = document.getElementById('user_training_form');
		var fv = FormValidation.formValidation(
			document.getElementById('user_training_form'),
			{
				fields: {
					training_course_name: {
						validators: {
							notEmpty: {
								message: 'Course Name is required'
							}
						}
					},
					
					training_institute_name: {
						validators: {
							notEmpty: {
								message: 'Institute Name is required'
							}
						}
					},
					training_date_from: {
						validators: {
							notEmpty: {
								message: 'Date from is required'
							}
						}
					},
					training_date_to: {
						validators: {
							notEmpty: {
								message: 'Date To is required'
							}
						}
					},
					training_type: {
						validators: {
							notEmpty: {
								message: 'Type To is required'
							}
						}
					},
					training_status: {
						validators: {
							notEmpty: {
								message: 'Status is required'
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
			});
		
	};
	
	return {
		// public functions
		init: function() {
			if(current_controller == "submissions" && (current_method == "detail" || current_method == "process_add")) {
				_initSubmissionForm();
			}
			
			if(current_controller == "instructions" && (current_method == "add" || current_method == "process_add")  ) {
				_initInstructionForm();
			}

			if(current_controller == "instructions" &&  (current_method == "update" || current_method == "process_update") ) {
				_initUpdateInstructionForm();
			}

			if(current_controller == "notices" &&  (current_method == "add" || current_method == "process_add")  ) {
				_initNoticesForm();
			}

			if(current_controller == "notices" &&  (current_method == "update" || current_method == "process_update") ) {
				_initUpdateNoticesForm();
			}

			
			if(current_controller == "advices" && ((current_method == "add" || current_method == "process_add")) ) {
				_initAdvicesForm();
			}

			if(current_controller == "advices" && ( current_method == "update" || current_method == "process_update") ) {
				_initUpdateAdvicesForm();
			}

			if(current_controller == "local_visits" && ((current_method == "add" || current_method == "process_add") || (current_method == "update" || current_method == "process_update")) ) {
				_initLocalVisitsForm();
			}
			if(current_controller == "inland_study_tours" && ((current_method == "add" || current_method == "process_add") || (current_method == "update" || current_method == "process_update")) ) {
				_initInlandStudyToursForm();
			}
			if(current_controller == "foreign_study_tours" && ((current_method == "add" || current_method == "process_add") || (current_method == "update" || current_method == "process_update")) ) {
				_initForeignStudyToursForm();
			}
			if(current_controller == "auth" && current_method == "change_password") {
				_initChangePassword();
			}
			if(current_controller == "auth" && current_method == "update_profile") {
				_initUpdateProfile();
			}
			if(current_controller == "institutes" && (current_method == "add" || current_method == "process_add")) {
				_initInstituteForm();
			}
			if(current_controller == "institutes" && (current_method == "update" || current_method == "process_update")) {
				_initInstituteUpdateForm();
			}
			if(current_controller == "designations" && (current_method == "add" || current_method == "process_add")) {
				_initDesignationForm();
			}
			if(current_controller == "designations" && (current_method == "update" || current_method == "process_update")) {
				_initDesignationUpdateForm();
			}
			if(current_controller == "batches" && (current_method == "add" || current_method == "process_add")) {
				_initBatchForm();
			}
			if(current_controller == "batches" && (current_method == "update" || current_method == "process_update")) {
				_initBatchUpdateForm();
			}
			if(current_controller == "sports" && (current_method == "add" || current_method == "process_add")) {
				_initSportForm();
			}
			if(current_controller == "sports" && (current_method == "update" || current_method == "process_update")) {
				_initSportUpdateForm();
			}
			if(current_controller == "committee_types" && (current_method == "add" || current_method == "process_add")) {
				_initCommitteeTypeForm();
			}
			if(current_controller == "committee_types" && (current_method == "update" || current_method == "process_update")) {
				_initCommitteeTypeUpdateForm();
			}
			if(current_controller == "local_departments" && (current_method == "add" || current_method == "process_add")) {
				_initLocalDepartmentForm();
			}
			if(current_controller == "local_departments" && (current_method == "update" || current_method == "process_update")) {
				_initLocalDepartmentUpdateForm();
			}
			if(current_controller == "guest_speaker_topics" && (current_method == "add" || current_method == "process_add")) {
				_initGuestSpeakerTopicForm();
			}
			if(current_controller == "guest_speaker_topics" && (current_method == "update" || current_method == "process_update")) {
				_initGuestSpeakerTopicUpdateForm();
			}
			if(current_controller == "participants" && (current_method == "add" || current_method == "process_add")) {
				_initAddParticipantForm();
			}
			if(current_controller == "participants" && (current_method == "update" || current_method == "process_update")) {
				_initUpdateParticipantForm();
			}
          	if(current_controller == "course_planning" && (current_method == "add" || current_method == "process_add")) {
				_initAddCoursePlanningForm();
			}
			if(current_controller == "course_planning" && (current_method == "update" || current_method == "process_update")) {
				_initAddCoursePlanningForm();
			}
			if(current_controller == "course_planning" && (current_method == "resource_add" || current_method == "new_resource_add" )) {
				_initResourceAddForm();
			}
           if(current_controller == "course_planning" && (current_method == "course_material"  || current_method == "course_material_add" || current_method == "resource_material_update" )) {
				_initResourceMaterialForm();
			}
           if(current_controller == "assignments" && (current_method == "assignment_materials" || current_method == "session_material_add" || current_method == "assignment_material_update" ) ) {
				_initResourceMaterialForm();
			}

			if(current_controller == "course_planning" && (current_method == "module_reading_material" || current_method == "reading_material_add" || current_method == "module_material_update")) {
				_initModuleMaterialForm();
			}
			
			if(current_controller == "users"  && (current_method == "add" || current_method == "process_add")) {
				_initAddUserForm();
			}


			if( current_controller == "guest_speakers" && (current_method == "add" || current_method == "process_add")) {
				_initAddGuestSpeakerForm();
			}


			if(current_controller == "users"  && (current_method == "update" || current_method == "process_update")) {
				_initUpdateUserForm();
			}

			if( current_controller == "guest_speakers" && (current_method == "update" || current_method == "process_update")) {
				_initUpdateGuestSpeakerForm();
			}


			if(current_controller == "profile" || current_controller == "participants_profile"  && (current_method == "personal_info" || current_method == "update_personal")) {
				_initPersonalInfoForm();
			}
			if(current_controller == "profile" || current_controller == "participants_profile"  && (current_method == "service_info" || current_method == "update_service")) {
				_initServiceInfoForm();
			}
			if(current_controller == "profile"  || current_controller == "participants_profile" && (current_method == "qualification_info" || current_method == "update_qualification")) {
				_initQualificationInfoForm()
			}
			if(current_controller == "profile" || current_controller == "participants_profile" && (current_method == "contact_info" || current_method == "update_contacts")) {
				_initContactInfoForm()
			}
			if(current_controller == "assignments" && (current_method == "record" || current_method == "assignment_add")) {
			
				_initAddAssignmentPlanningForm();
			}
			if(current_controller == "session_topics" && (current_method == "add" || current_method == "process_add")) {
				_initSessionTopicAddForm();
			}
			if(current_controller == "session_topics" && (current_method == "update" || current_method == "process_update")) {
				_initSessionTopicUpdateForm();
			}
			if(current_controller == "assignment_topics" && (current_method == "assign_topic_user" || current_method == "assign_topic"  )) {
				_initAssignmentTopicsAddForm();
			}
			if(current_controller == "committees" && (current_method == "add" || current_method == "process_add")) {
				_initAddCommitteeForm();
			}
			if(current_controller == "committees" && (current_method == "update" || current_method == "process_update")) {
				_initUpdateCommitteeForm();
			}
			if(current_controller == "preferences" && (current_method == "add" || current_method == "process_add")) {
				_initPreferencesAddForm();
			}
			if(current_controller == "participants" && (current_method == "preference_add" || current_method == "preference_save")) {
				_initPreferencesAddForm();
			}
			if(current_controller == "preferences" && (current_method == "update" || current_method == "process_update")) {
				_initPreferencesUpdateForm();
			}
			if(current_controller == "participants" && (current_method == "preference_update" || current_method == "update_preference_record")) {
				_initPreferencesUpdateForm();
			}
			if(current_controller == "miscellaneous" && (current_method == "add" || current_method == "process_add" || current_method == "update"  )  ) {
				_initMiscellaneousForm();
			}
			if(current_controller == "assignments" && (current_method == "advisor_add" || current_method == "new_advisor_add" )) {
				_initAssignAdvisorForm();
			}
			if(current_controller == "modules" && (current_method == "add" || current_method == "process_add" )) {
				_initModulesForm();
			}

			if(current_controller == "categories" && (current_method == "add" || current_method == "process_add" || current_method == "update" || current_method == "process_update")) {
				_initCategoriesForm();
			}

			if(current_controller == "assignment_types" && (current_method == "add" || current_method == "process_add" || current_method == "update" || current_method == "process_update" )) {
				_initAssignmentTypesForm();
			}
			if(current_controller == "Institute_users" && (current_method == "add" || current_method == "process_add" )) {
				_initAddInstituteUserForm();
			}
			if(current_controller == "institute_users" && (current_method == "update" || current_method == "process_update")) {
				_initUpdateInstituteUserForm();
			}

			if(current_controller == "evaluations" && (current_method == "evaluate" || current_method == "resource_evaluation")) {
				_initEvaluationsForm();
			}

			if(current_controller == "picture_gallery" && (current_method == "index")) {
			
				_initPictureGalleryForm();
			}

			if(current_controller == "user_trainings" && (current_method == "add" || current_method == "update"  )) {
			
				_initUserTrainingForm();
			}

			if(current_controller == "uploads" && (current_method == "seating_plan_add" || current_method == "seating_plan_save"  || current_method == "course_add" || current_method == "course_save" || current_method == "block_program_add"  || current_method == "block_program_save" || current_method == "add" || current_method == "process_add" )) {
	
				_initSeatingPlanForm();
			}

			if(current_controller == "uploads" && (current_method == "seating_plan_update" || current_method == "seating_plan_record_update" || current_method == "course_update" || current_method == "course_record_update"  || current_method == "block_program_update" || current_method == "block_record_update" )) {
	
				_initSeatingUpdatePlanForm();
			}

		}
	};
}();

jQuery(document).ready(function() {
	KTFormControls.init();
});
