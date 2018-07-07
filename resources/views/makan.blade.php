@extends('layouts.app')

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Riwayat Makan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Daftar Riwayat Makan Anda
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Jadwal</th>
                                            @if(Auth::user()->id == 1)
                                            <th>Nama</th>
                                            @endif
                                            <th>Status Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($makan as $data)
                                        <tr class="{{ ($data->status == 'lunas') ? 'odd gradeX' : 'danger' }}">
                                            <td>{{ $data->created_at->format('l, j F Y') }}</td>
                                            <td>{{ $data->created_at->toTimeString() }}</td>
                                            <td>{{ $data->jadwal }}</td>
                                            @if(Auth::user()->id == 1)
                                            <td>{{ App\User::find($data->id_user)->name }}</td> 
                                            @endif
                                            <td class="center">{{ $data->status }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            <div class="well">
                                
                                @if(Auth::user()->id != 1)
                                <h4>Total Uang makan anda ini : Rp. {{ $makan->count() * 7000 }}</h4><br>
                                <h4>Tagihan makan anda ini : Rp. {{ App\Makan::where('id_user','=',Auth::user()->id)->where('status','=','belum')->get()->count() * 7000 }}</h4>
                                @else
                                <h4>Total Uang makan : Rp. {{ $makan->count() * 7000 }}</h4><br>
                                <h4>Tagihan makan : Rp. {{ App\Makan::where('status','=','belum')->get()->count() * 7000 }}</h4>
                                @endif
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