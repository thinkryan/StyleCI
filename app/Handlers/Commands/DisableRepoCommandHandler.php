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

use StyleCI\StyleCI\Commands\DisableRepoCommand;
use StyleCI\StyleCI\GitHub\Hooks;
use StyleCI\StyleCI\Models\Repo;

/**
 * This is the disable repo command handler class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class DisableRepoCommandHandler
{
    /**
     * The hooks instance.
     *
     * @var \StyleCI\StyleCI\GitHub\Hooks
     */
    protected $hooks;

    /**
     * Create a new enable repo command handler instance.
     *
     * @param \StyleCI\StyleCI\GitHub\Hooks $hooks
     *
     * @return void
     */
    public function __construct(Hooks $hooks)
    {
        $this->hooks = $hooks;
    }

    /**
     * Handle the disable repo command.
     *
     * @param \StyleCI\StyleCI\Commands\DisableRepoCommand $command
     *
     * @return void
     */
    public function handle(DisableRepoCommand $command)
    {
        $repo = $command->getRepo();

        try {
            $this->hooks->disable($repo);
        } catch (\Exception $e) {
            // TODO: fix this
        }

        foreach ($repo->commits as $commit) {
            $commit->delete();
        }

        foreach ($repo->forks as $fork) {
            $fork->delete();
        }

        $repo->delete();
    }
}