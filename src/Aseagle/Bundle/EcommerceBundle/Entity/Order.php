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
 * Order Entity 
 *
 * @author Quang Tran <quang.tran@aseagle.com>
 */
class Order {
    
    /**
     * @var string
     */
    private $fullname;

    /**
     * @var string
     */
    private $email;

    /**
     * @var boolean
     */
    private $gender;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $address;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Aseagle\Bundle\UserBundle\Entity\User
     */
    private $user;


    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $orderItems;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderItems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set fullname
     *
     * @param string $fullname
     * @return Order
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string 
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Order
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set gender
     *
     * @param boolean $gender
     * @return Order
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return boolean 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Order
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Order
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Order
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Order
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Order
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
     * Set user
     *
     * @param \Aseagle\Bundle\UserBundle\Entity\User $user
     * @return Order
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
     * @var integer
     */
    private $total;


    /**
     * Set total
     *
     * @param integer $total
     * @return Order
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return integer 
     */
    public function getTotal()
    {
        return $this->total;
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
     * Add orderItems
     *
     * @param \Aseagle\Bundle\EcommerceBundle\Entity\OrderItem $orderItems
     * @return Order
     */
    public function addOrderItem(\Aseagle\Bundle\EcommerceBundle\Entity\OrderItem $orderItems)
    {
        $this->orderItems[] = $orderItems;

        return $this;
    }

    /**
     * Remove orderItems
     *
     * @param \Aseagle\Bundle\EcommerceBundle\Entity\OrderItem $orderItems
     */
    public function removeOrderItem(\Aseagle\Bundle\EcommerceBundle\Entity\OrderItem $orderItems)
    {
        $this->orderItems->removeElement($orderItems);
    }

    /**
     * Get orderItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }
}
