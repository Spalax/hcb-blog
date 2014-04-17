<?php
namespace HcbBlog\Entity\Post;

use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use HcbBlog\Entity\Post;

/**
 * Type
 *
 * @ORM\Table(name="post_type")
 * @ORM\Entity
 */
class Type implements EntityInterface
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
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name = '';

    /**
     * @var Post
     *
     * @ORM\OneToMany(targetEntity="HcbBlog\Entity\Post", mappedBy="type")
     */
    private $post;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->post = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Type
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add post
     *
     * @param \HcbBlog\Entity\Post $post
     * @return Type
     */
    public function addPost(\HcbBlog\Entity\Post $post)
    {
        $this->post[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \HcbBlog\Entity\Post $post
     */
    public function removePost(\HcbBlog\Entity\Post $post)
    {
        $this->post->removeElement($post);
    }

    /**
     * Get post
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPost()
    {
        return $this->post;
    }
}
