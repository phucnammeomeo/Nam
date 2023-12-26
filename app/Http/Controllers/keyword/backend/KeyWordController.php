<?php

namespace App\Http\Controllers\keyword\backend;

use App\Components\Nestedsetbie;
use App\Http\Controllers\Controller;
use App\Models\Keyword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Components\Helper;
use App\Models\Tag;
use Illuminate\Validation\Rule;

class KeyWordController extends Controller
{

    protected $table = 'keywords';
    public function index(Request $request)
    {
        $module = $this->table;
        $data =  Keyword::where(['alanguage' => config('app.locale')])
            ->with('user:id,name')
            ->orderBy('order', 'ASC')
            ->orderBy('id', 'DESC');
        $keyword = $request->keyword;
        if (!empty($keyword)) {
            $data =  $data->where($this->table . '.title', 'like', '%' . $keyword . '%');
        }
        $data =  $data->select('keywords.id','keywords.title', 'keywords.userid_created', 'keywords.created_at', 'keywords.publish', 'keywords.order', 'keywords.ishome', 'keywords.highlight', 'keywords.isaside', 'keywords.isfooter');
        $data =  $data->paginate(env('APP_paginate'));

        if (is($keyword)) {
            $data->appends(['keyword' => $keyword]);
        }
        $configIs = \App\Models\Configis::select('title', 'type')->where(['module' => $this->table, 'active' => 1])->get();
        return view('keyword.backend.index', compact('data', 'module', 'configIs'));
    }

    public function create()
    {
        $module = $this->table;
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $module])->get();
        return view('keyword.backend.create', compact('module', 'field'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'Tên gợi ý là trường bắt buộc.',
        ]);
        if (!empty($request->file('image'))) {
            $image_url = uploadImageNone($request->file('image'), 'articles');
        } else {
            $image_url = $request->image_old;
        }
        $this->submit($request, 'create', 0, $image_url);
        return redirect()->route('keywords.index')->with('success', "Thêm mới từ gợi ý thành công");
    }

    public function edit($id)
    {
        $module = $this->table;
        $detail  = Keyword::where('alanguage', config('app.locale'))->find($id);
        if (!isset($detail)) {
            return redirect()->route('keywords.index')->with('error', "Từ gợi ý không tồn tại");
        }
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $module])->get();
        return view('keyword.backend.edit', compact('module', 'detail', 'field'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'Tiêu đề là trường bắt buộc.',
        ]);
        //upload image
        if (!empty($request->file('image'))) {
            $image_url = uploadImage($request->file('image'), 'articles');
        } else {
            $image_url = $request->image_old;
        }
        //end
        $this->submit($request, 'update', $id, $image_url);
        return redirect()->route('keywords.index')->with('success', "Cập nhập từ khoá thành công");
    }

    public function submit($request = [], $action = '', $id = 0, $image_url = '')
    {
        if ($action == 'create') {
            $time = 'created_at';
            $user = 'userid_created';
        } else {
            $time = 'updated_at';
            $user = 'userid_updated';
        }
        //end
        $_data = [
            'title' => $request['title'],
            'publish' => $request['publish'],
            $user => Auth::user()->id,
            $time => Carbon::now(),
            'alanguage' => config('app.locale'),
        ];
        if ($action == 'create') {
            $id = Keyword::insertGetId($_data);
        } else {
            Keyword::find($id)->update($_data);
        }
        if (!empty($id)) {
            //START: custom fields
            fieldsInsert($this->table, $id, $request);
            //END
        }
    }

}
