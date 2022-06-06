@extends('admin.admin_master')
@section('main_content')


 <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		 

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
			 

			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Employee Salary List</h3>
	<a href="{{route('employee.registration.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Add Employee Salary</a>			  

				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
			<tr>
				<th width="5%">SL</th>  
				<th>Name</th> 
				<th>ID NO</th>
				<th>Mobile</th>
				<th>Gender</th>
				<th>Join Date</th>
				<th>Salary</th>
				<th width="20%">Action</th>
				 
			</tr>
		</thead>
		<tbody>
			@foreach($allData as $key => $employee )
			<tr>
				<td>{{ $key+1 }}</td>
				<td> {{ $employee->name }}</td>	
				<td> {{ $employee->id_no }}</td>	
				<td> {{ $employee->mobile }}</td>	
				<td> {{ $employee->gender }}</td>	
				<td> {{ date('d-m-Y',strtotime($employee->join_date))}}</td>	
				<td> {{ $employee->salary }}</td>	 
				<td>
<a title="Increament" href="{{route('employee.salary.increment',$employee->id)}}" class="btn btn-info"><i class="fa fa-plus-circle"></i></a>
<a title="Details" target="_blank" href="{{route('employee.salary.details',$employee->id)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>

				</td>
				 
			</tr>
			@endforeach
							 
						</tbody>
						<tfoot>
							 
						</tfoot>
					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->

			       
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>





@endsection
