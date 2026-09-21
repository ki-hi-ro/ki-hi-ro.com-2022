(function () {
  'use strict';
  var root = document.querySelector('.article-like');
  if (!root) return;
  var button = root.querySelector('button');
  var status = root.querySelector('.article-like__status');
  var token;
  var nonce;
  try {
    token = localStorage.getItem('kihiro-like-visitor');
    if (!/^[a-f0-9]{32}$/.test(token || '')) {
      var bytes = new Uint8Array(16);
      crypto.getRandomValues(bytes);
      token = Array.from(bytes, function (byte) { return byte.toString(16).padStart(2, '0'); }).join('');
      localStorage.setItem('kihiro-like-visitor', token);
    }
  } catch (error) {
    status.textContent = 'いいねを利用するにはブラウザーの保存機能を有効にしてください。';
    return;
  }
  async function request(vote) {
    button.disabled = true;
    var params = new URLSearchParams({ action: 'kihiro_like', post_id: root.dataset.postId, visitor: token });
    if (vote) { params.set('vote', '1'); params.set('nonce', nonce); }
    try {
      var response = await fetch(root.dataset.endpoint, { method: 'POST', credentials: 'same-origin', body: params });
      var result = await response.json();
      if (!response.ok || !result.success) throw new Error('request');
      nonce = result.data.nonce;
      root.querySelector('.article-like__count').textContent = result.data.count.toLocaleString();
      root.querySelector('.article-like__label').textContent = result.data.liked ? 'いいね済み' : 'いいね';
      button.querySelector('[aria-hidden]').textContent = result.data.liked ? '♥' : '♡';
      button.setAttribute('aria-pressed', String(result.data.liked));
      button.disabled = result.data.liked;
      status.textContent = vote ? 'ありがとうございます！' : '';
    } catch (error) {
      // Re-fetch state before retrying a vote: a timed-out save may have succeeded.
      nonce = null;
      status.textContent = '通信できませんでした。ボタンを押すと再接続します。';
      button.disabled = false;
    }
  }
  button.addEventListener('click', function () { request(Boolean(nonce)); });
  request(false);
}());
