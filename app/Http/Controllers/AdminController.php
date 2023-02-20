<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ManagementRequest;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::all();
        $data = [
            'admin' => $admin,
            'areas' => $areas,
            'genres' => $genres,
            'shops' => $shops,
        ];
        return view('admin.index', $data);
    }

    public function detail(Request $request)
    {
        $reservations = Reservation::all();
        $users = User::all();
        $shop_id = $request -> only('id');
        $shop = Shop::where('id', $shop_id)->first();
        $data = [
            'reservations' => $reservations,
            'users' => $users,
            'shop' => $shop,
        ];
        return view('admin.detail', $data);
    }

    public function create(ManagementRequest $request)
    {
        $img = $request->file('image_url');
        $path = $img->store('img','public');
        Shop::create([
            'name' => $request->name,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'admin_id' => $request->admin_id,
            'discription' => $request->discription,
            'image_url' => $path,
        ]);
        return back();
    }

    public function update(ManagementRequest $request)
    {
        $shop = Shop::find($request->id);
        $img = $request->file('image_url');
        if (isset($img)) {
            Storage::disk('public')->delete($shop->image_url);
            $path = $img->store('img','public');
            Shop::where('id', $request->id)->update([
            'name' => $request->name,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'discription' => $request->discription,
            'image_url' => $path,
            ]);
        }else{
            Shop::where('id', $request->id)->update([
            'name' => $request->name,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'discription' => $request->discription,
            ]);
        }
        return back();
    }

    public function send(Request $request)
    {
        $contact = $request->only([
            'name',
            'email',
        ]);
        Mail::to($request->email)->send(new ContactMail($contact));
        return back();
    }
}
