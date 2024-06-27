<!-- resources/views/home/user/reviews/list.blade.php -->

@extends('layouts.home-master')

@section('content')
    <style>
        .alert-success {
            width: 36% !important;
            margin: auto auto 10px 23% !important;
            text-align: center;
        }

        @media (max-width: 650px) {
            .alert-success {
                font-size: 13px;
                width: 100% !important;
                margin: auto auto 10px auto !important;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #dee2e6;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .actions button {
            font-size: 0.9em;
        }

        .btn-edit {
            color: #ffffff;
            background-color: #007bff;
        }

        .btn-delete {
            color: #ffffff;
            background-color: #dc3545;
        }
    </style>

    <div class="container mt-5">
        <h2>Reviews for {{ $company->name }}</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <p>Total Reviews: {{ $reviews->total() }}</p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Project Title</th>
                    <th>Review By</th>
                    <th>Review Date</th>
                    <th>Timeliness</th>
                    <th>Cost</th>
                    <th>Expertise</th>
                    <th>Quality</th>
                    <th>Communication</th>
                    <th>Refer Ability</th>

                    {{-- <th>Actions</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($reviews as $index => $review)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $review->project_title }}</td>
                        <td>{{ $review->user->name }}</td>
                        {{-- <td>{{ $review->scope_of_work }}</td> --}}
                        <td>{{ $review->created_at->format('M d, Y') }}</td> <!-- Display formatted create date -->

                        <td>{!! generateStarRating($review->timeliness) !!}</td>
                        <td>{!! generateStarRating($review->cost) !!}</td>
                        <td>{!! generateStarRating($review->expertise) !!}</td>
                        <td>{!! generateStarRating($review->quality) !!}</td>
                        <td>{!! generateStarRating($review->communication) !!}</td>
                        <td>{!! generateStarRating($review->refer_ability) !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $reviews->links() }}
    </div>
@endsection
