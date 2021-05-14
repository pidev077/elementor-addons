<?php
$post_id = get_the_ID();
$cats = get_the_terms( $post_id, 'category' );
$link = get_the_permalink($post_id);

?>
<div class="item-content-filter item-page">
  <div class="__info">
    <a href="<?php the_permalink(); ?>">
        <h3 class="__title">
            <?php
                $key_title = strtolower($key);
                $title = strtolower( get_the_title( get_the_ID() ) );
                $title_replace = "<span class='__text-highligh'>$key</span>";
                echo str_replace($key_title, $title_replace, $title);
             ?>
        </h3>
        <p class="__link"> <?php echo $link; ?> </p>
    </a>
    <div class="__content">
        <?php
            $excerpt = get_the_excerpt();
            $excerpt_replace = "<span class='__text-highligh'>$key</span>";
            echo str_replace($key, $excerpt_replace, $excerpt);
        ?>
    </div>
  </div>
</div>
<?php
