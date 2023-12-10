@extends('layouts.app')

@section('page-title', __('products.add'))

@section('content')
<div class="pb-20 px-1">
  <div class="card-box mb-30">
    <div class="pd-20">
      <h2 class="text-blue h2">{{__('products.add')}}</h2>
    </div>
    <div class="pd-20">
      <form action="{{route('products.insert')}}" method="POST">
        @csrf
        <div class="row">
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <label for="pr_code">{{__('products.product code')}} <span class="text-danger">*</span></label>
              <input type="text" name="pr_code" id="pr_code" class="form-control @error('pr_code') is-invalid @enderror"
                value="{{old('pr_code')}}" required>
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <label for="pr_name">{{__('products.product name')}} <span class="text-danger">*</span></label>
              <input type="text" name="pr_name" id="pr_name" class="form-control @error('pr_name') is-invalid @enderror"
                value="{{old('pr_name')}}" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <label for="qty">{{__('products.quantity')}} <span class="text-danger">*</span></label>
              <input type="number" name="qty" id="qty" class="form-control @error('qty') is-invalid @enderror"
                value="{{old('qty')}}" required>
            </div>
          </div>
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <label for="parchasing_price">{{__('products.parchasing price')}} <span class="text-danger">*</span></label>
              <input type="text" name="parchasing_price" id="parchasing_price" class="form-control @error('parchasing_price') is-invalid @enderror"
                value="{{old('parchasing_price')}}" required>
            </div>
          </div>
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <label for="price">{{__('products.price')}} <span class="text-danger">*</span></label>
              <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror"
                value="{{old('price')}}" required>
            </div>
          </div>
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <label for="discount_limit">{{__('products.discount limit')}}(%)</label>
              <input type="text" name="discount_limit" id="discount_limit" class="form-control @error('discount_limit') is-invalid @enderror"
                value="{{old('discount_limit')}}">
            </div>
          </div>
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <label for="alert-stock">{{__('products.alert stock')}}</label>
              <input type="text" name="alert-stock" id="alert-stock" class="form-control @error('alert-stock') is-invalid @enderror"
                value="{{old('alert-stock') ? old('alert-stock') : 5}}">
            </div>
          </div>
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <label for="color">{{__('products.color')}}</label>
              <input type="text" name="color" id="color" class="form-control @error('color') is-invalid @enderror"
                value="{{old('color')}}">
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label for="category">{{__('category.category')}}</label>
              <select class="custom-select2 form-control" name="category" id="category" style="width: 100%; height: 38px">
                <option value="none" disabled selected>{{__('category.select category')}}</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->category_name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <label for="desc">{{__('products.description')}}</label>
              <textarea type="text" name="desc" id="desc"
                class="form-control @error('desc') is-invalid @enderror">{{old('desc')}}</textarea>
            </div>
          </div>
        </div>
        <div class="row justify-content-end">
          <div class="col-md-2">
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