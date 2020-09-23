<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateUserRequest;
use App\Http\Resources\UserRegisteredResource;
use App\Model\User;
use App\ModelRepository\UserRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public $urepo;

    public function __construct(UserRepository $urepo)
    {
        $this->urepo = $urepo;
    }

    /**
     *
     * @api {post} https://api.admin-blog.test/register Register User
     * @apiHeaderExample {json} Header-Example:
     * {
     *   "Accept": "application/json"
     * }
     * @apiGroup Auth
     * @apiParam {string} name User name
     * @apiParam {string} email User email
     * @apiParam {string} password User password
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *      "name" => "testname",
     *      "email" => "some@email.com",
     *
     *     }
     * @apiErrorExample {json} Error-Response:
     *   HTTP/1.1 422 UNPROCESSABLE
     *     {
     * "message": "The given data was invalid.",
     *      "errors": {
     *          "name": [
     *          "The name field is required."
     *          ],
     *          "email": [
     *          "The email field is required."
     *          ],
     *          "password": [
     *          "The password field is required."
     *          ]
     *      }
     * }
     *
     */
    public function register(CreateUserRequest $request)
    {
        $user = $this->urepo->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)

        ]);

        return new UserRegisteredResource($user);

    }
}
