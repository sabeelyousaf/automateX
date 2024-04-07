@extends('backend_app.layouts.template')
@section('content')

<div class="layout-page">
    <!-- Navbar -->

  @include('backend_app.layouts.nav')
    <!-- / Navbar -->

    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->

      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Twitter /</span> Account</h4>
        <div class="row">
          <div class="col-md-12">


            <div class="card mb-4" id="general_setting">
              <h5 class="card-header">Twitter Keys Details</h5>
              <!-- Account -->
              <div class="card-body">
                <form  action="{{route('store-setting')}}" method="POST"  enctype="multipart/form-data">
                    @csrf

              </div>
              <hr class="my-0" />
              <div class="card-body">

                  <div class="row">
                    <div class="mb-3 col-md-6">
                      <label for="firstName" class="form-label">Consumer Key <span class="text-danger">*</span></label>
                      <input
                        class="form-control"
                        type="text"
                        id="firstName"
                        name="consumer_key"
                        @if($data === null)
                        value=""
                        @else
                        value="{{$data->consumer_key }}"
                        @endif
                        autofocus />
                        @error('consumer_key')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                      <label for="email" class="form-label">Consumer Secreat Key <span class="text-danger">*</span></label>
                      <input
                        class="form-control"
                        type="text"
                        id="email"
                        name="consumer_secreat"
                        @if($data === null)
                        value=""
                        @else
                        value="{{$data->consumer_secreat }}"
                        @endif

                       />
                       @error('consumer_secreat')
                       <span class="text-danger">{{$message}}</span>
                       @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="organization" class="form-label">Access Token <span class="text-danger">*</span></label>
                      <input
                        type="text"
                        class="form-control"
                        id="organization"
                        name="access_token"
                        @if($data === null)
                        value=""
                        @else
                        value="{{$data->consumer_access_token }}"
                        @endif
                      />
                        @error('access_token')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="phoneNumber">Token Secreat <span class="text-danger">*</span></label>
                      <div class="input-group input-group-merge">

                        <input
                          type="text"
                          id="phoneNumber"
                          name="token_secreat"
                          class="form-control"
                          @if($data === null)
                          value=""
                          @else
                          value="{{$data->consumer_token_secreat }}"
                          @endif
                       />

                      </div>
                      @error('token_secreat')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>





                  </div>
                  <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                  </div>
                </form>
              </div>
              <!-- /Account -->
            </div>
            <div class="card mb-4" id="password">
                <h5 class="card-header">Change Password</h5>
                <div class="card-body">
                  <form action="{{route('update-password')}}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="mb-3 col-md-6 form-password-toggle">
                        <label class="form-label" for="currentPassword">Current Password</label>
                        <div class="input-group input-group-merge">
                          <input
                            class="form-control"
                            type="password"
                            name="currentPassword"
                            id="currentPassword"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                          <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror

                      </div>
                    </div>
                    <div class="row">
                      <div class="mb-3 col-md-6 form-password-toggle">
                        <label class="form-label" for="newPassword">New Password</label>
                        <div class="input-group input-group-merge">
                          <input
                            class="form-control"
                            type="password"
                            id="password"
                            name="newPassword"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                          <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                        @error('newPassword')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>

                      <div class="mb-3 col-md-6 form-password-toggle">
                        <label class="form-label" for="confirmPassword">Confirm New Password</label>
                        <div class="input-group input-group-merge">
                          <input
                            class="form-control"
                            type="password"
                            name="newPassword_confirmation"
                            id="confirmPassword"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                          <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                        @error('confirm_password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-12 mb-4">
                        <h6>Password Requirements:</h6>
                        <ul class="ps-3 mb-0">
                          <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                          <li class="mb-1">At least one lowercase character</li>
                          <li>At least one number, symbol, or whitespace character</li>
                        </ul>
                      </div>
                      <div>
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>








        </div>
      </div>
      <!-- / Content -->

      <!-- Footer -->

      <!-- / Footer -->

      <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$("#password").hide();
$("#account").click(()=>{
    $('#general_setting').show();
    $('#general_setting').show();
    $("#account_inner").addClass('active');
    $("#security_inner").removeClass('active');
    $("#password").hide();
});
$("#security").click(()=>{
    $
    $('#password').show();
    $("#general_setting").hide();
    $("#security_inner").addClass('active');
    $("#account_inner").removeClass('active');
});
</script>
@endsection
