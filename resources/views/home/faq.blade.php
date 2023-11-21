@extends('layouts.home-master')
@section('content')
<style>
  


  .accordion-button {
    background: transparent;
    border: 0;
    width: 100%;
    text-align: left;
}


/* 
    .demofaq .panel-group .panel {
        border-radius: 0;
        box-shadow: none;
        border-color: #EEEEEE;
    }

    .demofaq .panel-default > .panel-heading {
        padding: 0;
        border-radius: 0;
        color: #212121;
        background-color: #f5f8fd;
        border-color: #EEEEEE;
    }

   .demofaq .panel-title {
        font-size: 14px;
        border: 1px solid #c4d1e8;
    }

    .demofaq .panel-title > a {
    display: block;
    padding: 15px;
    text-decoration: none;
    color: #000000;
    font-weight: 600;
    font-size: 16px;
    color: #191b1f;
   
}
   .demofaq .more-less {
        float: right;
        color: #212121;
    }

    .demofaq .panel-default > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #EEEEEE;
        padding: 0 20px;
        border: 1px solid #c4d1e8;
    } */

/* ----- v CAN BE DELETED v ----- */

.newaccordion .accordion-item{
background-color: #f5f8fd;
    border: 1px solid #d5deee;
    
}
.newaccordion .accordion-header{
background-color: #f5f8fd;
    border: 1px solid #d5deee;
   
}

.newaccordion .accordion-button{
    font-weight:bold;
}

  .newaccordion .accordion-body{
    padding: 10px 21px 10px 21px;
  }  
/* .demofaq {
    padding-top: 60px;
    padding-bottom: 60px;
} */
</style>
<section class="container-fluid signin-banner animatedParent hero-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5 mx-auto text-center">
                    <h3>FAQ</h3>
                </div>
            </div>
        </div>
    </div>
</section>








<!------ Include the above in your HEAD tag ---------->

<!-- <div class="container demofaq"> -->
<!-- <div class="container ">
    
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Can I Update My Review?
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                We don't allow reviewers to delete their reviews, but we do allow them to update their review. We allow reviews to be updated if: A substantial amount of additional work has been completed, or The trajectory of the partnership has changed following the original review’s publication Reach out the Theytrustus representative who conducted the initial review. If you no longer know the best point of contact, please reach out to reviews@Theytrustus.co. We will schedule a call or send our Updated Review Form to collect feedback on your experience with the vendor, including information regarding an updated scope of work or updated results and feedback. No original review content, including the quote, will be changed or removed from Theytrustus.co. The original content will be listed at the bottom of the more recent review.
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Is a TheyTrustUs Recommended Rating Helpful For Businesses When Choosing A Partner?
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                Data from public and third-party sources are incorporated into the TheyTrustUs Recommendability Rating. When making a purchase decision, it shouldn't be treated as the only source of information. Combined with other sources of information on a service provider's credibility, such as client reviews and testimonials, endorsements from industry leaders, and peer recommendations, the TheyTrustUs Recommendability Rating is designed to provide a reliable assessment of a service provider's quality.
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Does TheyTrustUs offer any free features?
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                TheyTrustUs offers service providers a variety of free options to find leads, establish online reputations, and establish brand leadership. Upgraded companies can also choose from premium options. Like:
<ul>
    <li>
    Business Profile: Listing on TheyTrustUs is free and takes less than 20 minutes.
</li>
<li>Interviews/Client Reviews: Our team will verify and populate your profile with client reviews after receiving client references.</li>
<li>Contributed Content: We want to hear about your expertise and thought leadership.</li>
</ul>


                </div>
            </div>
         </div>

         <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Who are TheyTrustUs' clients/customers/businesses looking for IT companies to hire?
                    </a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                <div class="panel-body">
                The TheyTrustUs list identifies the best companies and software in various IT domains based on their results from the research process. There are various categories on TheyTrustUs for outsourcing different services and software solutions. Users can browse the categories with verified reviews. They can even compare the prices of similar products and services different companies offer. Therefore, the task of finding an authenticated service/software online for their businesses is greatly reduced for service/software seekers.
                </div>
            </div>
         </div>

         <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFive">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        What makes TheyTrustUs different from other listing platforms?
                    </a>
                </h4>
            </div>
            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                <div class="panel-body">
                    <ul>
                        <li>
                        Compared to our competitors, our prices are low. Category selections are charged per web page, not per category.
                        </li>
                        <li>Compared to our competitors, we have a short review process.</li>
                        <li>We collect reviews by directly contacting a company's clients and asking them about their experiences.</li>
                    <li>Our company accepts video testimonials, corporate videos, and portfolio videos.</li>
                    </ul>
                



                </div>
            </div>
         </div>






         <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingSix">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        What can I do to improve my TheyTrustUs profile?
                    </a>
                </h4>
            </div>
            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                <div class="panel-body">
                You can easily and quickly improve your agency or business' Recommended Rating score by doing the following:
<ul>
    <li>
    The information on your profile must be claimed and completed.
</li>

<li>Make your TheyTrustUs profile stand out by collecting high-quality reviews.</li>
<li>Keep in touch with the community.</li>
<li>Stay up-to-date, accurate, and consistent with your business or organization's public information.</li>
<li>Strengthen the performance and authority of your website.</li>
</ul>




                </div>
            </div>
        </div>



        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingSeven">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        What can IT companies or software products do with TheyTrustUs?
                    </a>
                </h4>
            </div>
            <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                <div class="panel-body">
                Using TheyTrustUs, businesses can search for online services and software solutions, generating potential web traffic for their websites. Clients and software companies, and products are connected through TheyTrustUs. The possibility of showcasing their work to the right audience can be taken advantage of when IT companies and products register with GoodFirms and leverage this massive exposure to generate leads.
                </div>
            </div>
        </div>






     </div>
     </div> -->
     <!-- panel-group -->
    
    
<!-- container -->


<!-- test -->
<div class="container mb-5 pb-5 newaccordion">
<div class=" d-block" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      Can I Update My Review?
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      We don't allow reviewers to delete their reviews, but we do allow them to update their review. We allow reviews to be updated if: A substantial amount of additional work has been completed, or The trajectory of the partnership has changed following the original review’s publication Reach out the Theytrustus representative who conducted the initial review. If you no longer know the best point of contact, please reach out to reviews@Theytrustus.co. We will schedule a call or send our Updated Review Form to collect feedback on your experience with the vendor, including information regarding an updated scope of work or updated results and feedback. No original review content, including the quote, will be changed or removed from Theytrustus.co. The original content will be listed at the bottom of the more recent review.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
      Is a TheyTrustUs Recommended Rating Helpful For Businesses When Choosing A Partner?
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      Data from public and third-party sources are incorporated into the TheyTrustUs Recommendability Rating. When making a purchase decision, it shouldn't be treated as the only source of information. Combined with other sources of information on a service provider's credibility, such as client reviews and testimonials, endorsements from industry leaders, and peer recommendations, the TheyTrustUs Recommendability Rating is designed to provide a reliable assessment of a service provider's quality.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
      Does TheyTrustUs offer any free features?
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      TheyTrustUs offers service providers a variety of free options to find leads, establish online reputations, and establish brand leadership. Upgraded companies can also choose from premium options. Like:
      <ul>
    <li>
    Business Profile: Listing on TheyTrustUs is free and takes less than 20 minutes.
</li>
<li>Interviews/Client Reviews: Our team will verify and populate your profile with client reviews after receiving client references.</li>
<li>Contributed Content: We want to hear about your expertise and thought leadership.</li>
</ul>
      </div>
    </div>
  </div>













  <div class="accordion-item">
    <h2 class="accordion-header" id="headingFour">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
      Who are TheyTrustUs' clients/customers/businesses looking for IT companies to hire?
      </button>
    </h2>
    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      The TheyTrustUs list identifies the best companies and software in various IT domains based on their results from the research process. There are various categories on TheyTrustUs for outsourcing different services and software solutions. Users can browse the categories with verified reviews. They can even compare the prices of similar products and services different companies offer. Therefore, the task of finding an authenticated service/software online for their businesses is greatly reduced for service/software seekers.
      </div>
    </div>
  </div>







  <div class="accordion-item">
    <h2 class="accordion-header" id="headingFive">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
      What makes TheyTrustUs different from other listing platforms?
      </button>
    </h2>
    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <ul>
                        <li>
                        Compared to our competitors, our prices are low. Category selections are charged per web page, not per category.
                        </li>
                        <li>Compared to our competitors, we have a short review process.</li>
                        <li>We collect reviews by directly contacting a company's clients and asking them about their experiences.</li>
                    <li>Our company accepts video testimonials, corporate videos, and portfolio videos.</li>
                    </ul>
      </div>
    </div>
  </div>




  <div class="accordion-item">
    <h2 class="accordion-header" id="headingSix">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
      What can I do to improve my TheyTrustUs profile?
      </button>
    </h2>
    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      You can easily and quickly improve your agency or business' Recommended Rating score by doing the following:
      <ul>
    <li>
    The information on your profile must be claimed and completed.
</li>

<li>Make your TheyTrustUs profile stand out by collecting high-quality reviews.</li>
<li>Keep in touch with the community.</li>
<li>Stay up-to-date, accurate, and consistent with your business or organization's public information.</li>
<li>Strengthen the performance and authority of your website.</li>
</ul>
    
    </div>
    </div>
  </div>


  <div class="accordion-item">
    <h2 class="accordion-header" id="headingSeven">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
      What can IT companies or software products do with TheyTrustUs?
      </button>
    </h2>
    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      Using TheyTrustUs, businesses can search for online services and software solutions, generating potential web traffic for their websites. Clients and software companies, and products are connected through TheyTrustUs. The possibility of showcasing their work to the right audience can be taken advantage of when IT companies and products register with GoodFirms and leverage this massive exposure to generate leads.

      </div>
    </div>
  </div>









</div></div>
<!-- test -->


<script>function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);</script>

<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>








<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> 
@endsection
@section('script')
@endsection
