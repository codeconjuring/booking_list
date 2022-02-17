<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Robiussani152\Settings\Facades\Settings;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:System Settings'])->only(['index', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "System Settings";
        return view('admin.setting.index', compact('page_title'));
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
    public function store(SettingRequest $request)
    {
        try {

            if ($request->title) {
                Settings::set('title', $request->title);
            }

            if ($request->site_logo) {
                Settings::set('site_logo', $request->site_logo);
            }
            if ($request->favicon) {
                Settings::set('favicon', $request->favicon);
            }
            if ($request->default_profile) {
                Settings::set('default_profile', $request->default_profile);
            }
            if ($request->report_font_size) {
                Settings::set('report_font_size', $request->report_font_size);
            }

            if ($request->email_notification) {
                Settings::set('email_notification', $request->email_notification);
            }

            if ($request->banner_pic) {
                Settings::set('banner_pic', $request->banner_pic);
            }

            sendFlash('Settings Update Successfully');
            return back();

        } catch (\Exception $e) {
            sendFlash($e->getMessage(), 'error');
            return back();
        }
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
