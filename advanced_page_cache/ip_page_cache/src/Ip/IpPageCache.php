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

  public function setCacheId(Request $request) {
    return '192.168.0.233';
  }

}
