@extends('layouts/app')

@section('content')
    <div class="flex justify-center">
        <div class="bg-white w-4/12 p-6 rounded-lg">
            <form action="{{ route('products') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="title" class="sr-only">title</label>
                    <input type="text" name="title" id="title" placeholder="Your title" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror" value="{{ old('title') }}">

                    @error('title')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="price" class="sr-only">price</label>
                    <input type="text" name="price" id="price" placeholder="price" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('price') border-red-500 @enderror" value="{{ old('price') }}">

                    @error('price')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="sr-only">description</label>
                    <textarea name="description" id="description" placeholder="Your description" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('description') border-red-500 @enderror" value="{{ old('description') }}"></textarea>

                    @error('description')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="category" class="sr-only">category</label>
                    <input type="text" name="category" id="category" placeholder="Type category" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('category') border-red-500 @enderror" value="{{ old('category') }}">

                    @error('category')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="sr-only">image</label>
                    <input type="text" name="image" id="image" placeholder="image url" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('image') border-red-500 @enderror" value="{{ old('image') }}">

                    @error('image')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">create product</button>
                </div>
            </form>
        </div>
    </div>
    
    @if ($products->count())
    <div class="flex flex-wrap justify-center">
        @foreach ($products as $product)
            <div class="bg-white w-4/12 p-6 rounded-lg m-3">
                {{ $product->title }}
            </div>
        @endforeach
    </div>
    @else
        <p>No products</p>
    @endif
@endsection