<?php

declare(strict_types=1);

namespace PhpAT\Statement\Event\Listener;

use PhpAT\App\RuleValidationStorage;
use PHPAT\EventDispatcher\EventInterface;
use PHPAT\EventDispatcher\EventListenerInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PhpAT\Statement\Event\StatementNotValidEvent;

class StatementNotValidListener implements EventListenerInterface
{
    private $output;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    public function __invoke(EventInterface $event)
    {
        $this->output->write('X', false, OutputInterface::VERBOSITY_VERBOSE);
        $this->output->writeln(' ' . $event->getMessage(), OutputInterface::VERBOSITY_VERY_VERBOSE);
        RuleValidationStorage::addError($event->getMessage());
    }
}
