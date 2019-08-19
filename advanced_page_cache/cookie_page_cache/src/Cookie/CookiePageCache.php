<?php

namespace Drupal\cookie_page_cache\Cookie;

use Drupal\advanced_page_cache\AdvancedPageCacheInterface;
use Symfony\Component\HttpFoundation\Request;

class CookiePageCache implements AdvancedPageCacheInterface{

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

  public function setCacheId(Request $request) {
    return $request->cookies->get($this->cookie, 'default');
  }

}
