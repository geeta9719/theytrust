@extends('layouts.home-master')
@section('content')
    <div id="app" class="focus-sec">
        {{-- {{dd($company)}} --}}
             {{-- <focus-main-component :categories="{{ $categories }}"></focus-main-component>
              --}}
              <focus-main-component :categories="{{ $categories }}" :company-id="{{ $company }}" ></focus-main-component>
              {{-- <focus-main-component :categories="{{ $categories }}" :company-id="{{ $company }}" :selectedData ="{{$serviceLines}}"></focus-main-component> --}}

    </div>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
