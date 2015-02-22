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

namespace StyleCI\StyleCI\Commands;

/**
 * This is the process stripe event command class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class ProcessStripeEventCommand
{
    /**
     * The stripe event id.
     *
     * @var string
     */
    protected $id;

    /**
     * Create a new process stripe event command instance.
     *
     * @param string $id
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get the stripe event id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
