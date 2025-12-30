    <!--Filter  Modal -->
        <div class="modal fade" id="filterModel" tabindex="-1" aria-labelledby="filterModelLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <form action="">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="filterModelLabel">Filter</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Ministry*  </label>
                                <select class="form-select" id="gender" aria-label="Default select example">
                                    <option selected> Choose Any One</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Department*  </label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected> Choose Any One</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Organization name*  </label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected> Choose Any One</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Office name* </label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected> Choose Any One</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">City  </label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected> Choose Any One</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">State  </label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected> Choose Any One</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-item-center justify-content-between">
                        <button type="reset" class="btn-dark">Reset</button>
                        <button type="button" class="btn-dark">Select</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
     <!--Filter  Modal end -->

    <!--Department  Modal -->
        <div class="modal fade" id="addDepartmentModel" tabindex="-1" aria-labelledby="addDepartmentModelLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <form action="" class="w-100">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="addDepartmentModelLabel">Add Departments</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Department Name* </label>
                                <input type="text" class="form-control" id=""  placeholder="Department Name*">
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Status*  </label>
                                <select class="form-select" id="gender" aria-label="Default select example">
                                    <option value="Active" selected> Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-item-center justify-content-between">
                        <button type="reset" class="btn-dark">Reset</button>
                        <button type="Submit" class="btn-dark">Submit</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
     <!--Department  Modal end -->

     <!--Designations  Modal -->
     <div class="modal fade" id="addDesignationsModel" tabindex="-1" aria-labelledby="addDesignationsModelLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <form action="" class="w-100">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="addDesignationsModelLabel">Add Designations</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Add Designation* </label>
                                <input type="text" class="form-control" id=""  placeholder="Add Designation">
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Department Name* </label>
                                <!-- <input type="text" class="form-control" id=""  placeholder="Department Name*"> -->
                                <select class="form-select gender" id="gender" aria-label="Default select example">
                                    <option selected> Choose Any One</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 mb-3">
                                <label for="" class="form-label">Status*  </label>
                                <select class="form-select" id="gender" aria-label="Default select example">
                                    <option value="Active" selected> Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-item-center justify-content-between">
                        <button type="reset" class="btn-dark">Reset</button>
                        <button type="Submit" class="btn-dark">Submit</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
     <!--Designations  Modal end -->



     <script>
        @if(Session::has('success'))
            Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
        @endif

        @if(Session::has('error'))
            Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK'
                });
        @endif

    </script>


    {{-- <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
     <!-- DataTables JS -->
     <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
     <!-- Buttons Extension for DataTables -->
     <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->
        <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/fixedcolumns/5.0.4/js/dataTables.fixedColumns.js"></script>
        <script src="https://cdn.datatables.net/fixedcolumns/5.0.4/js/fixedColumns.dataTables.js"></script>
        <script src="https://cdn.datatables.net/select/3.0.0/js/dataTables.select.js"></script>
        <script src="https://cdn.datatables.net/select/3.0.0/js/select.dataTables.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
     <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{ asset('public/admin/assets/js/script.js')}}"></script>
    {{-- <script>

        $(document).ready(function() { $("#gender").select2(); });


        $('#filterModel').on('shown.bs.modal', function () {
        $('.form-select').select2({
          dropdownParent: $('#filterModel'), // Attach dropdown to modal
          width: '100%' // Full width
        });
      });


        $('#addDesignationsModel').on('shown.bs.modal', function () {
        $('.gender').select2({
          dropdownParent: $('#addDesignationsModel'), // Attach dropdown to modal
          width: '100%' // Full width
        });
      });

      $(document).ready(function () {
        $('.example').DataTable({
        dom: 'lBfrtip', // Add length menu and buttons on top
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible' // Export only visible columns
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible' // Export only visible columns
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible' // Export only visible columns
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible' // Export only visible columns
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible' // Export only visible columns
                }
            },
            {
                extend: 'colvis',
                text: 'Column Visibility'
            }
        ],
        paging: true, // Enable pagination
        searching: true, // Enable search functionality
        ordering: true, // Enable sorting functionality
        order: [[0, 'asc']], // Default sort by the first column
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100], // Options for rows per page
        responsive: true, // Enable responsiveness
        language: {
            lengthMenu: "Show _MENU_ entries" // Customize "Show entries" text
        },
        select: true
            });
        });

    </script> --}}
    <script>

        $(document).ready(function() { $("#gender").select2(); });


        $('#filterModel').on('shown.bs.modal', function () {
        $('.gender').select2({
          dropdownParent: $('#filterModel'), // Attach dropdown to modal
          width: '100%' // Full width
        });
      });


        $('#addDesignationsModel').on('shown.bs.modal', function () {
        $('.gender').select2({
          dropdownParent: $('#addDesignationsModel'), // Attach dropdown to modal
          width: '100%' // Full width
        });
      });




    </script>
    <script>
        $(function() {
        $('input[name="datetimes"]').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
            format: 'MM/DD/YYYY  A'
            }
            // locale: {
            // format: 'MM/DD/YYYY hh:mm A'
            // }
        });
        });
        new DataTable('.example', {
        dom: 'Bflrtip',
        columnDefs: [
            {
                orderable: false,
                render: DataTable.render.select(),
                targets: 0
            }
        ],
        fixedColumns: {
            start: 1
        },
        order: [[0, 'asc']], // Default sort by the first column
        paging: true, // Enable pagination
        searching: true, // Enable search functionality
        ordering: true, // Enable sorting functionality
        pageLength: 10, // Default rows per page
        lengthMenu: [10, 50, 75, 100], // Options for rows per page
        responsive: true, // Enable responsiveness
        language: {
            lengthMenu: "Show _MENU_ entries" // Customize "Show entries" text
        },
        scrollCollapse: true,
        scrollX: true,
        scrollY: true,
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':not(:first-child)' ,
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':not(:first-child)' ,
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(:first-child)' ,
                }
            },
            {
                extend: 'pdf',
                orientation: 'landscape', // Set landscape orientation
                pageSize: 'A4', // Optional: Set the page size
                customize: function (doc) {
                    // Adjust the page margins
                    doc.pageMargins = [10, 20, 10, 20]; // [left, top, right, bottom]
                    doc.defaultStyle.fontSize = 10; // Optional: Adjust font size
                    doc.styles.tableHeader.fontSize = 12; // Optional: Adjust header font size
                },
                exportOptions: {
                    columns: ':not(:first-child)' ,
                }
            },
            {
                extend: 'print',
                text: 'Print all (not just selected)',
                exportOptions: {
                    columns: ':not(:first-child)' ,
                }
            },
            {
                extend: 'colvis',
            }
        ]
        });
   
    </script>




@stack('custom-js')


  </body>
</html>
