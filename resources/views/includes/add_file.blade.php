<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
              
            </div>
          
            <h4 class="modal-title"><b>Update Daily Attendance Sheet</b></h4>
            
            {{-- <h4 class="modal-title"><b>Clock In Attendance</b></h4> --}}
            <div class="modal-body text-left">                

                  
                    <form class="form-horizontal" method="POST" action="{{ route('uploads') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                                                    
             
                   
                     <div class="form-group">
                        <label for="date" class="col-sm-12 control-label">Upload attendance sheet</label>                        
                            <div class="bootstrap-timepicker">
                                <input 
                                type="file" 
                                name="files[]" 
                                id="inputFile"
                                multiple 
                                class="form-control @error('files') is-invalid @enderror">
              
                            @error('files')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                                {{-- <input type="file" class="form-control" id="id" name="files" required multiple> --}}
                            </div>                        
                    </div>
                 
                 
                
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

