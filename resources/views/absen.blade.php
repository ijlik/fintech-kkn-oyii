@extends('layouts.app')

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Riwayat Kehadiran</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Daftar Riwayat Kehadiran Anda
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            @if(Auth::user()->id == 1)
                                            <th>Nama</th>
                                            @endif
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($absen as $data)
                                        <tr class="{{ ($data->is_absen == 1) ? 'odd gradeX' : 'danger' }}">
                                            <td>{{ $data->created_at->format('l, j F Y') }}</td>
                                            <td>{{ $data->created_at->toTimeString() }}</td>
                                            @if(Auth::user()->id == 1)
                                            <td>{{ App\User::find($data->id_user)->name }}</td> 
                                            @endif
                                            <td>{{ ($data->is_absen == 1) ? 'Hadir' : 'Tidak Hadir' }}</td>
                                            <td class="center">{{ $data->keterangan }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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