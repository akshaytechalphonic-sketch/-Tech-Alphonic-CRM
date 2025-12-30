@extends('admin.partical.main')
@push('title')
    <title>Dashboard | Admin</title>
@endpush

@push('custom-css')
@endpush

@section('content')
    <div class="main-content">
        <div class="pages-content">

            <div class="dash-tabs d-flex justify-content-end align-items-center mb-3">

                <div class="dash-tabs-filter d-flex gap-3">

                    <div class="create-client-btn">
                        <a href="{{ route('admin.ip.create') }}" class="d-flex align-items-center gap-2">
                            <img src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">Create IP
                        </a>
                    </div>

                </div>

            </div>
            <div class="dash-tabs-content no-scrollbar">
                <div class="tab-content" id="pills-tabContent">

                    <form action="{{ route('admin.ip.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>IP Address</label>
                            <input type="text" name="ip_address" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>

            </div>
        </div>

    </div>


    <!-- write-body-content here end -->
    </div>

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
            </script>
        @endpush
    @endsection
