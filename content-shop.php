<?php
$taxonomy = 'product_cat';
$terms = get_terms($taxonomy, array('hide_empty' => true, 'exclude' => '15')); // Get all terms of a taxonomy

if ( $terms && !is_wp_error( $terms ) ) :
?>
    <div class="customMenuList">
        <?php foreach ( $terms as $term ): ?>
            <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page'  => '-1',
                    'order' => 'ASC',
                    'tax_query' => array(
                        array(
                            'taxonomy'      => 'product_cat',
                            'field' => 'term_id',
                            'terms'         => $term->term_id,
                            'operator'      => 'IN'
                        ),
                    )
                );
                $productItems = new WP_Query($args);
            ?>
            <div class="customMenuHeading">
                <h5><?php echo $term->name; ?></h5>
            </div>
            <div class="customProductList">
                <?php while ( $productItems->have_posts() ) : $productItems->the_post(); ?>
                    <?php $productDetails = wc_get_product( get_the_id() );

                    ?>
                    <div class="customProductItem">
                        <h6><a href="<?= the_permalink(); ?>"><?= the_title(); ?> - $<?= $productDetails->get_price() ?></a></h6>
                        <p>
                            <?= $productDetails->get_short_description() ?>
                        </p>
                    </div>

                <?php endwhile;?>
            </div>

        <?php endforeach; ?>
    </div>
<?php endif;


// <li><a href="<?php echo get_term_link($term->slug, $taxonomy); ">
// <?php echo $term->name;
// </a></li>
