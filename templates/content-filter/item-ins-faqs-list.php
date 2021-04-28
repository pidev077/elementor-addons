<?php
$post_id = get_the_ID();
$cats = get_the_terms( $post_id, 'cat-faq' );
$post_status = get_post_status();
?>
<div class="item-content-filter post-faq <?php echo ($item == 0) ? '__is-actived __is-showed' : ''; ?>">
  <h3 class="__title"><?php the_title(); ?> <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
  <div class="__info">
    <div class="__content">
      <?php the_content(); ?>
    </div>
  </div>
</div>
<?php $item++;
