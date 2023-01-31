@extends('front.frontShow.master')
@section('content')
    <div class="container">
        <br><br>
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12 pt-5">
                <div class="card" style="">
                    <div class="card-header" style="text-align: center;background-color:#FFE4C4">{{__('sentence.login_as_admin')}}</div>
                   <div class="text-center ">
                       <i class="fa fa-user-circle fa-5x pt-3 pb-2"></i>
                   </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('adminlogin') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('sentence.email') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 mt-5">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('sentence.password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary ">
                                        {{ __('sentence.login') }}
                                    </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection












