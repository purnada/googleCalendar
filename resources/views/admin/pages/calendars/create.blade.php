@extends('admin.layouts.main')
@section('title')
	Create {{ Str::headline(request()->segment(2)) }}
@stop
@section('content')

		<div class="card card-default mt-2">
		  <div class="card-header">
		    <h3 class="card-title">New {{ Str::headline(request()->segment(2)) }}</h3>
		  </div>
		  <!-- /.card-header -->
		  <!-- form start -->
		  <div class="card-body">
		      <form method="POST" action="{{ route('admin.calendars.store') }}">
		          @csrf

		          <div class="form-group row">
		              <label for="name" class="required col-sm-3 col-form-label">Event Title</label>

		              <div class="col-sm-9">
		                  <input id="title" type="text" class="form-control form-control-sm @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">

		                  @error('title')
		                      <span class="invalid-feedback" role="alert">
		                          <strong>{{ $message }}</strong>
		                      </span>
		                  @enderror
		              </div>
		          </div>

                  <div class="form-group row">
                      <label for="name" class="required col-sm-3 col-form-label">Event Location</label>

                      <div class="col-sm-9">
                          <input id="location" type="text" class="form-control form-control-sm @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" >

                          @error('location')
                          <span class="invalid-feedback" role="alert">
		                          <strong>{{ $message }}</strong>
		                      </span>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="start_date" class="required col-sm-3 col-form-label">Date</label>

                      <div class="col-sm-4">
                          <input id="start_date" type="text"
                                 class="form-control form-control-sm datepicker @error('start_date') is-invalid @enderror"
                                 name="start_date" value="{{ old('start_date') }}"  autocomplete="off" autofocus
                                 placeholder="Start Date">

                          @error('start_date')
                          <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                          @enderror
                      </div>
                      <div class="col-sm-4">
                          <input id="end_date" type="text"
                                 class="form-control form-control-sm datepicker @error('end_date') is-invalid @enderror"
                                 name="end_date" value="{{ old('end_date') }}" placeholder="End Date"
                                 autocomplete="off" autofocus>

                          @error('end_date')
                          <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                          @enderror
                      </div>
                  </div>

		          <div class="form-group row">
		              <label for="description" class="col-sm-3 col-form-label">Description</label>

		              <div class="col-sm-9">

		              	  <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
		                  @error('description')
		                      <span class="invalid-feedback" role="alert">
		                          <strong>{{ $message }}</strong>
		                      </span>
		                  @enderror
		              </div>
		          </div>




		          <div class="form-group row mb-0">
		              <div class="col-md-5 offset-md-3">
		                  <button type="submit" class="btn btn-sm btn-primary">
		                      Submit
		                  </button>
		              </div>
		          </div>
		      </form>
		  </div>

		</div>

@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-datetimepicker/datetimepicker.css') }}">

@stop
@section('scripts')
    <script src="{{ asset('assets/plugins/jquery-datetimepicker/datetimepicker.js') }}"></script>
    <script>
        $(function() {
            $(".datepicker").datetimepicker({
                format: 'Y-m-d H:i',
                changeMonth: true,
                changeYear: true,
            });
        })
    </script>

@stop
