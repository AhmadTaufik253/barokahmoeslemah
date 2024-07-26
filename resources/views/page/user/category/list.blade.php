@foreach ($collection as $item)
<a href="{{route('user.category.show',$item->slug)}}" class="entry-image mb-0" style="background: url('{{$item->image}}') no-repeat center center / cover; height:600px;" data-center="background-position: 50% 0px;" data-top-bottom="background-position:50% 200px;">
</a>
@endforeach