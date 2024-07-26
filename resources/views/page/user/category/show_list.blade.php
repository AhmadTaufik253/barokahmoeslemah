<div id="shop" class="shop row grid-container leftmargin-sm" data-layout="fitRows">
    @foreach ($collection as $item)
    <div class="product col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="grid-inner">
            <div class="product-image">
                <a href="{{route('user.product.show',$item->slug)}}">
                    <img src="{{$item->image}}" alt="{{$item->titles}}">
                </a>
                @if ($item->stock_s < 1 AND $item->stock_m < 1 AND $item->stock_l < 1 AND $item->stock_xl < 1 AND $item->stock_xxl < 1) <div class="sale-flash badge bg-secondary p-2">Out of Stock
            </div>
            @endif
        </div>
        <div class="product-desc">
            <div class="product-title">
                <h3>
                    <center>
                        <a href="{{route('user.product.show',$item->slug)}}">
                            {{$item->titles}}
                        </a>
                    </center>
                </h3>
            </div>
            <center>
                <div class="product-price">
                    <ins>
                        @if($item->price_s == $item->price_xxl)
                        Rp. {{number_format($item->price_s)}}
                        @else
                        Rp. {{number_format($item->price_s)}} - Rp. {{number_format($item->price_xxl)}}
                        @endif
                    </ins>
                </div>
            </center>
        </div>
    </div>
</div>
@endforeach
</div>