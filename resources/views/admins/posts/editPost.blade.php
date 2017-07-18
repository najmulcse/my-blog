@extends('layouts.bloglayout')

@section('blog_body')
<div class="container-fluid">
<div class="row">
	<div class="col-sm-12">
		<ul class="list-inline">
		   <li class="list-inline-item"> 
		   		<a class="btn btn-success btn-sm" href="{{route('allPostAdmin')}}" role="button">Goto All Posts</a> </li>
		   {{-- <li class="list-inline-item">
		   		<h2 class="text-center">All posts</h2>
		   </li> --}}
		    
		</ul>
		
	</div>
</div>
<div class="row">
	<div class="col-lg-8 col-sm-8 col-sm-offset-1">
		<form action="{{route('postUpdate',['pid' =>$post->id])}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data" >
				{{csrf_field()}}
				{{method_field('PATCH')}}
				<div class="form-group">
				<br>
					<legend>Edit Post</legend>
				</div>
				@if (session('msg'))
				    <div class="alert alert-success text-center">
				       {{ session('msg') }}
				    </div>
				 @endif
				<div class="form-group">
					<label class="label-control col-sm-3">Category</label>
					<div class="col-sm-9  @if($errors->has('category')) has-error @endif">
						<select name="category" class="form-control ">
							
							@if(!empty($categories))
							    @foreach($categories as $category)
							    	@if($category->id == $post->category_id)
							    	<option value="{{$category->id}}" selected>{{$category->title}}</option>
							    	@else
							     	<option value="{{$category->id}}">{{$category->title}}</option>
							     	@endif
							    @endforeach
							       
							 @endif
						</select>
						
						{!!$errors->first('category','<span class = "help-block"> :message </span>')!!}
					</div>
				</div>
				<div class="form-group    ">
					<label class="label-control col-sm-3">Post type</label>
					<div class="col-sm-9 @if($errors->has('post_type')) has-error @endif">	
						<select class="form-control" name="post_type">
							@foreach($types as $type)
								@if($type->id == $post->post_type)
									<option value="{{$type->id}}" selected>{{$type->type}}</option>
								@else
								  	<option value="{{$type->id}}">{{$type->type}}</option>
								@endif  	
							 @endforeach 
						</select>
						{!!$errors->first('post_type','<span class = "help-block"> :message </span>')!!}
					</div>
				</div>
				<div class="form-group ">
					<label class="label-control col-sm-3">Title</label>
					<div class="col-sm-9 @if($errors->has('title')) has-error @endif">
						<input type="text" name="title" id="title" class="form-control" value="{{$post->title}}" >
						{!! $errors->first('title','<span class="help-block"> :message </span>')!!}
						
					</div>
				</div>
				<div class="form-group">
					<label class="label-control col-sm-3">Body</label>
					<div class="col-sm-9  @if($errors->has('body')) has-error @endif">
						<textarea type="text" name="body" id="body" class="form-control" rows="6">{{$post->body}}</textarea> 
					{!! $errors->first('body','<span class="help-block"> :message </span>')!!}
					</div>
				</div>
				<div class="form-group">
					<label class="label-control col-sm-3 col-xs-8">File</label>
					<div class="col-sm-9 col-xs-10 @if($errors->has('postFile')) has-error @endif">
						<input type="file" name="postFile" class="form-control">
						{!! $errors->first('postFile','<span class="help-block"> :message </span>')!!}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4 col-sm-offset-3">
						<button type="submit" class="btn btn-primary form-control">Update Post</button>
					</div>
				</div>
		</form>
	</div>
	<div class="col-sm-2"></div>
</div>

</div>
@endsection





