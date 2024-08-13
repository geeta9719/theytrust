@extends('layouts.home-master')
@section('content')
<style>
	.maincard .collapse {
		background-color: #fff;
	}
	.inner-subcat h3 {
		color: #2cc8dd;
		font-size: 14px;
		font-family: "Inter", sans-serif;
		font-weight: 400;
	}

	.card-body {
		padding: 0;
	}

	.card {
		border: 0;
	}

	.card-body a {
		color: #5b6371;
		font-size: 14px;
		font-family: "Inter", sans-serif;
		font-weight: 400;
		/* margin-left: 56px; */
		padding: 5px 0px 5px 51px;
		text-decoration: none;
		display: flex;
		width: 100%;
	}
	.innercard .collapsed a::after {
		display: none;
	}
	a.collapsed::after {
		transform: rotate(-90deg);
	}
	.innercard a::after {
		content: '';
		display: inline-block;
		width: 16px;
		/* Set width of the image */
		height: 16px;
		/* Set height of the image */
		background-image: url('https://theytrust-us.developmentserver.info/front_components/images/arrow.png');
		/* Replace with your image URL */
		background-size: contain;
		/* Ensure the image scales properly */
		background-repeat: no-repeat;
		/* Prevent the image from repeating */
		margin-left: 5px;
		/* Optional: space between text and image */
		position: relative;
	}


	a.collapsed::after {


		transform: rotate(-90deg);
	}

	.heading-bg a::after {
		content: '';
		display: inline-block;
		width: 16px;
		/* Set width of the image */
		height: 16px;
		/* Set height of the image */
		background-image: url('https://theytrust-us.developmentserver.info/front_components/images/arrow.png');
		/* Replace with your image URL */
		background-size: contain;
		/* Ensure the image scales properly */
		background-repeat: no-repeat;
		/* Prevent the image from repeating */
		margin-left: 5px;
		/* Optional: space between text and image */
		position: relative;
	}
















	.inner-subcat ul {
		margin: 0;
		padding: 0;
	}

	.inner-subcat ul li {
		color: #828892;
		list-style: none;
		font-size: 14px;
		font-family: "Inter", sans-serif;
		font-weight: 400;
	}

	.heading-bg {
		background-color: #ebfdff;
		background-color: #ebfdff;
		padding: 8px 0 !important;
		margin-bottom: 4px;
	}

	.card-header {
		border: 0;
		padding: 0;
	}

	.innercard a {
		color: #5b6371;
		font-size: 14px;
		font-family: "Inter", sans-serif;
		font-weight: 600;
		margin-left: 0;
		text-decoration: none;
		width: 100%;
		display: flex;
		padding: 11px 25px;
		align-items: center;
	}

	.innercard {
		margin-bottom: 0px;
		background-color: #a6f5ff;
		margin-top: 4px;
	}
</style>

<div class="container">
	<div id="accordion">
		@foreach($categories as $category)
		<div class="card maincard">
			<div class="card-header innercard" id="heading-{{ $category->id }}">
				<h5 class="mb-0">
					<a role="button" data-toggle="collapse" href="#collapse-{{ $category->id }}" aria-expanded="true"
						aria-controls="collapse-{{ $category->id }}">
						{{ $category->category }}
					</a>
				</h5>
			</div>
			<div id="collapse-{{ $category->id }}" class="collapse show" data-parent="#accordion"
				aria-labelledby="heading-{{ $category->id }}">
				<div class="card-body">
					<div id="accordion-{{ $category->id }}">
						@foreach($category->subcategories as $subcategory)
						<div class="card">
							<div class="card-header heading-bg" id="heading-{{ $category->id }}-{{ $subcategory->id }}">
								<h5 class="mb-0">
									<a class="collapsed" role="button" data-toggle="collapse"
										href="#collapse-{{ $category->id }}-{{ $subcategory->id }}"
										aria-expanded="false"
										aria-controls="collapse-{{ $category->id }}-{{ $subcategory->id }}">
										{{ $subcategory->subcategory }}
									</a>
								</h5>
							</div>
							<div id="collapse-{{ $category->id }}-{{ $subcategory->id }}" class="collapse"
								data-parent="#accordion-{{ $category->id }}"
								aria-labelledby="heading-{{ $category->id }}-{{ $subcategory->id }}">
								<div class="card-body">
									<div id="accordion-{{ $category->id }}-{{ $subcategory->id }}">
										<div class="inner-subcat">
											<div class="row px-md-5 my-md-4 mx-md-3">
												@foreach($subcategory->subcat_child as $subcat_child)
												<div class="col-md-2 col-4 mt-3 mt-md-0">
													<h3>{{ $subcat_child->name }}</h3>
													<ul>
														@foreach($subcat_child->skill as $skill)
														<li>{{ $skill->name }}</li>
														@endforeach
													</ul>
												</div>
												@endforeach
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
	integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

@endsection