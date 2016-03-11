<?php namespace Minioak\TwofactorExtension\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Minioak\TwofactorExtension\TwofactorExtension;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\UserAuthenticator;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class ThrottleLogin
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\ThrottleSecurityCheckExtension\Command
 */
class Login2FA implements SelfHandling
{

    use DispatchesJobs;
    
    /**
     * The user instance.
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * Create a new CheckUser instance.
     *
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the command.
     *
     * @param Repository                     $cache
     * @param Request                        $request
     * @param UserAuthenticator              $authenticator
     * @param SettingRepositoryInterface     $settings
     * @param ThrottleSecurityCheckExtension $extension
     * @return bool
     */
    public function handle(
        Repository $cache,
        Request $request,
        UserAuthenticator $authenticator,
        SettingRepositoryInterface $settings,
        TwofactorExtension $extension
    ) {
        if ($request->session()->get('minioak::twofa::authenticated')) {
            return true;
        }
        
        return $this->dispatch(new MakeResponse());
    }

}
