<?php
namespace App\Helper;
use Faker\Core\File;
use Nette\Utils\Image;

class imageUpload{
    static function singleUpload($name,$directory,$file){
        $rand=$name;
        $dir='images/'.$directory.'/'.$rand;
        $dirlarge=$dir.'/large';
        if (empty($file)){
            if(!file_exists($dir)){

                mkdir($dir,0755,true);

            }

            if(file_exists($dirlarge)){

                mkdir($dirlarge,0755,true);

            }

        }
        else{
            return "";
        }
        if ($file !== null && $file->getClientOriginalExtension()) {
            // dosya yüklendi
            $filename = rand(1, 90000) . '/' . $file->getClientOriginalExtension();
            // ...
        } else {
            // dosya yüklenmedi
            return '';
        }
    }
    static function singleUploadUpdate($name,$directory,$file,$data,$field){
        $rand=$name;
        $dir='images/'.$directory.'/'.$rand;
        $dirlarge=$dir.'/large';
        if (empty($file)){
            if(!file_exists($dir)){
                mkdir($dir,0755,true);
            }
            if(file_exists($dirlarge)){
                mkdir($dirlarge,0755,true);
            }
            File::delete('public/'.$data[0]['field']);

        }
        else{
            return $data[0]['field'];
        }
        if ($file !== null && $file->getClientOriginalExtension()) {
            // dosya yüklendi
            $filename = rand(1, 90000) . '/' . $file->getClientOriginalExtension();
            // ...
        } else {
            // dosya yüklenmedi
            return '';
        }
    }
}
