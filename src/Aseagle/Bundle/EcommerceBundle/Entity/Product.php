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
 * Product Entity
 *
 * @author Quang Tran <quang.tran@aseagle.com>
 */
class Product {
    
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
     * @var integer
     */
    private $type;
    
    /**
     *
     * @var string
     */
    private $description;
    
    /**
     *
     * @var string
     */
    private $intro;
    
    /**
     *
     * @var string
     */
    private $sku;
    
    /**
     *
     * @var integer
     */
    private $price;
    
    /**
     *
     * @var string
     */
    private $tags;
    
    /**
     *
     * @var string
     */
    private $metaTitle;
    
    /**
     *
     * @var string
     */
    private $metaContent;
    
    /**
     *
     * @var string
     */
    private $metaKeywords;
    
    /**
     *
     * @var integer
     */
    private $pageView;
    
    /**
     *
     * @var boolean
     */
    private $enabled;
    
    /**
     *
     * @var \DateTime
     */
    private $updated;
    
    /**
     *
     * @var \DateTime
     */
    private $created;
    
    /**
     *
     * @var integer
     */
    private $id;
    
    /**
     *
     * @var \Doctrine\Common\Collections\Collection
     */
    private $images;
    
    /**
     *
     * @var \Doctrine\Common\Collections\Collection
     */
    private $categories;
    
    /**
     * @var \Aseagle\Bundle\EcommerceBundle\Entity\Brand
     */
    private $brand;

    /**
     * Constructor
     */
    public function __construct() {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name            
     * @return Product
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
     * @return Product
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
     * Set type
     *
     * @param integer $type            
     * @return Product
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
     * Set description
     *
     * @param string $description            
     * @return Product
     */
    public function setDescription($description) {
        $this->description = $description;
        
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set intro
     *
     * @param string $intro            
     * @return Product
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
     * Set sku
     *
     * @param string $sku            
     * @return Product
     */
    public function setSku($sku) {
        $this->sku = $sku;
        
        return $this;
    }

    /**
     * Get sku
     *
     * @return string
     */
    public function getSku() {
        return $this->sku;
    }

    /**
     * Set price
     *
     * @param integer $price            
     * @return Product
     */
    public function setPrice($price) {
        $this->price = $price;
        
        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set tags
     *
     * @param string $tags            
     * @return Product
     */
    public function setTags($tags) {
        $this->tags = $tags;
        
        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags() {
        return $this->tags;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle            
     * @return Product
     */
    public function setMetaTitle($metaTitle) {
        $this->metaTitle = $metaTitle;
        
        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string
     */
    public function getMetaTitle() {
        return $this->metaTitle;
    }

    /**
     * Set metaContent
     *
     * @param string $metaContent            
     * @return Product
     */
    public function setMetaContent($metaContent) {
        $this->metaContent = $metaContent;
        
        return $this;
    }

    /**
     * Get metaContent
     *
     * @return string
     */
    public function getMetaContent() {
        return $this->metaContent;
    }

    /**
     * Set metaKeywords
     *
     * @param string $metaKeywords            
     * @return Product
     */
    public function setMetaKeywords($metaKeywords) {
        $this->metaKeywords = $metaKeywords;
        
        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @return string
     */
    public function getMetaKeywords() {
        return $this->metaKeywords;
    }

    /**
     * Set pageView
     *
     * @param integer $pageView            
     * @return Product
     */
    public function setPageView($pageView) {
        $this->pageView = $pageView;
        
        return $this;
    }

    /**
     * Get pageView
     *
     * @return integer
     */
    public function getPageView() {
        return $this->pageView;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled            
     * @return Product
     */
    public function setEnabled($enabled) {
        $this->enabled = $enabled;
        
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled() {
        return $this->enabled;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated            
     * @return Product
     */
    public function setUpdated($updated) {
        $this->updated = $updated;
        
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated() {
        return $this->updated;
    }

    /**
     * Set created
     *
     * @param \DateTime $created            
     * @return Product
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
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Add images
     *
     * @param \Aseagle\Bundle\EcommerceBundle\Entity\Image $images            
     * @return Product
     */
    public function addImage(\Aseagle\Bundle\EcommerceBundle\Entity\Image $images) {
        $this->images [] = $images;
        
        return $this;
    }

    /**
     * Remove images
     *
     * @param \Aseagle\Bundle\EcommerceBundle\Entity\Image $images            
     */
    public function removeImage(\Aseagle\Bundle\EcommerceBundle\Entity\Image $images) {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages() {
        return $this->images;
    }

    /**
     * Add categories
     *
     * @param \Aseagle\Bundle\ContentBundle\Entity\Category $categories            
     * @return Product
     */
    public function addCategory(\Aseagle\Bundle\ContentBundle\Entity\Category $categories) {
        $this->categories [] = $categories;
        
        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Aseagle\Bundle\ContentBundle\Entity\Category $categories            
     */
    public function removeCategory(\Aseagle\Bundle\ContentBundle\Entity\Category $categories) {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories() {
        return $this->categories;
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
     * Set brand
     *
     * @param \Aseagle\Bundle\EcommerceBundle\Entity\Brand $brand            
     * @return Product
     */
    public function setBrand(\Aseagle\Bundle\EcommerceBundle\Entity\Brand $brand = null) {
        $this->brand = $brand;
        
        return $this;
    }

    /**
     * Get brand
     *
     * @return \Aseagle\Bundle\EcommerceBundle\Entity\Brand
     */
    public function getBrand() {
        return $this->brand;
    }
    /**
     * @var integer
     */
    private $quantity;


    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
    /**
     * @var string
     */
    private $supplement;


    /**
     * Set supplement
     *
     * @param string $supplement
     * @return Product
     */
    public function setSupplement($supplement)
    {
        $this->supplement = $supplement;

        return $this;
    }

    /**
     * Get supplement
     *
     * @return string 
     */
    public function getSupplement()
    {
        return $this->supplement;
    }
    /**
     * @var string
     */
    private $thumbnail;


    /**
     * Set thumbnail
     *
     * @param string $thumbnail
     * @return Product
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Get thumbnail
     *
     * @return string 
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $reviews;


    /**
     * Add reviews
     *
     * @param \Aseagle\Bundle\EcommerceBundle\Entity\ProductReview $reviews
     * @return Product
     */
    public function addReview(\Aseagle\Bundle\EcommerceBundle\Entity\ProductReview $reviews)
    {
        $this->reviews[] = $reviews;

        return $this;
    }

    /**
     * Remove reviews
     *
     * @param \Aseagle\Bundle\EcommerceBundle\Entity\ProductReview $reviews
     */
    public function removeReview(\Aseagle\Bundle\EcommerceBundle\Entity\ProductReview $reviews)
    {
        $this->reviews->removeElement($reviews);
    }

    /**
     * Get reviews
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReviews()
    {
        return $this->reviews;
    }
    /**
     * @var boolean
     */
    private $showHomepage;


    /**
     * Set showHomepage
     *
     * @param boolean $showHomepage
     * @return Product
     */
    public function setShowHomepage($showHomepage)
    {
        $this->showHomepage = $showHomepage;

        return $this;
    }

    /**
     * Get showHomepage
     *
     * @return boolean 
     */
    public function getShowHomepage()
    {
        return $this->showHomepage;
    }
}
