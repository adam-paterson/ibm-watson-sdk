<?php

namespace IBM\Watson\LanguageTranslator\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

final class TranslationModel implements CreatableFromArrayInterface
{
    const KEY_ID           = 'model_id';
    const KEY_NAME         = 'name';
    const KEY_SOURCE       = 'source';
    const KEY_TARGET       = 'target';
    const KEY_BASE_ID      = 'base_model_id';
    const KEY_DOMAIN       = 'domain';
    const KEY_CUSTOMIZABLE = 'customizable';
    const KEY_DEFAULT      = 'default_model';
    const KEY_OWNER        = 'owner';
    const KEY_STATUS       = 'status';

    private $id;
    private $name;
    private $source;
    private $target;
    private $baseId;
    private $domain;
    private $customizable;
    private $isDefault;
    private $owner;
    private $status;

    /**
     * TranslationModel constructor.
     *
     * @param $id
     * @param $name
     * @param $source
     * @param $target
     * @param $baseId
     * @param $domain
     * @param $customizable
     * @param $isDefault
     * @param $owner
     * @param $status
     */
    public function __construct(
        $id,
        $name,
        $source,
        $target,
        $baseId,
        $domain,
        $customizable,
        $isDefault,
        $owner,
        $status
    ) {
        $this->id           = $id;
        $this->name         = $name;
        $this->source       = $source;
        $this->target       = $target;
        $this->baseId       = $baseId;
        $this->domain       = $domain;
        $this->customizable = $customizable;
        $this->isDefault    = $isDefault;
        $this->owner        = $owner;
        $this->status       = $status;
    }

    public static function create(array $data)
    {
        return new self(
            $data[static::KEY_ID],
            $data[static::KEY_NAME],
            $data[static::KEY_SOURCE],
            $data[static::KEY_TARGET],
            $data[static::KEY_BASE_ID],
            $data[static::KEY_DOMAIN],
            $data[static::KEY_CUSTOMIZABLE],
            $data[static::KEY_DEFAULT],
            $data[static::KEY_OWNER],
            $data[static::KEY_STATUS]
        );
    }

    /**
     * @return mixed
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return mixed
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @return mixed
     */
    public function getBaseId(): string
    {
        return $this->baseId;
    }

    /**
     * @return mixed
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @return mixed
     */
    public function canCustomize(): bool
    {
        return $this->customizable;
    }

    /**
     * @return mixed
     */
    public function isDefaultModel(): bool
    {
        return $this->isDefault;
    }

    /**
     * @return mixed
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * @return mixed
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
