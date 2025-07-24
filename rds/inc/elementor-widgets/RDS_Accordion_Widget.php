<?php
require_once get_template_directory() . "/inc/custom-widget-function.php";

class RDS_Accordion_Widget extends \Elementor\Widget_Base
{
	use FileVariations;
	use FeatureJSONUpdate;
	public $allVariation;
	public $widgetPath;
public $widgetPathFull;
	public function __construct($data = [], $args = null)
	{
		parent::__construct($data, $args);

		$this->widgetPath = "accordion";
		$this->widgetPathFull = "/global-templates/" .$this->widgetPath. "/"; 
		$this->allVariation = $this->getFileVariations($this->widgetPath);
	}

    public function get_categories()
    {
        return ["rds-global-widgets"];
    }

    public function get_name()
    {
        return "rds-accordion-widget";
    }

    public function get_title()
    {
        return "RDS Accordion";
    }

    public function get_icon()
    {
        return "eicon-tabs";
    }

    protected function render()
    {

        $settings = $this->get_settings();
        $accordion = "";
   
        // $this->setFeatureJsonData($args);

        if (!empty($settings["accordion_items"])) { ?>
            <div class="container-fluid" >
                <div class="container career_faq">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            foreach ($settings["accordion_items"] as $item) {
                                if (!empty($item["item_title"]) && !empty($item["item_content"])) {
                                    $accordion .= '[bc_card title="' . $item["item_title"] . '"] ' . $item["item_content"] . "[/bc_card]";
                                }
                            }
                            echo do_shortcode("[bc_accordion]" . $accordion . "[/bc_accordion]");
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (!is_admin() && !defined("DOING_AJAX")) {
            } else {
                 ?>
            <script>
        jQuery(document).ready(function () {
            jQuery('.accordion').on('show.bs.collapse', function (e) {
                toggleIcon(e.target);
            });
            jQuery('.accordion').on('hidden.bs.collapse', function (e) {
                toggleIcon(e.target);
            });
        });
        function toggleIcon(target) {
            var target = jQuery(target).parent('.accordion-item').find('i');
            target.toggleClass('icon-chevron-up4');
            target.toggleClass('icon-chevron-down4');
        }
    </script>
       <?php
            }}
    }

    protected function _register_controls()
    {

        $itemsArray = [
            [
                "item_title" => "Lorem Ipsum Der",
                "item_content" => "Lorem Ipsum Gen Amor",
            ],
        ];

        
        $this->start_controls_section("accordion_section", [
            "label" => __("Accordion Template Widget", "rds-accordion-widget"),
        ]);

        

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
			$this->add_control("variation", [
				"label" => "Variation",
				"type" => \Elementor\Controls_Manager::SELECT,
				"default" => "a",
				"options" => $this->allVariation,
			]);
		}


        $this->add_control("accordion_items", [
            "label" => __("Accordion Items", "rds-accordion-widget"),
            "type" => \Elementor\Controls_Manager::REPEATER,
            "fields" => [
                [
                    "name" => "item_title",
                    "label" => __("Title", "rds-accordion-widget"),
                    "type" => \Elementor\Controls_Manager::TEXT,
                    "default" => __("", "rds-accordion-widget"),
                    "label_block" => true,
                ],
                [
                    "name" => "item_content",
                    "label" => __("Content", "rds-accordion-widget"),
                    "type" => \Elementor\Controls_Manager::WYSIWYG,
                    "default" => __("", "rds-accordion-widget"),
                    "label_block" => true,
                ],
                // Add more fields for each item property (e.g., content)
            ],
            "default" => $itemsArray,
            "item_title" => "{{{ item_title }}}",
            "item_link" => "{{{ item_content }}}",
        ]);

        $this->end_controls_section();
    }
}
