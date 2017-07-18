@extends('layouts.bloglayout')

@section('blog_body')
<div class="container-fluid" >
        <div class="row">
            <div class="col-lg-9  col-md-10 col-sm-10">

            @if(!empty($results))
             @foreach ($results as $result) 
               <div>
                 <h3> <a href="{{route('postDetails',['pid'=>$result->id,'cid'=>$result->category_id])}}">{{$result->title}}</a></h3>
               </div>
               <hr>
             @endforeach 
             @else
             <h3>No result found!!! </h3>
            @endif 
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
