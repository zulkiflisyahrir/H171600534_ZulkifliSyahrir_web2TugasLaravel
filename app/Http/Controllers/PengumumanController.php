<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengumuman;
use App\KategoriPengumuman;

class PengumumanController extends Controller
{
	public function index(){
    //Eloquent => ORM (Object Relational Mapping)
    $listPengumuman=Pengumuman::all(); //select*from pengumuman

    //blade
    return view('pengumuman.index', compact('listPengumuman'));
    //return view(view: 'pengumuman.index')->with('data',$listgaleri);
	}
	public function show($id){

		//$Pengumuman=Pengumuman::where('id',$id)->first();
		$listPengumuman=Pengumuman::find($id);

		return view ('pengumuman.show', compact('listPengumuman'));
	}

	public function create(){
		$KategoriPengumuman=KategoriPengumuman::pluck('nama','id');
		return view('pengumuman.create', compact('KategoriPengumuman'));
	}

	public function store(Request $request){
		$input= $request->all();
		
		Pengumuman::create($input);

		return redirect(route('pengumuman.index'));
	}

	public function edit($id){
		$listPengumuman=Pengumuman::find($id);

		if(empty($listPengumuman)){
			return redirect(route('pengumuman.index'));
		}
		$KategoriPengumuman=KategoriPengumuman::pluck('nama','id');
		return view('pengumuman.edit',compact('listPengumuman','KategoriPengumuman'));
	}

	public function update($id, Request $request){
		$listPengumuman=Pengumuman::find($id);
		$input= $request->all();

		if(empty($listPengumuman)){
			return redirect(route('pengumuman.index'));
		}

		$listPengumuman->update($input);

		return redirect(route('pengumuman.index'));
	}

	public function destroy($id){
		$listPengumuman=Pengumuman::find($id);

		if(empty($listPengumuman)){
			return redirect(route('pengumuman.index'));
		}

		$listPengumuman->delete();
		return redirect(route('pengumuman.index'));
	}

}