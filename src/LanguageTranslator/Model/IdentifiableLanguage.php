<?php

declare(strict_types=1);

namespace IBM\Watson\LanguageTranslator\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

/**
 * IdentifiableLanguage.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
final class IdentifiableLanguage implements CreatableFromArrayInterface
{
    const KEY_CODE = 'language';
    const KEY_NAME = 'name';

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $code
     * @param string $name
     */
    public function __construct(string $code, string $name)
    {
        $this->code = $code;
        $this->name = $name;
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public static function create(array $data): self
    {
        return new self($data[static::KEY_CODE], $data[static::KEY_NAME]);
    }

    /**
     * Gets the language code for an identifiable language.
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Gets the name of the identifiable language.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
