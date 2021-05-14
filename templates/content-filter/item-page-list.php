<?php
$post_id = get_the_ID();
$cats = get_the_terms( $post_id, 'category' );
$link = get_the_permalink($post_id);

?>
<div class="item-content-filter item-page">
  <div class="__info">
    <a href="<?php the_permalink(); ?>">
        <h3 class="__title"><?php the_title(); ?></h3>
        <p class="__link"> <?php echo $link; ?> </p>
    </a>
    <div class="__content">
      <?php the_excerpt(); ?>
    </div>
  </div>
</div>
<?php
