
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ajax Todo List Project</title>

	<!-- CSRF Token -->
	{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

	{{-- bootstrap --}}
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	{{-- font awesome --}}
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" class="css">


	<style>
		

		table thead th,table tr td{
		text-align: center;
	}

	.pull-right{
		position: absolute;
		right: 10px;
		top: 5px;
	}

	.load{
		position: fixed;
		left: 35%;
		text-align: center;
		top: 20%;
		z-index: 9999;
		margin: auto;
		display: none;
	}

	</style>
</head>
<body>
	
	<div class="container">
		<br>
		<br>
		<div class="row">

@php
	// $sl = 1;
$sl = ($data->currentpage()-1)* $data->perpage() + 1;
@endphp
			
			<div class="col-md-12">
				
				<div class="card">
					<div class="card-header">
						Customer data
						<div class="pull-right">
							<button class="btn btn-primary" data-toggle="modal" data-target="#addCustomer">Add Customer</button>
						</div>
					</div>
					<div class="card-body table-responsive" id="showAllDataHere">
						
						<table class="table table-striped table-hover table-bordered">
							<thead>
								<th>Sl</th>
								<th>Name</th>
								<th>Phone</th>
								<th>Email</th>
								<th>District</th>
								<th>Registered Date</th>
								<th>Manage</th>
							</thead>
							<tbody>
								<div id="hellyyy">
								@foreach($data as $show)
								<tr>
									<td>{{ $sl++ }}</td>
									<td>{{ $show->name }}</td>
									<td>{{ $show->phone }}</td>
									<td>{{ $show->email }}</td>
									<td>{{ $show->district }}</td>
									<td>{{ date("d-m-Y", strtotime($show->created_at)) }}</td>
									<td>
										<a href="{{ url('view/customer/data') }}" data-id="{{ $show->id }}" id="view" class="btn btn-sm btn-success">View</a>

										<a href="{{ url('edit/customer/data') }}" data-id="{{ $show->id }}" id="edit" class="btn btn-sm btn-primary">Edit</a>

										<a onclick="return confirm('Are you sure to delete?')" href="{{ url('delete/customer/data') }}" data-id="{{ $show->id }}" id="delete" class="btn btn-sm btn-danger">Delete</a>
									</td>
								</tr>
								@endforeach
								</div>
							</tbody>
						</table>

						{!! $data->render() !!}
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- Add Customer start--}}
<div id="getalldata" data-url="{{ url('get/customer/data') }}"></div>
<div id="getalldatabypagination" data-url="{{ url('get/customer/data/by/pagination') }}"></div>

	<!-- Modal -->
	<div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="{{ url('add/customer/data') }}" method="POST" id="addcustomerform">
				@csrf
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Add Customer Data</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
							</div>
							<input type="text" class="form-control" placeholder="Name" name="name">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
							</div>
							<input type="text" class="form-control" placeholder="Phone" name="phone">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
							</div>
							<input type="text" class="form-control" placeholder="Email" name="email">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
							</div>
							<input type="text" class="form-control" placeholder="District" name="district">
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	{{-- Add Customer end --}}



	<!-- Modal -->
	<div class="modal fade" id="ViewCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="customername"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="cname"></div>
						<div class="cphone"></div>
						<div class="cemail"></div>
						<div class="cdistrict"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
		</div>
	</div>
	{{-- Add Customer --}}




	<!-- Update Customer -->
	<div class="modal fade" id="UpdateCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="{{ url('update/customer/data') }}" method="POST" id="updatecustomerform">
				@csrf
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="updatecustomertitle"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="id" id="customerid">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
							</div>
							<input type="text" id="cname" class="form-control" placeholder="Name" name="name">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
							</div>
							<input type="text" id="cphone" class="form-control" placeholder="Phone" name="phone">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
							</div>
							<input type="text" id="cemail" class="form-control" placeholder="Email" name="email">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
							</div>
							<input type="text" id="cdistrict" class="form-control" placeholder="District" name="district">
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	{{-- Update Customer Customer --}}




 </div>
    <div class="load">
        <img src="{{ asset('load.gif') }}" class="img-fluid loading">
    </div>
	{{-- jquery --}}
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		
	{{-- bootstrap --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>



	{{-- headers ta jquery er niche R je khane script korbo tar upore rakte hobbe ajax form submit er jonno --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    {{-- sweet alert script er upore thakte hobbe --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

	<script>
		
		$(function(){
			$(function(){
				$("#addcustomerform").on("submit", function(e){
					e.preventDefault();
					var form = $(this);
					var url = form.attr("action");
					var type = form.attr("method");
					var data = form.serialize();

					$.ajax({

						url: url,
						data: data,
						type: type,
						dataType: "JSON",
						beforeSend: function(){
							$(".load").fadeIn();
						},
						success: function(data){
							if(data == "success"){
								$("#addCustomer").modal("hide");
								swal("Great", "Successfully Customer Data Inputed", "success");
								form[0].reset();

								return getCustomerData();
							}
						},
						complete: function(){
							$(".load").fadeOut();
						},

					});

				});


				function getCustomerData(){
					var url = $("#getalldata").data("url");

					$.ajax({
						url: url, 
						type: "get",
						dataType: "HTMl",
						success: function(response){
							$("#showAllDataHere").html(response);
						}	
					})
				}


				// View Data
				$(document).on("click", "#view", function(e){
					e.preventDefault();
					var id = $(this).data("id");
					var url = $(this).attr("href");

					$.ajax({
						url: url,
						data: {id:id},
						type: "GET",
						dataType: "JSON",
						success: function(response){
							if($.isEmptyObject(response) != null){
								$("#ViewCustomer").modal("show");
								$("#customername").text(response.name + "'s Data");
								$(".cname").text("Name: " + response.name);
								$(".cphone").text("Phone: " + response.phone);
								$(".cemail").text("Email: " + response.email);
								$(".cdistrict").text("District: " + response.district);
							}
						}
					});

				});



				// Edit
				$(document).on("click", "#edit", function(arg){
					arg.preventDefault();
					var id = $(this).data("id");
					var url = $(this).attr("href");

					$.ajax({
						url: url,
						data: {id:id},
						dataType:"JSON",
						type: "GET",
						success(response){
							$("#UpdateCustomer").modal("show");
							$("#cname").val(response.name);
							$("#cphone").val(response.phone);
							$("#cemail").val(response.email);
							$("#cdistrict").val(response.district);
							$("#customerid").val(response.id);
							$("#updatecustomertitle").text("Update " + response.name + "'s Data");
						}
					})

				});	




				// Delete Data
				$(document).on("click", "#delete", function(arg){
					arg.preventDefault();
					var id = $(this).data("id");
					var url = $(this).attr('href');

					$.ajax({
						url: url,
						data: {id:id},
						type: "GET",
						dataType: "JSON", 
						success(response){
							swal("Deleted", "Customer Data Has Been Deleted", "success");
							return getCustomerData();
						}
					})

				});

				//update
				$("#updatecustomerform").on("submit", function(arg){
					arg.preventDefault();
					var form =$(this);
					var url = form.attr("action");
					var type = form.attr("method");
					var data = form.serialize();

					$.ajax({
						url: url,
						type: type,
						dataType: "JSON",
						data: data,
						beforeSend: function(){
							$(".load").fadeIn();
						},
						success: function(response){
							if(response == "success"){
								swal("Data Updated", "Success", "success");
								$("#UpdateCustomer").modal("hide");
								return getCustomerData();
							}
						},
						complete: function(){
							$(".load").fadeOut();
						}
					});

				});


				$(document).on("click", ".pagination li a", function(e){
					e.preventDefault();
					var page = $(this).attr("href");
					var pagenumber = page.split("?page=")[1];
					return getPagination(pagenumber);
				});

				function getPagination(pagenumber){
					var geturl = $("#getalldatabypagination").data("url");
					var url = geturl+"?page=" + pagenumber;
					
					$.ajax({
						url: url,
						type: "GET",
						dataType: "HTML",
						success: function(response){
							$("#showAllDataHere").html(response);
						}
					});
				}


			 });
		});
	</script>

</body>
</html>
