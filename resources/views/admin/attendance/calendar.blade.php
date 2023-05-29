
@extends('layouts.master')


@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<style>
.calendar {
  --side-padding: 20px;
  --border-radius: 34px;
  --accent-br: 15px;
  width: 400px;
  
}
.calendar select {
  background-color: #f3f4f6;
  padding: 15px 20px;
}
.calendar__opts, .calendar__buttons {
  background-color: #fff;
  display: grid;
  grid-template-columns: 1fr 1fr;
  column-gap: 15px;
}
.calendar__opts {
  border-top-left-radius: var(--border-radius);
  border-top-right-radius: var(--border-radius);
  padding: 20px var(--side-padding);
}
.calendar__body {
    
  background-image: linear-gradient(to bottom, #f3f4f6, #fff);
}
.calendar__days {
  background-color: #fff;
  padding: 0 var(--side-padding) 10px;
  display: grid;
  grid-template-columns: repeat(7, 1fr);
}
.calendar__days > div {
  text-align: center;
  font-weight: 700\;
  font-size: 1.02rem;
  color: #c5c8ca;
}
.calendar__dates {
  padding: 10px var(--side-padding);
  display: grid;
  grid-template-columns: repeat(7, 1fr);
}
.calendar__date {
  --height: calc(400px / 6 - var(--side-padding));
  text-align: center;
  height: var(--height);
  line-height: var(--height);
  font-weight: 600;
  font-size: 1.02rem;
  cursor: pointer;
  position: relative;
}
.calendar__date::before {
  content: "";
  position: absolute;
  background-color: rgba(255, 255, 255, 0);
  width: 100%;
  height: calc(var(--height) * 0.9);
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border-radius: var(--accent-br);
  transition: background-color 0.3s ease;
}
.calendar__date:not(.calendar__date--selected):not(.calendar__date--grey):hover::before {
  background-color: #ededed;
}
.calendar__date--grey {
  color: #c5c8ca;
  cursor: not-allowed;
}
.calendar__date--selected {
  color: #ff374b;
}
.calendar__date--selected::before {
  background-color: #ffeaec;
  border-radius: 10px;
}
.calendar__date--first-date::before {
  border-top-left-radius: var(--accent-br);
  border-bottom-left-radius: var(--accent-br);
}
.calendar__date--last-date::before {
  border-top-right-radius: var(--accent-br);
  border-bottom-right-radius: var(--accent-br);
}
.calendar__date--range-start::after {
  content: "";
  position: absolute;
  bottom: 3px;
  border-radius: 24px;
  left: 50%;
  transform: translateX(-50%);
  background-color: #ff374b;
  width: 10px;
  height: 4px;
}
.calendar__date--range-end {
  color: #fff;
}
.calendar__date--range-end::before {
  box-shadow: 0 15px 20px -3px rgba(255, 55, 75, 0.35);
  background-color: #ff374b;
  border-radius: var(--accent-br);
  z-index: 1;
}
.calendar__date--range-end::after {
  content: "";
  position: absolute;
  height: calc(var(--height) * 0.9);
  background-color: #ffeaec;
  width: 50px;
  top: 50%;
  right: 50%;
  transform: translateY(-50%);
}
.calendar__date span {
  position: relative;
  z-index: 1;
}
.calendar__buttons {
  padding: 10px var(--side-padding) 20px;
  border-bottom-left-radius: var(--border-radius);
  border-bottom-right-radius: var(--border-radius);
}
.calendar__button {
  cursor: pointer;
}
.calendar__button--grey {
  background-color: #f3f4f6;
}
.calendar__button--primary {
  background-color: #1752ff;
  color: #fff;
  transition: box-shadow 0.3s cubic-bezier(0.21, 0.68, 0.09, 0.27), transform 0.2s linear;
}
.calendar__button--primary:hover {
  box-shadow: 0 20px 30px -13px rgba(23, 82, 255, 0.45);
  transform: translateY(-3px);
}
.calendar__button--primary:active {
  box-shadow: 0 10px 10px -6px rgba(23, 82, 255, 0.45);
  transform: translateY(-1px);
}



select,
button {
  font-family: inherit;
  font-weight: 700;
  font-size: 1.02rem;
  border-radius: 20px;
  outline: none;
  border: 0;
  padding: 15px 20px;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}

select {
  background-image: url("data:image/svg+xml,%3C%3Fxml version='1.0' encoding='utf-8'%3F%3E%3C!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'%3E%3Csvg version='1.1' id='Capa_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='960px' height='560px' viewBox='0 0 960 560' enable-background='new 0 0 960 560' xml:space='preserve'%3E%3Cg id='Rounded_Rectangle_33_copy_4_1_'%3E%3Cpath d='M480,344.181L268.869,131.889c-15.756-15.859-41.3-15.859-57.054,0c-15.754,15.857-15.754,41.57,0,57.431l237.632,238.937 c8.395,8.451,19.562,12.254,30.553,11.698c10.993,0.556,22.159-3.247,30.555-11.698l237.631-238.937 c15.756-15.86,15.756-41.571,0-57.431s-41.299-15.859-57.051,0L480,344.181z'/%3E%3C/g%3E%3C/svg%3E");
  background-size: 24px;
  background-repeat: no-repeat;
  background-position: calc(100% - var(--side-padding)) center;
}
</style>

@section('breadcrumb')
    <div class="col-sm-6">
        <h4 class="page-title text-left">Schedules </h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Schedule</a></li>
 

        </ol>
    </div>
    
   
@endsection


@section('content')
@include('includes.flash')
@if(Session::has('message'))
<div class="alert alert-danger">
  {{Session::get('message')}}
</div>
@elseif(session('Success'))
<div class="alert alert-success">
  {{Session::get('Success')}}
</div>
@endif

<div class="container">
    <div class="row">    

        <div class="col-12">
            <div class="calendar">
                <div class="calendar__opts">
                  <select name="calendar__month" id="calendar__month">
                    <option>Jan</option>
                    <option>Feb</option>
                    <option>Mar</option>
                    <option>Apr</option>
                    <option selected>February</option>
                    <option>Jun</option>
                    <option>Jul</option>
                    <option>Aug</option>
                    <option>Sep</option>
                    <option>Oct</option>
                    <option>Nov</option>
                    <option>Dec</option>
                  </select>
              
                  <select name="calendar__year" id="calendar__year">
                    <option>2017</option>
                    <option>2018</option>
                    <option>2019</option>
                    <option selected>2023</option>
                  </select>
                </div>
              
                <div class="calendar__body">
                  <div class="calendar__days">

                    {{-- @php
                    $monday = strtotime('last monday', strtotime('tomorrow'));
                    $sunday = strtotime('+6 days', $monday);
                    echo "<P>". date('l', $monday) . " to " . date('l', $sunday) . "</P>";    
                                        
                    @endphp --}}
                    <div><?php echo date('D',strtotime("-4 days")); ?></div>
                    <div><?php echo date('D',strtotime("-3 days")); ?></div>
                    <div><?php echo date('D',strtotime("-2 days")); ?></div>
                    <div><?php echo date('D',strtotime("-1 days")); ?></div>
                    <div><?php echo date('D'); ?></div>
                    <div><?php echo date('D',strtotime("1 days")); ?></div>
                    <div><?php echo date('D',strtotime("2 days")); ?></div>
                  </div>
              
                  <div class="calendar__dates">

                    {{-- @php echo date('F j, Y',strtotime("-1 days")); @endphp --}}
                    <div class="calendar__date calendar__date--grey"><span>@php echo date('d',strtotime("-18 days")); @endphp</span></div>
                    <div class="calendar__date calendar__date--grey"><span>@php echo date('d',strtotime("-17 days")); @endphp</span></div>
                    <div class="calendar__date calendar__date--grey"><span>@php echo date('d',strtotime("-16 days")); @endphp</span></div>
                    <div class="calendar__date calendar__date--grey"><span>@php echo date('d',strtotime("-15 days")); @endphp</span></div>
                    <div class="calendar__date calendar__date--grey"><span>@php echo date('d',strtotime("-14 days")); @endphp</span></div>
                    <div class="calendar__date calendar__date--grey"><span>@php echo date('d',strtotime("-13 days")); @endphp</span></div>
                    <div class="calendar__date  calendar__date--selected"><span>@php echo date('d',strtotime("-12 days")); @endphp</span></div>
                    <div class="calendar__date"><span>@php echo date('d',strtotime("-11 days")); @endphp</span></div>
                    <div class="calendar__date"><span>@php echo date('d',strtotime("-10 days")); @endphp</span></div>
                    <div class="calendar__date"><span>@php echo date('d',strtotime("-9 days")); @endphp</span></div>
                    <div class="calendar__date"><span>@php echo date('d',strtotime("-8 days")); @endphp</span></div>
                    <div class="calendar__date"><span>@php echo date('d',strtotime("-7 days")); @endphp</span></div>
                    <div class="calendar__date"><span>@php echo date('d',strtotime("-6 days")); @endphp</span></div>
                    <div class="calendar__date  calendar__date--selected"><span>@php echo date('d',strtotime("-5 days")); @endphp</span></div>
                    <div class="calendar__date"><span>@php echo date('d',strtotime("-4 days")); @endphp</span></div>
                    <div class="calendar__date"><span>@php echo date('d',strtotime("-3 days")); @endphp</span></div>
                    <div class="calendar__date"><span>@php echo date('d',strtotime("-2 days")); @endphp</span></div>
                    <div class="calendar__date"><span>@php echo date('d',strtotime("-1 days")); @endphp</span></div>
                    <div class="calendar__date  calendar__date--last-date calendar__date--range-end"><span>@php echo date('d'); @endphp</span></div>
                    <div class="calendar__date"><span>@php echo date('d',strtotime("1 days")); @endphp</span></div>
                    <div class="calendar__date  calendar__date--selected"><span>@php echo date('d',strtotime("2 days")); @endphp</span></div>
                    
                    <div class="calendar__date"><span>@php echo date('d',strtotime("3 days")); @endphp</span></div>
                    <div class="calendar__date"><span>@php echo date('d',strtotime("4 days")); @endphp</span></div>
                    <div class="calendar__date"><span>@php echo date('d',strtotime("5 days")); @endphp</span></div>
                    <div class="calendar__date"><span>@php echo date('d',strtotime("6 days")); @endphp</span></div>
                    <div class="calendar__date"><span>@php echo date('d',strtotime("7 days")); @endphp</span></div>
                    <div class="calendar__date"><span>@php echo date('d',strtotime("8 days")); @endphp</span></div>
                    <div class="calendar__date  calendar__date--selected"><span>@php echo date('d',strtotime("9 days")); @endphp</span></div>
                  </div>
                </div>
              
                {{-- <div class="calendar__buttons">
                  <button class="calendar__button calendar__button--grey">Back</button>
              
                  <button class="calendar__button calendar__button--primary">Apply</button>
                </div> --}}
              </div>
        </div>

</div> <!-- end row -->

</div>


  
    @foreach ($schedules as $schedule)
        @include('includes.edit_delete_schedule')
    @endforeach

    @include('includes.add_schedule')

@endsection

@endsection
