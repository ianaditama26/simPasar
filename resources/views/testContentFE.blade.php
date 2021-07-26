@extends('frontend.app')
@section('contentFrontEnd')
    <div class="">
        {{-- Grid --}}
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                <div class="bg-gray-500 text-white rounded p-10">col-span-2</div>
            </div>
            <div>
                <div class="bg-gray-500 text-white rounded p-10">col 2</div>
            </div>
            <div>
                <div class="bg-gray-500 text-white rounded p-10">col 3</div>
            </div>
            <div>
                <div class="bg-gray-500 text-white rounded p-10">col 4</div>
            </div>
            <div>
                <div class="bg-gray-500 text-white rounded p-10">col 5</div>
            </div>
            <div>
                <div class="bg-gray-500 text-white rounded p-10">col 6</div>
            </div>
        </div>
        {{-- side bar and content --}}
        <div class="grid grid-cols-12 gap-6 mt-2">
            <div class="bg-blue-600 col-span-4 p-4">
                side bar
            </div>
            <div class="bg-blue-700 col-span-8 p-4">
                content
            </div>
        </div>

        {{-- Flex --}}
        <div class="flex flex-wrap">
            <div class="w-1/3 p-4">
                <div class="bg-pink-600">Column</div>
            </div>
            <div class="w-2/3 p-4">
                <div class="bg-pink-600">Column</div>
            </div>
            <div class="w-1/3 p-4">
                <div class="bg-pink-600">Column</div>
            </div>
            <div class="w-1/3 p-4">
                <div class="bg-pink-600">Column</div>
            </div>
            <div class="w-1/3 p-4">
                <div class="bg-pink-600">Column</div>
            </div>
            <div class="w-1/3 p-4">
                <div class="bg-pink-600">Column</div>
            </div>
            <div class="w-1/3 p-4">
                <div class="bg-pink-600">Column</div>
            </div>
            <div class="w-1/3 p-4">
                <div class="bg-pink-600">Column</div>
            </div>
        </div>
    </div>
@endsection