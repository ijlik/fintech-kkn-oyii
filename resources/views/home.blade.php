@extends('layouts.app')

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @if(Auth::user()->is_ganti == 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Silahkan ganti Password anda terlebih dahulu 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form action="/ganti-password" method="POST">
                              {{ csrf_field() }}
                              <div class="form-group">
                                <input class="form-control" type="password" name="password" id="example-number-input" minlength="6" placeholder="Password" required>
                              </div>
                              <button type="submit" class="btn btn-primary">
                                Submit
                              </button>
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @endif
  
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                          @if(!is_null($messages))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> Password diperbarui.
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-coffee fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{ \App\Makan::where('id_user','=',Auth::user()->id)->get()->count() }}</div>
                                    <div>Makan</div>
                                </div>
                            </div>
                        </div>
                        <a href="/riwayat-makan">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
              <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{ \App\Kasir::where('id_user','=',Auth::user()->id)->get()->count() }}</div>
                                    <div>Kas</div>
                                </div>
                            </div>
                        </div>
                        <a href="/kas">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-child fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{ \App\Absen::where('id_user','=',Auth::user()->id)->get()->count() }}</div>
                                    <div>Kehadiran</div>
                                </div>
                            </div>
                        </div>
                        <a href="/riwayat-absen">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
@endsection
