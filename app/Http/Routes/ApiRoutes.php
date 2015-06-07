<?php

/*
 * This file is part of StyleCI.
 *
 * (c) Cachet HQ <support@cachethq.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\StyleCI\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

/**
 * This is the api routes class.
 *
 * @author Joseph Cohen <joe@cachethq.io>
 */
class ApiRoutes
{
    /**
     * Define the account routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     *
     * @return void
     */
    public function map(Registrar $router)
    {
        $router->group(['prefix' => 'api'], function(Registrar $router) {
            $router->get('account/repos', [
                'as'   => 'account_repos_path',
                'uses' => 'AccountController@handleListRepos',
            ]);

            $router->post('account/repos/sync', [
                'as'   => 'api_account_repos_sync_path',
                'uses' => 'AccountController@handleSync',
            ]);

            $router->post('account/enable/{id}', [
                'as'   => 'api_enable_repo_path',
                'uses' => 'AccountController@handleEnable',
            ]);

            $router->post('account/disable/{repo}', [
                'as'   => 'api_disable_repo_path',
                'uses' => 'AccountController@handleDisable',
            ]);
        });
    }
}
