<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
              
            </div>
            <h4 class="modal-title"><b>Add New Duty Station</b></h4>
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="{{ route('stations.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Duty Station</label>                        
                            <div class="bootstrap-timepicker">
                                <input type="text" class="form-control timepicker" id="station" name="station">
                            </div>
                            <input type="hidden" class="form-control" id="incharge_id" name="incharge_id" value="Admin">
                    </div>
                    {{-- <div id="div_id_name" class="form-group required"> 
                        <label for="schedule" class="col-sm-12 control-label">Station Incharge</label>


                        <select class="form-control " id="incharge_id" name="incharge_id" required>
                            <option value="" selected>- Select -</option>
                            @foreach($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->name}} __ {{$employee->position}}  </option>
                            @endforeach

                        </select> 

                    </div> --}}
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

