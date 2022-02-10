@extends('layouts.main')
@push('title', 'Update Gender Segregation Budgeting')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('annual-development-projects.index') }}" class="text-muted">Gender Segregation Budgeting</a>
    </li>
    <li class="breadcrumb-item">
        <a class="text-muted">Update</a>
    </li>
@endpush
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example-compact">
                <div class="card-header">
                    <h3 class="card-title">Update Gender Segregation Budgeting</h3>

                </div>

                <!--begin::Form-->
                {!! Form::open(array('id'=>'form_add_edit','route' => ['annual-development-projects.update', $annualDevelopmentProject],'method'=>'PUT','files' => 'true')) !!}
                <div class="card-body">

                    <div class="row form-group @if(!empty(auth()->user()->department_id)) d-none @endif">
                        <div class="col-lg-6">
                            <label>Department <span class="color-red-700">*</span></label>
                            <select class="form-control select2" name="department_id">
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option {{ old('department_id',$annualDevelopmentProject->department_id)== $department->id ? 'selected': '' }} value="{{ $department->id }}"> {{ $department->department_name }} </option>
                                @endforeach
                            </select>
                            @error('department_id')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>


                    </div>
                    <div class="row form-group">


                        <div class="col-lg-6">
                            <label>Project <span class="color-red-700">*</span></label>
                            <select class="form-control select2" name="project_id" onchange="loadBudgetTable(this)">
                                <option value="">Select Project</option>
                                @foreach($projects as $project)
                                    <option {{ old('project_id', $annualDevelopmentProject->project_id)== $project->id ? 'selected': '' }} value="{{ $project->id }}"> {{ $project->project_title }} </option>
                                @endforeach
                            </select>
                            @error('project_id')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <label>Project Type <span class="color-red-700">*</span></label>
                            <select class="form-control select2" name="project_type_id">
                                <option value="">Select Project</option>
                                @foreach($project_types as $project_type)
                                    <option {{ old('project_type_id', $annualDevelopmentProject->project_type_id)== $project_type->id ? 'selected': '' }} value="{{ $project_type->id }}"> {{ $project_type->project_type_title }} </option>
                                @endforeach
                            </select>
                            @error('project_type_id')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">

                        <div class="col-lg-12">
                            <label>Project Target <span class="color-red-700">*</span></label>
                            <select class="form-control select2" name="target_id">
                                <option value="">Select Target</option>
                                @if(isset($targets) && !empty($targets))
                                    @foreach($targets as $target)
                                        <option {{ old('target_id',$annualDevelopmentProject->target_id)== $target->id ? 'selected': '' }} value="{{ $target->id }}"> {{ $target->target_value }} </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('target_id')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="row form-group">
                        <div class="col-lg-6">
                            <label>Project Document Attachment<span class="color-red-700">*</span>@if(!empty($annualDevelopmentProject->project_document_file))&nbsp;<a href="{{ \Illuminate\Support\Facades\Storage::url($annualDevelopmentProject->project_document_file) }}" target="_blank">View File</a> @endif</label>
                            <input type="file" name="project_document_file" class="form-control" value="" />
                            <input type="hidden" name="old_project_document_file" class="form-control" value="{{ $annualDevelopmentProject->project_document_file }}" />
                            <small>Upload formats are jpeg,jpg,png,pdf and upload file size must be less than 2 MB</small>
                            @error('project_document_file')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <label>Total Approved Budget (Million)<span class="color-red-700">*</span></label>
                            <input type="text" name="total_approved_budget" style="width: 100% !important;" class="form-control money_format" placeholder="Approved Budget (Rs in Million)" value="{{ old('total_approved_budget' ,intval($annualDevelopmentProject->total_approved_budget)) }}" />
                            @error('total_approved_budget')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="row form-group">

                        <div class="col-lg-6">
                            <label>Project Start Date<span class="color-red-700">*</span></label>
                            <input readonly type="text" id="project_start_date" name="project_start_date" style="width: 100% !important;" class="form-control" placeholder="Start Date" value="{{ old('project_start_date', $annualDevelopmentProject->project_start_date) }}" />
                            @error('project_start_date')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <label>Project End Date<span class="color-red-700">*</span></label>
                            <input readonly type="text" id="project_end_date" name="project_end_date" style="width: 100% !important;" class="form-control" placeholder="End Date" value="{{ old('project_end_date', $annualDevelopmentProject->project_end_date) }}" />
                            @error('project_end_date')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <h4 class="mt-10 font-weight-bold section_heading">
                        <span>Budget</span>
                    </h4>

                    <div class="section_box">
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="text-left">Fiscal Year</th>
                                        <th class="text-left">Allocation</th>
                                        <th class="text-left">Utilization</th>
                                    </tr>
                                    </thead>
                                    <tbody id="budget-table-data">
                                    @php
                                        $project_budgets_count= $annualDevelopmentProject->projectBudgets->count() >= count(old('project_budgets',array(0))) ? $annualDevelopmentProject->projectBudgets->count():count(old('project_budgets',array(0)));
                                        $projectBudgets = $annualDevelopmentProject->projectBudgets;
                                    @endphp

                                    @for($index =0; $index<$project_budgets_count; $index++)
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <input readonly type="text" name="project_budgets[{{ $index }}][fiscal_year]" style="width: 100% !important;" class="form-control fiscal_years" placeholder="Fiscal Year" value="{{ old("project_budgets.{$index}.fiscal_year", $projectBudgets[$index]->fiscal_year??'') }}" />
                                                        @error("project_budgets.{$index}.fiscal_year")
                                                        <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <input type="text" name="project_budgets[{{ $index }}][budget_allocation]" style="width: 100% !important;" class="form-control budget_allocations money_format" placeholder="Budget Allocation (Million)" value="{{ old("project_budgets.{$index}.budget_allocation", (isset($projectBudgets[$index]->budget_allocation)?intval($projectBudgets[$index]->budget_allocation):'')) }}"  />
                                                        @error("project_budgets.{$index}.budget_allocation")
                                                        <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <input type="text" name="project_budgets[{{ $index }}][budget_utilization]" style="width: 100% !important;" class="form-control budget_utilizations money_format" placeholder="Budget Utilization (Million)" value="{{ old("project_budgets.{$index}.budget_utilization",  (isset($projectBudgets[$index]->budget_utilization)?intval($projectBudgets[$index]->budget_utilization):'')) }}"  />
                                                        @error("project_budgets.{$index}.budget_utilization")
                                                        <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endfor

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">

                        <div class="col-lg-6">
                            <label>Total Expenditure<span class="color-red-700">*</span></label>
                            <input  type="text" name="total_expenditure" style="width: 100% !important;" class="form-control money_format" placeholder="Total Expenditure till date (as per budget utilized)" value="{{ old('total_expenditure', $annualDevelopmentProject->total_expenditure) }}" />
                            @error('total_expenditure')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="rep-addresses m_repeater_section">
                        <div  data-repeater-list="progress_reports">
                            @foreach($annualDevelopmentProject->projectProgressReport as $index => $progress_report)
                            <div class="row form-group" data-repeater-item>
                                <div class="col-lg-6">
                                    <label>Progress Report<span class="color-red-700">*</span>@if(!empty($progress_report->progress_report_file))&nbsp;<a class="view-file" href="{{ \Illuminate\Support\Facades\Storage::url($progress_report->progress_report_file) }}" target="_blank">View File</a> @endif</label>
                                    <input type="file" name="progress_report_file" class="form-control progress_report" value=""  />
                                    <input type="hidden" name="old_progress_report_file" class="old_progress_report_file form-control" value="{{ $progress_report->progress_report_file }}"  />
                                    <small>Upload formats are jpeg,jpg,png,pdf and upload file size must be less than 2 MB</small>
                                    @error("progress_reports.{$index}.progress_report_file")
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-icon btn-danger btn-sm mt-8 ">
                                        <i class="la la-remove"></i>
                                    </a>
                                </div>

                            </div>
                            @endforeach
                        </div>
                        <div class="text-left form-group">
                            <div data-repeater-create="" class="btn btn btn-sm btn-success m-btn m-btn--icon m-btn--pill m-btn--wide">
                                                                        <span>
                                                                            <i class="la la-plus"></i>
                                                                            <span>Add More</span>
                                                                        </span>
                            </div>
                        </div>

                    </div>

                    <h4 class="mt-10 font-weight-bold section_heading">
                        <span>Project Beneficiaries</span>
                    </h4>
                    <div class="section_box">
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <label>Male<span class="color-red-700"></span></label>
                                            <input  type="text" name="beneficiary_male" class="form-control beneficiary  money_format" placeholder="Male" value="{{ old('beneficiary_male', $annualDevelopmentProject->beneficiary_male) }}" />
                                            @error('beneficiary_male') <div class="error">{{ $message }}</div> @enderror
                                        </td>
                                        <td>
                                            <label>Female<span class="color-red-700"></span></label>
                                            <input  type="text" name="beneficiary_female" class="form-control beneficiary money_format" placeholder="Female" value="{{ old('beneficiary_female', $annualDevelopmentProject->beneficiary_female) }}" />
                                            @error('beneficiary_female') <div class="error">{{ $message }}</div> @enderror
                                        </td>
                                        <td>
                                            <label>Transgender<span class="color-red-700"></span></label>
                                            <input type="text" name="beneficiary_trans_gender" class="form-control beneficiary money_format" placeholder="Transgender" value="{{ old('beneficiary_trans_gender', $annualDevelopmentProject->beneficiary_trans_gender) }}" />
                                            @error('beneficiary_trans_gender') <div class="error">{{ $message }}</div> @enderror
                                        </td>
                                        <td>
                                            <label>Total<span class="color-red-700"></span></label>
                                            <input readonly type="text" id="beneficiary_total" name="beneficiary_total" class="form-control money_format" placeholder="Total" value="{{ old('beneficiary_total', $annualDevelopmentProject->beneficiary_total) }}" />
                                            @error('beneficiary_total') <div class="error">{{ $message }}</div> @enderror
                                        </td>
                                        <td>
                                            <label>Minority<span class="color-red-700"></span></label>
                                            <input type="text" name="minority" class="form-control money_format" placeholder="Minority" value="{{ old('minority', $annualDevelopmentProject->minority) }}" />
                                            @error('minority') <div class="error">{{ $message }}</div> @enderror
                                        </td>
                                        <td>
                                            <label>Disabilities<span class="color-red-700"></span></label>
                                            <input type="text" name="disability" class="form-control money_format" placeholder="Persons with Disabilities" value="{{ old('disability', $annualDevelopmentProject->disability) }}" />
                                            @error('disability') <div class="error">{{ $message }}</div> @enderror
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary custom-btn-form mr-2">Submit</button>
                    <a href="{{ route('annual-development-projects.index') }}"  class="btn btn-secondary">Cancel</a>
                </div>
            {!! Form::close() !!}
            <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection

@push('post-scripts')
    <script id="budget-table" type="x-tmpl-mustache">
        @{{#years}}
            <tr>
                <td>
                    <div class="row">
                        <div class="col-lg-12">
                    <input readonly type="text" name="project_budgets[@{{ index }}][fiscal_year]" style="width: 100% !important;" class="form-control fiscal_years" placeholder="Fiscal Year" value="@{{ name  }}" />
                    </div>
                      </div>
                </td>
                <td>
                    <div class="row">
                    <div class="col-lg-12">
                    <input type="text" name="project_budgets[@{{ index }}][budget_allocation]" style="width: 100% !important;" class="form-control budget_allocations money_format" placeholder="Budget Allocation (Million)" value=""  />
                    </div>
                    </div>
                </td>
                <td>
                   <div class="row">
                   <div class="col-lg-12">
                    <input type="text" name="project_budgets[@{{ index }}][budget_utilization]" style="width: 100% !important;" class="form-control budget_utilizations money_format" placeholder="Budget Utilization (Million)" value=""  />
                    </div>
                    </div>
                </td>
            </tr>
        @{{/years}}
    </script>

    <script>
        const fiscal_years_rule = {
            validators: {
                notEmpty: {
                    message: 'Fiscal year is required'
                }
            }
        };

        const budget_allocations_rule = {
            validators: {
                notEmpty: {
                    message: 'Budget allocation is required'
                }
            }
        };

        const budget_utilizations_rule = {
            validators: {
                notEmpty: {
                    message: 'Budget utilization is required'
                }
            }
        };

        const progress_report_rule = {
            validators: {
                notEmpty: {
                    message: 'Progress report attachment is required'
                },
                file: {
                    extension: 'jpeg,jpg,png,pdf',
                    type: 'image/jpeg,image/png,application/pdf',
                    maxSize: 2097152, // 2048 * 1024
                    message: 'The selected file is not valid',
                },
            }
        };

        let fv;
        $(document).ready(function() {

            $('.m_repeater_section').repeater({
                initEmpty: false,
                defaultValues: {
                    'text-input': 'foo'
                },
                show: function() {
                    $(this).slideDown();
                    $(this).find('.view-file').remove();
                    $(this).find('.old_progress_report_file').remove();
                    let progress_report = $(this).find('.progress_report').attr('name');
                    fv.addField(progress_report, progress_report_rule);
                },
                hide: function(deleteElement) {
                    if(confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                        let progress_report = $(this).find('.progress_report').attr('name');
                        console.log(progress_report);
                        fv.removeField(progress_report);
                    }
                },
                isFirstItemUndeletable: true,
            });

            fv = FormValidation.formValidation(
                document.getElementById('form_add_edit'),
                {
                    fields: {
                        department_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Department is required'
                                }
                            }
                        },
                        project_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Project is required'
                                }
                            }
                        },
                        project_type_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Project type is required'
                                }
                            }
                        },
                        target_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Project Target is required'
                                }
                            }
                        },
                        total_approved_budget: {
                            validators: {
                                notEmpty: {
                                    message: 'Total approved budget is required'
                                }
                            }
                        },
                        year_wise_policies_interventions: {
                            validators: {
                                notEmpty: {
                                    message: 'Year wise policies is required'
                                }
                            }
                        },
                        project_start_date: {
                            validators: {
                                notEmpty: {
                                    message: 'Project start date is required'
                                }
                            }
                        },
                        project_end_date: {
                            validators: {
                                notEmpty: {
                                    message: 'Project end date is required'
                                }
                            }
                        },
                        beneficiary_total: {
                            validators: {
                                notEmpty: {
                                    message: 'At least one is required (Male, Female, Transgender)'
                                }
                            }
                        },
                        'project_budgets[0][fiscal_year]' : fiscal_years_rule,
                        'project_budgets[0][budget_allocation]' : budget_allocations_rule,
                        'project_budgets[0][budget_utilization]' : budget_utilizations_rule,
                        total_expenditure : {
                            validators: {
                                notEmpty: {
                                    message: 'Total Expenditure is required'
                                }
                            }
                        },
                        project_document_file: {
                            validators: {
                                notEmpty: {
                                    enabled: {{$annualDevelopmentProject->project_document_file?'false':'true'}},
                                    message: 'Project document attachment is required'
                                },
                                file: {
                                    extension: 'jpeg,jpg,png,pdf',
                                    type: 'image/jpeg,image/png,application/pdf',
                                    maxSize: 2097152, // 2048 * 1024
                                    message: 'The selected file is not valid',
                                },
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


            $('.beneficiary').on('change', function (){
                let beneficiary_total = 0;
                $('.beneficiary').each(function (){
                    let beneficiary = $(this).val();
                    if(beneficiary)
                        beneficiary_total += parseInt(beneficiary.replace(',',''));
                });
                if(beneficiary_total){
                    $('#beneficiary_total').val(beneficiary_total);
                }else{
                    $('#beneficiary_total').val("");
                }
            });

            @for($index =0; $index<$project_budgets_count; $index++)
            fv.addField('project_budgets[{{$index}}][fiscal_year]', fiscal_years_rule);
            fv.addField('project_budgets[{{$index}}][budget_allocation]', budget_allocations_rule);
            fv.addField('project_budgets[{{$index}}][budget_utilization]', budget_utilizations_rule);
            @endfor

        });
        let fiscal_years = @if($annualDevelopmentProject->projectBudgets->isNotEmpty()) {!! $annualDevelopmentProject->projectBudgets->toJson() !!}; @else [[]] @endif
        function loadBudgetTable(obj){
            let project_id = $(obj).val();
            $.post('{{ route('annual-development-projects.find-project') }}', {'project_id': project_id}, function (response){
                if(response.status){
                    $('#project_start_date').val(response.project_start_date)
                    $('#project_end_date').val(response.project_end_date)
                    let template = document.getElementById('budget-table').innerHTML;
                    let rendered = Mustache.render(template, response);
                    document.getElementById('budget-table-data').innerHTML = rendered;
                    fiscal_years.forEach(function (obj, rowIndex) {
                        fv.removeField('project_budgets[' + rowIndex + '][fiscal_year]');
                        fv.removeField('project_budgets[' + rowIndex + '][budget_allocation]');
                        fv.removeField('project_budgets[' + rowIndex + '][budget_utilization]');
                    });

                    fiscal_years = response.years;

                    fiscal_years.forEach(function (obj, rowIndex){
                        fv.addField('project_budgets[' + rowIndex + '][fiscal_year]', fiscal_years_rule);
                        fv.addField('project_budgets[' + rowIndex + '][budget_allocation]', budget_allocations_rule);
                        fv.addField('project_budgets[' + rowIndex + '][budget_utilization]', budget_utilizations_rule);
                    });

                    $(".money_format").inputmask("currency",{
                        radixPoint:"",
                        groupSeparator: ",",
                        allowMinus: false,
                        prefix: '',
                        digits: 0,
                        digitsOptional: false,
                        rightAlign: false,
                        unmaskAsNumber: true,
                        removeMaskOnSubmit:true,
                        autoUnmask:false,
                        greedy:true,
                        insertMode:true,
                        clearIncomplete:false,
                        clearMaskOnLostFocus:true,
                        placeholder: ''
                    });

                }else{
                    $('#project_start_date').val("")
                    $('#project_end_date').val("")
                    let template = document.getElementById('budget-table').innerHTML;
                    let rendered = Mustache.render(template, response);
                    document.getElementById('budget-table-data').innerHTML = rendered;
                }
            }, "json");
        }

    </script>

@endpush
