@extends('layouts.app')

@section('page-title', __('sales.new'))

@section('stylesheets')
<style>
  .table thead th {
    padding: 5px 10px;
  }
</style>
@endsection


@section('content')
<div class="pb-10 px-1">
  <div class="card-box mb-30 p-3">
    <div class="card-title">
      <h2 class="text-blue h2">{{__('sales.new')}}</h2>
    </div>
    <div class="mb-10 sales-invoice-inputs">
      <div class="row">
        <div class="col-sm-12 col-md-2">
          <div class="form-group mb-0">
            <label for="sales_num">{{__('invoices.number')}}</label>
            <input type="text" id="sales_num" name="sales_num" class="form-control"
              value="{{Illuminate\Support\Facades\DB::select(" SHOW TABLE STATUS LIKE 'orders'")[0]->Auto_increment}}"
              disabled>
          </div>
        </div>
        <div class="col-sm-12 col-md-2">
          <div class="form-group mb-0">
            <label for="date">{{__('invoices.date')}}</label>
            <input type="date" id="date" name="date" class="form-control" value="{{date('Y-m-d')}}" disabled>
          </div>
        </div>
        <div class="col-sm-12 col-md-2">
          <div class="form-group mb-0">
            <label for="client_name">{{__('invoices.client name')}}</label>
            <input type="text" id="client_name" name="client_name" class="form-control" value="{{old('client_name')}}">
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="form-group mb-0">
            <label for="client_address">{{__('invoices.client address')}}</label>
            <input type="text" id="client_address" name="client_address" class="form-control"
              value="{{old('client_address')}}">
          </div>
        </div>
      </div>
    </div>
    <div class="mb-10">
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <select class="custom-select2 form-control" id="productId" name="product" style="width: 100%">
            <option value="none" disabled selected>{{__('products.select product')}}</option>
            @foreach ($products as $key => $item)
            <option value="{{$item->id}}">{{$item->product_name}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-12 col-md-2">
          <button class="btn btn-primary" id="addMoreProductBtnId"><i class="bi bi-plus-lg"></i>
            {{__('ar.add')}}</button>
        </div>
      </div>
    </div>

    <div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 50px">#</th>
            <th style="width: max(250px, 350px);">{{__('products.product name')}}</th>
            <th style="width: 100px;">{{__('products.quantity')}}</th>
            <th style="width: 100px;">{{__('products.discount')}}(%)</th>
            <th style="width: 100px;">{{__('products.price/unit')}}</th>
            <th style="width: 100px;">{{__('products.total price')}}</th>
            <th style="width: 100px;">{{__('products.in stock')}}</th>
            <th class="text-center" style="width: 40px"></th>
          </tr>
        </thead>
        <tbody id="addMoreProductContainer">
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  const products = <?php echo $products ?>
</script>
<script>
  (function() {

    const addMoreProductBtn = document.querySelector('#addMoreProductBtnId');

    addMoreProductBtn.addEventListener('click', function(evt){
      evt.preventDefault()
      // get product id
      let product_id = Number(document.querySelector('#productId').value);

      if (typeof product_id != 'NaN') {
        selected_product = products.find(product => product.id === product_id)
      }

      console.log(selected_product)
    })

  })()
</script>
@endsection