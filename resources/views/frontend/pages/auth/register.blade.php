

@extends('frontend.layout.master')
@section('content')
    <main class="main pages">

        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <img class="border-radius-15" src="images/login-1.png" alt="" />
                            </div>
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Register</h1>
                                            <p class="mb-30"> <a href="{{ route('login') }}">Already registered?</a></p>
                                        </div>









                                        <form method="POST" action="{{ route('register') }}">

                                            @csrf

                                            <!-- Name -->


                                            <div class="form-group">
                                                <input id="name" class="block mt-1 w-full" type="text"
                                                    name="name" :value="old('name')" required autofocus
                                                    autocomplete="name" placeholder="Name" />
                                            </div>
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />




                                            <!-- Email Address -->
                                            <div class="form-group">
                                                <input id="email" class="block mt-1 w-full" type="email"
                                                    name="email" :value="old('email')" required autofocus
                                                    autocomplete="username" placeholder="Email" />
                                            </div>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />


                                            <!-- Password -->


                                            <div class="form-group">
                                                <input id="password" class="block mt-1 w-full" type="password"
                                                    name="password" required autocomplete="new-password"
                                                    placeholder="Password" />
                                            </div>
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                            <!-- Confirm Password -->

                                            <div class="form-group">
                                                <input id="password_confirmation" class="block mt-1 w-full" type="password"
                                                    name="password_confirmation" required autocomplete="new-password"
                                                    placeholder="Confirm Password" />
                                            </div>

                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />


                                            <div class="form-group">
                                                <button type="submit" class="btn btn-heading btn-block hover-up"
                                                    name="register">Register</button>
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
@endsection
