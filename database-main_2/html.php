<?php
/*
 +-------------------------------------------------------------------------+
 | Copyright (C) 2004-2017 The Cacti Group                                 |
 |                                                                         |
 | This program is free software; you can redistribute it and/or           |
 | modify it under the terms of the GNU General Public License             |
 | as published by the Free Software Foundation; either version 2          |
 | of the License, or (at your option) any later version.                  |
 |                                                                         |
 | This program is distributed in the hope that it will be useful,         |
 | but WITHOUT ANY WARRANTY; without even the implied warranty of          |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           |
 | GNU General Public License for more details.                            |
 +-------------------------------------------------------------------------+
 | Cacti: The Complete RRDTool-based Graphing Solution                     |
 +-------------------------------------------------------------------------+
 | This code is designed, written, and maintained by the Cacti Group. See  |
 | about.php and/or the AUTHORS file for specific developer information.   |
 +-------------------------------------------------------------------------+
 | http://www.cacti.net/                                                   |
 +-------------------------------------------------------------------------+
*/

/* html_start_box - draws the start of an HTML box with an optional title
   @arg $title - the title of this box ("" for no title)
   @arg $width - the width of the box in pixels or percent
   @arg $background_color - deprecated
   @arg $cell_padding - the amount of cell padding to use inside of the box
   @arg $align - the HTML alignment to use for the box (center, left, or right)
   @arg $add_text - the url to use when the user clicks 'Add' in the upper-right
     corner of the box ("" for no 'Add' link) */
function html_start_box($title, $width, $background_color, $cell_padding, $align, $add_text, $add_label = 'Add') {
	static $table_suffix = 1;

	$table_prefix = basename($_SERVER['PHP_SELF'], '.php');;
	if (!isempty_request_var('report')) {
		$table_prefix .= '_' . clean_up_name(get_nfilter_request_var('report'));
	} elseif (!isempty_request_var('tab')) {
		$table_prefix .= '_' . clean_up_name(get_nfilter_request_var('tab'));
	} elseif (!isempty_request_var('action')) {
		$table_prefix .= '_' . clean_up_name(get_nfilter_request_var('action'));
	}
	$table_id = $table_prefix . $table_suffix;

	if ($title != '') {
	?>
	<div id='<?php print $table_id;?>' class='cactiTable' style='width:<?php print $width;?>;text-align:<?php print $align;?>;'>
		<div>
			<div class='cactiTableTitle'><span><?php if ($title != "") { print $title; }?></span></div>
		</div>
		<table id='<?php print $table_id . '_child';?>' class='cactiTable' style='padding:<?php print $cell_padding;?>px;'>
	<?php
	}else{
	?>
	<div id='<?php print $table_id;?>' class='cactiTable' style='width:<?php print $width;?>;text-align:<?php print $align;?>;'>
		<table id='<?php print $table_id . '_child';?>' class='cactiTable' style='padding:<?php print $cell_padding;?>px;'>
	<?php
	}

	$table_suffix++;
}

/* html_end_box - draws the end of an HTML box
   @arg $trailing_br (bool) - whether to draw a trailing <br> tag after ending
     the box */
function html_end_box($trailing_br = true) { ?>
		</table>
	</div>
	<?php if ($trailing_br == true) { print "<div class='break'></div>"; } ?>
<?php }



/* html_create_list - draws the items for an html dropdown given an array of data
   @arg $form_data - an array containing data for this dropdown. it can be formatted
     in one of two ways:
     $array["id"] = "value";
     -- or --
     $array[0]["id"] = 43;
     $array[0]["name"] = "Red";
   @arg $column_display - used to indentify the key to be used for display data. this
     is only applicable if the array is formatted using the second method above
   @arg $column_id - used to indentify the key to be used for id data. this
     is only applicable if the array is formatted using the second method above
   @arg $form_previous_value - the current value of this form element */
function html_create_list($form_data, $column_display, $column_id, $form_previous_value) {
	if (empty($column_display)) {
		foreach (array_keys($form_data) as $id) {
			print '<option value="' . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . '"';

			if ($form_previous_value == $id) {
			print " selected";
			}

			print ">" . title_trim(null_out_substitutions(htmlspecialchars($form_data[$id])), 75) . "</option>\n";
		}
	}else{
		if (sizeof($form_data) > 0) {
			foreach ($form_data as $row) {
				print "<option value='" . htmlspecialchars($row[$column_id], ENT_QUOTES, 'UTF-8') . "'";

				if ($form_previous_value == $row[$column_id]) {
					print " selected";
				}

				if (isset($row["host_id"])) {
					print ">" . title_trim(htmlspecialchars($row[$column_display]), 75) . "</option>\n";
				}else{
					print ">" . title_trim(null_out_substitutions(htmlspecialchars($row[$column_display])), 75) . "</option>\n";
				}
			}
		}
	}
}

/* html_split_string - takes a string and breaks it into a number of <br> separated segments
   @arg $string - string to be modified and returned
   @arg $length - the maximal string length to split to
   @arg $forgiveness - the maximum number of characters to walk back from to determine
         the correct break location.
   @returns $new_string - the modified string to be returned. */
function html_split_string($string, $length = 70, $forgiveness = 10) {
	$new_string = "";
	$j    = 0;
	$done = false;

	while (!$done) {
		if (strlen($string) > $length) {
			for($i = 0; $i < $forgiveness; $i++) {
				if (substr($string, $length-$i, 1) == " ") {
					$new_string .= substr($string, 0, $length-$i) . "<br>";

					break;
				}
			}

			$string = substr($string, $length-$i);
		}else{
			$new_string .= $string;
			$done        = true;
		}

		$j++;
		if ($j > 4) break;
	}

	return $new_string;
}




/* filter_value - a quick way to highlight text in a table from general filtering
   @arg $text - the string to filter
   @arg $filter - the search term to filter for
   @arg $href - the href if you wish to have an anchor returned
   @returns - the filtered string */
   function filter_value($value, $filter, $href = '') {
	static $charset;

	if ($charset == '') {
		$charset = ini_get('default_charset');
	}

	$value =  htmlspecialchars($value, ENT_QUOTES, $charset, false);

	if ($filter != '') {
		$value = preg_replace('#(' . $filter . ')#i', "<span class='filteredValue'>\\1</span>", $value);
	}

	if ($href != '') {
		$value = '<a class="linkEditMain" href="' . htmlspecialchars($href, ENT_QUOTES, $charset, false) . '">' . $value  . '</a>';
	}

	return $value;
}


/* html_header - draws a header row suitable for display inside of a box element
   @arg $header_items - an array containing a list of items to be included in the header
		alternatively and array of header names and alignment array('display' = 'blah', 'align' = 'blah')
   @arg $last_item_colspan - the TD 'colspan' to apply to the last cell in the row */
function html_header($header_items, $last_item_colspan = 1) {
	print "<tr class='tableHeader " . (!$last_item_colspan > 1 ? 'tableFixed':'') . "'>\n";

	for ($i=0; $i<count($header_items); $i++) {
		if (is_array($header_items[$i])) {
			print "<th style='text-align:" . $header_items[$i]['align'] . ";' " . ((($i+1) == count($header_items)) ? "colspan='$last_item_colspan' " : "") . ">" . $header_items[$i]['display'] . "</th>\n";
		}else{
			print "<th style='text-align:left;' " . ((($i+1) == count($header_items)) ? "colspan='$last_item_colspan' " : "") . ">" . $header_items[$i] . "</th>\n";
		}
	}

	print "</tr>\n";
}

