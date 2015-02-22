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

namespace StyleCI\StyleCI\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * This is the stripe controller class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class StripeController extends AbstractController
{
    /**
     * Create a new stripe controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(['except' => ['handle']]);
    }

    /**
     * Handles the request made to StyleCI by the Stripe API.
     *
     * We have to be super careful to prevent attackers from injecting their
     * own events here. For this reason we are only recording the provided id,
     * and then will fetch the event again through Stripe's api. We will also
     * be making sure that we protected against double event submissions.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request)
    {
        $payload = (array) json_decode($request->getContent(), true);

        $id = array_get($payload, 'id');

        if (!$id) {
            return new JsonResponse(['message' => 'StyleCI has determined that the provided payload was invalid.'], 400, [], JSON_PRETTY_PRINT);
        }

        $this->dispatch(new ProcessStripeEventCommand($id));

        return new JsonResponse(['message' => 'StyleCI has scheduled the processing of the provided event.'], 202, [], JSON_PRETTY_PRINT);
    }
}
