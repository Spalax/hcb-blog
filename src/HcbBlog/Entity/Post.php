<?php
namespace HcbBlog\Entity;

use HcbBlog\Entity\Post\Type;
use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use HcbBlog\Entity\Post\Data;

/**
 * Post
 *
 * @ORM\Table(name="post")
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
     * @var Type
     *
     * @ORM\ManyToOne(targetEntity="HcbBlog\Entity\Post\Type", inversedBy="post")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_type_id", referencedColumnName="id")
     * })
     */
    private $type;

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
     * Constructor
     */
    public function __construct()
    {
        $this->data = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set enabled
     *
     * @param integer $enabled
     * @return Post
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return integer 
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
     * Set type
     *
     * @param \HcbBlog\Entity\Post\Type $type
     * @return Post
     */
    public function setType(\HcbBlog\Entity\Post\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \HcbBlog\Entity\Post\Type 
     */
    public function getType()
    {
        return $this->type;
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
