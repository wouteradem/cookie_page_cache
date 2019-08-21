<?php

namespace Drupal\advanced_page_cache\StackMiddleware;

use Drupal\advanced_page_cache\AdvancedPageCacheInterface;
use Drupal\page_cache\StackMiddleware\PageCache;
use Symfony\Component\HttpFoundation\Request;

/**
 * Advanced Page Cache class.
 */
class AdvancedPageCache extends PageCache implements AdvancedPageCacheInterface {

  /**
   * Holds an array of cache IDs.
   *
   * @var \Drupal\advanced_page_cache\AdvancedPageCacheInterface[]
   */
  protected $cacheIds = [];

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
      $this->cid = implode(':', $cid_parts);
      $this->cid .= $this->setCacheId($request);
    }
    
    return $this->cid;
  }

  /**
   * @param \Drupal\advanced_page_cache\AdvancedPageCacheInterface $cacheId
   *   A service object.
   *
   * @return \Drupal\advanced_page_cache\AdvancedPageCacheInterface[] $cacheIds
   *   Array of Services that implement AdvancedPageCacheInterface.
   */
  public function addCacheId(AdvancedPageCacheInterface $cacheId) {
    $this->cacheIds[] = $cacheId;
  }

  /**
   * {@inheritdoc}
   */
  public function setCacheId(Request $request) {
    $cid_parts = [];
    foreach ($this->cacheIds as $cacheId) {
      $cid_parts[] = $cacheId->setCacheId($request);
    }

    return implode(':', $cid_parts);
  }
}
