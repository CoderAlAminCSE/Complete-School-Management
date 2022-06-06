@extends('admin.admin_master')

@section('main_content')
    
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">

      <!-- Main content -->
      <section class="content">
        <div class="row"> 
            <div class="col-12">
                <div class="box bb-3 border-warning">
                    <div class="box-header">
                    <h4 class="box-title">Student Search</h4>
                    </div>

                    <div class="box-body">
                        <form action="{{route('student.class.year.wise')}}" method="GET">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Year <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <select name="year_id" id="year_id" required class="form-control">
                                                <option value="" selected disabled>Select Year</option>
                                                    @foreach ($years as $year)
                                                    <option value="{{$year->id}}" {{ (@$year_id == $year->id) ? "selected":""}}>{{$year->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div> 
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Class <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <select name="class_id" id="class_id" required class="form-control">
                                                <option value="" selected disabled>Select Class</option>
                                                    @foreach ($classes as $class)
                                                        <option value="{{$class->id}}" {{(@$class_id == $class->id)? "selected":""}}>{{$class->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div> 
                                </div>

                                <div class="col-md-4" style="padding-top: 25px">
                                    <input type="submit" class="btn btn-rounded btn-dark md-5" name="search" value="search">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
              </div>



          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Student List</h3>
                <a href="{{route('student.registration.add')}}" style="float:right" class="btn btn-rounded btn-success mb-5">Add Student</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                      @if(!@search)
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="2%">SL</th>
                                    <th>Name</th>
                                    <th>ID No</th>
                                    <th>Role</th>
                                    <th>Year</th>
                                    <th>Class</th>
                                    <th>Image</th>
                                    @if (Auth::user()->role == 'Admin')
                                    <th>Code</th>
                                    @endif
                                    <th width="25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allData as $key=>$allData)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$allData['student']['name']}}</td>
                                    <td>{{$allData['student']['id_no']}}</td>
                                    <td>{{$allData->roll}}</td>
                                    <td>{{$allData['student_year']['name']}}</td>
                                    <td>{{$allData['student_class']['name']}}</td>
                                    <td>
                                        <img src="{{(!empty($allData['student']['image'])) ? url('upload/student_image/'.$allData['student']['image']):url('upload/no_image.jpg')}}" alt="" style="height: 50px;height:50px">
                                    </td>
                                    <td>{{$allData['student']['code']}}</td>
                                    <td>
                                        <a title="edit" href="{{route('student.registration.edit',$allData->student_id)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                        <a title="promotion" href="{{route('student.registration.promotion',$allData->student_id)}}" class=" btn btn-info"><i class="fa fa-check"></i></a>
                                        <a target="_blank" title="details" href="{{route('student.registration.details',$allData->student_id)}}" class=" btn btn-info" ><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            
                            </tbody>
                        </table>
                      @else
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="2%">SL</th> 
                                    <th>Name</th>
                                    <th>ID No</th>
                                    <th>Role</th>
                                    <th>Year</th>
                                    <th>Class</th>
                                    <th>Image</th>
                                    @if (Auth::user()->role == 'Admin')
                                    <th>Code</th>
                                    @endif
                                    <th width="25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allData as $key=>$allData)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$allData['student']['name']}}</td>
                                    <td>{{$allData['student']['id_no']}}</td>
                                    <td>{{$allData->roll}}</td>
                                    <td>{{$allData['student_year']['name']}}</td>
                                    <td>{{$allData['student_class']['name']}}</td>
                                    <td>
                                        <img src="{{(!empty($allData['student']['image'])) ? url('upload/student_image/'.$allData['student']['image']):url('upload/no_image.jpg')}}" alt="" style="height: 50px;height:50px">
                                    </td>
                                    <td>{{$allData['student']['code']}}</td>
                                    <td>
                                        <a title="edit" href="{{route('student.registration.edit',$allData->student_id)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                        <a title="promotion" href="{{route('student.registration.promotion',$allData->student_id)}}" class=" btn btn-info"><i class="fa fa-check"></i></a>
                                        <a target="_blank" title="details" href="{{route('student.registration.details',$allData->student_id)}}" class=" btn btn-info" ><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            
                            </tbody>
                        </table>
                      @endif
                    
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
<!-- /.content-wrapper -->

@endsection

