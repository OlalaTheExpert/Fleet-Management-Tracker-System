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
           
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="{{ route('comment', $schedule->id) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <div class="row">
                        <div class="form-group col-md-12 col-lg-12">
                            <label> Post a Comment for rejecting</label>

                            <textarea class="form-control" id="inland" name="comment" required></textarea>                            
                        </div>
                     
                    
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check-square-o"></i>
                    Reject</button>
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
               
                {{-- <h4 class="modal-title "><span class="employee_id">Approve?</span></h4> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('upload.approve', $schedule->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="text-center">
                        <h3>Approve?</h3>
                       
                    </div>

                    <input type="hidden" name="user" id="user" value="{{ Auth::user()->name }}" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-danger pull-left" data-dismiss="modal"><i
                        class="fa fa-close "></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Approve</button>
                </form>
            </div>
        </div>
    </div>
</div>