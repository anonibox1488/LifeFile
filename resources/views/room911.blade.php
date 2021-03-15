@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			
			<div id="error" class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-ban"></i> Alert!</h5>
				<span id="error_alert">Unexpected error try again</span>
			</div>
			
			
			<div id="success" class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-check"></i> Alert!</h5>
				<span id="error_success"></span>
			</div>
			
			<h1 class="text-center">Acces Control ROOM_911</h1>
			<div class="card">
				<div class="card-header ">
					<div class="row">
						<div class="col-md-9">
							<form  method="GET" action="{{ route('room-911') }}">
								<div class="row">
									<div class="col-md-6 p-1">
										<input type="text" class="form-control" id="search" name="search" placeholder="Search Id , Name or Last Name">
									</div>
									<div class="col-md-6 p-1">
										<select class="form-control" id="search_departments" name="search_departments">
											<option value=""> Search By Department</option>
											@foreach ($departaments as $departament)
											<option value="{{$departament->id}}">{{$departament->name}}</option>
											@endforeach
										</select>
									</div>

									<div class="col-md-5 p-1">
										<input class="form-control" id="initial_date" name="initial_date" autocomplete="off" placeholder="Date Initial" />
									</div>

									<div class="col-md-5 p-1">
										<input class="form-control" id="end_date" name="end_date"  autocomplete="off" placeholder=" Date End"/>
									</div>
									<div class="col-md-2 p-1">
										<button class="btn btn-primary float-right">Search</button>
									</div>
								</div>
							</form>
						</div>
						<div class="col-md-3">
							<div class="row">
								<div class="col-12 mb-2">
									<a href="{{ route('home') }}" class="btn btn-primary float-right"> Home</a>
								</div>
								<div class="col-12 mt-2">
									<button class="btn btn-primary float-right" data-toggle="modal" data-target="#new-employed">New Employed</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<table id="" class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Employed code</th>
								<th>Department</th>
								<th>Last Name</th>
								<th>Middle Name</th>
								<th>First Name</th>
								<th>Last Access</th>
								<th>Total Access </th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($employees as $employed)
							<tr>
								<td>{{$employed->code}}</td>
								<td>{{$employed->department->name}}</td> 
								<td>{{$employed->last_name}}</td>
								<td>{{$employed->middle_name}}</td>
								<td>{{$employed->name}}</td> 
								<td>{{$employed->last_access}}</td>
								<td>{{$employed->total}}</td>
								<td>
									<div class="dropdown show">
										<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Actions
										</a>

										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="#" onclick="loadEmployed('{{$employed}}')" data-toggle="modal" data-target="#update">Update</a>
											<div>
												<form id="change-access" action="{{ url('/access/'.$employed->id) }}" method="POST" >
													@csrf
													@method('PUT')
													<button type="submit" class="dropdown-item">{{$employed->access_button}} Access </button>
												</form>
											</div>
											<div>
												<form id="change-access" action="{{ url('/employed/'.$employed->id) }}" method="POST" >
													@csrf
													@method('DELETE')
													<button type="submit" class="dropdown-item">Delete</button>
												</form>
											</div>
											<a class="dropdown-item" href="{{ url('/history/'.$employed->id) }}">History</a>
											
										</div>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				{{ $employees->links() }}
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="new-employed" tabindex="-1" role="dialog" aria-labelledby="new-employed" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">New Employed</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- <form method="POST" action="{{ route('new-employed') }}"> -->
					<!-- @csrf -->
					<div class="form-group row">
						<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

						<div class="col-md-6">
							<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
							<span class="invalid-feedback" role="alert">
								<strong id="error_name"></strong>
							</span>
							
						</div>
					</div>

					<div class="form-group row">
						<label for="middle_name" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>

						<div class="col-md-6">
							<input id="middle_name" type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}" required autocomplete="middle_name">

							<span class="invalid-feedback" role="alert">
								<strong id="error_middle_name"></strong>
							</span>
							
						</div>
					</div>

					<div class="form-group row">
						<label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

						<div class="col-md-6">
							<input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

							<span class="invalid-feedback" role="alert">
								<strong id="error_last_name"></strong>
							</span>
							
						</div>
					</div>

					<div class="form-group row">
						<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

						<div class="col-md-6">
							<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">

							<span class="invalid-feedback" role="alert">
								<strong id="error_email"></strong>
							</span>
						</div>
					</div>

					<div class="form-group row">
						<label for="departments" class="col-md-4 col-form-label text-md-right">{{ __('Departments') }}</label>

						<div class="col-md-6">
							<select class="form-control" id="departments" name="departments">
								<option value="">Select</option>
								@foreach ($departaments as $departament)
								<option value="{{$departament->id}}">{{$departament->name}}</option>
								@endforeach
							</select>

							<span class="invalid-feedback" role="alert">
								<strong id="error_departments"></strong>
							</span>
						</div>
					</div>

					<div class="form-group row">
						<label for="access_room_911" class="col-md-4 col-form-label text-md-right">{{ __('Access Room_911') }}</label>

						<div class="col-md-6">
							<select class="form-control" id="access_room_911" name="access_room_911">
								<option value="no">No</option>
								<option value="yes">Yes</option>
							</select>

							<span class="invalid-feedback" role="alert">
								<strong id="error_access_room_911"></strong>
							</span>
						</div>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="button" class="btn btn-primary" onclick="newEmployed()">
								{{ __('Register') }}
							</button>
						</div>
					</div>
				<!-- </form> -->
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="update" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Update Employed</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('new-employed') }}">
					@csrf
					@method('PUT')
					<input type="hidden" name="id" id="id" value="">

					<div class="form-group row">
						<label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Code') }}</label>

						<div class="col-md-6">
							<input id="code" type="text" class="form-control" name="code" value="" readonly autocomplete="code" autofocus>
						</div>
					</div>

					<div class="form-group row">
						<label for="name_update" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

						<div class="col-md-6">
							<input id="name_update" type="text" class="form-control " name="name_update" value="{{ old('name_update') }}" required autocomplete="name_update" autofocus>
							
							<span class="invalid-feedback" role="alert">
								<strong id="error_name_update"></strong>
							</span>
						</div>
					</div>

					<div class="form-group row">
						<label for="middle_name_update" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>

						<div class="col-md-6">
							<input id="middle_name_update" type="text" class="form-control" name="middle_name_update" value="{{ old('middle_name_update') }}" required autocomplete="middle_name_update">

							<span class="invalid-feedback" role="alert">
								<strong id="error_middle_name_update"></strong>
							</span>
						</div>
					</div>

					<div class="form-group row">
						<label for="last_name_update" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

						<div class="col-md-6">
							<input id="last_name_update" type="text" class="form-control" name="last_name_update" value="{{ old('last_name_update') }}" required autocomplete="last_name_update">

							<span class="invalid-feedback" role="alert">
								<strong id="error_last_name_update"></strong>
							</span>
						</div>
					</div>

					<div class="form-group row">
						<label for="email_update" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

						<div class="col-md-6">
							<input id="email_update" type="email" class="form-control" name="email_update" value="{{ old('email_update') }}" readonly autocomplete="email_update">

							<span class="invalid-feedback" role="alert">
								<strong id="error_email_update"></strong>
							</span>
						</div>
					</div>

					<div class="form-group row">
						<label for="departments_update" class="col-md-4 col-form-label text-md-right">{{ __('Departments') }}</label>

						<div class="col-md-6">
							<select class="form-control" id="departments_update" name="departments_update">
								<option value="">Select</option>
								@foreach ($departaments as $departament)
								<option value="{{$departament->id}}">{{$departament->name}}</option>
								@endforeach
							</select>

							<span class="invalid-feedback" role="alert">
								<strong id="error_departments_update"></strong>
							</span>
						</div>
					</div>

					<div class="form-group row">
						<label for="access_room_911_update" class="col-md-4 col-form-label text-md-right">{{ __('Access Room_911') }}</label>

						<div class="col-md-6">
							<select class="form-control" id="access_room_911_update" name="access_room_911_update">
								<option value="no">No</option>
								<option value="yes">Yes</option>
							</select>

							<span class="invalid-feedback" role="alert">
								<strong id="error_access_room_911_update"></strong>
							</span>
							
						</div>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="button" class="btn btn-primary" onclick="updateEmployed()">
								{{ __('Register') }}
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#initial_date').datepicker({  
		format: 'yyyy-mm-dd'
	});

	$('#end_date').datepicker({  
		format: 'yyyy-mm-dd'
	});

	$('#error').hide();
	$('#success').hide();
</script>
@endsection
