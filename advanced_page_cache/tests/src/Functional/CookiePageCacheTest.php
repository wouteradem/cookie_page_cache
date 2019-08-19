<?php

namespace Drupal\Tests\cookie_page_cache\Functional;

use Drupal\Component\Datetime\DateTimePlus;
use Drupal\Core\Site\Settings;
use Drupal\Core\Url;
use Drupal\entity_test\Entity\EntityTest;
use Drupal\Core\Cache\Cache;
use Drupal\Tests\BrowserTestBase;
use Drupal\Tests\system\Functional\Cache\AssertPageCacheContextsAndTagsTrait;
use Drupal\user\RoleInterface;

/**
 * Enables the cookie page cache and tests it with a cookie.
 *
 * @group cookie_page_cache
 */
class CookiePageCacheTest extends BrowserTestBase {

  use AssertPageCacheContextsAndTagsTrait;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
  }

  /**
   * Test the setting of forms with a cookie.
   */
  public function testFormCookie() {
    // Install the module that provides the test form.
    $this->container->get('module_installer')
      ->install(['cookie_page_cache_form_test']);

    $this->drupalGet('cookie_page_cache_form_test_cookie');

    // We should now assert that the cookie value is present in cache_page table.
  }

}
