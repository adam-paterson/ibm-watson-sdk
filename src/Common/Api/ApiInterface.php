<?php

declare(strict_types=1);

namespace IBM\Watson\Common\Api;

/**
 * The ApiInterface is responsible for creating and sending API requests.
 */
interface ApiInterface
{
    const HTTP_METHOD_GET = 'GET';

    const HTTP_METHOD_HEAD = 'HEAD';

    const HTTP_METHOD_TRACE = 'TRACE';

    const HTTP_METHOD_POST = 'POST';

    const HTTP_METHOD_PUT = 'PUT';

    const HTTP_METHOD_PATCH = 'PATCH';

    const HTTP_METHOD_DELETE = 'DELETE';

    const HTTP_METHOD_OPTIONS = 'OPTIONS';
}
