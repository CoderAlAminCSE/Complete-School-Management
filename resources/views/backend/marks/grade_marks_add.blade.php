@extends('admin.admin_master')

@section('main_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">	  

      <!-- Main content -->
      <section class="content">

       <!-- Basic Forms -->
        <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Add Grade Marks</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">
                  <form method="post" action="{{route('store.marks.grade')}}">
                    @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Grade Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="grade_name" class="form-control" required="" > 
                                            </div>		 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Grade Point <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="grade_point" class="form-control" required="" > 
                                            </div>		 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Start Marks <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="start_marks" class="form-control" required=""> 
                                            </div>		 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>End Marks <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="end_marks" class="form-control" required="" > 
                                           </div>		 
                                          </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Start Point <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="start_point" class="form-control" required="" > 
                                           </div>		 
                                          </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>End Point <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="end_point" class="form-control" required="" > 
                                           </div>		 
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Remarks <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="remarks" class="form-control" required="" > 
                                       </div>		 
                                      </div>
                                </div>
                            </div>
                        </div>

                          

                      <div class="text-xs-right">
                          <input type="submit" class="btn btn-rounded btn-info" value="Submit">
                      </div>

                  </form>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->

@endsection
