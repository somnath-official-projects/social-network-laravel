<nav class="header-nav bg-danger text-light">
	<div class="container-fluid d-flex justify-content-between align-items-center">
		<a class="navbar-brand text-light" href="{{ url('/') }}">
			{{ config('app.name', 'Laravel') }}
		</a>
		<div>
			<i class="bi bi-search search-icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"></i>
			<i style="font-size: 25px; cursor: pointer;" class="bi bi-filter-right" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"></i>

			<div class="offcanvas text-dark offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
				<div class="offcanvas-header">
					<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				</div>
				<div class="offcanvas-body">
					<div class="user-image-container">
						<img src="{{asset('images/no-image.png')}}" class="img-fluid" style="border-radius: 50%;">
					</div>
					<div class="user-name-contaier my-3">
						<h5 class="text-center"><span>{{ Auth::user()->name }}</span></h5>
					</div>
					<div class="divider"></div>
					<div class="mt-3">
						<div class="item">
							<a class="dropdown-item" href="{{ url('user/account') }}"><i class="bi bi-person-circle"></i> Account</a>
						</div>
						<!-- <div class="item">
							<a class="dropdown-item" href="{{ url('user/friend-list') }}"><i class="bi bi-people-fill"></i> Freinds</a>
						</div> -->
						<div class="item">
							<a class="dropdown-item" href="{{ route('logout') }}"
								onclick="event.preventDefault();
													document.getElementById('logout-form').submit();">
								<i class="bi bi-box-arrow-right"></i>  {{ __('Logout') }}
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel" style="width: 100% !important;">
				<!-- <div class="offcanvas-header">
					<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				</div> -->
				<div class="offcanvas-body">
					<div class="container mt-4">
						<div class="row">
							<div class="col-md-1"></div>
							<div class="col-md-8"><input placeholder="Search user by name or email" class="form-control" type="text" id="search-input-box"></div>
							<div class="col-md-2 d-flex"><button class="btn btn-info btn-sm w-100" id="search">Search</button></div>
							<div class="col-md-1"></div>
						</div>
						<div class="row">
							<div class="col-12" id="search-result">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</nav>