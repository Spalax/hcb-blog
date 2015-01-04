<?php
namespace HcbBlog\Entity\Post;

use HcCore\Entity\EntityInterface;
use HcBackend\Entity\PageBindInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use HcBackend\Entity\PageInterface;
use HcbBlog\Entity\Post;
use HcBackend\Entity\ImageBindInterface;
use Zf2FileUploader\Entity\ImageInterface;

/**
 * PostData
 *
 * @ORM\Table(name="post_data")
 * @ORM\Entity
 */
class Data implements EntityInterface, ImageBindInterface, PageBindInterface
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=500, nullable=false)
     */
    private $title = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=6, nullable=false)
     */
    private $lang = '';

    /**
     * @var string
     *
     * @ORM\Column(name="preview", type="string", length=1024, nullable=false)
     */
    private $preview = '';

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content = '';

    /**
     * @var Post
     *
     * @ORM\ManyToOne(targetEntity="HcbBlog\Entity\Post", inversedBy="data")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     * })
     */
    private $post = null;

    /**
     * @var Page
     *
     * @ORM\OneToOne(targetEntity="HcBackend\Entity\Page")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="page_id", referencedColumnName="id")
     * })
     */
    private $page = null;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="HcBackend\Entity\Image", cascade={"persist"})
     * @ORM\JoinTable(name="post_data_image",
     *   joinColumns={
     *     @ORM\JoinColumn(name="post_data_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     *   }
     * )
     */
    private $image;

    /**
     * @var \HcbBlog\Entity\Post\Data\Image
     *
     * @ORM\OneToMany(targetEntity="HcbBlog\Entity\Post\Data\Image", mappedBy="data")
     *
     */
    private $dataImage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_timestamp", type="datetime", nullable=false)
     */
    private $updatedTimestamp;

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
     * Set page
     *
     * @param \HcBackend\Entity\PageInterface $page
     * @return Data
     */
    public function setPage(PageInterface $page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \HcBackend\Entity\Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Add image
     *
     * @param ImageInterface $image
     * @return Data
     */
    public function addImage(ImageInterface $image)
    {
        $this->image[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param ImageInterface $image
     */
    public function removeImage(ImageInterface $image)
    {
        $this->image->removeElement($image);
    }

    /**
     * Get image
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Data
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
     * Set lang
     *
     * @param string $lang
     * @return Data
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string 
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set preview
     *
     * @param string $preview
     * @return Data
     */
    public function setPreview($preview)
    {
        $this->preview = $preview;

        return $this;
    }

    /**
     * Get preview
     *
     * @return string 
     */
    public function getPreview()
    {
        return $this->preview;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Data
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set updatedTimestamp
     *
     * @param \DateTime $updatedTimestamp
     * @return Data
     */
    public function setUpdatedTimestamp($updatedTimestamp)
    {
        $this->updatedTimestamp = $updatedTimestamp;

        return $this;
    }

    /**
     * Get updatedTimestamp
     *
     * @return \DateTime 
     */
    public function getUpdatedTimestamp()
    {
        return $this->updatedTimestamp;
    }

    /**
     * Set createdTimestamp
     *
     * @param \DateTime $createdTimestamp
     * @return Data
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
     * Set post
     *
     * @param \HcbBlog\Entity\Post $post
     * @return Data
     */
    public function setPost(\HcbBlog\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \HcbBlog\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Add dataImage
     *
     * @param \HcbBlog\Entity\Post\Data\Image $dataImage
     * @return Data
     */
    public function addDataImage(\HcbBlog\Entity\Post\Data\Image $dataImage)
    {
        $this->dataImage[] = $dataImage;

        return $this;
    }

    /**
     * Remove dataImage
     *
     * @param \HcbBlog\Entity\Post\Data\Image $dataImage
     */
    public function removeDataImage(\HcbBlog\Entity\Post\Data\Image $dataImage)
    {
        $this->dataImage->removeElement($dataImage);
    }

    /**
     * Get dataImage
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDataImage()
    {
        return $this->dataImage;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->image = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dataImage = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
