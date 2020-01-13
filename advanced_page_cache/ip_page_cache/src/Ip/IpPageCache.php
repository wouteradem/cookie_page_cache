<?php

namespace Drupal\ip_page_cache\Ip;

use Drupal\advanced_page_cache\AdvancedPageCacheInterface;
use Symfony\Component\HttpFoundation\Request;

class IpPageCache implements AdvancedPageCacheInterface {

  private $ip;

  /**
   * Constructs a IpPageCache object.
   *
   * @param string $ip
   *   The IP address.
   */
  public function __construct($ip) {
    $this->ip = $ip;
  }

  /**
   * Adds the IP address to the page cache ID for this request.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   A request object.
   */
  public function getAdditionalCacheIdPart(Request $request) {
    return Request::getClientIp();
  }

}
