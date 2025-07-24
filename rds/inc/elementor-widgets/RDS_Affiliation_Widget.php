<?php
require_once get_template_directory() . "/inc/custom-widget-function.php";
class RDS_Affiliation_Widget extends \Elementor\Widget_Base
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
        $this->widgetPath = "affiliation";
        $this->widgetPathFull = "/global-templates/" . $this->widgetPath . "/";
        $this->allVariation = $this->getFileVariations($this->widgetPath);
    }

    public function get_categories()
    {
        return ["rds-global-widgets"];
    }

    public function get_name()
    {
        return "rds-affiliation-widget";
    }

    public function get_title()
    {
        return "RDS Affiliation";
    }

    public function get_icon()
    {
        return "eicon-nested-carousel";
    }

    public function render()
    {
        $settings = $this->get_settings();
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal; 

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $args["globals"]["affiliation"]["variation"] = sanitize_text_field($settings["variation"]);
        }
        $args["globals"]["affiliation"]["count"] = sanitize_text_field($settings["affiliation_count"]);
// 		echo $settings["affiliation_count"];
// 		print_r($settings["affiliation_count"]);
        //Update template spec file

        // SAVE TO SPEC
        if ($this->globalPath) {
            $this->setFeatureJsonData($args);
        }
        //RENDER VARIATION
        $variationVal = isset($settings["variation"]) ? sanitize_text_field($settings["variation"]) : 'a';
        set_query_var('settings', $settings);
        get_template_part($this->widgetPathFull . $variationVal, null, $args);
		?>

<script type="text/javascript">

       jQuery(document).ready(function () {
        var variation = "<?php echo $args['globals']['affiliation']['variation'] ?>";
          var count = "<?php echo $args['globals']['affiliation']['count'] ?>";
        var slidesPerView = {a: 4, b: 5, c: 6};
        if(count <= slidesPerView[variation]){
             var affiliactionSlider = new Swiper(".affiliation-swiper-a", {
            spaceBetween: 30,
            slidesPerView: 1,
            loop: true,
           navigation: {
                nextEl: ".affiliation_next_a",
                prevEl: ".affiliation_prev_a",
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                768: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                992: {
                    slidesPerView: count,
                    spaceBetween: 30,
                    noSwiping: true,
              
                },
            },
        });

        }else{
           var affiliactionSlider = new Swiper(".affiliation-swiper-a", {
            spaceBetween: 30,
            slidesPerView: 1,
            loop: true,
             autoplay: {
                delay: 4500,
                disableOnInteraction: false,
            },
            navigation: {
                 nextEl: ".affiliation_next_a",
                prevEl: ".affiliation_prev_a",
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                768: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                992: {
                    slidesPerView: slidesPerView[variation],
                    spaceBetween: 30,
                    noSwiping: false,
                },
            },
        });

        }
        
    });
</script>

<?php
    }

    public function _register_controls()
    {
        global $rdsTemplateDataGlobal;
        $args = $rdsTemplateDataGlobal;
        $affiliation = $args["globals"]["affiliation"];
        $this->start_controls_section("affiliation_section", [
            "label" => __("Affiliation", "rds-affiliation-widget"),
        ]);

        if (!empty($this->allVariation) && count($this->allVariation) > 1) {
            $defaultVariation = isset($args["globals"]["affiliation"]["variation"]) ? $args["globals"]["affiliation"]["variation"] : "a";
            $this->add_control("variation", [
                "label" => "Variation",
                "type" => \Elementor\Controls_Manager::SELECT,
                "default" => $defaultVariation,
                "options" => $this->allVariation,
            ]);
        }

        $this->add_control("affiliation_count", [
            "label" => "Count",
            "type" => \Elementor\Controls_Manager::NUMBER,
            "default" => isset($affiliation["count"]) ? $affiliation["count"] : 1,
            "min" => 1,
        ]);
        $this->end_controls_section();
    }
}
