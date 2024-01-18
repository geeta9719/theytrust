@extends('layouts.admin-master')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Data</title>
</head>
<body>
    <div class="card-body">
        <input type="text" id="searchInput" placeholder="Search users..." />
        <button id="searchButton" class="btn btn-sm btn-primary">Search</button>
    </div>
  
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Plan_id</th>
                <th>Plan_Name</th> 
                <th>User_Name</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptions as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ optional($item->plan)->plan_id }}</td>
                    <td>{{ optional($item->plan)->name }}</td>
                    <td>{{ optional($item->user)->name }}</td>
                    
                
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>
@endsection

<script>
    document.getElementById('searchButton').addEventListener('click', function() {
        performSearch();
    });

    // Add event listener for changes in the search input
    document.getElementById('searchInput').addEventListener('input', function() {
        performSearch();
    });

    function performSearch() {
        var searchTerm = document.getElementById('searchInput').value.trim();

        if (searchTerm !== '') {
            fetch(`/plans/test=${searchTerm}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (response.headers.get("content-type")?.indexOf("text/html") !== -1) {
                    return response.text();
                }
                throw new TypeError("Oops, we haven't got text/html!");
            })
            .then(data => {
                document.querySelector('#example3 tbody').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
        } else {
            // If search term is empty, fetch the original data or reload the page
            window.location.reload();
        }
    }
</script>

{{-- <script>
    // Assuming you are using jQuery for simplicity
    $(document).ready(function () {
        // Intercept the form submission and handle it using AJAX
        $('#searchForm').submit(function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Get the form data
            var formData = $(this).serialize();

            // Perform an AJAX request to the server
            $.ajax({
                type: 'GET',
                url: $(this).attr('action'),
                data: formData,
                success: function (data) {
                    // Update the search results container with the new data
                    $('#searchResults').html(data);
                },
                error: function (error) {
                    console.log('Error:', error);
                }
            });
        });

        // Optional: Add a delay for better user experience (e.g., wait for the user to stop typing)
        var timer;
        $('#search').on('input', function () {
            clearTimeout(timer);
            timer = setTimeout(function () {
                $('#searchForm').submit();
            }, 500); // Adjust the delay as needed
        });
    });
</script> --}}

















