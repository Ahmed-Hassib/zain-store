@extends('layouts.app')

@section('page-title', __('user.profile'))

@section('content')
<div class="pb-10 px-1">
  <div class="card-box mb-30">
    <div class="pd-20">
      <h2 class="text-blue h2">{{__('user.profile')}}</h2>
    </div>
    <div class="pd-20">
      <form action="{{route('user.update')}}" method="POST">
        @csrf
        @method('put')
        <input type="hidden" name="id" value="{{Auth::user()->id}}">
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label for="name">{{__('auth.username')}} <span class="text-danger">*</span></label>
              <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
              value="{{old('name') ? old('name') : Auth::user()->name }}" required>
            </div>
          </div>
          <div class="col-md-2 pt-30">
            <button type="submit" class="btn btn-primary w-100">
              <i class="bi bi-check-all"></i>
              {{__('ar.save')}}</button>
            </div>
          </div>
        </form>
    </div>
  </div>
</div>

<div class="pb-20 px-1">
  <div class="card-box mb-20">
    <div class="pd-20">
      <h2 class="text-blue h2">{{__('user.reset password')}}</h2>
    </div>
    <div class="pd-20">
      <form method="POST" action="{{ route('user.reset_password') }}">
        @csrf
        @method('put')
        <input type="hidden" name="id" value="{{Auth::user()->id}}">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <label for="password">{{ __('auth.new password') }}</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <label for="password-confirm">{{ __('auth.confirm password')}}</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">
            </div>
          </div>
        </div>

        <div class="row justify-content-end mb-0">
          <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
              <i class="bi bi-check-all"></i>
              {{ __('ar.save') }}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection