<?php
namespace App\Upload;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class FileItemTypeUpload
{
    private $targetDirectory;
    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }
    public function upload(Product $product)
    {
        if ($product->getPhoto() !== null) {
            $fileName = md5(uniqid()).'.'.$product->getPhoto()->guessExtension();
            try {
                $product->getPhoto()->move($this->getTargetDirectory(), $fileName);
                $product->setPhoto($fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
                throw new \Exception('Error when upload picture');
            }
        }
    }
    public function removeFile(Product $product)
    {
        if ($product->getPhoto()  !== null) {
            return \unlink($this->getTargetDirectory().Product::UPLOAD_DIRECTORY.'/'.$product->getPhoto());
        }
        return true;
    }
    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}