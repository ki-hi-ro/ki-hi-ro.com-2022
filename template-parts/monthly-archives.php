<?php
/** Browse published journal entries by month. */
global $wpdb;
$months = $wpdb->get_results("SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month FROM {$wpdb->posts} WHERE post_type = 'post' AND post_status = 'publish' AND post_password = '' ORDER BY year DESC, month DESC");
if (!$months) return;
$selected_month = is_date() ? sprintf('%04d%02d', get_query_var('year'), get_query_var('monthnum')) : '';
?>
<section class="monthly-archives" aria-label="年月アーカイブ">
  <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
    <label for="archive-month">年月アーカイブ</label>
    <select id="archive-month" name="m" required>
      <option value="">年月を選択</option>
      <?php foreach ($months as $month) : $value = sprintf('%04d%02d', $month->year, $month->month); ?>
        <option value="<?php echo esc_attr($value); ?>" <?php selected($selected_month, $value); ?>><?php echo esc_html($month->year . '年' . $month->month . '月'); ?></option>
      <?php endforeach; ?>
    </select>
    <button type="submit">表示する</button>
  </form>
</section>
