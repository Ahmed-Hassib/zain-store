@extends('layouts.app')

@section('page-title', __('category.add'))

@section('content')
<div class="pb-20 px-1">
  <div class="card-box mb-30">
    <div class="pd-20">
      <h2 class="text-blue h2">{{__('category.add')}}</h2>
    </div>
    <div class="pd-20">
      <form action="{{route('categories.insert')}}" method="POST">
        @csrf
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>{{__('category.name')}} <span class="text-danger">*</span></label>
              <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror"
                value="{{old('category_name')}}" required>
            </div>
          </div>
          <div class="col-md-2 pt-30">
            <button type="submit" class="btn btn-primary w-100">
              <i class="bi bi-plus"></i>
              {{__('ar.add')}}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection