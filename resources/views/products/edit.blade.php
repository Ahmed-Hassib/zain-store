@extends('layouts.app')

@section('page-title', __('products.edit'))

@section('content')
<div class="pb-20 px-1">
  <div class="card-box mb-30">
    <div class="pd-20">
      <h2 class="text-blue h2">{{__('products.edit')}}</h2>
    </div>
    <div class="pd-20">
      <form action="{{ route('products.update') }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$product_data['id']}}">
        <div class="row">
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <label>{{__('products.product code')}} <span class="text-danger">*</span></label>
              <input type="text" name="pr_code" class="form-control @error('pr_code') is-invalid @enderror"
                value="{{$product_data['product_code']}}" required>
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <label>{{__('products.product name')}} <span class="text-danger">*</span></label>
              <input type="text" name="pr_name" class="form-control @error('pr_name') is-invalid @enderror"
                value="{{$product_data['product_name']}}" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <label>{{__('products.quantity')}} <span class="text-danger">*</span></label>
              <input type="number" name="qty" class="form-control @error('qty') is-invalid @enderror"
                value="{{$product_data['quantity']}}" required>
            </div>
          </div>
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <label>{{__('products.parchasing price')}} <span class="text-danger">*</span></label>
              <input type="text" name="parchasing price" class="form-control @error('parchasing price') is-invalid @enderror"
                value="{{$product_data['parchasing_price']}}" required>
            </div>
          </div>
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <label>{{__('products.price')}} <span class="text-danger">*</span></label>
              <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                value="{{$product_data['price']}}" required>
            </div>
          </div>
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <label>{{__('products.discount limit')}}(%)</label>
              <input type="text" name="discount_limit" class="form-control @error('discount_limit') is-invalid @enderror"
                value="{{$product_data['discount_limit']}}">
            </div>
          </div>
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <label>{{__('products.alert stock')}}</label>
              <input type="text" name="alert-stock" class="form-control @error('alert-stock') is-invalid @enderror"
                value="{{$product_data['alert_stock']}}">
            </div>
          </div>
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <label>{{__('products.color')}}</label>
              <input type="text" name="color" class="form-control @error('color') is-invalid @enderror"
                value="{{$product_data['color']}}">
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>{{__('category.category')}}</label>
              <select class="custom-select2 form-control" name="category" style="width: 100%; height: 38px">
                <option value="none" disabled selected>{{__('category.select category')}}</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}" @if ($category->id == $product_data['category_id']) selected
                  @endif>{{$category->category_name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <label>{{__('products.description')}}</label>
              <textarea type="text" name="desc"
                class="form-control @error('desc') is-invalid @enderror">{{$product_data['description']}}</textarea>
            </div>
          </div>
        </div>
        <div class="row justify-content-end">
          <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
              <i class="bi bi-check-all"></i>
              {{__('ar.save')}}
            </button>
          </div>
          <div class="col-md-2">
            <button type="button" class="btn btn-danger w-100" data-toggle="modal" data-target="#confirmation-modal">
              <i class="bi bi-trash"></i>
              {{__('ar.delete')}}
            </button>
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
            <form action="{{route('products.delete')}}" method="post">
              @csrf
              @method('delete')
              <input type="hidden" name="id" value="{{$product_data['id']}}">
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