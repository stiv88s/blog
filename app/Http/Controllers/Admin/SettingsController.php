<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminWeeklyPostsNotificationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveSettingRequest;
use App\Model\Admin;
use App\Model\Constants\SettingConstants;
use App\Model\Constants\TimeZone;
use App\Model\Settings;
use Carbon\Carbon;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Settings::class);
        $settings = Settings::orderBy('created_at', 'desc')->get();

        return view('admin.settings.index', compact('settings'));
    }

    public function create()
    {
        $this->authorize('create', Settings::class);
        $days = SettingConstants::DAYS;

        return view('admin.settings.create', compact('days'));

    }

    public function store(SaveSettingRequest $request, Settings $settings)
    {

        $this->authorize('create', Settings::class);
        Settings::create([
            'type' => $request->type,
            'value' => $request->value_utc,
            'days' => $request->days
        ]);

        Session::flash('status', 'Setting is Created');

        return redirect()->route('settings.index', app()->getLocale());

    }


    public function edit(Settings $setting)
    {
        $this->authorize('update', $setting);
        $days = SettingConstants::DAYS;

        return view('admin.settings.edit', compact('setting', 'days'));

    }

    public function update(SaveSettingRequest $request, Settings $setting)
    {
        $this->authorize('update', $setting);
        $setting = $setting->fill([
            'type' => $request->type,
            'value' => $request->value_utc,
            'days' => $request->days
        ]);
        $setting->save();
        Session::flash('status', 'Setting is Updated');

        return redirect()->route('settings.index', app()->getLocale());

    }

    public function destroy(Settings $setting)
    {
        $this->authorize('delete', $setting);
        $setting->delete();

    }
}
