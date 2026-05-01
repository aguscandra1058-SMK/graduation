@extends('layouts.admin')

@section('header', 'Daftar Siswa')

@section('css')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="card">
              <div class="card-header">
                <a href="{{ url('students/create') }}" class="btn btn-primary">Tambah Siswa</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped">
                  <thead class="text-center">
                  <tr>
                    <th width="4%">No.</th>
                    <th>NIS</th>
                    <th>NISN</th>
                    <th>Nama Siswa</th>
                    <th>Gender</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                  </thead>
                  <tbody>
                    @foreach ($students as $key => $student)
                    <tr>
                        <td>{{ $key + 1 }}.</td>
                        <td>{{ $student->nis }}</td>
                        <td>{{ $student->nisn }}</td>
                        <td>{{ $student->name }}</td>
                        <td>
                            @if ($student->gender == 'L')
                                Laki-laki
                            @else
                                Perempuan
                            @endif
                        </td>
                        <td>{{ $student->classroom->name }}</td>
                        <td>{{ $student->major->name }}</td>
                        <td class="text-center">
                            @if ($student->status == 1)
                                <span class="badge badge-success">Lulus</span>
                            @else
                                <span class="badge badge-danger">Tidak Lulus</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ url('students/'.$student->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                            @role('admin')
                            <form action="{{ url('students/' . $student->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">Hapus</button>
                            </form>
                            @endrole
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
@endsection


@section('js')
    <!-- DataTables  & Plugins -->
  <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <script>
  $(function () {
    $("#datatable").DataTable({
    });
  });
</script>
@endsection