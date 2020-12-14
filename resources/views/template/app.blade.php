@include('template.head')
<body>
	<div class="wrapper">
		@include('template.navbar')

		<!-- Sidebar -->
		@include('template.sidebar')
		<!-- End Sidebar -->

		<div class="main-panel">

            @yield('content')

			<footer class="footer">
				<div class="container-fluid">

					<div class="copyright ml-auto">
						2020, made with <i class="fa fa-heart heart text-danger"></i> by <a href="{{url('/dashboard')}}">Les.in Tim</a>
					</div>
				</div>
			</footer>
		</div>
	</div>
	@include('template.script')
</body>
</html>
