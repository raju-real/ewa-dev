<?php
/**
 * Required sign for from label
 */

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

if(!function_exists('starSign')){
    function starSign(): string
    {
        return "<span class='text-danger'>"." *"."</span>";
    }
}

/**
 * Return saved message with type
 */
if(! function_exists('successMessage')) {
    function successMessage($message="Information has been saved successfully!"): array
    {
        return [
            'type' => 'success',
            'message' => $message
        ];
    }
}

/**
 * Return delete message with type
 */
if(! function_exists('updateMessage')) {
    function updateMessage($message="Information has been updated successfully!"): array
    {
        return [
            'type' => 'info',
            'message' => $message
        ];
    }
}

/**
 * Return delete message with type
 */
if(! function_exists('deleteMessage')) {
    function deleteMessage($message="Information has been deleted successfully!"): array
    {
        return [
            'type' => 'success',
            'message' => $message
        ];
    }
}

/**
 * Return warning message
 */
if(! function_exists('warningMessage')) {
    function warningMessage($message="Something is wrong!"): array
    {
        return [
            'type' => 'success',
            'message' => $message
        ];
    }
}

/**
 * Fetch Username by id
 */
if(! function_exists('userNameById')) {
    function userNameById($id): string
    {
        return \App\Models\User::find($id)->name ?? "N/A";
    }
}

/**
 * Return string with limit
 */
if(! function_exists('strLimit')) {
    function strLimit($string,$length=50)
    {
        return Str::limit($string,$length,'...');
    }
}

/**
 * Upload image
 */
if (! function_exists('uploadImage')) {
    function uploadImage($file,$path="assets/files/",$width="",$height="",$size="",$name=""): string
    {
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $imageName = $name."-".time().$file->getClientOriginalName();
        $image = Image::make($file->getPathname());
        if((isset($height)) AND (isset($width))) {
            $image->resize($width, $height);
        }
        if(isset($size)) {
            $image->filesize($size);
        }
        $image->save($path .$imageName);
        return $path.$imageName;
    }
}

/**
 * Check file is image
 */
if(! function_exists('isImage')) {
    function isImage($file) {
        $file_type = $file->getClientMimeType();
        $text = explode('/',$file_type)[0];
        if($text == "image") {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Get file extension
 */
if(! function_exists('fileExtension')) {
    function fileExtension($file) {
        if(isset($file)) {
            return $file->getClientOriginalExtension();
        } else {
            return "Inalid file";
        }
    }
}

/**
 * Get file type
 */
if(! function_exists('imageWidthHeight')) {
    function imageWidthHeight($image) {
        $img_size_array = getimagesize($image);
        $width = $img_size_array[0];
        $height = $img_size_array[1];
        return array('width' => $width,'height' => $height);
    }
}

/**
 * Get path image info
 */
if(! function_exists('pathImageInfo')) {
    function pathImageInfo($path) {
        $image = Image::make($path);
        return [
            'type' => explode('/',$image->mime())[0],
            'extension' => explode('/',$image->mime())[1],
            'height' => $image->height(),
            'width' => $image->width(),
        ];
    }
}

/**
 * Upload file
 */
if (! function_exists('uploadFile')) {
    function uploadFile($file,$path="assets/files/"): string
    {
        $uniqueFileName = $file->getClientOriginalName().'-'. time().'-' . '.'.$file->getClientOriginalExtension();
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $file->move($path,$uniqueFileName);
        return $path.$uniqueFileName;
    }
}

/**
 * Get pusher info from file
 */
if(!function_exists('siteSetting')) {
    function siteSetting() {
        if(file_exists('assets/json/site_setting.json')) {
            $jsonString = File::get('assets/json/site_setting.json');
            return json_decode($jsonString,true);
        } else {
            return "";
        }
    }
}

/**
 * Get blood group list
 */
if(! function_exists('bloodGroups')) {
    function bloodGroups(): array
    {
        return ["A+","A-","B+","B-","O+","O-","AB+","AB-"];
    }
}

/**
 * Get admin id
 */
if(! function_exists('adminId')) {
    function adminId() {
        return \App\Models\User::where('role','admin')->first()->id;
    }
}

/**
 * Save notification
 */
if(! function_exists('saveNotification')) {
    function saveNotification($user_for,$title,$text,$redirect_link) {
        $notification = new \App\Models\Notification();
        $notification->user_for = $user_for;
        $notification->title = $title;
        $notification->text = $text;
        $notification->redirect_link = $redirect_link;
        $notification->save();
    }
}

/**
 * Approve members
 */
if(! function_exists('approveMembers')) {
    function approveMembers() {
        return \App\Models\User::where('approve_status','yes')->get();
    }
}


