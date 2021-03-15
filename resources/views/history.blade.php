@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<h2 class="text-center">History of {{$user->name}} {{$user->last_name}}</h2>
			<div class="card">
				<div class="card-header ">
					<form  method="GET" action="{{url('/history/'.$user->id)}}">
						<div class="row">
							<input type="hidden" id="id" name="id" value="{{$user->id}}">
							<div class="col-md-4 p-1">
								<input class="form-control" id="initial_date" name="initial_date" autocomplete="off" placeholder="Date Initial" value="{{$start}}"/>
							</div>

							<div class="col-md-4 p-1">
								<input class="form-control" id="end_date" name="end_date"  autocomplete="off" placeholder=" Date End" value="{{$end}}"/>
							</div>
							<div class="col-md-4 p-1">
								<button type="submit" class="btn btn-primary">Search</button>
							</div>
						</div>
					</form>
				</div>
				<div class="card-body p-1">
					<button type="button" class="btn btn-primary float-right ml-1 mb-2" onclick="pdf()">Export PDF</button>
					<a href="{{ route('home') }}" class="btn btn-primary float-right ml-1 mb-2"> Home</a>
					<table id="" class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Department</th>
								<th>Access</th>
								<th>Date Access</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($histories as $history)
							<tr>
								<td>{{$history->department->name}}</td>
								<td>{{$history->access}}</td>
								<td>{{$history->created_at}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>				
				</div>
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

	function pdf() {
		let id = $('#id').val();
		let start = $('#initial_date').val();
		let end = $('#end_date').val();
		console.log(id, start, end);
		$url = '/export?id='+id+'&initial_date='+start+'&end_date='+end;
		$(location).attr('href',$url);
	}
</script>

@endsection