@extends('layouts/app')

@section('content')
    <div class="flex justify-center">
        <div class="bg-white w-8/12 p-6 rounded-lg">
            Posts <br>
            {{ __('message.welcome', ['name' => 'John']) }}<br>
            @lang('message.welcome', ['name' => 'John'])
        </div>
    </div>
@endsection