<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class ImageController extends Controller
{

    const DEFAULT_IMAGE_NAME = 'IMG-';
    const DEFAULT_IMAGE_TYPE = 'default';
    const DEFAULT_IMAGE_DIR = '0';
    const PATH_TO_IMAGES = '/images/';

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $title = !empty($request->input('image-title')) ? $request->input('image-title') : self::DEFAULT_IMAGE_NAME . time();
        $name = $title . '.' . $request->file('image')->getClientOriginalExtension();
        $type = !empty($request->input('image-type')) ? $request->input('image-type') : self::DEFAULT_IMAGE_TYPE;
        $dir = !empty($request->input('parent-id')) ? $request->input('parent-id') : self::DEFAULT_IMAGE_DIR;
        $path = public_path() . self::PATH_TO_IMAGES . $type . '/' . $dir;
        $src = route('home') . self::PATH_TO_IMAGES . $type . '/' . $dir . '/';

        // Check validation
        $v = \Validator::make($request->all(), [
            'image' => 'mimes:jpeg|required',
            'image-title' => 'required',
        ]);

        // Return validation errorrs
        if ($v->fails()) {
            return ['error' => $v->errors()];
        }

        try {
            if (!empty($name)) {
                $image = new Image();
                $image->src = $src . $name;
                $image->imageable_id = $request->input('parent-id');
                $image->imageable_type = 'App\\' . ucfirst($request->input('image-type'));
                $image->save();
                if (!is_dir($path)) {
                    mkdir($path, 0755);
                }

                $request->file('image')->move($path, $name);
                return [
                    'status' => 'success',
                    'error' => 0
                ];
            }
        } catch (QueryException $e) {
            echo 'Upload file not found: ', $e->getMessage(), "\n";
        }
    }
}
