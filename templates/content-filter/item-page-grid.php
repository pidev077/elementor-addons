<?php
$post_id = get_the_ID();
$cats = get_the_terms( $post_id, 'category' );
?>
<div class="item-content-filter item-page">
  <div class="__meta">
    <?php if(!empty($cats)): ?>
      <div class="__meta--type">
        <?php echo $cats[0]->name; ?>
      </div>
    <?php endif; ?>
  </div>
  <div class="__info">
    <a href="<?php the_permalink(); ?>"><h3 class="__title">
        <?php
            $key = strtolower($key);
            $title = strtolower( get_the_title( get_the_ID() ) );
            $title_replace = "<span class='__text-highligh'>$key</span>";
            echo str_replace($key, $title_replace, $title);
         ?>
    </h3></a>
    <div class="__content">
        <?php
            $excerpt = get_the_excerpt();
            $excerpt_replace = "<span class='__text-highligh'>$key</span>";
            echo str_replace($key, $excerpt_replace, $excerpt);
        ?>

    </div>
    <a href="<?php the_permalink(); ?>" class="btn-readmore"><?php echo __('Read more','bearsthemes-addons'); ?></a>
  </div>
</div>
<?php
