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
                                <h2>Sign In to Woorkroom</h2>
                            </div>
                            <form action="{{ route('verifyOtp') }}" method="post"> @csrf
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Code from SMS</label>
                                        <div class="code-inputs d-flex gap-3">
                                            <input type="text" name="otp1" maxlength="1" class="code-box" oninput="moveToNext(this, 'otp2')" onkeydown="moveToPrev(event, 'otp1')" autofocus/>
                                            <input type="text" name="otp2" maxlength="1" class="code-box" oninput="moveToNext(this, 'otp3')" onkeydown="moveToPrev(event, 'otp1')"/>
                                            <input type="text" name="otp3" maxlength="1" class="code-box" oninput="moveToNext(this, 'otp4')" onkeydown="moveToPrev(event, 'otp2')"/>
                                            <input type="text" name="otp4" maxlength="1" class="code-box" oninput="moveToNext(this, 'otp5')" onkeydown="moveToPrev(event, 'otp3')"/>
                                            <input type="text" name="otp5" maxlength="1" class="code-box" oninput="moveToNext(this, 'otp6')" onkeydown="moveToPrev(event, 'otp4')"/>
                                            <input type="text" name="otp6" maxlength="1" class="code-box" onkeydown="moveToPrev(event, 'otp5')"/>
                                        </div>

                                        @error('otp')
                                        <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror


                                    </div>
                                    {{-- <div class="sms-notify  mt-3">
                                    <span class="iconify" data-icon="fluent:important-12-filled" data-inline="false" style="font-size: 16px;"></span>
                                    <p> SMS was sent to your number +1 345 673-56-67.
                                    It will be valid for 01:25</p>
                                    </div> --}}

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



     <script>
        function moveToNext(current, nextFieldId) {
            if (current.value.length === current.maxLength) {
                const nextField = document.querySelector(`input[name=${nextFieldId}]`);
                if (nextField) {
                    nextField.focus();
                }
            }
        }

        function moveToPrev(event, prevFieldId) {
            if (event.key === "Backspace" && event.target.value.length === 0) {
                const prevField = document.querySelector(`input[name=${prevFieldId}]`);
                if (prevField) {
                    prevField.focus();
                }
            }
        }
    </script>
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
