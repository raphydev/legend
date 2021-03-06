<?php

namespace Labs\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BannerImage
 *
 * @ORM\Table(name="banner_image")
 * @ORM\Entity(repositoryClass="Labs\BackBundle\Repository\BannerImageRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class BannerImage
{
    /**
     * @var integer
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
     * @Vich\UploadableField(mapping="banner_image", fileNameProperty="imageName")
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
     * @ORM\Column(name="title", type="string", length=225, nullable=true)
     */
    protected $title;

    /**
     * @var string
     * @Assert\NotBlank(message="Entrez le nom de la bannière avant de continuer")
     * @ORM\Column(name="name", type="string", length=225, nullable=true)
     */
    protected $name;



    /**
     * @var dateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    protected $created;


    /**
     * @var
     *
     * @ORM\Column(name="online", type="boolean")
     */
    protected $online;


    /**
     * @var
     * @ORM\OneToMany(targetEntity="Labs\BackBundle\Entity\About", mappedBy="bannerImage")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true)
     */
    protected $about;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="Labs\BackBundle\Entity\Demand", mappedBy="bannerImage")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true)
     */
    protected $demand;



    public function __construct()
    {
        $this->created = new \DateTime('now');
        $this->online = true;
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set title
     *
     * @param string $title
     *
     * @return Banner
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
        return 'uploads/banners';
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
     * @return mixed
     */
    public function getOnline()
    {
        return $this->online;
    }


    /**
     * @param mixed $online
     */
    public function setOnline($online)
    {
        $this->online = $online;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }



    /**
     * Add about
     *
     * @param \Labs\BackBundle\Entity\About $about
     *
     * @return BannerImage
     */
    public function addAbout(\Labs\BackBundle\Entity\About $about)
    {
        $this->about[] = $about;

        return $this;
    }

    /**
     * Remove about
     *
     * @param \Labs\BackBundle\Entity\About $about
     */
    public function removeAbout(\Labs\BackBundle\Entity\About $about)
    {
        $this->about->removeElement($about);
    }

    /**
     * Get about
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Add demand
     *
     * @param \Labs\BackBundle\Entity\Demand $demand
     *
     * @return BannerImage
     */
    public function addDemand(\Labs\BackBundle\Entity\Demand $demand)
    {
        $this->demand[] = $demand;

        return $this;
    }

    /**
     * Remove demand
     *
     * @param \Labs\BackBundle\Entity\Demand $demand
     */
    public function removeDemand(\Labs\BackBundle\Entity\Demand $demand)
    {
        $this->demand->removeElement($demand);
    }

    /**
     * Get demand
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDemand()
    {
        return $this->demand;
    }
}
