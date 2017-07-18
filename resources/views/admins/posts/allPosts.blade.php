@extends('layouts.bloglayout')



@section('blog_body')
<div class="container-fluid">


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
</div>
@endsection
