@extends('layouts.master')
@section('title')
    Create Permission | MicroMac
@endsection


@section('content')

    <div class="page-header ">
        <div class="page-header-title">
            <h4>Add User Permissions</h4>
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
                <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">User
                        Permissions</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('permissions.create') }}">Add User Permissions</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partials.message')
                    <div class="card">

                        <div class="card-body">
                            <form action="{{ route('permissions.store') }}" method="POST">
                                @csrf

                                <div class="add_item">
                                    <div class="form-row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Group Name </label>
                                                <input type="text" name="group_name" class="form-control" id="group_name">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name">Permission Name</label>
                                                <input type="text" name="name[]" class="form-control" id="name">
                                            </div>
                                        </div>

                                        <div class="col-md-1" style="margin-top: 35px">
                                            <span class="btn btn-success btn-sm addeventmore"><i class="fas fa-plus-circle"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>
                            <div style="display: none;">
                                <div class="whole_extra_item_add" id="whole_extra_item_add">
                                    <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                                        <div class="form-row">
                                            {{-- <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Group Name </label>
                                                    <input type="text" name="group_name[]" class="form-control" id="group_name">
                                                </div>

                                            </div> --}}
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="name">Permission Name</label>
                                                    <input type="text" name="name[]" class="form-control" id="name">
                                                </div>
                                            </div>

                                            <div class=" form-group col-md-2">
                                                <div class="form-row" style="margin-top: 35px">
                                                    <span class="btn btn-sm badge-info mr-1 addeventmore"><i
                                                            class="fas fa-plus-circle"></i></span>
                                                    <span class="btn btn-sm badge-danger removeeventmore"><i
                                                            class="fas fa-minus-circle"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('custom-scripts')
            <script type="text/javascript">
                $(document).ready(function() {
                    var counter = 0;
                    $(document).on("click", ".addeventmore", function() {
                        var whole_extra_item_add = $("#whole_extra_item_add").html();
                        $(this).closest(".add_item").append(whole_extra_item_add);
                        counter++;
                    });
                    $(document).on("click", ".removeeventmore", function(event) {
                        var whole_extra_item_add = $("#whole_extra_item_add").html();
                        $(this).closest(".delete_whole_extra_item_add").remove();
                        counter -= 1;
                    });
                })
            </script>
        @endpush
    @endsection

