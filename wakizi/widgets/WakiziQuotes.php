<?php

class WP_Widget_WakiziQuotes extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array('classname' => 'widget_wakiziquotes', 'description' => __('Shows random quotes', 'wakizi'));
        $control_ops = array('width' => 600, 'height' => 350);
        parent::__construct('wakiziquotes', __('Wakizi Quotes', 'wakizi'), $widget_ops, $control_ops);
    }

    public function widget($args, $instance)
    {
        extract($args);
        $text = apply_filters('widget_text', empty($instance['text']) ? '' : $instance['text'], $instance);

        $text = str_replace(array("\r\n", "\r"), "\n", $text);

        $lines = array_filter(array_map('trim', explode("\n", $text)));

        if (0 === count($lines)) {
            return;
        }

        shuffle($lines);

        list($quote, $author) = explode('|', $lines[0]);

        echo $before_widget;
        ?>
            <blockquote class="wakiziquoteswidget">
                <p><?php echo wakizi_add_esszett_fix_wrapper($quote); ?></p>
                <footer>
                    <cite><?php echo wakizi_add_esszett_fix_wrapper($author); ?></cite>
                </footer>
            </blockquote>
        <?php
        echo $after_widget;
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        if (current_user_can('unfiltered_html'))
            $instance['text'] =  $new_instance['text'];
        else
            $instance['text'] = stripslashes(wp_filter_post_kses(addslashes($new_instance['text']))); // wp_filter_post_kses() expects slashed

        return $instance;
    }

    public function form($instance)
    {
        $instance = wp_parse_args((array) $instance, array('text' => ''));
        $text = esc_textarea($instance['text']);
?>
        <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
<?php
    }
}
