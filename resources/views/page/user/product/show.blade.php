<x-user-layout title="{{$product->titles}}">
    <section id="page-title">
        <div class="container clearfix">
            <h1>{{$product->titles}}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('user.home')}}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('user.category.index')}}">Shop</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{$product->titles}}</li>
            </ol>
        </div>
    </section>
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">
                <div class="single-product">
                    <div class="product">
                        <div class="row gutter-40">
                            <div class="col-md-5">
                                <!-- Product Single - Gallery ============================================= -->
                                <div class="product-image">
                                    <div class="fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
                                        <div class="flexslider">
                                            <div class="slider-wrap" data-lightbox="gallery">
                                                <div class="slide" data-thumb="{{$product->image}}">
                                                    <a href="{{$product->image}}" title="{{$product->titles}}" data-lightbox="gallery-item">
                                                        <img src="{{$product->image}}" alt="{{$product->titles}}">
                                                    </a>
                                                    <!-- <center> -->
                                                    <!-- <input id="input-16" class="rating" value="{{$avg->avg}}" data-size="sm" data-disabled="true"> -->
                                                    <!-- </center> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($product->stock_s < 1 AND $product->stock_m < 1 AND $product->stock_l < 1 AND $product->stock_xl < 1 AND $product->stock_xxl < 1) <div class="sale-flash badge bg-secondary p-2">Out of Stock
                                </div>
                                @endif
                            </div>
                            <!-- Product Single - Gallery End -->
                        </div>
                        <div class="col-md-5 product-desc">
                            <div class="d-flex align-items-center justify-content-between">
                                <!-- Product Single - Price ============================================= -->
                                <div class="product-price">
                                    <ins id="default_price">
                                        @if($product->price_s == $product->price_xxl)
                                        Rp. {{number_format($product->price_s)}}
                                        @else
                                        Rp. {{number_format($product->price_s)}} - Rp. {{number_format($product->price_xxl)}}
                                        @endif
                                    </ins>
                                    <ins id="price_s" style="display:none;">Rp. {{number_format($product->price_s)}}</ins>
                                    <ins id="price_m" style="display:none;">Rp. {{number_format($product->price_m)}}</ins>
                                    <ins id="price_l" style="display:none;">Rp. {{number_format($product->price_l)}}</ins>
                                    <ins id="price_xl" style="display:none;">Rp. {{number_format($product->price_xl)}}</ins>
                                    <ins id="price_xxl" style="display:none;">Rp. {{number_format($product->price_xxl)}}</ins>
                                    <br>
                                </div>
                                <!-- Product Single - Price End -->
                            </div>
                            <div class="line"></div>
                            <!-- Product Single - Quantity & Cart Button ============================================= -->
                            <form id="form_cart">
                                <div class="cart mb-0 d-flex justify-content-between align-items-center">
                                    <div class="quantity clearfix">
                                        <input type="button" value="-" class="minus">
                                        <input type="number" step="1" min="1" name="quantity" value="1" title="Qty" class="qty" />
                                        <input type="button" value="+" class="plus">
                                    </div>
                                    @auth
                                    <button type="button" onclick="add_cart('#tombol_keranjang','#form_cart','{{route('user.cart.store')}}','Add to Cart','{{$product->id}}');" id="tambah_keranjang" class="add-to-cart button m-0">Add to cart</button>
                                    @endauth
                                    @guest
                                    <a href="{{route('user.auth.index')}}" class="add-to-cart button m-0">Add to cart</a>
                                    @endguest
                                </div>
                                <!-- Product Single - Quantity & Cart Button End -->
                                <div class="line"></div>
                                <div class="row align-items-center">
                                    <div class="col-sm-6">
                                        <h5 class="fw-medium mb-3">Select Size:</h5>
                                        <div role="group">
                                            <input class="btn-check" type="radio" name="size" id="size-s" autocomplete="off" value="s">
                                            <label for="size-s" class="btn btn-sm btn-outline-secondary fw-normal ls0 nott {{$product->stock_s < 1 ? 'disabled' : ''}}" {{$product->stock_s < 1 ? 'disabled' : ''}}>{{$product->stock_s < 1 ? 'S' : 'S'}}</label>

                                            <input class="btn-check" type="radio" name="size" id="size-m" autocomplete="off" value="m">
                                            <label for="size-m" class="btn btn-sm btn-outline-secondary fw-normal ls0 nott {{$product->stock_m < 1 ? 'disabled' : ''}}" {{$product->stock_m < 1 ? 'disabled' : ''}}>{{$product->stock_m < 1 ? 'M' : 'M'}}</label>

                                            <input class="btn-check" type="radio" name="size" id="size-l" autocomplete="off" value="l">
                                            <label for="size-l" class="btn btn-sm btn-outline-secondary fw-normal ls0 nott {{$product->stock_l < 1 ? 'disabled' : ''}}" {{$product->stock_l < 1 ? 'disabled' : ''}}>{{$product->stock_l < 1 ? 'L' : 'L'}}</label>

                                            <input class="btn-check" type="radio" name="size" id="size-xl" autocomplete="off" value="xl">
                                            <label for="size-xl" class="btn btn-sm btn-outline-secondary fw-normal ls0 nott {{$product->stock_xl < 1 ? 'disabled' : ''}}" {{$product->stock_xl < 1 ? 'disabled' : ''}}>{{$product->stock_xl < 1 ? 'XL' : 'XL'}}</label>

                                            <input class="btn-check" type="radio" name="size" id="size-xxl" autocomplete="off" value="xxl">
                                            <label for="size-xxl" class="btn btn-sm btn-outline-secondary fw-normal ls0 nott {{$product->stock_xxl < 1 ? 'disabled' : ''}}" {{$product->stock_xxl < 1 ? 'disabled' : ''}}>{{$product->stock_xxl < 1 ? 'XXL' : 'XXL'}}</label>
                                        </div>
                                    </div>
                                </div>
                                <ins id="stock_s" style="display:none; text-decoration:none; color:red;">Stock : {{number_format($product->stock_s)}}</ins>
                                <ins id="stock_m" style="display:none; text-decoration:none; color:red;">Stock : {{number_format($product->stock_m)}}</ins>
                                <ins id="stock_l" style="display:none; text-decoration:none; color:red;">Stock : {{number_format($product->stock_l)}}</ins>
                                <ins id="stock_xl" style="display:none; text-decoration:none; color:red;">Stock : {{number_format($product->stock_xl)}}</ins>
                                <ins id="stock_xxl" style="display:none; text-decoration:none; color:red;">Stock : {{number_format($product->stock_xxl)}}</ins>
                            </form>
                            <!-- Product Single - Short Description ============================================= -->
                            <!-- Product Single - Short Description End -->
                            <!-- Product Single - Meta ============================================= -->
                            <div class="card product-meta">
                                <div class="card-body">
                                    {{-- <span itemprop="productID" class="sku_wrapper">SKU: <span class="sku">8465415</span></span> --}}
                                    <span class="posted_in">Category: <a href="{{route('user.category.show',$product->category->slug)}}" rel="tag">{{$product->category->titles}}</a>.</span>
                                    {{-- <span class="tagged_as">Tags: <a href="#" rel="tag">Pink</a>, <a href="#" rel="tag">Short</a>, <a href="#" rel="tag">Dress</a>, <a href="#" rel="tag">Printed</a>.</span> --}}
                                </div>
                            </div>
                            <br>
                            <p>
                                Jika ingin menanyakan sesuatu pada produk atau ingin bertanya kepada pihak Barokah Moeslemah chat melalui about yang berada di atas.
                            </p>
                            <!-- Product Single - Meta End -->
                        </div>
                        <div class="col-md-2">
                            <a href="{{route('user.category.show',$product->category->slug)}}" title="Brand Logo" class="d-none d-md-block">
                                <img src="{{$product->category->image}}" alt="{{$product->category->titles}}">
                            </a>
                            <div class="divider divider-center"><i class="icon-circle-blank"></i></div>
                            <div class="feature-box fbox-plain fbox-dark fbox-sm">
                                <div class="fbox-icon">
                                    <i class="icon-thumbs-up2"></i>
                                </div>
                                <div class="fbox-content fbox-content-sm">
                                    <h3>100% Original</h3>
                                    <p class="mt-0">We guarantee you the sale of Original Brands.</p>
                                </div>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-12 mt-5">
                            <div class="tabs clearfix mb-0" id="tab-1">
                                <ul class="tab-nav clearfix">
                                    <li><a href="#tabs-1"><i class="icon-align-justify2"></i><span class="d-none d-md-inline-block"> Description</span></a></li>
                                    {{-- <li><a href="#tabs-2"><i class="icon-info-sign"></i><span class="d-none d-md-inline-block"> Additional Information</span></a></li> --}}
                                    <li><a href="#tabs-3"><i class="icon-star3"></i><span class="d-none d-md-inline-block"> Reviews ({{$product->review->count()}})</span></a></li>
                                </ul>
                                <div class="tab-container">
                                    <div class="tab-content clearfix" id="tabs-1">
                                        {!!$product->description!!}
                                    </div>
                                    <div class="tab-content clearfix" id="tabs-2">
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Size</td>
                                                    <td>Small, Medium &amp; Large</td>
                                                </tr>
                                                <tr>
                                                    <td>Color</td>
                                                    <td>Pink &amp; White</td>
                                                </tr>
                                                <tr>
                                                    <td>Waist</td>
                                                    <td>26 cm</td>
                                                </tr>
                                                <tr>
                                                    <td>Length</td>
                                                    <td>40 cm</td>
                                                </tr>
                                                <tr>
                                                    <td>Chest</td>
                                                    <td>33 inches</td>
                                                </tr>
                                                <tr>
                                                    <td>Fabric</td>
                                                    <td>Cotton, Silk &amp; Synthetic</td>
                                                </tr>
                                                <tr>
                                                    <td>Warranty</td>
                                                    <td>3 Months</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-content clearfix" id="tabs-3">
                                        <div id="reviews" class="clearfix">
                                            <ol class="commentlist clearfix">
                                                @foreach ($product->review as $item)
                                                <li class="comment even thread-even depth-1" id="li-comment-1">
                                                    <div class="comment-wrap clearfix">
                                                        <div class="comment-meta">
                                                            <div class="comment-author vcard">
                                                                <span class="comment-avatar clearfix">
                                                                    <img alt='Image' src='https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60' height='60' width='60' /></span>
                                                            </div>
                                                        </div>
                                                        <div class="comment-content clearfix">
                                                            <div class="comment-author">{{$item->user->name}}
                                                                <span>
                                                                    <a href="javascript:;" title="Permalink to this comment">
                                                                        {{$item->created_at->format('j F y')}}
                                                                    </a>
                                                                </span>
                                                            </div>
                                                            <p>
                                                                {{$item->review}}
                                                            </p>
                                                            <div class="review-comment-ratings">
                                                                @if ($item->rates == "1,00")
                                                                <i class="icon-star3"></i>
                                                                @elseif ($item->rates == "2,00")
                                                                <i class="icon-star3"></i>
                                                                <i class="icon-star3"></i>
                                                                @elseif ($item->rates == "3,00")
                                                                <i class="icon-star3"></i>
                                                                <i class="icon-star3"></i>
                                                                <i class="icon-star3"></i>
                                                                @elseif ($item->rates == "4,00")
                                                                <i class="icon-star3"></i>
                                                                <i class="icon-star3"></i>
                                                                <i class="icon-star3"></i>
                                                                <i class="icon-star3"></i>
                                                                @elseif ($item->rates == "5,00")
                                                                <i class="icon-star3"></i>
                                                                <i class="icon-star3"></i>
                                                                <i class="icon-star3"></i>
                                                                <i class="icon-star3"></i>
                                                                <i class="icon-star3"></i>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ol>
                                            <!-- Modal Reviews ============================================= -->
                                            <!-- /.modal -->
                                            <!-- Modal Reviews End -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="line"></div>
            @if ($collection->count()>0)
            <center>
                <h4>Mungkin anda suka</h4>
            </center>
            <div class="w-100">
                <div class="owl-carousel product-carousel carousel-widget" data-margin="30" data-pagi="false" data-autoplay="5000" data-items-xs="1" data-items-md="2" data-items-lg="3" data-items-xl="4">
                    @foreach ($collection as $item)
                    <div class="oc-item">
                        <div class="product">
                            <div class="product-image">
                                <a href="{{route('user.product.show',$item->slug)}}">
                                    <img src="{{$item->image}}" alt="{{$item->titles}}">
                                </a>
                                @if ($item->stock_s < 1 AND $item->stock_m < 1 AND $item->stock_l < 1 AND $item->stock_xl < 1 AND $item->stock_xxl < 1) <div class="sale-flash badge bg-secondary p-2">Out of Stock
                            </div>
                            @endif
                            <div class="bg-overlay">
                                <div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
                                    <a href="#" class="btn btn-dark me-2"><i class="icon-shopping-cart"></i></a>
                                    {{-- <a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a> --}}
                                </div>
                                <div class="bg-overlay-bg bg-transparent"></div>
                            </div>
                        </div>
                        <div class="product-desc center">
                            <div class="product-title">
                                <h3>
                                    <a href="{{route('user.product.show',$item->slug)}}">
                                        {{$item->titles}}
                                    </a>
                                </h3>
                            </div>
                            <div class="product-price">
                                <ins id="default_price">
                                    @if($item->price_s == $item->price_xxl)
                                    Rp. {{number_format($item->price_s)}}
                                    @else
                                    Rp. {{number_format($item->price_s)}} - Rp. {{number_format($item->price_xxl)}}
                                    @endif
                                </ins>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        </div>
        </div>
    </section>
    @section('custom_js')
    <script type="text/javascript">
        load_list(1);
        $("#size-s").click(function() {
            $("#default_price").hide();
            $("#price_s").show();
            $("#price_m").hide();
            $("#price_l").hide();
            $("#price_xl").hide();
            $("#price_xxl").hide();

            $("#stock_s").show();
            $("#stock_m").hide();
            $("#stock_l").hide();
            $("#stock_xl").hide();
            $("#stock_xxl").hide();
        });
        $("#size-m").click(function() {
            $("#default_price").hide();
            $("#price_m").show();
            $("#price_s").hide();
            $("#price_l").hide();
            $("#price_xl").hide();
            $("#price_xxl").hide();

            $("#stock_m").show();
            $("#stock_s").hide();
            $("#stock_l").hide();
            $("#stock_xl").hide();
            $("#stock_xxl").hide();
        });
        $("#size-l").click(function() {
            $("#default_price").hide();
            $("#price_l").show();
            $("#price_s").hide();
            $("#price_m").hide();
            $("#price_xl").hide();
            $("#price_xxl").hide();

            $("#stock_l").show();
            $("#stock_s").hide();
            $("#stock_m").hide();
            $("#stock_xl").hide();
            $("#stock_xxl").hide();
        });
        $("#size-xl").click(function() {
            $("#default_price").hide();
            $("#price_xl").show();
            $("#price_s").hide();
            $("#price_m").hide();
            $("#price_l").hide();
            $("#price_xxl").hide();

            $("#stock_xl").show();
            $("#stock_s").hide();
            $("#stock_m").hide();
            $("#stock_l").hide();
            $("#stock_xxl").hide();
        });
        $("#size-xxl").click(function() {
            $("#default_price").hide();
            $("#price_xxl").show();
            $("#price_s").hide();
            $("#price_m").hide();
            $("#price_l").hide();
            $("#price_xl").hide();

            $("#stock_xxl").show();
            $("#stock_s").hide();
            $("#stock_m").hide();
            $("#stock_l").hide();
            $("#stock_xl").hide();
        });
    </script>
    @endsection
</x-user-layout>
