<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Website setting page
     * @return Application|Factory|View
     */
    public function websiteSetting() {
        return view('settings.site-setting');
    }

    public function updateWebsiteSetting (Request $request) {

        $this->validate($request,[
            'site_title' => 'required',
            'site_slogan' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'banner_image' => 'dimensions:max_width=780,max_height=646'
        ],[
            'banner_image.dimensions' => 'The Banner Image should be height 646px and width 780px'
        ]);
        $setting_data['site_title'] = $request->site_title ?? '';
        $setting_data['site_slogan'] = $request->site_slogan ?? '';
        $setting_data['banner_image'] = isset($request->banner_image) && $request->hasFile('banner_image') ? uploadFile($request->file('banner_image')) : '';
        $setting_data['phone'] = $request->phone ?? '';
        $setting_data['email'] = $request->email ?? '';
        $setting_data['address'] = $request->address ?? '';
        $setting_data['about_us'] = $request->about_us ?? '';
        $setting_data['privacy_policy'] = $request->privacy_policy ?? '';
        $setting_data['mission'] = $request->mission ?? [];
        $newJsonString = json_encode($setting_data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('assets/json/site_setting.json'), $newJsonString);
        return redirect()->route('website-settings')->with(updateMessage());
    }
}
