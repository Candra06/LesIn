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
						2021, made with <i class="fa fa-heart heart text-danger"></i> by <a href="{{url('/dashboard')}}">BelajardiRumah Tim</a>
					</div>
				</div>
			</footer>
		</div>
	</div>
	@include('template.script')
</body>
</html>
