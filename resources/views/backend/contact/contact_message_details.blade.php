@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Contact
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Contact</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Reply Contact Message</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.contact.message') }}" class="btn btn-primary"><i class="lni lni-arrow-left"> Go
                        Back</i></a>
            </div>
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
                        <form id="myForm" method="post" action="{{ route('admin.contact.message.send.reply') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $messages->id }}">
                            <input type="hidden" name="email" value="{{ $messages->email }}">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email :</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <input type="text" value="{{ $messages->email }}" class="form-control"
                                        readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Subject :</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <input type="text" value="{{ $messages->subject }}" class="form-control"
                                        readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Message :</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <textarea class="form-control" style="width: 100%; height: 150px;" readonly>{{ $messages->message }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email Reply Subject :</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <textarea name="subject" class="form-control" style="width: 100%; height: 50px;"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email Reply Content :</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <textarea name="message" class="form-control" style="width: 100%; height: 200px;"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-success px-4" value="Send Mail" />
                                </div>
                            </div>
                        </form>
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
                subject: {
                    required: true,
                },
                message: {
                    required: true,
                },
            },
            messages: {
                subject: {
                    required: 'Please enter email reply subject.',
                },
                message: {
                    required: 'Please enter email reply content.',
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
