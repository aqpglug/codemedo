<?php

namespace Aqpglug\CodemedoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Aqpglug\CodemedoBundle\Repository\BlockRepository");
 * @ORM\Table(indexes={@ORM\Index("slug_idx", columns={"slug"}),
 *                     @ORM\Index("type_idx", columns={"type"})})
 */
class Block
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /** @ORM\Column(type="string", length="30") */
    protected $type;
    /** @ORM\Column(type="string", length="255") */
    protected $title;
    /** @ORM\Column(type="string", length="255") */
    protected $slug;
    /** @ORM\Column(type="text", nullable="true") */
    protected $content;
    /** @ORM\Column(type="string", length="255", nullable="true") */
    protected $image;
    /** @ORM\Column(type="array", nullable="true") */
    protected $metadata;
    /** @ORM\Column(type="boolean") */
    protected $published;
    /** @ORM\Column(type="boolean") */
    protected $featured;
    /** @ORM\Column(type="datetime") */
    protected $created;
    /** @ORM\Column(type="datetime") */
    protected $modified;

    public function __construct()
    {
        $this->created = $this->modified = new \DateTime("now");
    }

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        $this->slug = $title; // TODO: hacer slug
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getMetadata()
    {
        return $this->metadata;
    }

    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
    }

    public function getPublished()
    {
        return $this->published;
    }

    public function setPublished($published)
    {
        $this->published = $published;
    }

    public function getFeatured()
    {
        return $this->featured;
    }

    public function setFeatured($featured)
    {
        $this->featured = $featured;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }

    public function getModified()
    {
        return $this->modified;
    }

    public function setModified($modified)
    {
        $this->modified = $modified;
    }

}