<?php

namespace Zhetenov\VuePreset;

use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class Preset extends LaravelPreset
{
    public static function install()
    {
        static::cleanSassDirectory();
        static::updateScripts();
        static::updateMix();
    }

    private static function cleanSassDirectory()
    {
        File::cleanDirectory(resource_path('sass/'));
    }

    private static function updateScripts()
    {
        $src = __DIR__ . '/stubs/';
        $dst = resource_path('js/');
        (new self())->recursiveCopy($src, $dst);
    }

    /**
     * @param $source
     * @param $dest
     */
    private function recursiveCopy($source, $dest){
        if(is_dir($source)) {
            $dir_handle=opendir($source);
            while($file=readdir($dir_handle)){
                if($file!="." && $file!=".."){
                    if(is_dir($source."/".$file)){
                        if(!is_dir($dest."/".$file)){
                            mkdir($dest."/".$file);
                        }
                        $this->recursiveCopy($source."/".$file, $dest."/".$file);
                    } else {
                        copy($source."/".$file, $dest."/".$file);
                    }
                }
            }
            closedir($dir_handle);
        } else {
            copy($source, $dest);
        }
    }

    public static function updatePackageArray($packages)
    {
        return array_merge([''], Arr::except($packages, [
            'popper.js'
        ]));
    }

    public static function updateMix()
    {
        copy(__DIR__ . '/webpack_stub/webpack.mix.js', base_path('webpack.mix.js'));
    }
}
