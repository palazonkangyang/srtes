@if(!empty(Auth::User()->idsrc_login))

	{{-- if this module is Training Evaluation System --}}
	@if (\Request::is('tes') || \Request::is('tes/*'))
	<div class="navbar navbar-inverse set-radius-zero">
			<div class="container">
					<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
							</button>
							<a class="logo-class" href="/tes/dashboard"><img src="{{ URL::asset('images/red_cross.png') }}" /> Training Evaluation System</a>

					</div>
			</div>
	</div>
	<!-- LOGO HEADER END-->
	<section class="menu-section">
			<div class="container">
					<div class="row">
							<div class="col-md-12">
									<div class="navbar-collapse collapse ">
											<ul id="menu-top" class="nav navbar-nav navbar-left">
													<li class="ooo-header" style="@if(Auth::User()->inoffice == 0) display: none; @endif"><a class="ooo-header-class" href="/account/account-settings"> <strong>Status:</strong> Out of Office</a></li>
											</ul>

											<ul id="menu-top" class="nav navbar-nav navbar-right">
													<li><a class="{{ Html::activeState('/tes/dashboard') }}" href="/tes/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
													<li><a class="{{ Html::activeState('/tes/course') }}" href="/tes/course"><i class="fa fa-graduation-cap"></i> Course</a></li>
													<li><a class="{{ Html::activeState('/tes/form-management') }}" href="/tes/form-management"><i class="fa fa-file-text-o"></i> Form Management</a></li>
													<li><a class="{{ Html::activeState('/tes/reports') }}" href="/tes/reports"><i class="fa fa-table"></i> Reports</a></li>
													<li><a class="{{ Html::activeState('/tes/settings') }}" href="/tes/settings"><i class="fa fa-cogs"></i> Settings</a></li>

											</ul>
									</div>
							</div>

					</div>
			</div>
	</section>
	<header>
			<div class="container">
					<div class="row">
							<div class="col-md-12">
									<strong>Welcome </strong> </h3>
									<div class="user-top-right btn-group">
										<a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											{{Auth::User()->loginname}} <span class="caret"></span>
										</a>
										<ul class="dropdown-menu dropdown-menu-right">
											<li class="last"><a href="/account/myprofile">My Profile</a></li>
											<li class="last"><a href="/controller/account/logout">Logout</a></li>
										</ul>
									</div>
							</div>

					</div>
			</div>
	</header>


	@else

	    <div class="navbar navbar-inverse set-radius-zero">
	        <div class="container">
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>
	                <a class="logo-class" href="/dashboard"><img src="{{ URL::asset('images/red_cross.png') }}" /> Approval Management System</a>

	            </div>
	        </div>
	    </div>
	    <!-- LOGO HEADER END-->
	    <section class="menu-section">
	        <div class="container">
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="navbar-collapse collapse ">
	                        <ul id="menu-top" class="nav navbar-nav navbar-left">
	                            <li class="ooo-header" style="@if(Auth::User()->inoffice == 0) display: none; @endif"><a class="ooo-header-class" href="/account/account-settings"> <strong>Status:</strong> Out of Office</a></li>
	                        </ul>

	                        <ul id="menu-top" class="nav navbar-nav navbar-right">
	                            <li><a class="{{ Html::activeState('/dashboard') }}" href="/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>

	                            <li><a class="{{ Html::activeState('/application/new/process') }}" href="/application/new/process"><i class="fa fa-edit"></i> New Application</a></li>

	                            <li><a class="{{ Html::activeState('/application/new') }} hide" href="/application/new"><i class="fa fa-edit"></i> New Application</a></li>
	                            <li><a class="{{ Html::activeState('/application/pending') }}" href="/application/pending"><i class="fa fa-list-ol"></i> Pending Task</a></li>
	                            <li><a class="{{ Html::activeState('/application/myapp') }}" href="/application/myapp"><i class="fa fa-th-list"></i> My Applications</a></li>
	                            @if(Auth::User()->roleid == -1 || Auth::User()->roleid == 1 || Auth::User()->roleid == 2 || Auth::User()->deptid == 9 || Auth::User()->deptid == 12|| Auth::User()->deptid == 13 )
	                                <li><a class="{{ Html::activeState('/application/reportmenu') }}" href="/application/reportmenu"><i class="fa fa-table"></i> Reports</a></li>
	                            @endif
	                            <li><a class="{{ Html::activeState('/history') }}" href="/history"><i class="fa fa-history"></i> History</a></li>
	                            <li><a class="{{ Html::activeState('/settings') }}" href="/settings"><i class="fa fa-cogs"></i> Settings</a></li>
	                        </ul>
	                    </div>
	                </div>

	            </div>
	        </div>
	    </section>
	    <header>
	        <div class="container">
	            <div class="row">
	                <div class="col-md-12">
	                    <strong>Welcome </strong> </h3>
	                    <div class="user-top-right btn-group">
	                      <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                        {{Auth::User()->loginname}} <span class="caret"></span>
	                      </a>
	                      <ul class="dropdown-menu dropdown-menu-right">
	                        <li class="last"><a href="/account/myprofile">My Profile</a></li>
	                        <li class="last"><a href="/controller/account/logout">Logout</a></li>
	                      </ul>
	                    </div>
	                </div>

	            </div>
	        </div>
	    </header>

	@endif

    <!-- MENU SECTION END-->
      <div class="content-wrapper">
        <div class="container">

@endif
