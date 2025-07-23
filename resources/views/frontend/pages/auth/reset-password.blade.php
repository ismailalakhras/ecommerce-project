@extends('frontend.layout.master')
@section('content')
    <main class="main">
       
            <div class="page-content pt-150 pb-150">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-8 col-md-12 m-auto">
                            <div class="row">
                                <div class="heading_s1">
                                    <img class="border-radius-15" src="{{ asset('images/reset_password.svg') }}"
                                        alt="" />
                                    <h2 class="mb-15 mt-15">Set new password</h2>
                                    <p class="mb-30">Please create a new password that you don’t use on any other site.</p>
                                </div>
                                <div class="col-lg-6 col-md-8">
                                    <div class="login_wrap widget-taber-content background-white">
                                        <div class="padding_eight_all bg-white">






                                            <form method="POST" action="{{ route('password.store') }}">
                                                @csrf

                                                <!-- Password Reset Token -->
                                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                                <!-- Email Address -->
                                                <div>
                                                    <x-input-label for="email" :value="__('Email')" />
                                                    <x-text-input id="email" class="block mt-1 w-full" type="email"
                                                        name="email" :value="old('email', $request->email)" required autofocus
                                                        autocomplete="username" />
                                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                </div>

                                                <!-- Password -->
                                                <div class="mt-4">
                                                    <x-input-label for="password" :value="__('Password')" />
                                                    <x-text-input id="password" class="block mt-1 w-full" type="password"
                                                        name="password" required autocomplete="new-password" />
                                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                </div>

                                                <!-- Confirm Password -->
                                                <div class="mt-4">
                                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                        type="password" name="password_confirmation" required
                                                        autocomplete="new-password" />

                                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                                </div>

                                                <div class="flex items-center justify-end mt-4">
                                                    <x-primary-button>
                                                        {{ __('Reset Password') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>










                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 pl-50">
                                    <h6 class="mb-15">Password must:</h6>
                                    <p>Be between 9 and 64 characters</p>
                                    <p>Include at least tow of the following:</p>
                                    <ol class="list-insider">
                                        <li>An uppercase character</li>
                                        <li>A lowercase character</li>
                                        <li>A number</li>
                                        <li>A special character</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </main>
@endsection
