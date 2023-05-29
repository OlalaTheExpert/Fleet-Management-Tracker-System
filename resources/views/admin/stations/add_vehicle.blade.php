<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>

            <h4 class="modal-title"><b>Add Vehicle Details</b></h4>
            <div class="modal-body">

                <div class="card-body text-left">

                    <form method="POST" action="{{ route('vehicles.store') }}">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="name">Vehicle Type </label>
                            <input type="text" class="form-control" placeholder="Enter Vehicle Type" id="type" name="type"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="position">Vehicle Model</label>
                            <input type="text" class="form-control" placeholder="Enter Vehicle Model" id="model" name="model"
                                required />
                        </div>

                        <div class="form-group">
                            <label for="position">Vehicle Color</label>
                            <input type="text" class="form-control" placeholder="Enter Vehicle Color" id="color" name="color"
                                required />
                        </div>

                        <div class="form-group">
                            <label for="position">Number Plate</label>
                            <input type="text" class="form-control" placeholder="Enter Plate Number" id="plateno" name="plateno"
                                required />
                        </div>

                        
                        
                        {{-- <div class="form-group">
                            <label for="schedule" class="col-sm-3 control-label">Schedule</label>


                            <select class="form-control" id="schedule" name="schedule" required>
                                <option value="" selected>- Select -</option>
                                @foreach($schedules as $schedule)
                                <option value="{{$schedule->slug}}">{{$schedule->slug}} -> from {{$schedule->time_in}}
                                    to {{$schedule->time_out}} </option>
                                @endforeach

                            </select> 

                        </div>--}}

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