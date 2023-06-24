@extends('layouts.master')

@section('title')
    Roles List | MicroMac
@endsection

@section('content')
    <div class="">
        <!-- Page-header start -->
        <div class="page-header ">
            <div class="page-header-title">
                <h4>User Roles List</h4>
            </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.html">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">User
                            Roles</a>
                    </li>

                </ul>
            </div>
        </div>
        <!-- Page-header end -->
        <!-- Page-body start -->
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    @include('layouts.partials.message')
                    <!-- Multi-column table start -->
                    <div class="card">
                        <div class="">
                            <div class="float-right mr-2 mt-2">
                                <a href="{{ route('roles.create') }}" id="" class="btn btn-primary"><i
                                        class="ion-plus"></i>Create
                                    New</a>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <div id="order-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <table id="dataTables"
                                                class="table table-striped table-bordered nowrap dataTable no-footer"
                                                role="grid" aria-describedby="order-table_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th width="2%" class="sorting" tabindex="0"
                                                            aria-controls="order-table" rowspan="1" colspan="1"
                                                            aria-label="Sl.: activate to sort column ascending"
                                                            style="width: 16px;">Sl.</th>
                                                        <th width="10%" class="sorting" tabindex="0"
                                                            aria-controls="order-table" rowspan="1" colspan="1"
                                                            aria-label="Roll Name: activate to sort column ascending"
                                                            style="width: 120.25px;">Roll Name</th>
                                                        <th width="10%" class="sorting" tabindex="0"
                                                            aria-controls="order-table" rowspan="1" colspan="1"
                                                            aria-label="Is Internal: activate to sort column ascending"
                                                            style="width: 83.2344px;">Is Internal</th>
                                                        <th style="white-space: normal; width: 744.688px;" width="20%"
                                                            class="sorting_desc" tabindex="0" aria-controls="order-table"
                                                            rowspan="1" colspan="1" aria-sort="descending"
                                                            aria-label="Roll Description: activate to sort column ascending">
                                                            Roll Description</th>
                                                        <th width="10%" class="sorting" tabindex="0"
                                                            aria-controls="order-table" rowspan="1" colspan="1"
                                                            aria-label="Action: activate to sort column ascending"
                                                            style="width: 83.2344px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($roles as $role)
                                                        <tr role="row" class="odd">
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td>{{ $role->name }}</td>
                                                            <td>
                                                                @if ($role->is_internal == 1)
                                                                    <span> Yes </span>
                                                                @else
                                                                    <span> No </span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $role->description }}</td>

                                                            <td>
                                                                <a href="{{ route('roles.edit', $role->id) }}"
                                                                    title="edit" class="edit"><img
                                                                        src="{{ asset('images/default/edit1.gif') }}"
                                                                        border="0" alt="Payment">
                                                                </a>&nbsp;

                                                                <a href="javascript:" onclick="$(this).find('#del_form').submit();" title="Delete" class="delete">
                                                                    <img src="{{ asset('images/default/delete1.gif') }}"
                                                                    border="0" alt="Payment">
                                                                    <form id="del_form" action="{{route('roles.destroy', $role->id)}}" method="POST"
                                                                          onsubmit="return confirm_type_delete()">
                                                                          @method('DELETE')
                                                                        @csrf
                                                                    </form>
                                                                </a>

                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Multi-column table end -->
                </div>
            </div>

        </div>
        <!-- Page-body end -->
    </div>
    @push('custom-scripts')
    <script>
         //Delete
      function confirm_type_delete() {
          if (confirm('Are you sure want to delete?')) {
              return true;
          } else {
              return false;
          }
      }
    </script>
  @endpush
@endsection

