@extends('layouts.app')

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Absen Kehadiran</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Pilih Absensi
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            @if(!is_null($messages))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> Absensi diterima.
                            </div>
                            @endif
                            <div class="well">
                                <h4>Tanggal : {{ Carbon\Carbon::now()->format('l, j F Y') }}</h4>
                            </div>
                            <?php if(Carbon\Carbon::now()->toTimeString() < "07:00:00") { ?>
                            <div class="well">
                                <h4>Kalem Lurr!! Belum waktunya absen</h4>
                            </div>
                          <?php } else { ?>
                            <?php if(App\Absen::where('id_user','=',Auth::user()->id)->whereDate('created_at','=',Carbon\Carbon::now()->toDateString())->get()->count() == 0 ) { ?>
                            <form action="/absen" method="POST">
                              {{ csrf_field() }}
                              <div class="form-group">
                                <label for="exampleFormControlSelect1">Silahkan Pilih</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="is_absen">
                                  <option value="1">Hadir</option>
                                  <option value="0">Tidak Hadir</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="exampleFormControlTextarea1">Keterangan (jika anda Tidak Hadir)</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="keterangan">&nbsp;</textarea>
                              </div>
                              <button type="submit" class="btn btn-primary">
                                Submit
                              </button>
                            </form>
                            <?php } else {?>
                            <div class="well">
                                <h4>Anda sudah absen hari ini</h4>
                            </div>
                          <?php } } ?>
                          
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
