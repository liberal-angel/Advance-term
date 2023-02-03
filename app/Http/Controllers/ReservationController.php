<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\RateRequest;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Like;
use App\Models\Area;
use App\Models\Genre;
use App\Models\User;

class ReservationController extends Controller
{
    public function index(){
        $User = Auth::user();
        $Shops = Shop::all();
        $Areas = Area::all();
        $Genres = Genre::all();
        $Data = [
            'User' => $User,
            'Shops' => $Shops,
            'Areas' => $Areas,
            'Genres' => $Genres,
        ];
        return view('index', $Data);
    }

    public function search(Request $request){
        $User = Auth::user();
        $Areas = Area::all();
        $Genres = Genre::all();

        $keyword = $request->only(['area_id', 'genre_id', 'name']);
        $query = Shop::query();

        if(!empty($keyword)) {
            if($request->area_id && !$request->genre_id && !$request->name){
                // エリア検索
                $query->where('area_id', $request->area_id);
            }elseif(!$request->area_id && $request->genre_id && !$request->name){
                // ジャンル検索
                $query->where('genre_id', $request->genre_id);
            }elseif(!$request->area_id && !$request->genre_id && $request->name){
                // 名前検索
                $query->where('name', 'LIKE BINARY', "%{$request->name}%");
            }elseif($request->area_id && $request->genre_id && !$request->name){
                // エリア＆ジャンル検索
                $query->where('area_id', $request->area_id)->where('genre_id', $request->genre_id);
            }elseif($request->area_id && !$request->genre_id && $request->name){
                // エリア＆名前検索
                $query->where('area_id', $request->area_id)->where('name', 'LIKE BINARY', "%{$request->name}%");
            }elseif(!$request->area_id && $request->genre_id && $request->name){
                // ジャンル＆名前検索
                $query->where('genre_id', $request->genre_id)->where('name', 'LIKE BINARY', "%{$request->name}%");
            }elseif($request->area_id && $request->genre_id && $request->name){
                // エリア＆ジャンル＆名前検索
                $query->where('area_id', $request->area_id)
                ->where('genre_id', $request->genre_id)
                ->where('name', 'LIKE BINARY', "%{$request->name}%");
            }
        }
        $Shops = $query->get();
        $param = [
            'User' => $User,
            'Areas' => $Areas,
            'Genres' => $Genres,
            'Shops' => $Shops,
        ];
        return view('index', $param);
    }

    public function like($shopId){
        Auth::user()->like($shopId);
        return back();
    }

    public function unlike($shopId){
        Auth::user()->unlike($shopId);
        return back();
    }

    public function detail(Request $request){
        $detail = $request->all();
        $user = Auth::user();
        $Areas = Area::all();
        $Genres = Genre::all();
        $today = Carbon::today()->format('Y-m-d');
        $after_year = Carbon::today()->addYears(1)->format('Y-m-d');
        $data = [
            'detail' => $detail,
            'user' => $user,
            'Areas' => $Areas,
            'Genres' => $Genres,
            'today' => $today,
            'after_year' => $after_year,
        ];
        return view('detail', $data);
    }

    public function reservation(ReservationRequest $request){
        $dt = $request->date;
        $ti = $request->time;
        $start_at = Carbon::parse("$dt $ti");
        $data = [
            'user_id' => $request->user_id,
            'shop_id' => $request->shop_id,
            'num_of_users' => $request->num_of_users,
            'start_at' => $start_at,
        ];
        Reservation::create($data);
        return view('done');
    }

    public function mypage(){
        $user = Auth::user();
        $Shops = Shop::all();
        $Areas = Area::all();
        $Genres = Genre::all();
        $reservations = Reservation::all();
        $now = Carbon::now();
        $today = Carbon::today()->format('Y-m-d');
        $after_year = Carbon::now()->addYears(1)->format('Y-m-d');
        $data = [
            'user' => $user,
            'Shops' => $Shops,
            'Areas' => $Areas,
            'Genres' => $Genres,
            'reservations' => $reservations,
            'now' => $now,
            'today' => $today,
            'after_year' => $after_year,
        ];
        return view('mypage', $data);
    }

    public function update(Request $request){
        $dt = $request->date;
        $ti = $request->time;
        $start_at = Carbon::parse("$dt $ti");
        $data = [
            'num_of_users' => $request->num_of_users,
            'start_at' => $start_at,
        ];
        Reservation::where('id', $request -> id)->update($data);
        return back();
    }

    public function delete(Request $request){
        $data = $request -> all();
        Reservation::where('id', $request -> id)->delete();
        return redirect('mypage');
    }

    public function menu(){
        return view('menu');
    }

    public function management(){
        return view('management');
    }

    public function rate(RateRequest $request){
        $test = $request->only([
            'user_id',
            'shop_id',
            'rate',
            'comment',
        ]);
        dd($test);
        return back();
    }
}