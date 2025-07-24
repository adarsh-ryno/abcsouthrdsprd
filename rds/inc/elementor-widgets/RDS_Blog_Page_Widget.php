<?php

class RDS_Blog_Page_Widget extends \Elementor\Widget_Base
{
    use FileVariations;
    use FeatureJSONUpdate;
    public $allVariation;
    public $widgetPath;
    public $widgetPathFull;
    public $globalPath = false;
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        if ($data && is_numeric($data['id'])) {
            $this->globalPath = true;
        }
        $this->widgetPath = "blog"; //Edit
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }
    public function get_categories()
    {
        return ["rds-global-widgets"];
    }

    public function get_name()
    {
        return "rds-blog-page-widget";
    }

    public function get_title()
    {
        return "Blog Page Widget";
    }

    public function get_icon()
    {
        return "eicon-testimonial-carousel";
    }

    protected function _register_controls()
    {
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
        $this->start_controls_section("rds_blog_widget", [
            "label" => __("Blog Page Widget", "rds-blog-page-widget"),
        ]);
        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args["globals"]["blog"]["variation"]) ? $args["globals"]["blog"]["variation"] : "a";
            $this->add_control("variation", [
                "label" => "Variation",
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" => $defaultVariation,
                "options" => $this->allVariation,
            ]);
        }
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
                if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $args["globals"]["blog"]["variation"] = sanitize_text_field($settings["variation"]);
            // SAVE TO SPEC
        }
        if ($this->globalPath) {
            $this->setFeatureJsonData($args);
        }

        $paged = get_query_var("paged") ? get_query_var("paged") : 1;
        $posts_per_page = get_option("posts_per_page") ? get_option("posts_per_page") : 1;
        $cat_id = isset($_GET["cat"]) && is_numeric($_GET["cat"]) ? $_GET["cat"] : "";

        $post_query_args = [
            "post_type" => "post",
            "posts_per_page" => $posts_per_page,
            "paged" => $paged,
            "order" => "DESC",
            "post_status" => "publish",
        ];

        if (!empty($_GET["s"])) {
            $post_query_args["s"] = sanitize_text_field($_GET["s"]);
        }

        if (!empty($cat_id)) {
            $post_query_args["cat"] = $cat_id;
        }

        query_posts($post_query_args);
        ?>

        <div class="container-fluid pt-lg-4 pb-lg-0 pb-4 my-2  px-lg-3 px-0 page_content">
            <div class="container subpage_full_content pb-lg-5 mt-sn-100">
                <div class="row pb-lg-4">
                    <div class="col-12">
                        <?php get_template_part("sidebar-templates/search", "blogtopbar"); ?>
                        <?php
                        // RENDER VARIATION
                        $variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
                        set_query_var('settings', $settings);
                        get_template_part($this->widgetPathFull . $variationVal, null, $args);
                        ?>
                        <div class="d-flex align-items-center justify-content-center mt-4 mb-4 mb-lg-0 pt-3 blog-page-pagination">
                            <?php
                            // echo paginate_links(array(
                            //     'total'     => $custom_query->max_num_pages,
                            //     'prev_text' => '<i class="icon-angles-left4"></i>',
                            //     'next_text' => '<i class="icon-angles-right4"></i>',
                            // ));
                            understrap_pagination([
                                "prev_text" => '<i class="icon-angles-left4"></i>',
                                "next_text" => '<i class="icon-angles-right4"></i>',
                            ]);
                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
