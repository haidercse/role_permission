@extends('layouts.master')

@section('title')
    Client User List | Ticket System
@endsection

@section('content')
    <!-- Page-header start -->
    <div class="page-header ">
        <div class="page-header-title">
            <h4> Client List</h4>
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
                <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Client
                        List</a>
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

                        <div class="float-right mt-2 mr-1">
                            <a href="{{ route('clients.create') }}" id="" class="btn btn-primary"><i
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
                                                        style="width: 120.25px;">Employee Name</th>

                                                    <th style="white-space: normal; width: 744.688px;" width="20%"
                                                        class="sorting_desc" tabindex="0" aria-controls="order-table"
                                                        rowspan="1" colspan="1" aria-sort="descending"
                                                        aria-label="Roll Description: activate to sort column ascending">
                                                        Organization</th>
                                                    <th style="white-space: normal; width: 744.688px;" width="20%"
                                                        class="sorting_desc" tabindex="0" aria-controls="order-table"
                                                        rowspan="1" colspan="1" aria-sort="descending"
                                                        aria-label="Roll Description: activate to sort column ascending">
                                                        Username</th>
                                                    <th style="white-space: normal; width: 744.688px;" width="20%"
                                                        class="sorting_desc" tabindex="0" aria-controls="order-table"
                                                        rowspan="1" colspan="1" aria-sort="descending"
                                                        aria-label="Roll Description: activate to sort column ascending">
                                                        Role </th>
                                                    <th width="10%" class="sorting" tabindex="0"
                                                        aria-controls="order-table" rowspan="1" colspan="1"
                                                        aria-label="Action: activate to sort column ascending"
                                                        style="width: 83.2344px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($clients as $client)
                                                    <tr role="row" class="odd">
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $client->name }}</td>
                                                        <td>{{ $client->organization->name ?? '' }}</td>
                                                        <td>{{ $client->username }}</td>
                                                        <td>
                                                            @foreach ($client->roles as $role)
                                                                {{ $role->name }}
                                                            @endforeach
                                                        </td>


                                                        <td>
                                                            <a href="{{ route('clients.show', $client->id) }}"
                                                                title="edit" class="edit"><img
                                                                    src="{{ asset('images/default/lock.gif') }}"
                                                                    border="0" alt="Payment">
                                                            </a>
                                                            <a href="{{ route('clients.edit', $client->id) }}"
                                                                title="edit" class="edit"><img
                                                                    src="{{ asset('images/default/edit1.gif') }}"
                                                                    border="0" alt="Payment">
                                                            </a>

                                                            <a href="javascript:" onclick="$(this).find('#del_form').submit();" title="Delete" class="delete">
                                                                <img src="{{ asset('images/default/delete1.gif') }}"
                                                                border="0" alt="Payment">
                                                                <form id="del_form" action="{{route('clients.destroy', $client->id)}}" method="POST"
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
