<?php

namespace App\Http\Controllers\admin\kitap;

use App\Helper\imageUpload;
use App\Helper\mHelper;
use App\Http\Controllers\Controller;
use App\Models\kitap;
use Faker\Core\File;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index()
    {
        $data = kitap::paginate(10);
        return view('admin.kitap.index', ['data' => $data]);
    }

    public function create()
    {
        return view('admin.kitap.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "img" => "required",
            "yazarid" => "required",
            "fiyat" => "required",
        ]);
        $all = $request->except('_token');
        $all['selflink'] = mHelper::permalink($request->input('name'));
        $all['img'] = imageUpload::singleUpload(rand(1, 90000),'kitap', $request->file('image'));
        $insert = kitap::create($all);
        $record = kitap::where('name', $request->input('name'))->first();

        if ($insert) {
            return redirect()->back()->with('status', 'Başarıyla eklendi');
        } elseif ($record) {
            return redirect()->back()->with('error', 'Bu kitap zaten kayıtlı.')->withInput();
        } else {
            return redirect()->back()->with('status', 'Eklenirken bir hata oluştu');
        }
    }

    public function edit($id)
    {
        $c = kitap::where('id', '=', $id)->count();
        if ($c) {
            $data = kitap::where('id', '=', $id)->get();
            return view('admin.kitap.edit', ['data' => $data]);
        } else {
            redirect('/');
        }
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = kitap::where('id', '=', $id)->count();
        if ($c) {
            $request->validate([
                "name" => "required",
                "img" => "required",
                "yazarid" => "required",
                "fiyat" => "required",
            ]);
            $data=kitap::where('id','=',$id)->get();
            $all = $request->except('_token');
            $all['selflink'] = mHelper::permalink($all['name']);
            $all['img'] = imageUpload::singleUploadUpdate( rand(1, 90000),'kitap', $request->file('img'),$data,"img");
            $update = kitap::where('id', '=', $id)->update($all);
            if ($update) {
                return redirect()->back()->with('status', 'Başarıyla güncellendi');
            } else {
                return redirect()->back()->with('status', 'Güncellenirken bir hata oluştu');
            }
        } else {
            redirect('/');
        }
    }

    public function delete($id)
    {
        $c = kitap::where('id', '=', $id)->count();
        if ($c) {
            kitap::where('id', '=', $id)->delete();
            $w=kitap::where('id','=',$id)->get();
            File::delete('public/',$w[[0]['img']]);
            return redirect()->back();
        }
        else{
            redirect('/');
        }
    }
}
