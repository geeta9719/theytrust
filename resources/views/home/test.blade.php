@extends('layouts.home-master')

@section('content')
    <style>
        /* Hide radio buttons */
        input[type="radio"].visually-hidden {
            position: absolute;
            clip: rect(0, 0, 0, 0);
            pointer-events: none;
        }

        /* Style the label of the selected category */
        input[type="radio"]:checked+label {
            background-color: #f0f8ff;
            /* Light blue background */
            color: #333;
            /* Dark text color */
        }
    </style>
    <!-- listing section start -->
    <section class="container-fluid list-top">
        <div class="container">
            <a href="">Home | Company Profile</a>
        </div>
    </section>

    <style>
        .selected-label {
            background-color: lightblue;
        }
    </style>

    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif


    <section class="container-fluid mt-5 mb-5 list-box">
        <form id="categoryForm">
            <div id="primarySkillSection" class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <h4 class="font-weight-bold">Primary Skill</h4>
                    <div id="sessionMessage" class="card p-3 mb-3">
                        <!-- Content goes here -->
                    </div>
                </div>
            </div>
            <div id="primarySkillSection" class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <h4 class="font-weight-bold">Sub Category</h4>
                    <div id="sessionSubcategory" class="card p-3 mb-3">
                        <!-- Content goes here -->
                    </div>
                </div>
            </div>

            <div class="container">
                <br>
                <br>

                {{-- <form id="categoryForm"> --}}
                <div class="row">
                    <div class="col-md-3">
                        <fieldset>
                            <legend>Choose Primary Service</legend>
                            @foreach ($categories as $category)
                                <div>
                                    <input type="checkbox" id="{{ strtolower(str_replace(' ', '', $category->id)) }}"
                                        name="primaryService[]"
                                        value="{{ strtolower(str_replace(' ', '', $category->id)) }}"
                                        data-category-name="{{ $category->category }}" class="primary-service">
                                    <label
                                        for="{{ strtolower(str_replace(' ', '', $category->id)) }}">{{ $category->category }}</label>
                                </div>
                            @endforeach

                        </fieldset>
                    </div>

                    <div class="col-md-3">
                        <fieldset>
                            <legend>Choose Sub Category</legend>
                            <div id="subCategoryFieldset"></div>
                        </fieldset>
                    </div>

                    <div class="col-md-3">
                        <fieldset>
                            <legend>Choose Skills</legend>
                            <div id="Skills"></div>
                            <!-- Skills checkboxes will go here -->
                        </fieldset>
                    </div>

                    <div class="col-md-3">
                        <fieldset>
                            <legend>Choose Deep Skill Tags</legend>
                            <!-- Deep skill tags checkboxes will go here -->
                        </fieldset>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary submit">Submit</button>
                    </div>
                </div>
        </form>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.primary-service').change(function() {
                var selectedCategory = $(this).val();
                var categoryName = $(this).data('category-name');
                var categoryNameSlug = generateSlug(categoryName);
                $('.selected-label').removeClass('selected-label');
                var selectedLabel = $('label[for="' + $(this).attr('id') + '"]');
                selectedLabel.addClass('selected-label');

                if ($(this).is(':checked')) {

                    var selectedCategories = JSON.parse(localStorage.getItem('selectedCategories')) || [];
                    if (!selectedCategories.includes(selectedCategory)) {
                        selectedCategories.push(selectedCategory);
                    }
                    localStorage.setItem('selectedCategories', JSON.stringify(selectedCategories));
                    generateCategoryNameTextbox(selectedCategory, categoryName);
                } else {
                    // Remove deselected category from localStorage
                    var selectedCategories = JSON.parse(localStorage.getItem('selectedCategories')) || [];
                    var index = selectedCategories.indexOf(selectedCategory);
                    if (index !== -1) {
                        selectedCategories.splice(index, 1);
                    }
                    localStorage.setItem('selectedCategories', JSON.stringify(selectedCategories));
                    var subCategoryDivId = categoryNameSlug + '_subCategorydiv';
                    $('#' + selectedCategory).remove();
                    $('#' + subCategoryDivId).remove();
                }

                $.ajax({
                    url: '/api/subcategories',
                    type: 'GET',
                    data: {
                        categories: selectedCategory
                    },
                    success: function(response) {
                        var subCategoryFieldset = $('#subCategoryFieldset');
                        subCategoryFieldset.empty();

                        if (response.length > 0) {
                            var html = '<div>';
                            for (var i = 0; i < response.length; i++) {
                                html += '<input type="checkbox" id="' + response[i].id +
                                    '" name="subCategory[]" value="' + response[i].subcategory +
                                    '" class="subcategory-checkbox" data-name="' + response[i]
                                    .category_name + '">';
                                html += '<label for="' + response[i].id + '"> ' + response[i]
                                    .subcategory + '</label><br>';
                            }
                            html += '</div>';
                            subCategoryFieldset.append(html);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
            // $('.primary-service + label').click(function() {
            //     $('.selected-label').removeClass('selected-label');
            //     $(this).toggleClass('selected-label');


            //     var selectedCategory = $(this).attr('for');
            //     var categoryName = $(this).prev('input[type="checkbox"]').data('category-name');
            //     console.log(categoryName);
            //     const TextBoxdivId = checkIfSubCategoryExists(categoryName);


            //     $.ajax({
            //         url: '/api/subcategories',
            //         type: 'GET',
            //         data: {
            //             categories: selectedCategory
            //         },
            //         success: function(response) {
            //             var subCategoryFieldset = $('#subCategoryFieldset');
            //             subCategoryFieldset.empty();

            //             if (response.length > 0) {
            //                 var html = '<div>';
            //                 for (var i = 0; i < response.length; i++) {
            //                     html += '<input type="checkbox" id="' + response[i].id +
            //                         '" name="subCategory[]" value="' + response[i].subcategory +
            //                         '" class="subcategory-checkbox" data-name="' + response[i]
            //                         .category_name + '">';
            //                     html += '<label for="' + response[i].id + '"> ' + response[i]
            //                         .subcategory + '</label><br>';
            //                 }
            //                 html += '</div>';
            //                 subCategoryFieldset.append(html);
            //             }
            //         },
            //         error: function(xhr, status, error) {
            //             console.error(error);
            //         }
            //     });
            // });

            $('.primary-service + label').click(function() {
                $('.selected-label').removeClass('selected-label');
                $(this).toggleClass('selected-label');

                var selectedCategory = $(this).attr('for');
                var categoryName = $(this).prev('input[type="checkbox"]').data('category-name');

                const TextBoxdivId = checkIfSubCategoryExists(categoryName);
                $.ajax({
                    url: '/api/subcategories',
                    type: 'GET',
                    data: {
                        categories: selectedCategory
                    },
                    success: function(response) {
                        var subCategoryFieldset = $('#subCategoryFieldset');
                        subCategoryFieldset.empty();

                        if (response.length > 0) {
                            var html = '<div>';
                            for (var i = 0; i < response.length; i++) {
                                html += '<input type="checkbox" id="' + response[i].id +
                                    '" name="subCategory[]" value="' + response[i].subcategory +
                                    '" class="subcategory-checkbox" data-name="' + response[i]
                                    .category_name + '">';

                                html += '<label for="' + response[i].id + '"> ' + response[i]
                                    .subcategory + '</label><br>';
                            }
                            html += '</div>';
                            subCategoryFieldset.append(html);

                            // Now that checkboxes are appended, check them based on certain condition
                            $('.SubCategoryNameText').each(function() {
                                var subcategoryName = $(this).data('subcategoryname');
                                console.log(subcategoryName, "Asdfasdf");
                                subCategoryFieldset.find('input[type="checkbox"]').each(
                                    function() {
                                        console.log(this.value, "asdfasdf")
                                        if (this.value === subcategoryName) {
                                            debugger
                                            $(this).prop('checked', true);
                                        }
                                    });
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

            });

            $(document).on('change', '.subcategory-checkbox', function() {
                var categoryname = $(this).data('name');
                var subCategoryName = $(this).val();
                const subcategoryslug = generateSlug(subCategoryName);

                var primaryCategory = $('.primary-service[data-category-name="' + categoryname + '"]');
                var isChecked = primaryCategory.is(':checked');


                if (isChecked) {
                    if ($(this).is(':checked')) {
                        var categoryslug = generateSlug($(this).data('name'));
                        hitAPIAndCreateCheckbox(subCategoryName, subcategoryslug, subcategoryslug);
                        generateSubCategoryNameTextbox($(this).data('name'), categoryslug, subcategoryslug,
                            subCategoryName);
                    } else {
                        removeElementAndParentIfSingleChild(subcategoryslug);
                    }
                } else {
                    alert("select  the Primay  Category")
                    $(this).prop('checked', false);

                }
            });



            // Generate input field for category name
            function generateCategoryNameTextbox(categoryid, categoryName) {
                var categoryContainer = $('<div class="row category-container" id="' + categoryid +
                    '"></div>'); // Assign categoryid as the ID

                var labelColumn = $('<div class="col-md-3"></div>'); // Label column with col-3 width
                var inputColumn = $('<div class="col-md-9"></div>'); // Input column

                var categoryNameLabel = $('<label class="category-label font-weight-bold" for="' + categoryid +
                    '">' + categoryName + ': </label>'); // Bold label

                var categoryNameInput = $('<input type="text" class="form-control form-control-sm" name="' +
                    categoryid + '" id="' + categoryid + '" placeholder="Enter ' +
                    categoryName + ' name">'); // Small text box

                labelColumn.append(categoryNameLabel); // Append label to label column
                inputColumn.append(categoryNameInput); // Append input field to input column

                categoryContainer.append(labelColumn, inputColumn); // Append both columns to the row
                $('#sessionMessage').append(categoryContainer);
            }




            // Generate slug from input string
            function generateSlug(inputString) {
                return inputString.toLowerCase().replace(/\s+/g,
                        '-') // Convert to lowercase and replace spaces with hyphens
                    .replace(/[^\w\-]+/g, '') // Remove non-word characters except hyphens
                    .replace(/\-\-+/g, '-') // Replace multiple consecutive hyphens with single hyphen
                    .replace(/^-+/, '') // Remove leading hyphens
                    .replace(/-+$/, ''); // Remove trailing hyphens
            }


            function generateSubCategoryNameText(slug, subCategoryName) {
                var subCategoryNameTextbox =
                    '<div class="card-body p-3 mb-3  SubCategoryNameText" id="subCategoryName_' + slug +
                    '" data-subcategoryname="' + subCategoryName + '">' +
                    '<label for="subCategoryName_input' + slug + '">' + subCategoryName + ':</label>' +
                    '<div><input type="text" name="subCategoryName" id="subCategoryName_input' + slug +
                    '" class="form-control form-control-sm" placeholder="Enter ' + subCategoryName +
                    ' name"></div>' +
                    '</div>';
                return subCategoryNameTextbox;
            }



            function generateSubCategoryNameTextbox(categoryname, categoryslug, subcategoryslug, subCategoryName) {
                console.log(categoryslug, "slug");
                var subCategoryDivExists = checkSubCategoryDivExistence(categoryslug);
                console.log(subCategoryDivExists);

                if (!subCategoryDivExists) {
                    var subCategoryDivId = categoryslug + '_subCategorydiv';
                    var subCategoryContainer = $('<div class="card p-3 mb-3" id="' + subCategoryDivId +
                        '" data-categoryname="' + categoryname + '"></div>'); // Added padding and margin
                    var subCategoryCardBody = $('<div class="card-body"></div>');
                    var subCategoryHeading = $('<h5 class="card-title font-weight-bold">' + categoryname +
                        '</h5>'); // Made the card-title bold

                    subCategoryCardBody.append(subCategoryHeading);
                    subCategoryContainer.append(subCategoryCardBody);

                    $('#sessionSubcategory').append(subCategoryContainer);
                }

                $('#' + categoryslug + '_subCategorydiv').append(generateSubCategoryNameText(subcategoryslug,
                    subCategoryName));
            }

            // Check if subcategory div exists
            function checkSubCategoryDivExistence(categoryslug) {
                var subCategoryDivId = categoryslug + '_subCategorydiv';
                var subCategoryDivExists = $('#' + subCategoryDivId).length > 0;

                return subCategoryDivExists;
            }

            function removeElementAndParentIfSingleChild(subcategoryslug) {
                var elementToRemove = $('#subCategoryName_' + subcategoryslug);
                var parentDiv = elementToRemove.parent('.card');

                // Check if the parent div has only one child element
                if (parentDiv.children('.card-body').length === 2) {
                    // If only one child element, remove both the parent and child elements
                    parentDiv.remove();
                } else {
                    // If more than one child element, remove only the child element
                    elementToRemove.remove();
                }
                $('#Skills .' + subcategoryslug).remove();
            }




            function validateInputValues() {
                var totalValue = 0;
                var $errorMessage = $('<div class="error-message"></div>'); // Create a new error message element
                var $textboxes = $('#sessionMessage input[type="text"]');
                $('.error-message').remove();
                $textboxes.css('border-color', '');

                // Calculate total value and highlight textbox if total exceeds 100
                $textboxes.each(function() {
                    var value = parseFloat($(this).val());
                    if (!isNaN(value)) {
                        totalValue += value;
                    }
                });

                if (totalValue > 100) {
                    var excessValue = totalValue - 100;
                    $errorMessage.text('Total value cannot exceed 100. Excess: ' + excessValue.toFixed(2));

                    // Highlight the first exceeding textbox
                    var currentTotal = 0;
                    $textboxes.each(function() {
                        var value = parseFloat($(this).val());
                        if (!isNaN(value)) {
                            currentTotal += value;
                            if (currentTotal > 100) {
                                $(this).css('border-color', 'red');
                                return false; // Exit the loop after highlighting the first exceeding textbox
                            }
                        }
                    });

                    $('#sessionMessage').append($errorMessage); // Append the error message below the textboxes
                }
            }
            $('.submit').click(function() {
                validateInputValues();
            });

            function hitAPIAndCreateCheckbox(subCategoryName, subcategoryslug, subcategoryslug) {
                console.log(subcategoryslug, "subcategoryslug");
                $.ajax({
                    url: '/api/skill',
                    type: 'get',
                    data: {
                        id: subcategoryslug // Assuming you're passing the subcategory slug as the ID
                    },
                    success: function(response) {
                        response.forEach(function(skill) {
                            var checkbox = $('<div class="form-check ' + subcategoryslug +'">' +
                                '<input class="form-check-input" type="checkbox" name="softSkills[]" id="softSkill_' +
                                skill.id + '" value="' + skill.id + '">' +
                                '<label class="form-check-label" for="softSkill_' + skill
                                .id + '">' + skill.name + '</label>' +
                                '</div>');

                            $('#Skills').append(checkbox);
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(error);
                    }
                });
            }

        });

        function checkIfSubCategoryExists(selectedCategory) {
            var foundId = false;
            $('#sessionSubcategory > div[data-categoryname="' + selectedCategory + '"]').each(function() {
                foundId = $(this).attr('id');
                return false;
            });

            return foundId;
        }
    </script>
@endsection
