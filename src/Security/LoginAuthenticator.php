<?php

namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

class LoginAuthenticator extends AbstractAuthenticator
{

    private UserRepository $usersRepository;
    private UrlGeneratorInterface $urlGenerator;

    // Cette méthode détermine si l'authentificateur doit être utilisé pour la requête actuelle

    /**
     * @param UserRepository $usersRepository
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UserRepository $usersRepository,UrlGeneratorInterface $urlGenerator)
    {
        $this->usersRepository= $usersRepository;
        $this->urlGenerator = $urlGenerator;
    }

    public function supports(Request $request): ?bool
    {
        // Logique pour vérifier si cette requête doit utiliser cet authentificateur
        return $request->attributes->get('_route') === 'login' && $request->isMethod('POST');
    }


    // Appelée lors d'une authentification réussie
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // Logique après une authentification réussie, par exemple rediriger l'utilisateur
        //dd($token);
        return null; // Modifier selon la logique appropriée
    }

    public function authenticate(Request $request): PassportInterface
    {
        // TODO: Implement authenticate() method.
        $user = $this->usersRepository->findOneByLowerUsername($request->request->get('username'));

        //dd($user);

        if (!$user) {
            throw new CustomUserMessageAuthenticationException('Invalid credentials');
        }
        //$request->getSession()->set('filter', ['username' => $user->getUsername(), 'idRole' => $user->getRoles()->getId(), 'idUser' => $user->getId()]);
        //return new Passport($user, new PasswordCredentials($request->request->get('password')),
           // [
                //new CsrfTokenBadge('login_form', $request->request->get('csrf_token'))
            //]);


        $passport = new Passport(

            new UserBadge($user->getUsername()),
            new PasswordCredentials($request->request->get('password')),
            [
                new CsrfTokenBadge('login_form', $request->request->get('csrf_token'))
            ]
        );
        //dd(new CsrfTokenBadge('login_form', $request->request->get('csrf_token')));
        //dd($passport);
        return $passport;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        // TODO: Implement onAuthenticationFailure() method.
        $request->getSession()->getFlashBag()->add('error', 'invalid login/password');
        //dd($request);
        return new RedirectResponse($this->urlGenerator->generate('index'));
    }


}
