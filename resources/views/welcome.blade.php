@extends('layouts.main')
@section('content')
    <div>
        <section class="overflow-hidden" style="background: url({{asset('gradia-assets/images/hero/bg.png')}}) no-repeat; background-size: cover;">
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
                                <ul class="flex items-center mr-10">
                                    <li class="font-heading mr-9 text-white hover:text-gray-200 text-lg"><a href="#">USSD Short Code</a></li>
                                    <li class="font-heading mr-9 text-white hover:text-gray-200 text-lg"><a href="#">SMS</a></li>
                                    <li class="font-heading text-white hover:text-gray-200 text-lg"><a href="/app/login">Login</a></li>
                                </ul>
                            </div>
                            <div class="w-auto hidden lg:block">
                                <a href="/app/register" class="group relative font-heading block py-2 px-5 text-lg text-white border-2 border-white overflow-hidden rounded-10">
                                    <div class="absolute top-0 left-0 transform -translate-y-full group-hover:-translate-y-0 h-full w-full bg-white transition ease-in-out duration-500"></div>
                                    <p class="relative z-10 group-hover:text-gray-800">Create Account</p>
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
                                @if(Auth::user())
                                    <div></div>
                                @else
                                <ul>
                                    <li class="mb-12"><a class="font-heading font-medium text-lg text-gray-900 hover:text-gray-700" href="#">USSD Short Code</a></li>
                                    <li class="mb-12"><a class="font-heading font-medium text-lg text-gray-900 hover:text-gray-700" href="#">SMS</a></li>
                                </ul>
                                    @endif
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
                                        <a href="/app/login" class="p-0.5 font-heading block w-full text-lg text-gray-900 font-medium rounded-10">
                                            <div class="py-2 px-5 rounded-10">
                                                <p>Login</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="w-full">
                                        <a href="/app/register" class="group relative p-0.5 font-heading block w-full text-lg text-gray-900 font-medium bg-gradient-cyan overflow-hidden rounded-10">
                                            <div class="absolute top-0 left-0 transform -translate-y-full group-hover:-translate-y-0 h-full w-full bg-gradient-cyan transition ease-in-out duration-500"></div>
                                            <div class="py-2 px-5 bg-white rounded-lg">
                                                <p class="relative z-10">Create Account</p>
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
                <div class="flex flex-wrap justify-between -m-6 pt-32 pb-40">
                    <div class="w-full lg:w-5/12 xl:w-1/2 p-6">
                        <p class="mb-5 font-heading text-gray-400 font-medium text-xl">Grow fast, get things done with ease</p>
                        <h1 class="mb-14 font-heading text-7xl md:text-9xl xl:text-11xl text-white font-bold">Your Omni-channel platform for Seamless
                            communications
                            with your clients</h1>
                        <div class="flex flex-wrap -m-3 mb-20">
                            <div class="w-full lg:w-auto p-3">
                                <button class="font-heading w-full px-6 py-4 text-base text-gray-900 bg-white hover:bg-gray-100 rounded-md">Buy USSD short code</button>
                            </div>
                            <div class="w-full lg:w-auto p-3">
                                <button class="font-heading w-full px-6 py-4 text-base text-white bg-transparent border border-gray-500 hover:border-gray-600 rounded-md">Buy Bulk SMS Packages</button>
                            </div>
                        </div>
                        <div class="lg:max-w-md">
                            <div class="flex flex-wrap -m-3">
                                <div class="w-auto p-3">
                                    <img class="w-14 h-14" src="{{ asset('images/Screenshot-2023-11-10-at-4-08-04-PM-removebg-preview.png')}}" alt="">
                                </div>
                                <div class="flex-1 p-3">
                                    <p class="mb-4 text-gray-300 text-base">“"Unleash Communication Excellence: Where Every Message Matters"</p>
                                    <p class="font-heading text-white text-base">Dennis Zitha. COO &amp; Co-founder</p>
                                </div>
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

        <section class="py-24 overflow-hidden">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap items-center -m-6">
                    <div class="w-full md:w-1/2 p-6">
                        <div class="md:max-w-md">
                            <h2 class="mb-6 font-heading font-bold text-4xl sm:text-5xl text-gray-900">Six hours of debugging can save you 10 mins of reading documentation</h2>
                            <p class="mb-9 text-base text-gray-900">Speed up your developing process by using our step by step documentation guide to integrate our USSD and SMS systems.</p>
                            <div class="flex flex-wrap -m-2">
                                <div class="w-full md:w-auto p-2">

                                </div>
                                <div class="w-full md:w-auto p-2">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 p-6">
                        <div class="flex flex-wrap mx-auto divide-y md:max-w-md">
                            <div class="w-full py-5">
                                <div class="flex flex-wrap items-center -m-2.5">
                                    <div class="w-auto p-2.5 self-start">
                                        <img class="relative top-1" src="{{asset('gradia-assets/elements/cta/file.svg')}}" alt="">
                                    </div>
                                    <div class="flex-1 p-2.5">
                                        <a class="group" href="{{ route('ussd_documentation') }}">
                                            <h3 class="mb-1 font-heading font-bold text-lg text-gray-900 group-hover:underline">USSD Documentation</h3>
                                            <p class="text-sm text-gray-900">simple yet powerful documentation to consider</p>
                                        </a>
                                    </div>
                                    <div class="w-auto p-2.5">
                                        <a href="#">
                                            <svg class="relative top-1" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.75 3.75L12 9L6.75 14.25" stroke="#18181B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full py-5">
                                <div class="flex flex-wrap items-center -m-2.5">
                                    <div class="w-auto p-2.5 self-start">
                                        <img class="relative top-1" src="{{ asset('gradia-assets/elements/cta/file.svg')}}" alt="">
                                    </div>
                                    <div class="flex-1 p-2.5">
                                        <a class="group" href="#">
                                            <h3 class="mb-1 font-heading font-bold text-lg text-gray-900 group-hover:underline">Getting Started with SMS API</h3>
                                            <p class="text-sm text-gray-900">you are few clicks away to seamlessly integrate</p>
                                        </a>
                                    </div>
                                    <div class="w-auto p-2.5">
                                        <a href="#">
                                            <svg class="relative top-1" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.75 3.75L12 9L6.75 14.25" stroke="#18181B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-24 pb-32 bg-black overflow-hidden">
            <div class="container mx-auto px-4">
                <div class="mb-20 max-w-xl mx-auto">
                    <h2 class="mb-5 font-heading font-bold text-6xl sm:text-7xl text-white text-center">Pricing &amp; Plans</h2>
                    <p class="text-gray-400 text-base text-center">Select your desired payment plan and take advantage of all the&nbsp;
                        value added features on this platform</p>
                </div>
                <div class="flex flex-wrap -m-3">
                    <div class="w-full md:w-1/2 xl:w-1/4 p-3">
                        <div class="h-full py-9 px-7 text-center bg-gray-900 rounded-10">
                            <h3 class="mb-8 font-heading text-xs text-white font-bold uppercase tracking-px">LITE</h3>
                            <p class="mb-3 font-heading font-bold text-6xl sm:text-7xl text-white">Bulk/ SIM</p>
                            <p class="mb-8 text-gray-400">per message/page</p>
                            <p class="mb-11 text-lg text-white">1,000 - 5,000 @ K0.30
                                5,000 - 10,000 @ K0.25</p>
                            <button class="mb-4 font-heading font-semibold py-4 px-10 text-xs uppercase text-white tracking-px border border-gray-500 hover:border-gray-600 rounded-md">BUY NOW</button>
                            <p class="text-sm text-gray-500" contenteditable="false">USE CARD/ MOBILE MONEY</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/4 p-3">
                        <div class="h-full py-9 px-7 text-center bg-gray-900 rounded-10">
                            <h3 class="mb-8 font-heading text-xs text-white font-bold uppercase tracking-px">Standard</h3>
                            <p class="mb-3 font-heading font-bold text-6xl sm:text-7xl text-white">Bulk/ SIM</p>
                            <p class="mb-8 text-gray-400">per message/page</p>
                            <p class="mb-11 text-lg text-white">10,001 -&nbsp;20,000 @ K0.22
                                20,001 - 30,000 @K0.20</p>
                            <button class="mb-4 font-heading font-semibold py-4 px-10 text-xs uppercase text-white tracking-px border border-gray-500 hover:border-gray-600 rounded-md">BUY NOW</button>
                            <p class="text-sm text-gray-500" contenteditable="false">USE CARD/ MOBILE MONEY</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/4 p-3">
                        <div class="relative h-full py-9 px-7 text-center bg-gray-900 overflow-hidden rounded-10">
                            <img class="absolute top-0 left-0 w-full" src="{{ asset('gradia-assets/elements/pricing/radial2.svg')}}" alt="">
                            <div class="relative z-10">
                                <h3 class="mb-8 font-heading text-xs text-white font-bold uppercase tracking-px">BUSINESS</h3>
                                <p class="mb-3 font-heading font-bold text-6xl sm:text-7xl text-white">Bulk/ SIM</p>
                                <p class="mb-8 text-gray-400">per message/page</p>
                                <p class="mb-11 text-lg text-white">30,001 - 50,000 @ K0.15
                                    50,001 - 100,000 @ K0.12</p>
                                <button class="group relative p-px mb-8 font-heading block w-full text-base text-gray-900 font-bold bg-gradient-cyan overflow-hidden rounded-md">
                                    <div class="absolute top-0 left-0 transform -translate-y-full group-hover:-translate-y-0 h-full w-full transition ease-in-out duration-500 bg-gradient-cyan"></div>
                                    <div class="py-4 px-7 bg-gray-900 rounded-md">
                                        <p class="relative z-10 font-heading text-white text-xs tracking-px uppercase">BUY NOW</p>
                                    </div>
                                </button>
                                <p class="text-sm text-gray-500" contenteditable="false">USE CARD/ MOBILE MONEY</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/4 p-3">
                        <div class="h-full py-9 px-7 text-center bg-gray-900 rounded-10">
                            <h3 class="mb-8 font-heading text-xs text-white font-bold uppercase tracking-px">BUSINESS PLUS</h3>
                            <p class="mb-3 font-heading font-bold text-6xl sm:text-7xl text-white">Bulk/ SIM</p>
                            <p class="mb-8 text-gray-400">per message/page</p>
                            <p class="mb-11 text-lg text-white">100,000 - 500,000 @ K0.09
                                500,001 - 1,000,000 @K0.0075</p>
                            <button class="mb-4 font-heading font-semibold py-4 px-10 text-xs uppercase text-white tracking-px border border-gray-500 hover:border-gray-600 rounded-md">BUY NOW</button>
                            <p class="text-sm text-gray-500" contenteditable="false">USE CARD/ MOBILE MONEY</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-32 bg-black overflow-hidden">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap items-center -m-6">
                    <div class="w-full md:w-1/2 p-6">
                        <div class="max-w-lg">
                            <h2 class="mb-5 font-heading font-bold text-6xl sm:text-7xl text-white">USSD Pricing &amp; Plans</h2>
                            <p class="mb-11 text-gray-400 text-base">Laverage on out USSD API infrastructure to deploy your various USSD projects Instantly</p>
                            <ul>
                                <li class="flex items-center mb-5 text-base text-white">
                                    <svg class="mr-2.5" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="9" cy="9" r="8.5" stroke="white"></circle>
                                        <path d="M5.5 9.5L7.5 11.5L12.5 6.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <p>Unlimited requests</p>
                                </li>
                                <li class="flex items-center mb-5 text-base text-white">
                                    <svg class="mr-2.5" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="9" cy="9" r="8.5" stroke="white"></circle>
                                        <path d="M5.5 9.5L7.5 11.5L12.5 6.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <p>Custom/ Rented Short Codes</p>
                                </li>
                                <li class="flex items-center mb-5 text-base text-white">
                                    <svg class="mr-2.5" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="9" cy="9" r="8.5" stroke="white"></circle>
                                        <path d="M5.5 9.5L7.5 11.5L12.5 6.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <p>Real-time Analytics</p>
                                </li>
                                <li class="flex items-center mb-5 text-base text-white">
                                    <svg class="mr-2.5" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="9" cy="9" r="8.5" stroke="white"></circle>
                                        <path d="M5.5 9.5L7.5 11.5L12.5 6.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <p>Premium Support</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 p-6">
                        <div class="md:max-w-lg ml-auto">
                            <a href="#">
                                <div class="mb-5 p-px bg-gradient-cyan rounded-md">
                                    <div class="p-4 bg-gray-900 rounded-md">
                                        <div class="flex flex-wrap justify-between -m-3">
                                            <div class="w-auto p-3">
                                                <div class="flex flex-wrap items-center -m-3">
                                                    <div class="w-auto p-3">
                                                        <img src="{{ asset('gradia-assets/elements/pricing/checkbox-white.svg')}}" alt="">
                                                    </div>
                                                    <div class="w-auto p-3">
                                                        <h3 class="mb-1 font-heading font-medium text-white text-xl" contenteditable="false">YEARLY @ K29,000</h3>
                                                        <p class="text-gray-400 text-base" contenteditable="false">that’s K2,417/month only</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-auto p-3">
                                                <p class="font-heading px-3 py-1.5 font-semibold text-xs text-gray-300 bg-gray-800 tracking-px uppercase rounded-full">Best value</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="#">
                                <div class="mb-5 p-4 bg-black border border-gray-800 rounded-md">
                                    <div class="flex flex-wrap justify-between -m-3">
                                        <div class="w-auto p-3">
                                            <div class="flex flex-wrap items-center -m-3">
                                                <div class="w-auto p-3">
                                                    <img src="{{ asset('gradia-assets/elements/pricing/checkbox-black.svg')}}" alt="">
                                                </div>
                                                <div class="w-auto p-3">
                                                    <h3 class="mb-1 font-heading font-medium text-white text-xl" contenteditable="false">MONTHLY @ K2600</h3>
                                                    <p class="text-gray-400 text-base" contenteditable="false">minimum of 1 month</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="group relative">
                                <div class="absolute top-0 left-0 w-full h-full bg-gradient-green opacity-0 group-hover:opacity-50 rounded-lg transition ease-out duration-300"></div>
                                <button class="p-1 w-full font-heading font-semibold text-xs text-gray-900 uppercase tracking-px overflow-hidden rounded-md">
                                    <div class="relative px-9 py-5 bg-gradient-green overflow-hidden rounded-md">
                                        <div class="absolute top-0 left-0 transform -translate-y-full group-hover:-translate-y-0 h-full w-full bg-white transition ease-in-out duration-500"></div>
                                        <p class="relative z-10" contenteditable="false">BUY NOW</p>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-20 pb-32 overflow-hidden">
            <div class="container mx-auto px-4">
                <div class="md:max-w-lg mx-auto text-center mb-20">
                    <h2 class="mb-4 font-heading font-semibold text-gray-900 text-6xl sm:text-7xl">Latest from our blog</h2>
                    <p class="text-lg text-gray-500">Keep up to date by reading some articles for various developers, tech founders and telecoms experts</p>
                </div>
                <div class="flex flex-wrap -m-9">
                    <div class="w-full md:w-1/3 p-9">
                        <a class="group" href="#">
                            <div class="group flex flex-col mb-5 overflow-hidden rounded-xl">
                                <img class="transform group-hover:scale-110 transition ease-out duration-500" src="{{asset('images/colleagues-working-their-laptop-office.jpg')}}" alt="">
                            </div>
                            <p class="mb-4 font-heading font-medium text-xl text-gray-900 group-hover:underline">The Impact of SMS marketing for small businesses</p>
                            <h2 class="font-heading font-medium text-xs uppercase text-gray-500 tracking-px">Technology . 4 min read</h2>
                        </a>
                    </div>
                    <div class="w-full md:w-1/3 p-9">
                        <a class="group" href="#">
                            <div class="group flex flex-col mb-5 overflow-hidden rounded-xl">
                                <img class="transform group-hover:scale-110 transition ease-out duration-500" src="{{asset('images/blessmore-ontech-copy.jpg')}}" alt="">
                            </div>
                            <p class="mb-4 font-heading font-medium text-xl text-gray-900 group-hover:underline">How to integrate Bulk SMS API using PHP</p>
                            <h2 class="font-heading font-medium text-xs uppercase text-gray-500 tracking-px">Technology . 4 min read</h2>
                        </a>
                    </div>
                    <div class="w-full md:w-1/3 p-9">
                        <a class="group" href="#">
                            <div class="group flex flex-col mb-5 overflow-hidden rounded-xl">
                                <img class="transform group-hover:scale-110 transition ease-out duration-500" src="{{asset('images/elixir-programming-ontech.jpg')}}" alt="">
                            </div>
                            <p class="mb-4 font-heading font-medium text-xl text-gray-900 group-hover:underline">Integrate Elixir USSD code to Ontech USSD API endpoint</p>
                            <h2 class="font-heading font-medium text-xs uppercase text-gray-500 tracking-px">Technology . 4 min read</h2>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="relative py-24 bg-black overflow-hidden">
            <img class="absolute bottom-0 left-0" src="{{asset('gradia-assets/elements/footers/radial2.svg')}}" alt="">
            <div class="relative z-10 container mx-auto px-4">
                <div class="flex flex-wrap -m-6">
                    <div class="w-full md:w-1/2 p-6 lg:w-7/12">
                        <div class="flex flex-col justify-between h-full max-w-sm">
                            <a href="/" class="mb-11">
                                <img src="{{asset('images/logo.png')}}" alt="">
                            </a>
                            <div>
                                <p class="mb-14 text-gray-200 text-sm" contenteditable="false">One of the many best products release to help businesses and freelancers engage with their clients seamlessly</p>
                                <p class="text-gray-400 text-sm" contenteditable="false">© Copyright 2022. All Rights Reserved by Ontech Innovations</p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 lg:w-2/12 p-6">
                        <div class="h-full">
                            <h3 class="mb-7 font-heading font-medium text-base text-gray-500 tracking-px">Support</h3>
                            <ul>
                                <li class="mb-4"><a class="font-heading font-medium text-base text-white hover:text-gray-200" href="#">Account</a></li>
                                <li class="mb-4"><a class="font-heading font-medium text-base text-white hover:text-gray-200" href="#">Help</a></li>
                                <li class="mb-4"><a class="font-heading font-medium text-base text-white hover:text-gray-200" href="#">Contact Us</a></li>
                                <li><a class="font-heading font-medium text-base text-white hover:text-gray-200" href="#">Customer Support</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 lg:w-3/12 p-6">
                        <div class="flex flex-col justify-between h-full">
                            <div>
                                <h3 class="mb-7 font-heading font-medium text-base text-gray-500 tracking-px">Contact Info</h3>
                                <ul class="mb-6">
                                    <li class="mb-4 font-heading font-medium text-base text-white" contenteditable="false">innovations@ontech.co.zm<div></div><div><br></div><div>Plot No. 25996 Kwacha Road,</div><div>Olympia Park,</div><div>10101 Lusaka,</div><div>Zambia</div><div><br></div><div>Cell: +260979699350</div></li>
                                    <li class="font-heading font-medium text-base text-white"><p class="p1" style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);" contenteditable="false">Plot No. 25996, Kwacha Road, Olympia Park Lusaka. Zambia</p></li>
                                </ul>
                            </div>
                            <div class="flex flex-wrap items-center -ml-5">
                                <div class="w-auto p-5">
                                    <a href="#">
                                        <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.6488 1.58924C13.137 1.81672 12.5967 1.9589 12.028 2.0442C12.5967 1.70298 13.0517 1.16271 13.2507 0.508707C12.7105 0.821493 12.1133 1.04897 11.4593 1.19115C10.9475 0.650883 10.2082 0.309662 9.41201 0.309662C7.87652 0.309662 6.62537 1.5608 6.62537 3.0963C6.62537 3.32378 6.65381 3.52283 6.71068 3.72187C4.40744 3.60813 2.33168 2.49916 0.938358 0.793058C0.710877 1.21958 0.568702 1.67455 0.568702 2.18638C0.568702 3.15317 1.0521 4.00622 1.81985 4.51805C1.36488 4.48962 0.938358 4.37588 0.540266 4.17683V4.20527C0.540266 5.57015 1.50706 6.70755 2.78664 6.96347C2.55916 7.02034 2.30324 7.04877 2.04733 7.04877C1.87672 7.04877 1.67767 7.02034 1.50706 6.9919C1.87672 8.10087 2.90038 8.92549 4.12309 8.92549C3.15629 9.6648 1.96202 10.1198 0.654007 10.1198C0.426526 10.1198 0.199046 10.1198 0 10.0913C1.25114 10.8875 2.70133 11.3425 4.2937 11.3425C9.44045 11.3425 12.2555 7.07721 12.2555 3.38065C12.2555 3.26691 12.2555 3.12473 12.2555 3.01099C12.7958 2.64134 13.2792 2.15794 13.6488 1.58924Z" fill="white"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="w-auto p-5">
                                    <a href="#">
                                        <svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.34923 14.8715V8.08792H0.0664062V5.44422H2.34923V3.49457C2.34923 1.23201 3.73112 0 5.74948 0C6.71629 0 7.54722 0.0719815 7.78937 0.104155V2.46866L6.38954 2.4693C5.29184 2.4693 5.0793 2.9909 5.0793 3.75633V5.44422H7.6972L7.35634 8.08792H5.07929V14.8715H2.34923Z" fill="white"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="w-auto p-5">
                                    <a href="#">
                                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.78828 1.49101C10.9976 1.49101 11.2592 1.49928 12.132 1.53908C12.6568 1.5455 13.1765 1.64186 13.6687 1.82396C14.0257 1.96161 14.3498 2.17247 14.6203 2.44298C14.8908 2.71348 15.1017 3.03763 15.2393 3.39456C15.4214 3.88675 15.5178 4.40652 15.5242 4.93127C15.5636 5.80404 15.5723 6.06568 15.5723 8.275C15.5723 10.4843 15.564 10.746 15.5242 11.6187C15.5178 12.1435 15.4214 12.6633 15.2393 13.1554C15.1017 13.5124 14.8908 13.8365 14.6203 14.107C14.3498 14.3775 14.0257 14.5884 13.6687 14.726C13.1765 14.9081 12.6568 15.0045 12.132 15.0109C11.2596 15.0503 10.998 15.059 8.78828 15.059C6.57857 15.059 6.31693 15.0507 5.44455 15.0109C4.91979 15.0045 4.40003 14.9081 3.90784 14.726C3.55091 14.5884 3.22676 14.3775 2.95626 14.107C2.68575 13.8365 2.47489 13.5124 2.33724 13.1554C2.15513 12.6633 2.05878 12.1435 2.05236 11.6187C2.01295 10.746 2.00428 10.4843 2.00428 8.275C2.00428 6.06568 2.01256 5.80404 2.05236 4.93127C2.05878 4.40652 2.15513 3.88675 2.33724 3.39456C2.47489 3.03763 2.68575 2.71348 2.95626 2.44298C3.22676 2.17247 3.55091 1.96161 3.90784 1.82396C4.40003 1.64186 4.91979 1.5455 5.44455 1.53908C6.31732 1.49967 6.57896 1.49101 8.78828 1.49101ZM8.78828 0C6.54232 0 6.2594 0.00945666 5.37678 0.0496476C4.69 0.0633078 4.01052 0.193342 3.36723 0.43422C2.81539 0.642135 2.31556 0.967957 1.90262 1.38895C1.48125 1.80204 1.15515 2.30215 0.947104 2.85435C0.706226 3.49764 0.576192 4.17712 0.562531 4.86389C0.523129 5.74573 0.513672 6.02864 0.513672 8.27461C0.513672 10.5206 0.523129 10.8035 0.56332 11.6861C0.57698 12.3729 0.707014 13.0524 0.947892 13.6957C1.15571 14.2478 1.48153 14.7479 1.90262 15.161C2.31579 15.5821 2.8159 15.908 3.36802 16.1158C4.01131 16.3567 4.69079 16.4867 5.37757 16.5004C6.26019 16.5398 6.54192 16.55 8.78907 16.55C11.0362 16.55 11.3179 16.5405 12.2006 16.5004C12.8873 16.4867 13.5668 16.3567 14.2101 16.1158C14.7596 15.9028 15.2586 15.5774 15.6752 15.1606C16.0918 14.7437 16.4168 14.2445 16.6295 13.6949C16.8703 13.0516 17.0004 12.3721 17.014 11.6853C17.0534 10.8035 17.0629 10.5206 17.0629 8.27461C17.0629 6.02864 17.0534 5.74573 17.0132 4.8631C16.9996 4.17633 16.8695 3.49685 16.6287 2.85356C16.4209 2.30144 16.095 1.80133 15.6739 1.38816C15.2608 0.967073 14.7607 0.641246 14.2085 0.433432C13.5653 0.192554 12.8858 0.0625198 12.199 0.0488596C11.3172 0.00945672 11.0342 0 8.78828 0Z" fill="white"></path>
                                            <path d="M8.78632 4.02582C7.94591 4.02582 7.12436 4.27503 6.42559 4.74194C5.72681 5.20885 5.18218 5.87248 4.86056 6.64892C4.53895 7.42537 4.4548 8.27974 4.61876 9.104C4.78272 9.92827 5.18741 10.6854 5.78168 11.2797C6.37594 11.8739 7.13307 12.2786 7.95734 12.4426C8.78161 12.6065 9.63598 12.5224 10.4124 12.2008C11.1889 11.8792 11.8525 11.3345 12.3194 10.6358C12.7863 9.93698 13.0355 9.11544 13.0355 8.27503C13.0355 7.14807 12.5878 6.06726 11.791 5.27038C10.9941 4.4735 9.91328 4.02582 8.78632 4.02582ZM8.78632 11.0332C8.2408 11.0332 7.70753 10.8715 7.25394 10.5684C6.80036 10.2653 6.44683 9.83454 6.23807 9.33054C6.02931 8.82655 5.97469 8.27197 6.08111 7.73693C6.18754 7.20189 6.45023 6.71042 6.83598 6.32468C7.22172 5.93894 7.71318 5.67625 8.24822 5.56982C8.78326 5.4634 9.33784 5.51802 9.84184 5.72678C10.3458 5.93554 10.7766 6.28907 11.0797 6.74265C11.3828 7.19623 11.5445 7.7295 11.5445 8.27503C11.5445 9.00655 11.2539 9.70811 10.7367 10.2254C10.2194 10.7426 9.51784 11.0332 8.78632 11.0332Z" fill="white"></path>
                                            <path d="M13.2058 4.85053C13.7542 4.85053 14.1988 4.40597 14.1988 3.85758C14.1988 3.30918 13.7542 2.86462 13.2058 2.86462C12.6575 2.86462 12.2129 3.30918 12.2129 3.85758C12.2129 4.40597 12.6575 4.85053 13.2058 4.85053Z" fill="white"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
