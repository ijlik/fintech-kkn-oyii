@extends('layouts.app')

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="text-align: center;">Laporan Kehadiran</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Absensi
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Nama</th>
                                            <th>Fakultas</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($absen as $data)
                                        <tr class="{{ ($data->is_absen == 1) ? 'odd gradeX' : 'danger' }}">
                                            <td>{{ $data->created_at->format('l, j F Y') }}</td>
                                            <td>{{ $data->created_at->toTimeString() }}</td>
                                            <td>{{ App\User::find($data->id_user)->name }}</td>
                                            <td>{{ App\User::find($data->id_user)->fakultas }}</td>
                                            <td>{{ ($data->is_absen == 1) ? 'Hadir' : 'Tidak Hadir' }}</td>
                                            <td>{{ $data->keterangan }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="well">
                                <h4>Total Data : {{ $absen->count() }}</h4>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <!-- /.row -->
        </div>
@endsection