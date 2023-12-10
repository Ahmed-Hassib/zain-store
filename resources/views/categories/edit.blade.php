@extends('layouts.app')

@section('page-title', __('category.edit'))

@section('content')
<div class="pb-20 px-1">
  <div class="card-box mb-30">
    <div class="pd-20">
      <h2 class="text-blue h2">{{__('category.edit')}}</h2>
    </div>
    <div class="pd-20">
      <form action="{{route('categories.update')}}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$category['id']}}">
        <div class="row">
          <div class="col-md-7 col-sm-12">
            <div class="form-group">
              <label>{{__('category.name')}} <span class="text-danger">*</span></label>
              <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror"
                value="{{$category['category_name']}}" required>
            </div>
          </div>
          <div class="col-md-2 pt-30">
            <button type="submit" class="btn btn-primary w-100">
              <i class="bi bi-check-all"></i>
              {{__('ar.save')}}</button>
          </div>
          <div class="col-md-2 pt-30">
            <button type="button" class="btn btn-danger w-100" data-toggle="modal" data-target="#confirmation-modal">
              <i class="bi bi-trash"></i>
              {{__('ar.delete')}}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center font-18">
        <h1 class="h1 text-danger" style="font-size: 80px;">
          <i class="bi bi-exclamation-circle"></i>
        </h1>
        <h4 class="mb-30 weight-500">
          {{__('ar.confirm delete')}}
        </h4>
        <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto">
          <div class="col-6">
            <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
              data-dismiss="modal">
              <i class="fa fa-times"></i>
              {{__('ar.no')}}
            </button>
          </div>
          <div class="col-6">
            <form action="{{route('categories.delete')}}" method="post">
              @csrf
              @method('delete')
              <input type="hidden" name="id" value="{{$category['id']}}">
              <button type="submit" class="btn btn-danger border-radius-100 btn-block confirmation-btn">
                <i class="fa fa-check"></i>
                {{__('ar.yes')}}
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection