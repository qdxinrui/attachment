<?php
namespace Xr\Attachment\Library;
use Xr\Attachment\Library\Contracts\StorageDriver;
abstract class AbstractCloudStorage implements StorageDriver
{
    abstract public function upload($file, $path = null):string;
}