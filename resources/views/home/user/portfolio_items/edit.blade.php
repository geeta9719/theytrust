@extends('layouts.home-master')

@section('content')
<style>
      .edit-sec {
    padding: 50px 0;
    background-color: #f5f2fd;
    text-align: center;
}
.edit-sec h1 {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 0px;
    text-align: center;
    color: #323842;
    font-family: "Epilogue", sans-serif;
}
.container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: flex-start;
        max-width: 1200px;
        margin: auto;
        padding: 20px;
        gap: 20px;
    }
  
    label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
        font-weight: 600;
    font-size: 14px;
    font-family: "Inter", sans-serif;
    }
    input[type="text"],
    input[type="url"],
    input[type="file"],
    input[type="date"],
    select,
    textarea {
        width: 100%;
        padding: 10px;
        margin-top: 0px;
        margin-bottom: 0px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 14px;
    font-weight: 400;
    font-family: "Inter", sans-serif;
    color: #495057;
    }
    .port-sec .char-count {
        font-size: 12px;
        color: #999;
        margin-bottom: 0px;
        display: block;
        text-align: right;
    }
    .port-sec .error-message {
        color: red;
        font-size: 12px;
        margin-top: -5px;
        margin-bottom: 10px;
    }
    .port-sec button {
        color: #fff;
    background-color: #00bdd6;
    border-color: #00bdd6;
    border-radius: 5px;
    padding: 5px 24px 6px 23px;
    font-size: 13px;
    text-align: center;
    outline:none;
    }
    .port-sec button:hover {
       background-color: #00bdd6;
        outline:none;
    }
    .port-sec button:active {
        background-color: #00bdd6;
        box-shadow: 0 2px #666;
        transform: translateY(2px);
        outline:none;
    }
    .current{
        word-wrap: break-word;
        width:520px;
        font-size: 14px;
    }
    #preview {
        /* flex: 1 1 600px;
        padding: 20px;
        color: #fff;
    background-color: #6c757d;
    border-color: #6c757d; */
    }
    #preview img,
    #preview iframe,
    #preview object,
    #preview video {
        width: fit-content;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 10px;
    height: 230px;
    }
    .create-sec h1 {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 15px;
    text-align: center;
    color: #323842;
    font-family: "Epilogue", sans-serif;
}
.port-sec button{
    color: #fff;
    background-color: #00bdd6;
    border-color: #00bdd6;
    border-radius: 5px;
    padding: 5px 24px 6px 23px;
    font-size: 13px;
    margin-left: 12px;
}
.port-sec .form-group{
    margin:0;
}
    .create-sec {
    padding: 50px 0;
    background-color: #f5f2fd;
    text-align:center;}
    @media (max-width: 767px) {
        .current{
        word-wrap: break-word;
        width:320px;
        font-size: 14px;
    }
    .port-sec .char-count {
   
    margin-bottom: 0;}}
</style>
<section class="container-fluid edit-sec ">
<h1 style="text-align: center">Edit Portfolio Item</h1>      
</section>
   
    <div class="container">
        <form
            action="{{ route('portfolio_items.update', $portfolioItem->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')
            <div class="row port-sec">
            <div class="col-md-6">
            <label for="media_type">Select Media Type</label>
            <select name="media_type" id="media_type" onchange="toggleMediaInput()">
                <option value="image_pdf" {{ $portfolioItem->media['type'] == 'file' ? 'selected' : '' }}>
                    Image or PDF File
                </option>
                <option value="youtube_url" {{ $portfolioItem->media['type'] == 'youtube' ? 'selected' : '' }}>
                    YouTube Video URL
                </option>
            </select>

            <div id="file_input_div" {{ $portfolioItem->media['type'] == 'youtube' ? 'style=display:none;' : '' }}>
                <label for="media" class="mt-4">Add Image or PDF</label>
                <input type="file" name="media" id="media" accept="image/*,.pdf" onchange="showPreview(event)" />
                @if ($portfolioItem->media && $portfolioItem->media['type'] == 'file')
                    <div class="mt-4 current">
                    <label for="current_file" class="mt-4"> Current File</label>   
                        <a href="{{ asset('storage/' . $portfolioItem->media['path']) }}" target="_blank">
                            {{ $portfolioItem->media['path'] }}
                        </a>
                    </div>
                @endif
            </div>
            <div id="url_input_div" {{ $portfolioItem->media['type'] == 'file' ? 'style=display:none;' : '' }}>
                <label for="youtube_url">Insert YouTube Video URL</label>
                <input
                    type="url"
                    name="youtube_url"
                    id="youtube_url"
                    value="{{ $portfolioItem->media['type'] == 'youtube' ? $portfolioItem->media['url'] : '' }}"
                    onchange="showPreview(event)"
                />
            </div>

            <label for="project_title" class="mt-4">Project Title</label>
            <input
                type="text"
                name="project_title"
                id="project_title"
                value="{{ $portfolioItem->project_title }}"
                maxlength="70"
                oninput="updateCharCount('project_title', 70)"
            />
            <span class="char-count" id="project_title-char-count">0/70</span>

            <label for="client_name">Client Name</label>
            <input
                type="text"
                name="client_name"
                id="client_name"
                value="{{ $portfolioItem->client_name }}"
                maxlength="35"
                oninput="updateCharCount('client_name', 35)"
            />
            <span class="char-count" id="client_name-char-count">0/35</span>

            <label for="country_location">Country / Location</label>
            <input
                type="text"
                name="country_location"
                id="country_location"
                value="{{ $portfolioItem->country_location }}"
            />

            <label for="engagement_start_date" class="mt-4">Engagement Start Date</label>
            <input
                type="date"
                name="engagement_start_date"
                id="engagement_start_date"
                value="{{ $portfolioItem->engagement_start_date->format('Y-m-d') }}"
            />

            <label for="engagement_end_date" class="mt-4">Engagement End Date</label>
            <input
                type="date"
                name="engagement_end_date"
                id="engagement_end_date"
                value="{{ optional($portfolioItem->engagement_end_date)->format('Y-m-d') }}"
            />

             </div>
            <div class="col-md-6">
            <div id="preview">
            @if ($portfolioItem->media)
                @if ($portfolioItem->media['type'] == 'file')
                    @if (Str::endsWith($portfolioItem->media['path'], ['.jpg', '.jpeg', '.png']))
                        <img src="{{ asset('storage/' . $portfolioItem->media['path']) }}" alt="Current Image" />
                    @elseif (Str::endsWith($portfolioItem->media['path'], '.pdf'))
                        <object
                            data="{{ asset('storage/' . $portfolioItem->media['path']) }}"
                            type="application/pdf"
                            width="100%"
                            height="500px"
                        >
                            <p>
                                Your browser does not support PDFs.
                                <a href="{{ asset('storage/' . $portfolioItem->media['path']) }}">Download the PDF</a>
                                .
                            </p>
                        </object>
                    @endif
                @elseif ($portfolioItem->media['type'] == 'youtube')
                    <iframe
                        src="https://www.youtube.com/embed/{{ explode('v=', $portfolioItem->media['url'])[1] }}"
                        width="100%"
                        height="500px"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                    ></iframe>
                @endif
            @endif
        </div>
            <div class="form-group">
                <label for="services_provided">
                    What services did you receive from 
                    <b>(for example: Digital Marketing, Web design, Mobile App development)</b>
                    <strong style="color: red;"> *</strong>
                </label>
              
                <select id="services_provided" name="services_provided[]" class="form-control" multiple="multiple">
                    @foreach ($services as $id => $name)
                        <option value="{{ $id }}" selected>{{ $name }}</option> <!-- Show name, keep ID as value -->
                    @endforeach
                </select>
                @error('services_provided')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

          

            <label for="short_description" class="mt-4" >Short Description</label>
            <textarea name="short_description" id="short_description">
{{ $portfolioItem->short_description }}</textarea
            >

         
            </div>
         
            </div>



            <div class="row port-sec">
    <div class="col-md-12 text-center mt-3">
    <button type="submit">Update</button> </div>
    </div>

        </form>
    
        
    </div>

    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function toggleMediaInput() {
            var mediaType = document.getElementById('media_type').value
            var fileInputDiv = document.getElementById('file_input_div')
            var urlInputDiv = document.getElementById('url_input_div')
            var previewDiv = document.getElementById('preview')
            previewDiv.innerHTML = ''

            if (mediaType === 'image_pdf') {
                fileInputDiv.style.display = 'block'
                urlInputDiv.style.display = 'none'
            } else {
                fileInputDiv.style.display = 'none'
                urlInputDiv.style.display = 'block'
            }
        }

        function showPreview(event) {
            var previewDiv = document.getElementById('preview')
            previewDiv.innerHTML = ''

            if (event.target.id === 'media') {
                var file = event.target.files[0]
                var reader = new FileReader()

                reader.onload = function (e) {
                    var fileType = file.type
                    if (fileType.startsWith('image/')) {
                        var img = document.createElement('img')
                        img.src = e.target.result
                        previewDiv.appendChild(img)
                    } else if (fileType === 'application/pdf') {
                        var object = document.createElement('object')
                        object.data = e.target.result
                        object.type = 'application/pdf'
                        object.width = '100%'
                        object.height = '500px'
                        previewDiv.appendChild(object)
                    }
                }

                reader.readAsDataURL(file)
            } else if (event.target.id === 'youtube_url') {
                var url = event.target.value
                var videoId = url.split('v=')[1]
                var ampersandPosition = videoId.indexOf('&')
                if (ampersandPosition !== -1) {
                    videoId = videoId.substring(0, ampersandPosition)
                }
                var iframe = document.createElement('iframe')
                iframe.src = 'https://www.youtube.com/embed/' + videoId
                iframe.width = '100%'
                iframe.height = '500px'
                iframe.frameBorder = '0'
                iframe.allow =
                    'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'
                iframe.allowFullscreen = true
                previewDiv.appendChild(iframe)
            }
        }

        function updateCharCount(fieldId, maxChars) {
            var field = document.getElementById(fieldId)
            var charCount = field.value.length
            var charCountSpan = document.getElementById(fieldId + '-char-count')
            if (charCountSpan) {
                charCountSpan.textContent = charCount + '/' + maxChars
            }
        }

        // Initialize CKEditor
        CKEDITOR.replace('short_description')

        // Trigger media input toggle on page load
        document.addEventListener('DOMContentLoaded', function () {
            toggleMediaInput()
            updateCharCount('project_title', 70)
            updateCharCount('client_name', 35)
            updateCharCount('services_provided', 140)
        })
        $("#services_provided").select2({
      tags: true, // Allow new tags to be created
      placeholder: "Type to search or create a tag",
      minimumInputLength: 2, // Start searching after 2 characters
      multiple: true, // Enable multiple selections
      ajax: {
        url: "{{ route('admin.service-provider.search') }}", // URL for fetching existing tags
        dataType: 'json',
        delay: 250, // Delay to prevent too many requests
        data: function(params) {
          return {
            q: params.term // Send the search term to the server
          };
        },
        processResults: function(data) {
          return {
            results: $.map(data, function(item) {
              return {
                id: item.id,
                text: item.name
              };
            })
          };
        },
        cache: true
      },
      createTag: function(params) {
        var term = $.trim(params.term);

        if (term === '') {
          return null;
        }

        return {
          id: term, // Temporary ID before it's saved on the server
          text: term,
          newTag: true // Mark it as a new tag
        };
      }
    }).on('select2:select', function(e) {
      var data = e.params.data;

      if (data.newTag) {
        // If it's a new tag, send it to the server
        $.ajax({
          url: "{{ route('admin.service-provider.store') }}", // URL to create a new tag
          type: 'POST',
          data: {
            name: data.text, // The new tag name
            _token: '{{ csrf_token() }}' // CSRF token for security
          },
          success: function(response) {
            console.log(response);
            // Replace the temporary ID with the real ID from the server
            var newOption = new Option(response.name, response.id, true, true);
            $('#services_provided').find('option[value="' + data.id + '"]').remove(); // Remove the temporary option
            $('#services_provided').append(newOption).trigger('change'); // Add the new option with the correct ID
          },
          error: function(xhr, status, error) {
            console.error("Tag creation failed: ", error);
          }
        });
      }
    });

    // Handle removing tags correctly
    $('#services_provided').on('select2:unselect', function(e) {

      var data = e.params.data;

      // Remove only the selected option
      $('#services_provided option[value="' + data.id + '"]').remove();
    });
    </script>
@endsection
