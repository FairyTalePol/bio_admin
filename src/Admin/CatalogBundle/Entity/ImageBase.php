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
     * @ORM\Column(name="video_url", type="text", nullable=true, unique=false)
     */
    private $video;

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
     * @var string
     *
     * @ORM\Column(name="image2", type="string", nullable=true, unique=false)
     */
    private $image2;

    /**
     * @var File
     * @Assert\File(maxSize="10M")
     */
    private $attachment2;

    /**
     * @var string
     *
     * @ORM\Column(name="image3", type="string", nullable=true, unique=false)
     */
    private $image3;

    /**
     * @var File
     * @Assert\File(maxSize="10M")
     */
    private $attachment3;

    /**
     * @var string
     *
     * @ORM\Column(name="image4", type="string", nullable=true, unique=false)
     */
    private $image4;

    /**
     * @var File
     * @Assert\File(maxSize="10M")
     */
    private $attachment4;

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
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param string $video
     * @return ImageBase
     */
    public function setVideo($video)
    {
        $this->video = $video;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage2()
    {
        return $this->image2;
    }

    /**
     * @param string $image2
     * @return ImageBase
     */
    public function setImage2($image2)
    {
        $this->image2 = $image2;
        return $this;
    }

    /**
     * @return File
     */
    public function getAttachment2()
    {
        return $this->attachment2;
    }

    /**
     * @param File $attachment2
     * @return ImageBase
     */
    public function setAttachment2($attachment2)
    {
        if ($attachment2 && $attachment2 instanceof File) {
            $this->image2 = md5(uniqid()) . '.' . $attachment2->guessExtension();
            $this->attachment2 = $attachment2;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getImage3()
    {
        return $this->image3;
    }

    /**
     * @param string $image3
     * @return ImageBase
     */
    public function setImage3($image3)
    {
        $this->image3 = $image3;
        return $this;
    }

    /**
     * @return File
     */
    public function getAttachment3()
    {
        return $this->attachment3;
    }

    /**
     * @param File $attachment3
     * @return ImageBase
     */
    public function setAttachment3($attachment3)
    {
        if ($attachment3 && $attachment3 instanceof File) {
            $this->image3 = md5(uniqid()) . '.' . $attachment3->guessExtension();
            $this->attachment3 = $attachment3;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getImage4()
    {
        return $this->image4;
    }

    /**
     * @param string $image4
     * @return ImageBase
     */
    public function setImage4($image4)
    {
        $this->image4 = $image4;
        return $this;
    }

    /**
     * @return File
     */
    public function getAttachment4()
    {
        return $this->attachment4;
    }

    /**
     * @param File $attachment4
     * @return ImageBase
     */
    public function setAttachment4($attachment4)
    {
        if ($attachment4 && $attachment4 instanceof File) {
            $this->image4 = md5(uniqid()) . '.' . $attachment4->guessExtension();
            $this->attachment4 = $attachment4;
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
//            return;
        } else {
            $fullPath = __DIR__ . '/../Resources/public/images/' . static::$img_dir . '/original/' . $this->image;
            $this->attachment->move(__DIR__ . '/../Resources/public/images/' . static::$img_dir . '/original/', $this->image);

            $im = new \Imagick($fullPath);
            $im->cropThumbnailImage(static::$logo_size['width'], static::$logo_size['height']);
            $im->writeImage(__DIR__ . '/../Resources/public/images/' . static::$img_dir . '/logo/' . $this->image);

            $im = new \Imagick($fullPath);
            $im->thumbnailImage(static::$full_size['width'], static::$full_size['height'], true);
            $im->writeImage(__DIR__ . '/../Resources/public/images/' . static::$img_dir . '/full/' . $this->image);
        }

        if (!$this->attachment2 || !($this->attachment2 instanceof File) || !$this->image2) {
//            return;
        } else {
            $fullPath = __DIR__ . '/../Resources/public/images/' . static::$img_dir . '/original/' . $this->image2;
            $this->attachment2->move(__DIR__ . '/../Resources/public/images/' . static::$img_dir . '/original/', $this->image2);

            $im = new \Imagick($fullPath);
            $im->cropThumbnailImage(static::$logo_size['width'], static::$logo_size['height']);
            $im->writeImage(__DIR__ . '/../Resources/public/images/' . static::$img_dir . '/logo/' . $this->image2);

            $im = new \Imagick($fullPath);
            $im->thumbnailImage(static::$full_size['width'], static::$full_size['height'], true);
            $im->writeImage(__DIR__ . '/../Resources/public/images/' . static::$img_dir . '/full/' . $this->image2);
        }

        if (!$this->attachment3 || !($this->attachment3 instanceof File) || !$this->image3) {
//            return;
        } else {
            $fullPath = __DIR__ . '/../Resources/public/images/' . static::$img_dir . '/original/' . $this->image3;
            $this->attachment3->move(__DIR__ . '/../Resources/public/images/' . static::$img_dir . '/original/', $this->image3);

            $im = new \Imagick($fullPath);
            $im->cropThumbnailImage(static::$logo_size['width'], static::$logo_size['height']);
            $im->writeImage(__DIR__ . '/../Resources/public/images/' . static::$img_dir . '/logo/' . $this->image3);

            $im = new \Imagick($fullPath);
            $im->thumbnailImage(static::$full_size['width'], static::$full_size['height'], true);
            $im->writeImage(__DIR__ . '/../Resources/public/images/' . static::$img_dir . '/full/' . $this->image3);
        }

        if (!$this->attachment4 || !($this->attachment4 instanceof File) || !$this->image4) {
//            return;
        } else {
            $fullPath = __DIR__ . '/../Resources/public/images/' . static::$img_dir . '/original/' . $this->image4;
            $this->attachment4->move(__DIR__ . '/../Resources/public/images/' . static::$img_dir . '/original/', $this->image4);

            $im = new \Imagick($fullPath);
            $im->cropThumbnailImage(static::$logo_size['width'], static::$logo_size['height']);
            $im->writeImage(__DIR__ . '/../Resources/public/images/' . static::$img_dir . '/logo/' . $this->image4);

            $im = new \Imagick($fullPath);
            $im->thumbnailImage(static::$full_size['width'], static::$full_size['height'], true);
            $im->writeImage(__DIR__ . '/../Resources/public/images/' . static::$img_dir . '/full/' . $this->image4);
        }
    }

}