<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/login_style.css')}}">
</head>
<body>



<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>


<script>
   @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('otp') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('verifyOtp') }}";
            }
        });
@endif

@if (session('danger'))
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session('danger') }}',
        confirmButtonColor: '#d33',
        confirmButtonText: 'OK'
    });
@endif

</script>

     <section class="login-form p-4">
        <div class="container-fluid h-100">
            <div class="login-box h-100">
                <div class="row h-100">
                    <div class="col-lg-6 col-md-6 ">
                        <div class="login-left d-flex justify-content-center align-items-center h-100 ">
                           <div class="login-left-content">
                                <h1>Access the CRMS panel using your Email and Passcode.</h1>
                                <div class="beyond-img">
                                    <img src="{{ asset('public/admin/assets/images/beyond-whiteboard.png')}}" alt="">
                                </div>
                           </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="login-right  d-flex justify-content-center flex-column h-100">
                        <div class="brand-logo mx-auto mb-3">
                            <img src="{{ asset('public/admin/assets/images/logo-d.png')}}" alt="">
                        </div>
                            <div class="login-form-title mb-3 text-center">
                                <h2>Forget your password.</h2>
                            </div>

                            <form action="{{ route('forget') }}" method="post">@csrf
                                <div class="row">

                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Email Address</label>
                                        <input type="text" class="form-control" name="email" id="Name" placeholder="">
                                        @error('email')
                                        <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    </div>


                                    <div class="sms-notify  mt-3">
                                    <span class="iconify" data-icon="fluent:important-12-filled" data-inline="false" style="font-size: 16px;"></span>
                                    <p> A password reset link has been sent to your registered email address.</p>
                                    </div>

                                    <div class="signin-btn mt-3 d-flex justify-content-center ">
                                        <button type="submit" >Submit <span class="iconify" data-icon="material-symbols:arrow-right-alt-rounded" data-inline="false" style="font-size: 24px;"></span></button>
                                    </div>
                                    <div class="login-text text-center mt-3">
                                    <p>Allready have an account,  <a href="sign-up.php">Sign In</a></p>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
     </section>


     <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        // -----Country Code Selection
        $("#mobile_code").intlTelInput({
            initialCountry: "in",
            separateDialCode: true,
            // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
        });
    </script>
</body>
</html>
