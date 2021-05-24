<?php
$post_id = get_the_ID();
$types = get_the_terms( $post_id, 'ins-type' );
$upload_file = get_field( 'upload_file' );
$link_resources = get_permalink() ;
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

        <?php if(!empty($upload_file) && trim($upload_file['subtype'])){
          ?><a href="<?php echo $upload_file['url']; ?>">
              <?php the_post_thumbnail('medium'); ?>
          </a><?php
        }else{
          ?><a href="<?php echo $link_resources ?>">
              <?php the_post_thumbnail('medium'); ?>
          </a><?php
        } ?>

    </div>
    <div class="__info">
      <?php if(!empty($upload_file) && trim($upload_file['subtype'])){
        ?><a href="<?php echo $upload_file['url']; ?>"><h3 class="__title"><?php the_title(); ?></h3></a><?php
      }else{
        ?><a href="<?php echo $link_resources ?>"><h3 class="__title"><?php the_title(); ?></h3></a><?php
      } ?>
      <div class="__content">
        <?php the_excerpt(); ?>
      </div>
      <?php if(!empty($upload_file) && trim($upload_file['subtype'])){
        ?><a href="<?php echo $upload_file['url']; ?>" class="btn-readmore">Download <?php echo strtoupper($upload_file['subtype']); ?></a><?php
      }else{
        ?><a href="<?php echo $link_resources ?>" class="btn-readmore"><?php echo __('Read more','bearsthemes-addons'); ?></a><?php
      } ?>
    </div>
</div>
<?php
