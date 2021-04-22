<?php
$post_id = get_the_ID();
$types = get_the_terms( $post_id, 'ins-type' );
?>
<div class="item-content-filter">
    <div class="__meta">
        <?php if(!empty($types)): ?>
          <div class="__meta--type">
            <span class="__meta--color" style="background-color:<?php  echo get_field('color', $types[0]); ?>;"></span>
            <?php echo $types[0]->name; ?>
          </div>
        <?php endif; ?>
        <div class="__meta--date">
          <?php echo get_the_date('d/m/Y'); ?>
        </div>
    </div>
    <div class="__featured-img">
        <?php the_post_thumbnail('medium'); ?>
    </div>
    <div class="__info">
      <a href="<?php the_permalink(); ?>"><h3 class="__title"><?php the_title(); ?></h3></a>
      <div class="__content">
        <?php the_field('short_description'); ?>
      </div>
      <a href="<?php the_permalink(); ?>" class="btn-readmore"><?php echo __('Read more','bearsthemes-addons'); ?></a>
    </div>
</div>
<?php
