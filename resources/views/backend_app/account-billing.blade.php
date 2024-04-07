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
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Billings & Plans</h4>

        <div class="row">
          <div class="col-md-12">

            <div class="card mb-4">
                <!-- Billing Address -->
                <h5 class="card-header">Billing Address</h5>
                <div class="card-body">
                  <form id="formAccountSettings" onsubmit="return false">
                    <div class="row">
                      <div class="mb-3 col-sm-6">
                        <label for="companyName" class="form-label">Company Name</label>
                        <input
                          type="text"
                          id="companyName"
                          name="companyName"
                          class="form-control"
                          placeholder="Pixinvent" />
                      </div>
                      <div class="mb-3 col-sm-6">
                        <label for="billingEmail" class="form-label">Billing Email</label>
                        <input
                          class="form-control"
                          type="text"
                          id="billingEmail"
                          name="billingEmail"
                          placeholder="john.doe@example.com" />
                      </div>
                      <div class="mb-3 col-sm-6">
                        <label for="taxId" class="form-label">Tax ID</label>
                        <input
                          type="text"
                          id="taxId"
                          name="taxId"
                          class="form-control"
                          placeholder="Enter Tax ID" />
                      </div>
                      <div class="mb-3 col-sm-6">
                        <label for="vatNumber" class="form-label">VAT Number</label>
                        <input
                          class="form-control"
                          type="text"
                          id="vatNumber"
                          name="vatNumber"
                          placeholder="Enter VAT Number" />
                      </div>
                      <div class="mb-3 col-sm-6">
                        <label for="mobileNumber" class="form-label">Mobile</label>
                        <div class="input-group input-group-merge">
                          <span class="input-group-text">US (+1)</span>
                          <input
                            class="form-control mobile-number"
                            type="text"
                            id="mobileNumber"
                            name="mobileNumber"
                            placeholder="202 555 0111" />
                        </div>
                      </div>
                      <div class="mb-3 col-sm-6">
                        <label for="country" class="form-label">Country</label>
                        <select id="country" class="form-select select2" name="country">
                          <option selected>USA</option>
                          <option>Canada</option>
                          <option>UK</option>
                          <option>Germany</option>
                          <option>France</option>
                        </select>
                      </div>
                      <div class="mb-3 col-12">
                        <label for="billingAddress" class="form-label">Billing Address</label>
                        <input
                          type="text"
                          class="form-control"
                          id="billingAddress"
                          name="billingAddress"
                          placeholder="Billing Address" />
                      </div>
                      <div class="mb-3 col-sm-6">
                        <label for="state" class="form-label">State</label>
                        <input class="form-control" type="text" id="state" name="state" placeholder="California" />
                      </div>
                      <div class="mb-3 col-sm-6">
                        <label for="zipCode" class="form-label">Zip Code</label>
                        <input
                          type="text"
                          class="form-control zip-code"
                          id="zipCode"
                          name="zipCode"
                          placeholder="231465"
                          maxlength="6" />
                      </div>
                    </div>

                  </form>
                </div>
                <!-- /Billing Address -->
              </div>
            <div class="card mb-4">
              <h5 class="card-header">Payment Methods</h5>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <form id="creditCardForm" class="row g-3" onsubmit="return false">
                      <div class="col-12 mb-2">
                        <div class="form-check form-check-inline">
                          <input
                            name="collapsible-payment"
                            class="form-check-input"
                            type="radio"
                            value=""
                            id="collapsible-payment-cc"
                            checked="" />
                          <label class="form-check-label" for="collapsible-payment-cc"
                            >Credit/Debit/ATM Card</label
                          >
                        </div>

                      </div>
                      <div class="col-12">
                        <label class="form-label w-100" for="paymentCard">Card Number</label>
                        <div class="input-group input-group-merge">
                          <input
                            id="paymentCard"
                            name="paymentCard"
                            class="form-control credit-card-mask"
                            type="text"
                            placeholder="1356 3215 6548 7898"
                            aria-describedby="paymentCard2" />
                          <span class="input-group-text cursor-pointer p-1" id="paymentCard2"
                            ><span class="card-type"></span
                          ></span>
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="form-label" for="paymentName">Name</label>
                        <input type="text" id="paymentName" class="form-control" placeholder="John Doe" />
                      </div>
                      <div class="col-6 col-md-3">
                        <label class="form-label" for="paymentExpiryDate">Exp. Date</label>
                        <input
                          type="text"
                          id="paymentExpiryDate"
                          class="form-control expiry-date-mask"
                          placeholder="MM/YY" />
                      </div>
                      <div class="col-6 col-md-3">
                        <label class="form-label" for="paymentCvv">CVV Code</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="text"
                            id="paymentCvv"
                            class="form-control cvv-code-mask"
                            maxlength="3"
                            placeholder="654" />
                          <span class="input-group-text cursor-pointer" id="paymentCvv2"
                            ><i
                              class="ti ti-help text-muted"
                              data-bs-toggle="tooltip"
                              data-bs-placement="top"
                              title="Card Verification Value"></i
                          ></span>
                        </div>
                      </div>
                      <div class="col-12">
                        <label class="switch">
                          <input type="checkbox" class="switch-input" />
                          <span class="switch-toggle-slider">
                            <span class="switch-on"></span>
                            <span class="switch-off"></span>
                          </span>

                        </label>
                      </div>
                      <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Save Changes</button>
                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
                      </div>
                    </form>
                  </div>

                </div>
              </div>
            </div>


          </div>
        </div>

        <!-- Pricing Modal -->
        <div class="modal fade" id="pricingModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-simple modal-pricing">
            <div class="modal-content p-2 p-md-5">
              <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <!-- Pricing Plans -->
                <div class="py-0 rounded-top">
                  <h2 class="text-center mb-2">Pricing Plans</h2>
                  <p class="text-center">
                    Get started with us - it's perfect for individuals and teams. Choose a subscription plan that
                    meets your needs.
                  </p>
                  <div class="d-flex align-items-center justify-content-center flex-wrap gap-2 pt-3 mb-4">
                    <label class="switch switch-primary ms-3 ms-sm-0 mt-2">
                      <span class="switch-label">Monthly</span>
                      <input type="checkbox" class="switch-input price-duration-toggler" checked />
                      <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                      </span>
                      <span class="switch-label">Annual</span>
                    </label>
                    <div class="mt-n5 ms-n5 d-none d-sm-block">
                      <i class="ti ti-corner-left-down ti-sm text-muted me-1 scaleX-n1-rtl"></i>
                      <span class="badge badge-sm bg-label-primary">Save up to 10%</span>
                    </div>
                  </div>
                  <div class="row mx-0 gy-3">
                    <!-- Basic -->
                    <div class="col-xl mb-md-0 mb-4">
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
                          <div class="text-center h-px-100 mb-2">
                            <div class="d-flex justify-content-center">
                              <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary">$</sup>
                              <h1 class="display-4 mb-0 text-primary">0</h1>
                              <sub class="h6 pricing-duration mt-auto mb-2 text-muted fw-normal">/month</sub>
                            </div>
                            <small class="price-yearly price-yearly-toggle text-muted">$ 0 / year</small>
                          </div>

                          <ul class="list-group ps-3 my-4">
                            <li class="mb-2">100 responses a month</li>
                            <li class="mb-2">Unlimited forms and surveys</li>
                            <li class="mb-2">Unlimited fields</li>
                            <li class="mb-2">Basic form creation tools</li>
                            <li class="mb-0">Up to 2 subdomains</li>
                          </ul>

                          <button
                            type="button"
                            class="btn btn-label-success d-grid w-100 mt-3"
                            data-bs-dismiss="modal">
                            Your Current Plan
                          </button>
                        </div>
                      </div>
                    </div>

                    <!-- Pro -->
                    <div class="col-xl mb-md-0 mb-4">
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
                          <div class="text-center h-px-100 mb-2">
                            <div class="d-flex justify-content-center">
                              <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary">$</sup>
                              <h1 class="price-toggle price-yearly display-4 text-primary mb-0">7</h1>
                              <h1 class="price-toggle price-monthly display-4 text-primary mb-0 d-none">9</h1>
                              <sub class="h6 text-muted pricing-duration mt-auto mb-2 fw-normal">/month</sub>
                            </div>
                            <small class="price-yearly price-yearly-toggle text-muted">$ 90 / year</small>
                          </div>

                          <ul class="list-group ps-3 my-4">
                            <li class="mb-2">Up to 5 users</li>
                            <li class="mb-2">120+ components</li>
                            <li class="mb-2">Basic support on Github</li>
                            <li class="mb-2">Monthly updates</li>
                            <li class="mb-0">Integrations</li>
                          </ul>

                          <button type="button" class="btn btn-primary d-grid w-100 mt-3" data-bs-dismiss="modal">
                            Upgrade
                          </button>
                        </div>
                      </div>
                    </div>

                    <!-- Enterprise -->
                    <div class="col-xl">
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

                          <div class="text-center h-px-100 mb-2">
                            <div class="d-flex justify-content-center">
                              <sup class="h6 text-primary pricing-currency mt-3 mb-0 me-1">$</sup>
                              <h1 class="price-toggle price-yearly display-4 text-primary mb-0">16</h1>
                              <h1 class="price-toggle price-monthly display-4 text-primary mb-0 d-none">19</h1>
                              <sub class="h6 pricing-duration mt-auto mb-2 fw-normal text-muted">/month</sub>
                            </div>
                            <small class="price-yearly price-yearly-toggle text-muted">$ 190 / year</small>
                          </div>

                          <ul class="list-group ps-3 my-4">
                            <li class="mb-2">Up to 10 users</li>
                            <li class="mb-2">150+ components</li>
                            <li class="mb-2">Basic support on Github</li>
                            <li class="mb-2">Monthly updates</li>
                            <li class="mb-0">Speedy build tooling</li>
                          </ul>

                          <button
                            type="button"
                            class="btn btn-label-primary d-grid w-100 mt-3"
                            data-bs-dismiss="modal">
                            Upgrade
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Pricing Plans -->
              </div>
            </div>
          </div>
        </div>
        <!--/ Pricing Modal -->

        <script src="../../assets//js/pages-pricing.js"></script>
      </div>
      <!-- / Content -->

      <!-- Footer -->

      <!-- / Footer -->

      <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
  </div>

@endsection
