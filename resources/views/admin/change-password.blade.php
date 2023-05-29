@extends('layouts.employee')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Change Password</h3>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
        @if(Session::has('message'))
        <div class="alert alert-danger">
          {{Session::get('message')}}
        </div>
      @elseif(session('Success'))
        <div class="alert alert-success">
          {{Session::get('Success')}}
        </div>
        @endif
                <form method="POST" action="{{route('changePasswordPost', auth()->user()->id)}}">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label>Old password </label>
                        <input type="password" name="current-password" id="current-password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>New password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirm password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
    
</div>
<!-- /Page Wrapper -->
@endsection