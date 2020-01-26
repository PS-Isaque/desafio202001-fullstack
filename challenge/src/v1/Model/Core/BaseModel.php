<?php
/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */

namespace App\v1\Model\Core;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{

    /**
     * @var bool
     */
    private $isDetail = false;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at->format('Y-m-d H:i:s');
    }

    /**
     * @return mixed
     */
    public function getDeletedAt()
    {
        if ($this->deleted_at) {
            return $this->deleted_at->format('Y-m-d H:i:s');
        }
        return null;
    }
}
