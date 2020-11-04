<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class FileController extends BaseController
{
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_img' => 'required|string'
        ]);
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $base64Image = $request->input('profile_img');
        $base64Image = str_replace(array('data:image/png;base64,','data:image/jpeg;base64,'), '', $base64Image);

        if ($validator->fails()) {
            return $this->sendError('Validator error', $validator->errors());
        }
        $user = Auth::user();
        // Pour s'assurer de sauvegarder une seule image pour l'utilisateur
        if (count($user->getMedia('image')) > 0) {
            foreach ($user->getMedia('image') as $media) {
                $media->delete();
            }
        }
        $base64Image = str_replace('data:image/png;base64,', '', $base64Image);
        $file_name = uniqid(). '_profile.png';
        Storage::put('tmp/uploads/'.$file_name, base64_decode($base64Image));

        $path = storage_path('app/tmp/uploads/' . $file_name);

        $user->addMedia($path)->toMediaCollection('image');
        $user = Auth::user()->fresh();
        return $this->sendResponse($user, 'Your profile was successfull saved');
    }

}
