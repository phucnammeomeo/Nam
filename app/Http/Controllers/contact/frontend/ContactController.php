<?php

namespace App\Http\Controllers\contact\frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use App\Components\System;
use Cache;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->system = new System();
    }
    public function index()
    {
        //page: Contact
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'contact'])->select('meta_title', 'meta_description', 'image', 'title')->first();

        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('contact.frontend.index', compact('fcSystem', 'seo', 'page'));
    }
    public function store(Request $request)
    {
        $status = 500;
        if (config('app.locale') == 'vi') {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => ['required', 'numeric', 'regex:/^(03|02|05|07|08|09|01[2|6|8|9])+([0-9]{8})$/'],
                'message' => 'required',
            ], [
                'fullname.required' => 'Họ và tên là trường bắt buộc.',
                'email.required' => 'Email là trường bắt buộc.',
                'email.email' => 'Email không đúng định dạng.',
                'phone.required' => 'Số điện thoại không được để trống.',
                'phone.regex'        => 'Số điện thoại không hợp lệ.',
                'phone.numeric' => 'Số điện thoại không đúng định dạng.',
                'message.required' => 'Nội dung là trường bắt buộc.',
            ]);
        } else if (config('app.locale') == 'gm') {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => ['required', 'numeric'],
                'message' => 'required',
            ], [
                'fullname.required' => 'Das Feld Nachname ist ein Pflichtfeld.',
                'email.required' => 'E-Mail ist ein Pflichtfeld.',
                'email.email' => 'E-Mail ungültig machen.',
                'phone.required' => 'Die Telefonnummer darf nicht leer bleiben.',
                'phone.numeric' => 'Die Telefonnummer hat nicht das richtige Format.',
                'message.required' => 'Inhalt ist ein Pflichtfeld.',
            ]);
        } else if (config('app.locale') == 'tl') {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => ['required', 'numeric'],
                'message' => 'required',
            ], [
                'fullname.required' => 'ช่องนามสกุลเป็นช่องบังคับ.',
                'email.required' => 'อีเมลเป็นฟิลด์บังคับ.',
                'email.email' => 'อีเมลไม่ถูกต้อง.',
                'phone.required' => 'หมายเลขโทรศัพท์ไม่สามารถเว้นว่างได้.',
                'phone.numeric' => 'หมายเลขโทรศัพท์ไม่อยู่ในรูปแบบที่ถูกต้อง.',
                'message.required' => 'เนื้อหาเป็นฟิลด์บังคับ.',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required',
            ]);
        }
        if ($validator->passes()) {
            $id = Contact::insertGetId([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone' => !empty($request->phone) ? $request->phone : '',
                'address' => !empty($request->address) ? $request->address : 'Gửi thông tin liên hệ',
                'message' => $request->message,
                'type' => 'contact',
                'created_at' => Carbon::now()
            ]);
            if ($id > 0) {
                $status = 200;
                //return response()->json(['status' => '200']);
            }
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => $status]);
    }
    public function subcribers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.required' => 'Email là trường bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
        ]);
        if ($validator->passes()) {
            $id = Contact::insertGetId([
                'email' => $request->email,
                'type' => 'email',
                'created_at' => Carbon::now()
            ]);
            if ($id > 0) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 500]);
            }
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }
    public function quote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'address' => 'required',
            'phone' => ['required', 'numeric', 'regex:/^(03|02|05|07|08|09|01[2|6|8|9])+([0-9]{8})$/'],
            'file' => 'max:2048',
            'message' => 'required',
        ], [
            'fullname.required' => 'Họ và tên là trường bắt buộc. ',
            'address.required' => 'Địa chỉ là trường bắt buộc. ',
            'phone.required' => 'Số điện thoại không được để trống. ',
            'phone.regex'        => 'Số điện thoại không hợp lệ. ',
            'phone.numeric' => 'Số điện thoại không đúng định dạng. ',
            // 'file.required' => 'CV là file bắt buộc.',
            'message' => 'Ghi chú là trường bắt buộc.',
        ]);

        if ($validator->passes()) {
            $filePath = '';
            if (!empty($request->file)) {
                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            }
            $id = Contact::insertGetId([
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'message' => $request->message,
                'address' => $request->address,
                'email' => $request->email,
                'file' =>  !empty($request->file) ? 'storage/app/public/' . $filePath : '',
                'type' => 'book',
                'created_at' => Carbon::now()
            ]);
            if ($id > 0) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 500]);
            }
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }
    public function machining(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'address' => 'required',
            'phone' => ['required', 'numeric', 'regex:/^(03|02|05|07|08|09|01[2|6|8|9])+([0-9]{8})$/'],
            'file' => 'max:2048',
        ], [
            'fullname.required' => 'Họ và tên là trường bắt buộc. ',
            'address.required' => 'Địa chỉ là trường bắt buộc. ',
            'phone.required' => 'Số điện thoại không được để trống. ',
            'phone.regex'        => 'Số điện thoại không hợp lệ. ',
            'phone.numeric' => 'Số điện thoại không đúng định dạng. ',
        ]);

        if ($validator->passes()) {
            $filePath = '';
            $machining = [];
            $machining['chatlieu'] = $request->chatlieu;
            $machining['solop'] = $request->solop;
            $machining['kichthuoc'] = !empty($request->kichthuoc) ? json_encode($request->kichthuoc) : '';
            $machining['soluong'] = $request->soluong;
            $machining['loaimachkhac'] = $request->loaimachkhac;
            $machining['pcb'] = $request->pcb;
            $machining['doday'] = $request->doday;
            $machining['colorboard'] = $request->colorboard;
            $machining['mauchu'] = $request->mauchu;
            $machining['kieuma'] = $request->kieuma;
            $machining['dodaydong'] = $request->dodaydong;
            $machining['thoigian'] = $request->thoigian;
            $machining['hanlinhkien'] = $request->hanlinhkien;
            $machining['stencil'] = $request->stencil;

            if (!empty($request->file)) {
                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            }
            $id = Contact::insertGetId([
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'message' => !empty($request->message) ? $request->message : '',
                'address' => $request->address,
                'email' => $request->email,
                'machining' => json_encode($machining),
                'file' => !empty($request->file) ? 'storage/app/public/' . $filePath : '',
                'type' => 'machining',
                'created_at' => Carbon::now()
            ]);
            if ($id > 0) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 500]);
            }
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }
}
