@extends('layouts.admin-master')
@section('content')
    <div class="container">
        <h1>Edit Plan Feature</h1>

        {{-- <form action="{{ route('planfeatures.update', ['planfeature' => $planfeature->id]) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $planFeature->name }}" required>
            </div>

            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" name="code" class="form-control" value="{{ $planFeature->code }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control">{{ $planFeature->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="limit">Limit:</label>
                <input type="number" name="limit" class="form-control" value="{{ $planFeature->limit }}">
            </div>

            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" name="type" class="form-control" value="{{ $planFeature->type }}" required>
            </div>

            <div class="form-group">
                <label for="plan_id">Plan:</label>
                <select name="plan_id" class="form-control" required>
                    @foreach ($plans as $plan)
                        <option value="{{ $plan->id }}" {{ $plan->id == $planFeature->plan_id ? 'selected' : '' }}>
                            {{ $plan->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Plan Feature</button>
    </form> --}}
    <form action="{{ route('planfeatures.update', ['planfeature' => $planfeature->id]) }}" method="POST">

        @csrf
        @method('PUT')
    
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $planfeature->name }}" required>
        </div>
    
        <div class="form-group">
            <label for="code">Code:</label>
            <input type="text" name="code" class="form-control" value="{{ $planfeature->code }}" required>
        </div>
    
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control">{{ $planfeature->description }}</textarea>
        </div>
    
        <div class="form-group">
            <label for="limit">Limit:</label>
            <input type="number" name="limit" class="form-control" value="{{ $planfeature->limit }}">
        </div>
    
        <div class="form-group">
            <label for="type">Type:</label>
            <input type="text" name="type" class="form-control" value="{{ $planfeature->type }}" required>
        </div>
    
        <div class="form-group">
            <label for="plan_id">Plan:</label>
            <select name="plan_id" class="form-control" required>
                @foreach ($plans as $plan)
                    <option value="{{ $plan->id }}" {{ $plan->id == $planfeature->plan_id ? 'selected' : '' }}>
                        {{ $plan->name }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <button type="submit" class="btn btn-primary">Update Plan Feature</button>
    </form>
    
    </div>
@endsection



