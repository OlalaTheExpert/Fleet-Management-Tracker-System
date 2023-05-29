<!-- Edit -->
<div class="modal fade" id="edit{{ $schedule->id }}">
    <div class=" modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            @php
            $id=$schedule->employee_id;
            $data= DB::table('employees')                                                
                ->where('employees.id', $id)
                ->get();
            @endphp
            <h4 class="modal-title"><b>Update Schedule for 
                @foreach ($data as $name)
                 <small class="font-weight-bold">{{ $name->name }}</small>
                @endforeach
                </b></h4>
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="{{ route('schedule.update', $schedule->id) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group">                     


                        <div class="bootstrap-timepicker">
                           
                            <input type="hidden" class="form-control timepicker" id="employee_id" name="employee_id"
                                value="{{ $schedule->employee_id}}">
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="edit_time_in" class="col-sm-3 control-label">Time In</label>

                        <div class="bootstrap-timepicker">
                            <input type="time" class="form-control timepicker" id="edit_time_in" name="time_in"
                                value="{{ $schedule->time_in }}">
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="edit_time_out" class="col-sm-3 control-label">Time out</label>


                        <div class="bootstrap-timepicker">
                            <input type="time" class="form-control timepicker" id="edit_time_out" name="time_out"
                                value="{{ $schedule->time_out }}">
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="schedule" class="col-sm-12 ">Mission Inland</label>

                            <input type="number" class="form-control" id="inland" min="0" max="1" name="inland" value="{{ $schedule->inland }}" required>
                            <input type="hidden" class="form-control" id="updatedinland" min="0" max="1" name="updatedinland" value="{{ $schedule->inland ?? "0" }}" required>

                        </div>
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="schedule" class="col-sm-12 ">Mission Overland</label>

                            <input type="number" class="form-control" id="overland" name="overland" min="0" max="1" value="{{ $schedule->overland }}" required>
                            <input type="hidden" class="form-control" id="updatedoverland" name="updatedoverland" min="0" max="1" value="{{ $schedule->overland ?? "0" }}" required>

                        </div>
                    
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check-square-o"></i>
                    Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete{{ $schedule->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header " style="align-items: center">
               
                <h4 class="modal-title "><span class="employee_id">Delete Attendance</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('schedule.destroy', $schedule->id) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div class="text-center">
                        <h3>Remove this attendance?</h3>
                       
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>