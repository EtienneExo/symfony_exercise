<?php

namespace App\Controller;


use App\Entity\Role;
use App\Entity\User;
use App\Normalizer\UsersNormalizer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use App\Form\UserType;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use App\Repository\UserRepository;


class UsersController extends AbstractController
{

    /**
     * @Route ("/account/new",name="account_new")
     * @Route ("/account/edit/{id}",name="account-edit")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     *
     */
    public function accountForm(Request $request, EntityManagerInterface $entityManager): Response
    {

        $update = false;

        //dd($request);

        if($request->attributes->get('_route')==='account-edit')
        {
            //dd($request);
            $userSession = $this->getUser();
            //$filter = $this->get('session')->get('filter');
            //$idRoleUser =  $filter['idRole'];
            $idUser = $userSession->getId();
           // if($idUser == $request->attributes->get('id')||$idRoleUser == 1 )
           // {
                //$user=$entityManager->getRepository(User::class)->find($request->attributes->get('id'));

            //}else
            //{
                //return $this->redirectToRoute('index');
            //}
            if($idUser == $request->attributes->get('id') || $userSession->getRole()->getId() == 1)
             {
            //$user=$entityManager->getRepository(User::class)->find($request->attributes->get('id'));
                 $user = $entityManager->getRepository(User::class)->find($request->attributes->get('id'));
                 $idRole = $user->getRole()->getId();

            }else
            {
              return $this->redirectToRoute('index');
            }
            $update=true;

        }else
        {
            $user = new User();
        }

//          $userForm = $this->createFormBuilder($user)
//              ->add('username', TextType::class,['attr'=>['placeholder'=>'login']])
//              ->add('password', PasswordType::class)
//              ->add('mail', EmailType::class)
//              ->add('role', EntityType::class,['class'=>Role::class,'choice_label'=>'name'])
//            ->add('Enregistrer', SubmitType::class, [ // Modifiez ici pour utiliser SubmitType
//                'attr' => ['class' => 'btn btn-success']])
//              ->getForm();

        // Remplacez la construction du formulaire avec :
        $userForm =  $this->createForm(UserType ::class, $user);

        //dd($userForm);


        if($update)
        {
                $userForm = $this->createForm(UserType::class,$user,array('validation_groups'=>('Default')));
                $userForm->remove('password');
                $userForm->remove('confirm_password');
        }else
        {
                $userForm = $this->createForm(UserType::class,$user,array('validation_groups'=>('registration')));
        }

        $userForm->handleRequest($request);

        //dd($userForm);

        if($userForm->isSubmitted() && $userForm->isValid())
        {

            $user = $userForm->getData();
            if(!$update)
            {
                $passHashed=password_hash($user->getPassword(),PASSWORD_BCRYPT);
                $user->setPassword($passHashed);

            }else
            {
                if($user->getRole()==null)
                {
                        $user->setRole($entityManager->getRepository(Role::class)->find($idRole));
                }
            }

            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('index');

        }


        // Render your template with the correct path
        return $this->render('View/auth/account.html.twig',['formAccount'=>$userForm->createView(),'editMode'=>$update]);
    }


    /**
     * @Route ("/account/check/",name="check")
     */
    public function checkUserExist(Request $request,EntityManagerInterface $manager) : Response
    {
        dd($request);

        $username = $request->request->get('username');
        $this->logger->debug('test');
        $User=$manager->getRepository(User::class)->findByUsername($username);
        $encoders = [new JsonEncoder()];
        //$normalizers = [new ObjectNormalizer()];
        $normalizers = [new UsersNormalizer(),new ObjectNormalizer()];
        $serializer = new Serializer($normalizers,$encoders);
        //$json = $serializer->serialize($User,'json',[ 'circular_reference_handler'=> function ($object)
        //{
            //return $object->getId();
        //}
        //]);
        //$this->logger->debug($json);
        $json = $serializer->serialize($User,'json');
        dd($json);
        return new JsonResponse($json);


    }



}
