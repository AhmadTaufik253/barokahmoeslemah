<x-user-layout title="Category">
    <section id="page-title">

        <div class="container clearfix">
            <h1>Shop Categories</h1>
            <span>Showcase of Our Shop Categories in Parallax Mode</span>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('user.home')}}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('user.category.index')}}">Shop</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
            </ol>
        </div>

    </section>
    <section id="content">
        <div class="content-wrap">
            <div id="shop-categories" class="header-stick footer-stick clearfix">
                <div id="content_list">
                    <div id="list_result"></div>
                </div>
            </div>
        </div>
    </section>
    @section('custom_js')
    <script type="text/javascript">
        load_list(1);
    </script>
    @endsection
</x-user-layout>