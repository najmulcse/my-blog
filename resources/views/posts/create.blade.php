@extends('layouts.adminLayout')

@section('admin_content')

<div class="row">
	<div class="col-lg-7 col-sm-8 col-sm-offset-1">
		<form action="" method="POST" class="form-horizontal" role="form">
				<div class="form-group">
				<div class="form-group ">
					<label class="label-control">Post type</label>
					<select class="form-control">
						<option>Please select post type</option>
						<option>Public</option>
						<option>Draft</option>
						<option>Personal</option>
					</select>
				</div>
				<br>
					<legend>Create Post</legend>
				</div>
				<div class="form-group">
					<label class="label-control">Category</label>
					<select name="category" class="form-control">
						<option value="">Please Select a Category</option>
						@if(!empty($categories))
						    @foreach($categories as $category)
						     <option value="{{$category->id}}">{{$category->title}}</option>
						    @endforeach
						       
						 @endif
					</select>
				</div>
				<div class="form-group @if($errors->has('title')) has-error @endif">
				<label class="label-control">Title</label>
					<input type="text" name="title" id="title" class="form-control" placeholder="Enter post title" value="{{old('title')}}" >
					{!! $errors->first('title','<span class="help-block"> :message </span>')!!}
				</div>
				<div class="form-group @if($errors->has('body')) has-error @endif">
				<label class="label-control">Body</label>
					<textarea type="text" name="body" id="body" class="form-control" placeholder="Enter post body " rows="6">{{old('body')}}</textarea> 
					{!! $errors->first('body','<span class="help-block"> :message </span>')!!}
				</div>
				<div class="form-group">
					<label class="label-control">File</label>
					<input type="file" name="file">
				</div>
				<div class="form-group">
					<div class="col-sm-4 col-sm-offset-3">
						<button type="submit" class="btn btn-primary form-control">Create Post</button>
					</div>
				</div>
		</form>
	</div>
	<div class="col-sm-4"></div>
</div>


@endsection





