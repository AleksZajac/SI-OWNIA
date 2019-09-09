<?php
/**
 * User Entity.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User.
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @UniqueEntity(fields="email", message="Email already taken")
 */
class User implements UserInterface
{
    /**
     * @constant int NUMBER_OF_ITEMS
     */
    const NUMBER_OF_ITEMS = 3;

    /**
     * Konto zwyklego uzytkownika.
     *
     * @var string
     */
    const ROLE_USER = 'ROLE_USER';

    /**
     * Konto admina.
     *
     * @var string
     */
    const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * Primary key.
     *
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Email.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * Haslo.
     *
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *     min="6",
     *     max="255",
     * )
     */
    private $haslo;

    /**
     * Uzytkownicy.
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Uzytkownicy", mappedBy="user", cascade={"persist", "remove"})
     */
    private $uzytkownicy;

    /**
     * Roles.
     *
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->uzytkownicy = new ArrayCollection();
    }

    /**
     * Getter fo idUser.
     *
     * @return int|null idUser
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for Email.
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Setter for email.
     *
     * @param string $email Email
     *
     * @return User
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Getter for haslo.
     *
     * @return string|null Haslo
     */
    public function getPassword(): ?string
    {
        return $this->haslo;
    }

    /**
     * Setter for Haslo.
     *
     * @param string $haslo Haslo
     *
     * @return User
     */
    public function setPassword(string $haslo): self
    {
        $this->haslo = $haslo;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using bcrypt or argon
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * Getter for uzytkownicy.
     *
     * @return ArrayCollection|Uzytkownicy
     */
    public function getUzytkownicy()
    {
        return $this->uzytkownicy;
    }

    /**
     * Setter for uzytkownicy.
     *
     * @param Uzytkownicy $uzytkownicy uzytkownicy
     *
     * @return User
     */
    public function setUzytkownicy($uzytkownicy): self
    {
        $this->uzytkownicy = $uzytkownicy;
        if ($this !== $uzytkownicy->getUser()) {
            $uzytkownicy->setUser($this);
        }

        return $this;
    }

    /**
     * Getter for the Roles.
     *
     * @return array Roles
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = static::ROLE_USER;

        return array_unique($roles);
    }

    /**
     * Setter for the Roles.
     *
     * @param array $roles Roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * {@inheritdoc}
     *
     * @see UserInterface
     *
     * @return string Username
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }
}
