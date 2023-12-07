<?php
namespace Xr\Attachment;
use InvalidArgumentException;
use Xr\Attachment\Library\Contracts\StorageDriver;
class AttachmentUpload
{
    /**
     * The array of created "drivers".
     *
     * @var array
     */
    protected static $drivers = [];

    /**
     * @param array $options
     * @return StorageDriver
     */
    public static function init($type = 'Local', array $options = []) : StorageDriver
    {
        if (empty($options)) {
            $options = config('app.token');
        }
        return self::$drivers[$type] ?? self::$drivers[$type] = self::resolve($type, $options);
    }
    /**
     * @param string $type
     * @param array $options
     * @return StorageDriver
     */
    protected static function resolve(string $type = 'Local', array $options = []) : StorageDriver
    {
        $class = false === strpos($type, '\\') ? '\\Xr\\Attachment\\Library\\Drivers\\' . ucwords($type) . 'CloudStorageDriver' : $type;
        if(class_exists($class)){
            self::$drivers[$type] = new $class($options);
            return new self::$drivers[$type];
        }
        throw new InvalidArgumentException(
            "AttachmentUpload driver [{$type}] for guard [{$type}] is not defined."
        );
    }
}