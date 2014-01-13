<?php
namespace HcbBlog\Entity;

use HcBackend\Entity\EntityInterface;
use HcBackend\Entity\Page;
use HcBackend\Entity\PageBindInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use HcbBlog\Entity\Post\Data;
use Zf2FileUploader\Entity\ImageBindInterface;
use Zf2FileUploader\Entity\ImageInterface;

/**
 * Post
 *
 * @ORM\Table(name="blog_post")
 * @ORM\Entity
 */
class Post implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="enabled", type="integer", nullable=false)
     */
    private $enabled = 0;

    /**
     * @var Data
     *
     * @ORM\OneToMany(targetEntity="HcbBlog\Entity\Post\Data", mappedBy="post")
     * @ORM\OrderBy({"updatedTimestamp" = "DESC"})
     */
    private $data = null;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_timestamp", type="datetime", nullable=false)
     */
    private $createdTimestamp;

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
     * Set enabled
     *
     * @param int $enabled
     * @return Data
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return int
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set createdTimestamp
     *
     * @param \DateTime $createdTimestamp
     * @return Post
     */
    public function setCreatedTimestamp($createdTimestamp)
    {
        $this->createdTimestamp = $createdTimestamp;

        return $this;
    }

    /**
     * Get createdTimestamp
     *
     * @return \DateTime 
     */
    public function getCreatedTimestamp()
    {
        return $this->createdTimestamp;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->data = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add data
     *
     * @param \HcbBlog\Entity\Post\Data $data
     * @return Post
     */
    public function addDatum(\HcbBlog\Entity\Post\Data $data)
    {
        $this->data[] = $data;

        return $this;
    }

    /**
     * Remove data
     *
     * @param \HcbBlog\Entity\Post\Data $data
     */
    public function removeDatum(\HcbBlog\Entity\Post\Data $data)
    {
        $this->data->removeElement($data);
    }

    /**
     * Get data
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getData()
    {
        return $this->data;
    }
}
