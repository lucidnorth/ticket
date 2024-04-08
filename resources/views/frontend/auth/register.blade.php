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
    <script src="{{ asset('js/custom.js') }}"></script>

</head>
@php
$setting = \App\Models\Setting::find(1);
@endphp

<body>
    <div class="flex justify-center mt-16">
        <div
            class="bg-white shadow-2xl rounded-md p-5 mt-10 1xl:w-[40%] xl:w-[45%] lg:w-[45%] xmd:w-[55%] md:w-[65%] sm:w-[75%] xxsm:w-full">
            <div class="flex justify-center mt-5">
                <img src="{{$setting->logo ? url('images/upload/' . $setting->logo) : asset('/images/logo.png') }}" alt="" class="h-20 w-auto object-cover">
            </div>
            <p class="font-poppins font-bold text-3xl leading-9 text-black text-center pt-6">
                {{ __('Create an account') }}
            </p>
            <form action="{{ url('user/register') }}" method="post">
                @csrf
                <div class="pt-12">
                    <div
                        class="flex sm:space-x-7 justify-center 1xl:mx-28 xl:mx-20 lg:mx-10 xmd:mx-10 sm:mx-10 msm:mx-10 xxsm:space-y-5 msm:space-y-0 msm:space-x-5 xsm:space-x-0 xxsm:space-x-0 xxsm:mx-10.0 xxsm:flex-wrap xsm:flex-wrap msm:flex-nowrap">
                        <label for="default-radio-1" class="w-full">
                            <div
                                class="border border-gray-light py-3.5 px-5 rounded-lg text-gray-100 w-full font-normal font-poppins text-base leading-6 flex">
                                <input id="default-radio-1" type="radio" value="user" checked name="user_type"
                                    class="user h-5 w-5 mr-2 border border-gray-light  hover:border-gray-light focus:outline-none">
                                <label for="default-radio-1">{{ __('User') }}
                            </div>
                        </label>
                        <label for="default-radio-2" class="w-full">
                            <div
                                class="border border-gray-light py-3.5 px-5 rounded-lg text-gray-100  w-full font-normal font-poppins text-base leading-6 flex">
                                <input id="default-radio-2" type="radio" value="organizer" name="user_type"
                                    class="org w-5 h-5 mr-2 border border-gray-light hover:border-gray-light focus:outline-none">
                                {{ __('Organizer') }}
                            </div>
                        </label>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-5 sm:grid-cols-2 msm:grid-cols-2 xxsm:grid-cols-1">
                    <div class="pt-5">
                        <label for="name"
                            class="font-poppins font-medium text-base leading-6 text-black">{{ __('First Name') }}</label>
                        <input type="text" name="name" required
                            id=""class="w-full text-sm font-poppins font-normal text-black block p-3 z-20 rounded-lg border border-gray-light focus:outline-none"
                            placeholder="{{ __('First Name') }}">
                    </div>
                    <div class="pt-5">
                        <label for="last_name"
                            class="font-poppins font-medium text-base leading-6 text-black">{{ __('Last Name') }}</label>
                        <input type="text" name="last_name" id="" required
                            class="w-full text-sm font-poppins font-normal text-black block p-3 z-20 rounded-lg border border-gray-light focus:outline-none"
                            placeholder="{{ __('Lats Name') }}">
                    </div>

                    <div class="">
                        <label for="number"
                            class="font-poppins font-medium text-base leading-6 text-black">{{ __('Contact Number') }}</label>
                        <div class="flex space-x-3">
                            <div class="w-[35%]">
                                <select id="location" name="Countrycode" class="select2 z-10 w-full " required>
                                    <option value="" disabled selected>{{__('Select Country')}}</option>
                                    @foreach ($phone as $item)
                                        <option class=" " value="{{ $item->phonecode }}">
                                            {{ $item->phonecode . ' ' . $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-[100%]">
                                <input type="number" name="phone" id=""
                                    class="w-full text-sm font-poppins font-normal text-black block p-3 z-20 rounded-md border border-gray-light focus:outline-none"
                                    placeholder="{{ __('Number') }}">
                            </div>
                        </div>
                    </div>
                    <div class="orginput hidden">
                        <label for="organize"
                            class="font-poppins font-medium text-base leading-6 text-black">{{ __('Organization Name') }}</label>
                        <input type="text" name="organize" id=""
                            class="w-full text-sm font-poppins font-normal text-black block p-3 z-20 rounded-lg border border-gray-light focus:outline-none"
                            placeholder="{{ __('Organization Name') }}">
                    </div>
                    <div class=" ">
                        <label for="email"
                            class="font-poppins font-medium text-base leading-6 text-black">{{ __('Email Address') }}</label>
                        <input type="email" name="email" id="" required
                            class="w-full text-sm font-poppins font-normal text-black block p-3 z-20 rounded-lg border border-gray-light focus:outline-none"
                            placeholder="{{ __('Email Address') }}">
                    </div>
                    <div class=" ">
                        <label for="password"
                            class="font-poppins font-medium text-base leading-6 text-black">{{ __('Password') }}</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" required
                                class="w-full focus:outline-none text-sm font-poppins font-normal text-black block p-3 z-30 rounded-lg border border-gray-light"
                                placeholder="{{ __('Password') }}">
                            <span
                                class="absolute right-2.5 bottom-2.5 text-xl font-poppins font-medium text-gray px-2"><i
                                    class="fa-regular fa-eye text-primary" id="togglePassword"></i></span>
                        </div>
                    </div>
                </div>
                <div class="pt-7">
                    <button
                        class="font-poppins text-white bg-primary leading-4 w-full text-sm font-medium py-4 rounded-lg focus:outline-none">{{ __('Create') }}</button>
                </div>
            </form>
            <div class="pt-6 flex justify-center">
                <h1 class="font-poppins font-medium text-base leading-5 pt-4 text-left text-gray">
                    {{ __('Already have an account? ') }}
                    <a href="{{ url('/user/login') }}"
                        class="text-primary text-medium text-base">{{ __('Login') }}</a>
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
    $('.user').on('click', function() {
        $('.orginput').addClass('hidden')
    });
    $('.org').on('click', function() {
        $('.orginput').removeClass('hidden')
    });
</script>

</html>
