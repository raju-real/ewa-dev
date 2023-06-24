@extends('layouts.app')
@section('content')
<div class="profile-page tx-13">
    <div class="row">
        <div class="col-12 grid-margin">
            @if(Session::has('message'))
                <x-alert-dismiss type="{{ Session::get('type') }}" message="{{ Session::get('message') }}"></x-alert-dismiss>
            @endif
            <div class="profile-header">
                <div class="cover">
                    <div class="gray-shade"></div>
                    <input type="hidden" id="member-id" value="{{ $user->member_id != Auth::user()->member_id ? $user->member_id : 0 }}">
                    <figure>
                        <img src="{{ $user->cover_photo != Null ? asset($user->cover_photo) : 'https://via.placeholder.com/1148x272' }}" height="272" width="100%" class="img-fluid" alt="profile cover">
                    </figure>
                    <div class="cover-body d-flex justify-content-between align-items-center">
                        <div>
                            <img class="profile-pic" src="{{ asset($user->image ?? 'assets/images/avatar.jpg') }}" alt="profile">
                            <span class="profile-name">
                                {{ $user->name ?? "User" }} <br>
                                <small>{{ $user->engineer_type->title ?? '' }}</small>
                            </span>
                        </div>
                        @if($user->id == \Illuminate\Support\Facades\Auth::user()->id)
                            <div class="d-none d-md-block">
                                <a href="{{ route('edit-profile') }}" class="btn btn-primary btn-icon-text btn-edit-profile">
                                    <i data-feather="edit" class="btn-icon-prepend"></i> Edit profile
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row profile-body">
        <!-- left wrapper start -->
        <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="card-title mb-0">About</h6>
                    </div>
                    <p>{{ $user->about_me ?? '' }}</p>
                    <div class="mt-3">
                        <label class="tx-11 font-weight-bold mb-0 text-uppercase">Joined:</label>
                        <p class="text-muted">{{ date('M d, Y',strtotime($user->created_at)) }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 font-weight-bold mb-0 text-uppercase">Email:</label>
                        <p class="text-muted">{{ $user->email ?? '' }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 font-weight-bold mb-0 text-uppercase">Lives:</label>
                        <p class="text-muted">{{ $user->present_address ?? '' }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 font-weight-bold mb-0 text-uppercase">Profession:</label>
                        <p class="text-muted">{{ $user->profession ?? '' }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 font-weight-bold mb-0 text-uppercase">Profession Details:</label>
                        <p class="text-muted">{{ $user->profession_details ?? '' }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 font-weight-bold mb-0 text-uppercase">Present Company:</label>
                        <p class="text-muted">{{ $user->present_company ?? '' }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 font-weight-bold mb-0 text-uppercase">Present Designation:</label>
                        <p class="text-muted">{{ $user->present_designation ?? '' }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 font-weight-bold mb-0 text-uppercase">Blood Group:</label>
                        <p class="text-muted">{{ $user->blood_group ?? '' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- left wrapper end -->
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-6 middle-wrapper">
            <div class="row">
                <div class="col-md-12" id="post-submit-div">
                    <div class="card rounded">
                        <div class="card-body">
                            <form action="{{ route('submit-post') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <textarea name="post_content" id="post_content" cols="30" rows="10" class="form-control" placeholder="What's on your mind ?"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="files[]" accept="image/*,.pdf" multiple class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- middle wrapper end -->
        <!-- right wrapper start -->
        <div class="d-none d-xl-block col-xl-3 right-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card rounded">
                        <div class="card-body">
                            <h6 class="card-title">Members</h6>
                            <input type="text" class="form-control member-list" placeholder="Search by name">
                            <br>
                            @foreach($members as $member)
                            <div class="d-flex justify-content-between mb-2 pb-2 border-bottom member-list-item d-none">
                                <div class="d-flex align-items-center hover-pointer">
                                    <img class="img-xs rounded-circle" src="{{ asset($member->image ?? 'https://via.placeholder.com/37x37') }}" alt="">
                                    <div class="ml-2">
                                        <p>
                                            <a class="member-name match-bold" href="{{ route('profile',['member' => $member->member_id]) }}">{{ $member->name ?? '' }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- right wrapper end -->
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('assets/backend/custom/js/post_profile.js') }}"></script>
@endpush
