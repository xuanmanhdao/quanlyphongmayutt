<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


class lienHeSuCoController extends Controller
{
    public function __construct()
    {
        // $this->model=(new LichMuonPhong())->query();

        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName); // Cắt chuỗi route theo ký tự . rồi push vào arr[]
        $arr = array_map('ucfirst', $arr); // Viết hoa chữ cái đầu trong arr[]
        $tieuDe = implode(' > ', $arr); // Nối chuỗi value của arr[] vào ký tự /
        View::share('tieuDe', $tieuDe);
    }

    public function index(){
        return view('contact');
    }
}
