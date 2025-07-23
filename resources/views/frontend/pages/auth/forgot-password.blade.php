@extends('frontend.layout.master')
@section('content')
    <main class="main">
        <main class="main pages">

            <div class="page-content pt-150 pb-150">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-8 col-md-12 m-auto"
                            style="display: flex;align-items: center;justify-content: center;">
                            <div class="row w-50">

                                <div class="col-lg-6 col-md-8 w-100">
                                    <div class="login_wrap widget-taber-content background-white">
                                        <div class="padding_eight_all bg-white">

                                            <div class="mb-4 text-sm text-gray-600">
                                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                                            </div>

                                            <!-- Session Status -->
                                            <x-auth-session-status class="mb-4" :status="session('status')" />

                                            <form method="POST" action="{{ route('password.email') }}">
                                                @csrf

                                                <!-- Email Address -->
                                                <div>
                                                    <x-input-label for="email" :value="__('Email')" />
                                                    <x-text-input id="email" class="block mt-1 w-full" type="email"
                                                        name="email" :value="old('email')" required autofocus />
                                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                </div>

                                                <div class="flex items-center justify-end mt-4">
                                                    <x-primary-button>
                                                        {{ __('Email Password Reset Link') }}
                                                    </x-primary-button>
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
        </main>
    </main>
@endsection
