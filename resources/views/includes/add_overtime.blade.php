<!-- Add -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
    div.searchable {
        width: 300px;
        float: left;
        margin: 0 15px;
    }
    
    .searchable input {
        width: 100%;
        height: 50px;
        font-size: 18px;
        padding: 10px;
        -webkit-box-sizing: border-box;
        /* Safari/Chrome, other WebKit */
        -moz-box-sizing: border-box;
        /* Firefox, other Gecko */
        box-sizing: border-box;
        /* Opera/IE 8+ */
        display: block;
        font-weight: 400;
        line-height: 1.6;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        background: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E") no-repeat right .75rem center/8px 10px;
    }
    
    .searchable ul {
        display: none;
        list-style-type: none;
        background-color: #fff;
        border-radius: 0 0 5px 5px;
        border: 1px solid #add8e6;
        border-top: none;
        max-height: 180px;
        margin: 0;
        overflow-y: scroll;
        overflow-x: hidden;
        padding: 0;
    }
    
    .searchable ul li {
        padding: 7px 9px;
        border-bottom: 1px solid #e1e1e1;
        cursor: pointer;
        color: #6e6e6e;
    }
    
    .searchable ul li.selected {
        background-color: #e8e8e8;
        color: #333;
    }
</style>
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
              
            </div>
           
            <h4 class="modal-title"><b>Update Overtime</b></h4>           
            {{-- <h4 class="modal-title"><b>Clock In Attendance</b></h4> --}}
            <div class="modal-body text-left">                

                   
                    <form class="form-horizontal" method="POST" action="{{ route('overTimeStore') }}">
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
                              <label for="schedule" class="col-sm-12 ">Overtime Classfications</label>
            
                                    <select class="form-control" id="overtime_category" name="overtime_category" required>
                                       <option value="0" selected disabled>Select Below</option>                                        
                                        <option value="ot15">Overtime OT 1.5 </option>                          
                                        <option value="ot75">Overtime OT 7.5 </option>
                                        <option value="ot2">Overtime OT 2 </option>
                                        <option value="ot2.5">Overtime OT 2.5 </option>
                                    </select> 
    
                           
                            </div>
                       </div>
                  
                    {{-- <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Select Date</label>                        
                            <div class="bootstrap-timepicker">
                                <input type="date" class="form-control timepicker" id="created" name="created" required >
                            </div>                        
                    </div> --}}
                    
                     
                
                   
                    <div class="form-group">
                        <label for="time_in" class="col-sm-3 control-label">Time In</label>                        
                            <div class="bootstrap-timepicker">
                                <input type="datetime-local" class="form-control timepicker" id="current_t" name="current_t" required >
                            </div>                        
                    </div>
                    <div class="form-group">
                        <label for="time_out" class="col-sm-3 control-label">Time Out</label>                        
                            <div class="bootstrap-timepicker">
                                <input type="datetime-local" class="form-control timepicker" id="start_t" name="start_t" required>
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

<script>
    function filterFunction(that, event) {
        let container, input, filter, li, input_val;
        container = $(that).closest(".searchable");
        input_val = container.find("input").val().toUpperCase();

        if (["ArrowDown", "ArrowUp", "Enter"].indexOf(event.key) != -1) {
            keyControl(event, container)
        } else {
            li = container.find("ul li");
            li.each(function(i, obj) {
                if ($(this).text().toUpperCase().indexOf(input_val) > -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            container.find("ul li").removeClass("selected");
            setTimeout(function() {
                container.find("ul li:visible").first().addClass("selected");
            }, 100)
        }
    }

    function keyControl(e, container) {
        if (e.key == "ArrowDown") {

            if (container.find("ul li").hasClass("selected")) {
                if (container.find("ul li:visible").index(container.find("ul li.selected")) + 1 < container.find("ul li:visible").length) {
                    container.find("ul li.selected").removeClass("selected").nextAll().not('[style*="display: none"]').first().addClass("selected");
                }

            } else {
                container.find("ul li:first-child").addClass("selected");
            }

        } else if (e.key == "ArrowUp") {

            if (container.find("ul li:visible").index(container.find("ul li.selected")) > 0) {
                container.find("ul li.selected").removeClass("selected").prevAll().not('[style*="display: none"]').first().addClass("selected");
            }
        } else if (e.key == "Enter") {
            container.find("input").val(container.find("ul li.selected").text()).blur();
            onSelect(container.find("ul li.selected").text())
        }

        container.find("ul li.selected")[0].scrollIntoView({
            behavior: "smooth",
        });
    }

    function onSelect(val) {
        alert(val)
    }

    $(".searchable input").focus(function() {
        $(this).closest(".searchable").find("ul").show();
        $(this).closest(".searchable").find("ul li").show();
    });
    $(".searchable input").blur(function() {
        let that = this;
        setTimeout(function() {
            $(that).closest(".searchable").find("ul").hide();
        }, 300);
    });

    $(document).on('click', '.searchable ul li', function() {
        $(this).closest(".searchable").find("input").val($(this).text()).blur();
        onSelect($(this).text())
    });

    $(".searchable ul li").hover(function() {
        $(this).closest(".searchable").find("ul li.selected").removeClass("selected");
        $(this).addClass("selected");
    });
</script>

