<?php

namespace Drupal\advanced_page_cache;

use Drupal\Core\DependencyInjection\ServiceModifierInterface;
use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\advanced_page_cache\StackMiddleware\AdvancedPageCache;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Overrides the Page Cache service to point to Advanced page Cache's module one.
 * Adds a service_collector Service Tag with Tag page_cache_cid.
 * Adds an Argument to pass the variable
 */
class AdvancedPageCacheServiceProvider implements ServiceModifierInterface {

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
    $pageCache = $container->getDefinition('http_middleware.page_cache');
    $pageCache->setClass(AdvancedPageCache::class);

    // Not sure about this.
    $pageCache->addTag('service_collector');
    $pageCache->addTag('advanced_page_cache_cid', ['priority' => 201]);

    // How can we pull in custom arguments by other custom modules?
    // By naming convention? Or should the module implementer add the argument?
    $pageCache->addArgument(new Reference('advanced_page_cache.cid'));
  }

}