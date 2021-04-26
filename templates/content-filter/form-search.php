<?php
extract($atts);
$suggestionsArr = explode(',',$suggestions);
$suggestionTop = array();
foreach ($suggestionsArr as $key => $val) {
  $suggestionTop[] = $val;
  if($key > 1) break;
}
$filters = !empty($filters) ? explode(',',$filters) : '';
$types = !empty($types) ? explode(',',$types) : '';
$topics = !empty($topics) ? explode(',',$topics) : '';
$is_date_filter = false;
$rand_id = rand(1000,99999);
$keys = "";
foreach ($suggestionsArr as $key => $val) {
  $keys .= trim($val);
  $keys .= (($key + 1) < count($suggestionsArr)) ? ',':'';
}

//Types
if(isset($_GET['type']) && $_GET['type'] != ''){
  $types = explode(',',$_GET['type']);
}

//Topic
if(isset($_GET['topic']) && $_GET['topic'] != ''){
  $topics = explode(',',$_GET['topic']);
}

//start date
if(isset($_GET['start_date']) && $_GET['start_date'] != ''){
  $start_date = $_GET['start_date'];
}

//end date
if(isset($_GET['end_date']) && $_GET['end_date'] != ''){
  $end_date = $_GET['end_date'];
}

?>
<div id="content_filter_<?php echo $rand_id; ?> "
  class="ica-content-filter"
  data-keys="<?php echo esc_attr($keys) ?>"
  data-post="<?php echo $post_type; ?>"
  data-numberposts="<?php echo $numberposts; ?>"
  data-orderby="<?php echo $orderby; ?>"
  data-order="<?php echo $order; ?>"
  data-pagination="<?php echo $pagination ?>"
  data-showcontent="<?php echo $showcontent; ?>">
    <div class="wrrap-content-filter">
      <div class="form-content-filter">
         <input type="text" class="typeahead" name="key" value="<?php echo isset($_GET['key']) ? $_GET['key'] : ''; ?>" placeholder="<?php echo $atts['placeholder']; ?>" autocomplete="off" required>
         <button class="btn-removeall" required="false"><i class="fa fa-times"></i></button>
         <button type="submit" data-ajax="<?php echo $ajax; ?>" <?php echo (!$ajax) ? 'data-redirect="'.$action.'"' : ''; ?>><i class="fa fa-search"></i></button>
      </div>
      <div class="log-error"></div>
      <div class="template-filter-form">
          <div class="__filter-suggestion">
            <?php if(!empty($suggestionTop)): ?>
              <div class="load-suggestion">
                <?php echo __('Suggestions:','bearsthemes-addons') ?>
                <div class="list-suggestions">
                  <?php foreach ($suggestionTop as $key => $suggestion): ?>
                    <span class="btn-suggestion" data-value="<?php echo $suggestion; ?>"><?php echo $suggestion; ?></span><?php echo (($key+1) < count($suggestionTop)) ? ',' : ''; ?>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>
            <?php if(!empty($filters)): ?>
              <div class="btn-filter <?php echo ($default_filter) ? '__is-actived' : ''; ?>">
                <i class="fa fa-caret-right" aria-hidden="true"></i>
                <?php echo __('Filters','bearsthemes-addons') ?>
              </div>
            <?php endif; ?>
          </div>
          <?php if(!empty($filters)): ?>
            <div class="__filter-options <?php echo ($default_filter) ? '__is-actived' : ''; ?>">
              <div class="wrap-options">
                <?php foreach ($filters as $key => $filter): ?>
                  <?php if($filter != 'date'){
                            $taxonomy = get_taxonomy($filter);
                            $terms = get_terms( array(
                              'taxonomy' => $filter,
                              'hide_empty' => false,
                            ) );
                    if(!empty($terms)):
                      $checkdata = ($filter == 'ins-type') ? $types : $topics;
                      ?>
                      <div class="ica-item-filter" data-filter="<?php echo $filter ?>">
                          <div class="name-filter">
                            <?php echo __('Filter by','bearsthemes-addons'); ?> <?php echo $taxonomy->label; ?>
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                          </div>
                          <div class="select-filter">
                              <span class="btn-select-all"><?php echo __('Select all','bearsthemes-addons') ?></span>
                              <?php foreach ($terms as $key => $term) {
                                  ?>
                                  <label class="checkbox-container"><?php echo $term->name; ?> (<?php echo $term->count; ?>)
                                    <input type="checkbox"
                                           name="<?php echo $taxonomy->name ?>"
                                           value="<?php echo $term->slug ?>"
                                           <?php echo (in_array($term->slug, $checkdata)) ? 'checked' : ''; ?>
                                           >
                                    <span class="checkmark"></span>
                                  </label>
                                  <?php
                              } ?>
                              <span class="btn-deselect-all"><?php echo __('Deselect all','bearsthemes-addons') ?></span>
                          </div>
                      </div>
                      <?php
                    endif;
                  } ?>
                  <?php $is_date_filter = ($filter == 'date') ? true : false; ?>
                  <?php endforeach; ?>
                  <?php if($is_date_filter){
                    $breakYears = 30;
                    $years = date('Y',current_time( 'timestamp', 1 ));
                    ?>
                    <div class="ica-item-filter select-date-range" data-filter="date">
                      <div class="__date-options">
                        <span class="__label"><?php echo __('Select date range','bearsthemes-addons') ?></span>
                        <div class="__select-options">
                          <div class="select-date-start">
                            <select name="date-range-start">
                              <option value=""><?php echo __('Select start year','bearsthemes-addons') ?></option>
                              <?php for ($i=0; $i < $breakYears; $i++) {
                                $selected = ($years - $i == $start_date) ? 'selected="selected"' : '';
                                ?><option value="<?php echo $years - $i ?>" <?php echo $selected; ?>><?php echo $years - $i ?></option><?php
                              } ?>
                            </select>
                          </div>
                          <div class="select-date-end">
                            <select name="date-range-end">
                              <option value=""><?php echo __('Select end year','bearsthemes-addons') ?></option>
                              <?php for ($i=0; $i < $breakYears; $i++) {
                                $selected = ($years - $i == $end_date) ? 'selected="selected"' : '';
                                ?><option value="<?php echo $years - $i ?>" <?php echo $selected; ?>><?php echo $years - $i ?></option><?php
                              } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
              </div>
              <div class="bt-actions">
                <button class="btn-clearall" data-filter data-ajax="<?php echo $ajax; ?>"><i class="fa fa-times" aria-hidden="true"></i> <?php echo __('Clear filters','bearsthemes-addons'); ?></button>
                <button class="btn-applyfilter" data-filter data-ajax="<?php echo $ajax; ?>" <?php echo (!$ajax) ? 'data-redirect="'.$action.'"' : ''; ?>><?php echo __('Apply filters','bearsthemes-addons'); ?></button>
              </div>
            </div>
          <?php endif; ?>
      </div>
    </div>
    <div class="content-filter-results"></div>
</div>
<?php
