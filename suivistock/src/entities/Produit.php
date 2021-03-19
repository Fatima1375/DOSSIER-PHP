<?php
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="produit")
 **/
class Produit
{
    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue **/
    private $ref;
    /** @ORM\Column(type="string") **/
    private $nom;
    /** @ORM\Column(type="decimal") **/
    private $qtStock;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="id")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    public $id;

    /**
     * @return mixed
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * @param mixed $ref
     */
    public function setRef($ref)
    {
        $this->ref = $ref;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getQtStock()
    {
        return $this->qtStock;
    }

    /**
     * @param mixed $qtStock
     */
    public function setQtStock($qtStock)
    {
        $this->qtStock = $qtStock;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}