<?php
// $Id: node.tpl.php,v 1.4 2008/09/15 08:11:49 johnalbin Exp $

/**
 * @file node.tpl.php
 *
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $picture: The authors picture of the node output from
 *   theme_user_picture().
 * - $date: Formatted creation date (use $created to reformat with
 *   format_date()).
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $name: Themed username of node author output from theme_user().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $submitted: themed submission information output from
 *   theme_node_submitted().
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $teaser: Flag for the teaser state.
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 * /sites/beta.anniebungeroth.com/files/imagecache/background/
 * @see template_preprocess()
 * @see template_preprocess_node()
 */
if ($page) {

 $iPod = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
 $iPhone = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");  
 $iPad = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
 
 $node_bg = node_load($node->field_bg_photo[0][nid]);
 $content_class = $node->field_box[0]['value'] . " " . 
   $node->field_placement[0]['value'] . " " .
   $node->field_placement[1]['value'] . " " .
   $node->field_size[0]['value'];
 
   if ($iPhone) {
     $background = "iphone";
   } elseif ($iPad) {
     $background = "ipad";
   } else {
     $background = "background";
   }
  
?>  
  <div id="cont">
    <div class="<?php print $content_class;?>"><div>
      <?php print $content; ?>
    </div></div>
  </div>
	
  <div id="bg">
    <div>
      <table cellpadding="0" cellspacing="0">
        <tr>
	   <td>
	      <img id="full-screen-background-image" alt="background" src="/sites/beta.anniebungeroth.com/files/imagecache/<?php 
	      print $background; 
	      ?>/<?php
	       print $node_bg->field_photo[0][filepath]; 
	      ?>" />
	   </td>
	</tr>
      </table>
    </div>
  </div>
<?php
} else {
   print $content;
}