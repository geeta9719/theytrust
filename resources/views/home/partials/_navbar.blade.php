<?php 
use App\Models\Category;
use App\Models\Company;
use App\Models\Subcategory;
$categoriese = Category::all();

$cd = '';
if(Auth::check())
{
    $uid = auth()->user()->id;
    $cd = Company::select('*')->where('user_id', '=', $uid)->first();
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

 <!-- menu section start-->
 <section class="container header position-relative py-md-4   mb-3 mb-md-0  ">
        
        <nav class="navbar navbar-expand-xl  navbar-dark px-0">
            
            <a class="navbar-brand" href="https://theytrust-us.developmentserver.info/">
                <img src="{{asset('front_components/images/logo.png')}}" alt="" class="logo">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            @if(Auth::check()) 
                @php $cls = 'afterLogin' @endphp 
            @else
                @php $cls = '' @endphp 
            @endif
            <div class="collapse navbar-collapse {{$cls}}" id="collapsibleNavbar">
                <ul class="navbar-nav topheader ">
                    <li class="nav-item  ">
                    <a class="nav-link " href="javascript:void(0)">Services <span class="drop-arrow down"></span></a>
                        <div class="accordion" id="myAccordion">
                        <?php $i = 1; ?>
                        @foreach($categoriese as $category)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="collapseOne">
                                    <div type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne{{$i}}">{{$category->category}}</div>
                                </h2>
                                <div id="collapseOne{{$i}}" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                                    <div class="card-body">
                                        @foreach($category->subcategory as $sub_cat)
                                            <a href="{{ url('directory/'.strtolower($sub_cat->subcategory)) }}">{{$sub_cat->subcategory}}</a>
                                        @endforeach 
                                    </div>
                                </div>
                            </div>
                        <?php $i++; ?>
                        @endforeach
                            <!-- <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <div type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo">Button 1</div>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                                    <div class="card-body">
                                        <a href="">Button 1a</a>
                                        <a href="">Button 1b</a>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <div type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree">Button 1</div>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    data-bs-parent="#myAccordion">
                                    <div class="card-body">
                                        <a href="">Button 1a</a>
                                        <a href="">Button 1b</a>
                                    </div>
                                </div>
                            </div> -->

                        </div>
                    </li>



                    <!-- <li class="nav-item  ">
                        <a class="nav-link " href="javascript:void(0)">Resources <span class="drop-arrow down"></span></a>
                        <div class="accordion" id="myAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <div type="button">Button 1</div>
                                </h2>

                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <div type="button">Button 1</div>
                                </h2>

                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <div type="button">Button 1</div>
                                </h2>

                            </div>
                        </div>
                    </li> -->

                    

                    <li class="nav-item  ">
                        <a class="nav-link " href="#">Blog</a>

                    </li>
                    <li class="nav-item  ">
                        <a class="nav-link " href="{{url('contact')}}"> Contact Us </a>

                    </li>


                    @if(!Auth::check())
                        <li class="nav-item  ">
                            <a class="nav-link brdnone modal-signin" href="#"  data-toggle="modal" data-target="#singin-modal"> Sign in</a>
                        </li>       
                    @else
                        <li class="nav-item  dropdown ">    
                            <a class="nav-link brdnone dropdown-toggle ProfileImg" href="#" id="navbardrop" data-toggle="dropdown">
                                <img src="@if(auth()->user()->avatar) {{auth()->user()->avatar}} @else {{asset('front_components/images/user1.png')}} @endif " class="img-circle elevation-2" alt="User" width="100%" height="100%" style="border-radius: 25px;"> Me
                            </a>
                            
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('user.personal') }}">My User Account</a>
                                @if($cd)
                                <a class="dropdown-item" href="{{ route('company.dashboard',$cd->id) }}">Company Dashboard</a>
                                <a class="dropdown-item" href="{{ url('/sponsorship') }}">Change Your Plan</a>
                                <a class="dropdown-item" href="{{ route('user.allinfo',auth()->user()->id) }}">Update Company Profile</a>
                                @else
                                <a class="dropdown-item" href="{{url('get-listed')}}">Update Company Profile</a>
                                @endif
                                <form method="post" action="/logout">
                                    @csrf
                                    <button class="btn btn-sm btn-primary btnLogout" type="submit">Logout</button>
                                </form>
                            </div>
                        </li>
                    @endif



                </ul>
            </div>
        </nav>
        <div class="right-section">

            <div class="input-group  ">
                <input type="text" class="form-control search" name="search" id="search"  placeholder="Search" onkeyup="search()">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                </div>

                <div class="srcbxc" style="position: absolute;top: 50px;background: #fff;min-width: 135%;display: none;padding: 10px;z-index: 99999;">
            </div>
            </div>
        </div>
    </section>
    <section class="container-fluid category-service ">
        <div class="container">
            <!-- <div class="d-flex align-items-center">
                <img src="{{asset('front_components/images/categoy.png')}}" alt="" class="img-fluid mr-3"><span class="alltxt">All Category</span>
            </div> -->
            <ul class="  mb-0">
                @foreach($categoriese as $cat)
                    @if($cat->top_cat == 1)
                        <li><a style="text-decoration: none;color: #fff;" href="{{url('directory/'.strtolower(str_replace(' ','-',$cat->category)))}}">{{$cat->category}}</a></li>
                    @endif
                @endforeach
        
            </ul>
        </div>
    </section>

<!-- menu section End -->
