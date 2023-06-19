@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Blog Post </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Blog Category </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.blog.post') }}" class="btn btn-primary"><i class="lni lni-arrow-left"> Go
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
                                @error('post_image')
                                    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                        <div class="text-white">{{ $message }}</div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @enderror
                                <form id="myForm" method="post" action="{{ route('update.blog.post') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $blogpost->id }}">
                                    <input type="hidden" name="old_image" value="{{ $blogpost->post_image }}">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Blog Category <span class="text-danger">*</span></h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-dark">
                                            <select name="category_id" class="form-select form-control single-select">
                                                <option></option>
                                                @foreach ($blogcategory as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $category->id == $blogpost->category_id ? 'selected' : '' }}>
                                                        {{ $category->blog_category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Blog Post</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="post_title" class="form-control"
                                                value="{{ $blogpost->post_title }}" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Blog Short Description <span class="text-danger">*</span>
                                            </h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <textarea name="post_short_description" class="form-control" rows="5" cols="5">{{ $blogpost->post_short_description }}
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Blog Long Description <span class="text-danger">*</span></h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <textarea id="mytextarea" name="post_long_description">{!! $blogpost->post_long_description !!}</textarea>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Blog Post Image <span class="text-danger">*</span></h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="file" name="post_image" class="form-control" id="image" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"> </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage" src="{{ asset($blogpost->post_image) }}" alt="Admin"
                                                style="width: 250px; height: 120px;">
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
                    category_id: {
                        required: true,
                    },
                    post_title: {
                        required: true,
                        maxlength: 255,
                    },
                    post_short_description: {
                        required: true,
                        maxlength: 500,
                    },
                },
                messages: {
                    category_id: {
                        required: 'Please select a category for the post.',
                    },
                    post_title: {
                        required: 'Please enter a title for the post.',
                        maxlength: 'The title of the post must not be greater than 255 characters.',
                    },
                    post_short_description: {
                        required: 'Please enter short description for the post.',
                        maxlength: 'The short description of the post must not be greater than 500 characters.',
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
