<x-default>

    @push('isstyles')
    <link rel="stylesheet" href="{{ asset('global/vendor/datatables.net-bs4/dataTables.bootstrap4.min.css')}}">
    @endpush

    <div class="page-header page-header-bordered">
        <h1 class="page-title">Customer</h1>
        <div class="page-header-actions">
            <a href="{{ route('device_create_index') }}" class="btn btn-sm btn-outline btn-primary btn-round waves-effect waves-classic">
                <span class="text hidden-sm-down">Add New</span>
                <i class="icon md-chevron-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</x-default>