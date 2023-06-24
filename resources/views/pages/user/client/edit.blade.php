@extends('layouts.master')

@section('title')
   Client User Upadte | MicroMac
@endsection

@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <h4>Update Client</h4>
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
                <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Clinet List</a>
                </li>

            </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                @include('layouts.partials.message')
                <!-- Basic Form Inputs card start -->
                <div class="card">
                    <div class="card-block">
                        <form action="{{ route('clients.update',$client->id) }}" role="form" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"> Name <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{ $client->name }}" required="required" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Username <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" value="{{ $client->username }}" required="required" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">User Email <span
                                    class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" value="{{ $client->email }}" required="required" class="form-control">
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">User Role <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select class="custom-select form-control"  name="roles[]">
                                        <option value="">Select An Option</option>
                                         @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                         @endforeach
                                      </select>
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Organization<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select name="organization_id" id="" class="form-control">
                                        <option value="">-Select Organization</option>
                                        @foreach ($organizations as $organization)
                                            <option value="{{ $organization->id }}" {{ $client->organization_id == $organization->id ? 'selected' : '' }}>{{ $organization->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select name="product_id" id="" class="form-control">
                                        <option value="">-Select Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" {{ $client->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Registration Date</label>
                                <div class="col-sm-10">
                                    <input type="text" name="registration_date" class="form-control hasDatepicker" value="{{ $client->registration_date }}" required="required" id="datepicker">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" id="" class="form-control">
                                        <option value="1" {{ $client->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $client->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" value="" required="required"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Password Confirm</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password_confirmation" value="" required="required"
                                        class="form-control">
                                </div>
                            </div> --}}


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">&nbsp;</label>

                                <div style="float: right;" class="col-xs-2"><input type="submit"
                                        class="btn btn-success" value="Save"></div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <!-- Basic Form Inputs card end -->
        </div>
    </div>
    </div>
    @push('custom-scripts')
    <script type="text/javascript">
        jQuery(document).ready(function($)
        {
            $("#datepicker").datepicker( {
                format: "dd-mm-yyyy",
                // viewMode: "months",
                // minViewMode: "months",
                // startDate: '-1d',
                // endDate: '+31d'
            });

        });
    </script>
    @endpush

@endsection
