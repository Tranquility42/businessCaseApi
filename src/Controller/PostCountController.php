<?php


namespace App\Controller;


use App\Repository\PostRepository;

class PostCountController
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    public function __construct(PostRepository $postRepository){

    }
    public function __invoke():int{
        return $this->postRepository->count([]);
    }

}