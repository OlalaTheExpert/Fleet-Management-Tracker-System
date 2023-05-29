

@extends('layouts.master')

@section('css')
<!--Chartist Chart CSS -->
<link rel="stylesheet" href="{{ URL::asset('plugins/chartist/css/chartist.min.css') }}">
@endsection

@section('breadcrumb')
<div class="col-sm-6 text-left" >
     <h4 class="page-title">Dashboard</h4>
     <ol class="breadcrumb">
         <li class="breadcrumb-item active">Welcome to Fleet Time Management Tracker</li>
     </ol>
</div>
@endsection

@section('content')
<!-- Edit -->

 
  <center>
            
<h4 class="modal-title"><b><span class="employee_id">Update Payment Details for: <br> <span style="color: green; font-weight:bold;">{{ $employee->name }} </span> CTG Number <span style="color: green; font-weight:bold;">{{$employee->ctgnumber }}</span></span></b></h4>
  </center>
 

            <div class="modal-body text-left">
              <div class="container-fluid">
                <form class="form-horizontal" method="POST" action="{{ route('payment.details', $employee->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" class="input-md textinput textInput form-control" id="employee_name" name="employee_name" value="{{ $employee->name }}"
                    required>
                    <input type="hidden" class="input-md textinput textInput form-control" id="employee_id" name="employee_id" value="{{ $employee->id }}"
                    required>
                    <input type="hidden" class="input-md textinput textInput form-control" id="ctgnumber" name="ctgnumber" value="{{ $employee->ctgnumber }}"
                    required>
                    <input type="hidden" class="input-md textinput textInput form-control" id="bsalary" name="bsalary" value="{{ $employee->bsalary }}"
                    required>
                    {{-- <input type="hidden" class="input-md textinput textInput form-control" id="bsalary" name="bsalary" value="{{ $employee-> }}"
                    required> --}}

                  <div class="row">
                    {{-- <div id="div_id_name" class="form-group required col-md-4"> 
                      <label for="id_name" class="control-label col-md-12  requiredField">No Days Worked<span class="asteriskField">*</span> </label>  --}}
                      @foreach( $data as $key => $datas)                    
                      
                      <div class="controls col-md-12 "> 
                          <input type="hidden" class="input-md textinput textInput form-control" id="daysworked" name="daysworked" value=" {{ $datas->attendance_time ?? "0" }}"
                           required>
                      </div>
                          {{-- <div id="div_id_name" class="form-group required col-md-4"> 
                        <label for="id_name" class="control-label col-md-12  requiredField"> Mission Overland<span class="asteriskField">*</span> </label> 
                        <div class="controls col-md-12 ">  --}}
                          <input type="hidden" class="input-md textinput textInput form-control" id="overland" name="overland" value="{{ $datas->overland }}"
                          required>
                     {{-- </div>
                 </div>
                 <div id="div_id_name" class="form-group required col-md-4"> 
                   <label for="id_name" class="control-label col-md-12  requiredField"> Mission Inland<span class="asteriskField">*</span> </label> 
                   <div class="controls col-md-12 ">  --}}
                       <input type="hidden" class="input-md textinput textInput form-control" id="inland" name="inland" value="{{ $datas->inland }}"
                        required>
                   {{-- </div>
               </div> --}}
                      @endforeach
                  {{-- </div> --}}
                
              
              {{-- <div id="div_id_name" class="form-group required col-md-4"> 
                <label for="id_name" class="control-label col-md-12  requiredField"> Sick Leave<span class="asteriskField">*</span> </label>  --}}
                @if($datemonth==$month)
                @foreach( $leaves as $key => $days) 
                @if($days->type=='Sick-Leave')
                <div class="controls col-md-12 "> 
                    <input type="hidden" class="input-md textinput textInput form-control" id="sickleave" name="sickleave" value="{{ $days->days }}"
                     required>
                </div>
                <div class="controls col-md-12 "> 
                  <input type="hidden" class="input-md textinput textInput form-control" id="annualleave" name="annualleave" value="0"
                   required>
              </div>
                @else
                <div class="controls col-md-12 "> 
                  <input type="hidden" class="input-md textinput textInput form-control" id="annualleave" name="annualleave" value="{{ $days->days }}"
                   required>
              </div>
              <div class="controls col-md-12 "> 
                <input type="hidden" class="input-md textinput textInput form-control" id="sickleave" name="sickleave" value="0"
                 required>
            </div>
              @endif
                @endforeach
                @else
                  <div class="controls col-md-12 "> 
                    <input type="hidden" class="input-md textinput textInput form-control" id="sickleave" name="sickleave" value="0"
                     required>
                </div>
                <div class="controls col-md-12 "> 
                  <input type="hidden" class="input-md textinput textInput form-control" id="annualleave" name="annualleave" value="0"
                   required>
              </div>
                @endif
            {{-- </div> --}}
            
            {{-- <div id="div_id_name" class="form-group required col-md-4"> 
              <label for="id_name" class="control-label col-md-12  requiredField"> Annual Leave<span class="asteriskField">*</span> </label> --}}
              {{-- @foreach( $leaves as $key => $days)  
                @if($days->type=='Annual-Leave')
              <div class="controls col-md-12 "> 
                  <input type="hidden" class="input-md textinput textInput form-control" id="annualleave" name="annualleave" value="{{ $days->days }}"
                   required>
              </div>
              @else
              <div class="controls col-md-12 "> 
                <input type="hidden" class="input-md textinput textInput form-control" id="annualleave" name="annualleave" value="0"
                 required>
            </div>
              @endif
              @endforeach --}}
          {{-- </div> --}}
        
          {{-- <div id="div_id_name" class="form-group required col-md-3"> 
            <label for="id_name" class="control-label col-md-12  requiredField"> TT OT 1.5<span class="asteriskField">*</span> </label> 
            <div class="controls col-md-12 ">  --}}
                <input type="hidden" class="input-md textinput textInput form-control" id="ot15" name="ot15" value="0"
                 required>
            {{-- </div>
        </div>

        <div id="div_id_name" class="form-group required col-md-3"> 
          <label for="id_name" class="control-label col-md-12  requiredField"> TT OT 1.75<span class="asteriskField">*</span> </label> 
          <div class="controls col-md-12 ">  --}}
              <input type="hidden" class="input-md textinput textInput form-control" id="ot175" name="ot175" value="0"
               required>
          {{-- </div>
      </div>
      <div id="div_id_name" class="form-group required col-md-3"> 
        <label for="id_name" class="control-label col-md-12  requiredField"> TT OT 2<span class="asteriskField">*</span> </label> 
        <div class="controls col-md-12 ">  --}}
            <input type="hidden" class="input-md textinput textInput form-control" id="ot2" name="ot2" value="0"
             required>
        {{-- </div>
    </div>

    <div id="div_id_name" class="form-group required col-md-3"> 
      <label for="id_name" class="control-label col-md-12  requiredField"> TT OT 2.5<span class="asteriskField">*</span> </label> 
      <div class="controls col-md-12 ">  --}}
          <input type="hidden" class="input-md textinput textInput form-control" id="ot25" name="ot25" value="0"
           required>
      {{-- </div>
  </div> --}}

</div>
<center>
  <div class="form-group">
                                            
                       
   
    <div class="controls col-md-8 ">
    <select class="form-control" id="batch" name="batch" required>
        <option value="" selected>-- Select Payroll Batch --</option>
        {{-- @foreach($employees as $employee) --}}

        @php
          $months = array("January", "February", "March", "April", "May", "June", "July", "August", "October", "November", "December");
          $date=now()->format('Y');
          foreach ($months as $month) {
              echo "<option value=\"" . $month . "/" . $date . "\">" . $month ." / ".$date."</option>";
          }
        @endphp 
        {{-- <option value="">February/ 2023  </option> --}}
        {{-- @endforeach --}}

    </select> 
    </div>



</div>
<div class="form-group"> 
    <div class="aab controls col-md-4 "></div>
    <div class="controls col-md-8 ">
        <button type="submit" class="btn btn-primary btn-lg btn-block" name="edit">Proceed...</button>                      
    </div>
</div> 
</center>

</div>
</form>      
      

@endsection

@section('script')
<!--Chartist Chart-->
<script src="{{ URL::asset('plugins/chartist/js/chartist.min.js') }}"></script>
<script src="{{ URL::asset('plugins/chartist/js/chartist-plugin-tooltip.min.js') }}"></script>
<!-- peity JS -->
<script src="{{ URL::asset('plugins/peity-chart/jquery.peity.min.js') }}"></script>
<script src="{{ URL::asset('assets/pages/dashboard.js') }}"></script>
@endsection
