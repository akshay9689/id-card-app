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
                                        <h3 class="nk-block-title page-title">Edit Student</h3>
                                        
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                        <div class="toggle-wrap nk-block-tools-toggle">
                                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                            <div class="toggle-expand-content" data-content="pageMenu">
                                                <ul class="nk-block-tools g-3">
                                                    
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
                                            
                                            <form method="post" action="{{ route('update-student') }}" class="form-validate" enctype="multipart/form-data">@csrf
                                                <div class="row g-gs">

                                            <input type="hidden" name="student_id" value="{{ $data->id}}">

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Class</label>
                                                            <div class="form-control-wrap">
                                                                <select name="class" id="class" class="form-control" required>
                                                                    <option value="">--select--</option>
                                                                    @foreach($class_data as $classs)
                                                                    <option value="{{ $classs->id }}" <?php  if($data->class == $classs->id) { echo "selected" ;}?>  >{{ $classs->name}}</option>
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
                                                                    @foreach($div as $div)
                                                                    <option value="{{ $div->id }}" <?php  if($data->division == $div->id) { echo "selected" ;}?> >{{ $div->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-full-name">Admission No.</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" name="admission_no" value="{{ $data->admission_no}}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Roll No</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{ $data->roll_no }}" name="roll_no" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">First Name</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{ $data->first_name }}" name="first_name" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Middle Name</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{ $data->middle_name }}" name="middle_name" >
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Last Name</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{ $data->last_name }}" name="last_name" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Gender</label>
                                                            <div class="form-control-wrap">
                                                                
                                                                <select name="gender" class="form-control" required>
                                                                    <option value="">--select--</option>
                                                                    <option value="male" {{ $data->gender == "male" ? "selected" : ""}}>Male</option>
                                                                    <option value="female" {{ $data->gender == "female" ? "selected" : ""}}>Female</option>
                                                                </select>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">DOB</label>
                                                            <div class="form-control-wrap">
                                                                <input type="date" class="form-control" value="{{ $data->dob }}" name="dob" required>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Blood Group</label>
                                                            <div class="form-control-wrap">
                                                                <select name="blood_group" class="form-control" >
                                                                    <option value="">--select--</option>
                                                                    <option value="O+" {{ $data->blood_group == "O+" ? "selected" : ""}}>O+</option>
                                                                    <option value="A+" {{ $data->blood_group == "A+" ? "selected" : ""}}>A+</option>
                                                                    <option value="B+" {{ $data->blood_group == "B+" ? "selected" : ""}}>B+</option>
                                                                    <option value="AB+" {{ $data->blood_group == "AB+" ? "selected" : ""}}>AB+</option>
                                                                    <option value="O-" {{ $data->blood_group == "O-" ? "selected" : ""}}>O-</option>
                                                                    <option value="A-" {{ $data->blood_group == "A-" ? "selected" : ""}}>A-</option>
                                                                    <option value="B" {{ $data->blood_group == "B+" ? "selected" : ""}}>B</option>
                                                                    <option value="AB-" {{ $data->blood_group == "AB-" ? "selected" : ""}}>AB-</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Father Name</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{ $data->father_name }}" name="father_name" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Father Mobile</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{ $data->father_mobile }}" name="father_mobile" required>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Mother Name</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{ $data->mother_name }}" name="mother_name" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Mother Mobile</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{ $data->mother_mobile }}" name="mother_mobile" required>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Student House</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{ $data->student_house }}" name="student_house" >
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Student Address</label>
                                                            <div class="form-control-wrap">
                                                                <textarea class="form-control" name="address"  required>{{ $data->address }}</textarea>
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



               