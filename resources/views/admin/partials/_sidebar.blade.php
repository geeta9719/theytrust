
<style>
/*.se {background-color:#5cc47e;}*/
.se {background-color:#00b4f8 !important;}
.act {background-color:#fff !important;}
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/admin')}}" class="brand-link">
      <img src="{{asset('bower_components/admin-lte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">They Trust Us</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!--<div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('bower_components/admin-lte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>-->

      <!-- SidebarSearch Form -->
      <!--<div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>-->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item menu-open" >
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Home Control
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview">
              @if(request()->is('admin/category/show'))
                @php $a = 'menu-open' @endphp
              @elseif(request()->is('admin/category/create'))
                @php $a = 'menu-open' @endphp   
              @elseif(request()->is('admin/subcategory/show'))
                @php $a = 'menu-open' @endphp 
              @elseif(request()->is('admin/subcategory/create'))
                @php $a = 'menu-open' @endphp 
                @elseif(request()->is('admin/seo-search'))
                @php $a = 'menu-open' @endphp   
              @elseif(request()->is('admin/subcategory-child/show'))
                @php $a = 'menu-open' @endphp          
              @else
                @php $a = '' @endphp
              @endif
              <li class="nav-item  {{$a}} see"  id="se1" onclick="hideShow('1')" ><!--menu-open-->
                <a href="#" class="nav-link active se" >
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p >Services
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview me" id="me1">
                  <li class="nav-item">
                    <a href="{{route('admin.category.index')}}" class="nav-link {{ request()->is('admin/category/show') ? 'active act' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Category</p>
                    </a>
                  </li>
                  <!--<li class="nav-item">
                    <a href="{{route('admin.category.create')}}" class="nav-link {{ request()->is('admin/category/create') ? 'active act' :'' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Category</p>
                    </a>
                  </li>-->

                  <li class="nav-item">
                    <a href="{{route('admin.subcategory.index')}}" class="nav-link {{ request()->is('admin/subcategory/show') ? 'active act' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Subcategory</p>
                    </a>
                  </li>
                  <!--<li class="nav-item">
                    <a href="{{route('admin.subcategory.create')}}" class="nav-link {{ request()->is('admin/subcategory/create') ? 'active act' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Subcategory</p>
                    </a>
                  </li>-->
				          <li class="nav-item">
                    <a href="{{route('admin.subcategory-child.show')}}" class="nav-link {{ request()->is('admin/subcategory-child/show') ? 'active act' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Subcategory Child</p>
                    </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ route('admin.seo-search') }}" class="nav-link {{ request()->is('admin/seo-search') ? 'active act' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        SEO Search</a>
                  </li>

                </ul>
              </li>


              @if(request()->is('admin/company/list'))
                @php $a = 'menu-open' @endphp
              @elseif(request()->is('admin/company/add'))
                @php $a = 'menu-open' @endphp
              @elseif(request()->is('admin/company/review'))
                @php $a = 'menu-open' @endphp
              @elseif(request()->is('admin/company/review/email-logs'))
                @php $a = 'menu-open' @endphp       
              @else
                @php $a = '' @endphp
              @endif
              <li class="nav-item  {{ $a }} see"  id="se2" onclick="hideShow('2')" ><!--menu-open-->
                <a href="#" class="nav-link active se" >
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p >Company Details
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview me" id="me2">

                  <li class="nav-item">
                    <a href="{{route('admin.company.add')}}" class="nav-link {{ request()->is('admin/company/add') ? 'active act' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Company</p>
                    </a>
                  </li>


                  <li class="nav-item">
                    <a href="{{route('admin.company.list')}}" class="nav-link {{ request()->is('admin/company/list') ? 'active act' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Companies</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{route('admin.company.review')}}" class="nav-link {{ request()->is('admin/company/review') ? 'active act' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Company Review</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{route('admin.review.email.logs')}}" class="nav-link {{ request()->is('admin/company/review/email-logs') ? 'active act' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Company Review Logs</p>
                    </a>
                  </li>

                 

                </ul>
              </li>

              
              @if(request()->is('admin/attribution/show'))
                @php $a = 'menu-open' @endphp
              @elseif(request()->is('admin/rate/show'))
                @php $a = 'menu-open' @endphp 
              @elseif(request()->is('admin/size/show'))
                @php $a = 'menu-open' @endphp
              @elseif(request()->is('admin/contacts'))
                @php $a = 'menu-open' @endphp    
                @elseif(request()->is('admin/budget/show'))
                @php $a = 'menu-open' @endphp         
              @else
                @php $a = '' @endphp
              @endif
              <li class="nav-item  {{ $a }} see"  id="se3" onclick="hideShow('3')" ><!--menu-open-->
                <a href="#" class="nav-link active se">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p >Site Settings
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>

                <ul class="nav nav-treeview me" id="me3">
                  <li class="nav-item">
                    <a href="{{route('admin.attribution.show')}}" class="nav-link {{ request()->is('admin/attribution/show') ? 'active act' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Attribution</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('admin.contacts.index')}}" class="nav-link {{ request()->is('admin/contacts') ? 'active act' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Contacts</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('admin.rate.show')}}" class="nav-link {{ request()->is('admin/rate/show') ? 'active act' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Hourly Rate</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('admin.size.show')}}" class="nav-link {{ request()->is('admin/size/show') ? 'active act' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Company Size</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('admin.budget.show')}}" class="nav-link {{ request()->is('admin/budget/show') ? 'active act' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Company Budget</p>
                    </a>
                  </li>
                </ul>
              </li>

              @if(request()->is('admin/users/list'))
                @php $a = 'menu-open' @endphp          
              @else
                @php $a = '' @endphp
              @endif
              <li class="nav-item  {{ $a }} see" id="se4" onclick="hideShow('4')" ><!--menu-open-->
                <a href="#" class="nav-link active se">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p >Users<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview me" id="me4">
                  <li class="nav-item">
                    <a href="{{route('admin.users.list')}}" class="nav-link {{ request()->is('admin/users/list') ? 'active act' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Users List</p>
                    </a>
                  </li>
                  
                </ul>
              </li>
            </li>

         


          <script>
              function hideShow(id){
                $(".see").removeClass('menu-open');
                $(".see").removeClass('menu-is-opening');
                $(".me").slideUp();
                $("#me"+id).slideDown();
              }
          </script>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>