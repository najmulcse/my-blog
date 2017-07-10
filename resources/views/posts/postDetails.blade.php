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
                <!-- For showing comments-->
                            @foreach($post->comments as $comment)
                              <div class="row">    
                                          <div class="col-sm-1">
                                                 <img class="img-responsive" src="{{asset('img/my.jpg')}}">
                                                   <label>{{ $comment->user->name }}</label>
                                          </div>
                                          <div class="col-sm-11">
                             @if( $user->id == $comment->user_id)
                                <div class="pull-right">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class="dropdown">
                                             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                 <span class=""><i class="fa fa-cog"></i></span>
                                             </a>
                                                <ul class="dropdown-menu" role="menu">
                                                 <li><a href="#"><i class="fa fa-pencil fa-fw"></i>Edit</a></li>
                                                       
                                                <li><a onclick="return confirm('are you sure?')" href="#"><i class="fa fa-trash-o fa-fw"></i>Delete</a></li>     
                                                </ul>
                                            </li>
                                         </ul>
                                     </div>
                                 @endif
                                              
                                              <p> {{$comment->body}}</p>
                                          </div>
                                                
                                  </div>  
                               @endforeach  
                                        
                                        <!--for comment submission form-->
                                 <div class="row">
                                        <div class="col-sm-1">
                                               <img class="img-responsive" src="{{asset('img/my.jpg')}}">
                                                 <label>{{ $user->name }}</label>
                                        </div>
                                        <div class="col-sm-11">
                                         
                                              <form action="{{route('commentStore')}}" method="POST" role="form">
                                               {{csrf_field()}}

                                                <input type="hidden" name="p_comment_id" value="{{$post->id}}">

                                                <div class="form-group @if($errors->has('body') && ($post->id == 41 )) has-error @endif" >
                                                 
                                                        <textarea type="text" class="form-control" name="body" id="" rows="3" placeholder="Write a comment">{{old('body')}}</textarea>
                                                      {!!$errors->first('body','<span class="help-block">:message </span>')!!}
                                                  </div>
                                                <div class="form-group">
                                                  
                                                        <button type="submit" class="btn btn-sm btn-primary">Comment</button>
                                                </div>
                                              </form>
                                        </div>
                                  </div>   <!-- comment submission form ended-->
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
