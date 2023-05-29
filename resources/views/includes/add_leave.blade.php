<!-- Add -->
<div class="modal  fade"  id="addnew" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>

            <h4 class="modal-title"><b>Add Leave</b></h4>
            <div class="modal-body">
                
                   
                <div class="card-body text-left">
                    <div class="container-fluid">
                    <form method="POST" action="{{ route('leaves.store') }}">
                        @csrf
                        <div class="row">
                        <div class="form-group col-md-6 col-lg-6">                          
                           
                                <label for="schedule" class="col-sm-12 ">Employee Name</label>

                                <select class="form-control" id="employee_id" name="employee_id" required>
                                    <option value="" selected>- Select -</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->name}}  </option>
                                    @endforeach

                                </select> 

                        </div>
                        <div class="form-group col-md-6 col-lg-6">                          
                           
                            <label for="schedule" class="col-sm-12 ">Annual Leave</label>

                            <select class="form-control" id="type" name="type" required>
                                <option value="" selected>- Select -</option>
                               
                                <option value="Sick-Leave">Sick Leave  </option>
                                <option value="Annual-Leave">Annual Leave  </option>
                               

                            </select> 

                    </div>
                       
                    </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-lg-6">
                                <label for="schedule" class="col-sm-12 ">As from</label>

                                <input type="date" class="form-control" id="leave_date" name="leave_date"
                                    required min="@php echo Date("Y-m-d") @endphp"/>
                            </div>                                                    
                        
                            <div class="form-group col-md-6 col-lg-6">
                                <label for="schedule" class="col-sm-12 ">Return Date</label>

                                <input type="date" class="form-control" id="return_date" name="return_date" required min="@php echo Date("Y-m-d") @endphp">

                            </div>
                        </div>
      

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect m-l-5" data-dismiss="modal">
                                    Cancel 
                                </button>
                            </div>
                        </div>
                    </form>

            </div>
            </div>

        </div>

        </div>

    </div>
</div>
</div>