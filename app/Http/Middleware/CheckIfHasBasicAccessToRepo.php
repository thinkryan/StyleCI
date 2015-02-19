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

namespace StyleCI\StyleCI\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * This is the check if has basic access to repo middleware class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class Authenticate
{
    /**
     * The authentication guard instance.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * The github repos instance.
     *
     * @var \StyleCI\StyleCI\GitHub\Repos
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     * @param array                            $allowed
     *
     * @return void
     */
    public function __construct(Guard $auth, array $allowed)
    {
        $this->auth = $auth;
        $this->allowed = $allowed;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($repo = $request->route('repo')) {
            $id = $repo->id;
        } else {
            $id = $request->route('id');
        }

        if (!array_get($this->repos->get($this->auth->user()), $id)) {
            throw new HttpException(403);
        }

        return $next($request);
    }
}
