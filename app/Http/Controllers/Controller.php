<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function datatable()
    {
        return view('datatable');
    }
    public function viewtambahkaryawan()
    {
        return view('tambah-karyawan');
    }
    public function tambahkaryawan(Request $r)
    {
        $ky = new Karyawan();
        $ky->nama = $r->nama;
        $ky->divisi_id = $r->divisi;
        $ky->save();
        $nki = Karyawan::latest()->get();

        $n = new Penilaian();
        $n->karyawan_id = $nki[0]->id;
        $n->kompetensi_id = 1;
        $n->nilai = 0;
        $n->save();

        $n2 = new Penilaian();
        $n2->karyawan_id = $nki[0]->id;
        $n2->kompetensi_id = 2;
        $n2->nilai = 0;
        $n2->save();

        $n3 = new Penilaian();
        $n3->karyawan_id = $nki[0]->id;
        $n3->kompetensi_id = 3;
        $n3->nilai = 0;
        $n3->save();

        $n4 = new Penilaian();
        $n4->karyawan_id = $nki[0]->id;
        $n4->kompetensi_id = 4;
        $n4->nilai = 0;
        $n4->save();

        $n5 = new Penilaian();
        $n5->karyawan_id = $nki[0]->id;
        $n5->kompetensi_id = 5;
        $n5->nilai = 0;
        $n5->save();
        return redirect('/dashboard');
    }
    public function lihatdash()
    {

        $ky = Karyawan::with('divisi', 'penilaian')->get();
        // dd($ky[0]->penilaian[0]->nilai);
        return view('dashboard', compact('ky'));
    }
    public function vieweditkaryawan($id)
    {
        $k = Karyawan::find($id);
        return view('formeditkaryawan', compact('k'));
    }
    public function updatekaryawan(Request $r)
    {
        $ky = Karyawan::find($r->id);
        $ky->nama = $r->nama;
        $ky->divisi_id = $r->divisi;
        $ky->save();
        return redirect('/dashboard');
    }
    public function hapuskaryawan($id)
    {
        $k = Karyawan::find($id);
        $k->delete();
        return redirect('/dashboard');
    }
    public function viewnilaikaryawan($id)
    {
        // $h = 0;
        // $t = 0;
        // $k = 0;
        // $d = Penilaian::where()

        $ky = Karyawan::find($id);
        return view('formnilaikaryawan', compact('ky'));
    }
    public function updatenilai(Request $r)
    {
        // $h = 0;
        // $t = 0;
        // $k = 0;
        // $d = Penilaian::where()
        $x = Penilaian::where('karyawan_id', $r->id)->delete();

        $n = new Penilaian();
        $n->karyawan_id = $r->id;
        $n->kompetensi_id = 1;
        $n->nilai = $r->penhadir;
        $n->save();

        $n2 = new Penilaian();
        $n2->karyawan_id = $r->id;
        $n2->kompetensi_id = 2;
        $n2->nilai = $r->penkre;
        $n2->save();

        $n3 = new Penilaian();
        $n3->karyawan_id = $r->id;
        $n3->kompetensi_id = 3;
        $n3->nilai = $r->penket;
        $n3->save();

        $n4 = new Penilaian();
        $n4->karyawan_id = $r->id;
        $n4->kompetensi_id = 4;
        $n4->nilai = $r->penpro;
        $n4->save();

        $n5 = new Penilaian();
        $n5->karyawan_id = $r->id;
        $n5->kompetensi_id = 5;
        $n5->nilai = $r->penker;
        $n5->save();
        return redirect('dashboard');
    }
}
