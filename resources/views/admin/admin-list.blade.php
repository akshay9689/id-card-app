<!DOCTYPE html>
<html lang="zxx" class="js">

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
                                        <h3 class="nk-block-title page-title">Create School</h3>
                                        <div class="nk-block-des text-soft">
                                            <p>You have total {{ $data->total() }} School's.</p>
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                        <div class="toggle-wrap nk-block-tools-toggle">
                                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                            <div class="toggle-expand-content" data-content="pageMenu">
                                                <ul class="nk-block-tools g-3">
                                                    <li><a href="#" class="btn btn-white btn-outline-light"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                                                    <li class="nk-block-tools-opt">
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a type="button" data-bs-toggle="modal" data-bs-target="#modalAdd" ><span>Add School</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
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
                                            <form method="post" action="{{ route('add-school') }}" class="form-validate" enctype="multipart/form-data">@csrf
                                                <div class="row g-gs">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-full-name">Name</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" name="org_name" value="{{old('org_name')}}" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Logo</label>
                                                            <div class="form-control-wrap">
                                                                <div class="form-icon form-icon-right">
                                                                    <em class="icon ni ni-file"></em>
                                                                </div>
                                                                <input type="file" class="form-control" name="org_photo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">School Email</label>
                                                            <div class="form-control-wrap">
                                                                <div class="form-icon form-icon-right">
                                                                    <em class="icon ni ni-email"></em>
                                                                </div>
                                                                <input type="email" value="{{old('org_email')}}" class="form-control" name="org_email" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">School Phone</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" value="{{old('org_mobile')}}" class="form-control" name="org_mobile" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-message">Address</label>
                                                            <div class="form-control-wrap">
                                                                <textarea class="form-control form-control-sm" name="org_address" placeholder="Write address" required>{{old('org_address')}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <h4>Add Admin</h4>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-full-name">Full Name</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{old('username')}}" name="username" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Contact</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{old('mobile')}}" name="mobile" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">Email</label>
                                                            <div class="form-control-wrap">
                                                                <input type="email" class="form-control" value="{{old('email')}}" name="email" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-logo">password</label>
                                                            <div class="form-control-wrap">
                                                                <input type="password" class="form-control" name="password" required>
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
                                                    <div class="nk-tb-col"><span class="sub-text">User</span></div>
                                                     <div class="nk-tb-col"><span class="sub-text">Mobile</span></div>
                                                      <div class="nk-tb-col"><span class="sub-text">Reg. Date</span></div>
                                                   
                                                    <div class="nk-tb-col"><span class="sub-text">Status</span></div>
                                                    <div class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Action</span></div>
                                                    
                                                </div><!-- .nk-tb-item -->
                                                <?php if(count($data) > 0) {?>
                                                 @foreach ($data as $user)
    
                                                 <div class="nk-tb-item">
                                                    <div class="nk-tb-col nk-tb-col-check">
                                                        {{ ($data->currentPage()-1) * $data->perPage() + $loop->iteration}}
                                                      
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <div class="user-card">
                                                            
                                                            <div class="user-info">
                                                                <span class="tb-lead"> {{ $user->name}} <span class="dot dot-success d-md-none ms-1"></span></span>
                                                                <span>{{ $user->email}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                      <div class="nk-tb-col">
                                                        <span>{{ $user->mobile}}</span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <span><?php echo date('d-m-Y',strtotime($user->created_at))?><sub style="font-size: 91%;"> / </sub></span>
                                                        <span><?php echo date('h:i A',strtotime($user->created_at))?></span>
                                                    </div>


                                                    <div class="nk-tb-col">
                                                        <ul class="list-status">
                                                            
                                                            <li>
                                                            @if($user->status === 0)
                                                            <em class="icon text-success ni ni-check-circle"></em><span>Active</span> 
                                                            @elseif($user->status === 1)
                                                            <em class="icon text-warning ni ni-alert-circle"></em><span>Deactive</span> 
                                                            @else 
                                                            <em class="icon text-danger ni ni-alarm-alt"></em> 
                                                            @endif
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    
                                                   
                                                    <div class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1">
                                                            <li class="nk-tb-action-hidden">
                                                                <a href="{{url('user-profile', $user->id )}}" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                                    <em class="icon ni ni-eye-fill"></em>
                                                                </a>
                                                            </li>
                                                            
                                                            <li>
                                                                <div class="drodown">
                                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            
                                                                            
                                                                            <li>
                                                                                <a type="button" data-bs-toggle="modal" data-bs-target="#modaledit<?php echo $user->id;?>">
                                                                                    <em class="icon ni ni-pen"></em><span>Edit School</span></a> 
                                                                            </li>
                                                                            <li>
                                                                                <a type="button" data-bs-toggle="modal" data-bs-target="#modaleditAdmin<?php echo $user->user_id;?>">
                                                                                    <em class="icon ni ni-pen"></em><span>Edit Admin</span></a> 
                                                                            </li>
                                                                           <?php if($user->status === 0) {?>
                                                                            <li><a type="button" data-bs-toggle="modal" data-bs-target="#modalstatus<?php echo $user->user_id;?>"><em class="icon ni ni-cross-fill-c"></em><span>Deactive</span></a></li>
                                                                            <?php } else { ?>
                                                                            <li><a type="button" data-bs-toggle="modal" data-bs-target="#modalstatus<?php echo $user->user_id;?>"><em class="icon ni ni-check-c"></em><span>Active</span></a></li>
                                                                            <?php } ?>
                                                                           
                                                                            <li class="divider"></li>
                                                                            
                                                                            <li>
                                                                                 <a type="button" data-bs-toggle="modal" data-bs-target="#modaldelete<?php echo $user->user_id;?>">
                                                                                    <em class="icon ni ni-trash-alt"></em><span>Delete Admin</span></a> 
                                                                                </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div><!-- .nk-tb-item -->

    <!-- Modal edit school -->
    <div class="modal fade" id="modaledit<?php echo $user->id;?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit School</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-school', $user->id) }}" enctype="multipart/form-data" class="form-validate is-alter">
                        @csrf
                        <input type="hidden" name="id" value="<?php echo $user->id;?>">
                        <div class="form-group">
                            <label class="form-label" for="">School Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="{{ $user->org_name }}" name="org_name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="">School Photo</label>
                            <input type="hidden" name="old_photo" value="{{ $user->org_photo }}">
                            <div class="form-control-wrap">
                                <input type="file" class="form-control" name="org_photo" >
                                <img class="img_size" src="images/school/{{ $user->org_photo}}" alt="photo">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="form-label" for="">School Email</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="{{ $user->org_email }}" name="org_email" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="form-label" for="">School Mobile</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="{{ $user->org_mobile }}" pattern="[6-9]{1}[0-9]{9}" 
                                title="Phone number with 7-9 and remaing 9 digit with 0-9" name="org_mobile" required>
                            </div>
                        </div>

                       
                            <div class="form-group">
                                <label class="form-label" for="fv-message">Address</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control form-control-sm" name="org_address" placeholder="Write address" required>{{ $user->org_address }}</textarea>
                                </div>
                            </div>
                        

                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Update </button>
                        </div>

                    </form>
                </div>
                
            </div>
        </div>
    </div>


<!-- Modal edit admin -->
<div class="modal fade" id="modaleditAdmin<?php echo $user->user_id;?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Admin</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('update-admin', $user->user_id) }}" class="form-validate is-alter">
                    
                    @csrf
                    <input type="hidden" name="id" value="<?php echo $user->id;?>">
                    <div class="form-group">
                        <label class="form-label" for="">Name</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" value="{{ $user->name }}" name="name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="">Email</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" value="{{ $user->email }}" name="email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for=""> Mobile </label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" value="{{ $user->mobile }}" pattern="[6-9]{1}[0-9]{9}" 
                            title="Phone number with 7-9 and remaing 9 digit with 0-9" name="mobile" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">Update </button>
                    </div>

                </form>
            </div>
            
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" id="modalstatus<?php echo $user->user_id;?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('change-admin-status')}}"> @csrf
            <input type="hidden" name="type" value="status_update">
            <input type="hidden" name="id" value="<?php echo $user->user_id;?>">
            <input type="hidden" name="status" value="{{ $user->status === 0 ? 1 : 0 }}">
            <div class="modal-body modal-body-lg text-center">
                <div class="nk-modal">
                    <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-question"></em>
                    <h4 class="nk-modal-title">Do You Really Want Change Status to {{ $user->status === 1 ? "Active" : "Deactive" }}   below User?</h4>
                    <div class="nk-modal-text">
                        <p class="text-soft">
                            {{ $user->name}} / {{ $user->email }}
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


<div class="modal fade" tabindex="-1" id="modaldelete<?php echo $user->user_id;?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{route('delete-admin')}}"> @csrf

            <input type="hidden" name="id" value="<?php echo $user->user_id;?>">
            <div class="modal-body modal-body-lg text-center">
                <div class="nk-modal">
                     <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                    <h4 class="nk-modal-title">Do You Really Want Delete below Admin?</h4>
                    <div class="nk-modal-text">
                        <p class="text-soft">
                            {{ $user->name}} / {{ $user->mobile }}
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

    
    <!-- Modal add member -->
    <div class="modal fade" id="modalAdd">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Member</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('add-admin') }}" class="form-validate is-alter">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="">Full Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="full_name" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="form-label" for="">Mobile</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" pattern="[6-9]{1}[0-9]{9}" 
                                title="Phone number with 7-9 and remaing 9 digit with 0-9" name="mobile" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="">Secondary Mobile</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="mobile2">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="form-label" for="">Email</label>
                            <div class="form-control-wrap">
                                <input type="email" class="form-control" name="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="pay-amount">Address</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="address" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="pay-amount">Pincode</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" pattern="[1-9]{1}[0-9]{6}" 
                                title="Enter a valid Pincode" name="pincode" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="">Select ID Proof</label>
                            <div class="form-control-wrap">
                                {{-- <input type="email" class="form-control" name="email"> --}}
                                <select name="document_name" class="form-control">
                                    <option value="">--Select--</option>
                                    <option value="adhar">Adhar Card</option>
                                    <option value="pan">Pan Card</option>
                                    <option value="voter">Voter Id</option>
                                    <option value="driving">Driving Licence</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="form-label" for="pay-amount">ID Number</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="document_number" >
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Add </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
                
                @include('admin.includes.footer')



               