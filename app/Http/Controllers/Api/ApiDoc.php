<?php

namespace App\Http\Api;


class ApiDoc{

    /**
     * @api               {post} https://api.admin-blog.test/oauth/token Refresh Auth Token
     * @apiName           Refresh User auth token
     * @apiGroup          Auth
     *
     * @apiParam {String} grant_type refresh_token Token grant type (only refresh_token).
     * @apiParam {String} refresh_token {refresh_token} Your refresh token.
     * @apiParam {String} client_id Walid clientID.
     * @apiParam {String} client_secret Walid clientSecret.
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     * "token_type": "Bearer",
     * "expires_in": 31536000,
     * "access_token":
     * "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM4OTlmNGUwNTNmMGUwOTRkZDJkMTU5M2UzNjFkMmM1Y2I2MGE2ZmU0ZDM3MWY3NjMzZTcyZmE2NWU2ZDNkYTZmNDczMTNlNjI1OTNiMTA2In0.eyJhdWQiOiIzIiwianRpIjoiYzg5OWY0ZTA1M2YwZTA5NGRkMmQxNTkzZTM2MWQyYzVjYjYwYTZmZTRkMzcxZjc2MzNlNzJmYTY1ZTZkM2RhNmY0NzMxM2U2MjU5M2IxMDYiLCJpYXQiOjE1MTQxOTk1NjUsIm5iZiI6MTUxNDE5OTU2NSwiZXhwIjoxNTQ1NzM1NTY1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.funnwTJALrRHe47xeXERYJm9BY8vmn68ff5wuiqmL82NPSVCQ6MfWOmi7r6iKXuxrz0bqNFCY2Qjqb31qgtIOAwZtzbDSw8aW7CglCKZNczFS2vcJZ2RhRIirZ9PjuGSLHXz4lGr_qERW2QXNctzarQMKsNSG-msERC-EacIfycZp2Xc6O7sbFuVC4ebIg8g0_SlpqH3IkhS_RLSg99t27gDpVcTZ527ktqejsvOBQQ5mhgdNABOCfJ4LPoI9dvB1v9cBQoAOu4OptwjTlPQZV4z_ibB607VZKKNQIU4dpswF25KXi6ChjPZ0izJRvUZjDtR8AHPnv6SILPXgpThwPZvZ-qZkkEzuKPll2qZQFvNQOl9jNQ9wdnf3zUwsGjFMA_1p96J5-b6YnOza1o6Jztm6sqEAVbJfyXgBMefSGWx9DDQX2rP-FEQJZ6n8oeYOufJkGd75DtUfNiujAORObCo3hcYpRcd5cNG7RyLO166DjsQHnOHLjSKJyItzQJ95y0ujHV_2fBszeaDWeW1w_UNfiJY8oA1qeX1LwwVRSB81rQMmenc6dK5Wbvgh_sefa5LbplKl6TO9qPQSjk_NC7pZ0B1T_EpEvJvF6A1pGQ_0vL6FydVgOfwr5VAJN2pv6Mucl9X4UZeJubXCirnAtQSeIPjXDzGMn0KXqlGgSc",
     * "refresh_token":
     * "def5020097d9f938fa55aa217e7f2e960a05da817f751dc9ae45593dee1996b3b657333b39eaea4ec266c659cc06d74a60b142169b9d7366e831b7508d1b805e387658415bff4125c2d9319777fea065f54b5979a22c057f9f199ff45fa29ee8d1258cecbf43b37db312af9cac3ef3267951e2e6389847d350411ba9c30a968e61350ca596f5bd6e952b5cd474ff3e42297e3a0479b51d6cc367f8595903f762020d97d8270f7880fb6f5f1f256bf4256faf38a36a4217ae17019e9e56bf3fdde8a30c0fb9ffa970d5a17058bf5d35877a963bade655bfda5f4c2253ec292c83deccbe25ee56fc76f278e7d50bcbbfaddd10482e8a61745fb5c7b22cb401a2d9ba3ab1dd3221e3feb09747a3274ca823d96803069b7cc55b1950cacc08daa36bc0b5acb1d437ef3864eaaebc702fa1d8f4845687a32334553733316f197d62e505d0543da7a76d4ce58ecc920497db7bc41dc594af1bfdbe99dc8deb8824b85da8"
     * }
     *
     * @apiError          UNAUTHORIZED 400 Invalid grant_type.
     * @apiError          UNAUTHORIZED 401 Invalid credential.
     *
     */

    /**
     * @api               {post} https://api.admin-blog.test/oauth/token Login - Request Auth Token
     * @apiName           Get User auth token
     * @apiGroup          Auth
     *
     * @apiParam {String} grant_type password Token grant type (only password).
     * @apiParam {String} client_id Walid clientID.
     * @apiParam {String} client_secret Walid clientSecret.
     * @apiParam {String} username User login.
     * @apiParam {String} password UserPassword.
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     * "token_type": "Bearer",
     * "expires_in": 31536000,
     * "access_token":
     * "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM4OTlmNGUwNTNmMGUwOTRkZDJkMTU5M2UzNjFkMmM1Y2I2MGE2ZmU0ZDM3MWY3NjMzZTcyZmE2NWU2ZDNkYTZmNDczMTNlNjI1OTNiMTA2In0.eyJhdWQiOiIzIiwianRpIjoiYzg5OWY0ZTA1M2YwZTA5NGRkMmQxNTkzZTM2MWQyYzVjYjYwYTZmZTRkMzcxZjc2MzNlNzJmYTY1ZTZkM2RhNmY0NzMxM2U2MjU5M2IxMDYiLCJpYXQiOjE1MTQxOTk1NjUsIm5iZiI6MTUxNDE5OTU2NSwiZXhwIjoxNTQ1NzM1NTY1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.funnwTJALrRHe47xeXERYJm9BY8vmn68ff5wuiqmL82NPSVCQ6MfWOmi7r6iKXuxrz0bqNFCY2Qjqb31qgtIOAwZtzbDSw8aW7CglCKZNczFS2vcJZ2RhRIirZ9PjuGSLHXz4lGr_qERW2QXNctzarQMKsNSG-msERC-EacIfycZp2Xc6O7sbFuVC4ebIg8g0_SlpqH3IkhS_RLSg99t27gDpVcTZ527ktqejsvOBQQ5mhgdNABOCfJ4LPoI9dvB1v9cBQoAOu4OptwjTlPQZV4z_ibB607VZKKNQIU4dpswF25KXi6ChjPZ0izJRvUZjDtR8AHPnv6SILPXgpThwPZvZ-qZkkEzuKPll2qZQFvNQOl9jNQ9wdnf3zUwsGjFMA_1p96J5-b6YnOza1o6Jztm6sqEAVbJfyXgBMefSGWx9DDQX2rP-FEQJZ6n8oeYOufJkGd75DtUfNiujAORObCo3hcYpRcd5cNG7RyLO166DjsQHnOHLjSKJyItzQJ95y0ujHV_2fBszeaDWeW1w_UNfiJY8oA1qeX1LwwVRSB81rQMmenc6dK5Wbvgh_sefa5LbplKl6TO9qPQSjk_NC7pZ0B1T_EpEvJvF6A1pGQ_0vL6FydVgOfwr5VAJN2pv6Mucl9X4UZeJubXCirnAtQSeIPjXDzGMn0KXqlGgSc",
     * "refresh_token":
     * "def5020097d9f938fa55aa217e7f2e960a05da817f751dc9ae45593dee1996b3b657333b39eaea4ec266c659cc06d74a60b142169b9d7366e831b7508d1b805e387658415bff4125c2d9319777fea065f54b5979a22c057f9f199ff45fa29ee8d1258cecbf43b37db312af9cac3ef3267951e2e6389847d350411ba9c30a968e61350ca596f5bd6e952b5cd474ff3e42297e3a0479b51d6cc367f8595903f762020d97d8270f7880fb6f5f1f256bf4256faf38a36a4217ae17019e9e56bf3fdde8a30c0fb9ffa970d5a17058bf5d35877a963bade655bfda5f4c2253ec292c83deccbe25ee56fc76f278e7d50bcbbfaddd10482e8a61745fb5c7b22cb401a2d9ba3ab1dd3221e3feb09747a3274ca823d96803069b7cc55b1950cacc08daa36bc0b5acb1d437ef3864eaaebc702fa1d8f4845687a32334553733316f197d62e505d0543da7a76d4ce58ecc920497db7bc41dc594af1bfdbe99dc8deb8824b85da8"
     * }
     *
     * @apiError          UNAUTHORIZED 400 Invalid grant_type.
     * @apiError          UNAUTHORIZED 401 Invalid credential.
     *
     */

    /**
     * @apiDefine  api1
     * @apiHeaderExample {json} Header-Example:
     *     {
     *       "Accept": "application/json"
     *       "Authorization": "Bearer {token}"
     *     }
     */

}
