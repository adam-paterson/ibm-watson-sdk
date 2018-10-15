<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

/**
 * Class.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class Utterance implements CreatableFromArrayInterface
{
    const KEY_TEXT = 'text';

    const KEY_USER = 'user';

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $user;

    /**
     * @param string $text
     * @param string $user
     */
    public function __construct(string $text, string $user)
    {
        $this->text = $text;
        $this->user = $user;
    }

    /**
     * @param array $data
     *
     * @return \IBM\Watson\ToneAnalyzer\Model\Utterance
     */
    public static function create(array $data): self
    {
        return new self($data[static::KEY_TEXT], $data[static::KEY_USER]);
    }

    /**
     * Gets the text.
     *
     * An utterance contributed by a user in the conversation that is to be analyzed.
     * The utterance can contain multiple sentences.
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Gets the user.
     *
     * A string that identifies the user who contributed the utterance specified by the `text` parameter.
     *
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }
}
