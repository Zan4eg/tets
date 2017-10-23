<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;


use AppBundle\Form\UserType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/display/{userId}", name="display")
     */
    public function displayAction(Request $request, $userId)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id ' . $userId
            );
        }

        if ($user->getModeratedLabel() != "Success") {
            return $this->render('default/display/forbidden.html.twig');
        }

        return $this->render('default/display/index.html.twig', [
            'user'   => $user,
            'images' => $user->getImagesList()
        ]);    
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $user = new User();

        $flow = $this->get('form.flow.createUser');
        $flow->bind($user);

        $form = $flow->createForm();

        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                $form = $flow->createForm();
            } else {

                foreach ($user->images as $image) {
                    $image->save($this->container->getParameter('passport_files_dir'));
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $flow->reset();

                return $this->render('default/register/done.html.twig', array(
                    'user' => $user,
                    'images' => $user->getImagesList()
                ));
            }
        }

        return $this->render('default/register/index.html.twig', array(
            'form' => $form->createView(),
            'flow' => $flow,
        ));
    }
}
