<?php

namespace App\Library;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class ImageTool
{

    public static function mycrop($myfilename, $width, $height, $default = '') {

        if (!Storage::exists($myfilename)) {

            return ;
        }

        $new_extens = ['svg','webp'];
        $extension = pathinfo($myfilename, PATHINFO_EXTENSION);
        if (in_array($extension, $new_extens))
        {

            return Storage::url($myfilename);
        }


        $extension = pathinfo($myfilename, PATHINFO_EXTENSION);


        $old_image = $myfilename;

        $new_image = 'cache/' . Str::remove('.'.$extension, $myfilename) . '-' . $width . 'x' . $height . '.' . $extension;


        if (!Storage::exists($new_image)) {


            if (\env('FILESYSTEM_DRIVER') == 'oss')
            {


                list($width_orig, $height_orig, $image_type) = self::getImage(Storage::url($old_image));
                if (!in_array($image_type, array('image/png', 'image/jpeg', 'image/gif'))) {
                    return Storage::url($old_image);
                }
            } else{

                list($width_orig, $height_orig, $image_type) = getimagesize(Storage::path($old_image));
                if (!in_array($image_type, array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF))) {
                    return Storage::url($old_image);
                }
            }




            $path = '';

            $directories = explode('/', dirname(str_replace('../', '', $new_image)));
            $tempdir = public_path('images/catalog/');
            if (!is_dir($tempdir))
            {
                if (!mkdir($tempdir, 0777) && !is_dir($tempdir)) {
                    throw new \RuntimeException(sprintf('Directory "%s" was not created', $tempdir));
                }
            }


            foreach ($directories as $directory) {

                $path = $path . '/' . $directory;


                if (!Storage::exists($path)) {
                    Storage::makeDirectory($path);
                }

                if (!is_dir($tempdir.$path)) {
                    if (!mkdir($tempdir.$path, 0777) && !is_dir($tempdir.$path)) {
                        throw new \RuntimeException(sprintf('Directory "%s" was not created', $tempdir.$path));
                    }
                }

            }


            if ($width_orig > $width || $height_orig > $height) {
                if (\env('FILESYSTEM_DRIVER') == 'oss')
                {

                    $url = Storage::url($old_image);
                    $fileName = basename($url);
                    file_put_contents(public_path('images') .'/'. $fileName, file_get_contents($url));
                    $image = new MyImage(public_path('images') .'/'. $fileName);
                    $image->resize($width, $height);
                    $image->save($tempdir. $new_image);
                    Storage::putRemoteFile($new_image,env('APP_URL').'images/catalog/'.$new_image);
                    @File::delete(public_path('images') .'/'. $fileName);
                    @File::delete($tempdir. $new_image);
                }else{

                    $image = new MyImage(Storage::path($old_image));
                    $image->resize($width, $height);
                    $image->save(Storage::path($new_image));
                }

            } else {
                Storage::copy($old_image, $new_image);

            }
        }

        return Storage::url($new_image);

    }

    public static function getImage( $url, $referer = '' ) {
        $default = array('width' => 0, 'height' => 0, 'mime' => NULL, 'resource' => NULL);

        // set headers
        $headers = array( 'Range: bytes=0-131072' );

        if ( !empty( $referer ) ) { array_push( $headers, 'Referer: ' . $referer ); }

        // set curl config
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $data = curl_exec( $ch );

        $http_status = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        $curl_errno = curl_errno( $ch );

        curl_close( $ch );

        // valid stauts
        if ( $http_status >= 400) {
            return $default;
        }

        // set stream config
        stream_context_set_default( [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);

        $mime = (!empty(get_headers($url, 1)['Content-Type'])) ? get_headers($url, 1)['Content-Type'] : false;
        $mime = (is_array($mime) && $mime) ? end($mime) : $mime;

        // valid image types
        if(!$mime || !preg_match('/png|jpe?g|gif/i',$mime)){
            return false;
        }

        $image_resource  = imagecreatefromstring( $data );

        if(!$image_resource){
            return $default;
        }

//        return ['width' => imagesx($image_resource), 'height' => imagesy($image_resource), 'mime' => $mime, 'resource' => $image_resource];
        return [imagesx($image_resource), imagesy($image_resource), $mime, 'resource' => $image_resource];

    }






}
