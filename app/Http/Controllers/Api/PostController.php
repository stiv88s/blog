<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     *
     * @api {get} /api/v1/post/ Request Post information
     * @apiName GetPost
     * @apiGroup Post
     * @apiUse api1
     * @apiParam {String} lastname          Mandatory Lastname.
     *
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "firstname": "John",
     *       "lastname": "Doe"
     *     }
     *
     * @apiError UserNotFound The id of the User was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "UserNotFound"
     *     }
     */
    public function index(Request $request){
        dd($request->user());
        dd('working');
    }
}
