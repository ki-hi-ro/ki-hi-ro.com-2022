<?php
/*
Template Name: タグ一覧
*/
get_header();
?>

<main>
  <h1>タグ一覧</h1>

  <?php
  // 全タグ取得（非表示も含む）
  $tags = get_tags(array(
    'orderby' => 'name',
    'hide_empty' => false,
  ));

  $custom_order = ['プログラミング']; // 並べたい順
  usort($tags, function($a, $b) use ($custom_order) {
      $indexA = array_search($a->name, $custom_order);
      $indexB = array_search($b->name, $custom_order);
  
      $indexA = $indexA !== false ? $indexA : PHP_INT_MAX;
      $indexB = $indexB !== false ? $indexB : PHP_INT_MAX;
  
      return $indexA - $indexB;
  });  

  // 階層構造を作成
  $tree = [];

  foreach ($tags as $tag) {
    $normalized_name = html_entity_decode($tag->name, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $normalized_name = preg_replace('/\x{3000}/u', ' ', $normalized_name); // 全角スペース→半角
    $normalized_name = str_replace('＞', '>', $normalized_name); // 全角 > → 半角 >
    $normalized_name = preg_replace('/\s*>\s*/', ' > ', $normalized_name); // 空白調整
    
    $parts = explode(' > ', trim($normalized_name));
    
    $ref = &$tree;

    foreach ($parts as $index => $part) {
      if (!isset($ref[$part])) {
        $ref[$part] = [
          '_tag' => null,
          '_children' => []
        ];
      }

      // 最後の要素ならタグオブジェクトをセット
      if ($index === count($parts) - 1) {
        $ref[$part]['_tag'] = $tag;
      }

      // 次の階層へ参照を移動
      $ref = &$ref[$part]['_children'];
    }

    unset($ref); // 忘れずにリセット
  }

  // 階層表示用：再帰関数
  function render_tag_tree($nodes) {
    if (empty($nodes)) return;
  
    // ★カスタムソート（タグ名ベース、キーで並べ替え）
    uksort($nodes, function($a, $b) {
      $order = ['Python', 'WordPress'];
      $indexA = array_search($a, $order);
      $indexB = array_search($b, $order);
  
      $indexA = $indexA !== false ? $indexA : PHP_INT_MAX;
      $indexB = $indexB !== false ? $indexB : PHP_INT_MAX;
  
      return $indexA - $indexB;
    });
  
    echo '<ul>';
    foreach ($nodes as $name => $data) {
      echo '<li>';
  
      if ($data['_tag']) {
        $link = get_tag_link($data['_tag']->term_id);
        echo '<a href="' . esc_url($link) . '">' . esc_html($name) . '</a>';
      } else {
        echo '<strong>' . esc_html($name) . '</strong>';
      }
  
      render_tag_tree($data['_children']);
      echo '</li>';
    }
    echo '</ul>';
  }  

  render_tag_tree($tree);
  ?>
</main>

<style>
  main {
    padding: 0 20px;
  }
  main h1 {
    margin-top: 0;
    padding: 32px 15px 9px;
    text-align: center;
  }
  li a {
    display: block;
    width: 100%;
    padding: 3px 0;
  }
  ul {
    padding-left: 20px;
  }
  @media (min-width: 1200px) {
    main {
        margin: 0 auto;
        padding: 20px 15px;
        width: 1170px;
        max-width: none;
    }
    main h1 {
      padding: 0;
      text-align: left;
    }
  }
</style>

<?php get_footer(); ?>