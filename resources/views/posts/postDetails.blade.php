@extends('layouts.blogLayout')


@section('content')

<div class="container ">
    <div class="row">
        <div class="col-lg-9 col-lg-offset-0 col-md-10 col-sm-10">

            @if(!empty($post))
               
                    <div class="post-preview">
                        <a href="#">
                            <h2 class="post-title">
                               {{$post->title}}
                            </h2>
                        </a>
                            <h3 class="post-subtitle">
                                {{$post->body}}
                            </h3>
                       
                        @if($contents = $post->contents)
                            @foreach($contents as $content)
                                
                                <a href="#" class=""><img class="img-responsive" src="{{asset('files/'.$content->id)}}">{{$content->content}}</a>
                               
                                <br>
                            @endforeach
                        @endif
                        <p class="post-meta">Posted by <a href="#">{{$post->user->name}}</a>on {{$post->created_at}}</p>
                    </div>
                    <hr>
               
            @endif

            
            <!-- Pager -->
            <ul class="pager">
                <li class="next">
                    <a href="#">Older Posts &rarr;</a>
                </li>
            </ul>   
        </div>
        <div class="col-lg-3 col-md-2 col-sm-2">
        <h2>Categories</h2>
            <ul>
                @if(!empty($categories))
                    @foreach($categories as $category)
                      <li> <a href="{{route('viewCategory',['cid' =>$category->id])}}">{{$category->title}}</a> </li>
                    @endforeach
                       
                 @endif
                
            </ul>
        </div>
    </div>
</div>
@endsection
