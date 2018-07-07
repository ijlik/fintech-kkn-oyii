<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Makan;
use App\Absen;
use App\User;
use App\Pemasukan;
use App\Kasir;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        return view('home',[
          'messages' => null
        ]);
    }
    public function formMakan()
    {
        return view('form-makan',[
          'messages' => null
        ]);
    }
    public function showMakan()
    {
      if(Auth::user()->id != 1){
          $data = Makan::where('id_user','=',Auth::user()->id)->get();
          return view('makan', [
            'makan' => $data
          ]);
      } else {
        $makan = Makan::all();
        return view('makan',[
          'makan' => $makan
        ]);
      }
    }
    public function createMakan(Request $request)
    {
        $makan = new Makan();
        $makan->id_user = Auth::user()->id;
        $makan->jadwal = $request->jadwal;
        $saldo = Pemasukan::where('id_user','=',Auth::user()->id)->sum('jumlah') - (Makan::where('id_user','=',Auth::user()->id)->where('status','=','lunas')->get()->count() * 7000);
        $status = '';
        if($saldo >= 7000){
          $status = 'lunas';
        } else {
          $status = 'belum';
        }
        $makan->status = $status;
        $makan->save();
        return view('form-makan',[
          'messages' => 'sukses'
        ]);
    }
    public function formAbsen()
    {
      return view('form-absen',[
          'messages' => null
        ]);
    }
    public function showAbsen()
    {
      if(Auth::user()->id != 1) {
        $data = Absen::where('id_user','=',Auth::user()->id)->get();
        return view('absen', [
          'absen' => $data
        ]);
      } else {
        $data = Absen::all();
        return view('absen', [
          'absen' => $data
        ]);
      }
    }
    public function createAbsen(Request $request)
    {
        $jam = Carbon::now()->toTimeString();
        if($jam <= "09:00:00" && $jam >= "07:00:00"){
            $absen = new Absen();
            $absen->id_user = Auth::user()->id;
            $absen->is_absen = $request->is_absen;
            $absen->keterangan = $request->keterangan;
            $absen->save();
            return view('form-absen',[
              'messages' => 'sukses'
            ]);
        } else {
            $absen = new Absen();
            $absen->id_user = Auth::user()->id;
            $absen->is_absen = $request->is_absen;
            $absen->keterangan = 'Telat Konfirmasi Absen, '.$request->keterangan;
            $absen->save();
            return view('form-absen',[
              'messages' => 'sukses'
            ]);
        }
    }
    public function formPemasukan(){
      $user = User::all();
      return view('form-pemasukan',[
        'mahasiswa' => $user,
        'messages' => null
      ]);
    }
    public function createPemasukan(Request $request)
    {
      $user = User::all();
      $pemasukan = new Pemasukan();
      $pemasukan->id_user = $request->id_user;
      $pemasukan->jumlah = $request->jumlah;
      $pemasukan->save();
      
      $status = '';
      $makan = Makan::where('id_user','=',$request->id_user)->where('status','=','belum')->get();
      $kas = Kasir::where('id_user','=',$request->id_user)->where('status','=','belum')->get();
      foreach($makan as $kadal){
        $saldo = Pemasukan::where('id_user','=',$request->id_user)->sum('jumlah') - (Makan::where('id_user','=',$request->id_user)->where('status','=','lunas')->get()->count() * 7000) - (Kasir::where('id_user','=',$request->id_user)->where('status','=','lunas')->get()->count() * 3000);
        if($saldo >= 7000){
            $kadal->status = 'lunas';
            $kadal->save();
        } else {
            break;
        }
      }
      foreach($kas as $kam){
        $sal = Pemasukan::where('id_user','=',$request->id_user)->sum('jumlah') - (Makan::where('id_user','=',$request->id_user)->where('status','=','lunas')->get()->count() * 7000) - (Kasir::where('id_user','=',$request->id_user)->where('status','=','lunas')->get()->count() * 3000);
        if($sal >= 3000){
            $kam->status = 'lunas';
            $kam->save();
        } else {
            break;
        }
      }
      
      return view('form-pemasukan',[
        'mahasiswa' => $user,
        'messages' => 'sukses'
      ]);
    }
  public function showPemasukan()
    {
      $data = Pemasukan::all();
      return view('pemasukan', [
        'pemasukan' => $data
      ]);
    }
  public function gantiPassword(Request $request)
  {
    $x = $request->validate([
      'password' => 'required|string|max:255|min:6',
    ]);
    
    $user = User::find(Auth::user()->id);
    $user->password = bcrypt($request->password);
    $user->is_ganti = 1;
    $user->save();
    
    return redirect()->back()->with([
          'messages' => 'sukses'
        ]);
  }
  public function showKas(){
    if(Auth::user()->id != 1){
        $hariini = Kasir::whereDate('created_at','=',Carbon::now()->toDateString())->where('id_user','=',Auth::user()->id)->first();
        if(is_null($hariini) && Auth::user()->id != 1){
          $saldo = Pemasukan::where('id_user','=',Auth::user()->id)->sum('jumlah') - (Makan::where('id_user','=',Auth::user()->id)->where('status','=','lunas')->get()->count() * 7000) - (Kasir::where('id_user','=',Auth::user()->id)->where('status','=','lunas')->get()->count() * 3000);
          $bayarkas = new Kasir();
          $bayarkas->id_user = Auth::user()->id;
          if($saldo >= 3000){
                $bayarkas->status = 'lunas';
            } else {
                $bayarkas->status = 'belum';
            }
          $bayarkas->save();
        }
        $kas = Kasir::where('id_user','=',Auth::user()->id)->get();
        return view('kas',[
          'kas' => $kas
        ]);
    } else {
        $user = User::all();
        foreach($user as $ini){
          $hariini = Kasir::whereDate('created_at','=',Carbon::now()->toDateString())->where('id_user','=',$ini->id)->first();
          if(is_null($hariini) && $ini->id != 1){
            $saldo = Pemasukan::where('id_user','=',$ini->id)->sum('jumlah') - (Makan::where('id_user','=',$ini->id)->where('status','=','lunas')->get()->count() * 7000) - (Kasir::where('id_user','=',$ini->id)->where('status','=','lunas')->get()->count() * 3000);
            $bayarkas = new Kasir();
            $bayarkas->id_user = $ini->id;
            if($saldo >= 3000){
                  $bayarkas->status = 'lunas';
              } else {
                  $bayarkas->status = 'belum';
              }
            $bayarkas->save();
          }
        }

        $kas = Kasir::all();
        return view('kas',[
          'kas' => $kas
        ]);
      }
  }
  public function reportKas(){
    $user = User::all();
    foreach($user as $ini){
      $hariini = Kasir::whereDate('created_at','=',Carbon::now()->toDateString())->where('id_user','=',$ini->id)->first();
      if(is_null($hariini) && $ini->id != 1){
        $saldo = Pemasukan::where('id_user','=',$ini->id)->sum('jumlah') - (Makan::where('id_user','=',$ini->id)->where('status','=','lunas')->get()->count() * 7000) - (Kasir::where('id_user','=',$ini->id)->where('status','=','lunas')->get()->count() * 3000);
        $bayarkas = new Kasir();
        $bayarkas->id_user = $ini->id;
        if($saldo >= 3000){
              $bayarkas->status = 'lunas';
          } else {
              $bayarkas->status = 'belum';
          }
        $bayarkas->save();
      }
    }
    
    $kas = Kasir::all();
    return view('laporan-kas',[
      'kas' => $kas
    ]);
  }
  public function reportMakan(){
    $makan = Makan::all();
    return view('laporan-makan',[
      'makan' => $makan
    ]);
  }
  public function reportAbsen(){
    $absen = Absen::all();
    return view('laporan-absen',[
      'absen' => $absen
    ]);
  }
  public function lalala(){
    $user = User::all();
    foreach($user as $ini){
      if($ini->id != 1){
        $bayarkas = new Absen();
        $bayarkas->id_user = $ini->id;
        $bayarkas->created_at = "2018-07-07 07:00:00";
        $bayarkas->is_absen = '1';
        $bayarkas->save();
      }
    }
    return "oaks";
  }
  public function formSettingUser(){
    if(Auth::user()->id == 1){
      $user = User::all();
      return view('form-setting',[
        'mahasiswa' => $user,
        'messages' => null
      ]);
    } else {
      return redirect()->to('/');
    }
   
  }
  public function updateUser(Request $request){
    if(Auth::user()->id == 1){
      $user = User::find($request->id_user);
      $user->password = bcrypt('123456');
      $user->is_ganti = 0;
      $user->save();

      $mhs = User::all();
        return view('form-setting',[
          'mahasiswa' => $mhs,
          'messages' => 'sukses'
        ]);
    } else {
      return redirect()->to('/');
    }
  }
}
