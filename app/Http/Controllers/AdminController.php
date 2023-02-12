<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ManagementRequest;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
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

    public function detail(Request $request){
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

    public function create(ManagementRequest $request){
        $cre_dt = $request->only(
            'admin_id',
            'name',
            'area_id',
            'genre_id',
            'discription',
            'image_url',
        );
        Shop::create($cre_dt);
        return back();
    }

    public function update(ManagementRequest $request)
    {
        $up_dt = $request->only(
            'name',
            'area_id',
            'genre_id',
            'discription',
            'image_url',
        );
        Shop::where('id', $request -> id)->update($up_dt);
        return back();
    }
}
