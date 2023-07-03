@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Subscriber
@endsection
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Subscriber</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Subscribers: <span
                            class="badge rounded-pill bg-danger">{{ count($subscribers) }}</span></li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Subscriber Email</th>
                            <th>Created at</th>
                            <th>Verified at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscribers as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ date('m-d-Y H:i:s', strtotime($item->created_at)) }}</td>
                                <td>{{ date('m-d-Y H:i:s', strtotime($item->updated_at)) }}</td>
                                <td>
                                    <a href="{{ route('admin.delete.subscriber', $item->id) }}" class="btn btn-danger"
                                        id="delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Subscriber Email</th>
                            <th>Created at</th>
                            <th>Verified at</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
