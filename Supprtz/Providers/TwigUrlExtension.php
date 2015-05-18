<?php
/**
 * Slim - a micro PHP 5 framework
 *
 * @author      Josh Lockhart
 * @author      Andrew Smith
 * @link        http://www.slimframework.com
 * @copyright   2013 Josh Lockhart
 * @version     0.1.2
 * @package     SlimViews
 *
 * MIT LICENSE
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace Supprtz\Providers;

use Slim\App;

class TwigUrlExtension extends \Twig_Extension
{
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function getName()
    {
        return 'slim';
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('urlFor', array($this, 'urlFor')),
            new \Twig_SimpleFunction('url_for', array($this, 'urlFor')),
            new \Twig_SimpleFunction('url', array($this, 'urlFor')),
            new \Twig_SimpleFunction('baseUrl', array($this, 'base')),
            new \Twig_SimpleFunction('siteUrl', array($this, 'site')),
            new \Twig_SimpleFunction('currentUrl', array($this, 'currentUrl')),
            new \Twig_SimpleFunction('currentPath', array($this, 'currentPath')),
        );
    }

    public function urlFor($name, $params = array())
    {
        return $this->app['router']->urlFor($name, $params);
    }

    public function site($url)
    {
        return $this->base() . '/' . ltrim($url, '/');
    }

    public function base()
    {
        /**@var \Slim\Http\Request $request */
        $request = $this->app['request'];

        return $request->getUrl();
    }

    public function currentUrl($withQueryString = true)
    {
        /**@var \Slim\Http\Request $request */
        $request = $this->app['request'];
        $uri = $request->getUrl() . $request->getPath();

        if ($withQueryString) {
            $env = $this->app['environment'];

            if ($env['QUERY_STRING']) {
                $uri .= '?' . $env['QUERY_STRING'];
            }
        }

        return $uri;
    }

    public function currentPath()
    {
        return $this->app['request']->getUri()->getPath();
    }
}
