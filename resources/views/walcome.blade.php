@extends('frontend.app')
@section('contentFrontEnd')
    <div class="flex flex-col lg:flex-row justify-between">
        <div class="flex flex-col my-auto">
            <div class="">
                <div class="bg-brand-white10 inline-flex justify-center items-center rounded-full">
                    <div class="bg-white text-black font-semibold px-2 rounded-full m-1">
                        75% SAVE
                    </div>
                    <p class="text-white px-2 ">For the Black Friday weekend</p>
                </div>
                <h1 class="lg:text-6xl font-bold pt-8 md:text-6xl text-4xl">
                    Fastest & secure platform to invest in crypto
                </h1>
                <p class="pt-8 md:w-1/2 opacity-70">
                    Buy and sell cryptocurrencies, trusted by 10M wallets with over $30 billion in transactions.
                </p>
                {{-- Image --}}
                <div class="pt-8">
                    <a href="#" class="px-2 py-2 bg-brand-button rounded-full inline-flex justify-center items-center space-x-2">
                        <span class="mx-4 py-1">Try for FREE</span>
                        <span class=" text-sm text-brand-button rounded-full bg-white h-6 w-6 text-center flex justify-center items-center">            
                        </span>
                    </a>
                </div>
            </div>

            <div class="">
                
            </div>
        </div>
        {{-- Batas --}}
    </div>
@endsection