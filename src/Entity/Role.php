<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 */
class Role
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="Role")
     */
    private $users;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $name = null;

    public function __construct()
    {

        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setRole($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getRole() === $this) {
                $user->setRole(null);
            }
        }

        return $this;
    }

    /**
     * Set the name of the role.
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {

        //$usernames=$this->userRepository->getAllUsernames;

        //$roleIds = $this->userRepository->findRoleIdsByUsername($usernames);

        //foreach ($roleIds as $roleId)
        //{
            //if( $roleId == 2 )
            //{

               // $this->$name = "Admin";

           // }else
           // {
               // $this->$name  = "User";
           // }

       // }

        return $this;
    }
}
