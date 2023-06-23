@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if(Session::has('message'))
                <x-alert-dismiss type="{{ Session::get('type') }}" message="{{ Session::get('message') }}"></x-alert-dismiss>
                @endif
                <form class="cmxform needs-validation" novalidate id="signupForm" method="POST" action="{{ route('update-profile') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">

                            <fieldset>
                                 <div class="form-group">
                                    <label for="">You Are</label>
                                    <select name="engineer_type_id" class="form-select">
                                        <option value="">Select</option>
                                        @foreach(App\Models\EngineerType::orderBy('title','asc')->get() as $type)
                                            <option value="{{ $type->id }}">{{ $type->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label> {!! starSign() !!}
                                    <input type="text" name="name" value="{{ old('name') ?? $user->name ?? '' }}" autocomplete="off" class="form-control max-length-input @error('name') is-invalid @enderror" maxlength="50" placeholder="Name" id="name" required>
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Mobile</label> {!! starSign() !!}
                                    <input type="text" name="mobile" value="{{ old('mobile') ?? $user->mobile ?? '' }}" autocomplete="off" class="form-control max-length-input @error('mobile') is-invalid @enderror" maxlength="11" placeholder="Mobile" id="mobile" required>
                                    @error('mobile')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Email</label> {!! starSign() !!}
                                    <input type="text" name="email" value="{{ old('email') ?? $user->email ?? '' }}" autocomplete="off" class="form-control max-length-input @error('email') is-invalid @enderror" maxlength="50" placeholder="Email" id="email" required>
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="national_id">National ID</label>
                                    <input id="national_id" value="{{ $user->national_id ?? '' }}" class="form-control max-length-input" maxlength="20" name="national_id" type="text" placeholder="National ID">
                                </div>
                                <div class="form-group">
                                    <label for="date_of_birth">Date Of Birth</label>
                                    <input name="date_of_birth" value="{{ old('date_of_birth') ?? $user->date_of_birth ?? '' }}" class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" placeholder="Date Of Birth"/>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="gender" class="form-select">
                                        <option value="">Select Gender</option>
                                        <option value="Male" {{ isset($user->gender) && $user->gender == "Male" ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ isset($user->gender) && $user->gender == "Female" ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="blood_group">Blood Group</label>
                                    <select name="blood_group" id="blood_group" class="form-select">
                                        <option value="">Blood Group</option>
                                        @foreach(bloodGroups() as $blood_group)
                                        <option value="{{ $blood_group }}" {{ isset($user->blood_group) && $user->blood_group == $blood_group ? 'selected' : '' }}>{{ $blood_group }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="present_address">Present Address</label>
                                    <textarea name="present_address" class="form-control max-length-input" maxlength="255" id="present_address" cols="30" rows="2" placeholder="Present Address">{{ old('present_address') ?? $user->present_address ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Profile Photo</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-6">
                            <fieldset>

                                <div class="form-group">
                                    <label for="father_name">Father Name</label>
                                    <input type="text" name="father_name" value="{{ old('father_name') ?? $user->father_name ?? '' }}" placeholder="Father Name" class="form-control max-length-input" maxlength="50" id="father_name" >
                                </div>
                                <div class="form-group">
                                    <label for="mother_name">Mother Name</label>
                                    <input type="text" name="mother_name" value="{{ old('mother_name') ?? $user->mother_name ?? '' }}" placeholder="Mother Name" class="form-control max-length-input" maxlength="50" id="mother_name" >
                                </div>

                                <div class="form-group">
                                    <label for="profession">Profession</label>
                                    <input type="text" name="profession" value="{{ old('profession') ?? $user->profession ?? '' }}" placeholder="Profession" class="form-control max-length-input" maxlength="50" id="profession" >
                                </div>

                                <div class="form-group">
                                    <label for="present_company">Present Company Name</label>
                                    <input type="text" name="present_company" value="{{ old('present_company') ?? $user->present_company ?? '' }}" placeholder="Present Company Name" class="form-control max-length-input" maxlength="50" id="present_company" >
                                </div>
                                <div class="form-group">
                                    <label for="present_designation">Present Designation</label>
                                    <input type="text" name="present_designation" value="{{ old('present_designation') ?? $user->present_designation ?? '' }}" placeholder="Present Designation" class="form-control max-length-input" maxlength="50" id="present_designation" >
                                </div>
                                <div class="form-group">
                                    <label for="profession_details">Profession Details</label>
                                    <textarea name="profession_details" class="form-control max-length-input" maxlength="255" id="profession_details" cols="30" rows="2" placeholder="Profession Details">{{ old('profession_details') ?? $user->profession_details ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="about_me">About Me</label>
                                    <textarea name="about_me" class="form-control max-length-input" maxlength="500" id="about_me" cols="30" rows="6" placeholder="About Me">{{ old('about_me') ?? $user->about_me ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="permanent_address">Permanent Address</label>
                                    <textarea name="permanent_address" class="form-control max-length-input" maxlength="255" id="permanent_address" cols="30" rows="2" placeholder="Permanent Address">{{ old('permanent_address') ?? $user->permanent_address ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Cover Photo</label>
                                    <input type="file" name="cover_photo" class="form-control">
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="extracurricular_activities">Extra Curricular Activities</label>
                                <table class="table" id="extra-curricular-activities-table">
                                    <tbody>
                                        @if($user->extracurricular_activities != Null && count(json_decode($user->extracurricular_activities)))
                                            @foreach(json_decode($user->extracurricular_activities) as $activity)
                                                <tr>
                                                    <td style="width: 95%">
                                                        <input type="text" value="{{ $activity }}" name="extracurricular_activities[]" class="form-control" placeholder="Extra Curricular Activities" required>
                                                    </td>
                                                    <td style="width: 5%">
                                                        <button type="button" class="btn btn-md btn-danger text-right remove-extra-curricular-activity" >
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <button type="button" id="add-extra-curricular-activity" class="btn btn-info btn-sm">
                                    <i class="fa fa-plus-circle"></i>Add More Activity
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="hobbies_and_interest">Hobbies and Interests</label>
                                <table class="table" id="hobbies-and-interests-table">
                                    <tbody>
                                        @if($user->hobbies_and_interest != Null && count(json_decode($user->hobbies_and_interest)))
                                            @foreach(json_decode($user->hobbies_and_interest) as $hobby)
                                                <tr>
                                                    <td style="width: 95%">
                                                        <input type="text" value="{{ $hobby }}" name="hobbies_and_interest[]" class="form-control" placeholder="Hobbies and Interests" required>
                                                    </td>
                                                    <td style="width: 5%">
                                                        <button type="button" class="btn btn-md btn-danger text-right  remove-hobbies-and-interests" >
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <button type="button" id="add-hobbies-and-interests" class="btn btn-info btn-sm">
                                    <i class="fa fa-plus-circle"></i>Add More Hobbies/Interests
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <div class="form-group">
                                <label for="hobbies_and_interest">Academic Information</label>
                                <hr>
                                <table class="table" id="academic-table">
                                    <thead>
                                        <tr>
                                            <th width="20%">Title {!! starSign() !!}</th>
                                            <th width="50%">Institute {!! starSign() !!}</th>
                                            <th width="10%">Passing Year {!! starSign() !!}</th>
                                            <th width="10%">Division/Grade {!! starSign() !!}</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($user->educations))
                                            @foreach($user->educations as $education)
                                                <tr>
                                                    <td>
                                                        <input type="text" value="{{ $education->degree_title ?? '' }}" name="degree_title[]" class="form-control" placeholder="Degree Title" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" value="{{ $education->institute ?? '' }}" name="institute[]" class="form-control" placeholder="Institute" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" value="{{ $education->passing_year ?? '' }}" name="passing_year[]" class="form-control" placeholder="Passing Year" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" value="{{ $education->division_grade ?? '' }}" name="division_grade[]" class="form-control" placeholder="Division/Grade" required>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-md btn-danger text-right remove-academic">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <button type="button" id="add-academic" class="btn btn-info btn-sm mt-3 ml-2">
                                    <i class="fa fa-plus-circle"></i> Add More
                                </button>
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary btn-lg pull-right">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        $(document).on('click','#add-extra-curricular-activity',function(e) {
            e.preventDefault();
            let input_div = `<tr>
                <td style="width: 95%">
                    <input type="text" name="extracurricular_activities[]" class="form-control" placeholder="Extra Curricular Activities" required>
                </td>
                <td style="width: 5%">
                    <button type="button" class="btn btn-md btn-danger text-right remove-extra-curricular-activity" >
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>`;
            $('#extra-curricular-activities-table').find('tbody').append(input_div);
        });

        $(document).on('click', '.remove-extra-curricular-activity', function(){
            let event = this;
            $(event).parent().parent().remove();
        });

        $(document).on('click','#add-hobbies-and-interests',function(e) {
            e.preventDefault();
            let input_div = `<tr>
                <td style="width: 95%">
                    <input type="text" name="hobbies_and_interest[]" class="form-control" placeholder="Hobbies and Interests" required>
                </td>
                <td style="width: 5%">
                    <button type="button" class="btn btn-md btn-danger text-right remove-hobbies-and-interests">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>`;
            $('#hobbies-and-interests-table').find('tbody').append(input_div);
        });

        $(document).on('click', '.remove-hobbies-and-interests', function(){
            let event = this;
            $(event).parent().parent().remove();
        });

        $(document).on('click','#add-academic',function(e) {
            e.preventDefault();
            let input_div = `<tr>
                <td>
                    <input type="text" name="degree_title[]" class="form-control" placeholder="Degree Title" required>
                </td>
                <td>
                    <input type="text" name="institute[]" class="form-control" placeholder="Institute" required>
                </td>
                <td>
                    <input type="text" name="passing_year[]" class="form-control" placeholder="Passing Year" required>
                </td>
                <td>
                    <input type="text" name="division_grade[]" class="form-control" placeholder="Division/Grade" required>
                </td>
                <td>
                    <button type="button" class="btn btn-md btn-danger text-right remove-academic">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>`;
            $('#academic-table').find('tbody').append(input_div);
        });

        $(document).on('click', '.remove-academic', function(){
            let event = this;
            $(event).parent().parent().remove();
        });
    </script>
@endpush
