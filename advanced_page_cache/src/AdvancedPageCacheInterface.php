<?php

namespace Drupal\advanced_page_cache;

use Symfony\Component\HttpFoundation\Request;

/**
 * Defines required methods for classes wanting to add an additional Page Cache ID.
 *
 * @ingroup cache
 */
interface AdvancedPageCacheInterface {

  /**
   * Adds an additional part to the page cache ID for this request.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   A request object.
   */
  public function getAdditionalCacheIdPart(Request $request);

}