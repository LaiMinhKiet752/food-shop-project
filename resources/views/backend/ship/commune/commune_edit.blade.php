@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Commune
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Commune</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Commune</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('all.commune') }}" class="btn btn-primary"><i class="lni lni-arrow-left"> Go
                        Back</i></a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @error('commune_name')
                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                    <div class="text-white">{{ $message }}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @enderror
                            <form method="post" action="{{ route('update.commune') }}" id="myForm">
                                @csrf
                                <input type="hidden" name="id" value="{{ $commune->id }}">
                                <div class="row mb-3 ">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">City, Province Name <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-dark">
                                        <select name="city_id" class="form-select mb-3 single-select"
                                            aria-label="Default select example">
                                            <option></option>
                                            @foreach ($city as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $commune->city_id ? 'selected' : '' }}>
                                                    {{ $item->city_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3 ">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">District Name <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-dark">
                                        <select name="district_id" class="form-select mb-3 single-select"
                                            aria-label="Default select example">
                                            <option></option>
                                            @foreach ($district as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $commune->district_id ? 'selected' : '' }}>
                                                    {{ $item->district_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Commune Name <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="commune_name" class="form-control"
                                            value="{{ $commune->commune_name }}" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4 savedata"
                                            value="Save Changes" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="city_id"]').on('change', function() {
            var city_id = $(this).val();
            if (city_id) {
                $.ajax({
                    url: "{{ url('/district/ajax') }}/" + city_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="district_id"]').html();
                        var d = $('select[name="district_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="district_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .district_name + '</option>');
                        });
                    },

                });
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                commune_name: {
                    required: true,
                    maxlength: 255,
                },
                city_id: {
                    required: true,
                },
                district_id: {
                    required: true,
                },
            },
            messages: {
                commune_name: {
                    required: 'Please enter commune name.',
                    maxlength: 'The commune name must not be greater than 255 characters.',
                },
                city_id: {
                    required: 'Please select a city, province name.',
                },
                district_id: {
                    required: 'Please select a district name.',
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>
@endsection
