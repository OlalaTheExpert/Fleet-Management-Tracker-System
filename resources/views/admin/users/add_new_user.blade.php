<!-- Add -->
<div class="modal  fade"  id="addnew" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>

            <h4 class="modal-title"><b>Add User</b></h4>
            <div class="modal-body">
                
                   
                <div class="card-body text-left">
                    <div class="container-fluid">
                        <form method="POST" action="{{ route('adduser') }}">
                            @csrf
                        <div class="row">  
                            {{-- <input type="hidden" name="role" id="role" value="{{ __('clerk') }}">  
                                           
                         --}}
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Employee') }}</label>
                            <select class="form-control @error('name') is-invalid @enderror" name="id" id="id" required>
                                <option value="" selected>- Select -</option>
                                @foreach($employees as $employee)
                                @if($employee->account_stat==0)
                                <option value="{{$employee->id}}">{{$employee->name}}  </option>
                                @endif
                                @endforeach

                            </select> 
                            {{-- <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter username"/> --}}
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Role') }}</label>
                            <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" required>
                                <option value="" selected>- Select -</option>
                                {{-- <option value="0"> Employee</option> --}}
                                <option value="Data-Clerk"> Data Clerk </option>
                                <option value="Station-Incharge"> Duty Station Incharge</option>
                                
                            </select> 
                            {{-- <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter username"/> --}}
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                           
                    </div>
                </div>
                 
                   
                        <div class="row">
                            <div class="form-group col-md-6 col-lg-6">
                                <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter Password"/>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                                                    
                        
                            <div class="form-group col-md-6 col-lg-6">
                                <label for="password-confirm" class="col-md-12 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm the password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    


                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    {{ __('Register') }}
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