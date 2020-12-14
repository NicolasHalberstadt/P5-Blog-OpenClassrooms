<?php
/* User: nicolashalberstadt 
* Date: 14/12/2020 
* Time: 09:12
*/

namespace app\core;

/**
 * Class Application
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package App\core
 */
class Application
{
    public Router $router;
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run()
    {
        $this->router->resolve();
    }
}