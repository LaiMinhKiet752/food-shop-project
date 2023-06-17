@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">SubCategory</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Restore SubCategory</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                @if (!$subcategories->isEmpty())
                <div class="btn-group">
                    <a href="{{ route('restore.all.subcategory.submit') }}" class="btn btn-danger" id="restore_all_subcategory"><i
                            class="lni lni-angle-double-up"> Restore All Subcategory</i></a>
                </div>
            @else
            @endif
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
                                <th>Category Name</th>
                                <th>SubCategory Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategories as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item['category']['category_name'] }}</td>
                                    <td>{{ $item->subcategory_name }}</td>
                                    <td>
                                        <a href="{{ route('restore.subcategory.submit', $item->id) }}"
                                            class="btn btn-warning" id="restore_subcategory">Restore</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Category Name</th>
                                <th>SubCategory Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
