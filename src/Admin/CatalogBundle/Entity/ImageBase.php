<?php

namespace Admin\CatalogBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ImageBase
 * @package Admin\CatalogBundle\Entity
 * @ORM\MappedSuperclass()
 * @ORM\HasLifecycleCallbacks()
 */
abstract class ImageBase extends CUBase {
    public static $logo_size = [
        'width' => 60,
        'height' => 60
    ];

    public static $full_size = [
        'width' => 500,
        'height' => 500
    ];

    protected static $img_dir = 'vermin';

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", nullable=true, unique=false)
     */
    private $image;

    /**
     * @var File
     * @Assert\File(maxSize="10M")
     */
    private $attachment;

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return ImageBase
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return File
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * @param File $attachment
     * @return ImageBase
     */
    public function setAttachment(File $attachment)
    {
        if ($attachment && $attachment instanceof File) {
            $this->image = md5(uniqid()) . '.' . $attachment->guessExtension();
            $this->attachment = $attachment;
        }
        return $this;
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function saveImage()
    {
        if (!$this->attachment || !($this->attachment instanceof File) || !$this->image) {
            return;
        }

        $fullPath = __DIR__ . '/../Resources/public/images/' . static::$img_dir . '/original/' . $this->image;
        $this->attachment->move(__DIR__ . '/../Resources/public/images/' . static::$img_dir . '/original/', $this->image);

        $im = new \Imagick($fullPath);
        $im->cropThumbnailImage(static::$logo_size['width'], static::$logo_size['height']);
        $im->writeImage(__DIR__ . '/../Resources/public/images/' . static::$img_dir . '/logo/' . $this->image);

        $im = new \Imagick($fullPath);
        $im->thumbnailImage(static::$full_size['width'], static::$full_size['height'], true);
        $im->writeImage(__DIR__ . '/../Resources/public/images/' . static::$img_dir . '/full/' . $this->image);
    }

}