@extends('client.partials.layout')

@section('meta')

<title>Member Files | {{config('app.name')}}</title>

@endsection

@section('extra_css')

<style>
    table tr th,td{
        font-size: 13px;
    }
    .box{
        display: none;
    }
</style>
@endsection

@section('main_content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Member Files</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                    <li class="breadcrumb-item active">Member Files</li>
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
                            <div class="row mb-0">
                                <div class="col-xl-3 col-sm-6">
                                    <div class="mt-2">
                                        <h5>Documents</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                          <th scope="col">Name</th>
                                          <th scope="col">Date</th>
                                        </tr>
                                      </thead>
                                    <tbody>
                                        @if ($files->Count() == 0 AND $folders->Count() == 0)
                                            <tr>
                                                <td colspan="3">
                                                    <div class="alert alert-info text-center" role="alert">
                                                        No files to show.
                                                    </div>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($folders as $folder)
                                                <tr>
                                                    <td>
                                                        <a href="/my-folder/files/{{ $folder->slug }}" class="text-dark fw-medium">
                                                            <i class="mdi mdi-folder font-size-16 align-middle text-warning me-2"></i>
                                                            {{ $folder->folder_name }}
                                                        </a>
                                                    </td>
                                                    <td>{{  date("d M Y", strtotime($folder->created_at)) }}</td>
                                                </tr>
                                            @endforeach
                                            @foreach ($files as $file)
                                                <tr>
                                                    <td>
                                                        <a href="/uploads/member-files/{{ $file->file }}" target="_blank" class="text-dark fw-medium">
                                                            @php
                                                                $filename = $file->file;
                                                                $a = explode('.', $filename);
                                                            @endphp
                                                            @if ($a[1] == "pdf" OR $a[1] == "PDF")
                                                                <i class="mdi mdi-file-pdf font-size-16 align-middle text-danger me-2"></i>
                                                            @elseif ($a[1] == "docx" OR $a[1] == "DOCX")
                                                                <i class="mdi mdi-file-word font-size-16 align-middle text-primary me-2"></i>
                                                            @elseif ($a[1] == "png" OR $a[1] == "PNG")
                                                                <i class="mdi mdi-file-image font-size-16 align-middle text-primary text-success me-2"></i>
                                                            @elseif ($a[1] == "jpg" OR $a[1] == "jpg")
                                                                <i class="mdi mdi-file-image font-size-16 align-middle text-primary me-2"></i>
                                                            @elseif ($a[1] == "JPEG" OR $a[1] == "JPEG")
                                                                <i class="mdi mdi-file-image font-size-16 align-middle text-sucondary me-2"></i>
                                                            @elseif ($a[1] == "xlsx" OR $a[1] == "XLXS")
                                                                <i class="mdi mdi-file-excel font-size-16 align-middle text-primary me-2"></i>
                                                            @elseif ($a[1] == "txt" OR $a[1] == "TXT")
                                                                <i class="mdi mdi-file-document font-size-16 align-middle text-primary me-2"></i>
                                                            @else
                                                                <i class="mdi mdi-file font-size-16 align-middle text-secondary me-2"></i>
                                                            @endif
                                                             
                                                            {{ $file->filename }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        {{  date("d M Y", strtotime($file->created_at)) }}
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
        </div>
    </div>
</div>

@endsection
@section('extra_js')
<script src="/assets/js/pages/file-manager.init.js"></script>
@endsection