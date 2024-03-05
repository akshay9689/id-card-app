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
                                        <h3 class="nk-block-title page-title">Edit Class</h3>
                                        
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
                                            <form method="post" action="{{ route('update_class') }}" class="form-validate" enctype="multipart/form-data">@csrf
                                                <div class="row g-gs">
                                                    
                                                    <input type="hidden" name="class_id" value="{{ $data->id }}">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-full-name">Class Name</label>
                                                            <div class="form-control-wrap">
                                                            <input type="text" class="form-control" value="{{ $data->name }}" name="name" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="fv-full-name">Sections</label>
                                                            <div class="form-control-wrap">
                                                                <div class="g-3">
                                                                    
                                                                    @if(count($divisions))
                                                                    @foreach($divisions as $division)
                                                                    
                                                                    @php
                                                                    $is_there = 0;
                                                                    $arr = App\Models\ClassDivision::where(['class_id' => $data->id, 'division_id' => $division->id])->get()->toArray();
                                                                    if(count($arr) > 0){
                                                                    $is_there = 1;
                                                                    }
                                                                    @endphp

                                                                    <div class="g">
                                                                        <div class="custom-control custom-control-sm custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" name="divisions[]" value="{{ $division->id }}" id="div{{ $division->id}}" {{ $is_there === 1?"checked":""}} >
                                                                            <label class="custom-control-label" for="div{{ $division->id}}">{{ $division->name}}</label>
                                                                        </div>
                                                                    </div>

                                                                    @endforeach
                                                                    @endif
                                                                </div>
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



               