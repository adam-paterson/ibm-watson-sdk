<?php
/**
 * Helper class
 */
namespace IBM\Watson\Common;

/**
 * Helper class
 *
 * This class defines various static utility functions that are in use
 * throughout the SDK
 *
 */
class Helper
{
    /**
     * Convert a string to camelCase. Strings already in camelCase will not be modified
     *
     * @param string  $string The input string
     * @return string The output string
     */
    public static function camelCase($string)
    {
        $string = self::convertToLowercase($string);
        return preg_replace_callback(
            '/_([a-z])/',
            function ($match) {
                return strtoupper($match[1]);
            },
            $string
        );
    }

    /**
     * Convert strings with underscores to all lowercase
     *
     * @param string string The input string
     * @return string The output string
     */
    protected static function convertToLowercase($string)
    {
        $explodedStr = explode('_', $string);

        if (count($explodedStr) > 1) {
            foreach ($explodedStr as $value) {
                $lowercasedStr[] = strtolower($value);
            }
            $string = implode('_', $lowercasedStr);
        }

        return $string;
    }

    /**
     * Initialize an object with the given parameters
     *
     * @param mixed $target  The object to set parameters on
     * @param array $parameters The parameters to set
     */
    public static function initialize($target, $parameters)
    {
        if (is_array($parameters)) {
            foreach ($parameters as $key => $value) {
                $method = 'set'.ucfirst(static::camelCase($key));
                if (method_exists($target, $method)) {
                    $target->$method($value);
                }
            }
        }
    }
}
