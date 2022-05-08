<!--app header-->
<div class="app-header header">
	<div class="container-fluid">
		<div class="d-flex">
			<div class="col-3">
				<div class="app-sidebar__toggle float-left" data-toggle="sidebar">
					<a class="open-toggle" href="#">
						<i class="fa fa-solid fa-bars"></i>
					</a>
					<a class="close-toggle" href="#">
						<i>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
						</i>
					</a>
				</div>
			</div>
			<div class="col-6 text-center">
				<h4 class="mt-3 mb-0">Inicio</h4>
			</div>
			<div class="col-3">
				<div class="d-flex order-lg-2 my-auto ml-auto float-right">
					<div class="dropdown profile-dropdown">
						<a href="#" class="nav-link pr-1 pl-0 leading-none" data-bs-toggle="dropdown">
							<span>
								<img src="{{ asset('images/usuario.png') }}" alt="img" class="avatar avatar-md bradius">
							</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
							<div class="p-3 text-center border-bottom">
								<a href="#" class="text-center user pb-0 font-weight-bold">Yolanda Delgado Mascorro</a>
								<p class="text-center user-semi-title">Administrador</p>
							</div>
							<a class="dropdown-item d-flex" href="#">
								{{-- <i class="feather feather-user mr-3 fs-16 my-auto"></i> --}}
								<div class="mt-1">Perfil</div>
							</a>
							<a class="dropdown-item d-flex" href="#">
								{{-- <i class="feather feather-settings mr-3 fs-16 my-auto"></i> --}}
								<div class="mt-1">Configuración</div>
							</a>
							<a class="dropdown-item d-flex" href="#">
								{{-- <i class="feather feather-edit-2 mr-3 fs-16 my-auto"></i> --}}
								<div class="mt-1">Cambiar contraseña</div>
							</a>
							<a href="#" class="dropdown-item d-flex text-danger"
							   {{-- onclick="event.preventDefault(); document.getElementById('logout-form').submit();" --}}
							   >
								   <i class="feather feather-power mr-3 fs-16 my-auto"></i>
								   <div class="mt-1">Cerrar sesión</div>
							</a>
							{{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
								@csrf
							</form> --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/app header-->