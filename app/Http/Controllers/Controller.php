<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      title="Mailbox API",
 *      version="1.0.0",
 *      @OA\Contact(
 *        name="Alex Ejimkaraonye", 
 *        email="ejimalex@gmail.com"
 *      ),
 * )
 * @QA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT"
 * )     
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
