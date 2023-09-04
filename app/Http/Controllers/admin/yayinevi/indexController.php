<?php

namespace App\Http\Controllers\admin\yayinevi;

use App\Helper\mHelper;
use App\Http\Controllers\Controller;
use App\Models\yayinevi;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index(){
        $data=yayinevi::paginate();
        return view('admin.yayinevi.index',['data'=>$data]);
    }
    public function create(){
        return view('admin.yayinevi.create');
    }
    public function store(Request $request){
        //  $all =$request->except('_token');
        //dd($all);
        $request->validate([
            "name"=>"required|unique:yayinevis,name"
        ]);
        $all =$request->except('_token');
        $all['selflink'] = mHelper::permalink($request->input('name'));
        $insert=yayinevi::create($all);
        $record = yayinevi::where('name', $request->input('name'))->first();

        if ($insert){
            return redirect()->back()->with('status','Başarıyla eklendi');
        }
        elseif ($record) {
            return redirect()->back()->with('error', 'Bu isim zaten kayıtlı.')->withInput();
        }
        else {
            return redirect()->back()->with('status','Eklenirken bir hata oluştu');
        }
        /* $validatedData = $request->validate([
             'name' => 'required|max:255|unique:yayinevis,name',
         ]);

         // CSRF token kontrolü yapıyoruz
         $token = $request->input('_token');
         if (! csrf_token() == $token) {
             // Token'ın doğru olmadığı durumda hata döndürüyoruz
             return response()->json(['error' => 'Token mismatch'], 400);
         }

         // Yeni bir ExampleModel örneği oluşturuyoruz
         $example = new yayinevi();
         $example->name = $validatedData['name'];
         // Diğer alanları da burada ekleyebiliriz
         $example->save();

         // Veri başarıyla kaydedildiğinde bir yanıt dönüyoruz
         return response()->json(['success' => 'Data saved'], 200);*/
    }
    public function edit($id){
        $c=yayinevi::where('id','=',$id)->count();
        if($c){
            $data= yayinevi::where('id','=',$id)->get();
            return view('admin.yayinevi.edit',['data'=>$data]);
        }
        else{
            redirect('/',);
        }


    }

    public function update(Request $request){
        $id=$request->route('id');
        $c=yayinevi::where('id','=',$id)->count();
        if($c){
            $request->validate([
                "name"=>"required|unique:yayinevis,name"
            ]);
            $all =$request->except('_token');
            $all['selflink'] = mHelper::permalink($request->input('name'));
            $update=yayinevi::where('id','=',$id)->update($all);
            if($update){
                return redirect()->back()->with('status','Yayinevi düzenlendi');
            }
            else {
                return redirect()->back()->with('status','Düzenlenirken bir hata oluştu');
            }
        }
        else{
            redirect('/');
        }


    }

    public function delete($id){
        $c=yayinevi::where('id','=',$id)->count();
        if($c){
            $delete=yayinevi::where('id','=',$id)->delete();
            if($delete){
                return redirect()->back()->with('status','Yayinevi silindi');
            }
            else {
                return redirect()->back()->with('status','Silinirken bir hata oluştu');
            }
            //return redirect()->back();

        }

        else{
            redirect('/');
        }


    }
}
