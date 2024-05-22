<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    registration,
    konten
};
class download_controller extends Controller
{
    public function download_att_registration ($file_name){
        return response()->download(public_path('file/registration/'.$file_name));
    }
    public function download_konten_file ($file_name){
        return response()->download(public_path('kontens/att/'.$file_name));
    }
}
