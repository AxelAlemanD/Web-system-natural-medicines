<!--aside open-->
<aside class="app-sidebar">
	<div class="app-sidebar__logo">
		{{-- <a class="header-brand" href="/">
			<img src="{{ asset('images/logo_2.png') }}" class="header-brand-img dark-logo" alt="Medicamento Natural Yolanda">
            <img src="{{ asset('images/logo.png') }}" class="header-brand-img mobile-logo" alt="Medicamento Natural Yolanda">
		</a> --}}
	</div>
	<div class="app-sidebar3">

		<div class="app-sidebar__user">
			<div class="dropdown user-pro-body text-center">
				<div class="user-pic">
                    <img src="{{ asset('images/usuario.png') }}" alt="img" class="avatar-xxl rounded-circle mb-1">
				</div>
				<div class="user-info">
					<h5 class=" mb-2">
                        Yolanda Delgado Mascorro
                    </h5>
					<span class="text-muted app-sidebar__user-name text-sm">Administrador</span>
				</div>
			</div>
		</div>

		<ul class="side-menu">
		
			{{-- Dashboard --}}
			<li class="slide">
				<a class="side-menu__item {{ Request::is('/') ? 'active' : '' }}" data-toggle="slide" href="{{route('/')}}" id="dashboard">
					<i class="sidemenu_icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
					</i>
					<span class="side-menu__label">Inicio</span><i class="angle fa fa-angle-right"></i>
				</a>
			</li>

			{{-- Productos --}}
			<li class="slide">
				<a class="side-menu__item {{ Request::is('productos') ? 'active' : '' }}" data-toggle="slide" href="{{route('productos.index')}}" id="products">
					<i class="sidemenu_icon">
						<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 width="20" height="20" viewBox="0 0 79.542 79.542" style="enable-background:new 0 0 79.542 79.542;"
							 xml:space="preserve">
							<g>
								<path style="fill:#010002;" d="M73.754,5.8C69.891,1.937,64.827,0,59.762,0c-5.063,0-10.128,1.937-13.98,5.8L25.787,25.792l0,0
									L5.796,45.78c-7.726,7.715-7.726,20.246,0.005,27.972c7.716,7.721,20.247,7.721,27.967,0L49.5,58.026l24.249-24.25
									C81.469,26.046,81.469,13.515,73.754,5.8z M69.493,29.513L49.5,49.503L30.041,30.043l19.992-19.99
									c2.595-2.597,6.054-4.036,9.72-4.036c3.677,0,7.136,1.439,9.734,4.036C74.857,15.415,74.857,24.153,69.493,29.513z"/>
							</g>
						</svg>
					</i>
					<span class="side-menu__label">Productos</span><i class="angle fa fa-angle-right"></i>
				</a>
			</li>

			{{-- Clientes --}}
			<li class="slide">
				<a class="side-menu__item {{ Request::is('clientes') ? 'active' : '' }}" data-toggle="slide" href="{{route('clientes.index')}}" id="customers">
					<i class="sidemenu_icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
					</i>
					<span class="side-menu__label">Clientes</span><i class="angle fa fa-angle-right"></i>
				</a>
			</li>

			{{-- Ventas --}}
			<li class="slide">
				<a class="side-menu__item {{ Request::is('ventas') ? 'active' : '' }}" data-toggle="slide" href="{{route('ventas.index')}}" id="sales">
					<i class="sidemenu_icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
						</svg>
					</i>
					<span class="side-menu__label">Ventas</span><i class="angle fa fa-angle-right"></i>
				</a>
			</li>			
		
		</ul>
	</div>
</aside>
<!--aside closed-->