<?php
/**
 * This file is part of the Aseagle package.
 *
 * (c) Quang Tran <quang.tran@aseagle.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Aseagle\Bundle\EcommerceBundle\Entity;

/**
 * Image Entity 
 *
 * @author Quang Tran <quang.tran@aseagle.com>
 */
class Image {
    
    const TYPE_THUMB = 1;
    const TYPE_BASE = 2;
    const TYPE_SMALL = 3;
    
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $ordering;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var integer
     */
    private $type;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Aseagle\Bundle\EcommerceBundle\Entity\Product
     */
    private $product;


    /**
     * Set name
     *
     * @param string $name
     * @return Image
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
     * Set ordering
     *
     * @param integer $ordering
     * @return Image
     */
    public function setOrdering($ordering)
    {
        $this->ordering = $ordering;

        return $this;
    }

    /**
     * Get ordering
     *
     * @return integer 
     */
    public function getOrdering()
    {
        return $this->ordering;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Image
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

    /**
     * Set type
     *
     * @param integer $type
     * @return Image
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
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
     * @param integer $id
     * @return \Aseagle\Bundle\EcommerceBundle\Entity\Image
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * Set product
     *
     * @param \Aseagle\Bundle\EcommerceBundle\Entity\Product $product
     * @return Image
     */
    public function setProduct(\Aseagle\Bundle\EcommerceBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Aseagle\Bundle\EcommerceBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
    /**
     * PrePersist
     */
    public function updatedTimestamp()
    {
        if($this->getCreated() == null)
    	{
    		$this->setCreated(new \DateTime(date('Y-m-d H:i:s')));
    	}
    }
    /**
     * @var string
     */
    private $path;


    /**
     * Set path
     *
     * @param string $path
     * @return Image
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }
    /**
     * @var boolean
     */
    private $thumb;


    /**
     * Set thumb
     *
     * @param boolean $thumb
     * @return Image
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;

        return $this;
    }

    /**
     * Get thumb
     *
     * @return boolean 
     */
    public function getThumb()
    {
        return $this->thumb;
    }
}
