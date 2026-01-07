<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/login_style.css')}}">
</head>




<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>


<script>
   @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('otp') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });

@endif

</script>

<body>

    <style>
        .dash-tabs .nav {
            background-color: #ffffff;
            padding: 4px;
            border-radius: 24px;
            box-shadow: 0px 0px 12px 0px #e3e3e3;
        }

        .dash-tabs .nav .nav-item .nav-link.active {
            color: #ffffff;
            background-color: #3C2FC0;
            font-weight: 700;
        }

        .dash-tabs .nav .nav-item .nav-link {
            color: #242E45;
            padding: 9px 40px;
            font-size: 16px;
            font-weight: 400;
        }
    </style>


    <section class="login-form p-4">
        <div class="container-fluid h-100">
            <div class="login-box h-100">
                <div class="row h-100">
                    <div class="col-lg-6 col-md-6 ">
                        <div class="login-left d-flex justify-content-center align-items-center h-100 ">
                            <div class="login-left-content">
                                <h1>Access the Leads panel using your Email and Passcode.</h1>
                                <div class="beyond-img">
                                    <img src="{{ asset('public/admin/assets/images/beyond-whiteboard.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="login-right  d-flex justify-content-center flex-column h-100">
                            <div class="brand-logo mx-auto mb-3">
                                <img src="{{ asset('public/admin/assets/images/tech-logo.svg')}}" alt="">
                            </div>
                            <div class="login-form-title mb-3 text-center">
                                <h2>Log In to Workroom</h2>
                            </div>

                            <div class="dash-tabs d-flex justify-content-center align-items-center mb-4">
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link rounded-pill active"
                                                id="pills-Allclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Allclient"
                                                type="button" role="tab" aria-controls="pills-Allclient" aria-selected="true">
                                            Login with Email
                                        </button>
                                    </li>
                                    <li class="nav-item d-none" role="presentation">
                                        <button class="nav-link rounded-pill {{ $errors->has('mobile_no') ? 'active' : '' }}"
                                                id="pills-Activeclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Activeclient"
                                                type="button" role="tab" aria-controls="pills-Activeclient" aria-selected="false">
                                            Login with Phone
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <div class="dash-tabs-content">
                                <div class="tab-content" id="pills-tabContent">
                                    <!-- Email Login -->
                                    <div class="tab-pane fade show active" id="pills-Allclient"
                                         role="tabpanel" aria-labelledby="pills-Allclient-tab">
                                        <form action="{{ route('admin.login') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                       value="{{ old('email') }}" placeholder="Youremail@gmail.com">
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password" id="password">
                                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                                                @error('password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class=" checked-condetion d-flex  justify-content-between my-3">
                                                <div class="form-check align-items-center d-flex gap-3">
                                                    <input class="form-check-input mt-0" type="checkbox" value="" id="flexCheckDefault" required>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Default checkbox
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="signin-btn mt-3 d-flex justify-content-center ">
                                                <button type="submit" >Log In <span class="iconify" data-icon="material-symbols:arrow-right-alt-rounded" data-inline="false" style="font-size: 24px;"></span></button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Phone Login -->
                                    <div class="tab-pane fade {{ $errors->has('mobile_no') ? 'show active' : '' }}" id="pills-Activeclient"
                                         role="tabpanel" aria-labelledby="pills-Activeclient-tab">
                                        <form action="{{ route('admin.login') }}" method="POST" onsubmit="setFullMobileNumber()">
                                            @csrf

                                            <div class="mb-3">
                                                <label for="mobile_no" class="form-label">Mobile Number</label>
                                                <input type="tel" class="form-control" name="mobile_no_display" id="mobile_code"
                                                       value="{{ old('mobile_no') }}" placeholder="123-456-7890">
                                                <input type="hidden" name="mobile_no" id="full_mobile_no">
                                                @error('mobile_no')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">assword</label>
                                                <input type="password" class="form-control" name="password" id="password">
                                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                                                @error('password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class=" checked-condetion d-flex  justify-content-between my-3">
                                                <div class="form-check align-items-center d-flex gap-3">
                                                    <input class="form-check-input mt-0" type="checkbox" value="" id="flexCheckDefault" required>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Default checkbox
                                                    </label>
                                                </div>
                                                <a href="forget.php">
                                                    Forget Password
                                                </a>
                                            </div>
                                            <div class="signin-btn mt-3 d-flex justify-content-center ">
                                                <button type="submit" >Log In <span class="iconify" data-icon="material-symbols:arrow-right-alt-rounded" data-inline="false" style="font-size: 24px;"></span></button>
                                            </div>
                                            {{-- <div class="login-text text-center mt-3">
                                                <p>Allready have an account,  <a href="Sign-up.php">Sign In</a></p>
                                                </div> --}}


                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
    <script src="{{ asset('public/admin/assets/js/login_script.js')}}"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const activeTab = localStorage.getItem("activeTab");
        if (activeTab) {
            const tabButton = document.querySelector(`button[data-bs-target="${activeTab}"]`);
            if (tabButton) tabButton.click();
        }

        const tabButtons = document.querySelectorAll('[data-bs-target]');
        tabButtons.forEach(button => {
            button.addEventListener('click', function () {
                localStorage.setItem("activeTab", this.getAttribute("data-bs-target"));
            });
        });
    });

    </script>



<script>
    $("#mobile_code").intlTelInput({
        initialCountry: "in",
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js",
    });

    // Set full mobile number before form submission
    function setFullMobileNumber() {
        const fullNumber = $("#mobile_code").intlTelInput("getNumber");
        console.log("Full Number:", fullNumber); // Debug log

        if (fullNumber) {
            document.getElementById('full_mobile_no').value = fullNumber;
            return true; // Allow form submission
        } else {
            alert('Please enter a valid mobile number.');
            return false; // Prevent form submission
        }
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {

        const togglePassword = document.querySelector('.toggle-password');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {

            if (password.type === "password") {
                password.type = "text";
                this.classList.remove("fa-eye");
                this.classList.add("fa-eye-slash");
            } else {
                password.type = "password";
                this.classList.remove("fa-eye-slash");
                this.classList.add("fa-eye");
            }

        });
    });
</script>


</body>

</html>
