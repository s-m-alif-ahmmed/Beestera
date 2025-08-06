<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use Exception;
use App\Helpers\Helper;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class SystemSettingController extends Controller
{
    /**
     * Display the system settings page.
     *
     * @return View
     */
    public function index(): View
    {
        $setting = SystemSetting::latest('id')->first();
        return view('backend.layouts.settings.system_settings', compact('setting'));
    }

    /**
     * Update the system settings.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable',
            'email' => 'nullable',
            'copyright_text' => 'nullable',
            'system_description' => 'nullable',
            'logo' => 'nullable|file|mimes:jpeg,jpg,png|max:51200',
            'favicon' => 'nullable|file|mimes:jpeg,jpg,png|max:51200',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $setting = SystemSetting::firstOrCreate();
            $setting->title = $request->title;
            $setting->email = $request->email;
            $setting->copyright_text = $request->copyright_text;
            $setting->system_description = $request->system_description;

            if ($request->hasFile('logo')) {
                if ($setting->logo) {
                    Helper::fileDelete($setting->logo);
                }
                $imagePath = Helper::fileUpload($request->file('logo'), 'setting', time() . '_' . $request->file('logo')->getClientOriginalName());
                $setting->logo = $imagePath;
            }
            if ($request->hasFile('favicon')) {
                if ($setting->favicon) {
                    Helper::fileDelete($setting->favicon);
                }
                $imagePath = Helper::fileUpload($request->file('favicon'), 'setting', time() . '_' . $request->file('favicon')->getClientOriginalName());
                $setting->favicon = $imagePath;
            }



            // if ($request->hasFile('logo')) {
            //     if ($setting->logo && file_exists(public_path($setting->logo))) {
            //         Helper::fileDelete(public_path($setting->logo));
            //     }
            //     $setting->logo = Helper::fileUpload($request->file('logo'), 'logo', $setting->logo);
            // }

            // if ($request->hasFile('favicon')) {
            //     if ($setting->favicon && file_exists(public_path($setting->favicon))) {
            //         Helper::fileDelete(public_path($setting->favicon));
            //     }
            //     $setting->favicon = Helper::fileUpload($request->file('favicon'), 'favicon', $setting->favicon);
            // }
            // dd($setting);
            $setting->save();
            return back()->with('t-success', 'Updated successfully');
        } catch (Exception) {
            return back()->with('t-error', 'Failed to update');
        }
    }
}
