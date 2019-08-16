<?php

namespace Drupal\cookie_page_cache;

use Drupal\cookie_page_cache\StackMiddleware\CookiePageCache;
use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceModifierInterface;

/**
 * Overrides the Page Cache service to point to Cookie Page Cache's module one.
 */
class CookiePageCacheServiceProvider implements ServiceModifierInterface {

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
    $container->getDefinition('http_middleware.page_cache')->setClass(CookiePageCache::class);
  }

}