<?php
declare(strict_types = 1);
namespace Core\Job\Entity;

use Core\App\Entity\AbstractEntity;
use Core\App\Entity\TimestampsTrait;
use Core\Job\Repository\JobTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobTypeRepository::class)]
#[ORM\Table(name: 'job_type')]
#[ORM\HasLifecycleCallbacks]
class JobType extends AbstractEntity
{
    use TimestampsTrait;

    #[ORM\Column(name: "type", type: "string", length: 100)]
    protected string $type;

    public function __construct()
    {
        parent::__construct();
        
        $this->created();
    }
    
    /**
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     *
     * @return array{ uuid: non-empty-string,
     *         created: DateTimeImmutable,
     *         updated: DateTimeImmutable|null,
     *         }
     */
    public function getArrayCopy(): array
    {
        return [
            'uuid' => $this->uuid->toString(),
            'created' => $this->created,
            'updated' => $this->updated,
            'type' => $this->getType()
        ];
    }
}
