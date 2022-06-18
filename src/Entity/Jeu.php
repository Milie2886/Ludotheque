<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\JeuRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
//Table principale, on ajoute HasLifecycleCallbacks et le trait Timestampable pour que les champs du trait s'ajoutent à la table
#[ORM\Entity(repositoryClass: JeuRepository::class)]
//Renommage de la table jeu en jeux
#[ORM\Table(name:"jeux")]
#[ORM\HasLifecycleCallbacks]
/**
 * @Vich\Uploadable
 */
class Jeu
{
    use Timestampable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    //Ajout de messages de validation et de contraintes
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message:'Le titre ne peut pas être vide')]
    #[Assert\Length(min:3)]
    private $title;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message:'Merci de mettre une description')]
    #[Assert\Length(min:10)]
    private $description;
    //Pour l'upload d'image j'ai utilisé Vich. Je n'ai pas trouvé le moyen de mettre cette anotation en mode symfony 6
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="jeu_image", fileNameProperty="imageName")
     * 
     * @var File|null
     */
    #[Assert\Image(maxSize:"8M")]
    private $imageFile;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $imageName;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'jeux')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

}
