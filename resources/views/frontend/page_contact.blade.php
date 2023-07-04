@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Contact
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>HOME</a>
            <span></span> Contact
        </div>
    </div>
</div>
<div class="page-content pt-150 pb-150">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                <div class="row">
                    <div class="col-lg-6 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h1 class="mb-5">Contact US</h1>
                                </div>
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $error }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endforeach
                                @endif
                                <form method="post" action="{{ route('contact.submit') }}" id="myForm">
                                    @csrf
                                    <div class="form-group">
                                        <input class="form-control" type="email" name="email"
                                            placeholder="Your Email *" value="{{ old('email') }}" />
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control" type="text" name="subject"
                                            placeholder="Subject *" value="{{ old('subject') }}" />
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" name="message" placeholder="Message *" style="height: 200px;">{{ old('message') }}</textarea>
                                    </div>

                                    <div class="form-group mb-30">
                                        <button type="submit"
                                            class="btn btn-fill-out btn-block hover-up font-weight-bold">Submit</button>
                                    </div>
                                    <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will
                                        be used to support your experience throughout this website, to manage
                                        access to your account, and for other purposes described in our privacy
                                        policy</p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="card-login" style="margin-top: 62px;">
                                    <h6 class="mb-15">Info Location:</h6>
                                    <p><i class="fa-solid fa-location-dot"></i>&nbsp;&nbsp; 65 Huynh Thuc Khang, Ben
                                        Nghe
                                        Ward, District 1, Ho Chi Minh City, Vietnam.</p>
                                    <p><i class="fa-solid fa-phone"></i>&nbsp;&nbsp; 1900 999</p>
                                    <p><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp; support.nestshop@gmail.com</p>
                                </div>
                            </div>
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
                email: {
                    required: true,
                    email: true,
                },
                subject: {
                    required: true,
                    maxlength: 255,
                },
                message: {
                    required: true,
                },
            },
            messages: {
                email: {
                    required: 'Please enter your email.',
                    email: 'The email must be a valid email address.',
                },
                subject: {
                    required: 'Please enter a subject for the email.',
                    maxlength: 'The subject must not be greater than 255 characters.',
                },
                message: {
                    required: 'Please enter your message.',
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
