@extends('admin.partials.layout')

@section('meta')

<title>Setting | {{config('app.name')}}</title>

@endsection

@section('extra_css')

@endsection

@section('main_content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Setting</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                    <li class="breadcrumb-item active">Setting</li>
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
                        <h4 class="card-title mb-4">Change Password</h4>
                        @if($errors->any())
                            @if($errors->first() == 'success')
                                <div class="alert alert-success" role="alert">
                                    Password has been succesfully updated.
                                </div>
                            @elseif($errors->first() == 'c_pass_not_match')
                                <div class="alert alert-danger" role="alert">
                                    Current password doesnot match.
                                </div>
                            @elseif($errors->first() == 'other')
                                <div class="alert alert-danger" role="alert">
                                    Password not updated. Please check your connection.
                                </div>
                            @endif
                        @endif
                        <form action="{{ route('admin.change_password') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Current Password</label>
                                        <input type="password" name="current_password" class="form-control" placeholder="Enter your current password">
                                        @error('current_password')
                                            <span style="font-size:13px!important; color: #fd0710!important;">
                                                {{ $message }} *
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">New Password</label>
                                        <input type="password" name="new_password" class="form-control" placeholder="Enter your new password">
                                        @error('new_password')
                                            <span style="font-size:13px!important; color: #fd0710!important;">
                                                {{ $message }} *
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Confirm New Password</label>
                                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm your password">
                                        @error('confirm_password')
                                            <span style="font-size:13px!important; color: #fd0710!important;">
                                                {{ $message }} *
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <button type="submit" class="btn btn-primary">Change Passowrd</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
    $(document).ready(function(){
        
        $("#show-file-div").click(function() {  
             $(".file-upload-div").css('display', 'block');     
        });
    });
</script>
<script src="/assets/js/pages/file-manager.init.js"></script>
@endsection