@extends('layouts.adminLayout')


@section('admin_content')

<div class="row">
	<div class="col-sm-4 col-sm-offset-1">
		<form action="{{route('cStore')}}" method="POST" class="form-horizontal" role="form">
				{{csrf_field()}}
				<div class="form-group">
					<legend>Add Category</legend>
				</div>	
				@if (session('msg'))
				    <div class="alert alert-success text-center">
				       {{ session('msg') }}
				    </div>
				 @endif
				<div class="form-group @if($errors->has('title')) has-error @endif">
					<input type="text" name="title" id="inputCategory" class="form-control" value=""  placeholder="Please enter a category">
					{!!$errors->first('title','<span class="help-block">:message</span>')!!}
				</div>
				<div class="form-group">
						<button type="submit" class="btn btn-primary form-control">Add category</button>
				</div>
		</form>

	</div>
	<div class="col-sm-5 col-sm-offset-1">
		<h2>All Categories </h2>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Category</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>	
					@if(!empty($categories))
						@foreach($categories as $category)
						<tr>
						<td>{{$category->title}}</td>
						<td ><a href="" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
						<td ><a href="#" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> </a></td>
						</tr>
						@endforeach
					@endif				
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection