@extends('layouts.main')

@section('content')
    <style>
        .login-title {
            font-family: "Dancing Script", cursive;
            font-optical-sizing: auto;
            font-weight: 700;
            font-style: normal;
            font-size: 35px;
        }
    </style>

    <div class="w-full flex justify-center px-12 h-screen pt-6">
        <div class="mr-12 mt-20">
            <h1 class="m-6 mr-6 login-title">Unlock the Festivities: <span class="text-blue-500">Register for Your Exclusive Evento Account</span>
            </h1>
        </div
        <div class="w-1/4">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <div class="sm:col-span-1">
                        <label for="picture" class="block mb-2 text-sm font-medium text-gray-900 ">Picture</label>
                        <input type="file" accept="image" name="picture"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                    </div>
                    <x-input-error :messages="$errors->get('picture')" class="mt-2"/>
                </div>

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')"/>
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                  required
                                  autofocus autocomplete="name"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')"/>
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                                  required
                                  autocomplete="username"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <div class="mt-4 flex justify-center">

                    <button id="dropdownRadioButton" data-dropdown-toggle="dropdownDefaultRadio"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">Pick Your Role
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdownDefaultRadio"
                         class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow">
                        <ul class="p-3 space-y-3 text-sm text-gray-700"
                            aria-labelledby="dropdownRadioButton">
                            <li>
                                <div class="flex items-center">
                                    <input id="default-radio-1" type="radio" value="Organizer" name="role"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                    <label for="default-radio-1"
                                           class="ms-2 text-sm font-medium text-gray-900">Event Organizer</label>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <input id="default-radio-3" type="radio" value="user" name="role"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="default-radio-3"
                                           class="ms-2 text-sm font-medium text-gray-900">Guest</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <x-input-error :messages="$errors->get('role')" class="mt-2"/>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')"/>

                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="new-password"/>

                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>

                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                  type="password"
                                  name="password_confirmation" required autocomplete="new-password"/>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                       href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
@stop
