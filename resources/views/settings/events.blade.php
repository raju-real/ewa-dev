@extends('layouts.app')
@push('css')
    <style>
        .table td img {
              width: 250px;
              height: 200px;
              border-radius: 0%;
            }
    </style>
@endpush
@section('content')
    <div class="row page-breadcrumb">
        <div class="col-md-12">
            @if(Session::has('message'))
                <x-alert-dismiss type="{{ Session::get('type') }}" message="{{ Session::get('message') }}"></x-alert-dismiss>
            @endif
        </div>
        <div class="col-md-6">
            <div class="page-title float-left">
                <h3>Events</h3>
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
                        <h5 class="modal-title" id="exampleModalLabel">Add New Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <form action="{{ route("events.store") }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                            @csrf
                          <div class="modal-body">
                              <div class="form-group">
                                  <label for="">Title</label> {!! starSign() !!}
                                  <input type="text" name="title" class="form-control max-length-input"  maxlength="100" placeholder="Title" required>
                              </div>
                              <div class="form-group">
                                  <label for="">Event Date</label> {!! starSign() !!}
                                  <input type="text" name="event_date" class="form-control date-picker" placeholder="Event Date" readonly required>
                              </div>
                              <div class="form-group">
                                  <label for="">Images(Choose Multiple)</label>
                                  <input type="file" name="images[]" class="form-control" multiple>
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
                                    <th class="w-2">SN</th>
                                    <th class="w-50">Title</th>
                                    <th class="w-20">Date</th>
                                    <th class="w-20">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $data)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $data->title ?? "" }}</td>
                                        <td>{{ date('d-m-Y',strtotime($data->event_date)) ?? "N/A" }}</td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-info btn-xs btn-icon-text" data-toggle="modal" data-target="#eventData-{{ $data->id }}">
                                              <i class="fa fa-eye"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="eventData-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Event Photos</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <div class="owl-carousel owl-theme owl-mouse-wheel">
                                                        @if($data->images != null && count(explode(',',$data->images)))
                                                            @foreach(explode(',',$data->images) as $image)
                                                                <div class="item">
                                                                    <img  src="{{ asset($image) }}" alt="item-image" class="img-responsive" >
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>


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
                                                    <form action="{{ route("events.update",$data->id) }}" method="POST" class="needs-validation" novalidate>
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
                                                <form id="delete-designation-{{ $data->id }}" action="{{ route('events.destroy',$data->id) }}"  method="POST">
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
