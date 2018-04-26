<?php

declare(strict_types=1);

namespace XtreamwayzTest\Expressive\Console\Fixtures;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    public $input;

    public $output;

    protected function configure()
    {
        $this
            ->setName('foo:bar')
            ->setDescription('The foo:bar command')
            ->setAliases(['afoobar']);
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('interact called');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input  = $input;
        $this->output = $output;
        $output->writeln('called');
    }
}
