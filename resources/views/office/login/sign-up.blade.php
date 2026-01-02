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
                            <div class="login-form-title mb-3 text-center">
                                <h2>Sign In to Workroom</h2>
                            </div>

                            <form action="{{ route('signup') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <!-- Name -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Your Full Name" required>
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="YourEmail@example.com" required>
                                    </div>

                                    <!-- Mobile -->
                                    <div class="mb-3">
                                        <label for="mobile" class="form-label">Mobile Number</label>
                                        <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="Your Mobile Number" pattern="[0-9]{10}" required>
                                    </div>

                                    <!-- Company Name -->
                                    <div class="mb-3">
                                        <label for="companyName" class="form-label">Company Name</label>
                                        <input type="text" class="form-control" name="company_name" id="companyName" placeholder="Your Company Name">
                                    </div>

                                    <!-- GST Number -->
                                    <div class="mb-3">
                                        <label for="gstNo" class="form-label">GST No.</label>
                                        <input type="text" class="form-control" name="gst_no" id="gstNo" placeholder="Your GST No.">
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="signin-btn mt-3 d-flex justify-content-center">
                                        <button type="submit">Sign Up</button>
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
