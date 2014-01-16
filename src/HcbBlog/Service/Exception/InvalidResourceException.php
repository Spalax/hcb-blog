<?php
namespace HcbBlog\Service\Exception;

use HcBackend\Service\Fetch\Paginator\Exception\InvalidResourceExceptionInterface;

class InvalidResourceException extends InvalidArgumentException implements InvalidResourceExceptionInterface {}
