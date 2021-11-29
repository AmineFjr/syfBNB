<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Comment;
use App\Form\AdminBookingType;
use App\Form\AdminCommentType;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBookingController extends AbstractController
{

    /**
     * @Route("/admin/booking",name = "admin_booking_index")
     * @return Response
     */
    public function index(BookingRepository $booking): Response
    {

        return $this->render('admin/booking/index.html.twig', [
            'controller_name' => 'AdminBookingController',
            'bookings' => $booking->findAll()
        ]);
    }

    /**
     * Permet de modifier une réservation
     *
     * @Route("/admin/booking/{id}/edit",name = "admin_booking_edit")
     * @param Booking $booking
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function edit(Booking $booking,Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(AdminBookingType::class,$booking);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $booking->setAmount(0);
            $manager->persist($booking);
            $manager->flush();

            $this->addFlash(
                'success',
                "La réservation n° {$booking->getId()}</strong> a bien été modifiée !"
            );

            return $this->redirectToRoute("admin_booking_index");
        }

        return $this->render('admin/booking/edit.html.twig',[
            'booking' => $booking,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet de supprimer une annonce
     *
     * @Route("/admin/booking/{id}/delete",name = "admin_booking_delete")
     * @param Booking $booking
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Booking $booking,EntityManagerInterface $manager)
    {

        $manager->remove($booking);
        $manager->flush();

        $this->addFlash(
            'success',
            "La réservation a bien été supprimée !"
        );


        return $this->redirectToRoute('admin_ads_index');
    }
}
