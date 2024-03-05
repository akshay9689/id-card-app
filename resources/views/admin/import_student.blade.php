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
                                        <h3 class="nk-block-title page-title">Import Student</h3>
                                        <div class="nk-block-des text-soft">
                                          
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                        <div class="toggle-wrap nk-block-tools-toggle">
                                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                            <div class="toggle-expand-content" data-content="pageMenu">
                                                <ul class="nk-block-tools g-3">
                                                    <li><a href="#" class="btn btn-white btn-outline-light yourlink" download><em class="icon ni ni-download"></em><span>Download Sample import File</span></a></li>
                                                </ul>
                                            </div>
                                        </div><!-- .toggle-wrap -->
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->

                            <!-- select criteria starts -->
                            
                            <div class="nk-block">
                                <div class="card card-stretch">
                                    <div class="card-inner-group">
                                        <div class="card-inner position-relative card-tools-toggle">
                                             
                                            <h6>Select Criteria</h6> <hr />
                                            
                                              <ol type="1">
                                                <li>1. Your CSV data should be in the format below. The first line of your CSV file should be the column headers as in the table example. Also make sure that your file is UTF-8 to avoid unnecessary encoding problems.</li>
                                                <li>2. If the column you are trying to import is date make sure that is formatted in format d-m-Y (06-06-2012).</li>
                                                <li>3. Duplicate Admission Number (unique) rows will not be imported.</li>
                                                <li>4. For student Gender use male, female value.</li>
                                                <li>5. For student Blood Group use O+, A+, B+, AB+, O-, A-, B-, AB- value.</li>
                                               </ol>
                                            
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- .card -->
                            </div><!-- .nk-block -->


                            <!-- select criteria ends -->

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
                                            <form method="post" action="{{ route('import_student') }}" class="form-validate" enctype="multipart/form-data">@csrf
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
                                                            <label class="form-label" for="fv-logo">Select CSV File</label>
                                                            <div class="form-control-wrap">
                                                                <input type="file" class="form-control" name="file">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-lg btn-primary">Import Student</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- .card -->
                            </div><!-- .nk-block -->

                            <!-- new code -->
                           
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

                    $('a.yourlink').click(function(e) {
                    e.preventDefault();
                    window.open('documents/import_student_sample_file.csv'); // it will open download of filepath

                    });
       
                  </script>
       
                
                @include('admin.includes.footer')



               