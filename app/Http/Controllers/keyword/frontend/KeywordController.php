<?php

namespace App\Http\Controllers\keyword\frontend;

use App\Http\Controllers\Controller;
use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cache;
use App\Components\Comment;
use App\Components\System;


class KeyWordController extends Controller
{

    public function getKeyword(Request $request)
    {
        $html = '';
        $data = [];
        $keyword = $request->keyword;
        if( $keyword != '' ) {
            $data =  Keyword::where(['alanguage' => config('app.locale')])
                ->orderBy('order', 'ASC')
                ->orderBy('id', 'DESC');
            if (!empty($keyword)) {
                $data =  $data->where( 'keywords.title', 'like', '%' . $keyword . '%');
                //$data =  $data->where( 'publish', 0);
            }
            $data =  $data->select('keywords.title');
            $data =  $data->limit(10)->get();

        }
        if( isset($data) && !$data->isEmpty() ){
            foreach ( $data as $key => $val ){
                $html .= '<a href="'.route('homepage.search').'?keyword='.str_replace(' ', '+', $val->title).'" class="text-f14 inline-block px-[10px] py-[2px] rounded-[20px] border border-Pimary_color text-Pimary_color mb-[5px] mr-[5px]">'.$val->title.'</a>';
            }
        }

        return response()->json(['html' => $html]);

    }

}
