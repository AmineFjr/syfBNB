<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\AdminCommentType;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCommentController extends AbstractController
{

    /**
     * Permet d'afficher les conmmentaires
     *
     * @Route("/admin/comments",name = "admin_comments_index")
     * @return Response
     */
    public function index(CommentRepository $comment): Response
    {
        return $this->render('admin/comments/index.html.twig', [
            'controller_name' => 'AdminCommentController',
            'comments' => $comment->findAll()
        ]);
    }

    /**
     * Permet de modifier les commentaires
     *
     * @Route("/admin/comments/{id}/comment",name = "admin_comments_edit")
     * @param Comment $comment
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function edit(Comment $comment,Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(AdminCommentType::class,$comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le commentaire <strong>{$comment->getId()}</strong> a bien été enregistrée !"
            );
        }

        return $this->render('admin/comments/edit.html.twig',[
            'comments' => $comment,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet de supprimer une commentaire
     *
     * @Route("/admin/comments/{id}/delete",name = "admin_comments_delete")
     * @param Comment $comment
     * @return Response
     */
    public function delete(Comment $comment,EntityManagerInterface $manager)
    {

            $manager->remove($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le commentaire de <strong>{$comment->getAuthor()->getFullName()}</strong> a bien été supprimé !"
            );


        return $this->redirectToRoute('admin_comments_index');
    }


}
