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
        <div class="card">
          <!-- Pricing Plans -->
          <div class="pb-sm-5 pb-2 rounded-top">
            <div class="container py-5">
              <h2 class="text-center mb-2 mt-0 mt-md-4">Pricing Plans</h2>
              <p class="text-center">
                Get started with us - it's perfect for individuals and teams. Choose a subscription plan that
                meets your needs.
              </p>


              <div class="row mx-0 gy-3 px-lg-5 mt-3">
                <!-- Basic -->
                <div class="col-lg-4 mb-md-0 mb-4">
                  <div class="card border rounded shadow-none">
                    <div class="card-body">
                      <div class="my-3 pt-2 text-center">
                        <img
                          src="../../assets/img/illustrations/page-pricing-basic.png"
                          alt="Basic Image"
                          height="140" />
                      </div>
                      <h3 class="card-title text-center text-capitalize mb-1">Basic</h3>
                      <p class="text-center">A simple start for everyone</p>
                      <div class="text-center">
                        <div class="d-flex justify-content-center">
                          <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary">$</sup>
                          <h1 class="display-4 mb-0 text-primary">0</h1>
                          <sub class="h6 pricing-duration mt-auto mb-2 text-muted fw-normal">/month</sub>
                        </div>
                      </div>

                      <ul class="ps-3 my-4 pt-2">
                        <li class="mb-2">100 responses a month</li>
                        <li class="mb-2">Unlimited forms and surveys</li>
                        <li class="mb-2">Unlimited fields</li>
                        <li class="mb-2">Basic form creation tools</li>
                        <li class="mb-0">Up to 2 subdomains</li>
                      </ul>

                      <a href="{{route('billing')}}" class="btn btn-label-success d-grid w-100"
                        >Buy Now</a
                      >
                    </div>
                  </div>
                </div>

                <!-- Pro -->
                {{-- <div class="col-lg mb-md-0 mb-4">
                  <div class="card border-primary border shadow-none">
                    <div class="card-body position-relative">
                      <div class="position-absolute end-0 me-4 top-0 mt-4">
                        <span class="badge bg-label-primary">Popular</span>
                      </div>
                      <div class="my-3 pt-2 text-center">
                        <img
                          src="../../assets/img/illustrations/page-pricing-standard.png"
                          alt="Standard Image"
                          height="140" />
                      </div>
                      <h3 class="card-title text-center text-capitalize mb-1">Pro</h3>
                      <p class="text-center">For small to medium businesses</p>
                      <div class="text-center">
                        <div class="d-flex justify-content-center">
                          <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary">$</sup>
                          <h1 class="price-toggle price-yearly display-4 text-primary mb-0">7</h1>
                          <h1 class="price-toggle price-monthly display-4 text-primary mb-0 d-none">9</h1>
                          <sub class="h6 text-muted pricing-duration mt-auto mb-2 fw-normal">/month</sub>
                        </div>
                        <small class="price-yearly price-yearly-toggle text-muted">$ 90 / year</small>
                      </div>

                      <ul class="ps-3 my-4 pt-2">
                        <li class="mb-2">Up to 5 users</li>
                        <li class="mb-2">120+ components</li>
                        <li class="mb-2">Basic support on Github</li>
                        <li class="mb-2">Monthly updates</li>
                        <li class="mb-0">Integrations</li>
                      </ul>

                      <a href="auth-register-basic.html" class="btn btn-primary d-grid w-100">Upgrade</a>
                    </div>
                  </div>
                </div>

                <!-- Enterprise -->
                <div class="col-lg">
                  <div class="card border rounded shadow-none">
                    <div class="card-body">
                      <div class="my-3 pt-2 text-center">
                        <img
                          src="../../assets/img/illustrations/page-pricing-enterprise.png"
                          alt="Enterprise Image"
                          height="140" />
                      </div>
                      <h3 class="card-title text-center text-capitalize mb-1">Enterprise</h3>
                      <p class="text-center">Solution for big organizations</p>

                      <div class="text-center">
                        <div class="d-flex justify-content-center">
                          <sup class="h6 text-primary pricing-currency mt-3 mb-0 me-1">$</sup>
                          <h1 class="price-toggle price-yearly display-4 text-primary mb-0">16</h1>
                          <h1 class="price-toggle price-monthly display-4 text-primary mb-0 d-none">19</h1>
                          <sub class="h6 pricing-duration mt-auto mb-2 fw-normal text-muted">/month</sub>
                        </div>
                        <small class="price-yearly price-yearly-toggle text-muted">$ 190 / year</small>
                      </div>

                      <ul class="ps-3 my-4 pt-2">
                        <li class="mb-2">Up to 10 users</li>
                        <li class="mb-2">150+ components</li>
                        <li class="mb-2">Basic support on Github</li>
                        <li class="mb-2">Monthly updates</li>
                        <li class="mb-0">Speedy build tooling</li>
                      </ul>

                      <a href="auth-register-basic.html" class="btn btn-label-primary d-grid w-100">Upgrade</a>
                    </div>
                  </div>
                </div> --}}
              </div>
            </div>
          </div>
          <!--/ Pricing Plans -->
        </div>
      </div>
      <!-- / Content -->

      <!-- Footer -->
      <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl">
          <div
            class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
            <div>
              ©
              <script>
                document.write(new Date().getFullYear());
              </script>
              , made with ❤️ by <a href="https://pixinvent.com" target="_blank" class="fw-medium">Pixinvent</a>
            </div>
            <div class="d-none d-lg-inline-block">
              <a href="https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank"
                >License</a
              >
              <a href="https://1.envato.market/pixinvent_portfolio" target="_blank" class="footer-link me-4"
                >More Themes</a
              >

              <a
                href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/"
                target="_blank"
                class="footer-link me-4"
                >Documentation</a
              >

              <a href="https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block"
                >Support</a
              >
            </div>
          </div>
        </div>
      </footer>
      <!-- / Footer -->

      <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
  </div>

@endsection
