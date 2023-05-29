<!-- Add -->
<div class="modal  fade"  id="addnew" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>

            <h4 class="modal-title"><b>Add Employee</b></h4>
            <div class="modal-body">
                
                   
                <div class="card-body text-left">
                    <div class="container-fluid">
                    <form method="POST" action="{{ route('employees.store') }}">
                        @csrf
                        <div class="row">
                        <div class="form-group col-md-6 col-lg-6">
                           
                            <input type="text" class="form-control" placeholder="Enter Employee Name" id="name" name="name"
                                required />
                        </div>
                        <div class="form-group col-md-6 col-lg-6">
                          
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter a valid email adress">

                        </div>
                    </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-lg-6">
                                <label for="schedule" class="col-sm-12">CTG Number</label>
                                <input type="text" class="form-control" placeholder="Enter CTG Number" id="ctgnumber" name="ctgnumber"
                                    required />
                            </div>
                                                    
                        
                            {{-- <div class="form-group col-md-6 col-lg-6">
                            
                                <input type="number" min="0" value="0" step=".01" class="form-control" id="bsalary" name="bsalary" placeholder="Enter Daily Salary Rate (USD)" required>

                            </div> --}}
                        
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="schedule" class="col-sm-12">Duty Station</label>


                            <select class="form-control" id="station" name="station" required>
                                <option value="" selected>- Select -</option>
                                @foreach($stations as $station)
                                <option value="{{$station->id}}">{{$station->station}}  </option>
                                @endforeach

                            </select> 

                        </div>
                    </div>
                    <div class="row">
                            <div class="form-group col-md-6 col-lg-6">
                                <label for="schedule" class="col-sm-12 ">Job Position</label>


                                <select class="form-control" id="position" name="position" required>
                                    <option value="" selected>- Select -</option>
                                    @foreach($positions as $position)
                                    <option value="{{$position->id}}">{{$position->position}}  </option>
                                    @endforeach

                                </select> 

                            </div>
                 
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="schedule" class="col-sm-12">Support Unit</label>


                            <select class="form-control" id="unit" name="unit" required>
                                <option value="" selected>- Select -</option>
                               
                                <option value="Support">Support  </option>
                                <option value="Fleet">Fleet </option>
                               

                            </select> 

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