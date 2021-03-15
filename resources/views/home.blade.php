@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12">
			@if ($message = Session::get('error'))
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-ban"></i> Alert!</h5>
				{{ $message }}
			</div>
			@endif
			@if ($message = Session::get('success'))
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-check"></i> Alert!</h5>
				{{ $message }}
			</div>
			@endif	
		</div>

		<div class="col-md-6 mt-3">
			<div class="card">
				<div class="card-header">
					<strong>Access Control</strong>
				</div>
				<div class="card-body">
					<p class="card-text"> Insert code of employed.</p>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#access_control">Insert</button>
				</div>
			</div>
		</div>
		
		<div class="col-md-6 mt-3">
			<div class="card">
				<div class="card-header">
					<strong>View Access Control</strong>
				</div>
				<div class="card-body">
					<p class="card-text">List of employees.</p>
					<a href="{{ route('room-911') }}" class="btn btn-primary">Go</a>
				</div>
			</div>
		</div>

		<div class="col-md-12 mt-3">
			<div class="card">
				<div class="card-header">
					<strong>Bulk Employee Upload</strong>
				</div>
				<div class="card-body">
					<p class="card-text">Upload file.</p>
					<a href="{{url('/Employees.xlsx')}}">Download Sample .XLSX File</a>
					<form method="POST" action="{{ url('bulk-employed')}}" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<select class="form-control @error('department') is-invalid @enderror" id="department" name="department">
										<option value="">Select</option>
										@foreach ($departaments as $department)
										<option value="{{$department->id}}">{{$department->name}}</option>
										@endforeach
									</select>	
									@error('department')
									<span style="color: red">
										{{ $message }}
									</span>
									@enderror
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input @error('file') is-invalid @enderror" id="file" name="file" value="">
										<label class="custom-file-label" data-browse="XLS" for="file">Select File of Employed to Import</label>
										@error('file')
										<span style="color: red">
											{{ $message }}
										</span>
										@enderror
									</div>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<div class="col-md-12">
										<button type="submit" class="btn btn-primary btn-block">
											{{ __('Upload') }}
										</button>
									</div>
								</div>
								
							</div>
						</div>						
					</form>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal Access Control -->
	<div class="modal fade" id="access_control" tabindex="-1" role="dialog" aria-labelledby="access_control" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="access_control">Insert Code</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{ route('access-control') }}">
						@csrf
						<div class="form-group row">
							<label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Code Employed') }}</label>

							<div class="col-md-6">
								<input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value=""  autocomplete="code" autofocus>

								@error('code')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary">
									{{ __('GO') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Upload File -->
	<div class="modal fade" id="upload_file" tabindex="-1" role="dialog" aria-labelledby="upload_file" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="upload_file">Bulk Employee Upload</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					
				</div>
			</div>
		</div>
	</div>
	@endsection
