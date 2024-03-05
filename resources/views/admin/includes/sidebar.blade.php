<div class="nk-sidebar is-light nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">

                {{-- <span style="font-size:14px;"><b>SHRI GURUDATTA FINACIAL SERVICES</b></span> --}}
                @php 
                $usertype = Auth::user()->role;
                if($usertype == '1'){
                @endphp
                <img height="50" width="50" src="https://image.similarpng.com/very-thumbnail/2021/08/Web-Icon-Summary-and-Sample-Logo-on-transparent-background-PNG.png">

                @php 

                } else if($usertype == '2') {
                    
                    $admin_id = Auth::id();
                    $get_org = DB::table('organisations')->where('admin_id', $admin_id)->first(); 
                    //echo $admin_id;
                @endphp
                
                <img height="50" width="50" src="{{asset('images/school/'.$get_org->org_photo)}}">
                                
                @php 

                }

                @endphp

                 {{-- <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                <img class="logo-dark logo-img" src="https://dashboard.earningfish.com/assets/dist/img/IMG-20230626-WA0001.jpg" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                <img class="logo-small logo-img logo-img-small" src="./images/logo-small.png" srcset="./images/logo-small2x.png 2x" alt="logo-small">  --}}
            
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                  
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Dashboards</h6>
                    </li><!-- .nk-menu-item -->

                    <li class="nk-menu-item">
                        <a href="{{route('dashboard')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-presentation"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li><!-- .nk-menu-item -->

                    @if(Auth::user()->role === 1)

                    <li class="nk-menu-item">
                        <a href="{{route('admin')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-account-setting"></em></span>
                            <span class="nk-menu-text">School's Data</span>
                        </a>
                    </li><!-- .nk-menu-item -->

                    @endif

                    <li class="nk-menu-item">
                        <a href="{{route('teacher')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                            <span class="nk-menu-text">Teacher's</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                   
                    @if(Auth::user()->role == '2')
                    
                    <li class="nk-menu-item has-sub">

                        <a class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-apple-store"></em></span>
                            <span class="nk-menu-text">Academics </span>
                        </a>

                        <ul class="nk-menu-sub">
                            
                            <li class="nk-menu-item">
                                <a href="{{ route('sections') }}" class="nk-menu-link"><span class="nk-menu-text">Division / Section</span></a>
                            </li>

                            <li class="nk-menu-item">
                                <a href="{{ route('classes') }}" class="nk-menu-link"><span class="nk-menu-text">Class</span></a>
                            </li>

                            <li class="nk-menu-item">
                                <a href="{{ route('student') }}" class="nk-menu-link"><span class="nk-menu-text">Student Admission</span></a>
                            </li>
                            
                            <li class="nk-menu-item">
                                <a href="{{ route('assign') }}" class="nk-menu-link"><span class="nk-menu-text">Assign Teacher</span></a>
                            </li>
                          
                          
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->

                    @endif

                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>