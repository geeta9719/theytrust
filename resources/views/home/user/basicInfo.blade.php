@php
    $company = \App\Models\Company::where('user_id', auth()->user()->id)->first();
@endphp
@extends('layouts.home-master')
@section('content')
    <?php
    if (isset($_GET['profile']) && !empty($_GET['profile'])) {
        $profile_type = $_GET['profile'];
    } else {
        $profile_type = '';
    }
    ?>
    <style>
    </style>
    <section class="container-fluid signin-banner animatedParent hero-section ">
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-5 mx-auto text-center">
                        <!--<h2>EDIT PROFILE</h2>-->
                        <!--<h3><strong class="card-title text-black" style="">Logged In With : {{ auth()->user()->email }} </strong></h3>-->
                        <p class="flashmsg">
                            @if (Session::has('message'))
                                <div class="alert alert-danger">{{ Session::get('message') }}</div>
                            @elseif(session('msg'))
                                <div class="alert alert-success">{{ session('msg') }}</div>
                            @endif
                        </p>
                        <!-- <h3>Thank you for signup up and confirming your email</h3> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="formbox container">
        <div class="row  ">
            <div class="col-lg-12">
                <div class="col-lg-12  form-size">
                    <!--<form action="/action_page.php" class="was-validated">-->
                    <form role="form" name="basicAdd" id="basicAdd" class=""
                        action="{{ route('user.saveBasicInfo') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="<?php if (!empty($company->user_id)) {
                            echo $company->user_id;
                        } else {
                            echo auth()->user()->id;
                        } ?>">
                        <input type="hidden" name="form" value="form1">
                        <input type="hidden" name="profile_type" value="<?php if (!empty($profile_type)) {
                            echo $profile_type;
                        } elseif (!empty($company->profile_type)) {
                            echo $company->profile_type;
                        } ?>">
                        <input type="hidden" id="oldLogo" name="oldLogo" value="{{ $company->logo ?? '' }}">

                        <div class="card-body sheet mb-5" id="sheet1">
                            <div class="basicinfo">
                                <h4 class="text-align-center"><strong class="card-title">Let's get some basic
                                        information</strong></h4>
                            </div>


                            <div class="row">
                                <div class="pt-4 col-md-11 mx-auto d-flex align-item-center">
                                    <div class="pt-4 col-md-8 file-field uploadbox">
                                        <h4> Upload Company Logo </h4>
                                        <div class="upload"><strong style="color: red;"> *</strong>
                                            <input type="file" class="rmvId" id="logo" name="logo">
                                            <span class="logocon d-block">(For best results upload a square logo in the
                                                ratio of 512 × 512 pixels.)</span>
                                        </div>
                                    </div>
                                    <div class="pt-4 col-md-4 file-field companylogo">
                                        <img id="logoPreview" src="<?php if (!empty($company->logo)) {
                                            echo $company->logo;
                                        } else {
                                            echo asset('front_components/download.jpeg');
                                        } ?>" width="200" height="auto"
                                            style="border-radius:25px;">
                                    </div>
                                </div>
                            </div>




                            <div class="row">
                                <div class="company-form-box">
                                    <div class=" col-md-6 col-12">
                                        <div class="form-group pt-4">
                                            <label for="name">Organization Name </label><strong style="color: red;">
                                                *</strong>
                                            <input type="text" class="form-control rmvId" id="name" name="name"
                                                value="<?php if (!empty($company->name)) {
                                                    echo $company->name;
                                                } ?>">
                                            <div class="invalid-feedback name rmvCls"></div>
                                        </div>


                                        <div class="form-group">
                                            <label for="website">Website or Company URL (eg: https://example.com)
                                            </label><strong style="color: red;"> *</strong>
                                            <input type="text" class="form-control rmvId" id="website" name="website"
                                                value="<?php if (!empty($company->website)) {
                                                    echo $company->website;
                                                } ?>">
                                            <div class="invalid-feedback website rmvCls"></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="budget">Project Scale</label>
                                            <select class="form-control rmvId" id="budget" name="budget">
                                                <option value="">Select a value</option>
                                                @foreach ($budget as $b)
                                                    <?php
                                                    $bb = explode('-', $b['budget']);
                                                    $bud = $bb[0] . ' -' . $bb[1];
                                                    ?>
                                                    <option value="{{ $b['budget'] }}" <?php if (!empty($company->budget)) {
                                                        echo 'selected';
                                                    } ?>>
                                                        {{ $bud }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback budget rmvCls"></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="rate">Hourly Rate</label>
                                            <select class="form-control rmvId" id="rate" name="rate">
                                                <option value="">Select a value</option>
                                                @foreach ($rate as $b)
                                                    <?php
                                                    $bb = explode('-', $b['rate']);
                                                    $bud = $bb[0] . ' -' . $bb[1];
                                                    ?>
                                                    <option value="{{ $b['rate'] }}" <?php if (!empty($company->rate)) {
                                                        echo 'selected';
                                                    } ?>>
                                                        {{ $bud }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback rate rmvCls"></div>
                                        </div>


                                    </div>


                                    <div class=" col-md-6 col-12 pt-4">
                                        <div class="form-group">
                                            <label for="size">Organization Size</label><strong style="color: red;">
                                                *</strong>
                                            <select class="form-control rmvId" id="size" name="size">
                                                <option value="">Select a value</option>
                                                @foreach ($size as $b)
                                                    <option value="{{ $b->size }}" <?php if (!empty($company->size)) {
                                                        echo 'selected';
                                                    } ?>>
                                                        {{ $b->size }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback size rmvCls"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="founded_at">Company Founded</label>
                                            <select class="form-control rmvId" id="founded_at" name="founded_at">
                                                <option value="">Select a value</option>
                                                <?php for($i=0; $i<=49; $i++){ $y = date('Y'); ?>
                                                <option value="{{ $y - $i }}" <?php if (!empty($company->founded_at)) {
                                                    echo 'selected';
                                                } ?>>
                                                    {{ $y - $i }}</option>
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback founded_at rmvCls"></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="tagline">Title</label><strong style="color: red;"> *</strong>
                                            <input type="text" class="form-control rmvId"
                                                placeholder="This will be displayed as main heading of your listing"
                                                id="tagline" name="tagline" maxlength="50"
                                                value="<?php if (!empty($company->tagline)) {
                                                    echo $company->tagline;
                                                } ?>">
                                            <div class="invalid-feedback tagline rmvCls"></div>
                                            <div id="taglineCharCount" class="char-count">50 characters remaining</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="short_description">Message</label><strong style="color: red;">
                                                *</strong>
                                            <textarea name="short_description" id="short_description" cols="50"
                                                placeholder="Tell us a little bit about your company" rows="5" class="form-control rmvId"
                                                maxlength="5000"><?php if (!empty($company->short_description)) {
                                                    echo $company->short_description;
                                                } ?></textarea>
                                            <div class="invalid-feedback short_description rmvCls"></div>
                                            <div id="charCount" class="char-count">5000 characters remaining</div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center btnbasic">
                                <button type="button" class=" btn-sm basicbtn "
                                    onclick="checkValue()">Next</button>
                                    @if($company)
                                    <button type="button" class=" btn-sm btn-secondary" onclick="saveAndBack()">Save & Exit</button>
                                @endif
                            </div>


                    </form>

                </div>
            </div>

        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('short_description');
            const charCount = document.getElementById('charCount');
            const maxChars = 5000;

            function updateCharCount() {
                const remaining = maxChars - textarea.value.length;
                charCount.textContent = `${remaining} characters remaining`;

                if (remaining < 0) {
                    charCount.style.color = 'red';
                } else {
                    charCount.style.color = 'grey';
                }
            }

            textarea.addEventListener('input', updateCharCount);
            updateCharCount(); // Initialize the count on page load
        });

        document.addEventListener('DOMContentLoaded', function() {
            const logoInput = document.getElementById('logo');
            const logoMessage = document.querySelector('.logocon');

            logoInput.addEventListener('change', function() {
                // This is just an informational message, no restriction
                logoMessage.textContent =
                    "For best results upload a square logo in the ratio of 512 × 512 pixels.";
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const logoInput = document.getElementById('logo');
            const logoPreview = document.getElementById('logoPreview');
            const logoMessage = document.querySelector('.logocon');

            logoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        logoPreview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);

                    // Update the informational message
                    logoMessage.textContent =
                        "For best results upload a square logo in the ratio of 512 × 512 pixels.";
                }
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            const inputField = document.getElementById('tagline');
            const charCount = document.getElementById('taglineCharCount');
            const maxChars = 50;

            function updateCharCount() {
                const remaining = maxChars - inputField.value.length;
                charCount.textContent = `${remaining} characters remaining`;

                if (remaining < 0) {
                    charCount.style.color = 'red';
                } else {
                    charCount.style.color = 'grey';
                }
            }

            inputField.addEventListener('input', updateCharCount);
            updateCharCount(); // Initialize the count on page load
        })


        $('.date').datepicker({
            format: 'mm-dd-yyyy'
        });

        var checkValue;
        $(document).ready(function() {
            checkValue = function() {
                var ser = new FormData($('#basicAdd')[0]);
                //var ser = $('#basicAdd').serialize();
                console.log(ser);
                jQuery.ajax({
                    url: "{{ url('get-listed-validation-step') }}",
                    type: "POST",
                    data: ser,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        console.log(result);
                        $(".rmvCls").html('');
                        $(".rmvId").removeClass('is-invalid');
                        var count = Object.keys(result).length;
                        if (count > 0) {
                            $.each(result, function(key, value) {
                                //console.log(key);
                                //console.log(value);
                                $("." + key).html(value).show();
                                $("#" + key).addClass('is-invalid');
                            });
                            //window.history.pushState('', '', 'companies?'+ser);
                            $(".alert").html('');
                            $(".alert").removeClass('alert-success');
                            $(".alert").removeClass('alert-danger');
                            $("html, body").animate({
                                scrollTop: "0"
                            });
                        } else {
                            $("#basicAdd").submit();
                        }
                    },
                    error: function(result) {
                        console.log("error");
                        console.log(result);
                    }
                });
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Existing code...

            window.saveAndBack = function() {
                // Add a hidden input to indicate "save and back" action
                const form = document.getElementById('basicAdd');
                const saveBackInput = document.createElement('input');
                saveBackInput.type = 'hidden';
                saveBackInput.name = 'save_and_back';
                saveBackInput.value = '1';
                form.appendChild(saveBackInput);

                // Submit the form
                checkValue();
            }
        })
    </script>
@endsection
