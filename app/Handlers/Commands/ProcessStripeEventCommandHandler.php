<?php

/*
 * This file is part of StyleCI.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 * (c) Joseph Cohen <joseph.cohen@dinkbit.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\StyleCI\Handlers\Commands;

use Stripe_Event;
use StyleCI\StyleCI\Commands\ProcessStripeEventCommand;

/**
 * This is the process stripe event command handler class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class ProcessStripeEventCommandHandler
{
    /**
     * Handle the process stripe event command.
     *
     * @param \StyleCI\StyleCI\Commands\ProcessStripeEventCommand $command
     *
     * @return void
     */
    public function handle(ProcessStripeEventCommand $command)
    {
        $event = Stripe_Event::retrieve($command->getId());

        $name = $this->getEventClass($event);

        if (class_exists($name)) {
            event(new $name($event['data']));
        }
    }

    /**
     * Get the class name for the given event.
     *
     * @param \Stripe_Event $event
     *
     * @return string
     */
    protected function getEventClass(Stripe_Event $event)
    {
        $name = studly_case(str_replace('.', '_', $event['type']));

        return "StyleCI\StyleCI\Events\Stripe{$name}Event";
    }
}
