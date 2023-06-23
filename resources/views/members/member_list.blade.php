@extends('layouts.app')
@section('content')
    @if(Session::has('message'))
        <x-alert-dismiss type="{{ Session::get('type') }}" message="{{ Session::get('message') }}"></x-alert-dismiss>
    @endif
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <h3>Member List</h3>
            </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Photo</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Join Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $member)
                      <tr>
                        <td>
                            <img src="{{ asset($member->image) }}" class="img-responsive rounded" alt="">
                        </td>
                        <td>1234</td>
                        <td>{{ $member->name ?? "" }}</td>
                        <td>{{ $member->email ?? "" }}</td>
                        <td>{{ $member->mobile ?? "" }}</td>
                        <td>{{ $member->created_at ?? "" }}</td>
                          <td>

                          </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection
