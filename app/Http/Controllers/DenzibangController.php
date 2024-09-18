<?php

namespace App\Http\Controllers;

use App\Models\DataPekerjaan;
use Illuminate\Http\Request;

class DenzibangController extends Controller
{
    public function dashboard()
    {
        return view('denzibang.dashboard');
    }

    public function lapjusik()
    {
        $data = DataPekerjaan::get();

        return view('denzibang.lapjusik', compact('data'));
    }

    public function input_lapjusik()
    {
        $data = DataPekerjaan::get();

        return view('denzibang.input_lapjusik', compact('data'));
    }

    public function input_gambar()
    {
        $data = DataPekerjaan::get();

        return view('denzibang.input_gambar', compact('data'));
    }

    public function find_lapjusik(Request $request, $id)
    {
        $data = DataPekerjaan::find($id);

        return view('denzibang.lapjusik', compact('data'));
    }

    public function update_lapjusik(Request $request, $id)
    {
        $data['lapju_rencana'] = $request->lapju_rencana;
        $data['lapju_ril'] = $request->lapju_ril;
        $data['lapju_deviasi'] = $request->lapju_deviasi;

        DataPekerjaan::whereId($id)->update($data);

        return redirect()->route('input-lapjusik');
    }

    public function add_gambar(Request $request, $id)
    {
        $data = [];

        if ($request->hasFile('img_awal')) {
            $imageAwal = $request->file('img_awal');
            $fileAwal = date('Y-m-d') . '-' . $imageAwal->getClientOriginalName();
            $pathAwal = $imageAwal->storeAs('images', $fileAwal, 'public');
            $data['img_awal'] = $pathAwal;
        }

        if ($request->hasFile('img_progress')) {
            $imageSaatIni = $request->file('img_progress');
            $fileSaatIni = date('Y-m-d') . '-' . $imageSaatIni->getClientOriginalName();
            $pathSaatIni = $imageSaatIni->storeAs('images', $fileSaatIni, 'public');
            $data['img_progress'] = $pathSaatIni;
        }

        if ($request->hasFile('img_akhir')) {
            $imageBukti = $request->file('img_akhir');
            $fileBukti = date('Y-m-d') . '-' . $imageBukti->getClientOriginalName();
            $pathBukti = $imageBukti->storeAs('images', $fileBukti, 'public');
            $data['img_akhir'] = $pathBukti;
        }

        DataPekerjaan::whereId($id)->update($data);

        return redirect()->route('input-gambar');
    }
}
