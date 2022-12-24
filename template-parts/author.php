<section class="author-box">
    <img class="author-box__img-circle" src="<?php echo get_template_directory_uri(); ?>/assets/img/introduce/2022-11-11.jpg?20221111">
    <h4 class="author-box__my-name">
        Shibata Hiroki
    </h4>
    <hr class="author-box__line">
    <p class="author-box__text">
        1993年生まれの29歳です。<br><br>
        ソフトウェア開発のエンジニアとして、<br>2月1日から就業開始します。<br><br>
        このサイトでは、自分が体験したことなどをアウトプットしていきます。<br><br>
        お問い合わせがある方は、<br><a href="mailto:hiroki.hiroki@icloud.com">hiroki.hiroki@icloud.com</a>まで<br>お願いします。
    </p>
    <div class="author-box__sns-wrap">
      <?php
      $sns_array = [
        [ 'ttl' => 'twitter', 'link' => 'https://twitter.com/2021_shibata' ],
        [ 'ttl' => 'instagram', 'link' => 'https://www.instagram.com/hiroki.hiroki2020/' ],
      ];
      foreach ($sns_array as $sns) :
      ?>
          <a class="author-box__sns-link" href="<?php echo $sns['link']; ?>" target="new">
              <img class="author-box__sns-icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $sns['ttl']; ?>.png" alt="<?php echo $sns['ttl']; ?>のアイコン">
          </a>
      <?php endforeach; ?>
    </div>
</section>