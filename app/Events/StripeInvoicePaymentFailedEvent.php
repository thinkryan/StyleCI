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

namespace StyleCI\StyleCI\Events;

use Illuminate\Queue\SerializesModels;

/**
 * This is the stripe invoice payment failed event class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class StripeInvoicePaymentFailedEvent
{
    use SerializesModels;

    /**
     * The event data.
     *
     * @var array
     */
    protected $data;

    /**
     * Create a new stripe invoice payment failed event instance.
     *
     * @param array $data
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the event data.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
