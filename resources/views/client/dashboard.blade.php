@extends('client.partials.layout')

@section('meta')

<title>Dashboard| {{config('app.name')}}</title>

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
            <h4 class="mb-sm-0 font-size-18">My Files</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                    <li class="breadcrumb-item active">My Files</li>
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
                        {{-- @if($errors->any())
                            @if($errors->first() == 'FileUploaded')
                                <div class="alert alert-success" role="alert">
                                    File uploaded successfully.
                                </div>
                            @elseif($errors->first() == 'FileNotUploaded')
                                <div class="alert alert-danger" role="alert">
                                    File not uploaded. Check your internet coonection and try again.
                                </div>
                            @elseif($errors->first() == 'UnknownError')
                                <div class="alert alert-warning" role="alert">
                                    Check your internet coonection and try again.
                                </div>
                            @endif
                        @endif --}}
                        <div>
                            <div class="row mb-0">
                                <div class="col-xl-3 col-sm-6">
                                    <div class="mt-2">
                                        <h5>Documents</h5>
                                    </div>
                                </div>
                                <div class="col-xl-9 col-sm-6">
                                    <form class="mt-4 mt-sm-0 float-sm-end d-flex align-items-center">
                                        <div class="search-box mb-2 me-2">
                                            <div class="position-relative">
                                                <input type="text" class="form-control bg-light border-light rounded" placeholder="Search..." id="search">
                                                <i class="bx bx-search-alt search-icon"></i>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-hover mb-0" id="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col" style="text-align: right; padding-right:20px;">
                                                Date modified
                                            </th>
                                        </tr>
                                      </thead>
                                    <tbody>
                                        @if ($files->Count() == 0)
                                            <tr>
                                                <td colspan="2">
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
                                                    <td style="text-align: right; padding-right:20px;">{{  date("d M Y", strtotime($folder->created_at)) }}</td>
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
                                                    <td style="text-align: right; padding-right:20px;">
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
                <!-- end card -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra_js')
    
<script>
    var $rows = $('#table tr');
    $('#search').keyup(function() {
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
        
        $rows.show().filter(function() {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).hide();
    });
</script>
<script src="/assets/js/pages/file-manager.init.js"></script>
@endsection