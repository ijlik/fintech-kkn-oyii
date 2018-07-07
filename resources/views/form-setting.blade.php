@extends('layouts.app')

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Reset Password</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Reset Password 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            @if(!is_null($messages))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> Password berhasil direset.
                            </div>
                            @endif
                            <div class="well">
                                <h4>Tanggal : {{ Carbon\Carbon::now()->format('l, j F Y') }}</h4>
                            </div>
                            <?php if(App\Absen::where('id_user','=',Auth::user()->id)->whereDate('created_at','=',Carbon\Carbon::now()->toDateString())->get()->count() == 0 ) { ?>
                            <form action="/setting-user" method="POST">
                              {{ csrf_field() }}
                              <div class="form-group">
                                <label for="exampleFormControlSelect1">Silahkan Pilih Mahasiswa</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="id_user">
                                  @foreach($mahasiswa as $data)
                                  <option value="{{ $data->id }}">{{ $data->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <button type="submit" class="btn btn-primary">
                                Reset Password
                              </button>
                            </form>
                            <?php } else { ?>
                            <div class="well">
                                <h4>Anda sudah absen hari ini</h4>
                            </div>
                          <?php } ?>
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
