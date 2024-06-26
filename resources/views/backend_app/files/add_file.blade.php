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
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tweet /</span> Add New Tweet</h4>




        <form action="{{route('store-tweet')}}" method="POST">
        @csrf
        <div class="card">
          <div class="card-datatable table-responsive p-4">

            <div class="row">




                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="mb-3 mt-2">


        </div>
                    <label for="">Text<span class="text-danger">*</span></label>
                    <textarea name="text" class="form-control" id="" cols="30" rows="10"></textarea>
                    @error('form_no')
                            <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

            </div>

            <button class="btn btn-primary mt-3">Submit</button>
        </form>

            </div>


        </form>
          </div>
        </div>
        <!-- Modal to add new record -->

        <!--/ DataTable with Buttons -->



      </div>
      <!-- / Content -->

      <!-- Footer -->
  @include('backend_app.layouts.footer')
      <!-- / Footer -->

      <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
  </div>

@endsection

