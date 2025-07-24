<?php
trait FileVariations
{
	protected function getFileVariations($folderName)
	{	
			$parent_theme_path = get_template_directory() . "/global-templates/" . $folderName . "/";
			$child_theme_path = get_stylesheet_directory() ."/global-templates/" .$folderName ."/";

			$parent_files = glob($parent_theme_path . "*.php");
			$child_files = glob($child_theme_path . "*.php");

			$all_files = array_merge($parent_files, $child_files);

			if ($all_files && count($all_files) > 0) {
				$fileVariation = [];
				foreach ($all_files as $file) {
					$fileName = explode(".", basename($file))[0];
					$cleanedString = preg_replace("/[^a-zA-Z\s]/", " ", $fileName);
					$fileVariation[$fileName] = strtoupper($cleanedString);
				}
				return $fileVariation;
			} else {
				return [];
			}
		}
	}

trait AssetVariations
{
	protected function getAssetVariations($subFolder)
	{
		$childThemePath =
			get_stylesheet_directory() . "/img/" . $subFolder . "/";
		$landingFolders = glob($childThemePath . "*", GLOB_ONLYDIR);
		$assetPath = $childThemePath;
		$customFolderPattern = "landing-*";
		$landingFolders = glob($assetPath . "*", GLOB_ONLYDIR);

		if ($landingFolders && count($landingFolders) > 0) {
			$assetVariation = [];
			foreach ($landingFolders as $folder) {
				$folderName = basename($folder);
				$cleanedString = preg_replace(
					"/[^a-zA-Z\s]/",
					" ",
					$folderName
				);
				$assetVariation[$folderName] = strtoupper($cleanedString);
			}
			return $assetVariation;
		} else {
			return [];
		}
	}
}
trait FeatureJSONUpdate
{
   
    protected function setFeatureJsonData($widgetSettings)
    {
		global $rdsTemplateDataGlobal;
        $updatedData = array();
        if(is_admin()){        
            $rdsFeatureData = $rdsTemplateDataGlobal;
            if ($rdsFeatureData !== null) {
                $this->replaceNestedProperties($rdsFeatureData,$widgetSettings);
				$rdsTemplateDataGlobal = $rdsFeatureData;
            }
        }else{
            return;
        }
    }
 
    public function replaceNestedProperties(&$arrayA, $arrayB) {
        foreach ($arrayB as $key => $value) {
            if (is_array($value) && isset($arrayA[$key]) && is_array($arrayA[$key])) {
				if($key == 'items' || $key == 'data' || $key == 'category_filter' ) {
					$arrayA[$key] = $value;
				}else{
					$this->replaceNestedProperties($arrayA[$key], $value);
				}
            } elseif (array_key_exists($key, $arrayA)) {
                $arrayA[$key] = $value;
            }
        }
    }
}

function save_feature_data($post_id, $editor_data) {
	global $rdsTemplateDataGlobal;
	if ( get_post_status( $post_id ) != 'publish' ) {
		return;
	}
	global $wpdb;

	$rdsTableOption = $wpdb->prefix . "options";
	$rdsTemplateDataGlobalJson = str_replace("\/","/",json_encode($rdsTemplateDataGlobal, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
	$wpdb->update($rdsTableOption,["option_value" => $rdsTemplateDataGlobalJson],["option_name" => "rds_template"]);
	// Check for errors and handle them if needed
    if ($wpdb->last_error) {
        // Handle the error, log it, or display a message
        error_log('Error updating rds_template option: ' . $wpdb->last_error);
    }
}

add_action('elementor/editor/after_save', 'save_feature_data', 50, 2);

