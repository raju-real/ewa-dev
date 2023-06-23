@extends('layouts.app')
@section('content')
    @if(Session::has('message'))
        <x-alert-dismiss type="{{ Session::get('type') }}" message="{{ Session::get('message') }}"></x-alert-dismiss>
    @endif
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <h3>Member Requests</h3>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>From Kaunia ?</th>
                        <th>Complete Graduation ?</th>
                        <th>Registration Time</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $member)
                      <tr>
                        <td>{{ $member->name ?? "" }}</td>
                        <td>{{ $member->email ?? "" }}</td>
                        <td>{{ $member->mobile ?? "" }}</td>
                        <td>{{ $member->from_kaunia ?? "" }}</td>
                        <td>{{ $member->complete_graduation ?? "" }}</td>
                        <td>{{ $member->created_at ?? "" }}</td>
                          <td>
                              <a href="{{ route('approve-request',$member->id) }}" class="btn btn-primary btn-sm">Approve</a>
                              <a href="javascript:void(0)" data-id="{{ 'delete-member-'.$member->id }}" class="delete-data btn btn-danger btn-xs btn-icon-text" >
                                  <form id="delete-member-{{ $member->id }}" action="{{ route('members.destroy',$member->id) }}"  method="POST">
                                      @csrf
                                      @method('DELETE')
                                  </form>
                                  <i class="fa fa-trash"></i>
                              </a>
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
