<?php

namespace App\Http\Controllers\Admin\EmailConfig;

use App\Http\Controllers\Controller;
use App\Models\Widget;
use Illuminate\Http\Request;

class EmailConfigSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Email Settings'])->only(['index', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email_setting = Widget::where('name', 'email_setting')->first();
        $page_title    = "Email Configration";
        return view('admin.email.create', compact('email_setting', 'page_title'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->all();
        $email_setting = Widget::where('name', 'email_setting')->first();
        if (!$email_setting) {
            $email_setting       = new Widget();
            $email_setting->name = "email_setting";
        }

        $email_setting->contents = $request->contents;
        $email_setting->save();

        sendFlash("Email Configration Successfully");
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
