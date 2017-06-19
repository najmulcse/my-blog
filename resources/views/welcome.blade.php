@extends('layouts.app')

@section('content')
<!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Learn Laravel ! </h1>
                        <hr class="small">
                        <span class="subheading">Web programming | Find a Problem | Make the Solutions</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container" >
        <div class="row">
            <div class="col-lg-9 col-lg-offset-0 col-md-10 col-sm-10">

                @if(!empty($posts))
                    @foreach($posts as $post)
                        <div class="post-preview">
                            <a href="#">
                                <h2 class="post-title">
                                   {{$post->title}}
                                </h2>
                                <h3 class="post-subtitle">
                                    {{$post->body}}
                                </h3>
                            </a>
                            @if($contents=$post->contents)
                                @foreach($contents as $content)
                                    <a href="#" class="">{{$content->content}}</a>
                                    <br>
                                @endforeach
                            @endif
                            <p class="post-meta">Posted by <a href="#">{{$post->user->where('id',$post->user_id)->first()->name}}</a> on September 24, 2014</p>
                        </div>
                        <hr>
                    @endforeach
                @endif

                
                <!-- Pager -->
                <ul class="pager">
                    <li class="next">
                        <a href="#">Older Posts &rarr;</a>
                    </li>
                </ul>   
            </div>
            <div class="col-lg-3 col-md-2 col-sm-2">
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

    <hr>

@endsection
