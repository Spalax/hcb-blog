<?php
namespace HcbBlog\Service\Exception;

use HcbBlog\Exception\ExceptionInterface;

class InvalidArgumentException extends \InvalidArgumentException implements ExceptionInterface {}
