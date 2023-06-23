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
                <h3>Designations</h3>
            </div>
        </div>
        <div class="col-md-6">
            <div class="page-action float-right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addData">
                  <i class="fa fa-plus-circle"></i>
                    Add New
                </button>
                <!-- Modal -->
                <div class="modal fade" id="addData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Designation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <form action="{{ route("designations.store") }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                          <div class="modal-body">
                              <div class="form-group">
                                  <label for="">Title</label> {!! starSign() !!}
                                  <input type="text" name="title" class="form-control max-length-input"  maxlength="100" placeholder="Title" required>
                              </div>
                              <div class="form-group">
                                  <label for="">Description</label>
                                  <textarea name="description" class="form-control maxlength-textarea" maxlength="200" cols="30" rows="5" placeholder="Description"></textarea>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        @if(count($results))
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Created By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $data)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ strLimit($data->title) ?? "" }}</td>
                                        <td>{{ strLimit($data->description) ?? "N/A" }}</td>
                                        <td>{{ userNameById($data->created_by) }}</td>
                                        <td>

                                             <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-xs btn-icon-text" data-toggle="modal" data-target="#editData-{{ $data->id }}">
                                              <i class="fa fa-edit"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editData-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Designation</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                    <form action="{{ route("designations.update",$data->id) }}" method="POST" class="needs-validation" novalidate>
                                                        @csrf
                                                        @method('PUT')
                                                      <div class="modal-body">
                                                          <div class="form-group">
                                                              <label for="">Title</label> {!! starSign() !!}
                                                              <input type="text" name="title" class="form-control max-length-input" value="{{ $data->title ?? '' }}" maxlength="100" placeholder="Title" required>
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="">Description</label>
                                                              <textarea name="description" class="form-control maxlength-textarea" maxlength="200" cols="30" rows="5" placeholder="Description">{{ $data->description }}</textarea>
                                                          </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                      </div>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                            <a href="javascript:void(0)" data-id="{{ 'delete-designation-'.$data->id }}" class="delete-data btn btn-danger btn-xs btn-icon-text" >
                                                <form id="delete-designation-{{ $data->id }}" action="{{ route('designations.destroy',$data->id) }}"  method="POST">
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
                        @else
                            <x-alert-danger message="No Data Found!"></x-alert-danger>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
