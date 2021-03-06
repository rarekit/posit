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
 * Brand Entity
 *
 * @author Quang Tran <quang.tran@aseagle.com>
 */
class Brand {
    
    /**
     *
     * @var string
     */
    private $name;
    
    /**
     *
     * @var string
     */
    private $slug;
    
    /**
     *
     * @var string
     */
    private $intro;
    
    /**
     *
     * @var string
     */
    private $picture;
    
    /**
     *
     * @var \DateTime
     */
    private $created;
    
    /**
     *
     * @var integer
     */
    private $type;
    
    /**
     *
     * @var integer
     */
    private $id;
    
    /**
     * @var boolean
     */
    private $enabled;

    /**
     * Set name
     *
     * @param string $name            
     * @return Brand
     */
    public function setName($name) {
        $this->name = $name;
        
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug            
     * @return Brand
     */
    public function setSlug($slug) {
        $this->slug = $slug;
        
        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * Set intro
     *
     * @param string $intro            
     * @return Brand
     */
    public function setIntro($intro) {
        $this->intro = $intro;
        
        return $this;
    }

    /**
     * Get intro
     *
     * @return string
     */
    public function getIntro() {
        return $this->intro;
    }

    /**
     * Set picture
     *
     * @param string $picture            
     * @return Brand
     */
    public function setPicture($picture) {
        $this->picture = $picture;
        
        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture() {
        return $this->picture;
    }

    /**
     * Set created
     *
     * @param \DateTime $created            
     * @return Brand
     */
    public function setCreated($created) {
        $this->created = $created;
        
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set type
     *
     * @param integer $type            
     * @return Brand
     */
    public function setType($type) {
        $this->type = $type;
        
        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * PrePersist
     */
    public function updatedTimestamp() {
        if ($this->getCreated() == null) {
            $this->setCreated(new \DateTime(date('Y-m-d H:i:s')));
        }
    }    

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Brand
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return string
     */
    public function getPropertyName() {
        return $this->name;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $categories;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add categories
     *
     * @param \Aseagle\Bundle\ContentBundle\Entity\Category $categories
     * @return Brand
     */
    public function addCategory(\Aseagle\Bundle\ContentBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Aseagle\Bundle\ContentBundle\Entity\Category $categories
     */
    public function removeCategory(\Aseagle\Bundle\ContentBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
