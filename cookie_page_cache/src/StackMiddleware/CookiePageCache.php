<?php

namespace Drupal\cookie_page_cache\StackMiddleware;

use Drupal\page_cache\StackMiddleware\PageCache;
use Symfony\Component\HttpFoundation\Request;

/**
 * Extends PageCache based on a cookie value.
 */
class CookiePageCache extends PageCache {

  /**
   * Implements getCacheId.
   *
   * @inheritdoc
   */
  protected function getCacheId(Request $request) {
    $cid_parts = [
      $request->getSchemeAndHttpHost() . $request->getRequestUri(),
      $request->getRequestFormat(),
      $request->cookies->get('cookie:john_doe', 'default'),
    ];
    return implode(':', $cid_parts);
  }

}
