<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Subdistrict;
use Illuminate\Http\Request;

class SubdistrictController extends Controller
{
    public function list(Request $request)
    {
        $result = Subdistrict::where('city_id','=',$request->param)->get();
        echo json_encode($result);
    }
    public function get_list(Request $request)
    {
        $result = Subdistrict::where('city_id','=',$request->id_city)->get();
        $list = "<option>Pilih Kota</option>";
        foreach($result as $row){
            $list.="<option value='$row->subdistrict_id'>$row->subdistrict_name</option>";
        }
        echo $list;
    }
}
