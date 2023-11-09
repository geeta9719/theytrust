@extends('layouts.admin-master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Review</h3>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.company.update', ['viewreview' => $data['review']->id]) }}">
                                @csrf
                                @method('PUT')

                                <!-- Company Name -->
                                <div class="form-group">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" name="company_name" class="form-control" value="{{ $data['review']->company_name }}">
                                </div>

                                <!-- Project Type -->
                                <div class="form-group">
                                <label for="project_type">Choose project type</label><strong style="color: red;"> *</strong>
                                <select class="form-control" id="project_type" name="project_type" required>
                                    <option value="">Select a value</option>
                                    @foreach($data['category'] as $cat)
                                        @foreach($cat->subcategory as $c)
                                            <option value="{{$c->subcategory}}" @if($c->subcategory == $data['review']->project_type) selected @endif>{{$c->subcategory}}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>

                                <!-- Project Title -->
                                <div class="form-group">
                                    <label for="project_title">Project Title</label>
                                    <input type="text" name="project_title" class="form-control" value="{{ $data['review']->project_title }}">
                                </div>

                                <!-- Company Type -->
                                                            <div class="form-group">
                                <l  abel for="company_type">Choose your company type</label><strong style="color: red;"> *</strong>
                                <select class="form-control rmvId" id="company_type" name="company_type" required>
                                    <option value="">Select a value</option>
                                    @foreach($data['category'] as $cat)
                                        <option value="{{ $cat->category }}" @if($cat->category == $data['review']->company_type) selected @endif>{{ $cat->category }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback company_type rmvCls"></div>
                            </div>


                            <div class="form-group">
    <label for="cost_range">Project Value Range</label><strong style="color: red;"> *</strong>
    <select class="form-control rmvId" id="cost_range" name="cost_range" required>
        <option value="">Select a value</option>
        @foreach($data['budget'] as $b)
            <?php 
                $bb = explode('-', $b['budget']);
                $budget_range = '$' . $bb[0] . ' - $' . $bb[1];
            ?>
            <option value="{{ $b['budget'] }}" @if($b['budget'] == $data['review']->cost_range) selected @endif>{{ $budget_range }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback cost_range rmvCls"></div>
</div>


                      <!-- Project Start -->
<div class="form-group">
    <label for="project_start">Project Start</label>
    <input type="date" name="project_start" class="form-control" value="{{ $data['review']->project_start }}">
</div>

<!-- Project End -->
<div class="form-group">
    <label for="project_end">Project End</label>
    <input type="date" name="project_end" class="form-control" value="{{ $data['review']->project_end }}">
</div>


                                <!-- Company Position -->
                                <div class="form-group">
                                    <label for="company_position">Company Position</label>
                                    <input type="text" name="company_position" class="form-control" value="{{ $data['review']->company_position }}">
                                </div>

                                <!-- For What Project -->
                                <div class="form-group">
                                    <label for="for_what_project">For What Project</label>
                                    <input type="text" name="for_what_project" class="form-control" value="{{ $data['review']->for_what_project }}">
                                </div>

                                <!-- How Select -->
                                <div class="form-group">
                                    <label for="how_select">How Select</label>
                                    <input type="text" name="how_select" class="form-control" value="{{ $data['review']->how_select }}">
                                </div>

                                <!-- Scope Of Work -->
                                <div class="form-group">
                                    <label for="scope_of_work">Scope Of Work</label>
                                    <input type="text" name="scope_of_work" class="form-control" value="{{ $data['review']->scope_of_work }}">
                                </div>

                                <!-- Team Composition -->
                                <div class="form-group">
                                    <label for="team_composition">Team Composition</label>
                                    <input type="text" name="team_composition" class="form-control" value="{{ $data['review']->team_composition }}">
                                </div>

                                <!-- Any Outcomes -->
                                <div class="form-group">
                                    <label for="any_outcomes">Any Outcomes</label>
                                    <input type="text" name="any_outcomes" class="form-control" value="{{ $data['review']->any_outcomes }}">
                                </div>

                                <!-- How Effective -->
                                <div class="form-group">
                                    <label for="how_effective">How Effective</label>
                                    <input type="text" name="how_effective" class="form-control" value="{{ $data['review']->how_effective }}">
                                </div>

                                <!-- Most Impressive -->
                                <div class="form-group">
                                    <label for="most_impressive">Most Impressive</label>
                                    <input type="text" name="most_impressive" class="form-control" value="{{ $data['review']->most_impressive }}">
                                </div>

                                <!-- Area Of Improvements -->
                                <div class="form-group">
                                    <label for="area_of_improvements">Area Of Improvements</label>
                                    <input type="text" name="area_of_improvements" class="form-control" value="{{ $data['review']->area_of_improvements }}">
                                </div>

                                <!-- Quality -->
                                <div class="form-group">
                                    <label for="quality">Quality</label>
                                    <input type="text" name="quality" class="form-control" value="{{ $data['review']->quality }}">
                                </div>

                                <!-- Quality Review -->
                                <div class="form-group">
                                    <label for="quality_review">Quality Review</label>
                                    <input type="text" name="quality_review" class="form-control" value="{{ $data['review']->quality_review }}">
                                </div>

                                <!-- Timeliness -->
                                <div class="form-group">
                                    <label for="timeliness">Timeliness</label>
                                    <input type="text" name="timeliness" class="form-control" value="{{ $data['review']->timeliness }}">
                                </div>

                                <!-- Timeliness Review -->
                                <div class="form-group">
                                    <label for="timeliness_review">Timeliness Review</label>
                                    <input type="text" name="timeliness_review" class="form-control" value="{{ $data['review']->timeliness_review }}">
                                </div>

                                <!-- Cost -->
                                <div class="form-group">
                                    <label for="cost">Cost</label>
                                    <input type="text" name="cost" class="form-control" value="{{ $data['review']->cost }}">
                                </div>

                                <!-- Cost Review -->
                                <div class="form-group">
                                    <label for="cost_review">Cost Review</label>
                                    <input type="text" name="cost_review" class="form-control" value="{{ $data['review']->cost_review }}">
                                </div>

                                <!-- Communication -->
                                <div class="form-group">
                                    <label for="communication">Communication</label>
                                    <input type="text" name="communication" class="form-control" value="{{ $data['review']->communication }}">
                                </div>

                                <!-- Communication Review -->
                                <div class="form-group">
                                    <label for="communication_review">Communication Review</label>
                                    <input type="text" name="communication_review" class="form-control" value="{{ $data['review']->communication_review }}">
                                </div>

                                <!-- Expertise -->
                                <div class="form-group">
                                    <label for="expertise">Expertise</label>
                                    <input type="text" name="expertise" class="form-control" value="{{ $data['review']->expertise }}">
                                </div>

                                <!-- Expertise Review -->
                                <div class="form-group">
                                    <label for="expertise_review">Expertise Review</label>
                                    <input type="text" name="expertise_review" class="form-control" value="{{ $data['review']->expertise_review }}">
                                </div>

                                <!-- Ease of Working -->
                                <div class="form-group">
                                    <label for="ease_of_working">Ease of Working</label>
                                    <input type="text" name="ease_of_working" class="form-control" value="{{ $data['review']->ease_of_working }}">
                                </div>

                                <!-- Ease of Working Review -->
                                <div class="form-group">
                                    <label for="ease_of_working_review">Ease of Working Review</label>
                                    <input type="text" name="ease_of_working_review" class="form-control" value="{{ $data['review']->ease_of_working_review }}">
                                </div>

                                <!-- Refer-ability -->
                                <div class="form-group">
                                    <label for="refer_ability">Refer-ability</label>
                                    <input type="text" name="refer_ability" class="form-control" value="{{ $data['review']->refer_ability }}">
                                </div>

                                <!-- Refer-ability Review -->
                                <div class="form-group">
                                    <label for="refer_ability_review">Refer-ability Review</label>
                                    <input type="text" name="refer_ability_review" class="form-control" value="{{ $data['review']->refer_ability_review }}">
                                </div>

                                <!-- Overall Rating -->
                                <div class="form-group">
                                    <label for="overall_rating">Overall Rating</label>
                                    <input type="text" name="overall_rating" class="form-control" value="{{ $data['review']->overall_rating }}">
                                </div>

                                <!-- Overall Rating Review -->
                                <div class="form-group">
                                    <label for="overall_rating_review">Overall Rating Review</label>
                                    <input type="text" name="overall_rating_review" class="form-control" value="{{ $data['review']->overall_rating_review }}">
                                </div>

                                <!-- Full Name -->
                                <div class="form-group">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" name="full_name" class="form-control" value="{{ $data['review']->full_name }}">
                                </div>

                                <!-- Position Title -->
                                <div class="form-group">
                                    <label for="position_title">Position Title</label>
                                    <input type="text" name="position_title" class="form-control" value="{{ $data['review']->position_title }}">
                                </div>

                                <!-- Company Size -->
                                <div class="form-group">
                                    <label for="company_size">Company Size</label>
                                    <input type="text" name="company_size" class="form-control" value="{{ $data['review']->company_size }}">
                                </div>

                                <!-- City -->
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city" class="form-control" value="{{ $data['review']->city }}">
                                </div>

                                <!-- State -->
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" name="state" class="form-control" value="{{ $data['review']->state }}">
                                </div>

                                <!-- Country -->
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" name="country" class="form-control" value="{{ $data['review']->country }}">
                                </div>

                                <!-- Company Email -->
                                <div class="form-group">
                                    <label for="company_email">Company Email</label>
                                    <input type="text" name="company_email" class="form-control" value="{{ $data['review']->company_email }}">
                                </div>

                                <!-- Phone Number -->
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" value="{{ $data['review']->phone_number }}">
                                </div>

                                <!-- Linkedin Url -->
                                <div class="form-group">
                                    <label for="linkedin_url">LinkedIn URL</label>
                                    <input type="text" name="linkedin_url" class="form-control" value="{{ $data['review']->linkedin_url }}">
                                </div>

                                <!-- Company Url -->
                                <div class="form-group">
                                    <label for="company_url">Company URL</label>
                                    <input type="text" name="company_url" class="form-control" value="{{ $data['review']->company_url }}">
                                </div>

                                <!-- Status -->
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" name="status" class="form-control" value="{{ $data['review']->status }}">
                                </div>

                                <!-- Project Summary -->
                                <div class="form-group">
                                    <label for="project_summary">Project Summary</label>
                                    <textarea name="project_summary" class="form-control">{{ $data['review']->project_summary }}</textarea>
                                </div>

                                <!-- Feedback Summary -->
                                <div class="form-group">
                                    <label for="feedback_summary">Feedback Summary</label>
                                    <textarea name="feedback_summary" class="form-control">{{ $data['review']->feedback_summary }}</textarea>
                                </div>

                                <!-- Published -->
                                <div class="form-group">
                                    <label for="published">Published</label>
                                    <select name="published" class="form-control">
                                        <option value="1" {{ $data['review']->published == 1 ? 'selected' : '' }}>Published</option>
                                        <option value="0" {{ $data['review']->published == 0 ? 'selected' : '' }}>Not Published</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
