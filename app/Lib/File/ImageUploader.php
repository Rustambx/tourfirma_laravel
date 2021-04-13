<?php
namespace App\Lib\File;
use Illuminate\Http\UploadedFile;

/**
 * Класс для сохранения картинок
 * Class ImageUploader
 * @package App\Lib\File
 */
class ImageUploader
{
    private $image = null;
    private $savedImage = null;

    /**
     * Доступные име типы
     * @var array
     */
    private $accessType = [
        "image/jpeg",
        "image/png"
    ];


    public function __construct($image)
    {
        $this->image = $image;
    }

    /**
     * Проверка миме типа файла
     * @return bool
     */
    public function checkMimeType ()
    {
        $mimeType = $this->image->getMimeType();
        if (in_array($mimeType, $this->accessType)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Сохранение файла
     * @param $path
     * @return string
     */
    public function save ($path)
    {
        $uniqFileName = uniqid();
        $extension = $this->image->getClientOriginalExtension();
        $fileName = $uniqFileName . '.' . $extension;
        $realPath = public_path() . $path;
        $this->savedImage = $this->image->move($realPath, $fileName);
        return $path . '/' . $fileName;
    }

    /**
     * Возврашение объекта сохраненного файла
     * @return UploadedFile
     */
    public function getSavedImage ()
    {
        return $this->savedImage;
    }

}
