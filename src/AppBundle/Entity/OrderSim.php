<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * OrderSim
 *
 * @ORM\Table(name="order_sim")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderSimRepository")
 */
class OrderSim
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=30)
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 3,
     *      max = 20,
     *      minMessage = "Имя должно быть длиннее {{ limit }} символов",
     *      maxMessage = "Очень длинное имя"
     * )
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=30)
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 3,
     *      max = 20,
     *      minMessage = "Фамилия должна быть длиннее {{ limit }} символов",
     *      maxMessage = "Очень длинная фамилия"
     * )
     */
    private $lastName;


    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50)
     *
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "Вы ввели не существующий '{{ value }}' email.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="delivery", type="string", length=150)
     *
     * @Assert\NotBlank()
     */
    private $delivery;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     *
     * @Assert\Regex(
     *     pattern="/^\(\d{3}\)-\d{3}-\d{2}-\d{2}$/",
     *     message="Не допустимый формат телефона, правильно (067)-777-77-77"
     * )
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="postIndex", type="string", length=5)
     *
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^\d+$/",
     *     message="Почтовый индекс(номер отделения) должен содержать только цифры"
     * )
     */
    private $postIndex;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50)
     *
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Город не должен содержать цифры"
     * )
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=200)
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 10,
     *      minMessage = "Адресс должен быть длиннее {{ limit }} символов",
     * )
     */
    private $address;

    /**
     * @var array
     *
     * @ORM\Column(name="list", type="json_array")
     *
     * @Assert\NotBlank()
     */
    private $list;

    /**
     * @var string
     *
     * @ORM\Column(name="productsPrice", type="decimal", precision=10, scale=2)
     *
     * @Assert\NotBlank()
     */
    private $productsPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="deliveryPrice", type="decimal", precision=10, scale=2)
     *
     * @Assert\NotBlank()
     */
    private $deliveryPrice;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", options={"default":true})
     */
    private $active;

    /**
     * @var bool
     *
     * @ORM\Column(name="done", type="boolean", options={"default":false})
     */
    private $done;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     */
    private $notes;

    public function __construct()
    {
        $this->active = true;
        $this->done = false;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return OrderSim
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return OrderSim
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return OrderSim
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
     * Set phone
     *
     * @param string $phone
     *
     * @return OrderSim
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
     * Set postIndex
     *
     * @param string $postIndex
     *
     * @return OrderSim
     */
    public function setPostIndex($postIndex)
    {
        $this->postIndex = $postIndex;

        return $this;
    }

    /**
     * Get postIndex
     *
     * @return string
     */
    public function getPostIndex()
    {
        return $this->postIndex;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return OrderSim
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return OrderSim
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
     * Set list
     *
     * @param array $list
     *
     * @return OrderSim
     */
    public function setList($list)
    {
        $this->list = $list;

        return $this;
    }

    /**
     * Get list
     *
     * @return array
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Set productsPrice
     *
     * @param string $productsPrice
     *
     * @return OrderSim
     */
    public function setProductsPrice($productsPrice)
    {
        $this->productsPrice = $productsPrice;

        return $this;
    }

    /**
     * Get productsPrice
     *
     * @return string
     */
    public function getProductsPrice()
    {
        return $this->productsPrice;
    }

    /**
     * Set deliveryPrice
     *
     * @param string $deliveryPrice
     *
     * @return OrderSim
     */
    public function setDeliveryPrice($deliveryPrice)
    {
        $this->deliveryPrice = $deliveryPrice;

        return $this;
    }

    /**
     * Get deliveryPrice
     *
     * @return string
     */
    public function getDeliveryPrice()
    {
        return $this->deliveryPrice;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return OrderSim
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set done
     *
     * @param boolean $done
     *
     * @return OrderSim
     */
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get done
     *
     * @return bool
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return OrderSim
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set delivery
     *
     * @param string $delivery
     *
     * @return OrderSim
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * Get delivery
     *
     * @return string
     */
    public function getDelivery()
    {
        return $this->delivery;
    }
}
