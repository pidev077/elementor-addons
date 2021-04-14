<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Don't allow direct access

$suggestions = explode(',',$atts['suggestions']);
$filters = explode(',',$atts['filters']);
$is_date_filter = false;

?>
<div class="ica-content-filter">
    <form class="form-content-filter" action="/" method="post">
       <input type="text" name="key-search" value="" placeholder="<?php echo $atts['placeholder']; ?>">
       <button type="submit" name="button"><i class="fa fa-search" aria-hidden="true"></i></button>
    </form>
    <div class="template-filter-form">
        <div class="__filter-suggestion">
          <?php if(!empty($suggestions)): ?>
            <div class="load-suggestion">
              <?php echo __('Suggestions:','bearsthemes-addons') ?>
              <div class="list-suggestions">
                <?php foreach ($suggestions as $key => $suggestion): ?>
                  <span><?php echo $suggestion; ?></span><?php echo (($key+1) < count($suggestions)) ? ',' : ''; ?>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endif; ?>
          <?php if(!empty($filters)): ?>
            <div class="btn-filter">
              <i class="fa fa-caret-right" aria-hidden="true"></i>
              <?php echo __('Filters','bearsthemes-addons') ?>
            </div>
          <?php endif; ?>
        </div>
        <?php if(!empty($filters)): ?>
          <div class="__filter-options">
              <?php foreach ($filters as $key => $filter): ?>
                      <?php if($filter != 'date'){
                                $taxonomy = get_taxonomy($filter);
                                $terms = get_terms( array(
                                  'taxonomy' => $filter,
                                  'hide_empty' => false,
                                ) );
                        if(!empty($terms)):
                          ?>
                          <div class="ica-item-filter">
                              <div class="name-filter">
                                <?php echo __('Filter by','bearsthemes-addons') ?> <?php echo $taxonomy->label; ?>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                              </div>
                              <div class="select-filter">
                                  <span class="btn-select-all"><?php echo __('Select all','bearsthemes-addons') ?></span>
                                  <?php foreach ($terms as $key => $term) {
                                      ?>
                                      <label class="checkbox-container"><?php echo $term->name ?>
                                        <input type="checkbox">
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
                $breakYears = 20;
                $years = date('Y',current_time( 'timestamp', 1 ));
                ?>
                <div class="ica-item-filter select-date-range">
                  <?php echo __('Select date range','bearsthemes-addons') ?>
                  <div class="select-date-start">
                    <select name="date-range-start">
                      <option value="">Select start year</option>
                      <?php for ($i=0; $i < $breakYears; $i++) {
                        ?><option value="<?php echo $years - $i ?>"><?php echo $years - $i ?></option><?php
                      } ?>
                    </select>
                  </div>
                  <div class="select-date-end">
                    <select name="name="date-range-start"">
                      <option value="">Select end year</option>
                      <?php for ($i=0; $i < $breakYears; $i++) {
                        ?><option value="<?php echo $years - $i ?>"><?php echo $years - $i ?></option><?php
                      } ?>
                    </select>
                  </div>
                </div>
              <?php } ?>
          </div>
        <?php endif; ?>
    </div>
</div>
<?php
