<?php
namespace Xr\Attachment\Library\Drivers;
use Illuminate\Support\Facades\Storage;
use Xr\Attachment\Library\AbstractCloudStorage;
class LocalCloudStorageDriver extends AbstractCloudStorage
{
    public function upload($file, $path = null):string
    {
        $path = Storage::putFile($path, $file);
        return $path;
    }
}