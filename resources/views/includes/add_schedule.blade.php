<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
              
            </div>
            @if(date('D') == 'Sun')
            <h4 class="modal-title"><b>Update Mission Attendance</b></h4>
            @else
            <h4 class="modal-title"><b>Update Daily Attendance</b></h4>
            @endif
           

            {{-- <h4 class="modal-title"><b>Clock In Attendance</b></h4> --}}
            <div class="modal-body text-left">                

                    @if(date('D') != 'Sun') 
                    <form class="form-horizontal" method="POST" action="{{ route('schedule.store') }}">
                        @csrf

                        <select class="js-example-basic-single" name="state">
                            <option value="AL">Alabama</option>
                              
                            <option value="WY">Wyoming</option>
                          </select>                   
                                 
                        <div class="form-group">
                                                    
                               
                                <label for="schedule" class="col-sm-12 ">Employee Name</label>
    
                                <select class="form-control" id="employee_id" name="employee_id" required>
                                    <option value="" selected>- Select -</option>
                                    @foreach($employees as $employee)
                                    @if (Auth::user()->role=='1')
                                    <option value="{{$employee->id}}">{{$employee->name}}  </option>
                                    @elseif(Auth::user()->station_id==$employee->station_id && Auth::user()->role=='Data-Clerk')
                                     <option value="{{$employee->id}}">{{$employee->name}}  </option>
                                    @endif
                                    @endforeach
                                </select> 
    
                       
                            
                        </div>
                    @if(Auth::user()->role =='1')
                    <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Select Date</label>                        
                            <div class="bootstrap-timepicker">
                                <input type="date" class="form-control timepicker" id="created" name="created" required >
                            </div>                        
                    </div>
                    
                     @else
                     <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Select Date</label>                        
                            <div class="bootstrap-timepicker">
                                <input type="date" class="form-control timepicker" id="created" name="created" required min="@php echo date("Y-m-d", strtotime("yesterday")) @endphp" max="@php echo date("Y-m-d") @endphp" >
                            </div>                        
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="time_in" class="col-sm-3 control-label">Time In</label>                        
                            <div class="bootstrap-timepicker">
                                <input type="time" class="form-control timepicker" id="time_in" name="time_in" required >
                            </div>                        
                    </div>
                    <div class="form-group">
                        <label for="time_out" class="col-sm-3 control-label">Time Out</label>                        
                            <div class="bootstrap-timepicker">
                                <input type="time" class="form-control timepicker" id="time_out" name="time_out" required>
                            </div>
                        
                    </div>                   

                    <div class="row">
                        <div class="form-group col-md-6 col-lg-12">
                          <label for="schedule" class="col-sm-12 ">Mission Types</label>
        
                                <select class="form-control" id="mission" name="mission" required>
                                   <option value="0" selected>No mission day</option> 
                                   
                                    <option value="inland">Mission Inland </option>                          
                                     <option value="overland">Mission Overland  </option>
                                   
                                </select> 

                            {{-- <label for="schedule" class="col-sm-12 ">Mission Inland</label>

                            <input type="number" class="form-control" id="inland" min="0" max="1" name="inland" value="0" required> --}}

                        </div>
                        {{-- <div class="form-group col-md-6 col-lg-6">
                            <label for="schedule" class="col-sm-12 ">Number of Days</label>

                            <input type="number" class="form-control" id="overland" name="overland" min="0" max="1" value="0" required>

                        </div> --}}
                    
                    </div>
                    @else
                    <form class="form-horizontal" method="POST" action="{{ route('schedule.sundaystore') }}">
                        @csrf
                        <div class="form-group">
                                                    
                               
                                <label for="schedule" class="col-sm-12 ">Employee Name</label>
    
                                <select class="form-control" id="employee_id" name="employee_id" required>
                                    <option value="" selected>- Select -</option>
                                    @foreach($employees as $employee)
                                    @if (Auth::user()->role=='1')
                                    <option value="{{$employee->id}}">{{$employee->name}}  </option>
                                    @elseif(Auth::user()->station_id==$employee->station_id && Auth::user()->role=='Data-Clerk')
                                     <option value="{{$employee->id}}">{{$employee->name}}  </option>
                                    @endif
                                    @endforeach
                                </select> 
    
                       
                            
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-lg-12">
                              <label for="schedule" class="col-sm-12 ">Mission Types</label>
            
                                    <select class="form-control" id="mission" name="mission" required>
                                       <option value="0" selected>No mission day</option> 
                                       
                                        <option value="inland">Mission Inland </option>                          
                                         <option value="overland">Mission Overland  </option>
                                       
                                    </select> 
    
                                {{-- <label for="schedule" class="col-sm-12 ">Mission Inland</label>
    
                                <input type="number" class="form-control" id="inland" min="0" max="1" name="inland" value="0" required> --}}
    
                            </div>
                            {{-- <div class="form-group col-md-6 col-lg-6">
                                <label for="schedule" class="col-sm-12 ">Number of Days</label>
    
                                <input type="number" class="form-control" id="overland" name="overland" min="0" max="1" value="0" required>
    
                            </div> --}}
                        
                        </div>

                    @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


