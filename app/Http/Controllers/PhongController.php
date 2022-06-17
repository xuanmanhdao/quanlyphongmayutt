<?php

namespace App\Http\Controllers;

use App\Models\Phong;
use App\Http\Requests\StorePhongRequest;
use App\Http\Requests\UpdatePhongRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class PhongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName); // Cắt chuỗi route theo ký tự . rồi push vào arr[]
        $arr = array_map('ucfirst', $arr); // Viết hoa chữ cái đầu trong arr[]
        $tieuDe = implode(' > ', $arr); // Nối chuỗi value của arr[] vào ký tự /
        View::share('tieuDe', $tieuDe);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('phong.index');
    }

    public function api()
    {
        // $users = DB::table('users')->select(['id', 'name', 'email', 'created_at', 'updated_at']);

        return DataTables::of(Phong::query())
            ->rawColumns(['GhiChu'])
            ->editColumn('TinhTrang', function ($object) {
                return $object->getTinhTrang();
            })
            ->addColumn('btnEdit', function ($object) {
                return route('phong.edit', $object->MaPhong);
            })
            ->addColumn('btnDestroy', function ($object) {
                return route('phong.destroy', $object->MaPhong);
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('phong.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePhongRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhongRequest $request)
    {

        $phong = new Phong();
        $phong->fill($request->all()); // Lấy hết dữ liệu
        $phong->fill($request->except('_token')); // Lấy hết dữ liệu ngoại trừ thuộc tính _token
        $phong->setTenPhong($request->TenPhong);
        $phong->setMaPhong($request->TenToaNha);
        // dd($phong->getAttribute('MaPhong'));

        if (Phong::where('MaPhong', '=',  $phong->getAttribute('MaPhong'))->exists()) {
            return Redirect::back()->withErrors(['msg' => 'Mã phòng đã tồn tại. Hãy nhập lại phòng khác']);
        } else {
            $phong->save();
            return redirect()->route('phong.index')->with('success', 'Đã thêm thành công');
        }
        // dd( response()->json([$phong]));



        // Điều hướng
        // Phong::create($request->validated());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Phong  $phong
     * @return \Illuminate\Http\Response
     */
    public function show(Phong $phong)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Phong  $phong
     * @return \Illuminate\Http\Response
     */
    public function edit(Phong $phong)
    {
        return view('phong.edit', [
            'each' => $phong,
        ],);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePhongRequest  $request
     * @param  \App\Models\Phong  $phong
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhongRequest $request, Phong $phong)
    {
        //    Classroom::query()->where('id', $classroom->id)->update(
        //        $request->except([
        //            '_token',
        //            '_method'
        //         ])
        //     );

        // dd($request);
        $phong->fill($request->all()); // Lấy hết dữ liệu
        $phong->fill($request->except('_token')); // Lấy hết dữ liệu ngoại trừ thuộc tính _token
        $phong->save();
        return redirect()->route('phong.index')->with('success', 'Đã cập nhật thông tin phòng thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phong  $phong
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phong $phong)
    {
        $phong->delete();

        // return redirect()->route('classrooms.index');

        // trả về json
        $arr = [];
        $arr['status'] = true;
        $arr['message'] = 'Bạn đã xóa thành công';

        return response($arr, 200);
    }
}
