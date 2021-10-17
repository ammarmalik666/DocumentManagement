@extends('admin.partials.layout')

@section('meta')

<title>Add Clients | {{config('app.name')}}</title>

@endsection

@section('extra_css')
<style>
    .box{
        display: none;
    }
</style>
@endsection

@section('main_content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Add Clients</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                    <li class="breadcrumb-item active">Add Clients</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @if($errors->any())
                    @if($errors->first() == 'Client_Added')
                        <div class="alert alert-success" role="alert">
                            Client Added Successfully.
                        </div>
                    @elseif($errors->first() == 'Client_Added')
                        <div class="alert alert-unknownError" role="alert">
                            Check your internet coonection and try again.
                        </div>
                    @endif
                @endif
                <h4 class="card-title mb-3">New Client</h4>
                <form action="{{ route('add.client') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="d-block mb-1">Client Type :</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="client_type" id="inlineRadio1" value="individual" required>
                                <label class="form-check-label" for="inlineRadio1">Individual</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="client_type" id="inlineRadio2" value="business" required>
                                <label class="form-check-label" for="inlineRadio2">Business</label>
                            </div>
                        </div>
                    </div>
                    <div class="box individual">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formrow-firstname-input" class="form-label">Client Name <code>*</code></label>
                                    <input type="text" class="form-control" id="formrow-firstname-input" name="client_name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="client_email">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="client_phone">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control" name="client_mobile">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Physical Address</label>
                                    <div class="input-group">
                                        <div class="input-group-text search-address-icon"><i class="mdi mdi-map-marker-circle"></i></div>
                                        <input type="text" class="form-control" placeholder="Seacrh address here" name="physical_address">
                                    </div>
                                    <div class="form-check mt-1">
                                        <input class="form-check-input" type="checkbox" id="postal-address" name="postal_checkbox" value="postal-address" checked>
                                        <label class="form-check-label" for="postal-address">
                                          Postal Address is the same as Physical Address
                                        </label>
                                    </div>
                                </div>
                                <div class="postal-address box">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-text search-address-icon">
                                                    <i class="mdi mdi-map-marker-circle"></i>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Postal address here" name="postal_address">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box business">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Business Name <code>*</code></label>
                                <input type="text" class="form-control" id="" placeholder="Enter business name" name="business_name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Name <code>*</code></label>
                                <input type="text" class="form-control" id="" placeholder="Enter contact name" name="contact_name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Business Email</label>
                                <input type="email" class="form-control" placeholder="Enter business email" name="business_email">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Email</label>
                                <input type="email" class="form-control" placeholder="Enter contact email" name="contact_email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Business Phone</label>
                                <input type="text" class="form-control" placeholder="Enter business phone" name="business_phone">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Phone</label>
                                <input type="text" class="form-control" placeholder="Enter contact phone" name="contact_phone">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Business Mobile</label>
                                <input type="text" class="form-control" placeholder="Enter business mobile" name="business_mobile">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Mobile</label>
                                <input type="text" class="form-control" placeholder="Enter contact mobile" name="contact_mobile">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Physical Address</label>
                                <div class="input-group">
                                    <div class="input-group-text search-address-icon"><i class="mdi mdi-map-marker-circle"></i></div>
                                    <input type="text" class="form-control" placeholder="Seacrh address here" name="business_physical_address">
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" id="business-postal-address" value="business-postal-address" checked name="business_postal_address_checkbox">
                                    <label class="form-check-label" for="business-postal-address">
                                      Postal Address is the same as Physical Address
                                    </label>
                                </div>
                            </div>
                        </div> 
                        <div class="business-postal-address box">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Postal Address</label>
                                    <div class="input-group">
                                        <div class="input-group-text search-address-icon">
                                            <i class="mdi mdi-map-marker-circle"></i>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Seacrh address here" name="business_postal_address">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra_js')
<script>
    $(document).ready(function(){
        $('#postal-address').click(function(){
            var inputValue = $(this).attr("value");
            $("." + inputValue).toggle();
        });
        $('#business-postal-address').click(function(){
            var inputValue = $(this).attr("value");
            $("." + inputValue).toggle();
        });
        $('#contact-name').click(function(){
            var inputValue = $(this).attr("value");
            $("." + inputValue).toggle();
        });
        $('input[name="client_type"]').click(function(){
            var inputValue = $(this).attr("value");
            var targetBox = $("." + inputValue);
            $(".box").not(targetBox).hide();
            $(targetBox).show();
        });
    });
</script>
@endsection