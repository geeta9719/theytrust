<!-- resources/views/home/user/portfolio_items/tables.blade.php -->

@extends('layouts.home-master')

@section('content')
<div class="container mt-5">
    <h2>Portfolio Items for {{ $company->name }}</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Check</th>
                <th>S. No.</th>
                <th>Date Added</th>
                <th>Client Name</th>
                <th>Project Title</th>
                <th>Country / Location</th>
                <th>Project Duration</th>
                <th>Reorder</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($portfolioItems as $index => $item)
            <tr>
                <td><input type="checkbox" name="selected[]" value="{{ $item->id }}"></td>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->created_at->format('M d, Y') }}</td>
                <td>{{ $item->client_name }}</td>
                <td>{{ $item->project_title }}</td>
                <td>{{ $item->country_location }}</td>
                <td>{{ $item->project_duration }}</td>
                <td><i class="fas fa-bars"></i></td>
                <td>
                    <a href="{{ route('portfolio_items.edit', $item->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td>
                    <form action="{{ route('portfolio_items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $portfolioItems->links() }}
</div>
@endsection
