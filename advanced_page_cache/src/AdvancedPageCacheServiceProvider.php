<?php

namespace Drupal\advanced_page_cache;

use Drupal\Core\DependencyInjection\ServiceModifierInterface;
use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\advanced_page_cache\StackMiddleware\AdvancedPageCache;

/**
 * Overrides the Page Cache service to point to Advanced page Cache's module one.
 * Adds a service_collector Service Tag with Tag advanced_page_cache_cid
 * and a call method addCacheId.
 */
class AdvancedPageCacheServiceProvider implements ServiceModifierInterface {

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {

    // Get Core's Page Cache service.
    $pageCache = $container->getDefinition('http_middleware.page_cache');

    // Change Core's Page Cache class handler to AdvancedPageCache.
    $pageCache->setClass(AdvancedPageCache::class);

    // Add a Service Collector tag for Services.
    $pageCache->addTag('service_collector', [
      'tag' => 'advanced_page_cache_cid',
      'call' => 'addCacheId'
    ]);
  }

}