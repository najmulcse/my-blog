@extends('layouts.bloglayout')

@section('blog_body')
<div class="container-fluid">
<div class="row">
	<div class="col-lg-8 col-sm-8 col-sm-offset-1">
		<form action="{{route('storePost')}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data" >
				{{csrf_field()}}
				<div class="form-group">
				<br>
					<legend>Create Post</legend>
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
							<option value="">Please Select a Category</option>
							@if(!empty($categories))
							    @foreach($categories as $category)
							     <option value="{{$category->id}}">{{$category->title}}</option>
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
							<option value="">Please select post type</option>
							@foreach($postTypes as $type)
							  	<option value="{{$type->id}}">{{$type->type}}</option>
							 @endforeach 
						</select>
						{!!$errors->first('post_type','<span class = "help-block"> :message </span>')!!}
					</div>
				</div>
				<div class="form-group ">
					<label class="label-control col-sm-3">Title</label>
					<div class="col-sm-9 @if($errors->has('title')) has-error @endif">
						<input type="text" name="title" id="title" class="form-control" placeholder="Enter post title" value="{{old('title')}}" >
						{!! $errors->first('title','<span class="help-block"> :message </span>')!!}
						
					</div>
				</div>
				<div class="form-group">
					<label class="label-control col-sm-3">Body</label>
					<div class="col-sm-9  @if($errors->has('body')) has-error @endif">
						<textarea type="text" name="body" id="body" class="form-control" placeholder="Body " rows="6">{{old('body')}}</textarea> 
					{!! $errors->first('body','<span class="help-block"> :message </span>')!!}
					</div>
				</div>
				<div class="form-group">
					<label class="label-control col-sm-3 col-xs-8">File</label>
					<div class="col-sm-9 col-xs-10 @if($errors->has('postFile')) has-error @endif">
						<input type="file" name="postFile" class="form-control" accept=".doc,.docx,.ppt,.pptx,.png,.jpeg,.jpg,.pdf">
						{!! $errors->first('postFile','<span class="help-block"> :message </span>')!!}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4 col-sm-offset-3">
						<button type="submit" class="btn btn-primary form-control">Create Post</button>
					</div>
				</div>
		</form>
	</div>
	<div class="col-sm-2"></div>
</div>
</div>
@endsection





