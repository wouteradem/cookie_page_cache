<?php

namespace Drupal\advanced_page_cache\StackMiddleware;

use Drupal\page_cache\StackMiddleware\PageCache;
use Symfony\Component\HttpFoundation\Request;

/**
 * Advanced Page Cache class.
 */
class AdvancedPageCache extends PageCache {

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
        // How do you get all the services tagged with 'advanced_page_cache_cid'? And call the method
        // setCacheId()?
      ];
      // Add the array to the end of $cid_parts.
      $this->cid = implode(':', $cid_parts);
    }
    return $this->cid;
  }

}
