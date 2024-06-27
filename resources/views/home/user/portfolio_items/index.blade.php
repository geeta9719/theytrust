@extends('layouts.home-master')

@section('content')

<head>
    <title>Portfolio Listing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS for Portfolio Listing Page */

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
            color: #343a40;
        }

        .portfolio-item {
            margin-bottom: 20px;
        }

        .portfolio-media img,
        .portfolio-media iframe {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .portfolio-media {
            text-align: center;
            margin-bottom: 15px;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-bottom: 10px;
        }

        .tag {
            background-color: #f1f1f1;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9em;
            color: #6c757d;
        }

        .short-description {
            max-height: 80px;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 10px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.25em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 0.95em;
            color: #6c757d;
            margin-bottom: 10px;
        }

        #load-more {
            display: block;
            width: 200px;
            margin: 20px auto;
            font-size: 1em;
            font-weight: bold;
        }

        #page-info {
            text-align: center;
            font-size: 1em;
            color: #6c757d;
            margin-top: 10px;
        }

        .img-thumbnail {
            max-width: 100%;
            height: auto;
        }

        .portfolio-item .row {
            align-items: center;
        }

        .portfolio-item .col-md-8 {
            padding-left: 0;
        }

        .portfolio-item .col-md-4 {
            padding-right: 0;
        }

        .portfolio-media img {
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Portfolio Items for {{ $company->name }}</h2>
        <div id="portfolio-items" class="row"></div>
        <button id="load-more" class="btn btn-primary">Load More</button>
        <div id="page-info" class="mt-3"></div> <!-- Added to display page info -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let currentPage = 1;
            const companyId = {{ $company->id }};
            const loadMoreBtn = document.getElementById('load-more');
            const pageInfo = document.getElementById('page-info');

            loadMoreBtn.addEventListener('click', loadMoreItems);

            function loadMoreItems() {
                fetch(`/portfolio/${companyId}/data?page=${currentPage}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Fetched data:', data); // Log the fetched data
                        const portfolioItems = data.data;
                        const portfolioContainer = document.getElementById('portfolio-items');

                        portfolioItems.forEach(item => {
                            const portfolioItem = document.createElement('div');
                            portfolioItem.classList.add('col-md-12', 'portfolio-item');

                            var mediaContent = '';
                            console.log(item);
                            if (item?.media?.type === 'file') {
                                if (item?.media?.path.endsWith('.pdf')) {
                                    mediaContent += `<img src="/path/to/pdf_icon.png" alt="PDF" class="img-thumbnail">`;
                                } else {
                                    mediaContent += `<img src="/storage/${item?.media?.path}" alt="Media">`;
                                }
                            } else if (item?.media?.type === 'youtube') {
                                mediaContent += `<iframe src="${item?.media?.url}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
                            }

                            portfolioItem.innerHTML = `
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5 class="card-title">${item.project_title}</h5>
                                                <p class="card-text">${item.client_name}</p>
                                                <p class="card-text">${item.country_location}</p>
                                                <div class="tags">
                                                    ${item.services_provided.split(',').map(service => `<span class="tag">${service.trim()}</span>`).join('')}
                                                </div>
                                                <p class="card-text short-description">${item.short_description}</p>
                                                <p class="card-text">${item.engagement_start_date} - ${item.engagement_end_date ?? 'Ongoing'}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="portfolio-media">
                                                    ${mediaContent}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;

                            portfolioContainer.appendChild(portfolioItem);
                        });

                        currentPage++;
                        pageInfo.innerHTML = `Page: ${currentPage}`;

                        if (!data.next_page_url) {
                            loadMoreBtn.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error); // Log any errors
                    });
            }

            // Load initial items
            loadMoreItems();
        });
    </script>
</body>
@endsection
