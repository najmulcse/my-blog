@extends('layouts.adminLayout')



@section('admin_content')

<div class="row">
	<div class="col-sm-8">
		<ul class="list-inline">
		   <li class="list-inline-item"> 
		   		<a class="btn btn-success btn-sm" href="{{route('createPost')}}" role="button">Create new Post</a> </li>
		   <li class="list-inline-item">
		   		<h2 class="text-center">All posts</h2>
		   </li>
		    
		</ul>
		
	</div>
	<div class="col-sm-4">
		
		<form action="" method="POST" class="form-inline" role="form">
		
			<div class="form-group">
				<label class="sr-only" for="">label</label>
				<input type="text" class="form-control" id="" placeholder="Search...">
			</div>
		
			
		
			<button type="submit" class="btn btn-primary">Search</button>
		</form>
	</div>
</div>

<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>S.N</th>
				<th>Name</th>
				<th>Category</th>
				<th>Type</th>
				<th>Title</th>
				<th>Body</th>
				<th>Details</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
		@if(!empty($posts))
			@foreach($posts as $post)
				<tr>
					<td>{{$post->id}}</td>
					<td>{{$post->user->name}}</td>
					<td>{{$post->category->title}}</td>
					<td>{{$post->postType->type}}</td>
					<td>{{$post->title}}</td>
					<td>{{$post->body}}</td>
					<td><a href="{{route('individualPostDetails',['pid' =>$post->id])}}" class="btn btn-sm btn-primary">Details</a></td>
					<td ><a href="{{route('editPost',['pid'=>$post->id])}}" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
					<td ><a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> </a></td>
				</tr>
			@endforeach
		@endif	
		</tbody>
	</table>
</div>

@endsection
