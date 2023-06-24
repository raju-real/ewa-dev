<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{ siteSetting()['title'] ?? '' }}</title>
	<link rel="stylesheet" href="{{ asset('assets/backend/vendors/core/core.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/backend/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/backend/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/backend/css/demo_5/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/backend/images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/select2/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/backend/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/backend/vendors/dropzone/dropzone.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/backend/vendors/dropify/dist/dropify.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/backend/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/backend/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/backend/vendors/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/backend/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}">

    <!-- Datatable -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/select2/select2.min.css') }}">
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <!-- include summernote css/js -->
{{--    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>--}}
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/simplemde/simplemde.min.css') }}">

    @stack('css')
</head>
<body>
<div id="fb-root"></div>
<div id="fb-root"></div>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v17.0&appId=385864235969257&autoLogAppEvents=1" nonce="XcydTEgS"></script>		<div class="horizontal-menu">
			<nav class="navbar top-navbar">
				<div class="container">
					<div class="navbar-content">
						<a href="{{ route('home') }}" target="_blank" class="navbar-brand">
							{{ siteSetting()['site_title'] }}
						</a>

						<ul class="navbar-nav">
							<li class="nav-item dropdown nav-notifications">
								<a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i data-feather="bell"></i>
									<div class="indicator">
										<div class="circle"></div>
									</div>
								</a>
								<div class="dropdown-menu" aria-labelledby="notificationDropdown">
									<div class="dropdown-header d-flex align-items-center justify-content-between">
										<p class="mb-0 font-weight-medium">6 New Notifications</p>
										<a href="javascript:;" class="text-muted">Clear all</a>
									</div>
									<div class="dropdown-body">
										<a href="javascript:;" class="dropdown-item">
											<div class="icon">
												<i data-feather="user-plus"></i>
											</div>
											<div class="content">
												<p>New customer registered</p>
												<p class="sub-text text-muted">2 sec ago</p>
											</div>
										</a>
										<a href="javascript:;" class="dropdown-item">
											<div class="icon">
												<i data-feather="gift"></i>
											</div>
											<div class="content">
												<p>New Order Recieved</p>
												<p class="sub-text text-muted">30 min ago</p>
											</div>
										</a>
										<a href="javascript:;" class="dropdown-item">
											<div class="icon">
												<i data-feather="alert-circle"></i>
											</div>
											<div class="content">
												<p>Server Limit Reached!</p>
												<p class="sub-text text-muted">1 hrs ago</p>
											</div>
										</a>
										<a href="javascript:;" class="dropdown-item">
											<div class="icon">
												<i data-feather="layers"></i>
											</div>
											<div class="content">
												<p>Apps are ready for update</p>
												<p class="sub-text text-muted">5 hrs ago</p>
											</div>
										</a>
										<a href="javascript:;" class="dropdown-item">
											<div class="icon">
												<i data-feather="download"></i>
											</div>
											<div class="content">
												<p>Download completed</p>
												<p class="sub-text text-muted">6 hrs ago</p>
											</div>
										</a>
									</div>
									<div class="dropdown-footer d-flex align-items-center justify-content-center">
										<a href="javascript:;">View all</a>
									</div>
								</div>
							</li>
							<li class="nav-item dropdown nav-profile">
								<a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<img src="{{ asset(Auth::user()->image ?? 'assets/images/avatar.jpg') }}" alt="profile">
								</a>
								<div class="dropdown-menu" aria-labelledby="profileDropdown">
									<div class="dropdown-header d-flex flex-column align-items-center">
										<div class="figure mb-3">
											<img src="{{ asset(Auth::user()->image ?? 'assets/images/avatar.jpg') }}" alt="">
										</div>
										<div class="info text-center">
											<p class="name font-weight-bold mb-0">{{ Auth::user()->name ?? "User" }}</p>
											<p class="email text-muted mb-3">{{ Auth::user()->email ?? "Email" }}</p>
										</div>
									</div>
									<div class="dropdown-body">
										<ul class="profile-nav p-0 pt-3">
											<li class="nav-item">
												<a href="{{ route('profile') }}" class="nav-link">
													<i data-feather="user"></i>
													<span>Profile</span>
												</a>
											</li>
											<li class="nav-item">
												<a href="{{ route('logout') }}" class="nav-link">
													<i data-feather="log-out"></i>
													<span>Log Out</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</li>
						</ul>
						<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
							<i data-feather="menu"></i>
						</button>
					</div>
				</div>
			</nav>
            @if(Auth::user()->menu_permission == "yes")
                <nav class="bottom-navbar">
                    <div class="container">
                        <ul class="nav page-navigation">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">
                                    <i class="link-icon" data-feather="box"></i>
                                    <span class="menu-title">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('member-requests') }}">
                                    <i class="link-icon" data-feather="user-plus"></i>
                                    <span class="menu-title">Member Request <i class="badge badge-danger rounded">{{ App\Models\User::where('approve_status',"no")->count() ?? 0 }}</i> </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('members.index') }}">
                                    <i class="link-icon" data-feather="users"></i>
                                    <span class="menu-title">Members <i class="badge badge-info rounded">{{ App\Models\User::where('approve_status','yes')->count() ?? 0 }}</i> </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="link-icon" data-feather="setting"></i>
                                    <span class="menu-title">Settings</span>
                                    <i class="link-arrow"></i>
                                </a>
                                <div class="submenu">
                                    <ul class="submenu-item">
                                        <li class="nav-item"><a class="nav-link" href="{{ route('website-settings') }}">Website Setting</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ route('engineer-types.index') }}">Engineer Types</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ route('designations.index') }}">Designation</a></li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                </nav>
            @endif
		</div>

		<div class="page-wrapper">

			<div class="page-content">
                @yield('content')
			</div>

			<footer class="footer align-items-center justify-content-between">
				<p class="text-muted text-center text-center">Copyright © {{ date('Y',strtotime(\Carbon\Carbon::now())) }} <a href="{{ route('home') }}" target="_blank">EWA</a>. All rights reserved</p>
			</footer>
			<!-- partial -->

		</div>
	</div>

    <script src="{{ asset('assets/backend/vendors/core/core.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/progressbar.js/progressbar.min.js') }}"></script>
	<script src="{{ asset('assets/backend/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('assets/backend/js/template.js') }}"></script>
    <script src="{{ asset('assets/backend/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datepicker.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/backend/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/backend/js/validation.js') }}"></script>
    <script src="{{ asset('assets/backend/js/common.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/inputmask.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/select2.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script src="{{ asset('assets/backend/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/simplemde/simplemde.min.js') }}"></script>
    @stack('js')
</body>
</html>
