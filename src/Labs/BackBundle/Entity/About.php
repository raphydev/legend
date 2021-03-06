<?php

namespace Labs\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * About
 *
 * @ORM\Table(name="about")
 * @ORM\Entity(repositoryClass="Labs\BackBundle\Repository\AboutRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class About
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\File(
     *     maxSize="3M",
     *     mimeTypes={"image/png", "image/jpeg", "image/jpg"}
     * )
     *
     * @Vich\UploadableField(mapping="banner_image_page", fileNameProperty="imageName")
     *
     * @var File $imageFile
     */
    protected $imageFile;

    /**
     * @var string $imageName
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $imageName;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=255)
     */
    protected $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="title_why", type="string", length=255)
     */
    protected $titleWhy;

    /**
     * @var string
     *
     * @ORM\Column(name="title_mission", type="string", length=255)
     */
    protected $titleMission;

    /**
     * @var string
     *
     * @ORM\Column(name="title_do", type="string", length=255)
     */
    protected $titleDo;

    /**
     * @var string
     *
     * @ORM\Column(name="content_why", type="text")
     */
    protected $contentWhy;

    /**
     * @var string
     *
     * @ORM\Column(name="content_mission", type="text")
     */
    protected $contentMission;

    /**
     * @var string
     *
     * @ORM\Column(name="content_do", type="text")
     */
    protected $contentDo;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255)
     */
    protected $video;

    /**
     * @var string
     *
     * @ORM\Column(name="content_video", type="text")
     */
    protected $contentVideo;

    /**
     * @var string
     *
     * @ORM\Column(name="title_video", type="string", length=255)
     */
    protected $titleVideo;


    /**
     * @var dateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    protected $created;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Labs\BackBundle\Entity\BannerImage", inversedBy="about")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true)
     */
    protected $bannerImage;


    public function __construct()
    {
        $this->created = new \DateTime('now');
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->created = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     *
     * @return Banner
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return About
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     *
     * @return About
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set titleWhy
     *
     * @param string $titleWhy
     *
     * @return About
     */
    public function setTitleWhy($titleWhy)
    {
        $this->titleWhy = $titleWhy;

        return $this;
    }

    /**
     * Get titleWhy
     *
     * @return string
     */
    public function getTitleWhy()
    {
        return $this->titleWhy;
    }

    /**
     * Set titleMission
     *
     * @param string $titleMission
     *
     * @return About
     */
    public function setTitleMission($titleMission)
    {
        $this->titleMission = $titleMission;

        return $this;
    }

    /**
     * Get titleMission
     *
     * @return string
     */
    public function getTitleMission()
    {
        return $this->titleMission;
    }

    /**
     * Set titleDo
     *
     * @param string $titleDo
     *
     * @return About
     */
    public function setTitleDo($titleDo)
    {
        $this->titleDo = $titleDo;

        return $this;
    }

    /**
     * Get titleDo
     *
     * @return string
     */
    public function getTitleDo()
    {
        return $this->titleDo;
    }

    /**
     * Set contentWhy
     *
     * @param string $contentWhy
     *
     * @return About
     */
    public function setContentWhy($contentWhy)
    {
        $this->contentWhy = $contentWhy;

        return $this;
    }

    /**
     * Get contentWhy
     *
     * @return string
     */
    public function getContentWhy()
    {
        return $this->contentWhy;
    }

    /**
     * Set contentMission
     *
     * @param string $contentMission
     *
     * @return About
     */
    public function setContentMission($contentMission)
    {
        $this->contentMission = $contentMission;

        return $this;
    }

    /**
     * Get contentMission
     *
     * @return string
     */
    public function getContentMission()
    {
        return $this->contentMission;
    }

    /**
     * Set contentDo
     *
     * @param string $contentDo
     *
     * @return About
     */
    public function setContentDo($contentDo)
    {
        $this->contentDo = $contentDo;

        return $this;
    }

    /**
     * Get contentDo
     *
     * @return string
     */
    public function getContentDo()
    {
        return $this->contentDo;
    }

    /**
     * Set video
     *
     * @param string $video
     *
     * @return About
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set contentVideo
     *
     * @param string $contentVideo
     *
     * @return About
     */
    public function setContentVideo($contentVideo)
    {
        $this->contentVideo = $contentVideo;

        return $this;
    }

    /**
     * Get contentVideo
     *
     * @return string
     */
    public function getContentVideo()
    {
        return $this->contentVideo;
    }

    /**
     * Set titleVideo
     *
     * @param string $titleVideo
     *
     * @return About
     */
    public function setTitleVideo($titleVideo)
    {
        $this->titleVideo = $titleVideo;

        return $this;
    }

    /**
     * Get titleVideo
     *
     * @return string
     */
    public function getTitleVideo()
    {
        return $this->titleVideo;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Banner
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    public function getUploadDir()
    {
        // On retourne le chemin relatif vers l'image pour un navigateur
        return 'uploads/pages';
    }


    protected function getUploadRootDir()
    {
        // On retourne le chemin relatif vers l'image pour notre code PHP
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }



    /**
     * @return string
     */
    public function getAssertPath()
    {
        return $this->getUploadDir().'/'.$this->imageName;
    }


    /**
     * Set bannerImage
     *
     * @param \Labs\BackBundle\Entity\BannerImage $bannerImage
     *
     * @return About
     */
    public function setBannerImage(\Labs\BackBundle\Entity\BannerImage $bannerImage = null)
    {
        $this->bannerImage = $bannerImage;

        return $this;
    }

    /**
     * Get bannerImage
     *
     * @return \Labs\BackBundle\Entity\BannerImage
     */
    public function getBannerImage()
    {
        return $this->bannerImage;
    }
}
