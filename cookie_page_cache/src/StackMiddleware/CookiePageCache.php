<?php

namespace Drupal\cookie_page_cache\StackMiddleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * Cookie Page Cache class.
 */
class CookiePageCache implements HttpKernelInterface {

  /**
   * The wrapped HTTP kernel.
   *
   * @var \Symfony\Component\HttpKernel\HttpKernelInterface
   */
  protected $httpKernel;

  /**
   * The cookie.
   *
   * @var string
   */
  protected $cookie;

  /**
   * Constructs a CookiePageCache object.
   *
   * @param \Symfony\Component\HttpKernel\HttpKernelInterface $http_kernel
   *   The decorated kernel.
   * @param string $cookie
   *   The cookie.
   */
  public function __construct(HttpKernelInterface $http_kernel, $cookie) {
    $this->httpKernel = $http_kernel;
    $this->cookie = $cookie;
  }

  /**
   * Relays a method call to the decorated service.
   *
   * @param string $method_name
   *   The method to invoke on the decorated serializer.
   * @param array $args
   *   The arguments to pass to the invoked method on the decorated serializer.
   *
   * @return mixed
   *   The return value.
   */
  protected function relay($method_name, array $args) {
    return call_user_func_array([$this->httpKernel, $method_name], $args);
  }

  /**
   * {@inheritdoc}
   */
  public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true) {
    return $this->relay(__FUNCTION__, func_get_args());
  }

  /**
   * Gets the page cache ID for this request.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   A request object.
   *
   * @return string
   *   The cache ID for this request.
   */
  protected function getCacheId(Request $request) {
    $cid_parts = [
      $request->getSchemeAndHttpHost() . $request->getRequestUri(),
      $request->getRequestFormat(),
      $request->cookies->get($this->cookie, 'default'),
    ];
    return implode(':', $cid_parts);
  }

}
