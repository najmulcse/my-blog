@extends('layouts.bloglayout')

@section('blog_body')
<div class="container-fluid" >
        <div class="row">
            <div class="col-lg-9  col-md-10 col-sm-10">

            @if(!empty($posts))
             @foreach ($posts as $post) <!--all posts/lectures printing foreach loop started -->
              <div class="row">
                
                       <div class="col-sm-1">
                          <figure>
                            <img class="img-responsive" src="{{asset('img/my.jpg')}}">
                          </figure>
                          <label>{{ $post->user->name }}</label>
                       </div>
                       <div class="col-sm-11">
                            <div>
                                        
                                
                                       <div class="pull-right">
                                           <ul class="nav navbar-nav navbar-right">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                             <span class=""><i class="fa fa-cog"></i></span>
                                                    </a>
                                                    <ul class="dropdown-menu" role="menu">
                                                          <li><a href="{{route('editPost',['pid'=>$post->id])}}"><i class="fa fa-pencil fa-fw"></i>Edit</a></li>

                                                          <li><a onclick="return confirm('are you sure?')" href="{{route('delete.post',['id'=>$post->id])}}"><i class="fa fa-trash-o fa-fw"></i>Delete</a></li> 
                                                      
                                                    </ul>
                                                </li>
                                            </ul>
                                       </div>

                                  
                                    
                            </div>
                            
                                   <div class="post-preview" style="padding-left: 10%;">
                            <a href="{{route('postDetails',['pid'=>$post->id,'cid'=>$post->category_id])}}">
                                <h2 class="post-title">
                                   {{$post->title}}
                                </h2>
                                <h3 class="post-subtitle">
                                    {!! nl2br($post->body)!!}
                                </h3>
                            </a>
                            @if($contents=$post->contents)
                                @foreach($contents as $content)
                                    <a href="#" class="">{{$content->content}}</a>
                                    <br>
                                @endforeach
                            @endif
                            <p class="post-meta">Posted by <a href="#">{{$post->user->name}}</a> on {{$post->created_at}}</p>
                        </div>
                        <hr>
                            </div>
                            <br>
                      
                </div>
               
          @endforeach 
          @endif <!--all posts/lectures printing foreach loop ended -->
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

    <hr>

@endsection
