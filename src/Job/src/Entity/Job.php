<?php

declare(strict_types=1);

namespace Core\Job\Entity;

use Core\App\Entity\AbstractEntity;
use Core\App\Entity\TimestampsTrait;
use Core\Job\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobRepository::class)]
#[ORM\Table(name: 'job')]
#[ORM\HasLifecycleCallbacks]
class Job extends AbstractEntity
{
    use TimestampsTrait;

    #[ORM\Column(name: "contact", type: "string", length: 100)]
    protected string $contact;
    
    public function __construct()
    {
        parent::__construct();

        $this->created();
    }

    /**
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }
    

    /**
     * @param string $contact
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    }
    

    /**
     * @return array{
     *      uuid: non-empty-string,
     *      created: DateTimeImmutable,
     *      updated: DateTimeImmutable|null,
     * }
     */
    public function getArrayCopy(): array
    {
        return [
            'uuid'    => $this->uuid->toString(),
            'contact' => $this->getContact(),
            'created' => $this->created,
            'updated' => $this->updated,
        ];
    }
}
