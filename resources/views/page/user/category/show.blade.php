<x-user-layout title="Category {{$category->titles}}">
    <section id="page-title">
        <div class="container clearfix">
            <h1>Products of {{$category->titles}}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('user.home')}}">Home</a></li>
                <li class="breadcrumb-item">
                    <a href="{{route('user.category.index')}}">Shop</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('user.category.show',$category->slug)}}">Categories</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{$category->titles}}</li>
            </ol>
        </div>
    </section>
    <section id="content">
        <div class="content-wrap">
            <div id="content_list">
                <div id="list_result"></div>
            </div>
        </div>
    </section>
    @section('custom_js')
        <script type="text/javascript">
            load_list(1);
        </script>
    @endsection
</x-user-layout>