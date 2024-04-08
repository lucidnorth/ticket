<!doctype HTML>
<html>

<head>
    <title>{{ __('Landing Page') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        .success-msg {
            margin: 10px 0;
            padding: 10px;
            border-radius: 3px 3px 3px 3px;
        }

        .success-msg {
            color: #270;
            background-color: #DFF2BF;
        }
    </style>
</head>

<body>
    @if (Session::has('checkMail'))
        <div class="success-msg">
            <i class="fa fa-check"></i>
            {{ Session::get('checkMail') }}
        </div>
    @endif
    @php
        $setting = \App\Models\Setting::find(1);
    @endphp
    <div class="flex justify-center mt-24">

        <div
            class="bg-white shadow-2xl rounded-md p-5 mt-10 1xl:w-[28%] xl:w-[35%] lg:w-[40%] xmd:w-[50%] md:w-[60%] sm:w-[70%] xxsm:w-full">
            <div class="flex justify-center mt-5">
                <img src="{{$setting->logo ? url('images/upload/' . $setting->logo) : asset('/images/logo.png') }}" alt="" class="h-20 w-auto object-cover">
            </div>
            <p class="font-poppins font-bold text-3xl leading-9 text-black text-center pt-6">
                {{ __('Sign in to your account') }}</p>
            <form action="{{ url('user/login') }}" method="post" data-qa="form-login" name="login">
                @csrf
                <input type="hidden" value="{{ url()->previous() }}" name="url">

                <div class="pt-12">
                    <div
                        class="flex sm:space-x-7 justify-center  xxsm:space-y-5 msm:space-y-0 msm:space-x-5 xsm:space-x-0 xxsm:space-x-0 xxsm:mx-10.0 xxsm:flex-wrap xsm:flex-wrap msm:flex-nowrap">
                        <label for="default-radio-1" class="w-full">
                            <div
                                class="border border-gray-light py-3.5 px-5 rounded-lg text-gray-100 w-full font-normal font-poppins text-base leading-6 flex">
                                <input id="default-radio-1" type="radio" value="user" checked name="type"
                                    class="h-5 w-5 mr-2 border border-gray-light  hover:border-gray-light focus:outline-none">
                                {{ __('User') }}
                            </div>
                        </label>
                        <label for="default-radio-2" class="w-full">
                            <div
                                class="border border-gray-light py-3.5 px-5 rounded-lg text-gray-100  w-full font-normal font-poppins text-base leading-6 flex">
                                <input id="default-radio-2" type="radio" value="org" name="type"
                                    class="select w-5 h-5 mr-2 border border-gray-light hover:border-gray-light focus:outline-none">
                                {{ __('Organizer') }}
                            </div>
                        </label>
                    </div>
                </div>

                <div class="pt-5">
                    <label for="email"
                        class="font-poppins font-medium text-base leading-6 text-black">{{ __('Email') }}</label>
                    <input type="email" name="email" id=""
                        class="w-full text-sm font-poppins font-normal text-black block p-3 z-20 rounded-lg border border-gray-light focus:outline-none"
                        placeholder="Your Email ">
                    @error('email')
                        <div class="_2OcwfRx4" data-qa="email-status-message">{{ $message }}</div>
                    @enderror
                    @if (Session::has('error_msg'))
                        <div class="_2OcwfRx4 text-danger mt-1" data-qa="email-status-message">
                            <strong>{{ Session::get('error_msg') }}</strong>
                        </div>
                    @endif
                </div>
                <div class=" pt-5">
                    <label for="password"
                        class="font-poppins font-medium text-base leading-6 text-black">{{ __('Password') }}</label>
                    <div class="relative">
                        <input type="password" name="password" id="password"
                            class="w-full focus:outline-none text-sm font-poppins font-normal text-black block p-3 z-30 rounded-lg border border-gray-light"
                            placeholder="Password">
                        <span class="absolute right-2.5 bottom-2.5 text-xl font-poppins font-medium text-gray px-2"><i
                                class="fa-regular fa-eye text-primary" id="togglePassword"></i></span>
                        @error('password')
                            <div class="_2OcwfRx4" data-qa="email-status-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-between pt-4">
                    <div class="flex">
                        <input id="default-radio-1" type="checkbox" value="true" name="remember" class="mr-2">
                        <label for=""
                            class="font-poppins font-medium text-xs leading-5 text-black pt-0.5">{{ __('Remember me') }}</label>
                    </div>
                    <div>
                        <a href="{{ url('/user/resetPassword') }}"
                            class="font-poppins font-medium text-xs leading-5 text-primary">{{ __('Forgot your password?') }}</a>
                    </div>
                </div>

                <div class="pt-7">
                    <button
                        class="font-poppins text-white bg-primary leading-4 w-full text-sm font-medium py-4 rounded-lg focus:outline-none">{{ __('Sign In') }}</button>
                </div>
            </form>
            <div class="pt-6 flex justify-center">
                <h1 class="font-poppins font-medium text-base leading-5 pt-4 text-left text-gray">
                    {{ __('Don’t have an account? ') }}
                    <a href="{{ url('/user/register') }}"
                        class="text-primary text-medium text-base">{{ __('Create account') }}</a>
                </h1>
            </div>
        </div>
    </div>
</body>
<script>
    window.addEventListener("DOMContentLoaded", function() {
        const togglePassword = document.querySelector("#togglePassword");

        togglePassword.addEventListener("click", function(e) {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            // toggle the eye / eye slash icon
            this.classList.toggle("fa-eye-slash");
        });
    });
</script>

</html>
