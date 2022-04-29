<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="Medicamento Natural Yolanda" name="author">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Title -->
		<title>Medicamento Natural Yolanda</title>

		<!-- Bootstrap-->
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<!-- Style css -->
		<link href="{{ asset('css/style.css') }}" rel="stylesheet" />
		<!--Sidemenu css -->
        <link  href="{{ asset('css/sidemenu.css') }}" rel="stylesheet">
		<!-- P-scroll bar css: Desplazamiento en panel de navegación-->
		<link href="{{ asset('plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />
		<!-- Fuente Poppins -->
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
		<!-- Select2 css -->
		<link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" />

        @yield('extra-css')
	</head>

	<body class="app sidebar-mini" id="index1">
		<div class="page">
			<div class="page-main">

                <!--aside-->
				<x-sidemenu />
				<!--/aside-->

				<div class="app-content main-content">
					<div class="side-app">

                    <!--app header-->
                    <x-navbar />
                    <!--/app header-->
						<!--Content-->
						@yield('content')
						<!--/Content-->
					</div>
				</div>
			</div>
		</div>

		<!-- JQuery-->
		<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
		<!--Ocultar/Mostrar panel de navegación-->
		<script src="{{ asset('plugins/sidemenu/sidemenu.js') }}"></script>
		<!-- P-scroll js: Desplazamiento en panel de navegación-->
		<script src="{{ asset('plugins/p-scrollbar/p-scrollbar.js') }}"></script>
		<script src="{{ asset('plugins/p-scrollbar/p-scroll1.js') }}"></script>
		<!-- Custom js-->
		<script src="{{ asset('js/custom.js') }}"></script>
		<!-- Select2 js -->
		<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>

		@yield('extra-script')
	</body>
</html>
