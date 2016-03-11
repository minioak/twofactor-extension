<?php namespace Minioak\TwofactorExtension;

use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Security\SecurityCheckExtension;

use Minioak\TwofactorExtension\Command\Login2FA;

class TwofactorExtension extends SecurityCheckExtension
{

    /**
     * This extension provides...
     *
     * This should contain the dot namespace
     * of the addon this extension is for followed
     * by the purpose.variation of the extension.
     *
     * For example anomaly.module.store::gateway.stripe
     *
     * @var null|string
     */
    protected $provides = 'anomaly.module.users::security_check.twofa_authentication';

    /**
     * Check a login attempt.
     *
     * @return bool|Response
     */
    public function attempt()
    {
        return true;
    }
    
    /**
     * Check an HTTP request.
     *
     * @param UserInterface $user
     * @return bool|Response
     */
    public function check(UserInterface $user = null)
    {
        if (is_null($user) || is_null($user->twofa_secret)) {
            return true;
        }

        return $this->dispatch(new Login2FA($user));
    }
}
