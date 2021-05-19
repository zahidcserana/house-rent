<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>

        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700","Asap+Condensed:500"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
        <!--begin::Base Styles -->
        <!--begin::Page Vendors -->
        <link rel="stylesheet" href="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/base/vendors.bundle.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/demo/demo8/base/style.bundle.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link rel="shortcut icon" href="{{ asset('assets/demo/demo8/media/img/logo/favicon.ico') }}">
    </head>
	<body style="background-image: url(/assets/app/media/img/bg/bg-7.jpg)" class="m-page--fluid m-page--loading-enabled m-page--loading m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default">

        <!-- begin::Page loader -->
		<div class="m-page-loader m-page-loader--base">
			<div class="m-blockui">
				<span>
					Please wait...
				</span>
				<span>
					<div class="m-loader m-loader--brand"></div>
				</span>
			</div>
		</div>
        <!-- end::Page Loader -->
        @inertia

        <script src="{{ asset('assets/vendors/base/vendors.bundle.js') }}"></script>
        <script src="{{ asset('assets/demo/demo8/base/scripts.bundle.js') }}"></script>
        <script src="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
        <script src="{{ asset('assets/app/js/dashboard.js') }}"></script>
        <script src="{{ asset('assets/app/js/datatables/base/html-table.js') }}"></script>

		<script>
            $(window).on('load', function() {
                $('body').removeClass('m-page--loading');
            });
		</script>
    </body>
</html>
