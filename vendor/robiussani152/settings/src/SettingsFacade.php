<?php
namespace Robiussani152\Settings;
use \Robiussani152\Settings\Models\Settings;
class SettingsFacade{
    public function set($key="", $value="")
    {
        Settings::updateOrCreate([
            'setting_key'=>$key
        ],[
            'setting_value'=>$value
        ]);
        return;
    }

    public function get($key="")
    {
        $settings = Settings::where('setting_key', $key)
            ->first();

        return $settings?$settings->setting_value:null;
    }

    public function forget($key="")
    {
        $settings = Settings::where('setting_key', $key)
            ->delete();

        return;
    }

    public function all()
    {
        $settings = Settings::get();

        return $settings;
    }
}
