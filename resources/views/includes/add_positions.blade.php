<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>

            <h4 class="modal-title"><b>Add New Job Position</b></h4>
            <div class="modal-body">

                <div class="card-body text-left">

                    <form method="POST" action="{{ route('positions.store') }}">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="name">Job Position </label>
                            <input type="text" class="form-control" placeholder="Enter New Job Position" id="position" name="position"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="name">Monthly Rate </label>
                            <input type="number" step=".01" class="form-control" placeholder="Enter Monthly Rates" id="monthly_rate" name="monthly_rate"
                                required />
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