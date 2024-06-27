<?php

namespace App\Normalizer;

use App\Entity\User;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class UsersNormalizer implements ContextAwareNormalizerInterface
{

    private $router;
    private $normalizer;

    public function supportsNormalization($data, string $format = null, array $context = []) : bool
    {
        // TODO: Implement supportsNormalization() method.
        return $data instanceof User;
    }

    public function normalize($user, string $format = null, array $context = []) : array
    {
        // TODO: Implement normalize() method.
        return
            [
                'id'=>$user->getId() ,
                'username' =>$user->getUsername(),
                'Roles'=>$user->getRoles()->getId(),
                'mail'=>$user->getMail(),

        ];

    }

}