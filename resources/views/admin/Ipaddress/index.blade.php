@extends('admin.partical.main')
@push('title')
    <title>Dashboard | Admin</title>
@endpush

@push('custom-css')
@endpush

@section('content')
    <div class="main-content">
        <div class="pages-content">

            <div class="dash-tabs d-flex justify-content-between align-items-center mb-3">

                {{-- LEFT SIDE: Validation message --}}
                <div class="validation-message">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-0 py-2 px-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                {{-- RIGHT SIDE: Create button --}}
                <div class="dash-tabs-filter d-flex gap-3">
                    <div class="create-client-btn">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#createIpModal"
                            class="d-flex align-items-center gap-2">
                            <img src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">Create IP
                        </a>
                    </div>
                </div>

            </div>
            <div class="dash-tabs-content no-scrollbar">
                <div class="tab-pane fade show active" id="pills-Allclient" role="tabpanel"
                        aria-labelledby="pills-Allclient-tab" tabindex="0">
  
                    
                        <div class="table-responsive">
                            <table class="example row-border order-column nowrap">
                                <thead class="thead-light">
                                
                                    <tr>
                                        <th></th>
                                        <th>SNo.</th>
                                        <th>Ip Address</th>
                                        <th>Created At</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
    
                                   @forelse ($allowIp as $key => $ip)
                                
                                        <tr>
                                            <td></td>
                                            <td>{{ $loop->iteration  }}</td>
                                            <td>{{ $ip->ip_address }}</td>
                                            <td>{{ $ip->created_at }}</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li>
                                                        <span class="iconify delete-icon" data-icon="iconoir:trash"
                                                            data-inline="false" style="font-size: 24px; cursor: pointer;"
                                                            data-id="{{ $ip->id }}">
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" class="openEditModal"
                                                            data-id="{{ $ip->id }}" data-ip="{{ $ip->ip_address }}"
                                                            data-bs-toggle="modal" data-bs-target="#editIpModal">
                                                            <span class="iconify" data-icon="basil:edit-outline"
                                                                style="font-size: 24px; cursor:pointer;"></span>
                                                        </a>
                                                        
                                                    </li>

                                                </ul>
                                            </td>
                                        </tr>


                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                            
                    </div>

                </div>

            </div>
        </div>

    </div>
    <div class="modal fade" id="createIpModal" tabindex="-1" aria-labelledby="createIpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="createIpModalLabel">Add IP Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.ip.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>IP Address</label>
                            <input type="text" name="ip_address" class="form-control" placeholder="Enter IP Address"
                                required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <div class="modal fade" id="editIpModal" tabindex="-1" aria-labelledby="editIpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editIpModalLabel">Edit IP Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="editIpForm" method="POST" method="post">
                    @csrf
                  

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>IP Address</label>
                            <input type="text" name="ip_address" id="edit_ip" class="form-control" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



    <!-- write-body-content here end -->
    </div>

    </section>

    <div class="search-box-mob">
        <div class="close-search-bar">
            <img width="30" height="30" src="https://img.icons8.com/ios/30/close-window.png')}}"
                alt="close-window" />
        </div>

        @push('custom-js')
            <script>
                $(document).on('click', '.delete-icon', function() {
                    var id = $(this).data('id');
                    if (confirm('Are you sure want to delete?')) {
                        $.ajax({
                            url: "{{ route('admin.ip.delete', '') }}/" + id,
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                location.reload();
                            }
                        });
                    }
                });

                $(document).on('click', '.openEditModal', function() {
                 
                    let id = $(this).data('id');
                    let ip = $(this).data('ip');

                    $('#edit_ip').val(ip);
                    $('#editIpForm').attr('action', '/admin/Ip-address/update/' + id);
                });
            </script>
        @endpush
    @endsection
