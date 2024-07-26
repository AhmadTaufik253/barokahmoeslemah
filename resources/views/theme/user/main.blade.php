<!DOCTYPE html>
<html dir="ltr" lang="en-US">
@include('theme.user.head')
<body class="stretched">
	<!-- Document Wrapper ============================================= -->
	<div id="wrapper" class="clearfix">
		<!-- Header ============================================= -->
		@include('theme.user.header')
        <!-- #header end -->
        @if (request()->is('home'))
		@include('theme.user.slider')
        @endif
		<!-- Content ============================================= -->
		{{$slot}}
        <!-- #content end -->
		<!-- Footer ============================================= -->
		@include('theme.user.footer')
        <!-- #footer end -->
	</div>
	<div class="modal fade" id="reviewFormModal" tabindex="-1" role="dialog" aria-labelledby="reviewFormModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" id="contentReviewModal">
				
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
    <!-- #wrapper end -->
	<!-- Go To Top ============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>
	<!-- JavaScripts ============================================= -->
	@include('theme.user.js')
	@yield('custom_js')
</body>
</html>