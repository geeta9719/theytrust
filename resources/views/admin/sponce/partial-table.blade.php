@foreach ($sponces as $sponce)
    <tr>
        <td>{{ $sponce->id }}</td>
        <td>{{ $sponce->user->name ?? 'N/A' }}</td>
        <td>{{ $sponce->company->name ?? 'N/A' }}</td>
        <td>{{ $sponce->location->name ?? 'N/A' }} ({{ class_basename($sponce->location_type_model) }})</td>
        <td>{{ $sponce->category->name ?? 'N/A' }} ({{ class_basename($sponce->category_type_model) }})</td>
        <td>{{ $sponce->planSubscription->name ?? 'N/A' }}</td>
        {{-- <td>{{ $sponce->created_at->format('Y-m-d') }}</td> --}}
    </tr>
@endforeach

<!-- Pagination links for AJAX call -->
<tr><td colspan="8" style="text-align: center">{!! $sponces->links() !!}</td></tr>

@if (! $sponces->count())
    <tr>
        <td colspan="8" style="text-align: center">No Record Found</td>
    </tr>
@endif
