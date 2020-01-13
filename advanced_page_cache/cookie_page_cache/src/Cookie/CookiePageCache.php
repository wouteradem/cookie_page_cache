<?php

namespace Drupal\cookie_page_cache\Cookie;

use Drupal\advanced_page_cache\AdvancedPageCacheInterface;
use Symfony\Component\HttpFoundation\Request;

class CookiePageCache implements AdvancedPageCacheInterface {

  private $cookie;

  /**
   * Constructs a CookiePageCache object.
   *
   * @param string $cookie
   *   The cookie.
   */
  public function __construct($cookie) {
    $this->cookie = $cookie;
  }

  /**
   * Adds a cookie value to the page cache ID for this request.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   A request object.
   */
  public function getAdditionalCacheIdPart(Request $request) {
    return $request->cookies->get('COOKIE NAME', 'default');
  }

}
