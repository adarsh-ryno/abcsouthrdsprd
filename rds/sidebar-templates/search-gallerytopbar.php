<?php
/**
 * Sidebar - search blog tobbar setup.
 *
 * @package understrap
 */
// Exit if accessed directly.
defined("ABSPATH") || exit();
$cat = isset($_GET["cat"]) ? $_GET["cat"] : "";
?>
<div class="row">
    <div class="col-lg-4 my-3 col-md-4 col-12 ps-lg-2">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text color_tertiary_bg color_tertiary_hover_bg border-0 rounded-0 h-54 text-center w-54  cursor-pointer"><i class="icon-bars2   bc_text_18 bc_line_height_18 mx-auto"></i></span>
            </div>
            <div class="custom-select">
                <select name="cat" id="cat_inputGroupSelect01" class="form-control rounded-0" onchange="document.location.href = this.options[this.selectedIndex].value;">
                    <option value="">Categories</option> 
                    <?php
                    $option = ''; // Initialize $option variable
                    $args = [
                    	"orderby" => "name",
                    	"order" => "ASC",
                    	"hide_empty" => false,
                    	"fields" => "all",
                    	"parent" => 0,
                    	"hierarchical" => true,
                    	"child_of" => 0,
                    	"childless" => false,
                    	"pad_counts" => false,
                    	"cache_domain" => "core",
                    ];
                    $categories = get_terms("bc_gallery_category", $args);
                    foreach ($categories as $category) {
                    	$selected = "";
                    	if (!empty($cat) && $category->slug == $cat):
                    		$selected = "selected";
                    	endif;
                    	$option .=
                    		'<option value="?cat=' .
                    		$category->slug .
                    		'" ' .
                    		$selected .
                    		">";
                    	$option .= $category->name;
                    	$option .= " (" . $category->count . ")";
                    	$option .= "</option>";
                    }
                    echo $option;
                    ?>           
                </select>
            </div>
        </div>
    </div>
</div>
<script>
    var x, i, j, selElmnt, a, b, c;
    /*look for any elements with the class "custom-select":*/
    x = document.getElementsByClassName("custom-select");
    for (i = 0; i < x.length; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        /*for each element, create a new DIV that will act as the selected item:*/
        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected rounded-0");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);
        /*for each element, create a new DIV that will contain the option list:*/
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 1; j < selElmnt.length; j++) {
            /*for each option in the original select element,
             create a new DIV that will act as an option item:*/
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function (e) {
                /*when an item is clicked, update the original select box,
                 and the selected item:*/
                var y, i, k, s, h;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                h = this.parentNode.previousSibling;
                for (i = 0; i < s.length; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;
                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        for (k = 0; k < y.length; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");
                        break;
                    }
                }
                h.click();
                jQuery('#searchsubmit').click();
                jQuery('input[name="cat_id"]').val(jQuery('select').val());
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function (e) {
            /*when the select box is clicked, close any other select boxes,
             and open/close the current select box:*/
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
        });
    }
    function closeAllSelect(elmnt) {
        /*a function that will close all select boxes in the document,
         except the current select box:*/
        var x, y, i, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        for (i = 0; i < y.length; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i)
            } else {
                y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < x.length; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
            }
        }
    }
    /*if the user clicks anywhere outside the select box,
     then close all select boxes:*/
    document.addEventListener("click", closeAllSelect);

    jQuery(".select-items").click(function () {
        var get_select_cat = jQuery(".same-as-selected").text();
        var getID = get_select_cat.substring(0, 5);
        jQuery('.box').hide();
        jQuery('#' + getID).show();

    });
    jQuery('.term_cat_case').change(function () {

    });
	
	jQuery('.select-items').on('click', function() {
    var text = jQuery(this).children('.same-as-selected').text().toLowerCase();
    category = text.split("(")[0].trim().replace(/\s/g, '-');
    var url      = window.location.pathname; 
    url = url.replace(/\/page\/\d+/, ''); 
    console.log(url+'?cat='+category)
    window.location.href = url+'?cat='+category;
    });

</script>
