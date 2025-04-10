@extends('layouts.home-master')

@section('content')

<style>
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
    margin-top: 8px;
    margin-bottom: 10px;
    display: block;
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
    .port-sec .char-count {
   
    margin-bottom: 0;}}
</style>
<section class="container-fluid create-sec ">
   
                    <h1>Add Portfolio Item</h1>
                   
            
</section>

<div class="row pt-5">
    <div class="col-md-12 m-0 p-0 ">
        @if ($errors->any())
        <div class="alert alert-danger">
            {!! implode('', $errors->all('<div>:message</div>')) !!}
        </div>
    @endif

    @if (session()->has('newsuccess'))
        <div class="alert alert-success">
            {{ session()->get('newsuccess') }}
        </div>
    @endif
    </div>
</div>
<div class="container">

    <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
        <div class="row port-sec">
            <div class="col-md-6">
        <label for="media_type">Select Media Type</label>
        <select name="media_type" id="media_type" onchange="toggleMediaInput()">
            <option value="image_pdf" {{ old('media_type') == 'image_pdf' ? 'selected' : '' }}>Image or PDF File</option>
            <option value="youtube_url" {{ old('media_type') == 'youtube_url' ? 'selected' : '' }}>YouTube Video URL</option>
        </select>
        <div class="error-message" id="media_type_error"></div>

        <div id="file_input_div" style="{{ old('media_type') == 'youtube_url' ? 'display:none;' : '' }}">
            <label for="media" class="mt-4">Add Image or PDF</label>
            <input type="file" name="media" id="media" accept="image/*,.pdf" onchange="showPreview(event)">
            <div class="error-message" id="media_error"></div>
        </div>
        <div id="url_input_div" style="{{ old('media_type') == 'youtube_url' ? 'display:block;' : 'display:none;' }}">
            <label for="youtube_url" >Insert YouTube Video URL</label>
            <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url') }}" onchange="showPreview(event)">
            <div class="error-message" id="youtube_url_error"></div>
        </div>

        <label for="project_title" class="mt-4">Project Title</label>
        <input type="text" name="project_title" id="project_title" value="{{ old('project_title') }}" maxlength="70" oninput="updateCharCount('project_title', 70)">
        <span class="char-count" id="project_title-char-count">0/70</span>
        <div class="error-message" id="project_title_error"></div>

        <label for="client_name">Client Name</label>
        <input type="text" name="client_name" id="client_name" value="{{ old('client_name') }}" maxlength="35" oninput="updateCharCount('client_name', 35)">
        <span class="char-count" id="client_name-char-count">0/35</span>
        <div class="error-message" id="client_name_error"></div>

        <label for="country_location">Country / Location</label>
        <input type="text" name="country_location" id="country_location" value="{{ old('country_location') }}">
        <div class="error-message" id="country_location_error"></div>
        <label for="engagement_start_date" class="mt-4">Engagement Start Date</label>
        <input type="date" name="engagement_start_date" id="engagement_start_date" value="{{ old('engagement_start_date') }}">
        <div class="error-message" id="engagement_start_date_error"></div>

        <label for="engagement_end_date" class="mt-4">Engagement End Date</label>
        <input type="date" name="engagement_end_date" id="engagement_end_date" value="{{ old('engagement_end_date') }}">
        <div class="error-message" id="engagement_end_date_error"></div>
        </div>
        <div class="col-md-6">
        <div id="preview"></div>



        <label for="short_description">Short Description</label>
        <textarea name="short_description" id="short_description">{{ old('short_description') }}</textarea>
        <div class="error-message" id="short_description_error"></div>


        <div class="form-group mt-1">
            <label for="services_provided" class="mt-4">What services did you receive from <b>  for eg. Digital Marketing, Web design, Mobile App development)
            <strong style="color: red;"> *</strong> </label>
            <select id="services_provided" name="services_provided[]" class="form-control" multiple="multiple"></select>
            <span class="error-message">Please enter 2 or more characters</span>
        </div>

        

        

      
        </div>
   
    </div>
    <div class="row port-sec">
    <div class="col-md-12 text-center mt-3">
    <button type="submit">Save</button> </div>
    </div>
    </form>

    <!-- <div id="preview"></div> -->
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function toggleMediaInput() {
        var mediaType = document.getElementById('media_type').value;
        var fileInputDiv = document.getElementById('file_input_div');
        var urlInputDiv = document.getElementById('url_input_div');
        var previewDiv = document.getElementById('preview');
        previewDiv.innerHTML = '';

        if (mediaType === 'image_pdf') {
            fileInputDiv.style.display = 'block';
            urlInputDiv.style.display = 'none';
        } else {
            fileInputDiv.style.display = 'none';
            urlInputDiv.style.display = 'block';
        }
    }

    function showPreview(event) {
        var previewDiv = document.getElementById('preview');
        previewDiv.innerHTML = '';

        if (event.target.id === 'media') {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var fileType = file.type;
                if (fileType.startsWith('image/')) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    previewDiv.appendChild(img);
                } else if (fileType === 'application/pdf') {
                    var object = document.createElement('object');
                    object.data = e.target.result;
                    object.type = 'application/pdf';
                    object.width = '100%';
                    object.height = '500px';
                    previewDiv.appendChild(object);
                }
            };

            reader.readAsDataURL(file);
        } else if (event.target.id === 'youtube_url') {
            var url = event.target.value;
            var videoId = url.split('v=')[1];
            var ampersandPosition = videoId.indexOf('&');
            if (ampersandPosition !== -1) {
                videoId = videoId.substring(0, ampersandPosition);
            }
            var iframe = document.createElement('iframe');
            iframe.src = 'https://www.youtube.com/embed/' + videoId;
            iframe.width = '100%';
            iframe.height = '500px';
            iframe.frameBorder = '0';
            iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
            iframe.allowFullscreen = true;
            previewDiv.appendChild(iframe);
        }
    }

    function validateForm() {
        var isValid = true;

        // Clear previous error messages
        document.querySelectorAll('.error-message').forEach(function(el) {
            el.textContent = '';
        });

        // Validate Media Type Input
        var mediaType = document.getElementById('media_type').value;
        if (mediaType === 'image_pdf') {
            var mediaInput = document.getElementById('media');
            if (mediaInput.files.length === 0) {
                isValid = false;
                document.getElementById('media_error').textContent = 'Please add an Image or PDF file.';
            }
        } else {
            var youtubeUrlInput = document.getElementById('youtube_url');
            if (youtubeUrlInput.value.trim() === '') {
                isValid = false;
                document.getElementById('youtube_url_error').textContent = 'Please insert a YouTube Video URL.';
            }
        }

        // Validate Project Title
        var projectTitleInput = document.getElementById('project_title');
        if (projectTitleInput.value.trim() === '') {
            isValid = false;
            document.getElementById('project_title_error').textContent = 'Project Title is required.';
        } else if (projectTitleInput.value.length > 70) {
            isValid = false;
            document.getElementById('project_title_error').textContent = 'Project Title must be less than or equal to 70 characters.';
        }

        // Validate Client Name
        var clientNameInput = document.getElementById('client_name');
        if (clientNameInput.value.trim() === '') {
            isValid = false;
            document.getElementById('client_name_error').textContent = 'Client Name is required.';
        } else if (clientNameInput.value.length > 35) {
            isValid = false;
            document.getElementById('client_name_error').textContent = 'Client Name must be less than or equal to 35 characters.';
        }

        // Validate Country / Location
        var countryLocationInput = document.getElementById('country_location');
        if (countryLocationInput.value.trim() === '') {
            isValid = false;
            document.getElementById('country_location_error').textContent = 'Country / Location is required.';
        }

        // Validate Services Provided
        var servicesProvidedInput = document.getElementById('services_provided');
        const servicesProvided = servicesProvidedInput.value.trim();
        if (servicesProvided === '') {
            isValid = false;
            document.getElementById('services_provided_error').textContent = 'Services Provided is required.';
        } else {
            const servicesProvidedTags = servicesProvided.split(',');
            if (servicesProvidedTags.length > 5 || servicesProvided.length > 140) {
                isValid = false;
                document.getElementById('services_provided_error').textContent = 'Services Provided must be up to 5 comma-separated keywords and not exceed 140 characters.';
            }
        }

        // Validate Short Description
        var shortDescriptionInput = CKEDITOR.instances.short_description;
        if (shortDescriptionInput.getData().trim() === '') {
            isValid = false;
            document.getElementById('short_description_error').textContent = 'Short Description is required.';
        }

        // Validate Engagement Start Date
        var engagementStartDateInput = document.getElementById('engagement_start_date');
        if (engagementStartDateInput.value.trim() === '') {
            isValid = false;
            document.getElementById('engagement_start_date_error').textContent = 'Engagement Start Date is required.';
        }

        // Validate Engagement End Date
        var engagementEndDateInput = document.getElementById('engagement_end_date');
        if (engagementEndDateInput.value.trim() === '') {
            isValid = false;
            document.getElementById('engagement_end_date_error').textContent = 'Engagement End Date is required.';
        }

        return isValid;
    }

    function updateCharCount(fieldId, maxChars) {
        var field = document.getElementById(fieldId);
        var charCount = field.value.length;
        var charCountSpan = document.getElementById(fieldId + '-char-count');
        if (charCountSpan) {
            charCountSpan.textContent = charCount + '/' + maxChars;
        }
    }

    // Initialize CKEditor
    CKEDITOR.replace('short_description');

    // Trigger media input toggle on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleMediaInput();
    });
    $(document).ready(function() {
    // Initialize Select2 with AJAX search and tag creation functionality
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
});
</script>
@endsection
