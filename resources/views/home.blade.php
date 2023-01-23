<div class="links">
    <a href="{{ url('/post/blog')}}">get post from drive</a>
</div>
<h1>POSTS FROM DRIVE</h1>
@foreach($posts as $post)
    <div class="col-md-4">
        <div class="card" style="width: 50rem;">
            <div class="card-body">
                <h5 class="card-title"> {{$post->title}}</h5>
                <img src='{{$post->image}}' width='400px'/>
                <p class="card-text">{!!$post->body!!}</p>
            </div>
        </div>
    </div>
@endforeach