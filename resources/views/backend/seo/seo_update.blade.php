@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Seo Setting
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Seo</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Seo Setting</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.seo.setting.update') }}" id="myForm">
                                @csrf
                                <input type="hidden" name="id" value="{{ $seo->id }}">

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Meta Title </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="meta_title" class="form-control"
                                            value="{{ $seo->meta_title }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Meta Author </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="meta_author" class="form-control"
                                            value="{{ $seo->meta_author }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Meta Keyword </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="meta_keyword" class="form-control"
                                            value="{{ $seo->meta_keyword }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Meta Description </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <textarea name="meta_description" class="form-control" style="height: 200px; width: 100%;">{{ $seo->meta_description }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
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
        $('#myForm').validate({
            rules: {
                meta_title: {
                    maxlength: 255,
                },
                meta_author: {
                    maxlength: 255,
                },
                meta_keyword: {
                    maxlength: 255,
                },
                meta_description: {
                    maxlength: 500,
                },
            },
            messages: {
                meta_title: {
                    maxlength: 'The title must not be greater than 255 characters.',
                },
                meta_author: {
                    maxlength: 'The author must not be greater than 255 characters.',
                },
                meta_keyword: {
                    maxlength: 'The keyword must not be greater than 255 characters.',
                },
                meta_description: {
                    maxlength: 'The description must not be greater than 500 characters.',
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
