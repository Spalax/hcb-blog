<?php
namespace HcbBlog\Entity\Post\Data;

use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="post_data_image")
 * @ORM\Entity
 */
class Image implements EntityInterface
{
    /**
     * @var \Zf2FileUploader\Entity\Image
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="\Zf2FileUploader\Entity\Image")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     * })
     */
    private $image;

    /**
     * @var \HcbBlog\Entity\Post\Data
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="\HcbBlog\Entity\Post\Data", inversedBy="image")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_data_id", referencedColumnName="id")
     * })
     */
    private $data;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_preview", type="boolean", nullable=false)
     */
    private $isPreview = false;

    /**
     * Set isPreview
     *
     * @param boolean $isPreview
     * @return Image
     */
    public function setIsPreview($isPreview)
    {
        $this->isPreview = $isPreview;

        return $this;
    }

    /**
     * Get isPreview
     *
     * @return boolean 
     */
    public function getIsPreview()
    {
        return $this->isPreview;
    }

    /**
     * Set image
     *
     * @param \Zf2FileUploader\Entity\Image $image
     * @return Image
     */
    public function setImage(\Zf2FileUploader\Entity\Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Zf2FileUploader\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set data
     *
     * @param \HcbBlog\Entity\Post\Data $data
     * @return Image
     */
    public function setData(\HcbBlog\Entity\Post\Data $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \HcbBlog\Entity\Post\Data 
     */
    public function getData()
    {
        return $this->data;
    }
}
