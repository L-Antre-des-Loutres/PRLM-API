<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\InMemoryUser;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class ApiKeyAuthenticator extends AbstractAuthenticator
{
    public function __construct(
        #[Autowire('%env(SECRET_TOKEN)%')] private string $apiToken
    ) {
    }

    /**
     * Header check
     */
    public function supports(Request $request): ?bool
    {
        return $request->headers->has('TOKEN');
    }

    /**
     * Token check
     */
    public function authenticate(Request $request): Passport
    {
        $apiToken = $request->headers->get('TOKEN');

        if (null === $apiToken || $apiToken !== $this->apiToken) {
            // Bad token
            throw new CustomUserMessageAuthenticationException('Invalid token');
        }

        // TODO : USE REAL USERS ONCE IMPLEMENTED
        // Since there is no "User" table, we create a placeholder user "api_user"
        return new SelfValidatingPassport(
            new UserBadge('api_user', function (string $userIdentifier) {
                // User will exist only for the request
                return new InMemoryUser($userIdentifier, null);
            })
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // Auth success
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        // Auth failed
        return new JsonResponse(
            ['message' => strtr($exception->getMessageKey(), $exception->getMessageData())],
            Response::HTTP_UNAUTHORIZED
        );
    }
}
