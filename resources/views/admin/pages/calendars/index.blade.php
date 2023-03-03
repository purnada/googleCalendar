@extends('admin.layouts.main')

@section('title')
  {{ Str::headline(request()->segment(2)) }}
@stop
@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <div class="float-end btn-group">
                <a  href="{{ route('admin.calendars.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Create {{ Str::headline(request()->segment(2)) }}</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="calendars" class="table table-sm table-head-fixed text-nowrap">
                <thead>
                <tr>
                <th>S.N.</th>
                  <th>Title</th>
                  <th>Event Start Date</th>
                  <th>Event End Date</th>
                  <th>Action</th>
                </tr>
                <tr>
                <th></th>

                    <th>
                      <input type="text" id="title" value="{{ request('title') }}" class="form-control form-control-sm" placeholder="Name">
                    </th>
                    <th></th>
                    <th> <button type="button" class="btn btn-sm btn-success" onclick="filterData()"><i class="fa fa-filter"></i> Filter </button> </th>


                </tr>
                </thead>
                <tbody>
                  @forelse($calendars as $key => $calendar)
                  <tr id="row_{{$key}}">
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $calendar->summary }}</td>
                    <td>{{ \Illuminate\Support\Carbon::parse($calendar->start->dateTime)->format('Y-m-d H:i') }}</td>
                    <td>{{ \Illuminate\Support\Carbon::parse($calendar->end->dateTime)->format('Y-m-d H:i') }}</td>
                    <td>

                          <div class="btn-group">
                              <a href="{{ route('admin.calendars.edit', $calendar->id) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                              <button  type="button"  onclick="confirmDelete('{{ route('admin.calendars.destroy', $calendar->id) }}', {{$key}},'{{csrf_token()}}')" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-times"></i></button>
                          </div>

                    </td>
                  </tr>

                  @empty
                      <td colspan="3">No Record found</td>
                  @endforelse
                </tbody>
              </table>

            </div>
            <!-- /.card-body -->

          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('assets/js/ajax-delete.js')}}"></script>
    <script>

            function filterData()
            {
                var url = '{{ request()->url() }}'+ '?';
                var title = $('#title').val();


                url += filterNullable('title',title);

                location = url;
            }

            function filterNullable(key,value)
            {
              if(value != '') {
                return '&'+ key+ '='+value;
              }

              return '';
            }
        </script>
@endsection
