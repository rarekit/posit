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
 * OrderItem Entity 
 *
 * @author Quang Tran <quang.tran@aseagle.com>
 */
class OrderItem {
    
    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Aseagle\Bundle\EcommerceBundle\Entity\Order
     */
    private $order;

    /**
     * @var \Aseagle\Bundle\EcommerceBundle\Entity\Product
     */
    private $product;


    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return OrderItem
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set order
     *
     * @param \Aseagle\Bundle\EcommerceBundle\Entity\Order $order
     * @return OrderItem
     */
    public function setOrder(\Aseagle\Bundle\EcommerceBundle\Entity\Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Aseagle\Bundle\EcommerceBundle\Entity\Order 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set product
     *
     * @param \Aseagle\Bundle\EcommerceBundle\Entity\Product $product
     * @return OrderItem
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
}
