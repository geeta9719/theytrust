@extends('layouts.home-master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Request a Review</h3>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="note">Personalized Note</label>
                            <textarea name="note" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
                            @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Request</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <h3>Reviews Request History</h3>
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Check</th>
                                <th>S. No.</th>
                                <th>Date Requested</th>
                                <th>Client Name</th>
                                <th>Resend Request</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $review->created_at->format('M d, Y') }}</td>
                                    <td>{{ $review->name }}</td>
                                    <td>
                                        <form action="{{ route('reviews.resend', $review->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-link">
                                                <i class="fa fa-paper-plane"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
