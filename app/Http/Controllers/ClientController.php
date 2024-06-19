<?php

namespace App\Http\Controllers;

use App\Models\MtdPembayaran;
use App\Models\Paket;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function shop()  {
        $pakets = Paket::get();
        $products = Product::get();
        return view('shop', compact('pakets','products'));
    }

    public function home()  {
        return view('home');
    }

    public function getByProduct($productId)
    {
        $pakets = Paket::where('product_id', $productId)->get();
        return response()->json($pakets);
    }

    public function detailProduct($productId  , $paketId) {
        $mtd = MtdPembayaran::get();
        $product =  Product::findOrFail($productId);
        $paket = Paket::with('product')->findOrFail($paketId);
        return view('detail', compact('paket','mtd'));
    }
    public function transaksi(Request $request, $productId, $paketId) {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'mtd_pembayaran_id' => 'required|integer',
            'telpon' => 'required|string|max:15', // Assuming max length for a phone number
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,png,pdf|max:2048' // File validation
        ]);

        // Add user_id, product_id, and paket_id to the validated data
        $validatedData['user_id'] = Auth::id();
        $validatedData['product_id'] = $productId;
        $validatedData['paket_id'] = $paketId;

        // Handle the file upload if present
        if ($request->hasFile('bukti_pembayaran')) {
            $validatedData['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            $validatedData['status'] = "sedang diproses";
        }

        Transaksi::create($validatedData);
        return redirect('/')->with('toast', 'showToast("Data berhasil disimpan")');
    }

    public function profiles()  {
        $user = User::where('id',Auth::id())->first();
        $transaksi = Transaksi::with('product','paket','user','metode')->where('user_id',$user->id)->get();
        return view('profile',compact('user' , 'transaksi'));
    }

    public function updateBukti(Request $request,$id) {
        // dd($request);
       $transaksi = Transaksi::find($id);
       $validatedData = [];

       if ($request->hasFile('bukti_pembayaran')) {
        $validatedData['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        $validatedData['status'] = "sedang diproses";
        }

        $transaksi->update($validatedData);
       return redirect('/profiles');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate(); // Invalidate the session

        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/'); // Redirect to home or login page
    }

}
