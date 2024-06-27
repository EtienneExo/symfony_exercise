<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="user")
 * @UniqueEntity(fields={"username"},message="Le nom de l utilisateur doit être unique")
 * @method string getUserIdentifier()
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255,unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="veuillez encoder un mot de passe")
     * @Assert\Regex(pattern="/^(?=.*[A-Z])(?=.*[a-z])(?=.*[@$!%*#?&])[\w@$!%*#?&]{8,}$/",htmlPattern="/^(?=.*[A-Z])(?=.*[a-z])(?=.*[@$!%*#?&])[\w@$!%*#?&]{8,}$/",message="Le password doit contenir au moins 1 majuscule, 1 caractère special",groups="registration")
     *
     * @Assert\Length(max=8,min=8,exactMessage="La longeur doit être de 8 caractères")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email(message="l email doit être valide")
     */
    private $mail;

    /**
     * @ORM\ManyToOne(targetEntity=Role::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @MaxDepth(1)
     */
    private $Role;

    /**
     * @Assert\EqualTo(propertyPath="password",message="les mots de passe ne sont pas identiques",groups="registration")
     */
    private $confirm_password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->Role;
    }

    public function setRole(?Role $Role): self
    {
        $this->Role = $Role;

        return $this;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirm_password;
    }

    public function setConfirmPassword(string $confirm_password): self
    {
        $this->confirm_password = $confirm_password;

        return $this;
    }


    public function getRoles() : ? array
    {
        // TODO: Implement getRoles() method.
        return array('ROLE_' . strtoupper($this->Role->getName()));
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }
}
