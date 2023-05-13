<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/forum')]
class ForumController extends AbstractController
{
    private $currentPostAuthor;

    #[Route('/', name: 'app_forum_index', methods: ['GET'])]
    public function index(PostRepository $postRepository): Response
    {
     
        
        $title = "coin forum";
        $titlePage = ucwords($title);
        

        
        return $this->render('forum/index.html.twig', [
            'titre' => $titlePage,
            'posts' => $postRepository->findAll(),
        ]);
        
    }

    #[Route('/new', name: 'app_forum_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PostRepository $postRepository): Response
    {
        $user = new User();
        $post = new Post();

        if($this->getUser())
        {
            $user = $this->getUser();
            $userId = $user->getId();
            $username = $user->getUsername();
        }


        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $author = $user->getId();
            $post->setAuthor($user);

            $postTitle = $post->getTitle();
            $post->setSlug($postTitle);



            $postRepository->save($post, true);
            return $this->redirectToRoute('app_forum_index', [], Response::HTTP_SEE_OTHER);
        }

        $title = "crée une nouvelle publication";
        $titlePage = ucwords($title);

        return $this->renderForm('forum/new.html.twig', [
            'titre' => $titlePage,
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_forum_show', methods: ['GET'])]
    public function show(Post $post): Response
    {
       
        $currentPostAuthor = $post->getAuthor();

        return $this->render('forum/show.html.twig', [
            'post_creator' => $currentPostAuthor,
            'post' => $post,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_forum_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Post $post, PostRepository $postRepository): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postRepository->save($post, true);

            return $this->redirectToRoute('app_forum_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('forum/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_forum_delete', methods: ['POST'])]
    public function delete(Request $request, Post $post, PostRepository $postRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $postRepository->remove($post, true);
        }

        return $this->redirectToRoute('app_forum_index', [], Response::HTTP_SEE_OTHER);
    }
}
