<?php
$id_team = get_the_ID();
$thumbnail_url = get_the_post_thumbnail_url($id_team);
$postions = get_field('position_team_insuranceca');
$addrress = get_field('addrress_team_insuranceca');
$listSocial = get_field('list_social_team_insuranceca');
$lengthDescription = strlen(get_the_content());
global $post;
$post_slug = $post->post_name;
?>
<div id="post-<?php the_ID(); ?>" class="item-team">
    <div class="content-team">
        <div class="thumbnail-team">
            <div class="avatar" style="background-image:url('<?php echo $thumbnail_url ?>')"></div>
        </div>
        <div class="meta-team">
            <div class="header-meta">
                <h3 class="name name-team" data-name="<?php echo $post_slug; ?>"> <?php the_title(); ?> </h3>
                <?php if ($listSocial): ?>
                    <div class="list-social-team">
                        <?php foreach ($listSocial as $key => $social): ?>
                            <a href="<?php echo $social['link'] ?>">
                                <i class="fa <?php echo $social['icon'] ?>" aria-hidden="true"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($postions): ?>
                <p class="positions _item-info"> <?php echo $postions ?>  </p>
            <?php endif; ?>
            <?php if ($addrress): ?>
                <p class="addrress _item-info"> <?php echo $addrress ?>  </p>
            <?php endif; ?>
            <div class="description"> <?php the_content(); ?> </div>
        </div>
    </div>

    <?php if ($lengthDescription > 425): ?>
        <div class="cta show-more">
            <span data-state="1">Expand</span>
        </div>
    <?php endif; ?>
</div>
