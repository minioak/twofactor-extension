<?php namespace Minioak\TwofactorExtension\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;

/**
 * Class MakeResponse
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\ThrottleSecurityCheckExtension\Command
 */
class MakeResponse implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param SettingRepositoryInterface $settings
     * @param ResponseFactory            $response
     * @param Factory                    $view
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(SettingRepositoryInterface $settings, ResponseFactory $response, Factory $view)
    {
        $lockoutInterval = 1;
        return $response->make($view->make('minioak.extension.twofactor::twofa', []), 200)->setTtl($lockoutInterval * 1);
    }
}
