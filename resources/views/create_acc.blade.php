@extends('layouts.main')
@section('content')
<section class="overflow-hidden h-screen" style="background: url({{asset('gradia-assets/images/hero/bg.png')}}) no-repeat; background-size: cover;">
    <section>
        <div class="flex items-center justify-between px-8 py-5">
            <div class="w-auto">
                <div class="flex flex-wrap items-center">
                    <div class="w-auto mr-14">
                        <a href="/">
                            <img src="{{asset('images/logo.png')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="w-auto">
                <div class="flex flex-wrap items-center">
                    @if(Auth::user())
                        <div class="w-auto hidden lg:block">
                            <a href="/app" class="group relative font-heading block py-2 px-5 text-lg text-white border-2 border-white overflow-hidden rounded-10">
                                <div class="absolute top-0 left-0 transform -translate-y-full group-hover:-translate-y-0 h-full w-full bg-white transition ease-in-out duration-500"></div>
                                <p class="relative z-10 group-hover:text-gray-800">Dashboard</p>
                            </a>
                        </div>
                    @else
                        <div class="w-auto hidden lg:block">
                            <a href="/app/login" class="group relative font-heading block py-2 px-5 text-lg text-white border-2 border-white overflow-hidden rounded-10">
                                <div class="absolute top-0 left-0 transform -translate-y-full group-hover:-translate-y-0 h-full w-full bg-white transition ease-in-out duration-500"></div>
                                <p class="relative z-10 group-hover:text-gray-800">Login</p>
                            </a>
                        </div>
                    @endif
                    <div class="w-auto lg:hidden">
                        <a href="#">
                            <svg class="navbar-burger text-gray-800" width="51" height="51" viewbox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="56" height="56" rx="28" fill="currentColor"></rect>
                                <path d="M37 32H19M37 24H19" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden navbar-menu fixed top-0 left-0 bottom-0 w-4/6 sm:max-w-xs z-50">
            <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-80"></div>
            <nav class="relative z-10 px-9 py-8 bg-white h-full">
                <div class="flex flex-wrap justify-between h-full">
                    <div class="w-full">
                        <div class="flex items-center justify-between -m-2">
                            <div class="w-auto p-2">
                                <a class="inline-block" href="#">
                                    <img src="{{ asset('gradia-assets/logos/gradia-name-black.svg')}}" alt="">
                                </a>
                            </div>
                            <div class="w-auto p-2">
                                <a class="navbar-burger" href="#">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 18L18 6M6 6L18 18" stroke="#111827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center py-8 w-full">
                    </div>
                    <div class="flex flex-col justify-end w-full">
                        <div class="flex flex-wrap">
                            @if(Auth::user())
                                <div class="w-full">
                                    <a href="/app" class="group relative p-0.5 font-heading block w-full text-lg text-gray-900 font-medium bg-gradient-cyan overflow-hidden rounded-10">
                                        <div class="absolute top-0 left-0 transform -translate-y-full group-hover:-translate-y-0 h-full w-full bg-gradient-cyan transition ease-in-out duration-500"></div>
                                        <div class="py-2 px-5 bg-white rounded-lg">
                                            <p class="relative z-10">Dashboard</p>
                                        </div>
                                    </a>
                                </div>
                            @else

                                <div class="w-full">
                                    <a href="/app/login" class="group relative p-0.5 font-heading block w-full text-lg text-gray-900 font-medium bg-gradient-cyan overflow-hidden rounded-10">
                                        <div class="absolute top-0 left-0 transform -translate-y-full group-hover:-translate-y-0 h-full w-full bg-gradient-cyan transition ease-in-out duration-500"></div>
                                        <div class="py-2 px-5 bg-white rounded-lg">
                                            <p class="relative z-10">Login</p>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </section>
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-between -m-6 pt-10 pb-40">
            <div class="w-full lg:w-5/12 xl:w-1/2 p-6">
                <div class="p-5">
                    <div class="w-full p-6">
                        <form action="{{ route('create.account') }}" method="POST">
                            @csrf
                            @method('POST')
                        <div class="md:max-w-xl text-center mx-auto">
                            <h2 class="mb-4 font-heading font-bold text-gray-50 text-6xl sm:text-7xl">Ready to get started?</h2>
                            <p class="mb-11 text-lg text-gray-500">Create your account</p>
                            <div class="flex flex-wrap max-w-md mx-auto -m-2 mb-5">
                                <div class="w-full p-2">
                                    <input class="w-full px-5 py-3.5 text-gray-500 placeholder-gray-500 bg-white outline-none focus:ring-4 focus:ring-gray-500 border border-gray-200 rounded-lg" type="text" placeholder="Full name" name="name" required>
                                </div>
                                <div class="w-full p-2">
                                    <input class="w-full px-5 py-3.5 text-gray-500 placeholder-gray-500 bg-white outline-none focus:ring-4 focus:ring-gray-500 border border-gray-200 rounded-lg" type="email" placeholder="Email address" name="email" required>
                                </div>
                                <div class="w-full p-2">
                                    <input class="w-full px-5 py-3.5 text-gray-500 placeholder-gray-500 bg-white outline-none focus:ring-4 focus:ring-gray-500 border border-gray-200 rounded-lg" type="password" placeholder="Password" name="password" required>
                                </div>
                                <div class="w-full p-2">
                                    <input class="w-full px-5 py-3.5 text-gray-500 placeholder-gray-500 bg-white outline-none focus:ring-4 focus:ring-gray-500 border border-gray-200 rounded-lg" type="text" placeholder="Business Name" name="business_name" required>
                                </div>
                                <div class="w-full p-2 mt-4">
                                    <button type="submit"
                                       class="group relative p-0.5 font-heading block w-full text-lg text-white font-medium bg-gradient-cyan overflow-hidden rounded-10">
                                        <div
                                            class="absolute top-0 left-0 transform -translate-y-full group-hover:-translate-y-0 h-full w-full bg-gradient-cyan transition ease-in-out duration-500"></div>
                                        <div class="py-2 px-5 bg-gray-900 rounded-lg">
                                            <p class="relative z-10">Create Account</p>
                                        </div>
                                    </button>

                                </div>
                            </div>
                            <p class="text-base text-gray-500">
                                <span>Already have an account?</span>
                                <a class="text-gray-50 hover:text-gray-300" href="/app/login">Login now</a>
                            </p>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="w-full lg:w-7/12 xl:w-1/2 p-6">
                <div class="max-w-max mx-auto">
                    <div class="flex flex-wrap justify-center -m-3 mb-3">
                        <div class="w-full p-3">
                            <div class="mx-auto w-64 p-3 bg-white transform hover:-translate-y-3 transition ease-out duration-1000 rounded-2xl">
                                <div class="flex flex-wrap -m-2">
                                    <div class="w-auto p-2">
                                        <img src="{{ asset('images/hash.png')}}" alt="" class="h-10">
                                    </div>
                                    <div class="w-auto p-2">
                                        <p class="font-heading text-base text-gray-900">*388* USSD</p>
                                        <p class="mb-2 text-sm text-gray-500">Get it Instantly</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap justify-center max-w-max -m-3 mb-3">
                        <div class="w-full sm:w-1/2 p-3">
                            <div class="mx-auto w-64 p-3 bg-white transform hover:-translate-y-3 transition ease-out duration-1000 rounded-2xl">
                                <div class="flex flex-wrap -m-2">
                                    <div class="w-auto p-2">
                                        <img src="{{ asset('images/api.png')}}" alt="" class="h-10">
                                    </div>
                                    <div class="w-auto p-2">
                                        <p class="font-heading text-base text-gray-900">Bulk SMS APIs</p>
                                        <p class="mb-2 text-sm text-gray-500">for thirdy part integration</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full sm:w-1/2 p-3">
                            <div class="mx-auto w-64 p-3 bg-white transform hover:-translate-y-3 transition ease-out duration-1000 rounded-2xl">
                                <div class="flex flex-wrap -m-2">
                                    <div class="w-auto p-2">
                                        <img src="{{ asset('images/two-way.png')}}" alt="" class="h-10">
                                    </div>
                                    <div class="w-auto p-2">
                                        <p class="font-heading text-base text-gray-900">Two-Way SMS</p>
                                        <p class="mb-2 text-sm text-gray-500">Surveys, Chat Bots etc</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap justify-center max-w-max -m-3 mb-3 xl:-ml-20">
                        <div class="w-full sm:w-1/2 p-3">
                            <div class="mx-auto w-64 p-3 bg-white transform hover:-translate-y-3 transition ease-out duration-1000 rounded-2xl">
                                <div class="flex flex-wrap -m-2">
                                    <div class="w-auto p-2">
                                        <img src="{{ asset('images/announcements.png')}}" alt="">
                                    </div>
                                    <div class="w-auto p-2">
                                        <p class="font-heading text-base text-gray-900">Bulk Notifications</p>
                                        <p class="mb-2 text-sm text-gray-500">Push Notifications
                                            for marketing e.t.c</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full sm:w-1/2 p-3">
                            <div class="mx-auto w-64 p-3 bg-white transform hover:-translate-y-3 transition ease-out duration-1000 rounded-2xl">
                                <div class="flex flex-wrap -m-2">
                                    <div class="w-auto p-2">
                                        <img src="{{ asset('images/money.png')}}" alt="" class="h-12">
                                    </div>
                                    <div class="w-auto p-2">
                                        <p class="font-heading text-base text-gray-900">USSD for Payments</p>
                                        <p class="mb-2 text-sm text-gray-500">Recieve payments from 
                                            clients via USSD code</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap justify-center max-w-max -m-3">
                        <div class="w-full sm:w-1/2 p-3">
                            <div class="mx-auto w-64 p-3 bg-white transform hover:-translate-y-3 transition ease-out duration-1000 rounded-2xl">
                                <div class="flex flex-wrap -m-2">
                                    <div class="w-auto p-2">
                                        <img src="{{ asset('images/otp-sms.png')}}" alt="" class="h-10">
                                    </div>
                                    <div class="w-auto p-2">
                                        <p class="font-heading text-base text-gray-900">OTP Verifications</p>
                                        <p class="mb-2 text-sm text-gray-500">for authentication and 
                                            transactional purposes</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full sm:w-1/2 p-3">
                            <div class="mx-auto w-64 p-3 bg-white transform hover:-translate-y-3 transition ease-out duration-1000 rounded-2xl">
                                <div class="flex flex-wrap -m-2">
                                    <div class="w-auto p-2">
                                        <img src="{{ asset('images/sms-icon.png')}}" alt="" class="h-10">
                                    </div>
                                    <div class="w-auto p-2">
                                        <p class="font-heading text-base text-gray-900">Unique SMS Sender ID</p>
                                        <p class="mb-2 text-sm text-gray-500">use your brand as sender
                                            id to your customers</p>

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
@endsection
