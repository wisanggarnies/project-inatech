<?php

namespace App\Http\Controllers;

use App\Models\TambakModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TambakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Kelola Data Tambak',
            'paragraph' => 'Berikut ini merupakan data tambak yang terinput ke dalam sistem',
            'list' => [
                ['label' => 'Home', 'url' => route('tambak.index')],
                ['label' => 'Manajemen Tambak'],
            ]
        ];
        $activeMenu = 'manajemenTambak';
        return view('tambak.index',['breadcrumb' =>$breadcrumb, 'activeMenu' => $activeMenu]);
    }
    
    public function list(Request $request)
    {
        $tambaks = TambakModel::select('id_tambak', 'nama_tambak', 'luas_lahan', 'luas_tambak'); 
        return DataTables::of($tambaks)
        ->make(true);
    }
public function create(){
    $breadcrumb = (object) [
        'title' => 'Tambah Data Tambak',
        'paragraph' => 'Berikut ini merupakan form tambah data tambak yang terinput ke dalam sistem',
        'list' => [
            ['label' => 'Home', 'url' => route('dashboard.index')],
            ['label' => 'Kelola Pengguna', 'url' => route('tambak.index')],
            ['label' => 'Tambah'],
        ]
    ];
    $activeMenu = 'manajemenTambak';
        $tambak = TambakModel::all();
        return view('tambak.create',['breadcrumb' =>$breadcrumb, 'activeMenu' => $activeMenu, 'tambak' => $tambak]);
}
}