<?php

declare(strict_types=1);

namespace XtreamwayzTest\Expressive\Console\Fixtures;

use RuntimeException;
use Symfony\Component\Console\Command\Command;

class ExceptionThrowingCommand extends Command
{
    public function __construct(string $name = null)
    {
        parent::__construct($name);

        throw new RuntimeException('Constructor exception; this should not be triggered if lazy loaded');
    }
}
