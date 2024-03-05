<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <title>{{$title? $title : ""}}</title>
    @include('admin.includes.script')
</head>

<body class="nk-body ui-rounder has-sidebar ">
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
                                        <h3 class="nk-block-title page-title"> </h3>
                                        <div class="nk-block-des text-soft">
                                            <p></p>
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="row g-gs">
                                    
                                   
                            <div class="nk-block">
                                <div class="row g-gs">
                                   
                                    
                                    
                                </div><!-- .row -->
                            </div><!-- .nk-block -->

                                   <!-- fish details new ends-->
                                            
                                   @php 
                                  $organisations = DB::table('organisations')->get();
                                  $usertype = Auth::user()->role;
                                   if($usertype == '2' ){
                                    
                                    $admin_id = Auth::id();
                                                  
                                    $get_teacher = DB::table('users')->where('admin_id', $admin_id)->get(); 
                                    $get_student = DB::table('students')->where('admin_id', $admin_id)->get();
                                    $get_student = DB::table('students')->where('admin_id', $admin_id)->get();
                                    $get_single_student = DB::table('students')->where('admin_id', $admin_id)->first();
                                    $school_id = $get_single_student?->school_id;
                                    $get_classes = DB::table('classes')->where('school_id', $school_id)->get();
                                    $get_division = DB::table('divisions')->where('school_id', $school_id)->get();
                                    
                                    
                                   @endphp

                                    <div class="col-xl-3 col-xxl-8">
                                        <div class="card card-full">
                                            <div class="card-inner border-bottom">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">Total Teacher</h6>
                                                        <p style="font-size: 18px; font-style:bold">{{ count($get_teacher) }}</p>
                                                    </div>
                                                    <div class="card-tools">
                                                        <a href="{{ route('teacher') }}" class="link">View All</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->


                                    <div class="col-xl-3 col-xxl-8">
                                        <div class="card card-full">
                                            <div class="card-inner border-bottom">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">Total Student</h6>
                                                        <p style="font-size: 18px; font-style:bold">{{ count($get_student) }}</p>
                                                    </div>
                                                    <div class="card-tools">
                                                        <a href="{{ route('student') }}" class="link">View All</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->

                                    <div class="col-xl-3 col-xxl-8">
                                        <div class="card card-full">
                                            <div class="card-inner border-bottom">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">Total Class </h6>
                                                        <p style="font-size: 18px; font-style:bold">{{ count($get_classes) }}</p>
                                                    </div>
                                                    <div class="card-tools">
                                                        <a href="{{ route('classes') }}" class="link">View All</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->

                                    <div class="col-xl-3 col-xxl-8">
                                        <div class="card card-full">
                                            <div class="card-inner border-bottom">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">Total Division</h6>
                                                        <p style="font-size: 18px; font-style:bold">{{ count($get_division) }}</p>
                                                    </div>
                                                    <div class="card-tools">
                                                        <a href="{{ route('sections') }}" class="link">View All</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->

                                    @php 
                                    } // end if (if user is school admin or admin id is 2)
                                    else if($usertype == '1' ){
                                    @endphp

                                    <div class="col-xl-3 col-xxl-8">
                                        <div class="card card-full">
                                            <div class="card-inner border-bottom">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">Total Organisation</h6>
                                                        <p style="font-size: 18px; font-style:bold">{{count($organisations) }}</p>
                                                    </div>
                                                    <div class="card-tools">
                                                        <a href="{{ route('admin') }}" class="link">View All</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->

                                    @php 
                                     }
                                    @endphp 
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
               
                 @include('admin.includes.footer')