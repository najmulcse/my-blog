@extends('layouts.bloglayout')


@section('blog_body')
	<a href="{{route('allPostAdmin')}}" class="btn btn-primary">Back</a>
	<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading">Post Details</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="form-control-static col-sm-3">Post ID </label>
				<label class="form-control-static col-sm-9">{{$post->id}}</label>
			</div>
			<div class="form-group">
				<label class="form-control-static col-sm-3">Posted By </label>
				<label class="form-control-static col-sm-9">{{$post->user->name}}</label>
			</div>
			<div class="form-group">
				<label class="form-control-static col-sm-3">Post Type </label>
				<label class="form-control-static col-sm-9">{{$post->postType->type}}</label>
			</div>
			<div class="form-group">
				<label class="form-control-static col-sm-3">Post Category </label>
				<label class="form-control-static col-sm-9">{{$post->category->title}}</label>
			</div>
			<div class="form-group">
				<label class="form-control-static col-sm-3">Post Title </label>
				<label class="form-control-static col-sm-9">{{$post->title}}</label>
			</div>
			<div class="form-group">
				<label class="form-control-static col-sm-3">Post Body </label>
				<label class="form-control-static col-sm-9">{{$post->body}}</label>
			</div>
			<div class="form-group">
				<label class="form-control-static col-sm-3">File </label>
				<label class="form-control-static col-sm-9"> </label>	
				@if($contents=$post->contents)
					@foreach($contents as $content)
					<label class="col-sm-3"> </label>
						<a href="#" class="form-control-static col-sm-9">{{$content->content}}</a>
					@endforeach	 
					
				@endif
			</div>
			<div class="form-group">
				<label class="form-control-static col-sm-3">Post created_at </label>
				<label class="form-control-static col-sm-9">{{$post->created_at}}</label>
			</div>
			<div class="form-group">
				<label class="form-control-static col-sm-3">Total Comments </label>
				<label class="form-control-static col-sm-9"></label>
			</div>
			<div class="form-group">
				<label class="form-control-static col-sm-3">Total viewers </label>
				<label class="form-control-static col-sm-9"></label>
			</div>
		
		</div>
	
		
	</div>
@endsection