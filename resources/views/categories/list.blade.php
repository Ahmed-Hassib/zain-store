@extends('layouts.app')

@section('page-title', __('category.categories'))

@section('content')
<div class="pb-10 px-1">
  <div class="card-box mb-30">
    <div class="pd-20">
      <h2 class="text-blue h2">{{__('category.categories')}}</h2>
      <form action="" method="POST" id="operations">
        @csrf
        @method('delete')
        <div class="row">
          <div class="form-group col-sm-3">
            <label for="operation">{{__('ar.operations')}}</label>
            <select class="form-control" name="operation" id="operation" required>
              <option value="none" selected disabled>{{__('ar.select operation')}}</option>
              <option value="{{route('categories.truncate')}}">{{__('ar.truncate')}}</option>
            </select>
          </div>
          <div class="col-sm-3 pt-30">
            <button type="button" class="btn btn-outline-primary" id="confirm-operation"
              onclick="check_select(this.form)">
              <i class="bi bi-check-all"></i>
              {{__('ar.save')}}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- show all categories --}}
<div class="pb-20 px-1">
  <div class="card-box mb-30">
    <div class="pd-20">
      <h2 class="text-blue h2">{{__('category.categories list')}}</h2>
    </div>
    <div class="pb-20">
      <table class="table data-table nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>{{__('category.name')}}</th>
            <th>{{__('products.#products')}}</th>
            <th class="datatable-nosort">{{__('Action')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $key => $category)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$category->category_name}}</td>
            <td>{{ \App\Models\Product::where('category_id', $category->id)->count() }}</td>
            <td>
              <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-3 px-1">
                  <a class="btn btn-success py-1 w-100" href="{{route('categories.edit', ['id' => $category->id ])}}"
                    role="button">
                    <i class="dw dw-edit2"></i> {{__('ar.edit')}}</a>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3 px-1 mt-sm-1 mt-lg-0">
                  <form action="{{route('categories.delete')}}" id="delete-category-{{$category->id}}"
                    name="delete-category" method="POST">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="id" id="deleted-cat-id" value="{{$category->id}}">
                    <button type="button" class="btn btn-danger py-1 w-100" data-toggle="modal"
                      data-target="#confirmation-modal" onclick="clicked_delete_button(this)"
                      form="delete-category-{{$category->id}}">
                      <i class="dw dw-delete-3"></i> {{__('ar.delete')}}</button>
                  </form>
                </div>
              </div>
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
            <button type="button" class="btn btn-danger border-radius-100 btn-block confirmation-btn"
              id="confirm-delete" onclick="submit_form(this)">
              <i class="fa fa-check"></i>
              {{__('ar.yes')}}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

<script>
  function clicked_delete_button(btn) {
    // get confirm delete button
    let confirm_delete = document.querySelector('#confirm-delete');
    // get target form id
    confirm_delete.dataset.formId = btn.form.getAttribute('id');
  }

  function submit_form(confirm_btn) {
    // get deleted form
    let delete_form = document.querySelector(`#${confirm_btn.dataset.formId}`);
    // submit form
    delete_form.submit();
  }

  function check_select(form) {
    var formData = new FormData(form);
    // output as an object
    let op = Object.fromEntries(formData)['operation'];
    // check select value
    if (op == 'undefined' || typeof op == 'undefined') {
      swal({
        type: 'error',
        title: 'عفواً',
        text: 'يجب إختيار العملية المطلوبة',
        timer: 3000
      });
    } else {
      let swal_al = swal({
      title: 'هل أنت متأكد؟',
      text: "!لن تتمكن من التراجع عن هذا",
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'نعم، حذف الكل',
      cancelButtonText: 'تراجع',
      confirmButtonClass: 'btn btn-outline-danger margin-5',
      cancelButtonClass: 'btn btn-secondary margin-5',
      buttonsStyling: false
      }).then(function (action, ac) {        
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
        let dismis_actions = ['cancel', 'overlay', 'close'];
        // get action
        let action_ = action['dismiss'] == undefined ? action['value'] : action['dismiss'];
        // check dismiss
        if (dismis_actions.includes(action_)) {
          swal({
            title: 'تم التراجع',
            text: 'أنت الآن في امان.. إطمئن',
            type: 'info'
          });
        } else if (action_) {
          // set form action
          form.action = op;
          // submit form
          form.submit();
        }
      })
    }
  }
</script>

<template id="my-template">
  <swal-title>
    Save changes to "Untitled 1" before closing?
  </swal-title>
  <swal-icon type="warning" color="red"></swal-icon>
  <swal-button type="confirm">
    Save As
  </swal-button>
  <swal-button type="cancel">
    Cancel
  </swal-button>
  <swal-button type="deny">
    Close without Saving
  </swal-button>
  <swal-param name="allowEscapeKey" value="false" />
  <swal-param name="customClass" value='{ "popup": "my-popup" }' />
  <swal-function-param name="didOpen" value="popup => console.log(popup)" />
</template>

@push('scripts')
{{-- js --}}
<script src="{{asset('layout/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('layout/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('layout/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('layout/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
{{-- add sweet alert --}}
<script src="{{asset('layout/src/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
<script src="{{asset('layout/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>
{{-- Datatable Setting js --}}
<script src="{{asset('layout/vendors/scripts/datatable-setting.js')}}"></script>
@endpush