<?php
/**
 * Sidebar - search blog tobbar setup.
 *
 * @package understrap
 */
// Exit if accessed directly.
defined("ABSPATH") || exit(); 
function getCurrentUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
                || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    return $protocol . $host . $uri;
}
?>
<form role="search" method="get" id="searchform" action="<?php echo esc_url(getCurrentUrl()); ?>">
    <div class="row">
        <div class="col-lg-4 my-3 col-md-4 col-12 pe-lg-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button id="searchsubmit" aria-label="Center Align" type="submit" class="input-group-text color_tertiary_bg color_tertiary_hover_bg border-0 rounded-0 h-54 text-center w-54  cursor-pointer"><i class="icon-magnifying-glass2 true_black bc_text_18 bc_line_height_18 mx-auto"></i></button>
                </div>
                <input type="text" id="search" value="<?php echo get_search_query(); ?>" name="s" class="form-control rounded-0 border-0 color_quaternary_bg font_alt_1 text_semibold text_13 line_height_18 h-54" placeholder="SEARCH">
            </div>
        </div>
        <?php
        $categories = get_categories();
        $has_only_uncategorized = false;
        if (count($categories) == 1) {
            foreach ($categories as $category) {
                if ($category->slug == 'uncategorized' || $category->name == 'Uncategorized') {
                    $has_only_uncategorized = true;
                    break;
                }
            }
        }
	if (count($categories) > 0 && !$has_only_uncategorized) { ?>
        <div class="col-lg-4 my-3 col-md-4 col-12 ps-lg-2 pe-lg-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text color_tertiary_bg color_tertiary_hover_bg border-0 rounded-0 h-54 text-center w-54  cursor-pointer"><i class="icon-bars2 true_black  bc_text_18 bc_line_height_18 mx-auto"></i></span>
                </div>
                <div class="custom-select">
                    <select name="cat" id="inputGroupSelect01" class="form-control rounded-0" onchange="document.location.href = this.options[this.selectedIndex].value;">
                        <option value=""><?php echo esc_html("Categories", "polaris-rds"); ?></option>
                        <?php
                        $categories = get_categories();
                        $option = '';
                        foreach ($categories as $category) {
                            $selected = "";
                            if (!empty(get_query_var("cat")) && $category->term_id == get_query_var("cat")):
                                $selected = "selected";
                            endif;
                            $option .= '<option value="' . $category->term_id . '" ' . $selected . ">";
                            $option .= $category->cat_name;
                            $option .= " (" . $category->category_count . ")";
                            $option .= "</option>";
                        }
                        echo $option;
                        ?>

                    </select>
                </div>
            </div>
        </div>
    <?php }
        ?>

    </div>
</form>
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
                //window.location =jQuery('select').val();
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
</script>
