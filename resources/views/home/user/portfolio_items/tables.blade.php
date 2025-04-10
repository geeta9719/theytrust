@extends('layouts.home-master')

@section('content')
<style>
  .table-box thead{
    background-color: #00bdd6ff;
    padding: 7px 30px;
    text-decoration: none;
    color: #fff;
    font-size: 15px;
    font-weight: 400;
  }  
  .table-box td{
    font-family: "Inter", sans-serif;
    font-weight: 400;
    font-size: 14px;
    text-transform: capitalize;
  }
  .table-box th{
    font-size: 15px;
    font-weight: 400;
  }   
  .tables-sec {
    padding: 50px 0;
    background-color: #f5f2fd;
    text-align: center;
}
.tables-sec h1 {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 15px;
    text-align: center;
    color: #323842;
    font-family: "Epilogue", sans-serif;
}
</style>
<section class="container-fluid tables-sec ">
<h1>Portfolio Items for {{ $company->name }}</h1>       
</section>
    <div class="container mt-5 mb-5">
        <!-- <h2>Portfolio Items for {{ $company->name }}</h2> -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-box">
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
            <tbody id="sortable">
                @foreach ($portfolioItems as $index => $item)
                    <tr data-id="{{ $item->id }}">
                        <td><input type="checkbox" name="selected[]" value="{{ $item->id }}" /></td>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->created_at->format('M d, Y') }}</td>
                        <td>{{ $item->client_name }}</td>
                        <td>{{ $item->project_title }}</td>
                        <td>{{ $item->country_location }}</td>
                        <td>
                            {{ $item->engagement_start_date->format('M Y') }} -
                            {{ $item->engagement_end_date ? $item->engagement_end_date->format('M Y') : 'Ongoing' }}
                        </td>
                        {{-- <td> --}}
                        <td class="handle" style="cursor: grab">
                            <i class="fas fa-bars"></i>
                            Drag here
                        </td>
                        {{-- </td> --}}
                        <td>
                            <a href="{{ route('portfolio_items.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <form
                                action="{{ route('portfolio_items.destroy', $item->id) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this item?');"
                            >
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

<script>
    $(document).ready(function () {
        $('.move-up').click(function () {
            var row = $(this).closest('tr')
            row.insertBefore(row.prev())
            updateOrder()
        })

        $('.move-down').click(function () {
            var row = $(this).closest('tr')
            row.insertAfter(row.next())
            updateOrder()
        })

        var sortable = new Sortable(document.getElementById('sortable'), {
            handle: '.handle',
            animation: 150,
            onEnd: function (evt) {
                updateOrder()
            },
        })

        function updateOrder() {
            var order = []
            $('#sortable tr').each(function (index, element) {
                order.push({ id: $(element).data('id'), order: index })
            })

            $.ajax({
                url: '{{ route('portfolio_items.reorder') }}',
                method: 'POST',
                data: {
                    order: order,
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    console.log(response)
                },
            })
        }
    })
</script>
{{-- @endsection --}}
