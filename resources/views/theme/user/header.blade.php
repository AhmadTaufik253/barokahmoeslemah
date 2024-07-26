<header id="header" class="full-header transparent-header" data-sticky-class="not-dark">
    <div id="header-wrap">
        <div class="container">
            <div class="header-row">
                <!-- Logo ============================================= -->
                <div id="logo">
                    <a href="{{route('user.home')}}" class="standard-logo" data-dark-logo="{{asset('img/logo.jpg')}}">
                        <img src="{{asset('img/logo.jpg')}}" alt="{{config('app.name')}}">
                    </a>
                    <a href="{{route('user.home')}}" class="retina-logo" data-dark-logo="{{asset('img/logo.jpg')}}">
                        <img src="{{asset('img/logo.jpg')}}" alt="{{config('app.name')}}">
                    </a>
                </div>
                <!-- #logo end -->
                <div class="header-misc">
                    <!-- Top Search ============================================= -->
                    <!-- #top-search end -->
                    <!-- Top Cart ============================================= -->
                    @auth
                    <div id="top-cart" class="header-misc-icon d-block d-sm-block">
                        <a href="#" id="top-cart-trigger">
                            <i class="icon-line-bag"></i>
                            <span class="top-cart-number"></span>
                        </a>
                        <div id="my_cart" class="top-cart-content">
                            <div class="top-cart-title">
                                <h4>Shopping Cart</h4>
                            </div>
                            <div class="top-cart-items">

                            </div>
                            <div class="top-cart-action">
                                <span class="top-checkout-price"></span>
                                <a href="{{route('user.cart.index')}}" class="button button-3d button-small m-0">Checkout</a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown mx-3 me-lg-0">
                        <a href="javascript:;" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="icon-user"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item text-start" href="{{route('user.auth.profile')}}">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-start" href="{{route('user.auth.logout')}}">Logout <i class="icon-signout"></i></a>
                        </ul>
                    </div>
                    @endauth
                    @guest
                    <a href="{{route('user.auth.index')}}" class="button button-mini button-border button-rounded">
                        <span>
                            Login
                        </span>
                    </a>
                    @endguest
                    <!-- #top-cart end -->
                </div>
                <div id="primary-menu-trigger">
                    <svg class="svg-trigger" viewBox="0 0 100 100">
                        <path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path>
                        <path d="m 30,50 h 40"></path>
                        <path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path>
                    </svg>
                </div>
                <!-- Primary Navigation ============================================= -->
                <nav class="primary-menu">
                    <ul class="menu-container">
                        <li class="menu-item">
                            <a class="menu-link" href="{{route('user.home')}}">
                                <div>Home</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="javascript:;">
                                <div>Shop</div>
                            </a>
                            <ul class="sub-menu-container">
                                @php
                                $db = \App\Models\Category::get();
                                @endphp
                                @foreach ($db as $item)
                                <li class="menu-item">
                                    <a class="menu-link" href="{{route('user.category.show',$item->slug)}}">
                                        <div>{{$item->titles}}</div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        <li class="menu-item">
                            <a class="menu-link" href="{{route('user.about')}}">
                                <div>About</div>
                            </a>
                        </li>
                        </li>
                    </ul>
                </nav>
                <!-- #primary-menu end -->
                <form class="top-search-form" action="search.html" method="get">
                    <input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
                </form>
            </div>
        </div>
    </div>
    <div class="header-wrap-clone"></div>
</header>