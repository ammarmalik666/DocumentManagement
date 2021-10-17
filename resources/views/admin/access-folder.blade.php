@extends('admin.partials.layout')

@section('meta')

<title>Access Folder | {{config('app.name')}}</title>

@endsection

@section('extra_css')

<style>
    table tr th,td{
        font-size: 13px;
    }
</style>
@endsection

@section('main_content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Access Folder</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                    <li class="breadcrumb-item active">Access Folder</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="d-xl-flex">
    <div class="w-100">
        <div class="d-md-flex">
            <div class="w-100">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div class="row mb-3">
                                <div class="col-xl-3 col-sm-6">
                                    <div class="mt-2">
                                        <h5>My Files</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6">
                                    <div class="card shadow-none border">
                                        <div class="card-body p-3">
                                            <div class="float-end ms-2">
                                                <div class="dropdown mb-2">
                                                    <a class="font-size-16 text-muted"><i class="mdi mdi-lock-open"></i></a>
                                                </div>
                                            </div>
                                            <div class="avatar-xs me-3 mb-3">
                                                <div class="avatar-title bg-transparent rounded">
                                                    <i class="bx bxs-folder font-size-24 text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="overflow-hidden me-auto">
                                                    <h5 class="font-size-14 text-truncate mb-1"><a href="/admin/{{ $client_id }}/member-files" class="text-body">Member Access</a></h5>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-md-3 col-sm-6">
                                    <div class="card shadow-none border">
                                        <div class="card-body p-3">
                                            <div class="float-end ms-2">
                                                <div class="dropdown mb-2">
                                                    <a class="font-size-16 text-muted"><i class="mdi mdi-lock"></i></a>
                                                </div>
                                            </div>
                                            <div class="avatar-xs me-3 mb-3">
                                                <div class="avatar-title bg-transparent rounded">
                                                    <i class="bx bxs-folder font-size-24 text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="overflow-hidden me-auto">
                                                    <h5 class="font-size-14 text-truncate mb-1"><a href="/admin/{{ $client_id }}/admin-files" class="text-body">Admin Access</a></h5>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra_js')
<script src="assets/libs/select2/js/select2.min.js"></script>
<script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/js/pages/crypto-orders.init.js"></script>
@endsection