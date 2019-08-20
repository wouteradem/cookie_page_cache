<?php

namespace Drupal\advanced_page_cache\StackMiddleware;

use Drupal\advanced_page_cache\AdvancedPageCacheInterface;
use Drupal\page_cache\StackMiddleware\PageCache;
use Symfony\Component\HttpFoundation\Request;

/**
 * Advanced Page Cache class.
 */
class AdvancedPageCache extends PageCache implements AdvancedPageCacheInterface {

  private $caches = [];

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
    if (!isset($this->cid)) {
      $cid_parts = [
        $request->getSchemeAndHttpHost() . $request->getRequestUri(),
        $request->getRequestFormat(NULL),
      ];
      // TODO: Rework -> this looks ugly...
      $additional_parts = $this->setCacheId($request);
      foreach ($additional_parts as $cid_part) {
        $cid_parts[] = $cid_part;
      }
      // Add the array to the end of $cid_parts.
      $this->cid = implode(':', $cid_parts);
    }

    return $this->cid;
  }

  public function addCacheId(AdvancedPageCacheInterface $cache) {
    $this->caches[] = $cache;
  }

  public function setCacheId(Request $request) {
    $cid_parts = [];
    foreach ($this->caches as $cache) {
      $cid_parts[] = $cache->setCacheId($request);
    }

    return $cid_parts;
  }
}
