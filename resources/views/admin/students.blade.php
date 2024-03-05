<!DOCTYPE html>
<html lang="zxx" class="js">
<meta name="csrf-token" content="{{ csrf_token() }}"/>

<head>
   <title>{{$title? $title : ""}}</title>
     @include('admin.includes.script')
      <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>

<body class="nk-body ui-rounder has-sidebar ">
     @include('sweetalert::alert')
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
             @include('admin.includes.sidebar')
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                 @include('admin.includes.header')
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-xl">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">Create Student</h3>
                                        <div class="nk-block-des text-soft">
                                            <p>You have total {{ $data->total() }} Student's.</p>
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                        <div class="toggle-wrap nk-block-tools-toggle">
                                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                            <div class="toggle-expand-content" data-content="pageMenu">
                                                <ul class="nk-block-tools g-3">
                                                    <li><a href="{{ route('import_student') }}" class="btn btn-white btn-outline-light"><em class="icon ni ni-upload"></em><span>Import</span></a></li>
                                                </ul>
                                            </div>
                                        </div><!-- .toggle-wrap -->
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->
                            <!-- new code -->
                           
                            <div class="nk-block">
                                <div class="card card-stretch">
                                    <div class="card-inner-group">
                                        <div class="card-inner position-relative card-tools-toggle">
                                            @if ($errors->any())
                                <div class="alert alert-danger">
                                <ul>
                                @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li>
                                @endforeach
                               </ul>
                            </div>
                          @endif
                                            <form method="post" action="{{ route('student') }}" class="form-validate" enctype="multipart/form-data">@csrf
                                                <div class="row g-gs">

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Class</label>
                                                            <div class="form-control-wrap">
                                                                <select name="class" id="class" class="form-control" required>
                                                                    <option value="">--select--</option>
                                                                    @foreach($class_data as $class)

                                                                    <option value="{{ $class->id }}">{{ $class->name}}</option>

                                                                    @endforeach
                                                                    
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Division</label>
                                                            <div class="form-control-wrap">
                                                                <select name="division" id="division" class="form-control" required>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-full-name">Admission No.</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{old('admission_no')}}" name="admission_no" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Roll No</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{old('roll_no')}}" name="roll_no" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">First Name</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{old('first_name')}}" name="first_name" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Middle Name</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{old('middle_name')}}" name="middle_name" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Last Name</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{old('last_name')}}" name="last_name" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Gender</label>
                                                            <div class="form-control-wrap">
                                                                
                                                                <select name="gender" class="form-control" required>
                                                                    <option value="">--select--</option>
                                                                    <option value="male">Male</option>
                                                                    <option value="female">Female</option>
                                                                </select>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">DOB</label>
                                                            <div class="form-control-wrap">
                                                                <input type="date" class="form-control" value="{{old('dob')}}" name="dob" required>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Blood Group</label>
                                                            <div class="form-control-wrap">
                                                                <select name="blood_group" class="form-control" required>
                                                                    <option value="">--select--</option>
                                                                    <option value="O+">O+</option>
                                                                    <option value="A+">A+</option>
                                                                    <option value="B+">B+</option>
                                                                    <option value="AB+">AB+</option>
                                                                    <option value="O-">O-</option>
                                                                    <option value="A-">A-</option>
                                                                    <option value="B">B</option>
                                                                    <option value="AB-">AB-</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Father Name</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{old('father_name')}}" name="father_name" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Father Mobile</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{old('father_mobile')}}" name="father_mobile" required>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Mother Name</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{old('mother_name')}}" name="mother_name" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Mother Mobile</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{old('mother_mobile')}}" name="mother_mobile" required>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Student House</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{old('student_house')}}" name="student_house" required>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Student Address</label>
                                                            <div class="form-control-wrap">
                                                                <textarea class="form-control" name="address" required>{{old('address')}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-lg btn-primary">Save Informations</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- .card -->
                            </div><!-- .nk-block -->

                            <!-- new code -->
                            <div class="nk-block">
                                <div class="card card-stretch">
                                    <div class="card-inner-group">
                                        <div class="card-inner position-relative card-tools-toggle">
                                            <div class="card-title-group">
                                                <div class="card-tools">
                                                    
                                                </div><!-- .card-tools -->
                                                <div class="card-tools me-n1">
                                                    <ul class="btn-toolbar gx-1">
                                                        <li>
                                                            <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                                                        </li><!-- li -->
                                                        <!-- <li class="btn-toolbar-sep"></li> -->
                                                        <li>
                                                            <div class="toggle-wrap">
                                                                <!-- <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-menu-right"></em></a> -->
                                                                <div class="toggle-content" data-content="cardTools">
                                                                    <ul class="btn-toolbar gx-1">
                                                                       
                                                                        
                                                                    </ul><!-- .btn-toolbar -->
                                                                </div><!-- .toggle-content -->
                                                            </div><!-- .toggle-wrap -->
                                                        </li><!-- li -->
                                                    </ul><!-- .btn-toolbar -->
                                                </div><!-- .card-tools -->
                                            </div><!-- .card-title-group -->
                                            <form method="post" action="{{url('member-list-search')}}">
                                            @csrf
                                            <div class="card-search search-wrap" data-search="search">
                                                <div class="card-body">
                                                    <div class="search-content">
                                                        <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                        <input type="text" name="text" class="form-control border-transparent form-focus-none" placeholder="Search by username or email or mobile">
                                                        <button type="submit" class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                                    </div>
                                                </div>
                                            </div><!-- .card-search -->
                                        </form>
                                        </div><!-- .card-inner -->
                                        <div class="card-inner p-0 table-responsive">
                                            <div class="nk-tb-list nk-tb-ulist">
                                                <div class="nk-tb-item nk-tb-head">
                                                    <div class="nk-tb-col nk-tb-col-check"> No.
                                                       <!--  <div class="custom-control custom-control-sm custom-checkbox notext">
                                                            <input type="checkbox" class="custom-control-input" id="uid">
                                                            <label class="custom-control-label" for="uid"></label>
                                                        </div> -->
                                                    </div>
                                                    <div class="nk-tb-col"><span class="sub-text">Admission No.</span></div>
                                                    <div class="nk-tb-col"><span class="sub-text">Student</span></div>
                                                    <div class="nk-tb-col"><span class="sub-text">Roll No</span></div>
                                                    <div class="nk-tb-col"><span class="sub-text">Class</span></div>
                                                    <div class="nk-tb-col"><span class="sub-text">Father Name</span></div>
                                                    <div class="nk-tb-col"><span class="sub-text">DOB</span></div>
                                                    <div class="nk-tb-col"><span class="sub-text">Gender</span></div>
                                                    <div class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Action</span></div>
                                                     
                                                </div><!-- .nk-tb-item -->
                                                <?php if(count($data) > 0) {?>
                                                 @foreach ($data as $student)
    
                                                 <div class="nk-tb-item">
                                                    <div class="nk-tb-col nk-tb-col-check">
                                                        {{ ($data->currentPage()-1) * $data->perPage() + $loop->iteration}}
                                                      
                                                    </div>

                                                    <div class="nk-tb-col">
                                                        <span> {{$student->admission_no}} </span>
                                                        
                                                    </div>

                                                    <div class="nk-tb-col">
                                                        <div class="user-card">
                                                            <div class="user-info">
                                                                <span class="tb-lead"> {{$student->first_name}} - {{$student->last_name}} <span class="dot dot-success d-md-none ms-1"></span></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="nk-tb-col">
                                                        <span> {{$student->roll_no}} </span>
                                                    </div>

                                                    
                                                    @php

                                                    $arr = App\Models\Division::where(['id' => $student->division])->get()->toArray();
                                                    if(count($arr) > 0){
                                                    $division_name = $arr[0]['name'];
                                                    }
                                                    else {
                                                    $division_name = "";
                                                    }
                                                     
                                                    @endphp


                                                    @php

                                                    $arr = App\Models\Classes::where(['id' => $student->class])->get()->toArray();
                                                    if(count($arr) > 0){
                                                    $class_name = $arr[0]['name'];
                                                   }
                                                    else {
                                                    $class_name = "";
                                                    }
 
@endphp

                                                    <div class="nk-tb-col">
                                                    <span> {{ $class_name }} ({{$division_name}}) </span>
                                                    </div>

                                                    <div class="nk-tb-col">
                                                    <span> {{ $student->father_name }} </span>
                                                    </div>

                                                    <div class="nk-tb-col">
                                                    <span> <?php echo date('d/m/Y', strtotime($student->dob)) ?> </span>
                                                    </div>

                                                    <div class="nk-tb-col"><span class="sub-text"> {{ $student->gender }} </span></div>

                                                   
                                                    <div class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1">
                                                            <li class="nk-tb-action-hidden">
                                                                <a href="{{url('view-student', $student->id )}}" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                                    <em class="icon ni ni-eye-fill"></em>
                                                                </a>
                                                            </li>
                                                            
                                                            <li>
                                                                <div class="drodown">
                                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            
                                                                            <li>
                                                                                <a type="button" href="{{ route('edit-student', $student->id) }}">
                                                                                <em class="icon ni ni-pen"></em><span>Edit Student</span></a> 
                                                                            </li>
                                                                           
                                                                            <li class="divider"></li>
                                                                            
                                                                            <li>
                                                                                 <a type="button" data-bs-toggle="modal" data-bs-target="#modaldelete<?php echo $student->id;?>">
                                                                                    <em class="icon ni ni-trash-alt"></em><span>Delete Student</span></a> 
                                                                                </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div><!-- .nk-tb-item -->

<div class="modal fade" tabindex="-1" id="modaldelete<?php echo $student->id;?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{route('delete-student')}}"> @csrf

            <input type="hidden" name="student_id" value="<?php echo $student->id;?>">
            <div class="modal-body modal-body-lg text-center">
                <div class="nk-modal">
                     <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                    <h4 class="nk-modal-title">Do You Really Want Delete below Student?</h4>
                    <div class="nk-modal-text">
                        <p class="text-soft">
                            {{ $student->first_name}} {{ $student->last_name}} 
                        </p>
                    </div>

                    <div class="nk-modal-action mt-5">
                         <input type="submit" class="btn btn-lg btn-mw btn-light" value="submit">
                        <a href="#" class="btn btn-lg btn-mw btn-light" data-bs-dismiss="modal">Cancel</a>
                    </div>
                    
                </div>
            </div><!-- .modal-body -->
        </form>
        </div>
    </div>
</div>


                                                  @endforeach    
                                                  <?php } ?>                                            
                                                
                                            </div><!-- .nk-tb-list -->
                                        </div><!-- .card-inner -->
                                        <div class="card-inner">
                                            <div class="nk-block-between-md g-3">
                                                <div class="g">
                                                    <ul class="pagination justify-content-center justify-content-md-start">
                                                        {!!$data->links('pagination::bootstrap-5')!!}
                                                        
                                                    </ul><!-- .pagination -->
                                                </div>
                                               
                                            </div><!-- .nk-block-between -->
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- .card -->
                            </div><!-- .nk-block -->
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <!-- footer @s -->
<div class="modal fade" tabindex="-1" id="modalAlert2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body modal-body-lg text-center">
                    <div class="nk-modal">
                        <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                        <h4 class="nk-modal-title">Unable to Process!</h4>
                        <div class="nk-modal-text">
                            <p class="lead">We are sorry, we were unable to process your payment. Please try after sometimes.</p>
                            <p class="text-soft">If you need help please contact us at (855) 485-7373.</p>
                        </div>
                        <div class="nk-modal-action mt-5">
                            <a href="#" class="btn btn-lg btn-mw btn-light" data-bs-dismiss="modal">Return</a>
                        </div>
                    </div>
                </div><!-- .modal-body -->
            </div>
        </div>
    </div>

    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script type="text/javascript">
  
        $(document).ready(function(){
       
                      //subcategory change
       
                      $('#class').change(function(){
                       var cat = $(this).val();
       
                       // AJAX request
                       $.ajax({
                         headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                         url:"{{route('get_division_by_id')}}",
                     
                         method: 'post',
                         data: {cat:cat},
                         dataType: 'json',
                         success: function(response){
       
                           var $el = $("#division");
       
                           $el.empty();
                           $("#division").val('');
                           $el.append($("<option></option>")
                             .attr("value", '')
                             .attr("hidden",'')
                             .text('Select Division'));
       
                           $.each(response, function(index, data){
                             $el.append('<option value="'+data.id+'">'+data.name+'</option>')
                           });
       
                         }
                       });
                     });
                    }); 
       
       
                  </script>
       
                
                @include('admin.includes.footer')



               