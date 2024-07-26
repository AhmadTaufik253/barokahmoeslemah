<script src="{{asset('semicolon/js/jquery.js')}}"></script>
<script src="{{asset('semicolon/js/plugins.min.js')}}"></script>

<!-- Footer Scripts ============================================= -->
<script src="{{asset('semicolon/js/components/star-rating.js')}}"></script>
<script src="{{asset('semicolon/js/components/bs-filestyle.js')}}"></script>

<script src="{{asset('semicolon/js/functions.js')}}"></script>
<script src="{{asset('js/ongkir.js')}}"></script>
<script type="text/javascript">
let APP_URL = "{{config('app.url')}}";
localStorage.setItem("route_cart", "{{route('user.cart.list')}}");
$(document).on('click', '#top-cart', function(){
    load_cart(localStorage.getItem("route_cart"));
});
$(".image_picker").fileinput({
    mainClass: "input-group-md",
    showUpload: false,
    previewFileType: "image",
    browseClass: "btn btn-success",
    browseLabel: "Pick Image",
    browseIcon: "<i class=\"icon-picture\"></i> ",
    removeClass: "btn btn-danger",
    removeLabel: "Delete",
    removeIcon: "<i class=\"icon-trash\"></i> ",
    uploadClass: "btn btn-info upload_bukti_tf",
    uploadLabel: "Upload",
    uploadIcon: "<i class=\"icon-upload\"></i> "
});

$("#input-16").rating("refresh", {disabled: true, showClear: false});
</script>
<script src="{{asset('js/toastr.js')}}"></script>
<script src="{{asset('js/confirm.js')}}"></script>
<script src="{{asset('js/plugin.js')}}"></script>
<script src="{{asset('js/method.js')}}"></script>