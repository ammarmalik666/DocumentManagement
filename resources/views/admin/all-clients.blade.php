@extends('admin.partials.layout')

@section('meta')

<title>All Clients | {{config('app.name')}}</title>

@endsection

@section('extra_css')
<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
            <h4 class="mb-sm-0 font-size-18">All Clients</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                    <li class="breadcrumb-item active">All Clients</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3">All Clients</h4>
                @if($errors->any())
                    @if($errors->first() == 'client_deleted')
                        <div class="alert alert-danger" role="alert">
                            Client deleted successfully.
                        </div>
                    @elseif($errors->first() == 'UnknownError')
                        <div class="alert alert-warning" role="alert">
                            Check your internet coonection and try again.
                        </div>
                            @endif
                        @endif
                <div class="table-responsive mt-1">
                    <table class="table table-hover datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">Client Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Type</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($client->Count() == 0)
                                <tr>
                                    <td colspan="3">
                                        <div class="alert alert-info text-center" role="alert">
                                            No clients found.
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($client as $client)
                                    <tr>
                                        <td>
                                            <a href="/admin/{{$client->id}}/access-folder">
                                                {{ $client->client_type }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $client->email }}
                                        </td>
                                        <td>
                                            @if ($client->individual_client_id == null)
                                                Business Client
                                            @elseif($client->business_client_id == null)
                                                Individual Client
                                            @endif
                                        </td>
                                        <td>13/10/21</td>
                                        <td>
                                            <a href="javascript:void(0);" class="font-size-16 text-danger" data-bs-toggle="modal" data-bs-target="#delete-client-modal" onclick="deleteClient('<?php echo $client->id; ?>', '<?php echo $client->client_type; ?>')">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Delete Client Modal -->
<div class="modal fade" id="delete-client-modal" tabindex="-1" role="dialog" aria-labelledby="deletefileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deletefileModalLabel">
                    Delete Client
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <b id="name" class="text-danger"></b> ?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('delete.client') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id" value="">
                    <button class="btn btn-outline-danger btn-sm" type="submit">
                        Delete
                    </button>
                </form>
                <button class="btn btn-outline-white btn-sm" data-bs-dismiss="modal" aria-label="Close">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra_js')
<script>
    function deleteClient(id, name ){
      $("#delete-client-modal #name").html(name);
      $("#delete-client-modal #id").val(id);
    }
</script>
<script src="assets/libs/select2/js/select2.min.js"></script>
<script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/js/pages/crypto-orders.init.js"></script>
@endsection