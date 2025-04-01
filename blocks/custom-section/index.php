<?php
error_log('Custom Section Block Rendered');

// Determine text alignment (left or right)
$alignment = get_field('text_position') == 'left' ? 'left' : 'right';

// Retrieve ACF fields
$title = get_field('title');
$visible_text = get_field('visible_text'); 
$hidden_text = get_field('hidden_text'); 
$read_more_text = get_field('read_more_text'); 
$image = get_field('image');
$button_color = get_field('button_color') ?: '#e6007e';

// TEXT, TITLE, AND "READ MORE" COLORS
$title_color = get_field('title_color') ?: '#020202'; 
$text_color = get_field('text_color') ?: '#4a4a4a'; 
$read_more_color = get_field('read_more_color') ?: 'rgb(64, 179, 49)'; 

// SETTING THE BACKGROUND
$background_type = get_field('background_type');
$color1 = get_field('background_color_1');
$color2 = get_field('background_color_2');
$color3 = get_field('background_color_3');
$custom_gradient = get_field('custom_gradient');

// Apply background styles based on selected type
if ($background_type == 'solid') {
    $background_style = "background-color: $color1;";
} elseif ($background_type == 'gradient') {
    $background_style = "background: linear-gradient(135deg, $color2, $color3);";
} elseif (!empty($custom_gradient)) {
    $background_style = "background: $custom_gradient;";
} else {
    $background_style = "";
}

// BUTTON
$button_link = get_field('button_link');
?>

<section class="custom-section" style="<?php echo esc_attr($background_style); ?>;">
    <div class="inner-container <?php echo esc_attr($alignment); ?>">

        <!-- Content Section -->
        <div class="custom-section__content col wow fadeInUp" data-wow-delay="0.5s" data-wow-duration="0.6s">
            <div class="wrap">
                <h2 style="color: <?php echo esc_attr($title_color); ?>;"><?php echo esc_html($title); ?></h2>

                <div class="text">
                    <p style="color: <?php echo esc_attr($text_color); ?>;">
                        <?php echo esc_html($visible_text); ?>
                        <span><?php echo esc_html($hidden_text); ?></span>
                    </p>
                    <a href="#" class="read-more" style="color: <?php echo esc_attr($read_more_color); ?>;">
                        <?php echo esc_html($read_more_text); ?>
                    </a>
                </div>

                <!-- Button (if set in ACF) -->
                <?php if ($button_link):
                    $button_url = $button_link['url'];
                    $button_title = $button_link['title'];
                    $button_target = $button_link['target'] ? $button_link['target'] : '_self';
                ?>
                    <a href="<?php echo esc_url($button_url); ?>" target="<?php echo esc_attr($button_target); ?>"
                        class="button" style="background: <?php echo esc_attr($button_color); ?>;">
                        <?php echo esc_html($button_title); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Image Section -->
        <div class="custom-section__image col wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="0.6s">
            <div class="wrap">
                <?php if ($image): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>