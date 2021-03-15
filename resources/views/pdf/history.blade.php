<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title></title>
	<style type="text/css">
		table{
			width: 100%;
			border: 1px solid #999999;
		}
		table tbody tr td{
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header ">
						<h2 class="text-center">History of {{$user->name}} {{$user->last_name}}</h2>
					</div>
					<div class="card-body p-1">
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
</body>
</html>