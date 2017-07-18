@extends('layouts.bloglayout')


@section('blog_body')
<div class="container-fluid">
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
				<tbody >	
					@if(!empty($categories))
						@foreach($categories as $category)
						<tr id="cat_table{{$category->id}}">
						<td>{{$category->title}}</td>
						<td >
							<button class="btn btn-info open-modal" value="{{$category->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
							<button class="btn btn-danger delete-task delete-modal" value="{{$category->id}}"><i class="fa fa-trash" aria-hidden="true"></i> </button>
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
                           <h4 class="modal-title" id="myModalLabel">Category Edit</h4>
                       </div>
                       <div class="modal-body">
                           <form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="">

                               <div class="form-group error">
                                   <label for="inputTask" class="col-sm-3 control-label">Category Name</label>
                                   <div class="col-sm-9">
                                       <input type="text" class="form-control has-error" id="title" name="title" placeholder="Category name" value="">
                                   </div>
                               </div>

                               
                           </form>
                       </div>
                       <div class="modal-footer">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           <button type="button" class="btn btn-primary" id="update_cat">Update</button>
                           <input type="hidden" id="cat_id" name="cat_id" value="0">
                       </div>
                   </div>
               </div>
           </div>

<!--modal,For deleting category -->

<div class="modal fade" id="modal-id-delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Delete Category</h4>
      </div>
      <div class="modal-body">
        <h2>Are you sure to delete this category?</h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="delete-confirm">Delete</button>
      </div>
    </div>
  </div>
</div>
</div>
           <script type="text/javascript">
           
           
         
           	$(document).ready(function(){

                var url = "/categoryEditAjax/";
                //display modal form for task editing
                $('.open-modal').click(function(){
                       var cat_id = $(this).val();

                $.ajax({
                        url      : url + cat_id,
                        type     : "GET",
                        dataType :'json',
                        success  : function(data){    
                                     $('#cat_id').val(data.id);
                                     $('#title').val(data.title);
                                     $('#myModal').modal('show');
                                     console.log(data);
                            },
                        error : function(err){
                                  console.log(err);
                        }    

                       });
                   });


            $('#update_cat').click(function(e){

                     
                     e.preventDefault();
                     var formDatas = {

                      title  : $('#title').val() 
                     
                     }  
                    // console.log(formDatas);
                     var cat_id = $('#cat_id').val();
                      $.ajaxSetup({
                        headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                      }
                      });

                     $.ajax({
                      url        : "/categoryUpdateAjax/" + cat_id ,
                      type       : "POST" ,
                      dataType   : 'json' ,
                     
                      data       : JSON.stringify(formDatas),
                      success    : function(data){

                                 if(data.cat === 'success'){
                                  $('#title'+cat_id).replaceWith('#title');
                                  $('#frmTasks').trigger("reset");
                                  $('myModal').modal('hide');
                                  }
                      },
                      error      : function(err){
                                  console.log(err);
                      }
                     });                 

                });


            // Delete category
            $('.delete-modal').click(function(){
                  var cat_id = $(this).val();
                  $('#modal-id-delete').modal('show');

                  $('#delete-confirm').click(function(){

                  $.ajax({
                    url       : "/deleteCategory/"+cat_id,
                    type      : "GET" ,
                    dataType  :'json',
                    success   : function(data){
                              console.log(data);
                              $('#cat_table'+cat_id).remove();
                              $('#modal-id-delete').modal('hide');
                    },
                    error     :function(err){
                              console.log(err);
                    }
                  });
              });
            });

            });
           		
           </script>
@endsection