<!doctype HTML>
<html>

<head>
    <title>{{ __('Forget Password') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
    @php
        $setting = \App\Models\Setting::find(1);
    @endphp
    <div class="flex justify-center mt-32">
        <div
            class="bg-white shadow-2xl rounded-md p-5 mt-10 1xl:w-[28%] xl:w-[35%] lg:w-[40%] xmd:w-[50%] md:w-[60%] sm:w-[70%] xxsm:w-full">
            <div class="flex justify-center mt-5">
                <img src="{{$setting->logo ? url('images/upload/' . $setting->logo) : asset('/images/logo.png') }}" alt="" class="h-20 w-auto object-cover">
            </div>
            <p class="font-poppins font-bold text-3xl leading-9 text-black text-center pt-6">{{ __('Forgot Password') }}
            </p>
            <form action="{{ url('user/resetPassword') }}" method="post" data-qa="form-login" name="login">
                @csrf

                <div class="pt-12">
                    <div
                        class="flex sm:space-x-7 justify-center  xxsm:space-y-5 msm:space-y-0 msm:space-x-5 xsm:space-x-0 xxsm:space-x-0 xxsm:mx-10.0 xxsm:flex-wrap xsm:flex-wrap msm:flex-nowrap">
                        <div
                            class="border border-gray-light py-3.5 px-5 rounded-lg text-gray-100 w-full font-normal font-poppins text-base leading-6 flex">
                            <input id="default-radio-1" type="radio" value="user" checked name="type"
                                class="h-5 w-5 mr-2 border border-gray-light  hover:border-gray-light focus:outline-none">
                            <label for="">{{ __('User') }}</label>
                        </div>
                        <div
                            class="border border-gray-light py-3.5 px-5 rounded-lg text-gray-100  w-full font-normal font-poppins text-base leading-6 flex">
                            <input id="default-radio-1" type="radio" value="org" name="type"
                                class="w-5 h-5 mr-2 border border-gray-light hover:border-gray-light focus:outline-none">
                            <label for="" class="">{{ __('Organizer') }}</label>
                        </div>
                    </div>
                </div>

                <div class="pt-5">
                    <label for="email"
                        class="font-poppins font-medium text-base leading-6 text-black">{{ __('Email') }}</label>
                    <input type="email" name="email" id=""
                        class="w-full text-sm font-poppins font-normal text-black block p-3 z-20 rounded-lg border border-gray-light focus:outline-none"
                        placeholder="john@gmail.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="pt-7">
                    <button
                        class="font-poppins text-white bg-primary leading-4 w-full text-sm font-medium py-4 rounded-lg focus:outline-none">{{ __('Reset Password') }}</button>

                </div>
            </form>
            <div class="pt-6 flex justify-center">
                <a href="{{ url('user/login') }}" class="font-poppins text-primary text-medium text-base">{{ __('Back to login') }}</a>
            </div>
        </div>
    </div>
</body>

</html>
