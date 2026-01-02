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

    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/login_style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

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

        .location-permission-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            text-align: center;
            padding: 20px;
        }

        .location-btn {
            background-color: #3C2FC0;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            margin-top: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .location-btn:hover {
            background-color: #2a1e9c;
            transform: translateY(-2px);
        }

        .location-btn i {
            margin-right: 8px;
        }

        /*.login-form-container {*/
        /*    display: none;*/
        /*}*/

        .location-message {
            margin-top: 15px;
            font-size: 14px;
            color: #666;
        }
    </style>

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

    <section class="login-form p-4">
        <div class="container-fluid h-100">
            <div class="login-box h-100">
                <div class="row h-100">
                    <div class="col-lg-6 col-md-6 ">
                        <div class="login-left d-flex justify-content-center align-items-center h-100 ">
                            <div class="login-left-content">
                                <h1>Access the Leads panel using your Email and Passcode.</h1>
                                <div class="beyond-img">
                                    <img src="{{ asset('public/admin/assets/images/beyond-whiteboard.png') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="login-right d-flex justify-content-center flex-column h-100">
                            <!-- Location Permission Section -->
                            <!--<div id="locationPermission" class="location-permission-container">-->
                            <!--    <div class="brand-logo mx-auto mb-3">-->
                            <!--        <img src="{{ asset('public/admin/assets/images/tech-logo.svg') }}" alt="">-->
                            <!--    </div>-->
                            <!--    <div class="login-form-title mb-3 text-center">-->
                            <!--        <h2>Location Access Required</h2>-->
                            <!--        <p class="location-message">To access the login form, we need to verify your-->
                            <!--            location first.</p>-->
                            <!--    </div>-->
                            <!--    <button id="grantLocationBtn" class="location-btn">-->
                            <!--        <i class="fas fa-location-arrow"></i> Grant Permission to Live Location-->
                            <!--    </button>-->
                            <!--    <div id="locationStatus" class="location-message mt-3"></div>-->
                            <!--</div>-->

                            <!-- Login Form Section (Initially Hidden) -->
                            <div id="loginForm" class="login-form-container">
                                <div class="brand-logo mx-auto mb-3">
                                    <img src="{{ asset('public/admin/assets/images/tech-logo.svg') }}" alt="">
                                </div>
                                <div class="login-form-title mb-3 text-center">
                                    <h2>Log In to Workroom</h2>
                                </div>

                                <div class="dash-tabs d-flex justify-content-center align-items-center mb-4">
                                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link rounded-pill active" id="pills-Allclient-tab"
                                                data-bs-toggle="pill" data-bs-target="#pills-Allclient" type="button"
                                                role="tab" aria-controls="pills-Allclient" aria-selected="true">
                                                Login with Email
                                            </button>
                                        </li>
                                        {{-- <li class="nav-item" role="presentation">
                                            <button class="nav-link rounded-pill {{ $errors->has('mobile_no') ? 'active' : '' }}"
                                                    id="pills-Activeclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Activeclient"
                                                    type="button" role="tab" aria-controls="pills-Activeclient" aria-selected="false">
                                                Login with Phone
                                            </button>
                                        </li> --}}
                                    </ul>
                                </div>

                                <div class="dash-tabs-content">
                                    <div class="tab-content" id="pills-tabContent">
                                        <!-- Email Login -->
                                        <div class="tab-pane fade show active" id="pills-Allclient" role="tabpanel"
                                            aria-labelledby="pills-Allclient-tab">
                                            <form action="{{ route('employee_login.login') }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email Address</label>
                                                    <input type="email" class="form-control" name="email"
                                                        id="email" value="{{ old('email') }}"
                                                        placeholder="Youremail@gmail.com">
                                                    @error('email')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="password"
                                                        id="password">
                                                    <span toggle="#password-field"
                                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>

                                                    @error('password')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class=" checked-condetion d-flex  justify-content-between my-3">
                                                    <div class="form-check align-items-center d-flex gap-3">
                                                        <input class="form-check-input mt-0" type="checkbox"
                                                            value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Remember me
                                                        </label>
                                                    </div>
                                                    {{-- <a href="{{ route('employee_forget') }}">Forget Password</a> --}}
                                                </div>

                                                <div class="signin-btn mt-3 d-flex justify-content-center ">
                                                    <button type="submit">Log In <span class="iconify"
                                                            data-icon="material-symbols:arrow-right-alt-rounded"
                                                            data-inline="false"
                                                            style="font-size: 24px;"></span></button>
                                                </div>
                                                {{-- <button type="submit" class="btn btn-primary">Log In</button> --}}
                                                {{-- <div class="login-text text-center mt-3">
                                                    <p>Allready have an account,  <a href="{{ route('signup') }}">Sign In</a></p>
                                                    </div> --}}
                                            </form>
                                        </div>

                                        <!-- Phone Login -->
                                        <div class="tab-pane fade {{ $errors->has('mobile_no') ? 'show active' : '' }}"
                                            id="pills-Activeclient" role="tabpanel"
                                            aria-labelledby="pills-Activeclient-tab">
                                            <form action="{{ route('admin.login') }}" method="POST"
                                                onsubmit="setFullMobileNumber()">
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="mobile_no" class="form-label">Mobile Number</label>
                                                    <input type="tel" class="form-control"
                                                        name="mobile_no_display" id="mobile_code"
                                                        value="{{ old('mobile_no') }}" placeholder="123-456-7890">
                                                    <input type="hidden" name="mobile_no" id="full_mobile_no">
                                                    @error('mobile_no')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="password"
                                                        id="password">
                                                    <span toggle="#password-field"
                                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>

                                                    @error('password')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class=" checked-condetion d-flex  justify-content-between my-3">
                                                    <div class="form-check align-items-center d-flex gap-3">
                                                        <input class="form-check-input mt-0" type="checkbox"
                                                            value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Remember me
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="signin-btn mt-3 d-flex justify-content-center ">
                                                    <button type="submit">Log In <span class="iconify"
                                                            data-icon="material-symbols:arrow-right-alt-rounded"
                                                            data-inline="false"
                                                            style="font-size: 24px;"></span></button>
                                                </div>
                                            </form>
                                        </div>
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
    <script src="{{ asset('public/admin/assets/js/login_script.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const activeTab = localStorage.getItem("activeTab");
            if (activeTab) {
                const tabButton = document.querySelector(`button[data-bs-target="${activeTab}"]`);
                if (tabButton) tabButton.click();
            }

            const tabButtons = document.querySelectorAll('[data-bs-target]');
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    localStorage.setItem("activeTab", this.getAttribute("data-bs-target"));
                });
            });

            // Location permission button event
            document.getElementById('grantLocationBtn').addEventListener('click', function() {
                checkLocationPermission();
            });
        });

        // function checkLocationPermission() {
        //     const locationStatus = document.getElementById('locationStatus');

        //     if (!navigator.geolocation) {
        //         locationStatus.innerHTML = '<span style="color: red;">Geolocation is not supported by this browser.</span>';
        //         return;
        //     }

        //     locationStatus.innerHTML = '<span style="color: blue;">Getting your location...</span>';

        //     navigator.geolocation.getCurrentPosition(
        //         function(position) {
        //             const latitude = position.coords.latitude;
        //             const longitude = position.coords.longitude;

        //             locationStatus.innerHTML = '<span style="color: blue;">Checking if you are in the office...</span>';

        //             // Send coordinates to API
        //             console.log(`Latitude : ${latitude}, Longitude : ${longitude}`)
        //             checkOfficeLocation(latitude, longitude);
        //         },
        //         function(error) {
        //             let errorMessage = "Error getting location: ";
        //             switch (error.code) {
        //                 case error.PERMISSION_DENIED:
        //                     errorMessage += "User denied the request for Geolocation.";
        //                     break;
        //                 case error.POSITION_UNAVAILABLE:
        //                     errorMessage += "Location information is unavailable.";
        //                     break;
        //                 case error.TIMEOUT:
        //                     errorMessage += "The request to get user location timed out.";
        //                     break;
        //                 case error.UNKNOWN_ERROR:
        //                     errorMessage += "An unknown error occurred.";
        //                     break;
        //             }
        //             locationStatus.innerHTML = `<span style="color: red;">${errorMessage}</span>`;
        //         }
        //     );
        // }

        // function checkOfficeLocation(lat, lon) {
        //     const locationStatus = document.getElementById('locationStatus');

        //     fetch('https://lightsalmon-quetzal-130864.hostingersite.com/api/check-office', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //             },
        //             body: JSON.stringify({
        //                 lat: lat,
        //                 lon: lon
        //             })
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             if (data.inside_office) {
        //                 locationStatus.innerHTML =
        //                     '<span style="color: green;">✅ You are in the office area. Login form is now available.</span>';
        //                 document.getElementById('locationPermission').style.display = 'none';
        //                 document.getElementById('loginForm').style.display = 'block';
        //             } else {
        //                 locationStatus.innerHTML = `<span style="color: red;">${data.message}</span>`;
        //             }
        //         })
        //         .catch(error => {
        //             console.error('Error checking office location:', error);
        //             locationStatus.innerHTML =
        //                 '<span style="color: red;">Error checking office location. Please try again.</span>';
        //         });
        // }

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
</body>

</html>
