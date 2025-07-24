<?php if (!$args["globals"]["financing"]["hidden"]): ?>
    <div class="mt-lg-5 mt-4 color_tertiary_bg sidbar-financing text-center py-lg-4 py-3 order-lg-3 order-3 mx-lg-0 mx-3">
        <div class="py-3">
            <div class="pb-3">
                <i class="icon-circle-dollar1 true_white text_88 line_height_88"></i>
            </div>
            <?php if (!empty($args["globals"]["financing"]["heading"])): ?>
                <h4 class="h4-alt pt-2"><?php echo $args["globals"]["financing"]["heading"]; ?></h4>
            <?php endif; ?>

            <?php if (!empty($args["globals"]["financing"]["subheading"])): ?>
                <span class="p-alt text_22 font_default text_normal line_height_25_3 pb-lg-5 pb-4 d-block">
                    <?php echo $args["globals"]["financing"]["subheading"]; ?>
                </span>
            <?php endif; ?>

            <?php if (!empty($args["globals"]["financing"]["button_link"]) && !empty($args["globals"]["financing"]["button_text"])): ?>
                <a href="<?php echo get_home_url() . $args["globals"]["financing"]["button_link"]; ?>" class="btn btn-primary mw-177">
                    <?php echo $args["globals"]["financing"]["button_text"]; ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
