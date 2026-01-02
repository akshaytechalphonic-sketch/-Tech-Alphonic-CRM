<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up</title>
</head>
<body>

</body>
</html><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/login_style.css')}}">
</head>
<body>




<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
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
                            <div class="brand-logo">
                                <img src="{{ asset('public/admin/assets/images/logo-d.png')}}" alt="">

                            </div>
                                <h1>Your place to work
                                Plan. Create. Control.</h1>
                                <div class="beyond-img">
                                    <img src="{{ asset('public/admin/assets/images/beyond-whiteboard.png')}}" alt="">

                                </div>
                           </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="login-right  d-flex justify-content-center flex-column h-100">
                            <div class="login-form-title mb-3 text-left">
                                <h2>Sign In to Workroom</h2>
                            </div>
                            <form action="{{ route('setPassword') }}" method="post"> @csrf
                                <div class="row">
                                    <div class="mb-6">
                                        <label for="" class="form-label">Enter New Password</label>
                                         <div class="code-inputs d-flex">
                                            @php
                                                 $email = Session::get('otp_email');
                                            @endphp
                                            <input type="hidden" class="form-control" name="email" value="{{ $email }}" id="Name" placeholder="">
                                            <input type="password" class="form-control" name="password" id="Name" placeholder="">
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password Confirmation</label>
                                            <input type="password" class="form-control" name="password_confirmation" id="password">
                                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>

                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                       @error('password')
                                       <div class="text-danger">
                                           <strong>{{ $message }}</strong>
                                       </div>
                                      @enderror


                                    </div>


                                    <div class="signin-btn mt-3 d-flex justify-content-start ">
                                        <button type="submit" >Submit <span class="iconify" data-icon="material-symbols:arrow-right-alt-rounded" data-inline="false" style="font-size: 24px;"></span></button>
                                    </div>
                                    <div class="login-text text-left mt-3">
                                    <p>Don’t have an account,  <a href="login.php">Log In</a></p>
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
