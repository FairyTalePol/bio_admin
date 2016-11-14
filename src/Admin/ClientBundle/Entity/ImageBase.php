<?php

namespace Admin\ClientBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CUBase
 * @package Admin\ClientBundle\Entity
 * @ORM\MappedSuperclass()
 * @ORM\HasLifecycleCallbacks()
 */
abstract class ImageBase extends CUBase {

    protected static $_dir = __DIR__;

    public static $logo_size = [
        'width' => 60,
        'height' => 60
    ];

    public static $full_size = [
        'width' => 500,
        'height' => 500
    ];

    protected static $img_dir = 'catalog';

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
            $this->image = md5(uniqid(rand(1, 1000), true)) . '.' . $attachment->guessExtension();
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

        $fullPath = static::$_dir . '/../Resources/public/images/' . static::$img_dir . '/original/' . $this->image;
        $this->attachment->move(static::$_dir . '/../Resources/public/images/' . static::$img_dir . '/original/', $this->image);

        $im = new \Imagick($fullPath);
        $im->cropThumbnailImage(static::$logo_size['width'], static::$logo_size['height']);
        $im->writeImage(static::$_dir . '/../Resources/public/images/' . static::$img_dir . '/logo/' . $this->image);

        $im = new \Imagick($fullPath);
        $im->thumbnailImage(static::$full_size['width'], static::$full_size['height'], true);
        $im->writeImage(static::$_dir . '/../Resources/public/images/' . static::$img_dir . '/full/' . $this->image);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($this->image) {
            @unlink(static::$_dir . '/../Resources/public/images/' . static::$img_dir . '/original/' . $this->image);
            @unlink(static::$_dir . '/../Resources/public/images/' . static::$img_dir . '/logo/' . $this->image);
            @unlink(static::$_dir . '/../Resources/public/images/' . static::$img_dir . '/full/' . $this->image);
        }
    }

}