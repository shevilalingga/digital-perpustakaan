<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KoleksiPribadi;
use Illuminate\Support\Facades\Auth;

class KoleksiPribadiController extends Controller
{
    public function index() {
        $koleksi = KoleksiPribadi::where('user_id', Auth::id())->with('buku')->get();
        return view('koleksi.index', compact('koleksi'));
    }

    public function store(Request $request) {
        $cek = KoleksiPribadi::where('user_id', Auth::id())->where('buku_id', $request->buku_id)->first();
        if ($cek) {
            return redirect()->back()->withErrors(['buku_id' => 'Buku sudah ada di koleksi Anda.']);
        }

        KoleksiPribadi::create([
            'user_id' => Auth::id(),
            'buku_id' => $request->buku_id
        ]);

        return redirect()->back()->with('success', 'Buku ditambahkan ke koleksi pribadi');
    }

    public function destroy($id) {
        $koleksi = KoleksiPribadi::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $koleksi->delete();
        return redirect()->back()->with('success', 'Buku dihapus dari koleksi');
    }
}