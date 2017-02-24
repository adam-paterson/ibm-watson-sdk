<?php
/**
 * IBM Watson Service interface
 */
namespace IBM\Watson\Common;

/**
 * IBM Watson Service interface
 *
 * This interface class defines the standard functions that any
 * IBM Watson Service needs to define.
 *
 * @see AbstractService
 *
 */
interface ServiceInterface
{
    /**
     * Get the service display name
     */
    public function getName();

    /**
     * Get the service parameters, in the following format:
     *
     * [
     *     'username' => '', // string
     *     'password' => false, // boolean
     *     'version'  => ['test', 'mode'], // enum, first item is default
     * ];
     */
    public function getDefaultParameters();

    /**
     * Initialize the service with parameters
     *
     * @param array $parameters
     */
    public function initialize(array $parameters = []);

    /**
     * Get all service parameters
     */
    public function getParameters();
}
