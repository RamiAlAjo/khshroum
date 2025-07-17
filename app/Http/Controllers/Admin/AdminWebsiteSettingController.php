<?php

namespace App\Http\Controllers\Admin;

use App\Models\WebsiteSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminWebsiteSettingController extends Controller
{
    public function index()
    {
        $settings = WebsiteSetting::first();

        $phones = [];

        if ($settings) {
            // Decode phone if exists
            if ($settings->phone) {
                $decodedPhones = json_decode($settings->phone, true);
                $phones = is_array($decodedPhones) ? $decodedPhones : [];
            }
        }

        return view('admin.setting.index')->with(compact('settings', 'phones'));
    }


public function store(Request $request)
{
    $request->validate([
        'facebook' => 'nullable|url',
        'youtube' => 'nullable|url',
        'watsapp' => 'nullable|url',
        'title' => 'nullable|string',
        'key_words' => 'nullable|string',
        'phone' => 'nullable|array|max:3',
        'phone.*' => 'nullable|string',
        'email' => 'nullable|email',
        'logo' => 'nullable|image|max:2048',
        'address' => 'nullable|string',
        'contact_email' => 'nullable|email',
        'carrers_email' => 'nullable|email',
        'location' => 'nullable|string',
        'remove_logo' => 'nullable|boolean',
    ]);

    $setting = WebsiteSetting::firstOrNew([]);

    $setting->facebook = $request->facebook;
    $setting->watsapp = $request->watsapp;
    $setting->youtube = $request->youtube;
    $setting->title = $request->title;
    $setting->key_words = $request->key_words;
    $setting->address = $request->address;
    $setting->email = $request->email;
    $setting->contact_email = $request->contact_email;
    $setting->carrers_email = $request->carrers_email;
    $setting->location = $request->location;

    // ✅ Save phone numbers as JSON
    $setting->phone = json_encode($request->phone ?? []);

    // ✅ Handle logo upload
    if ($request->hasFile('logo')) {
        // Delete old logo if it exists
        if (!empty($setting->logo) && file_exists(public_path($setting->logo))) {
            @unlink(public_path($setting->logo));
        }

        $file = $request->file('logo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('logos', $filename, 'public');
        $setting->logo = 'storage/' . $path;
    } elseif ($request->has('remove_logo') && $request->remove_logo == 1) {
        if (!empty($setting->logo) && file_exists(public_path($setting->logo))) {
            @unlink(public_path($setting->logo));
        }
        $setting->logo = null;
    }

    $setting->save();

    return redirect()->route('admin.settings.index')
        ->with('status-success', 'Settings have been updated successfully!');
}

}
