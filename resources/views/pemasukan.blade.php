@extends('layouts.app')

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Riwayat Pemasukan Dana</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Daftar Riwayat Pemasukan Dana
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Nama</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pemasukan as $data)
                                        <tr class="odd gradeX">
                                            <td>{{ $data->created_at->format('l, j F Y') }}</td>
                                            <td>{{ $data->created_at->toTimeString() }}</td>
                                            <td>{{ App\User::find($data->id_user)->name }}</td>
                                            <td class="center">{{ $data->jumlah }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            <div class="well">
                                <h4>Total dana terkumpul : {{ $pemasukan->sum('jumlah') }}</h4>
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