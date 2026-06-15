<a class="all-article__post-wrap" href="<?php the_permalink(); ?>">
  <div class="all-article__date-block">
    <div class="all-article__date">
      <?php echo get_the_date('Y.m.d'); ?>
    </div>
    <div class="all-article__modified">
      更新日：<?php echo get_the_modified_date('Y.m.d'); ?>
    </div>
  </div>

  <div class="all-article__content">
    <div class="all-article__ttl">
      <?php echo esc_html(get_the_title()); ?>
    </div>
  </div>

  <div class="all-article__arrow">
    &gt;
  </div>
</a>

<style>
.all-article__post-wrap {
  display: grid;
  grid-template-columns: 150px 1fr 24px;
  gap: 24px;
  align-items: center;
  padding: 24px;
  margin-bottom: 12px;
  border-radius: 12px;
  background: #fff;
  text-decoration: none;
  color: inherit;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
}

.all-article__date {
  font-size: 18px;
  color: #1a73e8;
  font-weight: 600;
}

.all-article__modified {
  margin-top: 8px;
  font-size: 13px;
  color: #777;
}

.all-article__ttl {
  font-size: 20px;
  font-weight: 600;
  line-height: 1.6;
}

.all-article__arrow {
  color: #1a73e8;
  font-size: 22px;
}

@media screen and (max-width: 768px) {
  .all-article__post-wrap {
    grid-template-columns: 1fr 20px;
  }

  .all-article__date-block {
    grid-column: 1 / 2;
  }

  .all-article__content {
    grid-column: 1 / 2;
  }
}

.all-article__post-wrap {
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.all-article__post-wrap:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
}
</style>