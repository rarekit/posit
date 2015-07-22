<?php
namespace Aseagle\Bundle\EcommerceBundle\Entity;

class ProductReview {
    
    /**
     * @var string
     */
    private $message;

    /**
     * @var boolean
     */
    private $enabled;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Aseagle\Bundle\EcommerceBundle\Entity\Product
     */
    private $product;

    /**
     * @var \Aseagle\Bundle\UserBundle\Entity\User
     */
    private $user;


    /**
     * Set message
     *
     * @param string $message
     * @return ProductReview
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return ProductReview
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
     * Set created
     *
     * @param \DateTime $created
     * @return ProductReview
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set product
     *
     * @param \Aseagle\Bundle\EcommerceBundle\Entity\Product $product
     * @return ProductReview
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
     * Set user
     *
     * @param \Aseagle\Bundle\UserBundle\Entity\User $user
     * @return ProductReview
     */
    public function setUser(\Aseagle\Bundle\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Aseagle\Bundle\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * PrePersist
     */
    public function updatedTimestamp()
    {
        if ($this->getCreated() == null) {
            $this->setCreated(new \DateTime(date('Y-m-d H:i:s')));
        }
    }
}
