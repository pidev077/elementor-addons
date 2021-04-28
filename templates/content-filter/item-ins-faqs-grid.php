<?php
$post_id = get_the_ID();
$cats = get_the_terms( $post_id, 'cat-faq' );
?>
<div class="item-content-filter post-faq">
  <div class="__meta">
    <?php if(!empty($cats)): ?>
      <div class="__meta--type">
        <?php echo $cats[0]->name; ?>
      </div>
    <?php endif; ?>
  </div>
  <div class="__info">
    <a href="<?php the_permalink(); ?>"><h3 class="__title"><?php the_title(); ?></h3></a>
    <div class="__content">
      <?php the_excerpt(); ?>
    </div>
    <a href="<?php the_permalink(); ?>" class="btn-readmore"><?php echo __('View full answer','bearsthemes-addons'); ?></a>
  </div>
</div>
<?php
