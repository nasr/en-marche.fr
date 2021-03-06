<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\IdeasWorkshop\ThreadComment;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/ideasworkshop-threadcomment/{uuid}")
 * @Security("has_role('ROLE_ADMIN_IDEAS_WORKSHOP')")
 * @Entity("comment", expr="repository.findOneByUuid(uuid, true)")
 */
class AdminThreadCommentController extends Controller
{
    /**
     * Moderates a thread comment.
     *
     * @Route("/disable", methods={"GET"}, name="app_admin_thread_comment_disable")
     */
    public function disableAction(ThreadComment $comment, ObjectManager $manager): Response
    {
        $comment->disable();
        $manager->flush();
        $this->addFlash('sonata_flash_success', sprintf('Le commentaire « %s » a été modéré avec succès.', $comment->getUuid()));

        return $this->redirectToRoute('admin_app_ideasworkshop_thread_show', ['id' => $comment->getThread()->getId()]);
    }

    /**
     * Enable a thread comment.
     *
     * @Route("/enable", methods={"GET"}, name="app_admin_thread_comment_enable")
     */
    public function enableAction(ThreadComment $comment, ObjectManager $manager): Response
    {
        $comment->enable();
        $manager->flush();
        $this->addFlash('sonata_flash_success', sprintf('Le commentaire « %s » a été activé avec succès.', $comment->getUuid()));

        return $this->redirectToRoute('admin_app_ideasworkshop_thread_show', ['id' => $comment->getThread()->getId()]);
    }
}
