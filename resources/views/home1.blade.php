
@extends('layouts.home-master')

@section('content')
    <div id="app">
        <listing-component 
            :categories="{{ json_encode($categories) }}"
            :budgets="{{ json_encode($budgets) }}"
            :rates="{{ json_encode($rates) }}"
            :industries="{{ json_encode($industries) }}"
        ></listing-component>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
