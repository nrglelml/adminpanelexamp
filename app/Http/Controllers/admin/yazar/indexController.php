<?php

namespace App\Http\Controllers\admin\yazar;

use App\Helper\mHelper;
use App\Http\Controllers\Controller;
use App\Models\kitap;
use App\Models\yayinevi;
use App\Models\yazar;
use Faker\Core\File;
use Illuminate\Http\Request;
use App\Helper\imageUpload;

class indexController extends Controller
{
    public function index(){
        $data=yazar::paginate(10);
        return view('admin.yazar.index',['data'=>$data]);
    }

    public function store(Request $request){
        $request->validate([
            "name" => "required|unique:yazars,name"
        ]);
        $all = $request->except('_token');
        $all['selflink'] = mHelper::permalink($request->input('name'));
        $all['img'] = imageUpload::singleUpload(rand(1, 90000),'yazar', $request->file('image'));
        $insert = yazar::create($all);

        try {
            $insert = yazar::create($all);
            return redirect()->back()->with('status', 'Başarıyla eklendi');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'Eklenirken bir hata oluştu: '.$e->getMessage());
        }
    }

    public function create(){
        return view('admin.yazar.create');
    }

    public function edit($id){
        $c=yazar::where('id','=',$id)->count();
        if($c){
            $data= yazar::where('id','=',$id)->get();
            return view('admin.yazar.edit',['data'=>$data]);
        }
        else{
            redirect('/',);
        }


    }

    public function update(Request $request){
        $id=$request->route('id');
        $c=yazar::where('id','=',$id)->count();
        if($c){
            $request->validate([
                "name"=>"required|unique:yazars,name"
            ]);
            $data=yazar::where('id','=',$id)->get();
            $all =$request->except('_token');
            $all['selflink'] = mHelper::permalink($all['name']);
            $all['img'] = imageUpload::singleUploadUpdate(rand(1,90000),'yazar',$request->file('image'),$data,"image");
            $update=yazar::where('id','=',$id)->update($all);
            if($update){
                return redirect()->back()->with('status','Yazar güncellendi');
            }
            else {
                return redirect()->back()->with('status','Güncellenirken bir hata oluştu');
            }
        }
        else{
            redirect('/',);
        }


    }

    public function delete($id){
        $c=yazar::where('id','=',$id)->count();
        if($c){
            yazar::where('id','=',$id)->delete();
            $w=yazar::where('id','=',$id)->get();
            File::delete('public/',$w[[0]['image']]);
            return redirect()->back();
        }
        else{
            redirect('/',);
        }


    }
}
