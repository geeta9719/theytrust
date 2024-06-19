@extends('layouts.home-master')

@section('content')


    <div id="app">
      <industry-client-form 
        :industries="{{ json_encode($industry) }}" 
        :client-sizes="{{ json_encode($clientSize) }}"
        :compan-id="112">
      </industry-client-form>
    </div>

  <script src="{{ mix('js/app.js') }}"></script>
@endsection


