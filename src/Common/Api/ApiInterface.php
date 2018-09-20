<?php

declare(strict_types=1);

namespace IBM\Watson\Common\Api;

/**
 * The ApiInterface is responsible for creating and sending API requests.
 */
interface ApiInterface
{
    public const HTTP_METHOD_GET = 'GET';

    public const HTTP_METHOD_HEAD = 'HEAD';

    public const HTTP_METHOD_TRACE = 'TRACE';

    public const HTTP_METHOD_POST = 'POST';

    public const HTTP_METHOD_PUT = 'PUT';

    public const HTTP_METHOD_PATCH = 'PATCH';

    public const HTTP_METHOD_DELETE = 'DELETE';

    public const HTTP_METHOD_OPTIONS = 'OPTIONS';
}
