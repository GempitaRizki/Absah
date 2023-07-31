<aside class="left-sidebar bg-sidebar">
	<div id="sidebar" class="sidebar sidebar-with-footer">
	  <!-- Aplication Brand -->
	  <div class="app-brand">
		<a href="/index.html" title="Sleek Dashboard">
		  <svg
			class="brand-icon"
			xmlns="http://www.w3.org/2000/svg"
			preserveAspectRatio="xMidYMid"
			width="30"
			height="33"
			viewBox="0 0 30 33">
			<g fill="none" fill-rule="evenodd">
			  <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
			  <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
			</g>
		  </svg>
		  <a href="{{ url('admin/dashboard') }}">
		  <span class="brand-name text-truncate">Larashop Dashboard</span>
		</a>
	  </div>

	  <!-- begin sidebar scrollbar -->
	  <div class="" data-simplebar style="height: 100%;">
		<!-- sidebar menu -->
		<ul class="nav sidebar-inner" id="sidebar-menu">
		  <li class="has-sub active expand">
			<a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#dashboard"
			  aria-expanded="false" aria-controls="dashboard">
			  <i class="mdi mdi-view-dashboard-outline"></i>
			  <span class="nav-text">Dashboard</span> <b class="caret"></b>
			</a>

			<ul class="collapse show" id="dashboard" data-parent="#sidebar-menu">
			  <div class="sub-menu">
				<li class="active">
				  <a class="sidenav-item-link" href="{{ url('admin/products')}}">
					<span class="nav-text">Products</span>
				  </a>
				</li>

				<li class="">
				  <a class="sidenav-item-link" href="{{ url('admin/categories')}}">
					<span class="nav-text">Categories</span>
				  </a>
				</li>
				<li class="">
					<a class="sidenav-item-link" href="{{ url('admin/attributes')}}">
					  <span class="nav-text">Attributes</span>
					</a>
				  </li>
			  </div>
			</ul>
		  </li>

		  <li class="has-sub ">
			<a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#charts"
			  aria-expanded="false" aria-controls="charts">
			  <i class="mdi mdi-chart-pie"></i>
			  <span class="nav-text">Charts</span> <b class="caret"></b>
			</a>

			<ul class="collapse " id="charts" data-parent="#sidebar-menu">
			  <div class="sub-menu">
				<li class="">
				  <a class="sidenav-item-link" href="chartjs.html">
					<span class="nav-text">ChartJS</span>
				  </a>
				</li>
			  </div>
			</ul>
		  </li>


		  <!-- <li class="section-title">
			Documentation
		  </li> -->
		</ul>
	  </div>

	  <div class="sidebar-footer">
		<hr class="separator mb-0" />
		<div class="sidebar-footer-content">
		  <h6 class="text-uppercase">
			Cpu Uses <span class="float-right">1000%</span>
		  </h6>

		  <div class="progress progress-xs">
			<div class="progress-bar active" style="width: 100%;" role="progressbar"></div>
		  </div>

		  <h6 class="text-uppercase">
			Memory Uses <span class="float-right">65%</span>
		  </h6>

		  <div class="progress progress-xs">
			<div class="progress-bar progress-bar-warning" style="width: 65%;" role="progressbar"></div>
		  </div>
		</div>
	  </div>
	</div>
  </aside>