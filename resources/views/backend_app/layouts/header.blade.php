<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
   @php
       $user=Auth::user();
   @endphp
    <div class="app-brand demo">
      <a href="{{route('dashboard')}}" class="app-brand-link py-5">
       <h4 class="fw-bold">AutomateX</h4>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
      <!-- Dashboards -->
      <li class="menu-item {{ Request::is('dashboard') ?'active':'' }}">
        <a href="{{route('dashboard')}}" class="menu-link" >
          <i class="menu-icon tf-icons ti ti-smart-home"></i>
          <div>Dashboards</div>
        </a>
      </li>

      <!-- Layouts -->
      <li class="menu-item {{ Request::is('add-files') || Request::is('all-files') ? 'active' : '' }}">

      <li class="menu-item {{ Request::is('add-files') || Request::is('all-files') ? 'open' : '' }}  ">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-chart-pie"></i>
          <div >Tweets</div>
        </a>

        <ul class="menu-sub">
          <li class="menu-item {{ Request::is('add-files') ? 'active' : '' }}">
            <a href="{{route('add-files')}}" class="menu-link">
              <div >Add New Tweet</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('add-files') ? 'active' : '' }}">
            <a href="{{route('add-gpt-file')}}" class="menu-link">
              <div >Add GPT Tweet</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('all-files') ? 'active' : '' }}">
            <a href="{{route('all-files')}}" class="menu-link">
              <div >View All Tweets</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('all-files') ? 'active' : '' }}">
            <a href="{{route('all-gpts-content')}}" class="menu-link">
              <div >View All GPTS Content</div>
            </a>
          </li>

        </ul>
      </li>
      <li class="menu-item {{ Request::is('pricing') ?'active':'' }}">
        <a href="{{route('pricing')}}" class="menu-link" >
          <i class="menu-icon tf-icons ti ti-smart-home"></i>
          <div>Pricing</div>
        </a>
      </li>

      {{-- <li class="menu-item {{ Request::is('discount/add-form') || Request::is('discount/all-forms') ? 'open' : '' }} ">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
          <div >Discount Forms</div>
        </a>

        <ul class="menu-sub">
          <li class="menu-item {{ Request::is('discount/add-form')  ? 'active' : '' }}">
            <a href="{{route('add-discount-form')}}" class="menu-link">
              <div >Add Forms</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('discount/all-forms') ? 'active' : '' }}">
            <a href="{{route('all-discount-form')}}" class="menu-link">
              <div >All Forms</div>
            </a>
          </li>

        </ul>
      </li> --}}
      <!-- Front Pages -->
      {{-- <li class="menu-item {{ Request::is('all-dealers') || Request::is('add-dealer') ? 'open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-files"></i>
          <div >Sales Partners</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ Request::is('all-dealers')  ? 'active' : '' }}">
            <a href="{{route('all-dealer')}}" class="menu-link">
              <div >All Dealers</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('add-dealer')  ? 'active' : '' }}">
            <a href="{{route('add-dealer')}}" class="menu-link" >
              <div >Add Dealers</div>
            </a>
          </li>

        </ul>
      </li> --}}

      {{-- <li class="menu-item {{ Request::is('all-clients') || Request::is('add-client') ? 'open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-id"></i>
          <div >Client Modules</div>
        </a>
        <ul class="menu-sub">

          <li class="menu-item {{ Request::is('all-clients') ? 'active' : '' }}">
            <a href="{{route('all-clients')}}" class="menu-link">
              <div >All Clients</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('add-client') ? 'active' : '' }}">
            <a href="{{route('add-client')}}" class="menu-link" >
              <div >Add Client</div>
            </a>
          </li>
        </ul>
      </li> --}}

      <!-- Apps & Pages -->


      {{-- <li class="menu-header small text-uppercase">
        <span class="menu-header-text">App Module</span>
      </li>

      <li class="menu-item {{ Request::is('all-banners') ? 'active' : '' }}">
        <a href="{{route('all-banners')}}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-brand-tabler"></i>
          <div >Banners</div>
        </a>
      </li>

      <!-- Academy menu end -->



      <li class="menu-item {{ Request::is('all-forms')     ? 'active' : '' }}">
        <a href="{{route('all-forms')}}" class="menu-link ">
          <i class="menu-icon tf-icons ti ti-file-description"></i>
          <div>Customer Query</div>
        </a>

      </li>
      <li class="menu-item {{ Request::is('all-partners') ? 'active' : '' }}">
        <a href="{{route('all-partners')}}" class="menu-link ">
          <i class="menu-icon tf-icons ti ti-users"></i>
          <div>Affiliated Sales Partners</div>
        </a>

      </li> --}}
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Advance Options</span>
      </li>

      <li class="menu-item {{ Request::is('edit-profile') ? 'active' : '' }}">
        <a href="{{route('edit_profile')}}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-mail"></i>
          <div >Edit porfile</div>
        </a>
      </li>

      <!-- Academy menu end -->



      <li class="menu-item">
        <a href="{{route('setting-details')}}" class="menu-link ">
          <i class="menu-icon tf-icons ti ti-settings"></i>
          <div>Settings</div>
        </a>

      </li>
    </ul>
  </aside>
