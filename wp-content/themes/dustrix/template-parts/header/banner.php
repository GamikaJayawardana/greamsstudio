<?php
$opt = get_option('dustrix_opt');
$is_breadcrumb = !empty($opt['is_breadcrumb']) ? $opt['is_breadcrumb'] : '';
?>
<section class="page-banner-wrap text-center bg-cover">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="page-heading text-white">
                    <h1><?php dustrix_banner_title(); ?></h1>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if ( $is_breadcrumb == true && !is_home() ) :?>
<div class="breadcrumb-wrapper">
    <div class="container">
        <?php if(function_exists('bcn_display')){
            bcn_display();
        }?>
    </div>
</div>
<?php endif; ?>
