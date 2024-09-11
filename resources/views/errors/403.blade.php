@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message')
    <div class="main-container min-h-screen text-black dark:text-white-dark">
        <!-- start main content section -->
        <div class="relative flex min-h-screen items-center justify-center overflow-hidden">
            <div
                class="px-6 py-16 text-center font-semibold before:container before:absolute before:left-1/2 before:aspect-square before:-translate-x-1/2 before:rounded-full before:bg-[linear-gradient(180deg,#4361EE_0%,rgba(67,97,238,0)_50.73%)] before:opacity-10 md:py-20">
                <div class="relative">
                    <img src="{{ url('themes/vristo/images/error/403-error-forbidden-pana.svg') }}" alt="404"
                        class="mx-auto -mt-10 w-full max-w-xs object-cover md:-mt-14 md:max-w-xl" />

                    {{-- <img src="{{ url('themes/vristo/images/error/404-light.svg') }}" alt="404"
                class="mx-auto -mt-10 w-full max-w-xs object-cover md:-mt-14 md:max-w-xl" /> --}}

                    <p class="mt-5 text-base dark:text-white">{{ __('messages.403Forbidden') }}
                    </p>
                    <a href="{{ url()->previous() }}"
                        class="btn btn-gradient mx-auto !mt-7 w-max border-0 uppercase shadow-none">
                        {{ __('messages.btn_go_back') }}
                    </a>
                </div>
            </div>
        </div>
        <!-- end main content section -->
    </div>
@stop
