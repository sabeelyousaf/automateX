@extends('backend_app.layouts.template')
@section('content')
<style>
     .icon-wrapper {
    cursor: pointer;
  }
  .icon-wrapper:hover{
    transform: scale(1.10);
    transition: 0.3s ease-in-out;
  }
  .sorting-arrows {
    display: inline-block;
    vertical-align: middle;
    font-size: 12px; /* Adjust the font size as needed */
    margin-left: 5px; /* Adjust the spacing between the text and arrows as needed */
}

.sorting-arrows span {
    cursor: pointer;
}

/* Styling for the top arrow */


</style>
<div class="layout-page">
    <!-- Navbar -->
    @include('backend_app.layouts.nav')


    {{-- Modal Dealer --}}

    <div class="modal fade" id="bulk_action_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
          <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="text-center mb-4">
                <h3 class="mb-2">Assign Dealer</h3>

              </div>

              <form id="enableOTPForm" class="row g-3" action="#" method="post">
                @csrf
                <div class="col-12">


                </div>
                <div class="col-12">
                    <label class="form-label" for="modalEnableOTPPhone">Dealers</label>
                    <div class="input-group py-2 mb-3">
                        <select class="form-select" id="dealer_assign">
                            <option value="">Choose...</option>
                            @foreach ($dealers as $dealer)
                            <option value="{{$dealer->id}}">{{$dealer->company}}</option>
                            @endforeach

                        </select>
                    </div>
                  </div>
                <div class="col-12">
                  <button type="button"  class="btn btn-outline-primary me-sm-3 me-1" id="dealer_btn">Assign</button>
                  <button
                    type="reset"
                    class="btn btn-label-secondary"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                    Cancel
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>







    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->



      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tweets /</span> All GPT Contents</h4>
        <div class="row">
            <div class="col-12 py-2">
                {{-- <select name="page_view" id="page_view" class="px-2 py-2 border rounded-3  border-primary"  id="">
                    <option selected value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select> --}}
                  {{-- <div class="dropdown float-end">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Export
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{route('export-files',['type'=>'pdf'])}}" class="btn btn-primary w-auto float-end mb-2">PDF</a></li>
                      <li><a class="dropdown-item" href="{{route('export-files',['type'=>'excel'])}}" id="delete_all"  class="btn btn-primary w-auto float-end mb-2 mx-2 text-white">Excel</a></li>

                    </ul>
                  </div> --}}
                  <div class="dropdown float-end mx-2">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Actions
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{route('add-gpt-file')}}" class="btn btn-primary w-auto float-end mb-2">Add Content</a></li>
                      <li><a class="dropdown-item" id="delete_all" onclick="return confirm('Are you want to confirm to delete the files?')" class="btn btn-primary w-auto float-end mb-2 mx-2 text-white">Delete Files</a></li>
                    </ul>
                  </div>

            </div>
        </div>
        <!-- DataTable with Buttons -->



        <div class="card">

            <div class="table-responsive text-nowrap">
                {{-- <a href="{{route('add-files')}}" class="btn btn-primary float-end mt-3 mx-3">Add New File</a> --}}
                <table class="table">
                  <thead>
                    <tr class="text-nowrap">
                        <th><input type="checkbox" id="checkItems"></th>
                        <th>S.No</th>
                        <th>Content</th>
                        <th>Date Posting</th>
                        <th>Time Posting</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                    <tbody id="table-body">
                    @foreach ($data as $key=>$item)
                    <tr>

                      <th scope="row">
                        <input type="checkbox" class="all_products" name="items[]" value="{{$item->id}}">
                    </th>
                        <td>{{$key}}</td>
                        <td>{{$item->text}}</td>
                        <td>{{$item->date}}</td>
                        <td>{{$item->time}}</td>

                        <td>  <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="ti ti-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{route('edit-file',['id'=>$item->id])}}"
                                ><i class="ti ti-pencil me-1"></i> Edit</a
                              >
                              <a class="dropdown-item"  href="{{route('delete-file',['id'=>$item->id])}}"
                                ><i class="ti ti-trash me-1"></i> Delete</a
                              >
                            </div>
                          </div></td>
                    </tr>
                    @endforeach
                </tbody>

               </table>

          </div>

        </div>
        <div id="paginationContainer" class="float-end mt-3">
            {{$data->links()}}
         </div>

      </div>
      <!-- / Content -->

      <!-- Footer -->
  @include('backend_app.layouts.footer')
      <!-- / Footer -->

      <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
  </div>

  <div class="modal fade" id="status_action_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
    <div class="modal-content p-3 p-md-5">
    <div class="modal-body">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    <div class="text-center mb-4">
    <h3 class="mb-2">Update Status</h3>
    </div>


    <div class="col-12">
    <label class="form-label" for="modalEnableOTPPhone">Status</label>
    <div class="input-group py-2 mb-3">

        <form action="{{route('bulk_status')}}" class="w-100" method="POST" id="status_form">
            @csrf
    <select name="file_status" class="form-select" id="status_value">
    <option value="">Choose...</option>
    <option value="open">Open</option>
    <option value="closed">Closed</option>
                                <option value="blocked">Blocked</option>
                                <option value="processing">Processing</option>
                                <option value="reserved">Reserved</option>
                                <option value="ready">Ready</option>
                                <option value="delivered">Delivered</option>

                               </select>



                    </div>
                  </div>
                <div class="col-12">
                  <button type="button"  class="btn btn-outline-primary me-sm-3 me-1" id="status_btn">Update Status</button>
                  <button
                    type="reset"
                    class="btn btn-label-secondary"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                    Cancel
                  </button>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>

      {{--  --}}

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function(){


        function sortByIdNo(order) {
    event.preventDefault();

    // Get the selected value of page_view
    var page_view = $('#page_view').val();

    // Get the text of the active page link's span element
    var active_page_text = $('.pagination').find('.active').find('.page-link').text();

    // Convert active_page_text to an integer
    var page_id = parseInt(active_page_text);

    // If active_page_text is not a number, default to page 1
    if (isNaN(page_id)) {
        page_id = 1;
    }

    // Serialize form data
    var formdata = $('#search-file').serialize();

    // Make AJAX request
    $.ajax({
        url: 'sorting-filter?page=' + page_id + '&page_view=' + page_view + '&sort_order=' + order,
        method: 'POST', // Assuming you want to use the POST method
        data: formdata, // Corrected variable name
        beforeSend: function () {
            // Show preloader
            $('#paginationContainer').html("");
            $("#table-body").empty();
            $("#table-body").append(`
                <div class="text-center">
                    <div id="preloader2" class="spinner-grow text-success" role="status">
                        <span class="visually mx-5">Loading...</span>
                    </div>
                </div>
            `);
        },
        success: function(response) {
            // Hide preloader
            $("#table-body").empty();
            $('#paginationContainer').html("");
            $('#paginationContainer').html(response.pagination);

            if (response.length === 0) {
                $('#products-area').html('<h2 class="text-center primary-heading">No Result Found</h2>');
            } else {
                var html = '';
                var products = response.data;
                console.log(products);
                products.forEach(function(element) {
                    // File status badge logic
                    var fileStatusBadge = '';
                    if (element.file_status === 'open') {
                        fileStatusBadge = '<span class="badge bg-success">Open</span>';
                    } else if (element.file_status === 'blocked' || element.file_status === 'closed') {
                        fileStatusBadge = '<span class="badge bg-danger">Blocked</span>';
                    } else if (element.file_status === 'processing') {
                        fileStatusBadge = '<span class="badge bg-warning">Processing</span>';
                    } else if (element.file_status === 'reserved') {
                        fileStatusBadge = '<span class="badge bg-info">Reserved</span>';
                    } else if (element.file_status === 'ready' || element.file_status === 'delivered') {
                        fileStatusBadge = '<span class="badge bg-primary">Ready</span>';
                    } else {
                        fileStatusBadge = '<span class="badge bg-secondary">' + element.file_status + '</span>';
                    }

                    // Append row HTML
                    html += `<tr>
            <th scope="row">
                <input type="checkbox" class="all_products" name="items[]" value="${element.id}">
            </th>
            <td><a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Detail" href="/file-data/${element.id}">${element.tracking}</a></td>
            <td>${element.app_form_no}</td>
            <td>${element.id_no}</td>
            <td>${element.security_no}</td>
            <td>${fileStatusBadge}</td>
            <td>${element.type}</td>
            <td>${element.size}</td>
            <td>${element.unit}</td>
            <td class="text-primary">Rs: ${parseFloat(element.total_amount).toLocaleString('en-IN', { maximumFractionDigits: 2 })}</td>
                <td class="text-warning">Rs: ${parseFloat(element.paid_amount).toLocaleString('en-IN', { maximumFractionDigits: 2 })}</td>
                <td class="text-danger">Rs: ${parseFloat(element.balance_amount).toLocaleString('en-IN', { maximumFractionDigits: 2 })}</td>
            <td>${element.file_location}</td>
            <td><span>${element.dealer_name}</span><span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Update Dealer"><i data-bs-toggle="modal" data-bs-target="#ledger_${element.id}" style="cursor: pointer" class="ti ti-pencil mx-1 text-warning"></i></span>
                <!-- Modal code for updating dealer -->
            </td>
            <td>${element.client_name}</td>
            <td>${element.client_cnic}</td>
            <td>${element.plot_no}</td>

            <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/edit-file/${element.id}"><i class="ti ti-pencil me-1"></i> Edit</a>
                        <a class="dropdown-item" href="/delete-file/${element.id}"><i class="ti ti-trash me-1"></i> Delete</a>
                    </div>
                </div>
            </td>
        </tr>`;
                });

                // Append HTML to table body
                $('#table-body').html(html);
            }
        }
    });
}

// Event listener for clicking top arrow for sorting
$('.top-arrow').click(function() {
    $('.bottom-arrow').removeClass('text-primary'); // Remove text-primary class from all top arrows
    $(this).addClass('text-primary'); // Add text-primary class to the clicked top arrow
    sortByIdNo('asc');
});

$('.bottom-arrow').click(function() {
    $('.top-arrow').removeClass('text-primary'); // Remove text-primary class from all bottom arrows
    $(this).addClass('text-primary'); // Add text-primary class to the clicked bottom arrow
    sortByIdNo('desc');
});



        $('.icon-wrapper').click(function(){
      $('#hiddenDiv').slideToggle(500);
      $('#toggleIcon').toggleClass('fa-angle-double-down fa-angle-double-up');
    });


        $("#bulk_btn").click(function(){

    var checkedItems = $("input[name='items[]']:checked").map(function () {
    return $(this).val();
  }).get();


    let val = $("#dealer_data").val();
    if(val === "dealers"){
        $("#bulk_action_modal").modal('show');
    }
    else if(val==="status"){
    $("#status_action_modal").modal('show');
    }
    else if(val=== "delete") {
        if (confirm("Do you want to delete the Files?")) {
  $.ajax({
      url: "{{route('delete_all')}}",
      method: 'GET',
      data: {
          items: checkedItems,
          datafrom:'files',
      },
      success: function (data) {
          if (data.success == true) {

              location.reload();

          } else if (data.success == false) {

              setTimeout(function () {

              }, 2000);
              location.reload();

          }
      }
  });
    }
}
});


$(document).on('click', '.pagination a', function (event) {
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    var formdata = $('#search-file').serialize();
    var page_view=$("#page_view").val();
    $.ajax({
        url: 'files-filter?page=' + page + '&page_view=' + page_view,
        beforeSend: function() {
        $('#paginationContainer').html("");
        $("#table-body").empty();
        $("#table-body").append(`
            <div class="text-center">
                <div id="preloader2" class="spinner-grow text-success" role="status">
                    <span class="visually mx-5">Loading...</span>
                </div>
            </div>
        `);
    },
        success: function (response) {
            $("#table-body").empty();
            $('#paginationContainer').html("");
            $('#paginationContainer').html(response.pagination);
                    // Handle the success response as needed
                    console.log(response);

                    if(response.length ===0){
                        $('#products-area').html(' <h2 class="text-center primary-heading">No Result Found</h2>');
                    }
                    else{
                        $('#paginationContainer').html(response.pagination);
                        var html = '';
                        var products = response.data;

                        products.forEach(function (element) {
                            var fileStatusBadge = '';

if (element.file_status === 'open') {
    fileStatusBadge = '<span class="badge bg-success">Open</span>';
} else if (element.file_status === 'blocked') {
    fileStatusBadge = '<span class="badge bg-danger">Blocked</span>';
}
else if (element.file_status === 'closed') {
    fileStatusBadge = '<span class="badge bg-danger">Closed</span>';
}
else if (element.file_status === 'processing') {
    fileStatusBadge = '<span class="badge bg-warning">Processing</span>';
} else if (element.file_status === 'reserved') {
    fileStatusBadge = '<span class="badge bg-info">Reserved</span>';
} else if (element.file_status === 'ready') {
    fileStatusBadge = '<span class="badge bg-primary">Ready</span>';
} else if (element.file_status === 'delivered') {
    fileStatusBadge = '<span class="badge bg-success">Delivered</span>';
} else {
    fileStatusBadge = '<span class="badge bg-secondary">' + element.file_status + '</span>';
}
                            html += `<tr>
            <th scope="row">
                <input type="checkbox" class="all_products" name="items[]" value="${element.id}">
            </th>
            <td><a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Detail" href="/file-data/${element.id}">${element.tracking}</a></td>
            <td>${element.app_form_no}</td>
            <td>${element.id_no}</td>
            <td>${element.security_no}</td>
            <td>${fileStatusBadge}</td>
            <td>${element.type}</td>
            <td>${element.size}</td>
            <td>${element.unit}</td>
            <td class="text-primary">Rs: ${parseFloat(element.total_amount).toLocaleString('en-IN', { maximumFractionDigits: 2 })}</td>
                <td class="text-warning">Rs: ${parseFloat(element.paid_amount).toLocaleString('en-IN', { maximumFractionDigits: 2 })}</td>
                <td class="text-danger">Rs: ${parseFloat(element.balance_amount).toLocaleString('en-IN', { maximumFractionDigits: 2 })}</td>
            <td>${element.file_location}</td>
            <td><span>${element.dealer_name}</span><span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Update Dealer"><i data-bs-toggle="modal" data-bs-target="#ledger_${element.id}" style="cursor: pointer" class="ti ti-pencil mx-1 text-warning"></i></span>
                <!-- Modal code for updating dealer -->
            </td>
            <td>${element.client_name}</td>
            <td>${element.client_cnic}</td>
            <td>${element.plot_no}</td>

            <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/edit-file/${element.id}"><i class="ti ti-pencil me-1"></i> Edit</a>
                        <a class="dropdown-item" href="/delete-file/${element.id}"><i class="ti ti-trash me-1"></i> Delete</a>
                    </div>
                </div>
            </td>
        </tr>`;
});


$("#table-body").append(html);
                }
                },
                error: function (error) {
                    // Handle errors if any
                    console.error(error);
                }
    });
});


// PAge view
$(document).on('change', '#page_view', function(event) {
    event.preventDefault();

    // Get the selected value of page_view
    var page_view = $(this).val();

    // Get the text of the active page link's span element
    var active_page_text = $('.pagination').find('.active').find('.page-link').text();

    // Convert active_page_text to an integer
    var page_id = parseInt(active_page_text);

    // If active_page_text is not a number, default to page 1
    if (isNaN(page_id)) {
        page_id = 1;
    }

    // Serialize form data
    var formdata = $('#search-file').serialize();

    // Make AJAX request
    $.ajax({
        url: 'files-filter?page=' + page_id + '&page_view=' + page_view,
        method: 'POST', // Assuming you want to use the POST method
        data: formdata, // Corrected variable name
        beforeSend: function() {
            // Show preloader
            $('#paginationContainer').html("");
            $("#table-body").empty();
            $("#table-body").append(`
                <div class="text-center">
                    <div id="preloader2" class="spinner-grow text-success" role="status">
                        <span class="visually mx-5">Loading...</span>
                    </div>
                </div>
            `);
        },
        success: function(response) {
            // Hide preloader
            $("#table-body").empty();
            $('#paginationContainer').html("");
            $('#paginationContainer').html(response.pagination);

            if (response.length === 0) {
                $('#products-area').html('<h2 class="text-center primary-heading">No Result Found</h2>');
            } else {
                var html = '';
                var products = response.data;
                console.log(products);
                products.forEach(function(element) {
                    // File status badge logic
                    var fileStatusBadge = '';
                    if (element.file_status === 'open') {
                        fileStatusBadge = '<span class="badge bg-success">Open</span>';
                    } else if (element.file_status === 'blocked' || element.file_status === 'closed') {
                        fileStatusBadge = '<span class="badge bg-danger">Blocked</span>';
                    } else if (element.file_status === 'processing') {
                        fileStatusBadge = '<span class="badge bg-warning">Processing</span>';
                    } else if (element.file_status === 'reserved') {
                        fileStatusBadge = '<span class="badge bg-info">Reserved</span>';
                    } else if (element.file_status === 'ready' || element.file_status === 'delivered') {
                        fileStatusBadge = '<span class="badge bg-primary">Ready</span>';
                    } else {
                        fileStatusBadge = '<span class="badge bg-secondary">' + element.file_status + '</span>';
                    }

                    // Append row HTML
                    html += `<tr>
            <th scope="row">
                <input type="checkbox" class="all_products" name="items[]" value="${element.id}">
            </th>
            <td><a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Detail" href="/file-data/${element.id}">${element.tracking}</a></td>
            <td>${element.app_form_no}</td>
            <td>${element.id_no}</td>
            <td>${element.security_no}</td>
            <td>${fileStatusBadge}</td>
            <td>${element.type}</td>
            <td>${element.size}</td>
            <td>${element.unit}</td>
            <td class="text-primary">Rs: ${parseFloat(element.total_amount).toLocaleString('en-IN', { maximumFractionDigits: 2 })}</td>
                <td class="text-warning">Rs: ${parseFloat(element.paid_amount).toLocaleString('en-IN', { maximumFractionDigits: 2 })}</td>
                <td class="text-danger">Rs: ${parseFloat(element.balance_amount).toLocaleString('en-IN', { maximumFractionDigits: 2 })}</td>
            <td>${element.file_location}</td>
            <td><span>${element.dealer_name}</span><span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Update Dealer"><i data-bs-toggle="modal" data-bs-target="#ledger_${element.id}" style="cursor: pointer" class="ti ti-pencil mx-1 text-warning"></i></span>
                <!-- Modal code for updating dealer -->
            </td>
            <td>${element.client_name}</td>
            <td>${element.client_cnic}</td>
            <td>${element.plot_no}</td>

            <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/edit-file/${element.id}"><i class="ti ti-pencil me-1"></i> Edit</a>
                        <a class="dropdown-item" href="/delete-file/${element.id}"><i class="ti ti-trash me-1"></i> Delete</a>
                    </div>
                </div>
            </td>
        </tr>`;
                });

                // Append HTML to table body
                $('#table-body').html(html);
            }
        }
    });
});



//


        $("#filter_btn").click(function() {
    // Serialize form data
    let filter_data = $("#search-file").serialize();

  var page_view = $("#page_view").val();

    // Get the text of the active page link's span element
    var active_page_text = $('.pagination').find('.active').find('.page-link').text();

    // Convert active_page_text to an integer
    var page_id = parseInt(active_page_text);

    // If active_page_text is not a number, default to page 1
    if (isNaN(page_id)) {
        page_id = 1;
    }

    // Serialize form data
    var formdata = $('#search-file').serialize();

    // Make AJAX request
    $.ajax({
        url: 'files-filter?page=' + page_id + '&page_view=' + page_view,
    method: 'POST',
    data: filter_data,
    beforeSend: function() {
        $('#paginationContainer').html("");
        $("#table-body").empty();
        $("#table-body").append(`
            <div class="text-center">
                <div id="preloader2" class="spinner-grow text-success" role="status">
                    <span class="visually mx-5">Loading...</span>
                </div>
            </div>
        `);
    },
    success: function(response) {
        $("#table-body").empty();
        $('#paginationContainer').html(response.pagination);
        let html='';
        response.data.forEach((element)=>{
            var fileStatusBadge = '';

if (element.file_status === 'open') {
    fileStatusBadge = '<span class="badge bg-success">Open</span>';
} else if (element.file_status === 'blocked') {
    fileStatusBadge = '<span class="badge bg-danger">Blocked</span>';
}
else if (element.file_status === 'closed') {
    fileStatusBadge = '<span class="badge bg-danger">Closed</span>';
}
else if (element.file_status === 'processing') {
    fileStatusBadge = '<span class="badge bg-warning">Processing</span>';
} else if (element.file_status === 'reserved') {
    fileStatusBadge = '<span class="badge bg-info">Reserved</span>';
} else if (element.file_status === 'ready') {
    fileStatusBadge = '<span class="badge bg-primary">Ready</span>';
} else if (element.file_status === 'delivered') {
    fileStatusBadge = '<span class="badge bg-success">Delivered</span>';
} else {
    fileStatusBadge = '<span class="badge bg-secondary">' + element.file_status + '</span>';
}
            html += `<tr>
            <th scope="row">
                <input type="checkbox" class="all_products" name="items[]" value="${element.id}">
            </th>
            <td><a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Detail" href="/file-data/${element.id}">${element.tracking}</a></td>
            <td>${element.app_form_no}</td>
            <td>${element.id_no}</td>
            <td>${element.security_no}</td>
            <td>${fileStatusBadge}</td>
            <td>${element.type}</td>
            <td>${element.size}</td>
            <td>${element.unit}</td>
            <td class="text-primary">Rs: ${parseFloat(element.total_amount).toLocaleString('en-IN', { maximumFractionDigits: 2 })}</td>
                <td class="text-warning">Rs: ${parseFloat(element.paid_amount).toLocaleString('en-IN', { maximumFractionDigits: 2 })}</td>
                <td class="text-danger">Rs: ${parseFloat(element.balance_amount).toLocaleString('en-IN', { maximumFractionDigits: 2 })}</td>
            <td>${element.file_location}</td>
            <td><span>${element.dealer_name}</span><span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Update Dealer"></span>
                <!-- Modal code for updating dealer -->
            </td>
            <td>${element.client_name}</td>
            <td>${element.client_cnic}</td>
            <td>${element.plot_no}</td>

            <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/edit-file/${element.id}"><i class="ti ti-pencil me-1"></i> Edit</a>
                        <a class="dropdown-item" href="/delete-file/${element.id}"><i class="ti ti-trash me-1"></i> Delete</a>
                    </div>
                </div>
            </td>
        </tr>`;
        });
        $("#table-body").append(html);
    },
    error: function(xhr, status, error) {
        console.error(xhr.responseText);
    }
});




});



$("#status_btn").click(function(){
        // Get the selected dealer ID
        var select_status = $("#status_val").val();
        // Get the selected items
        var checkedItems = $("input[name='items[]']:checked").map(function () {
            return $(this).val();
        }).get();
        // Append values to the form

        // Append selected items as hidden inputs
        checkedItems.forEach(function (item) {
            $("<input>").attr({
                type: "hidden",
                name: "selected_items[]",
                value: item
            }).appendTo("#status_form");
        });
        $("<input>").attr({
            type:"hidden",
            name:"status",
            value:select_status
        }).appendTo("#status_form");

        $("#status_form").submit();
    });

    // Dealer BTN
   $("#dealer_btn").click(function(){
        // Get the selected dealer ID
        var selectedDealer = $("#dealer_assign").val();
        // Get the selected items
        var checkedItems = $("input[name='items[]']:checked").map(function () {
            return $(this).val();
        }).get();
        // Append values to the form
        $("#dealer_assign").val(selectedDealer);
        // Append selected items as hidden inputs
        checkedItems.forEach(function (item) {
            $("<input>").attr({
                type: "hidden",
                name: "selected_items[]",
                value: item
            }).appendTo("#dealer_form");
        });
        $("<input>").attr({
            type:"hidden",
            name:"dealer_id",
            value:selectedDealer
        }).appendTo("#dealer_form");

        $("#dealer_form").submit();
    });

    //


          $('#checkItems').on('click', function(e) {
              // e.preventDefault();
              $('.all_products').each(function() {
                  $(this).prop('checked', !$(this).prop('checked'));
              });
          });
      });
      $("#delete_all").click(() => {

  var checkedItems = $("input[name='items[]']:checked").map(function () {
      return $(this).val();
  }).get();



  $.ajax({
      url: "{{route('delete_all')}}",
      method: 'GET',
      data: {
          items: checkedItems,
          datafrom:'files',
      },
      success: function (data) {
          if (data.success == true) {

              location.reload();

          } else if (data.success == false) {

              setTimeout(function () {

              }, 2000);
              location.reload();

          }
      }
  });

});
</script>
@endsection

