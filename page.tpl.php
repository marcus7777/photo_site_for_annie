<?php
// $Id: page.tpl.php,v 1.13 2008/09/15 08:31:58 johnalbin Exp $

/**
 * @file page.tpl.php
 *
 * Theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the theme is located in, e.g. themes/garland or
 *   themes/garland/minelli.
 * - $is_front: TRUE if the current page is the front page. Used to toggle the mission statement.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Page metadata:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $body_classes: A set of CSS classes for the BODY tag. This contains flags
 *   indicating the current layout (multiple columns, single column), the current
 *   path, whether the user is logged in, and so on.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $search_box: HTML to display the search box, empty if search has been disabled.
 * - $primary_links (array): An array containing primary navigation links for the
 *   site, if they have been configured.
 * - $secondary_links (array): An array containing secondary navigation links for
 *   the site, if they have been configured.
 *
 * Page content (in order of occurrance in the default page.tpl.php):
 * - $left: The HTML for the left sidebar.
 *
 * - $breadcrumb: The breadcrumb trail for the current page.
 * - $title: The page title, for use in the actual HTML content.
 * - $help: Dynamic help text, mostly for admin pages.
 * - $messages: HTML for status and error messages. Should be displayed prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the view
 *   and edit tabs when displaying a node).
 *
 * - $content: The main content of the current Drupal page.
 *
 * - $right: The HTML for the right sidebar.
 *
 * Footer/closing data:
 * - $feed_icons: A string of all feed icons for the current page.
 * - $footer_message: The footer message as defined in the admin settings.
 * - $footer : The footer region.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic content.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */
 $result = db_query('SELECT nid FROM `node` WHERE `type` = "blog"  ORDER BY `node`.`created`  DESC LIMIT 1');
 $result = db_fetch_object($result);
 $last_blog = $result->nid;
 
 $iPod = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
 $iPhone = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
 $iPad = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
 
if ( $iPod || $iPhone || $iPad )  {$body_classes .= " iPad"; }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">

<head>
 <title><?php print $head_title; ?></title>
  <?php print $head; ?><?php  $styles; ?>
  <meta name="viewport" content="width=device-width, initial-scale=.6">
  <link type="text/css" rel="stylesheet" media="all" href="/sites/all/modules/lightbox2/css/lightbox.css?3" />
  <link type="text/css" rel="stylesheet" media="all" href="/sites/all/modules/t/public_html/sites/all/modules/extlink/extlink.css?3" />
<link type="text/css" rel="stylesheet" media="all" href="/sites/all/themes/photo_site_for_annie/photo_site_for_annie.css?3" />
<link type="text/css" rel="stylesheet" media="print" href="/sites/all/themes/photo_site_for_annie/print.css?3" />
  <meta name="google-site-verification" content="epc5o33gaca_68_WaWj3qXsrmETF3hQ_K8CvshwY_fs" />
  <script type="text/javascript"><?php /* Needed to avoid Flash of Unstyled Content in IE */ ?> </script>
</head>
<body class="<?php print $body_classes; ?>"><?php if (!empty($admin)) print $admin; ?>
  <?php print $content; ?>
  <div id="menu"><div>
    <?php if ($secondary_links): ?>
      <div id="secondary">
        <?php print theme('links', $secondary_links); ?>
      </div> <!-- /#secondary -->
    <?php endif; ?>
    <?php if ($primary_links): ?>
      <div id="primary">
        <?php print theme('links', $primary_links); ?>
      </div> <!-- /#primary -->
    <?php endif; ?>
    <a href="<?php print $base_path; ?>" title="<?php print t('Click here to go Home'); ?>" rel="home" id="site-name">
      <span style="color: #72ccea">annie</span>bungeroth<br /><span class="slogan"><?php print t($site_slogan); ?></span>
    </a><span id=copyright > <?php print l("©", "node/332"); ?></span>
    
    
    <div id=fixed_menu />
      <ul>
         <li><?php 
              print l(t("home"), "<front>");
            ?> </li> 
        <li> <?php 
              print l(t("blog"), "node/". $last_blog);
            ?></li>
            <li><?php 
              print l(t("published"), "node/538");
            ?></li>
            <li><?php 
              print l(t("about me"), "node/371");
            ?></li>
        <li><?php 
              print l(t("contact me"), "node/19");
            ?></li>
            
      </ul>
    </div>
  </div></div>
  <?php if ($show_messages && $messages): ?>
    <div id="lightboxAutoModal" rel="[height:300px]" style="display: none;height:300px" ><?php print $messages; ?></div>
  <?php endif; ?>
</body>
  <?php print $scripts; ?>

</html>
