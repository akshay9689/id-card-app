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
                                        <h3 class="nk-block-title page-title">Assign the Teacher</h3>
                                        <div class="nk-block-des text-soft">
                                            <p>You have total {{ $data->total() }} Student's.</p>
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                        <div class="toggle-wrap nk-block-tools-toggle">
                                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                            <div class="toggle-expand-content" data-content="pageMenu">
                                               
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
                                            <form method="post" action="{{ route('assign') }}" class="form-validate" enctype="multipart/form-data">@csrf
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
                                                            <label class="form-label" for="fv-logo">Teacher</label>
                                                            <div class="form-control-wrap">
                                                                <select name="teacher" id="teacher" class="form-control" required>
                                                                    <option value="">--select--</option>
                                                                    @foreach($teacher_data as $teacher)
                                                                    <option value="{{ $teacher->id }}">{{ $teacher->name}}</option>
                                                                    @endforeach
                                                                </select>
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
                                                    <div class="nk-tb-col"><span class="sub-text">Class</span></div>
                                                    <div class="nk-tb-col"><span class="sub-text">Section</span></div>
                                                    <div class="nk-tb-col"><span class="sub-text">Class Teacher</span></div>
                                                    <div class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Action</span></div>
                                                     
                                                </div><!-- .nk-tb-item -->
                                                <?php if(count($data) > 0) {?>
                                                 @foreach ($data as $data1)
                                            
                                                 <div class="nk-tb-item">
                                                    <div class="nk-tb-col nk-tb-col-check">
                                                        {{ ($data->currentPage()-1) * $data->perPage() + $loop->iteration}}
                                                    </div>

                                                    <div class="nk-tb-col">
                                                        <span> {{$data1->class_name}} </span>
                                                    </div>

                                                    <div class="nk-tb-col">
                                                        <span> {{$data1->division_name}} </span>
                                                    </div>


                                                    <div class="nk-tb-col">
                                                        <span> {{$data1->teacher_name}} </span>
                                                    </div>

                                                   
                                                    <div class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1">
                                                            
                                                            <li class="nk-tb-action-hidden">
                                                                <a href="{{url('user-profile', $data1->id )}}" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                                    <em class="icon ni ni-eye-fill"></em>
                                                                </a>
                                                            </li>
                                                            
                                                            <li>
                                                                <div class="drodown">
                                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            
                                                                            <li>
                                                                                <a type="button" href="{{ url('edit-assign',$data1->id)}}">
                                                                                <em class="icon ni ni-pen"></em><span>Edit</span></a> 
                                                                            </li>
                                                                            
                                                                            <li class="divider"></li>
                                                                            
                                                                            <li>
                                                                                 <a type="button" data-bs-toggle="modal" data-bs-target="#modaldelete<?php echo $data1->id;?>">
                                                                                 <em class="icon ni ni-trash-alt"></em><span>Remove Assignment</span></a> 
                                                                            </li>
                                                                            
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div><!-- .nk-tb-item -->

<div class="modal fade" tabindex="-1" id="modaldelete<?php echo $data1->id;?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{route('delete-admin')}}"> @csrf

            <input type="hidden" name="id" value="<?php echo $data1->id;?>">
            <div class="modal-body modal-body-lg text-center">
                <div class="nk-modal">
                     <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                    <h4 class="nk-modal-title">Do You Really Want Delete below Assign Teacher?</h4>
                    <div class="nk-modal-text">
                        <p class="text-soft">

                            {{ $data1->teacher_name}} 

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



               