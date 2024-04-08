@extends('frontend.master', ['activePage' => 'checkout'])
@section('title', __('Checkout'))
@section('content')
    {{-- content --}}
    <div class="pb-20 bg-scroll min-h-screen" style="background-image: url('images/events.png')">
        {{-- scroll --}}
        <div class="mr-4 flex justify-end z-30">
            <a type="button" href="{{ url('#') }}"
                class="scroll-up-button bg-primary rounded-full p-4 fixed z-20  2xl:mt-[49%] xl:mt-[59%] xlg:mt-[68%] lg:mt-[75%] xxmd:mt-[83%] md:mt-[90%]
                xmd:mt-[90%] sm:mt-[117%] msm:mt-[125%] xsm:mt-[160%]">
                <img src="{{ asset('images/downarrow.png') }}" alt="" class="w-3 h-3 z-20">
            </a>
        </div>
        <input type="hidden" name="flutterwave_key" value="{{ \App\Models\PaymentSetting::find(1)->ravePublicKey }}">
        <input type="hidden" name="email" value="{{ auth()->guard('appuser')->user()->email }}">
        <input type="hidden" name="phone" value="{{ auth()->guard('appuser')->user()->phone }}">
        <input type="hidden" name="name" value="{{ auth()->guard('appuser')->user()->name }}">
        <input type="hidden" name="flutterwave_key" value="{{ \App\Models\PaymentSetting::find(1)->ravePublicKey }}">
        <form action="{{ url('createOrder') }}" method="post" id="ticketorder">
            @csrf
            <input type="hidden" id="razor_key" name="razor_key"
                value="{{ \App\Models\PaymentSetting::find(1)->razorPublishKey }}">

            <input type="hidden" id="stripePublicKey" name="stripePublicKey"
                value="{{ \App\Models\PaymentSetting::find(1)->stripePublicKey }}">
            <input type="hidden" value="{{ $data->ticket_per_order }}" name="tpo" id="tpo">
            <input type="hidden" value="{{ $data->available_qty }}" name="available" id="available">
            <input type="hidden" name="price" id="ticket_price" value="{{ $data->price }}">

            <input type="hidden" name="tax" id="tax_total" value="{{ $data->type == 'free' ? 0 : $data->tax_total }}">
            <input type="hidden" name="payment" id="payment"
                value="{{ $data->type == 'free' ? 0 : $data->price + $data->tax_total }}">
            @php
                $price = $data->price + $data->tax_total;
                if ($data->currency_code == 'USD' || $data->currency_code == 'EUR' || $data->currency_code == 'INR') {
                    $price = $price * 100;
                }
            @endphp
            <input type="hidden" name="stripe_payment" id="stripe_payment"
                value="{{ $data->type == 'free' ? 0 : $price }}">


            <input type="hidden" name="currency_code" id="currency_code" value="{{ $data->currency_code }}">
            <input type="hidden" name="payment_token" id="payment_token">
            <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $data->id }}">
            <input type="hidden" name="coupon_id" id="coupon_id" value="">
            <input type="hidden" name="coupon_discount" id="coupon_discount" value="0">
            <input type="hidden" name="subtotal" id="subtotal" value="">
            <input type="hidden" name="add_ticket" value="">
            <input type="hidden" class="tax_data" name="tax_data" value="{{ $data->tax }}">
            <input type="hidden" name="event_id" value="{{ $data->event_id }}">
            <input type="hidden" name="ticketname" id="ticketname" value="{{ $data->name }}">
            <div
                class="mt-10 3xl:mx-52 2xl:mx-28 1xl:mx-28 xl:mx-36 xlg:mx-32 lg:mx-36 xxmd:mx-24 xmd:mx-32 md:mx-28 sm:mx-20 msm:mx-16 xsm:mx-10 xxsm:mx-5 z-10 relative">
                <div
                    class="flex sm:space-x-6 msm:space-x-0 xxsm:space-x-0 xlg:flex-row lg:flex-col xmd:flex-col xxsm:flex-col">
                    <div class="xlg:w-[75%] xxmd:w-full xxsm:w-full">

                        <div
                            class="flex 3xl:flex-row 2xl:flex-nowrap 1xl:flex-nowrap xl:flex-nowrap xlg:flex-wrap flex-wrap justify-between 3xl:pt-5 xl:pt-5 gap-x-5 xl:w-full xlg:w-full">
                            <div class="">
                                <div
                                    class="w-full shadow-2xl p-5 rounded-lg flex 3xl:flex-nowrap md:flex-wrap xxmd:flex-nowrap sm:flex-wrap msm:flex-wrap xsm:flex-wrap xxsm:flex-wrap bg-white xlg:w-full xmd:w-full 3xl:mb-0 xl:mb-0 xlg:mb-5 xxsm:mb-5">
                                    <img src="{{ asset('images/upload/' . $data->event->image) }}" alt=""
                                        class="rounded-lg w-56 h-56">
                                    <div class="ml-4 2xl:w-[60%] xl:w-full xlg:w-full xmd:w-full xxmd:w-[80%]">

                                        <p class="font-poppins font-bold text-4xl leading-8 text-left pt-3 text-black-100">
                                            {{ $data->event->name }}</p>
                                        <p class="font-poppins font-normal text-sm text-gray-200 leading-8 text-left pt-2">
                                            {{ __('Date') }}</p>
                                        <p class="font-poppins font-medium text-base leading-7 text-gray text-left">
                                            {{ Carbon\Carbon::parse($data->event->start_time)->format('d M Y') }} -
                                            {{ Carbon\Carbon::parse($data->event->end_time)->format('d M Y') }}
                                        </p>

                                        <p class="font-poppins font-normal text-sm text-gray-200 leading-8 text-left pt-2">
                                            {{ __('Location') }}</p>
                                        <p
                                            class="font-poppins font-medium text-base leading-7 text-gray text-left w-[50%]">
                                            {{ $data->event->address }}
                                        </p>
                                        @if ($data->allday == 0)
                                        <div>
                                            <input type="date" name="ticket_date" class="mt-3">
                                            @if ($errors->has('ticket_date'))
                                                <div class="text-danger" >{{ $errors->first('ticket_date') }}</div>
                                            @endif
                                        </div>
                                        @endif
                                    </div>

                                    <div class="md:w-[15%] sm:w-full pt-14">

                                        @if ($data->type == 'paid')
                                            <p class="font-poppins font-medium text-sm leading-7 text-danger text-left">
                                                {{ __('Paid') }}</p>
                                        @else
                                            <p class="font-poppins font-medium text-sm leading-7 text-success text-left">
                                                {{ __('Free') }}</p>
                                        @endif

                                        @if ($data->type == 'paid')
                                            <p
                                                class="font-poppins font-semibold text-3xl leading-7 text-primary text-left pt-5">
                                                {{ $data->currency_code . $data->price }}</p>
                                        @endif
                                        <p class="font-poppins font-medium text-base leading-7 text-black text-left pt-10">
                                            {{ __('Quantity') }}</p>
                                        <div
                                            class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1 pro-qty">

                                            <button data-mdb-ripple="true" id="dec-{{ $data->id }}"
                                                data-mdb-ripple-color="light" data-action="decrement" type="button"
                                                class="border-l dec qtybtn  border-t border-b border-primary bg-primary-light text-primary hover:text-black-700 h-8 w-9 cursor-pointer">
                                                <span class="m-auto text-2xl font-thin ">−</span>
                                            </button>
                                            <div class="text-center ">
                                                <input type="number" id="quantity" readonly name="quantity"
                                                    value="1"
                                                    class=" bg-primary-light outline-none focus:outline-none text-center w-8 font-semibold text-md
                                             hover:text-black focus:text-black md:text-basecursor-default flex items-center text-primary h-8"
                                                    name="custom-input-number" value="1">
                                            </div>
                                            <button data-mdb-ripple="true" data-mdb-ripple-color="light"
                                                data-action="increment" id="inc-{{ $data->id }}" type="button"
                                                class="border-r inc qtybtn border-t border-b border-primary bg-primary-light text-primary hover:text-black-700 h-8 w-9 cursor-pointer">
                                                <span class="m-auto text-2xl font-thin">+</span>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                                <div
                                    class="w-full shadow-2xl p-5 rounded-lg  bg-white xlg:w-full xmd:w-full 3xl:mb-0 xl:mb-0 xlg:mb-5 xxsm:mb-5 mt-5">
                                    <p class="font-poppins font-semibold text-2xl leading-8 text-black pb-3 pt-10">
                                        {{ __('Payment Methods') }}</p>

                                    <div
                                        class="flex md:space-x-5 md:flex-row md:space-y-0 sm:flex-col sm:space-x-0 sm:space-y-5 xxsm:flex-col xxsm:space-x-0 xxsm:space-y-5 mb-5 payments">
                                        <?php $setting = App\Models\PaymentSetting::find(1); ?>
                                        @if ($data->type == 'free')

                                            <div
                                                class="border border-gray-light  p-5 rounded-lg text-gray-100 w-full font-normal font-poppins text-base leading-6 flex
                             ">
                                                {{ __('FREE') }}
                                                <input id="default-radio-1" required type="radio" value="FREE"
                                                    name="payment_type" checked
                                                    class="ml-2 h-5 w-5 mr-2 border border-gray-light  hover:border-gray-light focus:outline-none">

                                            </div>
                                        @else
                                            @if ($setting->paypal == 1)
                                                <div
                                                    class="border border-gray-light  p-5 rounded-lg text-gray-100 w-full font-normal font-poppins text-base leading-6 flex
                                         ">
                                                    <input id="default-radio-1" required type="radio" value="PAYPAL"
                                                        name="payment_type"
                                                        class="h-5 w-5 mr-2 border border-gray-light  hover:border-gray-light focus:outline-none">
                                                    <label for=""><img src="{{ asset('images/paypal.png') }}"
                                                            alt="" class="w-full h-8"></label>
                                                </div>
                                            @endif
                                            @if ($setting->razor == 1)
                                                <div
                                                    class="border border-gray-light p-5 rounded-lg text-gray-100 w-full font-normal font-poppins text-base leading-6 flex">
                                                    <input id="default-radio-1" required type="radio" value="RAZOR"
                                                        name="payment_type"
                                                        class="h-5 w-5 mr-2 border border-gray-light  hover:border-gray-light focus:outline-none">
                                                    <label for=""><img src="{{ asset('images/razorpay.png') }}"
                                                            alt="" class="w-full h-8"></label>
                                                </div>
                                            @endif

                                            @if ($setting->stripe == 1)
                                                <div
                                                    class="border border-gray-light p-5 rounded-lg text-gray-100 w-full font-normal font-poppins text-base leading-6 flex">
                                                    <input id="default-radio-1" required type="radio" value="STRIPE"
                                                        name="payment_type"
                                                        class="h-5 w-5 mr-2 border border-gray-light  hover:border-gray-light focus:outline-none">
                                                    <label for=""><img
                                                            src="http://t3.gstatic.com/images?q=tbn:ANd9GcSJHbnfk81kA_5mIj81yhRy3R2LRx3S11OyMjC68QeONsOp5DXx"
                                                            alt="" class="w-full h-8"></label>
                                                </div>
                                            @endif

                                            @if ($setting->flutterwave == 1)
                                                <div
                                                    class="border border-gray-light p-5 rounded-lg text-gray-100 w-full font-normal font-poppins text-base leading-6 flex
                                 ">
                                                    <input id="default-radio-1" required type="radio"
                                                        value="FLUTTERWAVE" name="payment_type"
                                                        class="h-5 w-5 mr-2 border border-gray-light  hover:border-gray-light focus:outline-none">
                                                    <label for=""><img
                                                            src="https://imtconferences.com/wp-content/uploads/2018/08/Flutterwave_IMTC-300x150.jpg"
                                                            alt="" class="w-full h-8"></label>
                                                </div>
                                            @endif

                                            @if (
                                                $setting->cod == 1 ||
                                                    ($setting->flutterwave == 0 && $setting->stripe == 0 && $setting->paypal == 0 && $setting->razor == 0))
                                                <div
                                                    class="border border-gray-light p-5 rounded-lg text-gray-100 w-full font-normal font-poppins text-base leading-6 flex
                             ">
                                                    <input id="default-radio-1" type="radio" value="LOCAL"
                                                        name="payment_type"
                                                        class="h-5 w-5 mr-2 border border-gray-light  hover:border-gray-light focus:outline-none">
                                                    <label for=""><img
                                                            src="https://i.pinimg.com/236x/09/51/c2/0951c247dcd42d66662a622ab5451f19.jpg"
                                                            alt="" class="w-full h-8"></label>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="paypal-button-section hidden mt-4 mx-auto">
                                        <div id="paypal-button-container"> </div>
                                    </div>
                                    <div class="stripe-form-section hide mt-4  mx-auto">
                                        <div class="stripe-form "> </div>
                                    </div>
                                    <div class="">
                                        <button type="submit" id="form_submit"
                                            class="font-poppins font-medium text-lg leading-6 text-white bg-primary w-full rounded-md py-3"
                                            <?php
                                        if(!isset($_REQUEST['payment_type'])&&$setting->cod == 0 ){ ?> disabled <?php
                                        } ?>><i
                                                class="fa pr-2 fa-check-square"></i>{{ __('Place Order') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($data->type == 'paid')

                        <div class="xlg:w-[25%] xxmd:w-full xxsm:w-full">
                            <div class="p-4 bg-white shadow-lg rounded-md space-y-5">
                                <p class="font-poppins font-semibold text-2xl leading-8 text-black pb-3">
                                    {{ __('Payment Summary') }}</p>
                                <div
                                    class="flex justify-between border border-primary rounded-md py-5 xxsm:flex-wrap sm:flex-nowrap xlg:px-0">
                                    <input type="text" value="" name="coupon_code" id="coupon_id"
                                        class=" focus:outline-none font-poppins font-normal text-base leading-6 text-white-100 ml-5 1xl:w-44 xl:w-36
                            xlg:w-28"
                                        placeholder="Coupon code">
                                    <button type="button" id="apply" name="apply"
                                        class="font-poppins font-medium text-base leading-6 text-primary focus:outline-none mr-5">{{ __('Apply') }}</button>
                                </div>
                                <div class="couponerror"></div>
                                <p class="font-poppins font-semibold text-base leading-8 text-black ">
                                    {{ __('Taxes and charges') }}</p>
                                <div class="taxes  border border-primary rounded-md p-2">

                                    @foreach ($data->tax as $key => $item)
                                        <input type="hidden" class="amount_type" name="amount_type"
                                            value="{{ $item->amount_type }}">
                                        <div class="flex justify-between">
                                            <p class="font-poppins font-normal text-lg leading-7 text-gray-200 ">
                                                {{ $item->name }}
                                                @if ($item->amount_type == 'percentage')
                                                    ({{ $item->price . '%' }})
                                                @endif
                                            </p>
                                            <p class="font-poppins font-medium text-lg leading-7 text-gray-300">
                                                @if ($item->amount_type == 'percentage')
                                                    @php
                                                        $result = ($data->price * $item->price) / 100;
                                                        $formattedResult = round($result, 2);
                                                    @endphp
                                                    {{ $formattedResult }}
                                                @else
                                                    {{ $item->price }}
                                                @endif
                                            </p>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="flex justify-between">
                                    <p class="font-poppins font-normal text-lg leading-7 text-gray-200">
                                        {{ __('Total Tax amount') }}</p>
                                    <p class="font-poppins font-medium text-lg leading-7 text-gray-300 totaltax">
                                        {{ $data->tax_total }}
                                    </p>
                                </div>
                                <div class="flex justify-between">
                                    <p class="font-poppins font-normal text-lg leading-7 text-gray-200">
                                        {{ __('Tickets amount') }}</p>
                                    <p class="font-poppins font-medium text-lg leading-7 text-gray-300">
                                        {{ $data->price }}
                                    </p>
                                </div>

                                <div class="flex justify-between border-dashed border-b border-gray-light pb-5">
                                    <p class="font-poppins font-normal text-lg leading-7 text-gray-200">
                                        {{ __('Coupon discount') }}</p>
                                    <p class="font-poppins font-medium text-lg leading-7 text-gray-300 discount">00.00</p>
                                </div>
                                <div class="flex justify-between">
                                    <p
                                        class="font-poppins font-semibold text-xl leading-7 text-primary xlg:text-lg 1xl:text-xl">
                                        {{ __('Total amount') }}</p>
                                    <p
                                        class="font-poppins font-semibold text-2xl leading-7 text-primary xlg:text-lg 1xl:text-2xl subtotal">
                                        {{ $data->price + $data->tax_total }}</p>
                                </div>

                            </div>
                        </div>
                    @endif
                </div>
            </div>
    </div>
@endsection
