@extends('admin.partials.layout')

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
                        @if($errors->any())
                            @if($errors->first() == 'FileUploaded')
                                <div class="alert alert-success" role="alert">
                                    File uploaded successfully.
                                </div>
                            @elseif($errors->first() == 'FileNotUploaded')
                                <div class="alert alert-danger" role="alert">
                                    File not uploaded. Check your internet coonection and try again.
                                </div>
                            @elseif($errors->first() == 'file_deleted')
                                <div class="alert alert-danger" role="alert">
                                    File deleted successfully.
                                </div>
                            @elseif($errors->first() == 'FolderCreated')
                                <div class="alert alert-success" role="alert">
                                    Folder uploaded successfully
                                </div>
                            @elseif($errors->first() == 'FolderNotCreated')
                                <div class="alert alert-danger" role="alert">
                                    Folder not created. Check your internet coonection and try again.
                                </div>
                            @elseif($errors->first() == 'folder_deleted')
                                <div class="alert alert-danger" role="alert">
                                    Folder deleted successfully.
                                </div>
                            @elseif($errors->first() == 'UnknownError')
                                <div class="alert alert-warning" role="alert">
                                    Check your internet coonection and try again.
                                </div>
                            @endif
                        @endif
                        <div>
                            <div class="row mb-0">
                                <div class="col-xl-3 col-sm-6">
                                    <div class="mt-2">
                                        <h5>Documents</h5>
                                    </div>
                                </div>
                                <div class="col-xl-9 col-sm-6">
                                    <form class="mt-4 mt-sm-0 float-sm-end d-flex align-items-center">
                                        <div class="dropdown mb-2 me-2">
                                            <a class="btn btn-sm btn-outline-primary" href="javascript:void(0)" id="show-folder-div">
                                                <i class="bx bx-file me-1"></i> Create Folder
                                            </a>
                                            <a class="btn btn-sm btn-outline-primary" href="javascript:void(0)" id="show-file-div">
                                                <i class="bx bx-file me-1"></i> Upload File
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="box file-upload-div">
                            <div class="row mb-4">
                                <div class="col-md-6" id="dropzone">
                                    <form action="{{ route('member.uploadfiles_inFolder') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="client_id" value="{{ $client_id }}">
                                        <input type="hidden" name="slug" value="{{ $slug }}">
                                        <div class="form-group mb-3">
                                            <label for="">Filename</label>
                                            <input type="text" class="form-control" placeholder="Enter file name" name="filename">
                                            @error('filename')
                                                <span>
                                                    <p style="font-size:13px!important; color: #fd0710!important;">{{ $message }}*</p>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Upload Files</label>
                                            <input type="file" class="form-control" placeholder="Upload Files" name="file">
                                            @error('file')
                                                <span>
                                                    <p style="font-size:13px!important; color: #fd0710!important;">{{ $message }}*</p>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary">Upload File</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="box folder-upload-div">
                            <div class="row mb-4">
                                <div class="col-md-6" id="dropzone">
                                    <form action="{{ route('member.create_folderinfolder') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="client_id" value="{{ $client_id }}">
                                        <input type="hidden" name="slug" value="{{ $slug }}">
                                        <div class="form-group mb-3">
                                            <label for="">Folder Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Folder Name" name="folder_name">
                                            @error('folder_name')
                                            <span>
                                                <p style="font-size:13px!important; color: #fd0710!important;">{{ $message }}*</p>
                                            </span>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary">Create Folder</button>
                                        </div>
                                    </form>
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
                                          <th scope="col">Action</th>
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
                                                        <a href="/admin/{{ $folder->client_id }}/member-files/{{ $folder->slug }}" class="text-dark fw-medium">
                                                            <i class="mdi mdi-folder font-size-16 align-middle text-warning me-2"></i>
                                                            {{ $folder->folder_name }}
                                                        </a>
                                                    </td>
                                                    <td>{{  date("d M Y", strtotime($folder->created_at)) }}</td>
                                                    <td>
                                                        <a class="btn btn-danger waves-effect waves-light btn-sm" data-bs-toggle="modal" data-bs-target="#delete-folder-modal" 
                                                        onclick="deleteFolder('<?php echo $folder->id; ?>', '<?php echo $folder->folder_name; ?>')">
                                                            <i class="mdi mdi-delete font-size-13 align-middle me-1"></i> Delete
                                                        </a>
                                                    </td>
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
                                                    <td>{{  date("d M Y", strtotime($file->created_at)) }}</td>
                                                    <td>
                                                        <a class="btn btn-danger waves-effect waves-light btn-sm" data-bs-toggle="modal" data-bs-target="#delete-file-modal" 
                                                        onclick="deleteFile('<?php echo $file->id; ?>', '<?php echo $file->filename; ?>')">
                                                            <i class="mdi mdi-delete font-size-13 align-middle me-1"></i> Delete
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
        </div>
    </div>
</div>
<!-- Delete File Modal -->
<div class="modal fade" id="delete-file-modal" tabindex="-1" role="dialog" aria-labelledby="deletefileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="">
                    Delete File
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <b id="name" class="text-danger"></b> ?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('delete.member-file') }}" method="POST">
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
<!-- Delete Folder Modal -->
<div class="modal fade" id="delete-folder-modal" tabindex="-1" role="dialog" aria-labelledby="deletefileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deletefileModalLabel">
                    Delete Folder
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <b id="name" class="text-danger"></b> ?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('delete.member-folder') }}" method="POST">
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
    $(document).ready(function(){
        $("#show-file-div").click(function() {  
             $(".file-upload-div").css('display', 'block');     
        });
        $("#show-folder-div").click(function() {  
             $(".folder-upload-div").css('display', 'block');     
        });
    });

    function deleteFile(id, name ){
      $("#delete-file-modal #name").html(name);
      $("#delete-file-modal #id").val(id);
    }
    function deleteFolder(id, name ){
      $("#delete-folder-modal #name").html(name);
      $("#delete-folder-modal #id").val(id);
    }
</script>
<script src="/assets/js/pages/file-manager.init.js"></script>
@endsection