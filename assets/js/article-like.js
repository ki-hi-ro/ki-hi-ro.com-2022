(function () {
  'use strict';
  var roots = Array.from(document.querySelectorAll('.article-like'));
  if (!roots.length) return;
  var root = roots[0];
  var buttons = roots.map(function (item) { return item.querySelector('button'); });
  var pending = false;
  function setStatus(message) {
    roots.forEach(function (item) { item.querySelector('.article-like__status').textContent = message; });
  }
  function setDisabled(disabled) {
    buttons.forEach(function (button) { button.disabled = disabled; });
  }
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
    setStatus('いいねを利用するにはブラウザーの保存機能を有効にしてください。');
    return;
  }
  async function request(vote) {
    if (pending) return;
    pending = true;
    setDisabled(true);
    var params = new URLSearchParams({ action: 'kihiro_like', post_id: root.dataset.postId, visitor: token });
    if (vote) { params.set('vote', '1'); params.set('nonce', nonce); }
    try {
      var response = await fetch(root.dataset.endpoint, { method: 'POST', credentials: 'same-origin', body: params });
      var result = await response.json();
      if (!response.ok || !result.success) throw new Error('request');
      nonce = result.data.nonce;
      roots.forEach(function (item) {
        item.querySelector('.article-like__count').textContent = result.data.count.toLocaleString();
        item.querySelector('button').setAttribute('aria-pressed', String(result.data.liked));
      });
      setDisabled(result.data.liked);
      setStatus(vote ? 'ありがとうございます！' : '');
    } catch (error) {
      // Re-fetch state before retrying a vote: a timed-out save may have succeeded.
      nonce = null;
      setStatus('通信できませんでした。ボタンを押すと再接続します。');
      setDisabled(false);
    } finally {
      pending = false;
    }
  }
  buttons.forEach(function (button) {
    button.addEventListener('click', function () { request(Boolean(nonce)); });
  });
  request(false);
}());
