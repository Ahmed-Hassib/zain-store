@extends('layouts.app')

@section('page-title', __('products.list'))

@section('content')
<div class="pb-20 px-1">
  <div class="card-box mb-30">
    <div class="pd-20">
      <h2 class="text-blue h2">{{__('products.list')}}</h2>
    </div>
    <div class="pb-20">
      <table class="table hover data-table nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>{{__('products.product name')}}</th>
            <th>{{__('products.product code')}}</th>
            <th>{{__('products.quantity')}}</th>
            <th>{{__('products.price')}}</th>
            <th>{{__('products.alert stock')}}</th>
            <th class="datatable-nosort">{{__('Action')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $key => $product)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$product->product_name}}</td>
            <td>{{$product->product_code}}</td>
            <td>{{$product->quantity}}</td>
            <td>{{number_format($product->price, 2)}}</td>
            <td>
              @if ($product->quantity <= $product->alert_stock)
                <span class="badge badge-warning" style="font-size: 12px">
                  <i class="bi bi-exclamation-triangle-fill"></i>
                  {{__('products.low stock', ['num' => $product->alert_stock])}}
                </span>
                @else
                <span class="badge badge-info" style="font-size: 12px">
                  <i class="bi bi-check-circle-fill"></i>
                  {{__('products.bigger stock', ['num' => $product->alert_stock])}}
                </span>
                @endif
            </td>
            <td>
              <a class="btn btn-success py-1" href="{{route('products.edit', ['id' => $product->id])}}"><i
                  class="dw dw-edit2"></i> {{__('ar.edit')}}</a>
              <button class="btn btn-danger py-1" data-toggle="modal" data-target="#confirmation-modal"
                data-id="{{$product->id}}" onclick="put_delete_data_into_form(this)">
                <i class="dw dw-delete-3"></i>
                {{__('ar.delete')}}</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
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
              <input type="hidden" name="id" id="deleted-cat-id" value="">
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

<script>
  function put_delete_data_into_form(clicked_btn) {
    let deleted_id = document.querySelector('#deleted-cat-id');
    deleted_id.value = clicked_btn.dataset.id;
  }
</script>

@push('scripts')
<script src="{{asset('layout/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('layout/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('layout/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('layout/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>

<!-- Datatable Setting js -->
<script src="{{asset('layout/vendors/scripts/datatable-setting.js')}}"></script>
@endpush