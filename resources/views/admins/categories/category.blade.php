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
						<th>Option</th>
						
					</tr>
				</thead>
				<tbody>	
					@if(!empty($categories))
						@foreach($categories as $category)
						<tr>
						<td>{{$category->title}}</td>
						<td >
							<button class="btn btn-info open-modal" value="{{$category->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
							<a href="#" class="btn btn-danger delete-task"><i class="fa fa-trash" aria-hidden="true"></i> </a>
						</td>
						</tr>
						@endforeach
					@endif				
				</tbody>
			</table>
		</div>
	</div>
</div>



<!-- Modal (Pop up when detail button clicked) -->
           <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                           <h4 class="modal-title" id="myModalLabel">Task Editor</h4>
                       </div>
                       <div class="modal-body">
                           <form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="">

                               <div class="form-group error">
                                   <label for="inputTask" class="col-sm-3 control-label">Task</label>
                                   <div class="col-sm-9">
                                       <input type="text" class="form-control has-error" id="task" name="task" placeholder="Task" value="">
                                   </div>
                               </div>

                               <div class="form-group">
                                   <label for="inputEmail3" class="col-sm-3 control-label">Description</label>
                                   <div class="col-sm-9">
                                       <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="">
                                   </div>
                               </div>
                           </form>
                       </div>
                       <div class="modal-footer">
                           <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                           <input type="hidden" id="task_id" name="task_id" value="0">
                       </div>
                   </div>
               </div>
           </div>


           <script >
           	$.ajaxSetup({
           
          });
           	$(document).ready(function(){
                var url = "categoryEditAjax";
                //display modal form for task editing
                   $('.open-modal').click(function(){
                       var cat_id = $(this).val();
                        console.log(cat_id);
                        $('#myModal').modal('show');
                       // $.get(url , function (data) {
                       //     //success data
                       //     console.log(data);
                       //     // $('#task_id').val(data.id);
                       //     // $('#task').val(data.task);
                       //     // $('#description').val(data.description);
                       //     // $('#btn-save').val("update");

                       //      $('#myModal').modal('show');
                       // }) 

                       $.ajax({
                        url     : "categoryEditAjax",
                        headers : {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                  },
                        dataType :'json',
                        success  : function(data){
                                  console.log(data);
                            },
                        error : function(err){
                                  console.log(err);
                        }    

                       });
                   });

            });
           		
           </script>
@endsection