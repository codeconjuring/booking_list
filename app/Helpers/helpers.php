<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Session\flash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

// Return tag string
if (!function_exists('tagString')) {
    /**
     * @return string
     */
    function tagString($tags)
    {
        return implode(',', $tags->pluck('title')->toArray());
    }
}

// Return month name
if (!function_exists('getMonthName')) {
    /**
     * @return string
     */
    function getMonthName($m)
    {
        $month = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "Novemeber", "December");
        return $month[$m - 1];
    }
}

// Return post sub content
if (!function_exists('blogPostSubContent')) {
    /**
     * @return string
     */
    function blogPostSubContent($content)
    {
        return strip_tags(Str::limit($content, 120, '...'));
    }
}

// Get default image
if (!function_exists('getDefaultImage')) {
    /**
     * @return string
     */
    function getDefaultImage()
    {
        return asset('/images/default.png');
    }
}

// Get user default image
if (!function_exists('getUserDefaultImage')) {
    /**
     * @return string
     */
    function getUserDefaultImage()
    {
        return asset('/images/user-default.png');
    }
}

// Get global image
if (!function_exists('getStorageImage')) {
    /**
     * @return string
     */
    function getStorageImage($path, $name)
    {
        if ($name) {
            return asset('/storage/' . $path . '/' . $name);
        }
        return getDefaultImage();
    }
}

// Generate slug
if (!function_exists('generateSlug')) {
    /**
     * @param $value
     * @return string
     */
    function generateSlug($value)
    {
        try {
            return strtolower(preg_replace('/\s+/u', '-', trim($value)));
        } catch (\Exception $e) {
            return '';
        }
    }
}

if (!function_exists('custom_datetime')) {
    /**
     * custom_datetime
     *
     * @param mixed $datetime
     *
     * @return mixed
     */
    function custom_datetime($datetime)
    {
        return date('Y-m-d g:i a', strtotime($datetime));
    }
}

if (!function_exists('get_page_title')) {
    /**
     * get_page_title
     *
     * @param null $title
     *
     * @return string
     */
    function get_page_title($title = null)
    {
        if (session()->has('page_title')) {
            $title = ' | ' . session()->get('page_title');
            session()->forget('page_title');
            return $title;
        }
        return '';
    }
}

if (!function_exists('set_page_title')) {
    /**
     * set_page_title
     *
     * @param null $title
     *
     * @return void
     */
    function set_page_title($title = null)
    {
        session()->put('page_title', $title);
    }
}

if (!function_exists('storagelink')) {
    /**
     * storagelink
     *
     * @param mixed $url
     * @param string $type
     *
     * @return string
     */
    function storagelink($url, $type = "site")
    {
        $defaultImage = config('settings.default_image');
        if ($type == 'user') {
            $defaultImage = config('settings.user_default_image');
        }
        if ($url) {
            return Storage::url($url);
        } else {
            return Storage::url($defaultImage);
        }
    }
}

if (!function_exists('getRandomNumber')) {
    /**
     * getRandomNumber
     *
     * @param int $length
     *
     * @return string
     */
    function getRandomNumber($length = 8)
    {
        $characters = '0123456789';
        $string     = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }
}

if (!function_exists('checkPermission')) {
    /**
     * checkPermission
     *
     * @param mixed $permissions
     *
     * @return void
     */
    function checkPermission($permissions)
    {
        if (!auth()->user()->can($permissions)) {
            abort(403);
        }
    }
}

if (!function_exists('prefixGenerator')) {
    /**
     * prefixGenerator
     *
     * @param Model $model
     * @param string $prefix
     *
     * @return string
     */
    function prefixGenerator(Model $model, $prefix = 'IC-')
    {
        $countNumber = $model::count();
        return $prefix . sprintf('%06d', $countNumber + 1);
    }
}

if (!function_exists('getSetting')) {
    /**
     * getSetting
     *
     * @param string $getColumn
     *
     * @return mixed
     */
    function getSetting($getColumn = '')
    {
        return \Robiussani152\Settings\Models\Settings::get($getColumn);
    }
}

if (!function_exists('setSetting')) {
    /**
     * setSetting
     *
     * @param string $columnName
     * @param string $columnValue
     *
     * @return mixed
     */
    function setSetting($columnName = '', $columnValue = '')
    {
        return \Robiussani152\Settings\Models\Settings::set($columnName, $columnValue);
    }
}

if (!function_exists('removeSetting')) {
    /**
     * removeSetting
     *
     * @param string $columnName
     *
     * @return mixed
     */
    function removeSetting($columnName = '')
    {
        return \Robiussani152\Settings\Models\Settings::forget($columnName);
    }
}

if (!function_exists('getToday')) {
    /**
     * getToday
     *
     * @return mixed
     */
    function getToday()
    {
        return \Carbon\Carbon::parse(now())->format('Y-m-d');
    }
}

if (!function_exists('formateDate')) {
    /**
     * formateDate
     *
     * @param mixed $date
     * @param bool $withTime
     *
     * @return string
     */
    function formateDate($date, $withTime = false)
    {
        if ($withTime) {
            return \Carbon\Carbon::parse($date)->format('Y-m-d h:i a');
        }
        return \Carbon\Carbon::parse($date)->format('Y-m-d');
    }
}

if (!function_exists('getFormateDate')) {
    /**
     * formateDate
     *
     * @param mixed $date
     * @param bool $withTime
     *
     * @return string
     */
    function getFormateDate($date, $withTime = false)
    {
        if ($withTime) {
            return \Carbon\Carbon::parse($date)->format('Y-m-d h:i a');
        }
        if ($date) {
            return \Carbon\Carbon::parse($date)->format('d-m-Y');
        }
        return;
    }
}

if (!function_exists('sendFlash')) {
    /**
     * sendFlash
     *
     * @param mixed $message
     * @param string $type
     *
     * @return void
     */
    function sendFlash($message, $type = 'success')
    {
        if ($type == 'error') {
            Session::flash($type, $message);
        } else {
            Session::flash($type, $message);
        }
    }
}

if (!function_exists('systemSettings')) {
    /**
     * systemSettings
     *
     * @param string $columnName
     * @param string $configName
     *
     * @return string
     */
    function systemSettings($columnName = '', $configName = "settings")
    {
        return config($configName . '.' . $columnName);
    }
}

if (!function_exists('get_page_meta')) {
    /**
     * get_page_meta
     *
     * @param string $metaName
     *
     * @return mixed
     */
    function get_page_meta($metaName = "title")
    {
        if (session()->has('page_meta_' . $metaName)) {
            $title = session()->get("page_meta_" . $metaName);
            session()->forget("page_meta_" . $metaName);
            return $title;
        }
        return null;
    }
}

if (!function_exists('set_page_meta')) {
    /**
     * set_page_meta
     *
     * @param null $content
     * @param string $metaName
     *
     * @return void
     */
    function set_page_meta($content = null, $metaName = "title")
    {
        session()->put('page_meta_' . $metaName, $content);
    }
}

if (!function_exists('associativeToKeyValuePair')) {
    function associativeToKeyValuePair(array $arr)
    {
        $two_d_array = [];
        foreach ($arr as $key => $value) {
            $tmp_class        = new \stdClass();
            $tmp_class->key   = $key;
            $tmp_class->value = $value;
            $two_d_array[]    = $tmp_class;
        }
        return $two_d_array;
    }
}

if (!function_exists('constant_exists')) {
    /**
     * @throws ReflectionException
     */
    function constant_exists($class, $constant_name)
    {
        if (is_object($class) || is_string($class)) {
            $reflect = new ReflectionClass($class);
            return array_key_exists($constant_name, $reflect->getConstants());
        }
        return false;
    }
}

if (!function_exists('fileExplorerStorage')) {
    /**
     * @return \Illuminate\Contracts\Filesystem\Filesystem
     */
    function fileExplorerStorage(): \Illuminate\Contracts\Filesystem\Filesystem
    {
        return Storage::disk('public');
    }
}
