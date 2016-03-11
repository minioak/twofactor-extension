<?php namespace Minioak\TwofactorExtension\Http\Controller;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\Config\Repository;
use App\User;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use PragmaRX\Google2FA\Google2FA;

/**
 * Class GroupsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\VariablesModule\Http\Controller\Admin
 */
class AuthenticateController extends PublicController
{
    
    public function index(Redirector $redirect, Repository $config)
    {
        $secret = $this->request->input('twofa');
        $twofa = new Google2FA();
        
        $valid = $twofa->verifyKey(\Auth::user()->twofa_secret, $secret);
        
        if ($valid === false) {
            $this->messages->error('Your code was not accepted. Please try again');
        } else {
            $this->request->session()->put('minioak::twofa::authenticated', true);
        }
        
        return $redirect->to($config->get('anomaly.module.users::paths.home', 'admin/dashboard'));
    }

}
