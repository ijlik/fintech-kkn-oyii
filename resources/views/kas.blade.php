@extends('layouts.app')

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Riwayat Kas</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Daftar Riwayat Kas Anda
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
<!--                                             <th>Jam</th> -->
                                            @if(Auth::user()->id == 1)
                                            <th>Nama</th>
                                            @endif
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kas as $data)
                                        <tr class="{{ ($data->status == 'lunas') ? 'odd gradeX' : 'danger' }}">
                                            <td>{{ $data->created_at->format('l, j F Y') }}</td>
<!--                                             <td>{{ $data->created_at->toTimeString() }}</td> -->
                                            @if(Auth::user()->id == 1)
                                            <td>{{ App\User::find($data->id_user)->name }}</td> 
                                            @endif
                                            <td class="center">{{ $data->status }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="well">
                                @if(Auth::user()->id != 1)
                                  <h4>Total Uang kas anda ini : Rp. {{ $kas->count() * 3000 }}</h4><br>
                                  <h4>Tagihan kas anda ini : Rp. {{ App\Kasir::where('id_user','=',Auth::user()->id)->where('status','=','belum')->get()->count() * 3000 }}</h4>            
                                @else
                                <h4>Total Uang kas : Rp. {{ $kas->count() * 3000 }}</h4><br>
                                <h4>Tagihan kas : Rp. {{ App\Kasir::where('status','=','belum')->get()->count() * 3000 }}</h4>
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