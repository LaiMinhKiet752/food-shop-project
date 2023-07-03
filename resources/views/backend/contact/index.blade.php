@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Contact
@endsection
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Contact</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Contact Messages: <span
                            class="badge rounded-pill bg-danger">{{ count($message) }}</span></li>
                </ol>
            </nav>
        </div>
        {{-- @if (Auth::user()->can('brand.add'))
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.brand') }}" class="btn btn-primary"><i class="lni lni-plus"> Add New</i></a>
                </div>
            </div>
        @endif --}}
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
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Sent at</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($message as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ Str::limit($item->subject, 30, '...') }}</td>
                                <td>{{ Str::limit($item->message, 30, '...') }}</td>
                                <td>{{ date('m-d-Y H:i:s', strtotime($item->created_at)) }}</td>
                                @if ($item->status == 0)
                                    <td>
                                        <span class="badge rounded-pill bg-dark" style="font-size: 13px;">Unanswered</span>
                                    </td>
                                @else
                                    <td><span class="badge rounded-pill bg-success"
                                            style="font-size: 13px;">Responded</span></td>
                                @endif
                                <td>
                                    <a href="{{ route('admin.contact.message.details', $item->id) }}"
                                        class="btn btn-info" title="Details"><i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.contact.message.delete', $item->id) }}" class="btn btn-danger" title="Delete" id="delete"><i
                                            class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Sent at</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
