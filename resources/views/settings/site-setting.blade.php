@extends('layouts.app')
@section('content')
    <div class="row page-breadcrumb">
        <div class="col-md-12">
            @if(Session::has('message'))
                <x-alert-dismiss type="{{ Session::get('type') }}" message="{{ Session::get('message') }}"></x-alert-dismiss>
            @endif
        </div>
        <div class="col-md-6">
            <div class="page-title float-left">
                <h3>Website Setting</h3>
            </div>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('update-website-settings') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Site Title</label> {!! starSign() !!}
                                    <input type="text" name="site_title" value="{{ siteSetting()['site_title'] ?? '' }}" class="form-control" placeholder="Site Title" required>
                                    @error('site_title')
                                        <x-validation-error message="{{ $message }}"></x-validation-error>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Site Slogan</label> {!! starSign() !!}
                                    <input type="text" name="site_slogan" value="{{ siteSetting()['site_slogan'] ?? '' }}" class="form-control" placeholder="Site Slogan" required>
                                    @error('site_slogan')
                                        <x-validation-error message="{{ $message }}"></x-validation-error>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Banner Image (780px X 646px, 1MB)</label>
                                    <input type="file" name="banner_image" class="form-control">
                                    @error('banner_image')
                                        <x-validation-error message="{{ $message }}"></x-validation-error>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Phone</label> {!! starSign() !!}
                                    <input type="text" name="phone" value="{{ siteSetting()['phone'] ?? '' }}" class="form-control" placeholder="Phone" required>
                                    @error('phone')
                                        <x-validation-error message="{{ $message }}"></x-validation-error>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Email</label> {!! starSign() !!}
                                    <input type="text" name="email" value="{{ siteSetting()['email'] ?? '' }}" class="form-control" placeholder="Email" required>
                                    @error('email')
                                        <x-validation-error message="{{ $message }}"></x-validation-error>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Address</label> {!! starSign() !!}
                                    <input type="text" name="address" value="{{ siteSetting()['address'] ?? '' }}" class="form-control" placeholder="Address" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Facebook Link</label>
                                    <input type="text" name="facebook_link" value="{{ siteSetting()['facebook_link'] ?? '' }}" class="form-control" placeholder="Facebook Link" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Youtube Link</label>
                                    <input type="text" name="youtube_link" value="{{ siteSetting()['youtube_link'] ?? '' }}" class="form-control" placeholder="Youtube Link" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Linkedin Link</label>
                                    <input type="text" name="linkedin_link" value="{{ siteSetting()['linkedin_link'] ?? '' }}" class="form-control" placeholder="Linkedin Link" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Google Map URL</label>
                                    <input type="text" name="google_map_url" value="{{ siteSetting()['google_map_url'] ?? '' }}" class="form-control" placeholder="Google Map URL" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">About Us</label>
                                    <textarea name="about_us" id="about_us" cols="30" rows="10">{{ siteSetting()['about_us'] }}</textarea>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Privacy Policy</label>
                                    <textarea name="privacy_policy" id="privacy_policy" cols="30" rows="10">{{ siteSetting()['privacy_policy'] ?? '' }}</textarea>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Our Mission</label>
                                </div>
                                <table class="table table-bordered table-sm text-nowrap mission-table" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="90%">Mission {!! starSign() !!}</th>
                                            <th width="10%" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty(siteSetting()['mission']))
                                            @foreach(siteSetting()['mission'] as $mission)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="mission[]" value="{{ $mission }}" class="form-control" placeholder="Mission" required>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0)" class="btn btn-danger btn-xs delete-mission"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <a href="javascript:void(0)" class="btn btn-info btn-xs mt-1 add-mission">
                                    <i class="fa fa-plus-circle"></i>
                                </a>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
         CKEDITOR.replace( 'about_us', {

             removePlugins: ['info'],
        });
         CKEDITOR.replace( 'privacy_policy', {

             removePlugins: ['info'],
        });
        $(document).on('click','.add-mission',function() {
            let mission_input = `<tr>
                <td>
                    <input type="text" name="mission[]" class="form-control" placeholder="Mission" required>
                </td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-danger btn-xs delete-mission"><i class="fa fa-trash"></i></a>
                </td>
            </tr>`;
           $(".mission-table").find("tbody").append(mission_input);
        });

        $(document).on('click','.delete-mission',function(e) {
            e.preventDefault();
           let event = this;
            $(event).parent().parent().remove();
        });
    </script>
@endpush
