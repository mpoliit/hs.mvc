<?php

namespace Controllers\Api\v1\post;

use Controllers\Api\v1\Controller;

class Post extends Controller
{
    public function __invoke()
    {
        $this->before();
        $this->getHeaders();

        $post = new \Models\Post();
        $allPost = $post->selectAllPost();

        echo json_encode([
            'code'          => 200,
            'name'          => 'OK',
            'description'   => '',
            'data'          => $allPost
        ]);
    }

}